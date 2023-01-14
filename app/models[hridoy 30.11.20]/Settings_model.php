<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{
	
	public function __construct() {
		parent::__construct();
	}
	
	public function updateSetting($data = array()) { 
		if($this->db->update('settings', $data, array('setting_id' => 1))) {
			return true;
		}
		return false;
	}

	 /*$store_id = $this->session->userdata('store_id');

        if(($store_id !=0)||($store_id !=NULL)){        
			if($this->db->update('settings', $data, array('store_id' => $store_id))) {
				return true;
			}
		} else {
			if($this->db->update('settings', $data, array('store_id' => $store_id))) {
				return true;
			}
		}
		return false;*/
	

}
