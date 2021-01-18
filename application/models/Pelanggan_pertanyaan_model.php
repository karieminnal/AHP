<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pelanggan_pertanyaan_model extends CI_Model
{

    public function get_pelanggan_pertanyaan($id_pelanggan, $id_pertanyaan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_pertanyaan', $id_pertanyaan);
        return $this->db->get('pelanggan_pertanyaan');
    }

    public function add_pelanggan_pertanyaan($params)
    {
        return $this->db->insert('pelanggan_pertanyaan', $params);
    }

    public function update_pelanggan_pertanyaan($id_pelanggan, $id_pertanyaan, $params)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('id_pertanyaan', $id_pertanyaan);
        return $this->db->update('pelanggan_pertanyaan', $params);
    }

    public function get_all_pelanggan_pertanyaan()
    {
        return $this->db->get('pelanggan_pertanyaan');
    }

    public function get_pelanggan_pertanyaan_by_id_pelanggan($id_pelanggan, $id_divisi)
    {
        $this->db->where('id_divisi', $id_divisi);
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->get('pelanggan_pertanyaan');
    }

    public function update_by_id($id, $params)
    {
        $this->db->where('id', $id);
        return $this->db->update('pelanggan_pertanyaan', $params);
    }

    public function get_jumlah_pelanggan($id_divisi)
    {
        $this->db->where('id_divisi', $id_divisi);
        $this->db->group_by('id_pelanggan');
        return $this->db->get('pelanggan_pertanyaan')->num_rows();
    }
}

/* End of file Pelanggan_pertanyaan_model.php */
/* Location: ./application/models/Pelanggan_pertanyaan_model.php */