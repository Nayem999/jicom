<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Marge_model extends CI_Model
{

    public function __construct() {

        parent::__construct();

    }
    public function addMarge($data){
	    if($this->db->insert('marge', $data)){
	    	return TRUE;    	
	    } 
	    return FALSE ;   	 
		
    }
    public function mergedelete($id){
        $this->db->where('marge_id', $id);
        if($this->db->delete('marge')) 
            return true;         
        else return false;
    }

    public function laserdelete($id) {
         $this->db->where('laser_id', $id);
        if($this->db->delete('marge_laser')) 
            return true;         
        else return false;
    }

    public function getMergeById($id){
		$this->db->from('marge');
        $this->db->where('marge_id', $id);
        $query = $this->db->get();
     	$results = $query->result();     
        return $results ;

    }
    public function getSalesPurseByCidAndSupid($supplier, $cusromer ){
        $addArarr = array();
        $salesid = array();
        $purchsesid = array();

        $this->db->select('SUM(opening_blance) as opening_blance');
        $this->db->where('opening_blance !=', '0');
        $this->db->where('opening_blance !=', NULL);
        $q = $this->db->get_where('suppliers', array('id' => $supplier));
            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = '' ;
                    $rows['total'] = $row->opening_blance ;
                    $rows['pgtotal'] = $row->opening_blance ;
                    $rows['type'] = 'Supplier Opening balance';
                    if($row->opening_blance !=''){
                    $results[] = $rows ;
                    }
                }  
            }

        $this->db->select('opening_blance as opening_blance');
        $this->db->where('opening_blance !=', '0'); 
        $q = $this->db->get_where('customers', array('id' => $cusromer));
            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = '' ;
                    $rows['total'] = $row->opening_blance ;
                    $rows['pgtotal'] = $row->opening_blance ;
                    $rows['type'] = 'Customer Opening balance';
                    if($row->opening_blance !=''){
                    $results[] = $rows ;
                    }
                }  
            }

        $this->db->select('adv_collection.add_date as datetime, adv_collection.adv_collection as advcoll');
         $q = $this->db->get_where('adv_collection', array('customer_id' => $cusromer));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = $row->datetime ;
                    $rows['total'] = $row->advcoll ;
                    $rows['type'] = 'Advance Collection'; 
                    if($row->advcoll !=''){
                    $results[] = $rows ;
                    }
                } 
            } 

        $this->db->select('sales.id,sales.date as datetime,sales.grand_total');
        $q = $this->db->get_where('sales', array('customer_id' => $cusromer));
         if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $rows['datetime'] = $row->datetime ;
                $rows['total'] = $row->grand_total ;
                $rows['sgtotal'] = $row->grand_total ;
                $rows['sale'] = '0.00' ;
                $rows['type'] = 'sale' ;
                $rows['id'] = $row->id;
                $results[] = $rows ;
                $salesid[] = $row->id ;
            }
          
        } 
        else return 'No data pound';
        
        $this->db->select('today_collection.today_collect_id, today_collection.payment_date as datetime, payment_amount as amount');
        $this->db->order_by("today_collect_id","DESC");    
        $q = $this->db->get_where('today_collection', array('customer_id' => $cusromer));
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $rows['datetime'] = $row->datetime ;
                $rows['total'] = $row->amount ;
                $rows['sgtotal'] = $row->amount ;
                $rows['sale'] = '0.00' ;
                $rows['type'] = 'collection' ;
                $rows['id'] = $row->id ;
                $results[] = $rows ;
            } 

        }        

        $this->db->select('adv_payment.adv_id,adv_payment.add_date as datetime,adv_amount as advmount');
         $q = $this->db->get_where('adv_payment', array('suppliers_id' => $supplier));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = $row->datetime ;
                    $rows['total'] = $row->advmount ;
                    $rows['pgtotal'] = $row->advmount ;
                    $rows['type'] = 'Advance Payment';
                    if($row->advmount !=''){
                    $results[] = $rows ;
                    }
                } 
            } 
        
         $this->db->select('purchases.id,purchases.date as datetime, purchases.total');
         $q = $this->db->get_where('purchases', array('supplier_id' => $supplier));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = $row->datetime ;
                    $rows['total'] = $row->total ;
                    $rows['pgtotal'] = $row->total ;
                    $rows['type'] = 'purchases' ;
                    $rows['sale'] = '0.00' ;
                    $rows['id'] = $row->id;
                    $results[] = $rows ;
                    $purchsesid[] = $row->id ;
                }
            }
        else return 'No data pound';        

        $this->db->select('today_purchase_payment.today_payment_id, today_purchase_payment.payment_date as datetime,  today_purchase_payment.payment_amount as amount'); 
        $q = $this->db->get_where('today_purchase_payment', array('supplier_id' => $supplier));
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $rows['datetime'] = $row->datetime ;
                $rows['total'] = $row->amount ;
                $rows['pgtotal'] = $row->amount ;
                $rows['type'] = 'payment' ;                
                $rows['sale'] = '0.00' ;
                $rows['id'] = $row->p_pay_id ;
                $results[] = $rows ;
            }

        }      
        return $results; 
    }

    public function GetMergeTotalVal($supplier, $cusromer ){
        $addArarr = array();
        $salesid = array();
        $purchsesid = array();

        $this->db->select('adv_collection.add_date as datetime, SUM(adv_collection) as advcoll');
         $q = $this->db->get_where('adv_collection', array('customer_id' => $cusromer));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = $row->datetime ;
                    $rows['total'] = $row->advcoll ;
                    $rows['type'] = 'Advance Collection'; 
                    if($row->advcoll !=''){
                    $results[] = $rows ;
                    }
                } 
            }
        else return 'No data pound';

        $this->db->select('sales.id,sales.date as datetime,sales.grand_total');
        $q = $this->db->get_where('sales', array('customer_id' => $cusromer));
         if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $rows['datetime'] = $row->datetime ;
                $rows['total'] = $row->grand_total ;
                $rows['sgtotal'] = $row->grand_total ;
                $rows['sale'] = '0.00' ;
                $rows['type'] = 'sale' ;
                $rows['id'] = $row->id;
                $results[] = $rows ;
                $salesid[] = $row->id ;
            }
          
        } 
        else return 'No data pound';
        $this->db->select('payments.id,payments.date as datetime,SUM(amount) as amount,payments.sale_id');
        $this->db->order_by("id","DESC");
        $this->db->where_in('sale_id', $salesid);        
        $this->db->group_by("date(date)");
        $q = $this->db->get_where('payments', array('customer_id' => $cusromer,));
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $rows['datetime'] = $row->datetime ;
                $rows['total'] = $row->amount ;
                $rows['sgtotal'] = $row->amount ;
                $rows['sale'] = '0.00' ;
                $rows['type'] = 'collection' ;
                $rows['id'] = $row->id ;
                $results[] = $rows ;
            } 

        }         
        $this->db->select('adv_payment.adv_id,adv_payment.add_date as datetime, SUM(adv_amount) as advmount');
         $q = $this->db->get_where('adv_payment', array('suppliers_id' => $supplier));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = $row->datetime ;
                    $rows['total'] = $row->advmount ;
                    $rows['pgtotal'] = $row->advmount ;
                    $rows['type'] = 'Advance Payment';
                    if($row->advmount !=''){
                    $results[] = $rows ;
                    }
                } 
            }
        else return 'No data pound';
        
         $this->db->select('purchases.id,purchases.date as datetime, purchases.total');
         $q = $this->db->get_where('purchases', array('supplier_id' => $supplier));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = $row->datetime ;
                    $rows['total'] = $row->total ;
                    $rows['pgtotal'] = $row->total ;
                    $rows['type'] = 'purchases' ;
                    $rows['sale'] = '0.00' ;
                    $rows['id'] = $row->id;
                    $results[] = $rows ;
                    $purchsesid[] = $row->id ;
                }
            }
        else return 'No data pound';        

        $this->db->select('purchase_payments.p_pay_id,purchase_payments.date as datetime, SUM(amount) as amount,purchase_payments.purchases_id DESC');
        $this->db->where_in('purchases_id', $purchsesid); 
        $this->db->group_by("date(date)");
        $this->db->order_by("p_pay_id", "DESC"); 
         $q = $this->db->get_where('purchase_payments', array('supplier_id' => $supplier));
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $rows['datetime'] = $row->datetime ;
                $rows['total'] = $row->amount ;
                $rows['pgtotal'] = $row->amount ;
                $rows['type'] = 'payment' ;                
                $rows['sale'] = '0.00' ;
                $rows['id'] = $row->p_pay_id ;
                $results[] = $rows ;
            }
            foreach ($results as $key => $value) {
                    $i++;
                    $gtotal = $gtotal; 
                     if(($value['type'] == 'purchases') ||($value['type'] =='collection') ||($value['type'] =='Advance Collection')) {  ; 
                         $pgtotal = $pgtotal + $value['total'];
                     } 
                     if(($value['type'] == 'sale') || ($value['type'] =='payment') || ($value['type'] =='Advance Payment')){ 
                        $sgtotal = $sgtotal + $value['total'];
                     }
                       
                     $gtotal = $sgtotal - $pgtotal; 
                  
            }  

        } 

        return $gtotal; 
    } 
}

