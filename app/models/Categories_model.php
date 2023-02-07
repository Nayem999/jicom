<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model
{

    public function __construct() {
        parent::__construct();

    }

    public function addCategory($data) {
        if ($this->db->insert('categories', $data)) {
            return true;
        }
        return false;
    }

    public function add_categories($data = array()) {
        if ($this->db->insert_batch('categories', $data)) {
            return true;
        }
        return false;
    }

    public function updateCategory($id, $data = NULL) {
        if ($this->db->update('categories', $data, array('id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteCategory($id) {
        if ($this->db->delete('categories', array('id' => $id))) {
            return true;
        }
        return FALSE;
    }

    public function addExpCategory($data) {
        if ($this->db->insert('expens_category', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function getAllCategories() {
        $this->db->from('expens_category');
        $this->db->where('name !=', 'Partner');
        $this->db->where('name !=', "Sales Return");
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }

    public function getCategoryByID($id) {
        $q = $this->db->get_where('expens_category', array('cat_id' => $id));
            if ($q->num_rows() > 0) {
                return $q->result();
            }
        return FALSE;
    }

    public function updateExpCategory($id, $data = NULL) {
        if ($this->db->update('expens_category', $data, array('cat_id' => $id))) {
            return true;
        }
        return false;
    }

    public function deleteExpCategory($id) {
        if ($this->db->delete('expens_category', array('cat_id' => $id))) {
            return true;
        }
        return FALSE;
    }
    public function likeAsValue() {
        $catid = array();
        $q = $this->db->get('settings');
        if ($q->num_rows() > 0) {    
           $pcatid = $q->row()->p_count;
        $q = $this->db->query("SELECT * FROM tec_categories where parent_id =".$q->row()->p_count);
        $results = $q->result(); 

        if($results==Array ( )) { 
             
            $q = $this->db->query("SELECT * FROM tec_categories where id =".$pcatid); 
            $results = $q->result();
            
         }
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $crow) {
                $catid[] = $crow->id;
                $name[] = $crow->name;
            } 
        $this->db->select('products.id,SUM(quantity) as quantity,products.category_id'); 
        $this->db->where_in('category_id', $catid);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $prow) {
                $qty = $prow->quantity;
                }
            return $qty;
            } 
          }
        } 
        else return FALSE;
    }

    public function getCatByID($id) {
       $this->db->from('categories');
       $this->db->where('id',$id);
       $q = $this->db->get();
       if ($q->num_rows() > 0) {
       foreach (($q->result()) as $prow) {
               $name = $prow->name;
               $id = $prow->id;
               $parent_id = $prow->parent_id;
            }
            return $parent_id;  
        }
    }

   public function getIdByParen($id){ 
    $this->db->from('categories');
       $this->db->where('id',$id);
       $q = $this->db->get();
       $results = $q->result();     
        return $results ; 
    }
    public function getCategories($store_id=0) {

        $this->db->select(
            $this->db->dbprefix('categories').'.id,'.
            $this->db->dbprefix('categories').'.code,'.
            $this->db->dbprefix('categories').'.image,'.
            $this->db->dbprefix('categories').'.name,'.
            $this->db->dbprefix('categories').'.parent_id,SUM('. 
            $this->db->dbprefix('product_store_qty').'.quantity) as qty');       
        $this->db->from('categories');
        $this->db->join('products', 'products.category_id=categories.id');  
        $this->db->join('product_store_qty', 'products.id=product_store_qty.product_id');  
        $this->db->group_by('categories.id');
        $this->db->where('product_store_qty.quantity !=','0.00');
        if($store_id){ $this->db->where('product_store_qty.store_id',$store_id);}
        $query=$this->db->get();
        return $query->result(); 
    }
    function getSubcategories($cat_id) {
        $q = $this->db->get_where('categories', array('id' => $cat_id), 1); 

        if( $q->num_rows() > 0 ) {
            
            return $q->row();

        } 
    } 

    public function getProductByCatId($id){ 
        $this->db->where('category_id',$id);
        $this->db->where('quantity !=','0.00');
        $query=$this->db->get('products');
        if( $query->num_rows() > 0 ) {
         return  $query->result();
        }
        return FALSE; 
    }

}
