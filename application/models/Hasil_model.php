<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Hasil_model extends CI_Model
{

    public function get_all_hasil()
    {
        $this->db->order_by('nilai_ahp', 'desc');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan=hasil.id_pelanggan', 'left');
        return $this->db->get('hasil');
    }

    public function get_hasil_by_id_pelanggan($id_pelanggan, $id_divisi)
    {
        $this->db->where('id_divisi', $id_divisi);
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->get('hasil');
    }

    public function get_hasil_by_id_divisi($id_divisi)
    {
        $this->db->where('hasil.id_divisi', $id_divisi);
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan=hasil.id_pelanggan', 'left');
        $this->db->join('divisi', 'divisi.id_divisi=hasil.id_divisi', 'left');
        return $this->db->get('hasil');
    }

    public function add_hasil($params)
    {
        return $this->db->insert('hasil', $params);
    }

    public function update_hasil($id_hasil, $params)
    {
        $this->db->where('id_hasil', $id_hasil);
        return $this->db->update('hasil', $params);
    }

}

/* End of file Hasil_model.php */
/* Location: ./application/models/Hasil_model.php */