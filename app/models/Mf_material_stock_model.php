<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_material_stock_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

	public function getStockList(){

        $this->db->select('mf_material_store_qty.id, mf_material.name as material_name, mf_brands.name as brand_name, stores.name as store_name, mf_material_store_qty.quantity, mf_unit.name as unit_name '); 
        $this->db->from('mf_material_store_qty');  
		$this->db->join('mf_material','mf_material_store_qty.material_id=mf_material.id');
		$this->db->join('stores','mf_material_store_qty.store_id=stores.id');
		$this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');
		$this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
		$this->db->order_by('mf_material.id','desc');
  
        $query = $this->db->get();
        return $query->result(); 
    }

	public function getStockStoreById($id){

        $this->db->select('mf_material_store_qty.id, mf_material.id as material_id, mf_material.name as material_name, mf_brands.name as brand_name, stores.name as store_name, mf_material_store_qty.quantity '); 
        $this->db->from('mf_material_store_qty');  
		$this->db->join('mf_material','mf_material_store_qty.material_id=mf_material.id');
		$this->db->join('stores','mf_material_store_qty.store_id=stores.id');
		$this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
		$this->db->order_by('mf_material.name');
		$this->db->where('mf_material_store_qty.id',$id);
  
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

    }

	public function getStockById($id){

        $this->db->select('mf_material.id as material_id, mf_material.name as material_name,  mf_material.quantity '); 
        $this->db->from('mf_material');  
		$this->db->order_by('mf_material.id');
		$this->db->where('mf_material.id',$id);
  
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

    }

    public function adjustStoreStock($id, $data = array())
	{
		if($this->db->update('mf_material_store_qty', $data, array('id' => $id))) {
			return true;
		}
		return false;
	}
    public function adjustStock($id, $data = array())
	{
		if($this->db->update('mf_material_store_qty', $data, array('id' => $id))) {
			return true;
		}
		return false;
	}

    public function adjustStockLog($data) {
        if ($this->db->insert('mf_material_adjust', $data)) {
            return true;
        }
        return false;
    }

	public function getStockLogList(){

        $this->db->select('mf_material_store_qty.id, mf_material.name as material_name, mf_brands.name as brand_name, stores.name as store_name, mf_material_adjust.adjust_qty, mf_material_adjust.adjust_type, mf_unit.name as unit_name'); 
        $this->db->from('mf_material_adjust');  
        $this->db->join('mf_material_store_qty','mf_material_store_qty.id=mf_material_adjust.material_stock_id');  
		$this->db->join('mf_material','mf_material_store_qty.material_id=mf_material.id');
		$this->db->join('stores','mf_material_store_qty.store_id=stores.id');
        $this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');
		$this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
		$this->db->order_by('mf_material_adjust.id','desc');
  
        $query = $this->db->get();
        return $query->result(); 
    }

 
}

