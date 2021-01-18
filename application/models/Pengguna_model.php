<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengguna_model extends CI_Model
{

    public function get_all_pengguna($sort = 'asc')
    {
        $this->db->order_by('id_pengguna', $sort);
        return $this->db->get('pengguna');
    }

    public function get_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->get('pengguna');
    }

    public function add_pengguna($params)
    {
        $this->db->insert('pengguna', $params);
        return $this->db->insert_id();
    }

    public function update_pengguna($id_pengguna, $params)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->update('pengguna', $params);
    }

    public function delete_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->delete('pengguna');
    }

    public function get_by_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('pengguna');
    }

    public function cek_unik_username($username, $username_awal)
    {
        $this->db->where('username', $username);
        $this->db->where('username <>', $username_awal);
        return $this->db->get('pengguna');
    }

}

/* End of file Pengguna_model.php */
/* Location: ./application/models/Pengguna_model.php */