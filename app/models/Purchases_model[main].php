<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Purchases_model extends CI_Model
{

    public function __construct() {

        parent::__construct();

    }

    public function getPurchaseByID($id) {

        $q = $this->db->get_where('purchases', array('id' => $id), 1);

        if( $q->num_rows() > 0 ) {

            return $q->row();

        }

        return FALSE;

    }
	public function purchasesAmount($type, $id =NULL,$date=null){
		 $total = 0;
		 $this->db->select('purchases.*');
		 $this->db->from('purchases');
		 if( $id !=''){
		 	$this->db->where('supplier_id', $id);
		 }

		  if( $date !=''){
		 $data = $this->db->like('date', $date);
		 }
	     $query = $this->db->get(); 
		
		  $results = $query->result();
		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}
	public function advPayAmount($type, $id =NULL,$date=null){
		 $total = 0;
		 $this->db->select('adv_payment.*');
		 $this->db->from('adv_payment');
		 if( $id !=''){
		 	$this->db->where('suppliers_id', $id);
		 }

		 if( $date !=''){
		 $data = $this->db->like('add_date', $date);
		 }
	     $query = $this->db->get(); 
		
		  $results = $query->result();
		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}
	public function purcAmountByCustomer($type,$date=null){
		 $total = 0;
		 $this->db->select('today_purchase_payment.*');
		 $this->db->from('today_purchase_payment');
		 if( $date !=''){
		 $data = $this->db->like('payment_date', $date);
		 }
	     $query = $this->db->get(); 		
		  $results = $query->result();		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}

	public function expenAmountByCustomer($type,$date=null){
		 $total = 0;
		 $this->db->select('expenses.*');
		 $this->db->from('expenses');
		 if( $date !=''){
		 $data = $this->db->like('date', $date);
		 }
	     $query = $this->db->get(); 		
		  $results = $query->result();		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}

	public function expenAmoByBetwDate($start,$end){

		 $total = 0;
		 $this->db->select('expenses.*');
		 $this->db->from('expenses');
		 if($start && $end) {
            $this->db->where('date >=', $start);
            $this->db->where('date <=', $end);
        } else if($start !='') {
        	$this->db->like('date', $start);
        }
	     $query = $this->db->get(); 		
		  $results = $query->result();		  
		  foreach ($results as $result){
			 $total = $total + $result->amount ;
			}
		return $total ;
		
		}
    public function getAllPurchaseItems($purchase_id) {

        $this->db->select('purchase_items.*, products.code as product_code, products.name as product_name')

            ->join('products', 'products.id=purchase_items.product_id', 'left')

            ->group_by('purchase_items.id')

            ->order_by('id', 'asc');

        $q = $this->db->get_where('purchase_items', array('purchase_id' => $purchase_id));

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {

                $data[] = $row;

            }

            return $data;

        }

        return FALSE;

    }

    public function addPurchase($data, $items) {
    
        if ($this->db->insert('purchases', $data)) {

            $purchase_id = $this->db->insert_id();

            foreach ($items as $item) {

                $item['purchase_id'] = $purchase_id;

                if($this->db->insert('purchase_items', $item)) {

                    $product = $this->site->getProductByID($item['product_id']);
					
					$old_cost = $product->cost;					
					$old_quantity = $product->quantity;	

					$new_cost = $item['cost'];
					$new_qty = $item['quantity'];

					if($old_quantity>0){
						$oldTPrice = $old_cost*$old_quantity;
						$newTPrice = $new_cost*$new_qty;
						$TotalPrice = $oldTPrice+$newTPrice;
						$TotalQty = $old_quantity+$new_qty;
						$coust_amount = $TotalPrice/$TotalQty;
					}else{
						$coust_amount = $new_cost;
					}					
					
                    $this->db->update('products', array('cost' => $coust_amount, 'quantity' => ($product->quantity+$item['quantity'])), array('id' => $product->id));

                }

            }

            return true;

        }

        return false;

    }

    public function updatePurchase($id, $data = NULL, $items = array()) {

        $oitems = $this->getAllPurchaseItems($id);
		
		//print_r($oitems);
		
		//exit;

        foreach ($oitems as $oitem) {

            $product = $this->site->getProductByID($oitem->product_id);
			
		//	print_r($product);
			
			// total price 
			
			 $total_cost  =  $product->quantity * $product->cost ;
			
			 $old_purches_cost  =  $oitem->subtotal ;
			 
			 $old_product_cost  =  $total_cost - $oitem->subtotal ;
			
			 $old_purches_quantity  =  $oitem->quantity ;
			 
			 $product_quantity = $product->quantity ;
			 
			 $old_product_quantity =   $product_quantity -  $old_purches_quantity ;
			 
		     $old_cost =  $old_product_cost / $old_product_quantity ;
			
             $this->db->update('products', array('cost' => $old_cost ,'quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));

        }

        if ($this->db->update('purchases', $data, array('id' => $id)) &&
		 $this->db->delete('purchase_items', array('purchase_id' => $id))) {

            foreach ($items as $item) {

                $item['purchase_id'] = $id;

                if($this->db->insert('purchase_items', $item)) {

                    $product = $this->site->getProductByID($item['product_id']);
					
					$old_cost = $product->cost;
					
					$old_quantity = $product->quantity;
					
					$coust_amount = (($old_cost * $old_quantity) + ($item['cost'] * $item['quantity']))/($old_quantity + $item['quantity'] ) ;
					
                    $this->db->update('products', array('cost' => $coust_amount, 'quantity' => ($product->quantity+$item['quantity'])), array('id' => $product->id));
					
					//'cost' => $coust_amount, 
                   // $this->db->update('products', array('cost' => $coust_amount,'quantity' => ($product->quantity+$item['quantity'])),
					//array('id' => $product->id));

                }

            }

            return true;

        }

        return false;

    }

    public function deletePurchase($id) {

        $oitems = $this->getAllPurchaseItems($id);

        foreach ($oitems as $oitem) {

            $product = $this->site->getProductByID($oitem->product_id);

            $this->db->update('products', array('quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));

        }

        if ($this->db->delete('purchases', array('id' => $id)) && $this->db->delete('purchase_items', array('purchase_id' => $id))) {

            return true;

        }

        return FALSE;

    }



    public function getProductNames($term, $limit = 10) {

        $this->db->where("type != 'combo' AND (name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%')");

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

    public function getExpenseByID($id) {

        $q = $this->db->get_where('expenses', array('id' => $id), 1);

        if ($q->num_rows() > 0) {

            return $q->row();

        }

        return FALSE;

    }

    public function addExpense($data = array()) {

        if ($this->db->insert('expenses', $data)) {

            return true;

        }

        return false;

    }

    public function updateExpense($id, $data = array()) {

        if ($this->db->update('expenses', $data, array('id' => $id))) {

            return true;

        }

        return false;

    }

    public function deleteExpense($id) {

        if ($this->db->delete('expenses', array('id' => $id))) {

            return true;

        }

        return FALSE;

    }
	
    public function deletePayment($id) {

	    if ($this->db->delete('purchase_payments', array('p_pay_id' => $id))) {

	        return true;

	    }

	    return FALSE;

    }
	
	
	public function getParchasePay($id) {
	

		$q = $this->db->get_where('purchase_payments', array('purchases_id' => $id)); 
	
        $query = $this->db->get_where('purchase_payments', array('purchases_id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
			return  $query->result(); //$q->rows();

		} 

		return FALSE;

	}
	
 	public function getParchaseInfo($id) {

		$q = $this->db->get_where('purchases', array('id' => $id)); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}
	
	 
	public function getParInfo($id) {
		  
		$query = $this->db->get_where('purchase_payments', array('purchases_id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
			return  $query->result(); //$q->rows();

		} 
		return FALSE;
		  
	 }
	
    public function addPayment($data) {
		if ($this->db->insert('purchase_payments', $data)) {

			return true;
		}

		return false;

    }
	
	public function editPayment($data,$id){

		 if ($this->db->update('purchase_payments', $data, array('p_pay_id' => $id))) {

            return true;

        	}

        	return false;

	}
	
	 public function getPaymentSingel($id) {
			$q = $this->db->get_where('purchase_payments', array('p_pay_id' => $id)); 

			if( $q->num_rows() > 0 ) {
				
				return $q->row();

			} 

			return FALSE;

	 }
	
	public function updateAmount($data,$id){

		 if ($this->db->update('purchases', $data, array('id' => $id))) {

            return true;

        }

        return false;
		
	}
	
	public function getSupplierInfo($id){
		
		 $q = $this->db->get_where('suppliers', array('id' => $id), 1);

        if( $q->num_rows() > 0 ) {

            return $q->row();

        }

        return FALSE;
		
		
	}
 	public function get_purchase_items_Info($product_id){
	 
	    $q = $this->db->get_where('products', array('id' => $product_id)); 		

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;
	 
	 
	 }
    public function getSupplierByID($id) {

        $q = $this->db->get_where('purchases', array('supplier_id' => $id));

        if( $q->num_rows() > 0 ) {

            return $q->result();
        }
        return FALSE;

    }

    public function getSupplierDeu($id) {

     	$q = $this->db->get_where('purchases', array('supplier_id' => $id));

        if( $q->num_rows() > 0 ) {
            return $q->result();
        }
        return FALSE;
    }
 	public function UpdateSupplierDeu($data,$id){

		 if ($this->db->update('purchases', $data, array('id' => $id))) {
            return true;
        }
        return false;		
	}

	public function payPayment($data){		 
	$this->db->insert('today_purchase_payment', $data);

	return $this->db->insert_id();
	
	}
  public function getAllpaymentID($id){     
    $q = $this->db->get_where('purchase_payments', array('todayP_Payment' => $id));
    if( $q->num_rows() > 0 ) {
     return  $q->result();
    }
    return FALSE; 
  }
	
public function deletePaymentForPurchase($id) {

        if ($this->db->delete('purchase_payments', array('todayP_Payment' => $id))) {

            return true;
        }
        return FALSE;
    }
 	public function deleteTodayPurPay($id)  {
         
        if ($this->db->delete('today_purchase_payment', array('today_payment_id' => $id))) {
             
            return true;
        }
        return FALSE;
    }

    public function deleteAdvSupPay($id)  {
         
        if ($this->db->delete('adv_payment', array('today_payment_id' => $id))) {
             
            return true;
        }
        return FALSE;
    }
    public function purchasesPaidAmount($id =NULL,$date=null){
		 $total = 0;
		 $this->db->select('SUM(paid) as totalpurpaid');
		 $this->db->from('purchases');
		 if( $id !=''){
		 	$this->db->where('id', $id);
		 }

		  if( $date !=''){
		 $data = $this->db->like('date', $date);
		 }
	     $query = $this->db->get(); 
		
		  $results = $query->result();
		  
		  foreach ($results as $result){
			 $total = $result->totalpurpaid ;
			}
		return $total ;		
		}
	public function purchasesPaidAmountPay(){ 
		$this->db->select('id');
		$this->db->from('purchases');
        $query = $this->db->get();
     	$results = $query->result();
     	foreach ($results as $key => $result) {
     		$purID[] = $result->id;
     	}
		// And now your main query
		$this->db->select('SUM(amount) as totalpurpaid');
		$this->db->where_in("$purID");
		$this->db->where('paid_by', 'cash');
		$que =$this->db->get('purchase_payments'); 
     	$resu = $que->result(); 		  
		  foreach ($resu as $res){
			 $total= $res->totalpurpaid ;
			}	

		//print_r($purID);
     	return $total; 

	}
	public function expenTotal($date=null){
		 $total = 0;
		 $this->db->select('SUM(amount) as totalexpense');
		 $this->db->from('expenses');
		 if( $date !=''){
		 $data = $this->db->like('date', $date);
		 }
	     $query = $this->db->get(); 		
		  $results = $query->result();		  
		  foreach ($results as $result){
			 $total = $result->totalexpense ;
			}
		return $total ;		
		} 
    public function acPayable($id=NULL) {  

     $this->db->select('purchases.* , (total - paid ) as due');
     $this->db->from('purchases');
     $this->db->where('total > paid');
     if($id){
         $this->db->where('supplier_id', $id);          
     }     
     $query = $this->db->get();
     $results = $query->result();     
        return $results ; 
    }
    public function acPayableAd($id=NULL) {
     $this->db->select('adv_payment.* , SUM(adv_amount) as adv_amount');
     $this->db->from('adv_payment'); 
     $this->db->where('suppliers_id', $id);       
     $query = $this->db->get();
     $results = $query->result();     
        return $results ; 
    }

    public function acRecvleAd($id=NULL) {
     $this->db->select('adv_collection.* , SUM(adv_collection) as adv_collec');
     $this->db->from('adv_collection'); 
     $this->db->where('customer_id', $id);       
     $query = $this->db->get();
     $results = $query->result();     
        return $results ; 
    }

    public function getSuppByID($id) { 
        $this->db->from('suppliers');
        $this->db->where('id', $id);
        $query = $this->db->get();
     	$results = $query->result();     
        return $results ;     

    }
    public function getAllSupper() {     	
        $this->db->from('suppliers');
        $query = $this->db->get();
     	$results = $query->result();     
        return $results ; 
    }

    public function getEexpenByFilter($start,$end,$category) {
     $this->db->select('*');
     $this->db->from('expenses');
     if($start) {
     	$this->db->where('date >=', $start);
     }
     if($end) {
     	$this->db->where('date <=', $end);
     }
     
     if($category){
         $this->db->where('c_id', $category);          
     }     
     $query = $this->db->get();
     $results = $query->result();     
        return $results ; 
    }
    public function addAdvPayment($data) {
		if ($this->db->insert('adv_payment', $data)) {

			return true;
		}

		return false;

    }

}

