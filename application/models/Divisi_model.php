<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Divisi_model extends CI_Model
{

    public function get_all_divisi($sort = 'asc')
    {
        $this->db->order_by('id_divisi', $sort);
        return $this->db->get('divisi');
    }

    public function get_divisi($id_divisi)
    {
        $this->db->where('id_divisi', $id_divisi);
        return $this->db->get('divisi');
    }

    public function add_divisi($params)
    {
        return $this->db->insert('divisi', $params);
    }

    public function update_divisi($id_divisi, $params)
    {
        $this->db->where('id_divisi', $id_divisi);
        return $this->db->update('divisi', $params);
    }

    public function delete_divisi($id_divisi)
    {
        $this->db->where('id_divisi', $id_divisi);
        return $this->db->delete('divisi');
    }

    public function cek_unik_nama_divisi($nama_divisi, $nama_divisi_awal)
    {
        $this->db->where('nama_divisi', $nama_divisi);
        $this->db->where('nama_divisi <>', $nama_divisi_awal);
        return $this->db->get('divisi');
    }
}

/* End of file Divisi_model.php */
/* Location: ./application/models/Divisi_model.php */