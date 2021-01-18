<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pelanggan extends CI_Controller
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
        $this->load->model('pelanggan_model');
        $this->load->model('pengguna_model');

        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['pelanggan'] = $this->pelanggan_model->get_all_pelanggan()->result();
        $this->load->view('pelanggan/tabel', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'numeric');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|is_unique[pengguna.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        $this->form_validation->set_message('required', 'Isi dulu %s');
        $this->form_validation->set_message('numeric', '%s harus angka');
        $this->form_validation->set_message('is_unique', '%s sudah ada');
        $this->form_validation->set_message('min_length', '%s minimal 6 huruf');

        if ($this->form_validation->run()) {
            $params = array(
                'nama_lengkap' => $this->input->post('nama_pelanggan', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
                'level' => 'Pelanggan',
            );
            $id_pengguna = $this->pengguna_model->add_pengguna($params);

            $params = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'id_pengguna' => $id_pengguna,
            );
            $this->pelanggan_model->add_pelanggan($params);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
            redirect('pelanggan/tambah');
        } else {
            $this->load->view('pelanggan/tambah');
        }
    }

    public function ubah($id_pelanggan = '')
    {
        $pelanggan = $this->pelanggan_model->get_pelanggan($id_pelanggan)->row();

        if (empty($pelanggan)) {
            redirect('pelanggan');
        } else {
            $this->form_validation->set_rules('nama_pelanggan', 'Nama Pelanggan', 'required');
            $this->form_validation->set_rules('no_hp', 'No HP', 'numeric');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|callback_cek_unik_username');

            $this->form_validation->set_message('required', 'Isi dulu %s');
            $this->form_validation->set_message('numeric', '%s harus angka');
            $this->form_validation->set_message('min_length', '%s minimal 6 huruf');

            if ($this->form_validation->run()) {
                $params = array(
                    'nama_lengkap' => $this->input->post('nama_pelanggan', TRUE),
                    'username' => $this->input->post('username', TRUE),
                );
                $this->pengguna_model->update_pengguna($pelanggan->id_pengguna, $params);

                $params = array(
                    'nama_pelanggan' => $this->input->post('nama_pelanggan', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'no_hp' => $this->input->post('no_hp', TRUE),
                );
                $this->pelanggan_model->update_pelanggan($id_pelanggan, $params);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil disimpan</div>');
                redirect('pelanggan/ubah/' . $id_pelanggan);
            } else {
                $data['pelanggan'] = $pelanggan;
                $this->load->view('pelanggan/ubah', $data);
            }
        }
    }

    public function hapus($id_pelanggan = '')
    {
        $pelanggan = $this->pelanggan_model->get_pelanggan($id_pelanggan)->row();

        if (!empty($pelanggan)) {
            $this->pengguna_model->delete_pengguna($pelanggan->id_pengguna);
            $this->pelanggan_model->delete_pelanggan($id_pelanggan);
        }
        redirect('pelanggan');
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


/* End of file Pelanggan.php */
/* Location: ./application/controllers/Pelanggan.php */