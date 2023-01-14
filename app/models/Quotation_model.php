<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    } 

    public function addQuotation($data = array()) {
        if ($this->db->insert('quotation', $data)) {
            return true;
        }
        return false;
    }

    public function getQuotation($id) {

        $q = $this->db->get_where('quotation', array('quotation_id' => $id), 1); 
        if( $q->num_rows() > 0 ) {            
            return $q->row();
        } 
        return FALSE;

    }

    public function getQuotationByID($id)
    {
        $q = $this->db->get_where('quotation', array('quotation_id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function updateQuotation($id, $data = array()) {
        if ($this->db->update('quotation', $data, array('quotation_id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteQuotation($id) {
        if ($this->db->delete('quotation', array('quotation_id' => $id))) {
            return true;
        }
        return FALSE;
    }

}
