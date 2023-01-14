<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model
{
	public function __construct() {

		parent::__construct();

	}
	public function getBankByID($id) 
	{

		$q = $this->db->get_where('bank_account', array('bank_account_id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function addBank($data)

	{
	
	   if($this->db->insert('bank_account', $data)) {
		   
		
			return $this->db->insert_id();
			
		}
		
		return false;

	}

	public function bankPendingTranjection($data)

	{
	
	   if($this->db->insert('bank_pending', $data)) {
		   
		
			return $this->db->insert_id();
			
		}
		
		return false;

	}
	
	public function editBank($data,$id)

	{
	

		if($this->db->update('bank_account', $data, array('bank_account_id' => $id))) {

			return true;

		}

		return false;

	}
 public function editTransaction($data, $id){
	 
	if($this->db->update('tranjiction', $data, array('tranjiction_id' => $id))) {

			return true;

		}

		return false;	
	}  
	 
  public function  deleteBank($id) 

	{
	
		if($this->db->delete('bank_account', array('bank_account_id' => $id))) {
			
		  // expenses data delete 
		  
			return true;

		}

		return FALSE;

	}
public function  deleteTransaction($id) 

	{
	
		if($this->db->delete('tranjiction', array('tranjiction_id' => $id))) {
			
		  // expenses data delete 
		  
			return true;

		}

		return FALSE;

	}

	public function  deletePeddingChque($id) {
	
		if($this->db->delete('tranjiction', array('pedding_cheque' => $id))) { 
			return true;
		}

		return FALSE;
	}

	public function  deletePeddingLoan($id) {
	
		if($this->db->delete('tranjiction', array('loan_pending_id' => $id))) { 
			return true;
		}

		return FALSE;
	}
	
   public function addTranjiction($data){
	  
	  
	    if($this->db->insert('tranjiction', $data)) {
		   
		
			return $this->db->insert_id();
			
		}
		
		return false;
	  
	 }
	public function getTranjiction($id,$limit=NULL ){
	$this->db->order_by("tranjiction_id", "DESC");	
	if($limit !=NULL){
	$this->db->limit($limit);	
	}
	$query = $this->db->get_where('tranjiction', array('bank_account_id' => $id)); 
		if( $query->num_rows() > 0 ) {
			
			 return  $query->result(); ; //$q->rows();

		} 

		return FALSE;	
		
	}
	
	public function getTransactionByID($id) {

		$q = $this->db->get_where('tranjiction', array('tranjiction_id' => $id), 1); 

		if( $q->num_rows() > 0 ) {
			
			return $q->row();

		} 

		return FALSE;

	}

	public function getPendingChequeByIDTrans($id) {
        $q = $this->db->get_where('tranjiction', array('pedding_cheque' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;  
	}
	public function pettyTobank($data){
		   if($this->db->insert('tranjiction', $data)) {		
			return $this->db->insert_id();		
		}
		
		return false;
	}
	public function getAlltranjection(){ 
		$query = $this->db->get('tranjiction');
		$result = $query->result();
		return $result;
		 
	}

	public function tPettyTobankAmount($store_id=NULL){
		$this->db->select_sum('tran_amount', 'bamount');
		$this->db->where('pettytobankt','1');
		if(!$this->Admin){$this->db->where('store_id',$this->session->userdata('store_id'));}
		if($store_id !=NULL){$this->db->where('store_id',$store_id);}
		$query = $this->db->get('tranjiction');
		$result = $query->result();
		return $result[0]->bamount;
		 
	}
	public function banktopettyAmount($store_id=NULL){
		$this->db->select_sum('tran_amount', 'bamount');
		$this->db->where('pettytobankt','0');
		if(!$this->Admin){$this->db->where('store_id',$this->session->userdata('store_id'));}
		if($store_id !=NULL){$this->db->where('store_id',$store_id);}
		$query = $this->db->get('tranjiction');
		$result = $query->result();
		return $result[0]->bamount;
		 
	}

	public function totalBankCash($store_id=NULL){
		if(!$this->Admin){$this->db->where('store_id',$this->session->userdata('store_id'));}
		if($store_id !=NULL){$this->db->where('store_id',$store_id);}
		$query = $this->db->select_sum('current_amount', 'amount'); 
		$query = $this->db->get('bank_account');
		$result = $query->result();
		return $result[0]->amount;
	}

	public function pendinBankAmount(){
		$query = $this->db->select_sum('amount', 'bamount');
		$query = $this->db->where('type','pending');
		$query = $this->db->get('bank_pending');
		$result = $query->result();
		return $result[0]->bamount;		
	} 
	public function getPendingChequeByID($id) {
        $q = $this->db->get_where('bank_pending', array('pending_id' => $id), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;  
	}
	public function updateChequeByID($data,$id) {
       if($this->db->update('bank_pending', $data, array('pending_id' => $id))) {

			return true;
		}
		return false;	
	}
	public function  ChequeDelete($id) {	
		if($this->db->delete('bank_pending', array('pending_id' => $id))) { 
			return true;
		}
		return FALSE;
	}
	public  function loanOut($loaner_id){
		$this->db->select('loaner_id, type, SUM(amount) as amount'); 
        $this->db->where('type','pay');
        $this->db->where('loaner_id',$loaner_id); 
        $q = $this->db->get('payloaner'); 
        return $q->row()->amount;
	}
	public  function loanIn($loaner_id){
		$this->db->select('loaner_id, type, SUM(amount) as amount'); 
        $this->db->where('type','receive');
        $this->db->where('loaner_id',$loaner_id); 
        $q = $this->db->get('payloaner'); 
        return $q->row()->amount;
	}
}

