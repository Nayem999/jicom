<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mf_report_model extends CI_Model
{


	public function __construct()
	{
		parent::__construct();

	}


	public static function calculateQty(){
		return 4545;
	}

	public static function getMaterialData($brand = null){
		$ci =& get_instance();
		$materialData =
            $ci->db->select('mf_material.name as name , mf_brands.name as brand_name, stores.name as store_name, mf_material_store_qty.quantity as qty, mf_material_store_qty.cost as cost,mf_unit.name as unit,mf_categories.name as cat_name ');
            $ci->db->from('mf_material_store_qty');
            $ci->db->join('mf_material', 'mf_material.id = mf_material_store_qty.material_id');
            $ci->db->join('mf_brands', 'mf_brands.id = mf_material_store_qty.brand_id');
            $ci->db->join('stores', 'stores.id = mf_material_store_qty.store_id');
            $ci->db->join('mf_unit', 'mf_unit.id = mf_material.uom_id','left');
            $ci->db->join('mf_categories', 'mf_categories.id = mf_material.category_id','left');
            if($brand):
                $ci->db->where('mf_material_store_qty.brand_id',$brand);
            endif;

			return $materialData->get()->result();
	}
	
}

