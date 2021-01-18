<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Hasil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $allowed = array('Admin');
        if (!in_array($this->session->userdata('level'), $allowed)) {
            redirect('home');
        }

        $this->load->model('hasil_model');
        $this->load->model('pertanyaan_model');
        $this->load->model('nilai_model');
        $this->load->model('pelanggan_model');
        $this->load->model('pelanggan_pertanyaan_model');
        $this->load->model('divisi_model');
    }

    public function index()
    {
        $pelanggan = $this->pelanggan_model->get_all_pelanggan()->result();
        $divisi = $this->divisi_model->get_all_divisi()->result();

        foreach ($divisi as $row_divisi) {
            foreach ($pelanggan as $row_pelanggan) {
                $result = $this->pelanggan_pertanyaan_model->get_pelanggan_pertanyaan_by_id_pelanggan($row_pelanggan->id_pelanggan, $row_divisi->id_divisi)->result();
                if (!empty($result)) {
                    $nilai_ahp = 0;
                    foreach ($result as $row_result) {
                        $pertanyaan = $this->pertanyaan_model->get_pertanyaan($row_result->id_pertanyaan)->row();
                        $nilai = $this->nilai_model->get_nilai($row_result->id_nilai)->row();
                        $nilai_ahp += $pertanyaan->prioritas * $nilai->prioritas;
                    }

                    $hasil = $this->hasil_model->get_hasil_by_id_pelanggan($row_pelanggan->id_pelanggan, $row_divisi->id_divisi);
                    if ($hasil->num_rows() > 0) {
                        $hasil = $hasil->row();
                        $params = array(
                            "nilai_ahp" => $nilai_ahp,
                            "tingkat_kepuasan" => round($nilai_ahp * 100, 0),
                        );
                        $this->hasil_model->update_hasil($hasil->id_hasil, $params);
                    } else {
                        $params = array(
                            "id_divisi" => $row_divisi->id_divisi,
                            "id_pelanggan" => $row_pelanggan->id_pelanggan,
                            "nilai_ahp" => $nilai_ahp,
                            "tingkat_kepuasan" => round($nilai_ahp * 100, 0),
                        );
                        $this->hasil_model->add_hasil($params);
                    }
                }
            }
        }

        $data['hasil'] = $this->hitung_divisi($divisi);
        $this->load->view('hasil/tabel', $data);
    }

    public function hitung_divisi($divisi)
    {
        $result = array();
        foreach ($divisi as $row) {
            $hasil = $this->hasil_model->get_hasil_by_id_divisi($row->id_divisi)->result();
            if (!empty($hasil)) {
                $tingkat_kepuasan = 0;
                foreach ($hasil as $row_hasil) {
                    $tingkat_kepuasan += $row_hasil->tingkat_kepuasan;
                }
                $rata = round($tingkat_kepuasan / count($hasil), 0);
                $id_nilai = $this->get_id_nilai($rata);
                $nilai = $this->nilai_model->get_nilai($id_nilai)->row();
                $keterangan = empty($nilai) ? '' : $nilai->nama_nilai;
                $jumlah_pelanggan = $this->pelanggan_pertanyaan_model->get_jumlah_pelanggan($row->id_divisi);
                $result[] = array(
                    'id_divisi' => $row->id_divisi,
                    'nama_divisi' => $row->nama_divisi,
                    'tingkat_kepuasan' => $rata,
                    'keterangan' => $keterangan,
                    'jumlah_pelanggan' => empty($jumlah_pelanggan) ? '' : $jumlah_pelanggan,
                );
            }
        }
        $this->array_sort_by_column($result, 'tingkat_kepuasan');

        return $result;
    }

    public function get_id_nilai($nilai)
    {
        $nilai = $this->nilai_model->get_rentang_nilai($nilai)->row();
        if (empty($nilai)) {
            return null;
        } else {
            return $nilai->id_nilai;
        }
    }

    public function array_sort_by_column(&$arr, $col, $dir = SORT_DESC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }
        array_multisort($sort_col, $dir, $arr);
    }

    public function cetak()
    {
        $divisi = $this->divisi_model->get_all_divisi()->result();
        $data['hasil'] = $this->hitung_divisi($divisi);
        $html = $this->load->view('hasil/cetak', $data, TRUE);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("laporan-hasil-penilaian-ahp.pdf", array("Attachment" => FALSE));
    }

    public function detail($id_divisi = '')
    {
        $data['pelanggan'] = $this->hasil_model->get_hasil_by_id_divisi($id_divisi)->result();
        $data['pertanyaan'] = $this->pertanyaan_model->get_pertanyaan_by_divisi_detail($id_divisi)->result();
        $data['data_nilai'] = $this->nilai_model->get_all_nilai()->result();
        $data['divisi'] = $this->divisi_model->get_divisi($id_divisi)->row();

        $nilai = array();
        $nilai_prioritas = array();
        $hasil = array();

        foreach ($data['pelanggan'] as $row_pelanggan) {
            $nilai_total = 0;
            $res = $this->pelanggan_pertanyaan_model->get_pelanggan_pertanyaan_by_id_pelanggan($row_pelanggan->id_pelanggan, $id_divisi)->result();
            if (!empty($res)) {
                foreach ($res as $row_res) {
                    $pelanggan_pertanyaan = $this->pelanggan_pertanyaan_model->get_pelanggan_pertanyaan($row_pelanggan->id_pelanggan, $row_res->id_pertanyaan)->row();

                    $result = $this->nilai_model->get_nilai($pelanggan_pertanyaan->id_nilai)->row();
                    $nilai[$row_pelanggan->id_pelanggan][$row_res->id_pertanyaan] = empty($pelanggan_pertanyaan) ? '' : $result->nama_nilai;
                    $pertanyaan = $this->pertanyaan_model->get_pertanyaan($row_res->id_pertanyaan)->row();

                    $prioritas = $pertanyaan->prioritas * $result->prioritas;
                    $nilai_prioritas[$row_pelanggan->id_pelanggan][$pertanyaan->id_pertanyaan] = number_format($prioritas, 5);

                    $nilai_total += $prioritas;
                }
            }
            $hasil[] = array(
                "id_pelanggan" => $row_pelanggan->id_pelanggan,
                "nama_pelanggan" => $row_pelanggan->nama_pelanggan,
                "nilai_ahp" => number_format($nilai_total, 5),
                "tingkat_kepuasan" => round(number_format($nilai_total, 5) * 100, 0),
            );
        }
        $this->array_sort_by_column($hasil, 'tingkat_kepuasan');
        $data['nilai'] = $nilai;
        $data['nilai_prioritas'] = $nilai_prioritas;
        $data['hasil'] = $hasil;

        $this->load->view('hasil/detail', $data);
    }

}


/* End of file Hasil.php */
/* Location: ./application/controllers/Hasil.php */