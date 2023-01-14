<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    } 


    public function getTransfersByID($id) {

        $q = $this->db->get_where('transfers', array('id' => $id), 1);

        if( $q->num_rows() > 0 ) {

            return $q->row();

        }

        return FALSE;

    }

 
    public function getProductNames($term, $limit = 10) { 

        if(!$this->Admin){
                $store_id = $this->session->userdata('from_warehouse') ;
            }else{
                $store_id = $this->session->userdata('from_warehouse') ;
         }
  $this->db->where("(name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%') and pro_sequence.store_id=".$store_id." and pro_sequence.status=0");
        $this->db->join('pro_sequence', 'pro_sequence.pro_id = products.id');
        $this->db->group_by("pro_sequence.pro_id");
        $this->db->limit($limit);

        $q = $this->db->get('products');

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            }

            return $data;

        }

        return FALSE;

    }

    public function getProductStoreQtyByPidAndStoreId($store_id,$product_id){ 

        $this->db->where("product_id = '".$product_id."' AND store_id = ".$store_id);

        $q = $this->db->get('product_store_qty');

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) { 

                $data[] = $row;
                return $row;

            }

        }

    }

    public function upadteProductQtyById($id, $data = array()){ 

         if ($this->db->update('product_store_qty', $data, array('id' => $id))) {

            return true;

        }

        return false;
    }

    public function addtransfers($data, $items, $sequence,$towarehouse,$fromwarehouse) { 

        if ($this->db->insert('transfers', $data)) {



            $transfers_id = $this->db->insert_id();         

            foreach ($items as $item) {

                $item['transfers_id'] = $transfers_id;

                 $this->storeProQtyDelete($item['product_id'],$item['quentity'],$fromwarehouse);
                 $this->storeProQtyUpdate($item['product_id'],$item['quentity'],$towarehouse);

                if($this->db->insert('transfers_items', $item));

                
               

            }

           // $sequence 
         
          foreach ($sequence as $key => $seq) {

                $sequence  = $seq['sequence'] ;
                $rtrimdata = rtrim($sequence,",");
                $psequence = explode(',',$rtrimdata); 

                foreach ($psequence as $key => $idVal) {

                     $sqdata  = array(
                        'store_id' => $seq['store_id']
                      ); 
                     $this->db->update('pro_sequence', $sqdata, array('sequence' => $idVal ));      
                 }         
                 
            }

            $this->session->unset_userdata('from_warehouse');
          
            return true;

        }

        return false;

    } 


    public function UpdateTransfers($id,$data, $products,$sequence,$fromwarehouse,$towarehouse){

        if ($this->db->update('transfers', $data, array('id' => $id))){

             $idem_pr = $this->db->get_where('transfers_items', array('transfers_id' => $id));

                $results = $idem_pr->result() ; 

                foreach ($results as $key => $result) {
                  //print_r($result->);
                  $sequenceS =  $result->sequence;
                  $rtrimdata = rtrim($sequenceS,",");
                  $psequence = explode(',',$sequenceS); 
                  //$sqdata = array();
                  $this->storeProQtyDelete($result->product_id,$result->quentity,$towarehouse);
                  $this->storeProQtyUpdate($result->product_id,$result->quentity,$fromwarehouse);
                  foreach ($psequence as $key => $sequenceN) {
                    $sqdata  = array('store_id' => $fromwarehouse);
                    $this->db->update('pro_sequence', $sqdata, array('sequence' => $sequenceN)); 

                  }

            }

            $this->db->delete('transfers_items', array('transfers_id' => $id));
            foreach ($products as $product) {
                 $this->db->insert('transfers_items', $product); 
                 $this->storeProQtyDelete($product['product_id'],$product['quentity'],$fromwarehouse);
                 $this->storeProQtyUpdate($product['product_id'],$product['quentity'],$towarehouse);

            }
            foreach ($sequence as $key => $seq) {

                $sequence  = $seq['sequence'] ;
                $rtrimdata = rtrim($sequence,",");
                $psequence = explode(',',$rtrimdata); 
            
                $sqdata = array();
                foreach ($psequence as $key => $sqvalue) {
                     $sqdata  = array(
                        'pro_id' => $seq['pro_id'],
                        'store_id' => $seq['store_id'],
                        'status' => 0 , 
                        'entry_date' => date('Y-m-d H:i:s')
                      ); 
                     $this->db->update('pro_sequence', $sqdata, array('sequence' => $sqvalue));      
                 }         
                 
            }

            

    }

    }
   public function  Delete($id ,$to_warehouse_id , $from_warehouse_id){

         $idem_pr = $this->db->get_where('transfers_items', array('transfers_id' => $id));

                $results = $idem_pr->result() ; 

                foreach ($results as $key => $result) {
                  //print_r($result->);
                  $sequenceS =  $result->sequence;
                  $rtrimdata = rtrim($sequenceS,",");
                  $psequence = explode(',',$sequenceS); 
                  //$sqdata = array();
                  $this->storeProQtyDelete($result->product_id,$result->quentity,$to_warehouse_id);
                  $this->storeProQtyUpdate($result->product_id,$result->quentity,$from_warehouse_id);
                  foreach ($psequence as $key => $sequenceN) {
                    $sqdata  = array('store_id' => $from_warehouse_id);
                    $this->db->update('pro_sequence', $sqdata, array('sequence' => $sequenceN)); 

                  }

            }

            $this->db->delete('transfers_items', array('transfers_id' => $id));

            $this->db->delete('transfers', array('id' => $id));

    }

    public function getSroteByID($id){
       $q = $this->db->get_where('stores', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    public function getSequence($id,$store_id){
        $this->db->from('pro_sequence');
        if($id !=''){
            $this->db->where('pro_id', $id);
        }  
        if($store_id !=''){
            $this->db->where('store_id', $store_id);
        }        
        $query = $this->db->get();
        $results = $query->result();     
        return $results; 
    }

    public function getAllTransfersItems($transfers_id) { 

        $this->db->select('transfers_items.*, products.code as product_code, products.name as product_name')

            ->join('products', 'products.id=transfers_items.product_id', 'left')

            ->group_by('transfers_items.id')

            ->order_by('id', 'asc');

        $q = $this->db->get_where('transfers_items', array('transfers_id' => $transfers_id));

        $purchases = $this->db->get_where('transfers', array('id' => $transfers_id)); 
        if($purchases->num_rows() > 0){
            foreach ($purchases->result() as $storeid)  
            $store_id = $storeid->store_id; 
        }

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {  
                $row->store_id = $store_id; 
                $data[] = $row;  
            }   

            return $data;


        }

        return FALSE;

    }
        function storeProQtyDelete($item_id,$item_quantity,$store_id){

        $q = $this->db->get_where('product_store_qty', array('product_id' => $item_id , 'store_id' => $store_id ), 1);

        $value =  $q->row();

        $quantityOld = $value->quantity ;

        $dbQty  = $quantityOld - $item_quantity ;

        $data  = array('quantity' => $dbQty );

        if($this->db->update('product_store_qty', $data, array('product_id' => $item_id,'store_id' => $store_id ))) {
                return true;
         }
        return false; 

 }
 function storeProQtyUpdate($item_id,$item_quantity,$store_id){
        $q = $this->db->get_where('product_store_qty', array('product_id' => $item_id , 'store_id' => $store_id ), 1);
        if ($q->num_rows() > 0) {
            $value =  $q->row();
            $quantityOld = $value->quantity ;
            $dbQty  = $quantityOld + $item_quantity ;
            $data  = array('quantity' => $dbQty );
            if($this->db->update('product_store_qty', $data, array('product_id' => $item_id,'store_id' => $store_id ))) {
                    return true;
            }
            return false; 
        }else{

        $sqdata = array(
                        'product_id'=> $item_id,
                        'store_id' => $store_id,
                        'quantity' => $item_quantity
                    );                  
                    $this->db->insert('product_store_qty', $sqdata);
                        
        }

     }

}
