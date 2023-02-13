<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends CI_Model
{
	
	public function __construct() {
		parent::__construct();

	}

	public function getSaleByID($id)
    {
        $q = $this->db->get_where('sales', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getSaleItemsBySaleId($id) {
       $q = $this->db->get_where('sale_items', array('sale_id' => $id));
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;  
    }
    public function getProductById($id){
       $q = $this->db->get_where('products', array('id' => $id));
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;   
    }
    public function ProQtyUpdate($id,$data) {

        $this->db->where('id', $id);
      if( $this->db->update('products', $data)){
            return true;
        }
        return FALSE;
        

    }
	
	public function deleteInvoice($id) {
		if($this->db->delete('sale_items', array('sale_id' => $id)) && $this->db->delete('sales', array('id' => $id))) {
			return true;
		}
		return FALSE;
	}

	public function deleteOpenedSale($id) {
		if($this->db->delete('suspended_items', array('suspend_id' => $id)) && $this->db->delete('suspended_sales', array('id' => $id))) {
			return true;
		}
		return FALSE;
	}
	
	public function getSalePayments($sale_id)
    {
        $this->db->order_by('id', 'asc');
        $q = $this->db->get_where('payments', array('sale_id' => $sale_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getPaymentByID($id)
    {
        $q = $this->db->get_where('payments', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function addPayment($data = array()) {
        if ($this->db->insert('payments', $data)) {
            if ($data['paid_by'] == 'gift_card') {
                $gc = $this->site->getGiftCardByNO($data['gc_no']);
                $this->db->update('gift_cards', array('balance' => ($gc->balance - $data['amount'])), array('card_no' => $data['gc_no']));
            }
            $this->syncSalePayments($data['sale_id']);
            return true;
        }
        return false;
    }
  public function editNote($data = array() , $id )
    {
      if ($this->db->update('tec_sales', $data, array('id' => $id))) {
         $this->db->update('payments', $data, array('sale_id' => $id));
            return true;
        }

        return false;
    }
    public function updatePayment($id, $data = array())
    {
        if ($this->db->update('payments', $data, array('id' => $id))) {
            $this->syncSalePayments($data['sale_id']);
            return true;
        }
        return false;
    }

    public function deletePayment($id)
    {
        $opay = $this->getPaymentByID($id);
        if ($this->db->delete('payments', array('id' => $id))) {
            $this->syncSalePayments($opay->sale_id);
            return true;
        }
        return FALSE;
    }

    public function syncSalePayments($id) {
        $sale = $this->getSaleByID($id);
        $payments = $this->getSalePayments($id);
        $paid = 0;
        if($payments) {
        	foreach ($payments as $payment) {
        		$paid += $payment->amount;
        	}
        }
        $status = $paid <= 0 ? 'due' : $sale->status;
	    if ($this->tec->formatDecimal($sale->grand_total) > $this->tec->formatDecimal($paid) && $paid > 0) {
            $status = 'partial';
        } elseif ($this->tec->formatDecimal($sale->grand_total) <= $this->tec->formatDecimal($paid)) {
            $status = 'paid';
        }

        if ($this->db->update('sales', array('paid' => $paid, 'status' => $status), array('id' => $id))) {
            return true;
        }

        return FALSE;
    }


    public function salesAmount($type,$id =NULL,$date=null,$store_id=NULL){
         $total = 0;
         $this->db->select('sales.*');
         $this->db->from('sales');
         if(!$this->Admin){
            $this->db->where('store_id', $this->session->userdata('store_id'));
         }
         if($store_id !=NULL){
            $this->db->where('store_id', $store_id);
         }
         $this->db->where('sales_type','sale');         
         if( $id !=''){
            $this->db->where('created_by', $id);
            
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
  public function salesDeu($id =NULL,$date=null){
        $total = 0;
        if(!$this->Admin){ 
           $storeid = $this->session->userdata('store_id');
            if($date !=null){
            if($id !=null){
                $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where date like '%$date%' and sales_type ='sale' and created_by=$id and store_id=$storeid" );
            } else {
                $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where date like '%$date%' and sales_type ='sale' and store_id=$storeid");
            }
            
         } else {
            if($id !=null){
              $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales  where created_by=$id and sales_type ='sale' and store_id=$storeid");  
            }else {
            $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where sales_type ='sale' and store_id=$storeid ");
          }
         }  
        } else {
            if($date !=null){
            if($id !=null){
                $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where date like '%$date%' and sales_type ='sale' and created_by=$id" );
            } else {
                $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where date like '%$date%' and sales_type ='sale'");
            }
            
         } else {
            if($id !=null){
              $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales  where created_by=$id and sales_type ='sale'");  
            }else {
            $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where sales_type ='sale' ");
          }
         }  
        }


         $results = $query->result();
          
          foreach ($results as $result){
             $total = $total + $result->deu ;
             
            }

            if($results < 0){
                 $total = 0;
             }
        return $total ;
        
        }

    public function salesAmountByCustomer($type,$id =NULL,$date=null){
         if($this->session->userdata('store_id') !=0){
            $this->db->where('store_id', $this->session->userdata('store_id'));
         }
         $total = 0;
         $this->db->select('sales.*');
         $this->db->from('sales');
         $this->db->where('sales_type','sale');
         if( $id !=''){
            $this->db->where('customer_id', $id);
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
    public function advCollecAmount($type, $id =NULL,$date=null){
         $total = 0;
         $this->db->select('adv_collection.*');
         $this->db->from('adv_collection');
         if( $id !=''){
            $this->db->where('customer_id', $id);
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
    public function collectAmountByCustomer($type,$id =NULL,$date=null,$store_id=NULL){
        if(!$this->Admin){
            $this->db->where('store_id', $this->session->userdata('store_id'));
        }
        if($store_id !=NULL){
            $this->db->where('store_id', $store_id);
         }
        $total = 0;
        $this->db->select('today_collection.*');
        $this->db->from('today_collection');
        if( $id !=''){
            $this->db->where('customer_id', $id);
        }

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
  public function allSalesDeu(){       
       
        $query  = $this->db->query(" SELECT (grand_total - paid) as deu FROM tec_sales where sales_type ='sale' ");
    
        $results = $query->result();
          
          foreach ($results as $result){
             $total = $total + $result->deu ;             
            }
            if($results < 0){
                 $total = '0';
             }
        return $total ;
        
        }
  public function salesDeuByCustomer($id =NULL,$date=null,$store_id=NULL){         
        $this->db->select('(grand_total - paid) as deu');
        $this->db->from('sales'); 
        $this->db->where('sales_type','sale');
        if($id !=null){$this->db->where('customer_id',$id);}
        if($date !=null){$this->db->like('date',$date);}
        if($store_id !=NULL){$this->db->where('store_id',$store_id);}
        if(!$this->Admin){$this->db->where('store_id',$this->session->userdata('store_id'));}
        $query = $this->db->get();
        $results = $query->result();  
        $total=0;        
          foreach ($results as $result){
             $total = $total + $result->deu ;             
            }
            if($results < 0){
                 $total = 0;
             }
        return $total ;
        
        }

  public function getAllCustomers($id){ 
  if($this->session->userdata('store_id') !=0){
            $this->db->where('store_id', $this->session->userdata('store_id'));
            }    
    $q = $this->db->get_where('customers', array('id' => $id));
    if( $q->num_rows() > 0 ) {
      return $q->row();
    }
    return FALSE; 
  }
    public function getCustomerDeu($id) {
       $this->db->select('id,paid,grand_total,(grand_total - paid ) as deu ');
       $this->db->from('sales');
       $this->db->where('customer_id', $id);
       $this->db->where('(grand_total - paid) !=', '0.00');  
       $q =$this->db->get();
        if( $q->num_rows() > 0 ) {
            return $q->result();
        }
        return FALSE;
    }

    public function getCustomerGrandTotal($id) {
       $this->db->select('sum(grand_total) as grand_total');
       $this->db->from('sales');
       $this->db->where('customer_id', $id);
       $q =$this->db->get();
        if( $q->num_rows() > 0 ) {
            return $q->result();
        }
        return FALSE;
    }

    public function getCustomerAmountWithBankApproved($id) {
       $this->db->select("sum(if(paid_by='Cheque' && type='Approved',payments.amount,0)) as chk_amount, sum(if(paid_by='TT' || paid_by='cash', payments.amount,0)) as other_amount ");
       $this->db->from('payments');
       $this->db->join('bank_pending',"payments.collect_id=bank_pending.collection_id and bank_pending.customer_id=$id",'left');
       $this->db->where('payments.customer_id', $id);
       $q =$this->db->get();
       
        if( $q->num_rows() > 0 ) {
            return $q->result();
        }
        return FALSE;
    }
    
  public function UpdateCustomerDeu($data,$id){
   
    $this->db->where('id', $id);
    $this->db->update('sales', $data); 
     return true;   
  }

  public function payPayment($data){

  $this->db->insert('today_collection', $data);

  return $this->db->insert_id();

  }
  public function getAllsalesID($id){     
    $q = $this->db->get_where('payments', array('collect_id' => $id));
    if( $q->num_rows() > 0 ) {
     return  $q->result();
    }
    return FALSE; 
  }

 public function deletePaymentForCollect($id) {

        if ($this->db->delete('payments', array('collect_id' => $id))) {

            return true;
        }
        return FALSE;
    }
  public function deleteCollect($id)  {
         
        if ($this->db->delete('today_collection', array('today_collect_id' => $id))) {
             
            return true;
        }
        return FALSE;
    }

public function deleteAdvCusPay($id)  {
         
        if ($this->db->delete('adv_collection', array('today_collect_id' => $id))) {
             
            return true;
        }
        return FALSE;
    }

public function salesGtotalAmount($id =NULL,$date=null){
     $total = 0;
     $this->db->select('SUM(grand_total) as totalpaid');
     $this->db->from('sales');
     
     if( $id !=''){
        $this->db->where('id', $id);            
     }
     if( $date !=''){
        $data = $this->db->like('date', $date);
     }
     $query = $this->db->get();
     $results = $query->result();
      foreach ($results as $result){
         $total = $result->totalpaid ;
        }
    return $total;        
    }
public function salesPaidAmount($id =NULL,$date=null,$store_id=NULL){
     $total = 0;
     if(!$this->Admin){
        $this->db->where('store_id',$this->session->userdata('store_id'));
     }
     if($store_id !=NULL){$this->db->where('store_id',$store_id);}
     $this->db->select('SUM(paid) as totalpaid');
     $this->db->from('sales');
     
     if( $id !=''){
        $this->db->where('id', $id);
        
     }
     if( $date !=''){
        $data = $this->db->like('date', $date);
     }
     /*$this->db->where('paid_by !=', 'Cheque');
     $this->db->where('paid_by !=', 'Cheque ✓');*/
     $query = $this->db->get();
     $results = $query->result();
      foreach ($results as $result){
         $total = $result->totalpaid ;
        }
    return $total ;
    
    }
    
    public function salesCostAmount($id =NULL){
     $total_cost = 0;
    
     $this->db->select('sale_items.*');
     $this->db->from('sale_items');
     if( $id !=''){
        $this->db->where('sale_id', $id);
        
     }
     
     $query = $this->db->get();
     $results = $query->result();
      foreach ($results as $result){
         $total_cost = $total_cost + ($result->quantity * $result->cost);
         
        }
    return $total_cost ;
    
    }  
    public function salesProfitAmount($id =NULL,$date=null){
     $total_cost = 0;
     $grand_total = 0;
     $this->db->select('sales.*');
     $this->db->from('sales');
     if(!$this->Admin){
            $this->db->where('store_id',$this->session->userdata('store_id'));
         }
     if( $id !=''){
        $this->db->where('created_by', $id);
        
     }
      if( $date !=''){
     $data = $this->db->like('date', $date);
     }
     $query = $this->db->get();
     $results = $query->result();
      foreach ($results as $result){
         $grand_total = $grand_total + ($result->grand_total - $result->total_tax);
         $total_cost = $total_cost + $this->salesCostAmount($result->id);
        }
    return $grand_total-$total_cost ;    
    }

public function salesProfitByDate($start,$end,$store_id=NULL){
    if(!$this->Admin){
        $this->db->where('store_id',$this->session->userdata('store_id'));
    }else{
        if($store_id)
        {$this->db->where('store_id',$store_id);} 
    }

     $total_cost = 0;
     $grand_total = 0;
     $this->db->select('sales.*');
     $this->db->from('sales');
    if($start && $end) {
            $this->db->where('date >=', $start);
            $this->db->where('date <=', $end);
    } else if($start !=''){
        $data = $this->db->like('date', $start);
     }
     $query = $this->db->get();
     $results = $query->result();
      foreach ($results as $result){
         $grand_total = $grand_total + ($result->grand_total - $result->total_tax);
         $total_cost = $total_cost + $this->salesCostAmount($result->id);
        }
    return $grand_total-$total_cost ;    
    }
    public function inspattycash($data){

       if($this->db->insert('pettycash', $data)){
        return true;
       }
       return false;
    }
    public function pattycashdelete($id){
        $this->db->where('pettycash_id', $id);
        if($this->db->delete('pettycash')) 
            return true;         
        else return false;
    }    

    public function lastReceivable($id) {
     $this->db->order_by("id"," DESC"); 
     $q = $this->db->get_where('payments', array('customer_id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }  
      
    }
    public function acReceivable($id=NULL) {
     $this->db->select('sales.* , (grand_total - paid) AS due');
     $this->db->from('sales');
     //$this->db->where('grand_total > paid');
     if($id !=NULL){
         $this->db->where('customer_id', $id);          
     }     
     $query = $this->db->get();
     $results = $query->result();     
        return $results ; 
    }
     public function getCustomerByID($id) { 
        $this->db->from('customers');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $results = $query->result();     
        return $results ;     

    }
     public function getAllCustomer() {   
        if(!$this->Admin){
            $this->db->where('store_id',$this->session->userdata('store_id'));
        } 
        $this->db->from('customers');
        $query = $this->db->get();
        $results = $query->result();     
        return $results ; 
    }

   public function laserPayment($data){

      $this->db->insert('marge_laser', $data);

      return $this->db->insert_id();

  }
    public function addAdvCollec($data) {
        if ($this->db->insert('adv_collection', $data)) {

            return true;
        }

        return false;

    }
    public function getCollectByID($id) {
        $q = $this->db->get_where('today_collection', array('today_collect_id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }
    public function getUserInfo($id) {
        $q = $this->db->get_where('users', array('id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function getCusAdv($id) {
     $this->db->select('SUM(adv_collection) AS advcoll');
     $this->db->from('adv_collection'); 
     $this->db->where('customer_id', $id);        
     $query = $this->db->get(); ; 
     $results = $query->result();
          
          foreach ($results as $result){
             $total =  $result->advcoll ;
             
            }

            if($results < 0){
                 $total = '0';
             }
        return $total ;
    }

 public function getSequence($id, $type = NULL){

        if($this->session->userdata('store_id') !=0){
            $store_id = $this->session->userdata('store_id');
        }else{
            $store_id = $this->session->userdata('store_id_pos'); 
        } 
      
        $this->db->from('pro_sequence');
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
        return $results; 
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
     function sequenceUpdate ($sales_id , $data ){

        $this->db->update('pro_sequence', $data, array('sales_id' => $sales_id));

        return true;
     }

    public function salesReturnAmount($id=NULL,$start_date=NULL,$end_date=NULL){ 
        $total = 0;
        $this->db->select('salesreturn.*');
        $this->db->from('salesreturn');
        if($start_date && $end_date) {
            $this->db->where('date_submit >=', $start_date.' 00:00:00');
            $this->db->where('date_submit <=', $end_date.' 23:59:59');
        }
        if($id){$this->db->where('customer_id', $id);}
        $query = $this->db->get();
        $results = $query->result();
        foreach ($results as $row){
            $this->db->select('return_amount as return_amount');
            $riten = $this->db->get_where('sreturn_items', array('sreturn_id'=> $row->sreturn_id));
            if($riten->num_rows() > 0) {
                foreach (($riten->result()) as $ritens) {
                    $total = $total + $ritens->return_amount;
                }
            }
        }
        return $total ;       
    }
    public function salesReturn($id=NULL,$start_date=NULL,$end_date=NULL){ 
        $total = 0;
        $this->db->select('salesreturn.*');
        $this->db->from('salesreturn');
        if($start_date && $end_date) {
            $this->db->where('date_submit >=', $start_date.' 00:00:00');
            $this->db->where('date_submit <=', $end_date.' 23:59:59');
        }
        if($id){$this->db->where('customer_id', $id);}
        $query = $this->db->get();
        $results = $query->result();
        foreach ($results as $row){ 
            $this->db->select('sum(real_unit_price * return_qty) as return_amount');
            $riten = $this->db->get_where('sreturn_items', array('sreturn_id'=> $row->sreturn_id));
            if($riten->num_rows() > 0) {
                foreach (($riten->result()) as $ritens) {
                    $total = $total + $ritens->return_amount;
                }
            }
        }
        return $total ;    
    }

    public function updateCollectionID($data,$id) {
        if($this->db->update('today_collection', $data, array('today_collect_id' => $id))) {
            return true;
        }
        return false;	
     }

}
