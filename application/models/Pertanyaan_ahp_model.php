<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pertanyaan_ahp_model extends CI_Model
{

    public function get_pertanyaan_ahp($id_pertanyaan_1, $id_pertanyaan_2)
    {
        $this->db->where('id_pertanyaan_1', $id_pertanyaan_1);
        $this->db->where('id_pertanyaan_2', $id_pertanyaan_2);
        return $this->db->get('pertanyaan_ahp');
    }

    public function add_pertanyaan_ahp($params)
    {
        return $this->db->insert('pertanyaan_ahp', $params);
    }

    public function update_pertanyaan_ahp($id_pertanyaan_1, $id_pertanyaan_2, $params)
    {
        $this->db->where('id_pertanyaan_1', $id_pertanyaan_1);
        $this->db->where('id_pertanyaan_2', $id_pertanyaan_2);
        return $this->db->update('pertanyaan_ahp', $params);
    }

    public function delete_pertanyaan_ahp($id_divisi)
    {
        $this->db->where('id_divisi', $id_divisi);
        return $this->db->delete('pertanyaan_ahp');
    }
}

/* End of file Pertanyaan_ahp_model.php */
/* Location: ./application/models/Pertanyaan_ahp_model.php */