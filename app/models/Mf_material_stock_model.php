<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_material_stock_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

	public function getStockList(){
        $this->db->select('mf_material.name as material_name, mf_brands.name as brand_name, stores.name as store_name, mf_material_store_qty.quantity  '); 
        $this->db->from('mf_material_store_qty');  
		$this->db->join('mf_material','mf_material_store_qty.material_id=mf_material.id');
		$this->db->join('stores','mf_material_store_qty.store_id=stores.id');
		$this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
		$this->db->order_by('mf_material.name');
  
        $query = $this->db->get();
        return $query->result(); 
    }
 
}

