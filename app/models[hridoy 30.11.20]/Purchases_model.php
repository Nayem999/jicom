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
	public function purchasesAmount($type, $id =NULL,$date=null,$store_id=NULL){		
		 $total = 0;
		 $this->db->select('purchases.*');
		 $this->db->from('purchases');
		 if( $id !=''){ $this->db->where('supplier_id', $id);}
		 if( $date !=''){ $data = $this->db->like('date', $date); }
		 if($store_id !=NULL){ $this->db->where('store_id',$store_id);}
		 if(!$this->Admin){
            $this->db->where('store_id', $this->session->userdata('store_id'));
         }
	     $query = $this->db->get(); 
		
		  $results = $query->result();
		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}
	public function advPayAmount($type, $id =NULL,$date=null,$store_id=NULL){
		 $total = 0;
		 if(!$this->Admin){
        	$this->db->where('store_id',$this->session->userdata('store_id'));
     	 }
     	 if($store_id !=NULL){$this->db->where('store_id',$store_id);}
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
	public function purcAmountByCustomer($type,$date=null,$store_id=NULL){
		if(!$this->Admin){
            $this->db->where('store_id', $this->session->userdata('store_id'));
         }
		 $total = 0;
		 $this->db->select('today_purchase_payment.*');
		 $this->db->from('today_purchase_payment');
		 if($store_id !=NULL){ $this->db->where('store_id',$store_id);}
		 if( $date !=''){ $data = $this->db->like('payment_date', $date); }
	     $query = $this->db->get(); 		
		  $results = $query->result();		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}

	public function expenAmountByCustomer($type,$date=null,$store_id=NULL){
		 $total = 0;
		 $this->db->select('expenses.*');
		 $this->db->from('expenses');
		 if( $date !=''){
		 $data = $this->db->like('date', $date);
		 }
		 if($store_id !=NULL){ $this->db->where('store_id',$store_id);}
		 if(!$this->Admin){
            $this->db->where('store_id', $this->session->userdata('store_id'));
         }
	     $query = $this->db->get(); 		
		  $results = $query->result();		  
		  foreach ($results as $result){
			 $total = $total + $result->$type ;
			}
		return $total ;
		
		}

	public function expenAmoByBetwDate($start,$end,$store_id=NULL){

		$total = 0;
		$this->db->select('expenses.*');
		$this->db->from('expenses');
		if(!$this->Admin){
        $this->db->where('store_id',$this->session->userdata('store_id'));
	    }else{
	        if($store_id){
	        	$this->db->where('store_id',$store_id); 
	        }
	        
	    }
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

        $purchases = $this->db->get_where('purchases', array('id' => $purchase_id)); 
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

    public function getProductStoreQtyByPidAndStoreId($store_id,$product_id){ 

        $this->db->where("product_id = '".$product_id."' AND store_id = ".$store_id);

        $q = $this->db->get('product_store_qty');

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {  

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

    public function addPurchase($data, $items,$sqeno) {  

        if ($this->db->insert('purchases', $data)) {

            $purchase_id = $this->db->insert_id();

            foreach ($sqeno as $key => $sqid) {	 
			$proID = $key;   
		    $rtrimdata = rtrim($sqid,",");
		    $psequence = explode(',',$rtrimdata); 
			    foreach ($psequence as $key => $sqvalue) {
			    	$sqdata = array(
						'purchases_id'=> $purchase_id,
						'sequence' => $sqvalue,
						'status' => 0,
						'pro_id' => $proID,
						'store_id' =>  $data['store_id'],
						'entry_date' =>date("Y-m-d H:i:s")
					);	
					if($sqid){
		    			$this->db->insert('pro_sequence', $sqdata);
		    		} 
			    }			
				 
			}

            foreach ($items as $item) {

                $item['purchase_id'] = $purchase_id;
                $item['store_id'] = $data['store_id'];

                if($this->db->insert('purchase_items', $item)) {
                // Product stock insert in tec_product_store_qty table
                $incstoreqty = $this->getProductStoreQtyByPidAndStoreId($data['store_id'],$item['product_id']);

                if($incstoreqty){
                    $upqtyinc = $incstoreqty->quantity + $item['quantity'];

                    $incdata = array(
                            'quantity' => $upqtyinc,
                        );
                    $this->upadteProductQtyById($incstoreqty->id, $incdata);

                } else { 

                    $insertdata = array(
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'store_id' => $data['store_id']
                    ); 

                    $this->db->insert('product_store_qty', $insertdata);
                } 

                // product quentity incriment in product table 

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
                $this->session->unset_userdata('squNo');

            }

            return true;

        }

        return false;

    }

    public function lastProSeque(){
    	$this->db->order_by('sequence_id','DESC');
    	$query = $this->db->get('pro_sequence',1); 
		 if ($query->num_rows() > 0) {
            return $query->row();
        } 
		return FALSE;
    }

    public function updatePurchase($id, $data = NULL, $items = array()) {

        $oitems = $this->getAllPurchaseItems($id); 

		$result = $this->getStoreId_purchases($id);
	    $store_id = $result->store_id ;

        foreach ($oitems as $oitem) {

            $product = $this->site->getProductByID($oitem->product_id); 
			
			if($product->quantity > 0){	
				$total_cost  =  $product->quantity * $product->cost ;
				$old_purches_cost  =  $oitem->subtotal ;
				$old_product_cost  =  $total_cost - $oitem->subtotal ;
				$old_purches_quantity  =  $oitem->quantity ;
				$product_quantity = $product->quantity ;
				$old_product_quantity =   $product_quantity - $old_purches_quantity ;
				$old_cost = $old_product_cost / $old_product_quantity ;	
				if($old_product_quantity <= 0){
					$old_cost = $product->cost;
				}
				if($old_cost <= 0){
					$old_cost = $oitem->cost;
				}
			}else{
				$old_cost = $product->cost;
			}	
			
            $this->db->update('products', array('cost' => $old_cost ,'quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));

        }

        $idem_pr = $this->db->get_where('purchase_items', array('purchase_id' => $id));

        $results = $idem_pr->result() ; 

        foreach ($results as $key => $result) {
          $this->storeProQtyDelete($result->product_id,$result->quantity,$store_id);
        }


        if ($this->db->update('purchases', $data, array('id' => $id)) &&
		 $this->db->delete('purchase_items', array('purchase_id' => $id))) {

            foreach ($items as $item) {

                $item['purchase_id'] = $id;

                $this->storeProQtyUpdate($item['product_id'],$item['quantity'],$store_id);

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

        $this->db->delete('pro_sequence', array('purchases_id' => $id)) ;

        foreach ($oitems as $oitem) {

        	$store_id = $oitem->store_id ;

        	$this->storeProQtyDelete($oitem->product_id,$oitem->quantity,$store_id);

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
	public function purchasesPaidAmountPay($store_id=NULL){ 
		
		$this->db->select('id');
		$this->db->from('purchases');
		if(!$this->Admin){
        $this->db->where('store_id',$this->session->userdata('store_id'));
     	}
		if($store_id !=NULL){$this->db->where('store_id',$store_id);}
        $query = $this->db->get();
     	$results = $query->result();
     	foreach ($results as $key => $result) {
     		$purID[] = $result->id;
     	}
		// And now your main query
		$this->db->select('SUM(amount) as totalpurpaid');
		$this->db->where_in("$purID");
		$this->db->where('paid_by', 'cash');
		if(!$this->Admin){
        $this->db->where('store_id',$this->session->userdata('store_id'));
     	}
     	if($store_id !=NULL){$this->db->where('store_id',$store_id);}
		$que =$this->db->get('purchase_payments'); 
     	$resu = $que->result(); 		  
		  foreach ($resu as $res){
			 $total= $res->totalpurpaid ;
			}	

		//print_r($purID);
     	return $total; 

	}
	public function expenTotal($date=null,$store_id=NULL){
		 $total = 0;
		 if(!$this->Admin){
	        $this->db->where('store_id',$this->session->userdata('store_id'));
	     }
	     if($store_id !=NULL){$this->db->where('store_id',$store_id);}
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
    	if(!$this->Admin){
    		$this->db->where('store_id',$this->session->userdata('store_id'));
    	}  	
        $this->db->from('suppliers');
        $query = $this->db->get();
     	$results = $query->result();     
        return $results ; 
    }

    public function getEexpenByFilter($start,$end,$category) {
    	if($this->session->userdata('store_id') !=0){
            $this->db->where('store_id', $this->session->userdata('store_id'));
         }
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
    public function SequenceCheck($sequence) {
    	$this->db->where_in('sequence', $sequence);
    	$q =  $this->db->get('pro_sequence');
        if( $q->num_rows() > 0 ) {
            return $q->row();
        }
        return FALSE;

    }

    public function SequenceCheckEdit($sequence ,$sequenceId ) {
    	$this->db->where_not_in('sequence_id', $sequenceId);
    	$this->db->where_in('sequence', $sequence);
    	$q =  $this->db->get('pro_sequence');
        if( $q->num_rows() > 0 ) {
            return $q->row();
        }
        return FALSE;

    }
    public function checkDBedit($sequence, $seqId = NULL) {
    	$this->db->where('sequence_id !=',  $seqId);
    	$this->db->where('sequence =', $sequence);
    	$q =  $this->db->get('pro_sequence');
        if( $q->num_rows() > 0 ) {
            return $q->result();
        }
        return FALSE;

    }
    public function checkedSequence($sequence){
    	$this->db->from('pro_sequence'); 
        $query = $this->db->get();        
        $results = $query->result();     
        return $results ;
    }  


    public function getLastSequence($purchases_id, $product_id){

       $this->db->where(array('purchases_id' => $purchases_id ,'pro_id' => $product_id))
        ->limit(1, 0)->order_by("sequence_id", "desc");
       $q = $this->db->get('pro_sequence');
        if ($q->num_rows() > 0) {
        	return $q->row('sequence');
        }
        return '';
    }
    public function getAllSequence($purchases_id, $product_id){
       $this->db->select('pro_sequence.sequence'); 
       $this->db->where(array('purchases_id' => $purchases_id ,'pro_id' => $product_id,'status'=>0));
       $q = $this->db->get('pro_sequence');
        if ($q->num_rows() > 0) {
        	$result =  $q->result();
        	//print_r($result ) ;
        	$sequence = '';
        	foreach ($result as $key => $value) {
        		//print_r($value->sequence);
        		
        		 $sequence .= $value->sequence.','; ;
        	}
        	 return $sequence =  $sequence ;
        	
        }

        return FALSE;
    }


    public function getAllSequenceS($purchases_id, $product_id){
       $this->db->select('pro_sequence.sequence, pro_sequence.sequence_id,pro_sequence.status'); 
       $this->db->where(array('purchases_id' => $purchases_id ,'pro_id' => $product_id));
       $q = $this->db->get('pro_sequence');
        if ($q->num_rows() > 0) {
        	$result =  $q->result();
        	
        	 return $result;
        	
        }

        return FALSE;
    }
	function deleteSequence($id,$item_id){
		 $this->db->delete('pro_sequence', array('purchases_id' => $id, 'pro_id' => $item_id ,'status' => 0));

	}  

	function AddSequence($id,$item_id,$sqno){
	$result = $this->getStoreId_purchases($id);
	$store_id = $result->store_id ;
	if($sqno !=''){
	$rtrimdata = rtrim($sqno,",");
	    $psequence = explode(',',$rtrimdata); 
		    foreach ($psequence as $key => $sqvalue) {
		    	$sqdata = array(
					'purchases_id'=> $id,
					'sequence' => $sqvalue,
					'status' => 0,
					'pro_id' => $item_id,
					'store_id' =>  $store_id,
					'entry_date' =>date("Y-m-d H:i:s")
				);					
				$this->db->insert('pro_sequence', $sqdata);
		    }
		 }
	}
	public function getStoreId_purchases($id){

       $this->db->select('purchases.store_id'); 
       $this->db->where(array('id' => $id));
       $q = $this->db->get('purchases');
        if ($q->num_rows() > 0) {
        	$result =  $q->row();
        	 return $result;	
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

