<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model
{
	public function __construct() {

		parent::__construct();

	}
	public function getPartnerByID($id) {

		$q = $this->db->get_where('partner', array('id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function addPartner($data) {
		
	
	   if($this->db->insert('partner', $data)) {
		   
		
			return $this->db->insert_id();
			
		}
		
		
		return false;


	}
	
	public function editPartner($data = array(),$id) {

		if($this->db->update('partner', $data, array('id' => $id))) {

			return true;

		}

		return false;

	}

	public function getLiftprofit($id){
		
		$this->db->order_by("liftprofit_id", "DESC");	
		$query = $this->db->get_where('liftprofit', array('partner_id' => $id)); 
			if( $query->num_rows() > 0 ) {
				
				 return  $query->result(); ; //$q->rows();

			} 

		return FALSE;
		
    }	
	public function payProfit($data) {
		
	  $this->db->set('pay_date', 'NOW()', FALSE);
	   if($this->db->insert('liftprofit', $data)) {			
			return $this->db->insert_id();
			
		}
		
		
		return false;


	}
	
	public function payLeftprofitUpdate($data,$id) {
		
		if($this->db->update('liftprofit', $data, array('liftprofit_id' => $id))) {

			return true;

		}

		return false;		
		
		}
	public function payProfiteSingel($id) {

		$q = $this->db->get_where('liftprofit', array('liftprofit_id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function deletePartner($id) {

		if($this->db->delete('partner', array('id' => $id))) {

			return true;

		}

		return FALSE;

	}
	
	public function  payProfitdelete($id) {
	
		if($this->db->delete('liftprofit', array('liftprofit_id' => $id))) { 
		  $this->db->delete('expenses', array('partner_id' => $id));

			return true;

		}

		return FALSE;

	}
	
	
    public function updateSalaryExpense($data,$id) {

        if ($this->db->update('expenses', $data, array('emp_pay_id' => $id))) {
            return true;
        }
        return false;
    }

    public function updatePartnerExpense($data,$id) {

        if ($this->db->update('expenses', $data, array('partner_id' => $id))) {
            return true;
        }
        return false;
    }

    public function getAllCategories() {
        $this->db->from('expens_category'); 
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }
  


}

