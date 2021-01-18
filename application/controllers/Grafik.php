<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Grafik extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $allowed = array('Admin', 'Pegawai');
        if (!in_array($this->session->userdata('level'), $allowed)) {
            redirect('home');
        }

        $this->load->model('hasil_model');
        $this->load->model('nilai_model');
        $this->load->model('pegawai_model');
        $this->load->model('divisi_model');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'Admin') {
            $divisi = $this->divisi_model->get_all_divisi()->result();
        } else {
            $pegawai = $this->pegawai_model->get_by_id_pengguna($this->session->userdata('id_pengguna'))->row();
            $divisi = $this->divisi_model->get_divisi($pegawai->id_divisi)->result();
        }
        $data['hasil'] = $this->hitung_divisi($divisi);

        $this->load->view('grafik/index', $data);
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
                $result[] = array(
                    'id_divisi' => $row->id_divisi,
                    'nama_divisi' => $row->nama_divisi,
                    'tingkat_kepuasan' => $rata,
                    'keterangan' => $keterangan,
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
}


/* End of file Grafik.php */
/* Location: ./application/controllers/Grafik.php */