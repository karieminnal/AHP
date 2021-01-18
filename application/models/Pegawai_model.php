<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pegawai_model extends CI_Model
{

    public function get_all_pegawai($sort = 'asc')
    {
        $this->db->order_by('id_pegawai', $sort);
        $this->db->join('pengguna', 'pengguna.id_pengguna=pegawai.id_pengguna', 'left');
        $this->db->join('divisi', 'divisi.id_divisi=pegawai.id_divisi', 'left');
        return $this->db->get('pegawai');
    }

    public function get_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->join('pengguna', 'pengguna.id_pengguna=pegawai.id_pengguna', 'left');
        $this->db->join('divisi', 'divisi.id_divisi=pegawai.id_divisi', 'left');
        return $this->db->get('pegawai');
    }

    public function add_pegawai($params)
    {
        $this->db->insert('pegawai', $params);
        return $this->db->insert_id();
    }

    public function update_pegawai($id_pegawai, $params)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        return $this->db->update('pegawai', $params);
    }

    public function delete_pegawai($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        return $this->db->delete('pegawai');
    }

    public function get_by_id_pengguna($id_pengguna)
    {
        $this->db->where('id_pengguna', $id_pengguna);
        return $this->db->get('pegawai');
    }

    public function cek_unik_no_induk($no_induk, $no_induk_awal)
    {
        $this->db->where('no_induk', $no_induk);
        $this->db->where('no_induk <>', $no_induk_awal);
        return $this->db->get('pegawai');
    }
}

/* End of file Pegawai_model.php */
/* Location: ./application/models/Pegawai_model.php */