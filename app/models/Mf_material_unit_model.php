<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_material_unit_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    }

    public function addUnit($data) {
        if ($this->db->insert('mf_unit', $data)) {
            return true;
        }
        return false;
    }

    public function updateUnit($id, $data = NULL) {
        if ($this->db->update('mf_unit', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteCategory($id) {
        if ($this->db->delete('mf_categories', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }

    public function getAllUnit() {
        $this->db->from('mf_unit');
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }

    public function getUnitByID($id) {
        $q = $this->db->get_where('mf_unit', array('id' => $id));
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        return FALSE;
    }

}
