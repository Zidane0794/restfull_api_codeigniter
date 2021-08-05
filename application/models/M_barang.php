<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barang extends CI_Model {

    public function get_all()
    {
        
        $q = $this->db->get('tbl_barang');
        
        return $q;
        
    }

    public function get_by_id($id)
    {
        # code...
        $q = $this->db->get_where("tbl_barang", ['id' => $id]);
        return $q;
    }

    public function save($data)
    {
        # code...
        return $this->db->insert('tbl_barang', $data);
        
    }

    public function edit($id, $data)
    {
        # code...
        $this->db->where('id', $id);
        return $this->db->update('tbl_barang', $data);
        
    }

    public function delete($id)
    {
        # code...
        $this->db->where('id', $id);
        
       return $this->db->delete('tbl_barang');
        
    }

}

/* End of file M_barang.php */
