<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Divisi extends CI_Controller
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
        $this->load->model('divisi_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['divisi'] = $this->divisi_model->get_all_divisi()->result();
        $this->load->view('divisi/tabel', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_divisi', 'Nama Divisi', 'required|is_unique[divisi.nama_divisi]');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('is_unique', '%s sudah ada');

        if ($this->form_validation->run()) {
            $params = array(
                'nama_divisi' => $this->input->post('nama_divisi', TRUE),
            );
            $this->divisi_model->add_divisi($params);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('divisi/tambah');
        } else {
            $this->load->view('divisi/tambah');
        }
    }

    public function ubah($id_divisi = '')
    {
        $divisi = $this->divisi_model->get_divisi($id_divisi)->row();

        if (empty($divisi)) {
            redirect('divisi');
        } else {
            $this->form_validation->set_rules('nama_divisi', 'Nama Divisi', 'required|callback_cek_unik_nama_divisi');

            $this->form_validation->set_message('required', 'Isi dulu %s');

            if ($this->form_validation->run()) {
                $params = array(
                    'nama_divisi' => $this->input->post('nama_divisi', TRUE),
                );
                $this->divisi_model->update_divisi($id_divisi, $params);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('divisi/ubah/' . $id_divisi);
            } else {
                $data['divisi'] = $divisi;
                $this->load->view('divisi/ubah', $data);
            }
        }
    }

    public function hapus($id_divisi = '')
    {
        $divisi = $this->divisi_model->get_divisi($id_divisi)->row();

        if (!empty($divisi)) {
            $this->divisi_model->delete_divisi($id_divisi);
        }
        redirect('divisi');
    }

    public function cek_unik_nama_divisi($nama_divisi)
    {
        $query = $this->divisi_model->cek_unik_nama_divisi($nama_divisi, $this->input->post('nama_divisi_awal'));
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('cek_unik_nama_divisi', '{field} sudah ada');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}


/* End of file Divisi.php */
/* Location: ./application/controllers/Divisi.php */