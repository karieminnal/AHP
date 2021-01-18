<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pertanyaan extends CI_Controller
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

        $this->load->model('pertanyaan_model');
        $this->load->model('pertanyaan_ahp_model');
        $this->load->model('divisi_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['pertanyaan'] = $this->pertanyaan_model->get_all_pertanyaan()->result();
        $this->load->view('pertanyaan/tabel', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('id_divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('kode_pertanyaan', 'Kode Pertanyaan', 'required|is_unique[pertanyaan.kode_pertanyaan]');
        $this->form_validation->set_rules('nama_pertanyaan', 'Nama Pertanyaan', 'required');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('is_unique', '%s sudah ada');

        if ($this->form_validation->run()) {
            $params = array(
                'kode_pertanyaan' => $this->input->post('kode_pertanyaan', TRUE),
                'nama_pertanyaan' => $this->input->post('nama_pertanyaan', TRUE),
                'id_divisi' => $this->input->post('id_divisi', TRUE),
            );
            $this->pertanyaan_model->add_pertanyaan($params);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('pertanyaan/tambah');
        } else {
            $data['divisi'] = $this->divisi_model->get_all_divisi()->result();
            $data['kode_pertanyaan'] = $this->get_kode_pertanyaan();
            $this->load->view('pertanyaan/tambah', $data);
        }
    }

    public function ubah($id_pertanyaan = '')
    {
        $data['pertanyaan'] = $this->pertanyaan_model->get_pertanyaan($id_pertanyaan)->row();

        if (empty($data['pertanyaan'])) {
            redirect('pertanyaan');
        } else {
            $this->form_validation->set_rules('id_divisi', 'Divisi', 'required');
            $this->form_validation->set_rules('kode_pertanyaan', 'Kode Pertanyaan', 'required|callback_cek_unik_kode_pertanyaan');
            $this->form_validation->set_rules('nama_pertanyaan', 'Nama Pertanyaan', 'required');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'kode_pertanyaan' => $this->input->post('kode_pertanyaan', TRUE),
                    'nama_pertanyaan' => $this->input->post('nama_pertanyaan', TRUE),
                    'id_divisi' => $this->input->post('id_divisi', TRUE),
                );
                $this->pertanyaan_model->update_pertanyaan($id_pertanyaan, $params);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('pertanyaan/ubah/' . $id_pertanyaan);
            } else {
                $data['divisi'] = $this->divisi_model->get_all_divisi()->result();
                $this->load->view('pertanyaan/ubah', $data);
            }
        }
    }

    public function hapus($id_pertanyaan = '')
    {
        $pertanyaan = $this->pertanyaan_model->get_pertanyaan($id_pertanyaan);

        if ($pertanyaan->num_rows() > 0) {
            $this->pertanyaan_model->delete_pertanyaan($id_pertanyaan);
        }
        redirect('pertanyaan');
    }

    public function cek_unik_kode_pertanyaan($kode_pertanyaan)
    {
        $query = $this->pertanyaan_model->cek_unik_kode_pertanyaan($kode_pertanyaan, $this->input->post('kode_pertanyaan_awal'));
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('cek_unik_kode_pertanyaan', '{field} sudah digunakan');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_kode_pertanyaan()
    {
        $this->load->library('auto_number');
        $row = $this->pertanyaan_model->id_terakhir();
        $config['id'] = empty($row->kode_pertanyaan) ? '' : $row->kode_pertanyaan;
        $config['awalan'] = 'P';
        $config['digit'] = 3;
        $this->auto_number->config($config);
        return $this->auto_number->generate_id();
    }

    public function prioritas($id_divisi = '')
    {
        $data['id_divisi'] = empty($this->input->post('id_divisi')) ? $id_divisi : $this->input->post('id_divisi');
        $data['divisi'] = $this->divisi_model->get_all_divisi()->result();

        $query_pertanyaan = $this->pertanyaan_model->get_pertanyaan_by_divisi($data['id_divisi']);
        $data['pertanyaan'] = $query_pertanyaan->num_rows() < 3 ? null : $query_pertanyaan->result();

        if (isset($_POST['save'])) {
            $this->pertanyaan_ahp_model->delete_pertanyaan_ahp($data['id_divisi']);
            $i = 0;
            foreach ($data['pertanyaan'] as $row1) {
                $ii = 0;
                foreach ($data['pertanyaan'] as $row2) {
                    if ($i < $ii) {
                        $nilai_input = $this->input->post('nilai_' . $row1->id_pertanyaan . '_' . $row2->id_pertanyaan);
                        $nilai_1 = 0;
                        $nilai_2 = 0;
                        if ($nilai_input < 1) {
                            $nilai_1 = abs($nilai_input);
                            $nilai_2 = number_format(1 / abs($nilai_input), 5);
                        } elseif ($nilai_input > 1) {
                            $nilai_1 = number_format(1 / abs($nilai_input), 5);
                            $nilai_2 = abs($nilai_input);
                        } elseif ($nilai_input == 1) {
                            $nilai_1 = 1;
                            $nilai_2 = 1;
                        }
                        $params = array(
                            'id_divisi' => $data['id_divisi'],
                            'id_pertanyaan_1' => $row1->id_pertanyaan,
                            'id_pertanyaan_2' => $row2->id_pertanyaan,
                            'nilai_1' => $nilai_1,
                            'nilai_2' => $nilai_2,
                        );
                        $this->pertanyaan_ahp_model->add_pertanyaan_ahp($params);
                    }
                    $ii++;
                }
                $i++;
            }
            $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert">Nilai perbandingan pertanyaan berhasil disimpan</div>');
        }

        if (isset($_POST['check'])) {
            if ($query_pertanyaan->num_rows() < 3) {
                $this->session->set_flashdata('pesan_error', '<div class="alert alert-danger" role="alert">Jumlah pertanyaan kurang, minimal 3</div>');
            } else {
                $id_pertanyaan = array();
                foreach ($data['pertanyaan'] as $row)
                    $id_pertanyaan[] = $row->id_pertanyaan;
            }

            // perhitungan metode AHP
            $matrik_pertanyaan = $this->ahp_get_matrik_pertanyaan($id_pertanyaan);
            $jumlah_kolom = $this->ahp_get_jumlah_kolom($matrik_pertanyaan);
            $matrik_normalisasi = $this->ahp_get_normalisasi($matrik_pertanyaan, $jumlah_kolom);
            $prioritas = $this->ahp_get_prioritas($matrik_normalisasi);
            $matrik_baris = $this->ahp_get_matrik_baris($prioritas, $matrik_pertanyaan);
            $jumlah_matrik_baris = $this->ahp_get_jumlah_matrik_baris($matrik_baris);
            $hasil_tabel_konsistensi = $this->ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas);
            if ($this->ahp_uji_konsistensi($hasil_tabel_konsistensi)) {
                $this->session->set_flashdata('pesan_sukses', '<div class="alert alert-success" role="alert">Nilai perbandingan : KONSISTEN</div>');
                $i = 0;
                foreach ($data['pertanyaan'] as $row) {
                    $params = array(
                        'prioritas' => $prioritas[$i++],
                    );
                    $this->pertanyaan_model->update_pertanyaan($row->id_pertanyaan, $params);
                }

                $data['list_data'] = $this->tampil_data_1($matrik_pertanyaan, $jumlah_kolom, $data['id_divisi']);
                $data['list_data2'] = $this->tampil_data_2($matrik_normalisasi, $prioritas, $data['id_divisi']);
                $data['list_data3'] = $this->tampil_data_3($matrik_baris, $jumlah_matrik_baris, $data['id_divisi']);
                $list_data = $this->tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi, $data['id_divisi']);
                $data['list_data4'] = $list_data[0];
                $data['list_data5'] = $list_data[1];
            } else {
                $this->session->set_flashdata('pesan_error', '<div class="alert alert-danger" role="alert">Nilai perbandingan : TIDAK KONSISTEN</div>');
            }
        }

        if (!empty($data['pertanyaan'])) {
            $result = array();
            $i = 0;
            foreach ($data['pertanyaan'] as $row1) {
                $ii = 0;
                foreach ($data['pertanyaan'] as $row2) {
                    if ($i < $ii) {
                        $pertanyaan_ahp = $this->pertanyaan_ahp_model->get_pertanyaan_ahp($row1->id_pertanyaan, $row2->id_pertanyaan)->row();
                        if (empty($pertanyaan_ahp)) {
                            $params = array(
                                'id_divisi' => $data['id_divisi'],
                                'id_pertanyaan_1' => $row1->id_pertanyaan,
                                'id_pertanyaan_2' => $row2->id_pertanyaan,
                                'nilai_1' => 1,
                                'nilai_2' => 1,
                            );
                            $this->pertanyaan_ahp_model->add_pertanyaan_ahp($params);
                            $nilai_1 = 1;
                            $nilai_2 = 1;
                        } else {
                            $nilai_1 = $pertanyaan_ahp->nilai_1;
                            $nilai_2 = $pertanyaan_ahp->nilai_2;
                        }
                        $nilai = 0;
                        if ($nilai_1 < 1) {
                            $nilai = $nilai_2;
                        } elseif ($nilai_1 > 1) {
                            $nilai = -$nilai_1;
                        } elseif ($nilai_1 == 1) {
                            $nilai = 1;
                        }
                        $result[$row1->id_pertanyaan][$row2->id_pertanyaan] = $nilai;
                    }
                    $ii++;
                }
                $i++;
            }

            $data['pertanyaan_ahp'] = $result;
        }

        $this->load->view('pertanyaan/prioritas', $data);
    }

    public function reset($id_divisi)
    {
        $this->pertanyaan_ahp_model->delete_pertanyaan_ahp($id_divisi);
        $params = array(
            'prioritas' => null,
        );
        $this->pertanyaan_model->update_prioritas($id_divisi, $params);
        redirect('pertanyaan/prioritas/' . $id_divisi);
    }

    // --- metode AHP --- START
    public function ahp_get_matrik_pertanyaan($pertanyaan)
    {
        $matrik = array();
        $i = 0;
        foreach ($pertanyaan as $row1) {
            $ii = 0;
            foreach ($pertanyaan as $row2) {
                if ($i == $ii) {
                    $matrik[$i][$ii] = 1;
                } else {
                    if ($i < $ii) {
                        $pertanyaan_ahp = $this->pertanyaan_ahp_model->get_pertanyaan_ahp($row1, $row2)->row();
                        if (empty($pertanyaan_ahp)) {
                            $matrik[$i][$ii] = 1;
                            $matrik[$ii][$i] = 1;
                        } else {
                            $matrik[$i][$ii] = $pertanyaan_ahp->nilai_1;
                            $matrik[$ii][$i] = $pertanyaan_ahp->nilai_2;
                        }
                    }
                }
                $ii++;
            }
            $i++;
        }
        return $matrik;
    }

    public function ahp_get_jumlah_kolom($matrik)
    {
        $jumlah_kolom = array();
        for ($i = 0; $i < count($matrik); $i++) {
            $jumlah_kolom[$i] = 0;
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $jumlah_kolom[$i] = $jumlah_kolom[$i] + $matrik[$ii][$i];
            }
        }
        return $jumlah_kolom;
    }

    public function ahp_get_normalisasi($matrik, $jumlah_kolom)
    {
        $matrik_normalisasi = array();
        for ($i = 0; $i < count($matrik); $i++) {
            for ($ii = 0; $ii < count($matrik); $ii++) {
                $matrik_normalisasi[$i][$ii] = number_format($matrik[$i][$ii] / $jumlah_kolom[$ii], 5);
            }
        }
        return $matrik_normalisasi;
    }

    public function ahp_get_prioritas($matrik_normalisasi)
    {
        $prioritas = array();
        for ($i = 0; $i < count($matrik_normalisasi); $i++) {
            $prioritas[$i] = 0;
            for ($ii = 0; $ii < count($matrik_normalisasi); $ii++) {
                $prioritas[$i] = $prioritas[$i] + $matrik_normalisasi[$i][$ii];
            }
            $prioritas[$i] = number_format($prioritas[$i] / count($matrik_normalisasi), 5);
        }
        return $prioritas;
    }

    public function ahp_get_matrik_baris($prioritas, $matrik_pertanyaan)
    {
        $matrik_baris = array();
        for ($i = 0; $i < count($matrik_pertanyaan); $i++) {
            for ($ii = 0; $ii < count($matrik_pertanyaan); $ii++) {
                $matrik_baris[$i][$ii] = number_format($prioritas[$ii] * $matrik_pertanyaan[$i][$ii], 5);
            }
        }
        return $matrik_baris;
    }

    public function ahp_get_jumlah_matrik_baris($matrik_baris)
    {
        $jumlah_baris = array();
        for ($i = 0; $i < count($matrik_baris); $i++) {
            $jumlah_baris[$i] = 0;
            for ($ii = 0; $ii < count($matrik_baris); $ii++) {
                $jumlah_baris[$i] = $jumlah_baris[$i] + $matrik_baris[$i][$ii];
            }
        }
        return $jumlah_baris;
    }

    public function ahp_get_tabel_konsistensi($jumlah_matrik_baris, $prioritas)
    {
        $jumlah = array();
        for ($i = 0; $i < count($jumlah_matrik_baris); $i++) {
            $jumlah[$i] = $jumlah_matrik_baris[$i] + $prioritas[$i];
        }
        return $jumlah;
    }

    public function ahp_uji_konsistensi($tabel_konsistensi)
    {
        $jumlah = array_sum($tabel_konsistensi);
        $n = count($tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        if ($cr <= 0.1) {
            return true;
        } else {
            return false;
        }
    }
    // --- metode AHP --- END

    // --- untuk menampilkan langkah perhitungan ---
    public function tampil_data_1($matrik_pertanyaan, $jumlah_kolom, $id_divisi)
    {
        $pertanyaan = $this->pertanyaan_model->get_pertanyaan_by_divisi($id_divisi)->result();
        // --- tabel matriks perbandingan berpasangan
        $list_data = '';
        $list_data .= '<tr><td class="text-center">Pertanyaan</td>';
        foreach ($pertanyaan as $row) {
            $list_data .= '<td class="text-center">' . $row->nama_pertanyaan . '</td>';
        }
        $list_data .= '</tr>';
        $i = 0;
        foreach ($pertanyaan as $row) {
            $list_data .= '<tr>';
            $list_data .= '<td style="text-align: left">' . $row->nama_pertanyaan . '</td>';
            $ii = 0;
            foreach ($pertanyaan as $row2) {
                $list_data .= '<td class="text-center">' . $matrik_pertanyaan[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data .= '</tr>';
            $i++;
        }
        $list_data .= '<tr><td class="font-weight-bold">Jumlah</td>';
        for ($i = 0; $i < count($jumlah_kolom); $i++) {
            $list_data .= '<td class="text-center font-weight-bold">' . $jumlah_kolom[$i] . '</td>';
        }
        $list_data .= '</tr>';
        // ---
        return $list_data;
    }

    public function tampil_data_2($matrik_normalisasi, $prioritas, $id_divisi)
    {
        $pertanyaan = $this->pertanyaan_model->get_pertanyaan_by_divisi($id_divisi)->result();
        // --- matriks nilai pertanyaan
        $list_data2 = '';
        $list_data2 .= '<tr><td class="text-center">Pertanyaan</td>';
        foreach ($pertanyaan as $row) {
            $list_data2 .= '<td class="text-center">' . $row->nama_pertanyaan . '</td>';
        }
        $list_data2 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data2 .= '<td class="text-center font-weight-bold">Prioritas</td>';
        $list_data2 .= '</tr>';
        $i = 0;
        foreach ($pertanyaan as $row) {
            $list_data2 .= '<tr>';
            $list_data2 .= '<td style="text-align: left">' . $row->nama_pertanyaan . '</td>';
            $jumlah = 0;
            $ii = 0;
            foreach ($pertanyaan as $row2) {
                $list_data2 .= '<td class="text-center">' . $matrik_normalisasi[$i][$ii] . '</td>';
                $jumlah += $matrik_normalisasi[$i][$ii];
                $ii++;
            }
            $list_data2 .= '<td class="text-center font-weight-bold">' . $jumlah . '</td>';
            $list_data2 .= '<td class="text-center font-weight-bold">' . $prioritas[$i] . '</td>';
            $list_data2 .= '</tr>';
            $i++;
        }
        // ---
        return $list_data2;
    }

    public function tampil_data_3($matrik_baris, $jumlah_matrik_baris, $id_divisi)
    {
        $pertanyaan = $this->pertanyaan_model->get_pertanyaan_by_divisi($id_divisi)->result();
        // --- matriks penjumlahan setiap baris
        $list_data3 = '';
        $list_data3 .= '<tr><td class="text-center">Pertanyaan</td>';
        foreach ($pertanyaan as $row) {
            $list_data3 .= '<td class="text-center">' . $row->nama_pertanyaan . '</td>';
        }
        $list_data3 .= '<td class="text-center font-weight-bold">Jumlah</td>';
        $list_data3 .= '</tr>';
        $i = 0;
        foreach ($pertanyaan as $row) {
            $list_data3 .= '<tr>';
            $list_data3 .= '<td style="text-align: left">' . $row->nama_pertanyaan . '</td>';
            $ii = 0;
            foreach ($pertanyaan as $row2) {
                $list_data3 .= '<td class="text-center">' . $matrik_baris[$i][$ii] . '</td>';
                $ii++;
            }
            $list_data3 .= '<td class="text-center font-weight-bold">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data3 .= '</tr>';
            $i++;
        }
        // ---
        return $list_data3;
    }

    public function tampil_data_4($jumlah_matrik_baris, $prioritas, $hasil_tabel_konsistensi, $id_divisi)
    {
        $pertanyaan = $this->pertanyaan_model->get_pertanyaan_by_divisi($id_divisi)->result();
        // --- perhitungan rasio konsistensi
        $list_data4 = '';
        $list_data4 .= '<tr><td class="text-center">Pertanyaan</td>';
        $list_data4 .= '<td class="text-center">Jumlah per Baris</td>';
        $list_data4 .= '<td class="text-center">Prioritas</td>';
        $list_data4 .= '<td class="text-center font-weight-bold">Hasil</td>';
        $list_data4 .= '</tr>';
        $i = 0;
        foreach ($pertanyaan as $row) {
            $list_data4 .= '<tr>';
            $list_data4 .= '<td style="text-align: left">' . $row->nama_pertanyaan . '</td>';
            $list_data4 .= '<td class="text-center">' . $jumlah_matrik_baris[$i] . '</td>';
            $list_data4 .= '<td class="text-center">' . $prioritas[$i] . '</td>';
            $list_data4 .= '<td class="text-center font-weight-bold">' . $hasil_tabel_konsistensi[$i] . '</td>';
            $list_data4 .= '</tr>';
            $i++;
        }
        $jumlah = array_sum($hasil_tabel_konsistensi);
        $n = count($hasil_tabel_konsistensi);
        $lambda_maks = $jumlah / $n;
        $ci = ($lambda_maks - $n) / ($n - 1);
        $ir = array(0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1.51, 1.48, 1.56, 1.57, 1.59);
        if ($n <= 15) {
            $ir = $ir[$n - 1];
        } else {
            $ir = $ir[14];
        }
        $cr = number_format($ci / $ir, 5);

        $list_data5 = '';
        $list_data5 .= '<table class="table-prioritas mt-4">
<tr>
    <td width="100" style="text-align: left">Jumlah</td>
    <td style="text-align: left">= ' . $jumlah . '</td>
</tr>
<tr>
    <td width="100" style="text-align: left">n </td>
    <td style="text-align: left">= ' . $n . '</td>
</tr>
<tr>
    <td width="100" style="text-align: left">λ maks</td>
    <td style="text-align: left">= ' . number_format($lambda_maks, 5) . '</td>
</tr>
<tr>
    <td width="100" style="text-align: left">CI</td>
    <td style="text-align: left">= ' . number_format($ci, 5) . '</td>
</tr>
<tr>
    <td width="100" style="text-align: left">CR</td>
    <td style="text-align: left">= ' . $cr . '</td>
</tr>
<tr>
    <td width="100" style="text-align: left">CR <= 0.1</td>';
        if ($cr <= 0.1) {
            $list_data5 .= '
    <td style="text-align: left">Konsisten</td>';
        } else {
            $list_data5 .= '
    <td style="text-align: left">Tidak Konsisten</td>';
        }
        $list_data5 .= '
</tr>
</table>';
        // ---
        return array($list_data4, $list_data5);
    }
    // -------
}


/* End of file Pertanyaan.php */
/* Location: ./application/controllers/Pertanyaan.php */