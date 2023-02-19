<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_recipe_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    }

    public function update_recipe($id, $data = NULL) {
        if ($this->db->update('mf_recipe', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteCategory($id) {
        if ($this->db->delete('mf_categories', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }

    public function get_all_recipe() {
        $this->db->from('mf_recipe');
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }

    public function get_recipe_by_id($id) {
        $q = $this->db->get_where('mf_recipe', array('id' => $id));
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

}
