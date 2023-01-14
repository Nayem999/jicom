<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salesreturn_model extends CI_Model
{
	public function __construct() {

		parent::__construct();

	}
	public function getInvoice($data) {
		
        $this->db->where(" sales_type='sale' and (id LIKE '%" . $data . "%' or customer_name  LIKE '%" . $data . "%') ");

        $this->db->limit(10);

        $this->db->where('return_id',NULL);

        $q = $this->db->get('sales');

		if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $result[] = $row;

                  }
              return $result;

		}
	}
	public function getSaleItems($ids){
		
		
	   $this->db->select('sale_items.*, products.name as product_name, products.code as product_code, products.category_id , products.tax_method as tax_method')

        ->join('products', 'products.id=sale_items.product_id')
		
        ->order_by('sale_items.id');
		
		$this->db->where("sale_items.id IN (".$ids.")");
		
        $q = $this->db->get_where('sale_items');
		

        if($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            } 

            return $data;

        }

        return FALSE;
    }	
    public function getSaleInfo($id){
		 
		$q = $this->db->get_where('sales', array('id' => $id), 1); 
		
		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
		 
	}
	public function getAllExpCategories() {
        $this->db->from('expens_category'); 
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ; 
    }
    public function addExpCategory($data) {
        if ($this->db->insert('expens_category', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function addExpense($data = array()) {
        if ($this->db->insert('expenses', $data)) {
            return true;
        }
        return false;
    }
    public function getSequence($id){ 
      
        /*$this->db->from('pro_sequence');
        if($id !=''){
            $this->db->where('pro_id', $id);
        }  
        if($store_id !=''){
            $this->db->where('store_id', $store_id);
        } 
        if($type ==''){
            $this->db->where('status', 0);
        }        
        $query = $this->db->get();
        $results = $query->result();     
        return $results; */
    }

	public function addsalesreturn($data){ 
		
	   if($this->db->insert('salesreturn', $data)) {
	   	$return_id = $this->db->insert_id(); 	
	   		$saleData = array(
				'return_id' => $this->db->insert_id(),
			);
			$this->db->update('sales', $saleData, array('id' => $data['sale_id']));
			
			return $return_id; 			
		}
		
		return false;  

  	}
	public function addSreturnItems($data,$sequence) {   
		
	   if($this->db->insert('sreturn_items', $data)) { 	   	
	   		$lastReturnId = $this->db->insert_id();
	   		// sale_items table update
	   	    $saleData = array(
				'return_item_id' => $this->db->insert_id(),
			);
			$this->db->update('sale_items', $saleData, array('id' => $data['sale_item_id']));
			// pro_sequence table update
			$sequencArray = explode(",", $sequence); 
			foreach ($sequencArray as $key => $sequ) {
				$sqData = array(
					'sales_id' => 0,
					'status' => 0,
				);
				$this->db->update('pro_sequence', $sqData, array('sequence_id' => $sequ));
			} 
			// product_store_qty table select
			$queryStore = $this->db->get_where('product_store_qty', array('product_id' => $data['product_id'],'store_id'=>$data['store_id']));  

			if( $queryStore->num_rows() > 0 ) {	
				$proStockQty = $queryStore->row(); 
				$proData = array(
					'quantity' => $proStockQty->quantity+$data['return_qty'],
				);
				$this->db->update('product_store_qty', $proData, array('id' => $proStockQty->id));		 
			}			

			$products = $this->db->get_where('products', array('id' => $data['product_id']));
			if( $products->num_rows() > 0 ) {	
				$productQty = $products->row(); 
				$proDataqty = array(
					'quantity' => $productQty->quantity+$data['return_qty'],
				); 
				$this->db->update('products', $proDataqty, array('id' => $productQty->id));		 
			}
			

			
			return $lastReturnId;
			
		}
		
		return false;
    }

    public function getWhereDataByElement($table,$field1,$field2,$data1,$data2){
		        $q = $this->db->get_where($table, array($field1 => $data1,$field2 => $data2));
		        if( $q->num_rows() > 0 ) {
		         return  $q->result();
		        }
		        return FALSE; 
		    }
	
	
	public function getSaleItemsEdit($id){
		 
	  $this->db->select('sreturn_items.*, products.name as product_name, products.code as product_code, products.category_id , products.tax_method as tax_method')
	  
	 ->join('products', 'products.id=sreturn_items.product_id')	
	 
	 ->order_by('sreturn_items.sreturn_item_id');
		
	 $q = $this->db->get_where('sreturn_items', array('sreturn_id' => $id));		

        if($q->num_rows() > 0) {
			
             return  $q->result();

        }

        return FALSE;
    }	
	
	public function getSaleItemsSingel($id){		
		
	   $this->db->select('sale_items.*, products.name as product_name, products.code as product_code, products.category_id , products.tax_method as tax_method')

        ->join('products', 'products.id=sale_items.product_id')
		
        ->order_by('sale_items.id');
		
		$this->db->where("sale_items.id =".$id);
		
        $q = $this->db->get_where('sale_items');
		

        if($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            }

            return $data;

        }

        return FALSE;
    }
	
	
	
    public function ChechSaleSarvice($id){
	 
		$q = $this->db->get_where('sales', array('service_id' => $id), 1); 
		
		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
		 
	}
	
    public function AddSaleInfo($data,$id,$type){	
		if($type =='Add'){
			
			$this->db->insert('sales', $data) ;
			
		}if($type =='edit'){
			
			$this->db->update('sales', $data, array('service_id' => $id));
			
		 }
		
		return false;
	 }
	 
    public function listPayment($id) {
		  
		$query = $this->db->get_where('payments', array('service_id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
			return  $query->result(); //$q->rows();

		} 


		return FALSE;
		  
	 }
    
    public function addPayment($data){
	
		$this->db->insert('payments', $data) ;

	}
    public function getPaymentSingel($id){
	
		$query = $this->db->get_where('payments', array('id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
				return $query->row();

		} 

	}
    public function PaymentDelete($id){
	
		$this->db->delete('payments', array('id' => $id));

	}
	
	 public function  editPayment($data,$id){
	
	 	
		if($this->db->update('payments', $data, array('id' => $id))) {

			return true;

		}

		return false;

	 
	 
	 }
	
	
 public function getSeviceInfo($id){
		 
		$q = $this->db->get_where('salesreturn', array('sreturn_id' => $id), 1); 
		
		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
		 
	}
 public function getParts($id){
	 
	 
	  $this->db->select('service_parts.*, service.total as total, service.paid  as paid, service.customer_name  as customer_name, service.date_submit  as date_submit  ')
	  
	 ->join('service', 'service.service_id=service_parts.service_id')	
	 
	 ->order_by('service_parts.parts_id');
	 
		$q = $this->db->get_where('service_parts', array('service_parts.service_id' => $id)); 
		
		if( $q->num_rows() > 0 ) {
			
			 return  $q->result();

		} 

		return FALSE;
		 
	}
	 
   public function addservicePromlem($data)

	{
		
	   if($this->db->insert('service_promlem', $data)) {
			
			return $this->db->insert_id();
			
		}
		
		return false;

  } 
  
  public function servicePartsSingel($id){
	  
	 $q = $this->db->get_where('service_parts', array('parts_id' => $id), 1); 
	  if( $q->num_rows() > 0 ) {
			
		return $q->row();

	 } 

	return FALSE;

  }
  
   public function  editservicePromlem($data,$id){
	
	 	
		if($this->db->update('service_promlem', $data, array('problem_id' => $id))) {

			return true;

		}

		return false;

	 
	 
	 }
	 
  public function  editservice($data,$id){
	
	 	
		if($this->db->update('service', $data, array('service_id' => $id))) {

			return true;

		}

		return false;

	 }
	 
	 public function  editserviceParts($data,$id){
	
	 	
		if($this->db->update('service_parts', $data, array('parts_id' => $id))) {

			return true;

		}

		return false;

	 
	 
	 }
	 
	public function deleteInvoice($id) {

		if($this->db->delete('salesreturn', array('sreturn_id' => $id))) {
			
			$this->db->delete('sreturn_items', array('sreturn_id' => $id));

			//$this->db->delete('expenses', array('sale_return_id' => $id));
			
			return true;

		}

		return FALSE;

	}
	
	public function deleteParts($id) {
		
			$this->db->delete('service_parts', array('parts_id' => $id));
			return true;

	}

	 public function upadteSequence($sequence, $data = array()){ 

         if ($this->db->update('pro_sequence', $data, array('sequence_id' => $sequence))) {
            return true;
        }

        return false;
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

   public function ProQtyUpdate($id,$data) {

        $this->db->where('id', $id);
      if( $this->db->update('products', $data)){
            return true;
        }
        return FALSE;
	}

   public function SelsItemUpdate($id,$data) {

        $this->db->where('id', $id);
      if( $this->db->update('sale_items', $data)){
            return true;
        }
        return FALSE;
	}
   public function SelsUpdate($id,$data) { 
        $this->db->where('id', $id);
      if( $this->db->update('sales', $data)){

            return true;
        }
        return FALSE;
	}
	

  
}


