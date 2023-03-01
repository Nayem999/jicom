<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_production_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    }

    public function update_recipe($id, $data = NULL) {
        if ($this->db->update('mf_production_mst', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function get_all_recipe() {
        $this->db->from('mf_production_mst');
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }

    public function get_recipe_by_id($id) {
        $q = $this->db->get_where('mf_production_mst', array('id' => $id));
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        return FALSE;
    }

    public function get_max_id() {
        $this->db->select('max(id) as id');
        $q = $this->db->get('mf_production_mst');
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

    public function add_production($data, $items) {  

        if ($this->db->insert('mf_production_mst', $data)) {
            $production_id = $this->db->insert_id();
            foreach ($items as $item) {

                $item['production_id'] = $production_id;
                $this->db->insert('mf_production_dtls', $item);

            }
            return true;
        }
        return false;

    }

    public function getProductionByID($id) {

        $this->db->select('mf_production_mst.*, mf_production_mst.batch_no, mf_recipe_mst.name as recipe_name, products.name as products_name, mf_unit.name as uom_name ');
        $this->db->join('mf_recipe_mst','mf_production_mst.recipe_id=mf_recipe_mst.id');
        $this->db->join('products','mf_production_mst.product_id=products.id'); 
        $this->db->join('mf_unit','mf_production_mst.uom_id=mf_unit.id','left');
        $q = $this->db->get_where('mf_production_mst', array('mf_production_mst.id' => $id,'mf_production_mst.active_status'=>1), 1);

        if( $q->num_rows() > 0 ) {
            return $q->row();
        }

        return FALSE;

    }

    public function getProductionDtlsByID($id) {

        $this->db->select('mf_production_dtls.* , mf_material.name, mf_brands.name as brand_name, mf_unit.name as unit_name, mf_recipe_dtls.quantity as qty, mf_material_store_qty.quantity as stock_qty, mf_material_store_qty.cost as stock_cost');
        $this->db->join('mf_material','mf_production_dtls.material_id=mf_material.id');
        $this->db->join('mf_material_store_qty','mf_production_dtls.material_stock_id=mf_material_store_qty.id');
        $this->db->join('mf_recipe_dtls','mf_production_dtls.recipe_dtls_id=mf_recipe_dtls.id');
        $this->db->join('mf_brands','mf_material_store_qty.brand_id=mf_brands.id','left');
        $this->db->join('mf_unit','mf_material.uom_id=mf_unit.id','left');

        $q = $this->db->get_where('mf_production_dtls', array('mf_production_dtls.production_id' => $id,'mf_production_dtls.active_status'=>1));
        // echo 
        if( $q->num_rows() > 0 ) {
            foreach (($q->result()) as $row){  
                $data[] = $row;  
            }
            return $data;
        }

        return FALSE;

    }

    public function updateProduction($id, $data = NULL, $items = array()) {

        if ($this->db->update('mf_production_mst', $data, array('id' => $id)) && $this->db->update('mf_production_dtls', array('active_status'=>0), array('production_id' => $id))) {

            foreach ($items as $item) {
                $item['production_id'] = $id;
                $this->db->insert('mf_production_dtls', $item);
            }

            return true;

        }

        return false;

    }

    public function deleteProduction($id,$data,$data2) {

        if ($this->db->update('mf_production_mst', $data, array('id' => $id)) && $this->db->update('mf_production_dtls', $data2, array('production_id' => $id))) {
            return true;
        }
        return false;

    }

    public function updateStatusApprove($id,$dataAppr,$data,$info,$status) {
        $q = $this->db->get_where('mf_finished_good_stock', array('mf_finished_good_stock.product_id' => $info->product_id,'mf_finished_good_stock.store_id' => $info->store_id), 1);

        if( $q->num_rows() > 0 ) {
            $finished_good_stock = $q->row();
            if($status=='Approved')
            {
                $oldTPrice = $finished_good_stock->cost*$finished_good_stock->quantity;
                $newTPrice = $info->total_cost*$info->target_qty;
                $TotalPrice = $oldTPrice+$newTPrice;
                $TotalQty = $finished_good_stock->quantity+$info->target_qty;
                $coust_amount = $TotalPrice/$TotalQty;

                $this->db->update('mf_finished_good_stock',array('quantity' => $TotalQty,'cost' => $coust_amount), array('product_id' => $info->product_id));
            }
            else
            {
                $new_qty= $finished_good_stock->quantity-$info->target_qty;
                $oldTPrice = $finished_good_stock->cost*$finished_good_stock->quantity;
                $newTPrice = $info->total_cost*$info->target_qty;
                $TotalPrice = $oldTPrice-$newTPrice;
                $TotalQty = $finished_good_stock->quantity-$info->target_qty;
                $coust_amount = $TotalPrice/$TotalQty;

                $this->db->update('mf_finished_good_stock', array('quantity' => $new_qty,'cost' => $coust_amount), array('product_id' => $info->product_id));
            }
        }
        else
        {
            $finished_good_data=array(
                'store_id' => $info->store_id,
                'product_id' => $info->product_id,
                'quantity' => $info->target_qty,
                'cost' => $info->total_cost
            );
            $this->db->insert('mf_finished_good_stock',$finished_good_data );
        }

        if($this->db->update('mf_production_mst', $dataAppr, array('id' => $id)) && $this->db->insert('mf_finished_good_stock_log', $data)) {
            return true;
        }
        return false;	
    }


}
