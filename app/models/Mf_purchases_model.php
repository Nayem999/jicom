<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mf_purchases_model extends CI_Model
{

    public function __construct() {

        parent::__construct();

    }

    public function getPurchaseByID($id) {

        $q = $this->db->get_where('mf_purchases', array('id' => $id), 1);

        if( $q->num_rows() > 0 ) {

            return $q->row();

        }

        return FALSE;

    }

	public function purchasesAmount($type, $id =NULL,$date=null,$store_id=NULL){		
		 $total = 0;
		 $this->db->select('mf_purchases.*');
		 $this->db->from('mf_purchases');
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

        $this->db->select('mf_purchase_material.*, mf_material.name as product_name')

            ->join('mf_material', 'mf_material.id=mf_purchase_material.material_id', 'left')

            ->group_by('mf_purchase_material.id')

            ->order_by('id', 'asc');

        $q = $this->db->get_where('mf_purchase_material', array('purchase_id' => $purchase_id));

        $purchases = $this->db->get_where('mf_purchases', array('id' => $purchase_id)); 
		$transport_cost=0;
        if($purchases->num_rows() > 0){
        	foreach ($purchases->result() as $purchasesVal)  
        	$store_id = $purchasesVal->store_id; 
        	$transport_cost = $purchasesVal->transport_cost; 
        }

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {  
                $row->store_id = $store_id; 
                $row->transport_cost = $transport_cost; 
                $data[] = $row;  
            }   

            return $data;


        }

        return FALSE;

    }

    public function getProductStoreQtyByPidAndStoreId($store_id,$material_id,$brand_id){ 

        $this->db->where("material_id = ".$material_id." AND store_id = ".$store_id." AND brand_id = ".$brand_id);

        $q= $this->db->get('mf_material_store_qty');

        if ($q->num_rows() > 0) {

            foreach (($q->result()) as $row) {  

                return $row;

            }

        }

    }

    public function upadteProductQtyById($id, $data = array()){ 

         if ($this->db->update('mf_material_store_qty', $data, array('id' => $id))) {

            return true;

        }

        return false;
    }

    public function addPurchase($data, $items) {  

        if ($this->db->insert('mf_purchases', $data)) {
            $purchase_id = $this->db->insert_id();
            foreach ($items as $item) {

                $item['purchase_id'] = $purchase_id;

                if($this->db->insert('mf_purchase_material', $item)) {
					// Product stock insert in tec_mf_material_store_qty table
					$incstoreqty = $this->getProductStoreQtyByPidAndStoreId($item['store_id'],$item['material_id'],$item['brand_id']);
					$new_cost = $item['cost'];
					$new_qty = $item['quantity'];

					if($incstoreqty){
						$oldTPrice = $incstoreqty->cost*$incstoreqty->quantity;
						$newTPrice = $new_cost*$new_qty;
						$TotalPrice = $oldTPrice+$newTPrice;
						$TotalQty = $incstoreqty->quantity+$new_qty;
						$coust_amount = $TotalPrice/$TotalQty;
						$incdata = array(
							'quantity' => $TotalQty,
							'cost' => $coust_amount,
						);
						$this->upadteProductQtyById($incstoreqty->id, $incdata);

					} else { 

						$insertdata = array(
							'material_id' => $item['material_id'],
							'brand_id' => $item['brand_id'],
							'store_id' => $item['store_id'],
							'quantity' => $new_qty,
							'cost' => $new_cost
						); 

						$this->db->insert('mf_material_store_qty', $insertdata);
						// echo $this->db->last_query();die;
					} 

					// material quentity incriment in material table 

                    $material = $this->site->wheres_rows('mf_material',array('id'=>$item['material_id']));
					$old_quantity = $material[0]->quantity;	

					if($old_quantity>0){
						$old_cost = $material[0]->cost;	
						$oldTPrice = $old_cost*$old_quantity;
						$newTPrice = $new_cost*$new_qty;
						$TotalPrice = $oldTPrice+$newTPrice;
						$TotalQty = $old_quantity+$new_qty;
						$coust_amount = $TotalPrice/$TotalQty;		
						$this->db->update('mf_material', array('cost' => $coust_amount, 'quantity' => ($material[0]->quantity+$item['quantity'])), array('id' => $material->id));				 
					}else{
						$this->db->update('mf_material', array('cost' => $new_cost, 'quantity' => ($item['quantity'])), array('id' => $material[0]->id));
					}						
					

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

            $product = $this->site->getMaterialByID($oitem->material_id); 
			
			if($product->quantity > 0){	

				$total_cost  =  $product->quantity * $product->cost ;
				$old_product_cost  =  $total_cost - $oitem->subtotal ;
				$old_product_quantity =   $product->quantity - $oitem->quantity ;
				
				if($old_product_cost==0 && $old_product_quantity==0)
				{
					$old_cost=0;
				}
				else
				{
					$old_cost = $old_product_cost / $old_product_quantity ;	
				}

				/* if($old_product_quantity <= 0){ $old_cost = $product->cost; }

				if($old_cost <= 0){ $old_cost = $oitem->cost; } */
			}else{
				$old_cost = $product->cost;
			}	
			
            $this->db->update('mf_material', array('cost' => $old_cost ,'quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));


			$incstoreqty = $this->getProductStoreQtyByPidAndStoreId($store_id,$oitem->material_id,$oitem->brand_id);

			if($incstoreqty){
				$stock_total_cost  =  $incstoreqty->quantity * $incstoreqty->cost ;
				$stock_old_product_cost  =  $stock_total_cost - $oitem->subtotal ;
				$stock_old_product_quantity =  $incstoreqty->quantity - $oitem->quantity ;

				if($stock_old_product_cost==0 && $stock_old_product_quantity==0)
				{
					$stock_old_cost=0;
				}
				else
				{
					$stock_old_cost = $stock_old_product_cost / $stock_old_product_quantity ;	
				}

				$incdata = array(
					'quantity' => $stock_old_product_quantity,
					'cost' => $stock_old_cost,
				);
				$this->upadteProductQtyById($incstoreqty->id, $incdata);

			}

        }


        if ($this->db->update('mf_purchases', $data, array('id' => $id)) && $this->db->delete('mf_purchase_material', array('purchase_id' => $id))) {

            foreach ($items as $item) {

                $item['purchase_id'] = $id;
                $item['store_id'] = $store_id;

                $this->storeProQtyUpdate($item['material_id'],$item['quantity'],$store_id, $item['brand_id'], $item['cost']);

                if($this->db->insert('mf_purchase_material', $item)) {

                    $product = $this->site->getMaterialByID($item['material_id']);
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
					
                    $this->db->update('mf_material', array('cost' => $coust_amount, 'quantity' => ($product->quantity+$item['quantity'])), array('id' => $product->id));
					
                }

            }

            return true;

        }

        return false;

    }

    public function deletePurchase($id) {

        $oitems = $this->getAllPurchaseItems($id);

        foreach ($oitems as $oitem) {

        	$store_id = $oitem->store_id ;

        	$this->storeProQtyDelete($oitem->material_id,$oitem->quantity,$store_id,$oitem->brand_id,$oitem->cost);

            $product = $this->site->getMaterialByID($oitem->material_id);

            $this->db->update('mf_material', array('quantity' => ($product->quantity-$oitem->quantity)), array('id' => $product->id));

        }




        if ($this->db->delete('mf_purchases', array('id' => $id)) && $this->db->delete('mf_purchase_material', array('purchase_id' => $id))) {

            return true;

        }

        return FALSE;

    }



    public function getProductNames($term, $limit = 10) {

        $this->db->where(" (name LIKE '%" . $term . "%' )");

        $this->db->limit($limit);

        $q = $this->db->get('mf_material');

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

		$q = $this->db->get_where('mf_purchases', array('id' => $id)); 

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
		
		 $q = $this->db->get_where('mf_suppliers', array('id' => $id), 1);

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
		$this->db->where_in($purID);
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

    public function checkDBedit($sequence, $seqId = NULL) {
    	$this->db->where('sequence_id !=',  $seqId);
    	$this->db->where('sequence =', $sequence);
    	$q =  $this->db->get('pro_sequence');
        if( $q->num_rows() > 0 ) {
            return $q->result();
        }
        return FALSE;
    }

	public function getStoreId_purchases($id){

       $this->db->select('mf_purchases.store_id'); 
       $this->db->where(array('id' => $id));
       $q = $this->db->get('mf_purchases');
        if ($q->num_rows() > 0) {
        	$result =  $q->row();
        	 return $result;	
        }

        return FALSE;
    }

    function storeProQtyDelete($item_id,$item_quantity,$store_id,$brand_id,$item_cost){

        $q = $this->db->get_where('mf_purchase_material', array('material_id' => $item_id , 'store_id' => $store_id, 'brand_id' => $brand_id ), 1);
        $value =  $q->row();
        /* $quantityOld = $value->quantity ;
        $dbQty  = $quantityOld - $item_quantity ;
        $data  = array('quantity' => $dbQty ); */


		$stock_total_cost  =  $value->quantity * $value->cost ;
		$stock_old_product_cost  =  $stock_total_cost - $item_cost ;
		$stock_old_product_quantity =  $value->quantity - $item_quantity ;

		if($stock_old_product_cost==0 && $stock_old_product_quantity==0)
		{
			$stock_old_cost=0;
		}
		else
		{
			$stock_old_cost = $stock_old_product_cost / $stock_old_product_quantity ;	
		}

		$data = array(
			'quantity' => $stock_old_product_quantity,
			'cost' => $stock_old_cost,
		);

        if($this->db->update('mf_purchase_material', $data, array('material_id' => $item_id,'store_id' => $store_id ))) {
            return true;
        }
        return false; 

 	}

 	function storeProQtyUpdate($item_id,$item_quantity,$store_id,$brand_id,$item_cost){
        $q = $this->db->get_where('mf_material_store_qty', array('material_id' => $item_id , 'store_id' => $store_id, 'brand_id' => $brand_id ), 1);
        if ($q->num_rows() > 0) {
	        $value =  $q->row();

			$oldTPrice = $value->cost*$value->quantity;
			$newTPrice = $item_cost*$item_quantity;
			$TotalPrice = $oldTPrice+$newTPrice;
			$TotalQty = $value->quantity+$item_quantity;
			$coust_amount = $TotalPrice/$TotalQty;

	        $data  = array('quantity' => $TotalQty,'cost' => $coust_amount );
	        if($this->db->update('mf_material_store_qty', $data, array('material_id'=>$item_id, 'store_id'=>$store_id, 'brand_id'=>$brand_id))){
	            return true;
	        }
	        return false; 
    	}else{

    		$sqdata = array(
				'product_id'=> $item_id,
				'store_id' => $store_id,
				'quantity' => $item_quantity,
				'brand_id' => $brand_id,
				'cost' => $item_cost
			);					
			$this->db->insert('mf_material_store_qty', $sqdata);
			   			
    	}
 	}

	
	
}

