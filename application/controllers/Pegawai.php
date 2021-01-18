<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pegawai extends CI_Controller
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
        $this->load->model('pegawai_model');
        $this->load->model('pengguna_model');
        $this->load->model('divisi_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['pegawai'] = $this->pegawai_model->get_all_pegawai()->result();
        $this->load->view('pegawai/tabel', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('no_induk', 'No Induk', 'required|is_unique[pegawai.no_induk]');
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'numeric');
        $this->form_validation->set_rules('id_divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|is_unique[pengguna.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('numeric', '%s harus angka');
        $this->form_validation->set_message('is_unique', '%s sudah ada');
        $this->form_validation->set_message('min_length', '%s minimal 6 huruf');

        if ($this->form_validation->run()) {
            $params = array(
                'nama_lengkap' => $this->input->post('nama_pegawai', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                'level' => 'Pegawai',
            );
            $id_pengguna = $this->pengguna_model->add_pengguna($params);

            $params = array(
                'no_induk' => $this->input->post('no_induk', TRUE),
                'nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'id_divisi' => $this->input->post('id_divisi', TRUE),
                'id_pengguna' => $id_pengguna,
            );
            $this->pegawai_model->add_pegawai($params);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('pegawai/tambah');
        } else {
            $data['divisi'] = $this->divisi_model->get_all_divisi()->result();
            $this->load->view('pegawai/tambah', $data);
        }
    }

    public function ubah($id_pegawai = '')
    {
        $pegawai = $this->pegawai_model->get_pegawai($id_pegawai)->row();

        if (empty($pegawai)) {
            redirect('pegawai');
        } else {
            $this->form_validation->set_rules('no_induk', 'No Induk', 'required|callback_cek_unik_no_induk');
            $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
            $this->form_validation->set_rules('no_hp', 'No HP', 'numeric');
            $this->form_validation->set_rules('id_divisi', 'Divisi', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_cek_unik_username');

            $this->form_validation->set_message('required', 'Isi dulu %s');
            $this->form_validation->set_message('numeric', '%s harus angka');
            $this->form_validation->set_message('min_length', '%s minimal 6 huruf');

            if ($this->form_validation->run()) {
                $params = array(
                    'nama_lengkap' => $this->input->post('nama_pegawai', TRUE),
                    'username' => $this->input->post('username', TRUE),
                );
                $this->pengguna_model->update_pengguna($pegawai->id_pengguna, $params);

                $params = array(
                    'no_induk' => $this->input->post('no_induk', TRUE),
                    'nama_pegawai' => $this->input->post('nama_pegawai', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'no_hp' => $this->input->post('no_hp', TRUE),
                    'id_divisi' => $this->input->post('id_divisi', TRUE),
                );
                $this->pegawai_model->update_pegawai($id_pegawai, $params);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('pegawai/ubah/' . $id_pegawai);
            } else {
                $data['pegawai'] = $pegawai;
                $data['divisi'] = $this->divisi_model->get_all_divisi()->result();
                $this->load->view('pegawai/ubah', $data);
            }
        }
    }

    public function hapus($id_pegawai = '')
    {
        $pegawai = $this->pegawai_model->get_pegawai($id_pegawai)->row();

        if (!empty($pegawai)) {
            $this->pengguna_model->delete_pengguna($pegawai->id_pengguna);
            $this->pegawai_model->delete_pegawai($id_pegawai);
        }
        redirect('pegawai');
    }

    public function cek_unik_no_induk($no_induk)
    {
        $query = $this->pegawai_model->cek_unik_no_induk($no_induk, $this->input->post('no_induk_awal'));
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('cek_unik_no_induk', '{field} sudah ada');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cek_unik_username($username)
    {
        $query = $this->pengguna_model->cek_unik_username($username, $this->input->post('username_awal'));
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('cek_unik_username', '{field} sudah ada');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}


/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */