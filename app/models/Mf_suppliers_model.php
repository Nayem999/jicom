<?php defined('BASEPATH') OR exit('No direct script access allowed');

class mf_suppliers_model extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}

	public function getSupplierByID($id)
	{
		$q = $this->db->get_where('mf_suppliers', array('id' => $id), 1);
		if( $q->num_rows() > 0 ) {
			return $q->row();
		}
		return FALSE;
	}

	public function addSupplier($data = array())
	{
		if($this->db->insert('mf_suppliers', $data)) {
			return $this->db->insert_id();
		}
		return false;
	}

	public function updateSupplier($id, $data = array())
	{
		if($this->db->update('mf_suppliers', $data, array('id' => $id))) {
			return true;
		}
		return false;
	}

	public function deleteSupplier($id)
	{
		if($this->db->delete('mf_suppliers', array('id' => $id))) {
			return true;
		}
		return FALSE;
	}

	public function getSupplierLaserBySid($supplier){ 
        $addArarr = array(); 
        $purchsesid = array();

        $this->db->select('SUM(opening_blance) as opening_blance');
        $this->db->where('opening_blance !=', '0');
        $this->db->where('opening_blance !=', NULL);
        $q = $this->db->get_where('mf_suppliers', array('id' => $supplier));

            if($q->num_rows() > 0) {
                foreach (($q->result()) as $row) {
                    $rows['datetime'] = '' ;
                    $rows['total'] = $row->opening_blance ;
                    $rows['pgtotal'] = $row->opening_blance ;
                    $rows['type'] = 'Opening balance';
                    if($row->opening_blance !=''){
                    $results[] = $rows ;
                    }
                }  
            } 

        /*$this->db->select('adv_payment.add_date as datetime, SUM(adv_amount) as advmount');
        $this->db->where('adv_amount !=', '0');
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
            }*/ 
        
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
                $rows['id'] = $row->today_payment_id ;
                $results[] = $rows ;
            }

        }      
        return $results; 
    }
}
