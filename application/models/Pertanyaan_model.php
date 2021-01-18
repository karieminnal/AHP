<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pertanyaan_model extends CI_Model
{

    public function get_all_pertanyaan($sort = 'asc')
    {
        $this->db->order_by('id_pertanyaan', $sort);
        $this->db->join('divisi', 'divisi.id_divisi=pertanyaan.id_divisi', 'left');
        return $this->db->get('pertanyaan');
    }

    public function get_pertanyaan_by_divisi($id_divisi)
    {
        $this->db->order_by('id_pertanyaan', 'asc');
        $this->db->where('pertanyaan.id_divisi', $id_divisi);
        $this->db->join('divisi', 'divisi.id_divisi=pertanyaan.id_divisi', 'left');
        return $this->db->get('pertanyaan');
    }

    public function get_pertanyaan_by_divisi_detail($id_divisi)
    {
        $this->db->order_by('id_pertanyaan', 'asc');
        $this->db->where('pertanyaan.id_divisi', $id_divisi);
        $this->db->where('prioritas <>', null);
        $this->db->join('divisi', 'divisi.id_divisi=pertanyaan.id_divisi', 'left');
        return $this->db->get('pertanyaan');
    }

    public function get_pertanyaan($id_pertanyaan)
    {
        $this->db->where('id_pertanyaan', $id_pertanyaan);
        $this->db->join('divisi', 'divisi.id_divisi=pertanyaan.id_divisi', 'left');
        return $this->db->get('pertanyaan');
    }

    public function add_pertanyaan($params)
    {
        return $this->db->insert('pertanyaan', $params);
    }

    public function update_pertanyaan($id_pertanyaan, $params)
    {
        $this->db->where('id_pertanyaan', $id_pertanyaan);
        return $this->db->update('pertanyaan', $params);
    }

    public function delete_pertanyaan($id_pertanyaan)
    {
        $this->db->where('id_pertanyaan', $id_pertanyaan);
        return $this->db->delete('pertanyaan');
    }

    public function cek_unik_kode_pertanyaan($kode_pertanyaan, $kode_pertanyaan_awal)
    {
        $this->db->where('kode_pertanyaan', $kode_pertanyaan);
        $this->db->where('kode_pertanyaan <>', $kode_pertanyaan_awal);
        return $this->db->get('pertanyaan');
    }

    public function update_prioritas($id_divisi = '', $params)
    {
        $this->db->where('id_divisi', $id_divisi);
        return $this->db->update('pertanyaan', $params);
    }

    public function id_terakhir()
    {
        $this->db->select('kode_pertanyaan');
        $this->db->order_by('kode_pertanyaan', 'DESC');
        $query = $this->db->get('pertanyaan');
        return $query->row();
    }
}

/* End of file Pertanyaan_model.php */
/* Location: ./application/models/Pertanyaan_model.php */