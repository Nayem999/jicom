<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_finish_good_stock_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

	public function getFinishStockList(){

        $this->db->select('mf_finished_good_stock.id, mf_finished_good_stock.quantity as qty, products.name as product_name'); 
        $this->db->from('mf_finished_good_stock');  
		$this->db->join('products','mf_finished_good_stock.product_id=products.id');
		$this->db->order_by('mf_finished_good_stock.id','desc');
  
        $query = $this->db->get();
        return $query->result(); 
    }

	public function getStockStoreById($id){

        $this->db->select('mf_finished_good_stock.id, mf_finished_good_stock.quantity, mf_finished_good_stock.product_id, products.name as product_name,mf_finished_good_stock.store_id'); 
        $this->db->from('mf_finished_good_stock');  
		$this->db->join('products','mf_finished_good_stock.product_id=products.id');
        $this->db->where('mf_finished_good_stock.id',$id);


        /* $this->db->select('mf_material_store_qty.id, mf_material.id as material_id, mf_material.name as material_name, mf_brands.name as brand_name, stores.name as store_name, mf_material_store_qty.quantity, mf_unit.name as unit_name '); 
        $this->db->from('mf_material_store_qty');  
		$this->db->join('mf_material','mf_material_store_qty.material_id=mf_material.id');
		$this->db->join('stores','mf_material_store_qty.store_id=stores.id');
        $this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');
		$this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
		$this->db->order_by('mf_material.name');
		$this->db->where('mf_material_store_qty.id',$id); */
  
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

    }

    public function adjustStoreStock($id, $data = array())
	{
		if($this->db->update('mf_finished_good_stock', $data, array('id' => $id))) {
			return true;
		}
		return false;
	}
    public function adjustStock($id, $data = array())
	{
		if($this->db->update('mf_finished_good_stock', $data, array('id' => $id))) {
			return true;
		}
		return false;
	}

    public function adjustStockLog($data) {
        if ($this->db->insert('mf_finished_good_stock_log', $data)) {
            return true;
        }
        return false;
    }

	public function getStockLogList(){

        $this->db->select('mf_finished_good_stock.id, mf_finished_good_stock_log.quantity, products.name as product_name, mf_finished_good_stock_log.note,mf_finished_good_stock_log.adjust_type'); 
        $this->db->from('mf_finished_good_stock');  
		$this->db->join('products','mf_finished_good_stock.product_id=products.id');
		$this->db->join('mf_finished_good_stock_log','mf_finished_good_stock_log.product_id=products.id and mf_finished_good_stock_log.store_id=mf_finished_good_stock.store_id');
        $this->db->where('mf_finished_good_stock_log.type','2');
        $this->db->order_by('mf_finished_good_stock_log.id','desc');

        $query = $this->db->get();
        // echo $this->db->last_query();die;
        return $query->result(); 
    }

 
}

