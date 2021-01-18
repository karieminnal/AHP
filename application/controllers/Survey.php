<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Survey extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $allowed = array('Pelanggan');
        if (!in_array($this->session->userdata('level'), $allowed)) {
            redirect('home');
        }

        $this->load->model('pelanggan_model');
        $this->load->model('pertanyaan_model');
        $this->load->model('nilai_model');
        $this->load->model('pelanggan_pertanyaan_model');
        $this->load->model('divisi_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['divisi'] = $this->divisi_model->get_all_divisi()->result();
        $pelanggan = $this->pelanggan_model->get_by_id_pengguna($this->session->userdata('id_pengguna'))->row();
        $id_pelanggan = $pelanggan->id_pelanggan;
        foreach ($data['divisi'] as $row) {
            $pelanggan_pertanyaan[$row->id_divisi] = $this->pelanggan_pertanyaan_model->get_pelanggan_pertanyaan_by_id_pelanggan($id_pelanggan, $row->id_divisi)->result();
            $pertanyaan[$row->id_divisi] = $this->pertanyaan_model->get_pertanyaan_by_divisi($row->id_divisi)->result();
        }
        $data['pertanyaan'] = $pertanyaan;
        $data['pelanggan_pertanyaan'] = $pelanggan_pertanyaan;
        $this->load->view('survey/index', $data);
    }

    public function divisi($id_divisi = '')
    {
        $data['pertanyaan'] = $this->pertanyaan_model->get_pertanyaan_by_divisi($id_divisi)->result();
        $data['nilai'] = $this->nilai_model->get_all_nilai()->result();
        $data['divisi'] = $this->divisi_model->get_divisi($id_divisi)->row();

        $pelanggan = $this->pelanggan_model->get_by_id_pengguna($this->session->userdata('id_pengguna'))->row();
        $id_pelanggan = $pelanggan->id_pelanggan;

        foreach ($data['pertanyaan'] as $row) {
            $this->form_validation->set_rules('pertanyaan' . $row->id_pertanyaan, $row->nama_pertanyaan, 'required');
        }

        $this->form_validation->set_message('required', 'Isi dulu %s');

        if ($this->form_validation->run()) {

            foreach ($data['pertanyaan'] as $row) {
                $params = array(
                    'id_divisi' => $id_divisi,
                    'id_pelanggan' => $id_pelanggan,
                    'id_pertanyaan' => $row->id_pertanyaan,
                    'id_nilai' => $this->input->post('pertanyaan' . $row->id_pertanyaan, TRUE),
                );
                $this->pelanggan_pertanyaan_model->add_pelanggan_pertanyaan($params);
            }

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data survey berhasil dikirim</div>');
            $this->load->view('survey/success');
        } else {
            $this->load->view('survey/divisi', $data);
        }
    }

    public function lihat($id_divisi)
    {
        $data['divisi'] = $this->divisi_model->get_divisi($id_divisi)->row();
        $data['pertanyaan'] = $this->pertanyaan_model->get_pertanyaan_by_divisi($id_divisi)->result();
        $data['nilai'] = $this->nilai_model->get_all_nilai()->result();

        $pelanggan = $this->pelanggan_model->get_by_id_pengguna($this->session->userdata('id_pengguna'))->row();
        $id_pelanggan = $pelanggan->id_pelanggan;

        foreach ($data['pertanyaan'] as $row) {
            $result = $this->pelanggan_pertanyaan_model->get_pelanggan_pertanyaan($id_pelanggan, $row->id_pertanyaan)->row();
            $pelanggan_pertanyaan[$row->id_pertanyaan] = empty($result) ? '' : $result->id_nilai;
        }
        $data['pelanggan_pertanyaan'] = $pelanggan_pertanyaan;

        $this->load->view('survey/lihat', $data);
    }
}


/* End of file Survey.php */
/* Location: ./application/controllers/Survey.php */