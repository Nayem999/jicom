<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model
{
	public function __construct() {

		parent::__construct();

	}
	public function getEmplyeeByID($id) {

		$q = $this->db->get_where('employee', array('id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function addEmployee($data) {
		
	
	   if($this->db->insert('employee', $data)) {
		   
		
			return $this->db->insert_id();
			
		}
		
		
		return false;


	}
	
	
	public function editEmployee($data = array(),$id) {

		if($this->db->update('employee', $data, array('id' => $id))) {

			return true;

		}

		return false;

	}

	public function getPaysalary($id){
		
		$this->db->order_by("pay_id", "DESC");	
		$query = $this->db->get_where('paysalary', array('emp_id' => $id)); 
			if( $query->num_rows() > 0 ) {
				
				 return  $query->result(); ; //$q->rows();

			} 

		return FALSE;
		
    }	
	public function paySalary($data) {
		
	  $this->db->set('pay_date', 'NOW()', FALSE);
	   if($this->db->insert('paysalary', $data)) {
			
			return $this->db->insert_id();
			
		}
		
		
		return false;


	}
	
	public function paySalaryUpdate($data,$id) {
		
		if($this->db->update('paysalary', $data, array('pay_id' => $id))) {

			return true;

		}

		return false;

		
		
		}
	public function paySalarySingel($id) {

		$q = $this->db->get_where('paysalary', array('pay_id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function deleteEmployee($id) {

		if($this->db->delete('employee', array('id' => $id))) {

			return true;

		}

		return FALSE;

	}
	
	public function  paySalarydelete($id) {
	
		if($this->db->delete('paysalary', array('pay_id' => $id))) {
			
		  // expenses data delete 
		  
		  $this->db->delete('expenses', array('emp_pay_id' => $id));

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

    public function getAllCategories() {
        $this->db->from('expens_category'); 
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }
  


}

