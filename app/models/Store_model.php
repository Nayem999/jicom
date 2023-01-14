<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model
{
	public function __construct() {

		parent::__construct();

	}
	public function getStoreByID($id) {

		$q = $this->db->get_where('stores', array('id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function addStores($data) {		
	
	   if($this->db->insert('stores', $data)) {		   
		
			return $this->db->insert_id();
			
		}	
		
		return false;

	}
	
	public function storeEditByID($id,$data) {	 

		if($this->db->update('stores', $data, array('id' => $id))) {

			return true;

		}

		return false;

	}

	public function deleteStore($id) {

		if($this->db->delete('stores', array('id' => $id))) {

			return true;

		}

		return FALSE;

	}

}

