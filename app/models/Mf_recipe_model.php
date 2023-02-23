<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_recipe_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    }

    public function update_recipe($id, $data = NULL) {
        if ($this->db->update('mf_recipe_mst', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function get_all_recipe() {
        $this->db->from('mf_recipe_mst');
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }

    public function get_recipe_by_id($id) {
        $q = $this->db->get_where('mf_recipe_mst', array('id' => $id));
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        return FALSE;
    }

    public function get_max_id() {
        $this->db->select('max(id) as id');
        $q = $this->db->get('mf_recipe_mst');
            if ($q->num_rows() > 0) {
                $res= $q->result();
                return $res[0]->id;
            }
        return 0;
    }

    public function get_raw_material_info($term, $limit = 10) {

        $this->db->select(" mf_material.id as material_id, mf_material.name as name, mf_material_store_qty.id as material_stock_id, mf_brands.name as brand_name, mf_unit.name as unit_name");
        $this->db->from('mf_material');
        $this->db->join('mf_material_store_qty','mf_material_store_qty.material_id=mf_material.id');
        $this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
        $this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');

        $this->db->where(" (tec_mf_material.name LIKE '%" . $term . "%' )");

        $this->db->limit($limit);
        $q = $this->db->get();
        // echo $this->db->last_query();die;
        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            }

            return $data;

        }

        return FALSE;

    }

    public function add_recipe($data, $items) {  

        if ($this->db->insert('mf_recipe_mst', $data)) {
            $recipe_id = $this->db->insert_id();
            foreach ($items as $item) {

                $item['recipe_id'] = $recipe_id;
                $this->db->insert('mf_recipe_dtls', $item);

            }

            return true;

        }

        return false;

    }

    public function getRecipeByID($id) {

        $this->db->select('mf_recipe_mst.id, mf_recipe_mst.code as code, mf_recipe_mst.name as recipe_name, mf_recipe_mst.description , mf_recipe_mst.created_at as created_at, mf_unit.name as uom_name, products.name as products_name, products.id as product_id, mf_recipe_mst.uom_id ');
        $this->db->join('products','mf_recipe_mst.product_id=products.id');
        $this->db->join('mf_unit','mf_recipe_mst.uom_id=mf_unit.id','left');
        $q = $this->db->get_where('mf_recipe_mst', array('mf_recipe_mst.id' => $id,'mf_recipe_mst.active_status'=>1), 1);

        if( $q->num_rows() > 0 ) {
            return $q->row();
        }

        return FALSE;

    }

    public function getRecipeDtlsByID($id) {

        $this->db->select('mf_material.name, mf_brands.name as brand_name, mf_recipe_dtls.quantity as qty, mf_unit.name as unit_name, mf_recipe_dtls.material_id, mf_recipe_dtls.material_stock_id ');
        $this->db->join('mf_material','mf_recipe_dtls.material_id=mf_material.id');
        $this->db->join('mf_material_store_qty','mf_recipe_dtls.material_stock_id=mf_material_store_qty.id');
        $this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
        $this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');

        $q = $this->db->get_where('mf_recipe_dtls', array('mf_recipe_dtls.recipe_id' => $id,'mf_recipe_dtls.active_status'=>1));

        if( $q->num_rows() > 0 ) {
            foreach (($q->result()) as $row){  
                $data[] = $row;  
            }
            return $data;
        }

        return FALSE;

    }

    public function updateRecipe($id, $data = NULL, $items = array()) {

        if ($this->db->update('mf_recipe_mst', $data, array('id' => $id)) && $this->db->update('mf_recipe_dtls', array('active_status'=>0), array('recipe_id' => $id))) {

            foreach ($items as $item) {
                $item['recipe_id'] = $id;
                $this->db->insert('mf_recipe_dtls', $item);
            }

            return true;

        }

        return false;

    }

    public function deleteRecipe($id,$data,$data2) {

        if ($this->db->update('mf_recipe_mst', $data, array('id' => $id)) && $this->db->update('mf_recipe_dtls', $data2, array('recipe_id' => $id))) {
            return true;
        }
        return false;

    }

    
    public function get_Recipe_for_production($id) {

        $this->db->select('mf_recipe_mst.uom_id, mf_recipe_mst.product_id, mf_material.name, mf_brands.name as brand_name, mf_recipe_dtls.quantity as qty, mf_unit.name as unit_name, mf_recipe_dtls.material_id, mf_recipe_dtls.material_stock_id, mf_material_store_qty.quantity as stock_qty, mf_material_store_qty.id as material_stock_id, mf_recipe_dtls.id as recipe_dtls_id, mf_material_store_qty.cost as cost');
        $this->db->join('mf_recipe_mst','mf_recipe_dtls.recipe_id=mf_recipe_mst.id');
        $this->db->join('mf_material','mf_recipe_dtls.material_id=mf_material.id');
        $this->db->join('mf_material_store_qty','mf_recipe_dtls.material_stock_id=mf_material_store_qty.id');
        $this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
        $this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');

        $q = $this->db->get_where('mf_recipe_dtls', array('mf_recipe_dtls.recipe_id' => $id,'mf_recipe_dtls.active_status'=>1));

        if( $q->num_rows() > 0 ) {
            foreach (($q->result()) as $row){  
                $data[] = $row;  
            }
            return $data;
        }

        return FALSE;

    }

}
