<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pelanggan_model extends CI_Model
{

    public function get_all_pelanggan($sort = 'asc')
    {
        $this->db->order_by('id_pelanggan', $sort);
        $this->db->join('pengguna', 'pengguna.id_pengguna=pelanggan.id_pengguna', 'left');
        return $this->db->get('pelanggan');
    }

    public function get_pelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->join('pengguna', 'pengguna.id_pengguna=pelanggan.id_pengguna', 'left');
        return $this->db->get('pelanggan');
    }

    public function add_pelanggan($params)
    {
        $this->db->insert('pelanggan', $params);
        return $this->db->insert_id();
    }

    public function update_pelanggan($id_pelanggan, $params)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->update('pelanggan', $params);
    }

    public function delete_pelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->delete('pelanggan');
    }

    public function get_by_id_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->get('pelanggan');
    }
}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */