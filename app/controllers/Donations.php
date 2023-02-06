<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
Class Donations extends MY_Controller
{
	
	function __construct(){
		parent::__construct();
        if (! $this->loggedIn) {
            redirect('login');
        } 
        $this->load->library('form_validation');
        $this->load->model('bank_model');
        
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
	}

	public function index() {  
        $this->data['page_title'] = lang('Persons or Organizations list');
        $bc = array(array('link' => '#', 'page' => lang('Persons or Organizations')));
        $meta = array('page_title' => lang('Persons or Organizations list'), 'bc' => $bc);
        $this->page_construct('donations/index', $this->data, $meta);
    } 

    public function get_donations_persons() { 
        $this->load->library('datatables');
    	$this->datatables
    	->select("id, name, phone, email, cf1, cf2")
    	->from("donations_persons") 
    	->add_column("Actions", "<div class='text-center'>
    		<div class='btn-group'>
    		<a href='" . site_url('donations/donations_ledger/$1') . "' class='tip btn btn-primary btn-xs' title='Loaner ledger'><i class='fa fa-file-text-o'></i></a>  
    		<a href='" . site_url('donations/edit/$1') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("Edit")."'><i class='fa fa-edit'></i></a> 
    		</div></div>", "id")
        /*<a href='" . site_url('donations/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('Are you sure delete this') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("Delete")."'><i class='fa fa-trash-o'></i></a>*/

    	->unset_column('id'); 
    	echo $this->datatables->generate();
    } 

    public function add(){  
        $this->form_validation->set_rules('name', 'Persons or Organizations', 'required'); 
        $data = array(
            'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'cf1' => $this->input->post('cf1'),
			'cf2' => $this->input->post('cf2'), 
		); 
        if(($this->form_validation->run() == true) && ($this->site->insertQuery('donations_persons',$data))){
            $this->session->set_flashdata('message', 'Persons or Organizations Added Successfully');
            redirect('donations');
        } 
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Add Persons or Organizations';
        $bc = array(array('link' => site_url('donations'), 'page' => 'Add Persons or Organizations'), array('link' => '#', 'page' => 'Add Persons or Organizations'));
        $meta = array('page_title' => 'Add Persons or Organizations', 'bc' => $bc); 
        $this->page_construct('donations/add', $this->data, $meta); 
         
    } 
    public function edit($id){ 
        $this->form_validation->set_rules('name', 'Persons or Organizations Name', 'required'); 
        $data = array('name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'cf1' => $this->input->post('cf1'),
			'cf2' => $this->input->post('cf2'), 
		);  
        if(($this->form_validation->run() == true) &&($this->site->updateQuery('donations_persons',$data,array('id'=>$id)))){
            $this->session->set_flashdata('message', 'Persons or Organizations Updated Successfully');
            redirect('donations');
        } 
        $this->data['donations'] = $this->site->findeNameByID('donations_persons','id',$id);
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Edit Persons or Organizations';
        $bc = array(array('link' => site_url('donations'), 'page' => 'Edit Persons or Organizations'), array('link' => '#', 'page' => 'Persons or Organizations'));
        $meta = array('page_title' => 'Edit Persons or Organizations', 'bc' => $bc); 
        $this->page_construct('donations/edit', $this->data, $meta); 
         
    } 
    public function delete($id){ 
        if($this->site->deleteQuery('donations_persons',array('id' => $id))){            
           $this->session->set_flashdata('message','Persons or Organizations Delete Successfully');
        }else{
           $this->session->set_flashdata('error','Persons or Organizations Not Delete');
        }
        redirect("donations");    
    }
    public function pay_list() {  
        $this->data['page_title'] = lang('Persons or Organizations list');
        $bc = array(array('link' => '#', 'page' => lang('Persons or Organizations')));
        $meta = array('page_title' => lang('Persons or Organizations list'), 'bc' => $bc);
        $this->page_construct('donations/pay_list', $this->data, $meta);
    } 

    public function get_pay_list() { 
        $this->load->library('datatables');
        $this->datatables->select($this->db->dbprefix('donations_pay').".id as id,". 
            $this->db->dbprefix('donations_pay').".entry_date, ".
            $this->db->dbprefix('donations_persons').".name as dname,".
            $this->db->dbprefix('donations_pay').".amount, ".
            $this->db->dbprefix('donations_pay').".payment_type, ".
            $this->db->dbprefix('donations_pay').".cheque_or_card_no, ".
            $this->db->dbprefix('bank_account').".bank_name as bname,")
        ->from("donations_pay");   
        $this->datatables->join('donations_persons','donations_persons.id=donations_pay.donations_persons_id');
        $this->datatables->join('bank_account','bank_account.bank_account_id=donations_pay.bank_id','left');
        $this->datatables->add_column("Actions", "<div class='text-center'>
            <div class='btn-group'>  
            <a href='" . site_url('donations/pay_delete/$1') . "' onClick=\"return confirm('". $this->lang->line('Are you sure delete this') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("Delete")."'><i class='fa fa-trash-o'></i></a>
            </div></div>", "id"); 

        $this->datatables->unset_column('id'); 
        echo $this->datatables->generate();
    }
    public function pay(){  
        $this->form_validation->set_rules('donation_id', 'Persons or Organizations', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required'); 
        $date = $this->input->post('date') ? $this->input->post('date') : date('Y-m-d H:i:s');
        $payment_type = $this->input->post('payment_type');
        $data = array(
            'amount'        => $this->input->post('amount'),
            'payment_type'  => $this->input->post('payment_type'),
            'cheque_or_card_no' => $this->input->post('cheque_or_card_no'), 
            'donations_persons_id' => $this->input->post('donation_id'),
            'note'          => $this->input->post('note'),
            'entry_date'    => $date           
        ); 
        if($payment_type == 'cheque' || $payment_type == 'card'){
            $data['bank_id']  =  $this->input->post('bank');
            $data['bankname'] = $this->input->post('bankname');
            $data['cheque_or_card_no']  =  $this->input->post('cheque_or_card_no');
        } 
        if(($this->form_validation->run() ==true) && ($loanId = $this->site->insertQuery('donations_pay',$data))){ 
            if(($payment_type == 'cheque') || ($payment_type == 'card')){
                $bankPending = array(
                    'donations_persons_id'=> $this->input->post('donation_id'),
                    'donations_pay_id' => $loanId,
                    'bank_id'      => $this->input->post('bank'),
                    'payment_type' => $this->input->post('payment_type'),
                    'type'         => 'pay', 
                    'bank_status'  => 'Pending',
                    'cheque_or_card_no' => $this->input->post('cheque_or_card_no'),
                    'amount'       => $this->input->post('amount'),
                    'created_by'   => $this->session->userdata('user_id') 
                );
                $this->site->insertQuery('bank_pending_donations', $bankPending); 
            }                
            $this->session->set_flashdata('message','Donate add Successfully');
            redirect('donations/pay');
        }    
        $this->data['donations'] = $this->site->seleteQuery('donations_persons');        
        $this->data['page_title'] = 'Persons or Organizations pay';
        $bc = array(array('link' => '#','page' => 'Persons or Organizations pay' ) );        
        $meta = array('page_title' => 'Persons or Organizations pay','bc' => $bc);        
        $this->page_construct('donations/pay', $this->data, $meta);
    
    } 
    public function pay_delete($id){ 
        $donations_pay = $this->site->whereRow('donations_pay', 'id', $id); 
        if($donations_pay->payment_type =='cash'){
            $this->site->deleteQuery('donations_pay',array('id' => $id));
            $this->session->set_flashdata('message','Donations amount delete successfully');
        }   
        if(($donations_pay->payment_type =='card') || ($donations_pay->payment_type =='cheque')){
            $pending = $this->site->whereRow('bank_pending_donations', 'donations_pay_id', $id);   
            if($pending->bank_status =='Approved'){
                $transactions = $this->site->whereRow('tranjiction','tranjiction_id',$pending->transactions_id);  
                $bank = $this->site->whereRow('bank_account', 'bank_account_id',$transactions->bank_account_id);  
                $bkbalance = array('current_amount' => ($bank->current_amount + $transactions->tran_amount)); 
                $this->site->updateQuery('bank_account',$bkbalance,array('bank_account_id'=>$bank->bank_account_id));
                $this->site->deleteQuery('tranjiction',array('id' => $pending->transactions_id)); 
            }
            $this->site->deleteQuery('bank_pending_donations',array('donations_pay_id' => $id));
            $this->site->deleteQuery('donations_pay',array('id' => $id));
            $this->session->set_flashdata('message','Donations amount delete successfully'); 
        } 
        redirect("donations/pay_list");
    }
    public function personsInfo($id){
        $donationsPerson = $this->site->findeNameByID('donations_persons','id',$id); 
        $this->db->select('donations_persons_id,SUM(amount) as amount');
        $this->db->from('donations_pay'); 
        $this->db->where('donations_persons_id',$id);     
        $queryDonations = $this->db->get();
        $resultsDonations = $queryDonations->row();  
        echo '<div class="col-xs-10">
            <h3 class"box-title">Persons or Organizations ('. $donationsPerson->name.')</h3>
            <p>Loaner information</p>
            <table class="table table-bordered">
                <tbody>  
                  <tr>
                    <td class="col-xs-5">Total Donations Amount</td>
                    <td class="col-xs-7">'.($resultsDonations->amount).'</td>
                  </tr>
                </tbody>
              </table>
             </div>
             <div class="col-xs-10">';
             
    }
    public function bankInfo($type,$sid){    
        $banks = $this->site->getAllBanks(); 
        if(($type=='cheque') || ($type=='card')){
            $output= '<div class="form-group">
                    <p>Bank information </p> 
                       <select class="form-control select2 tip" name="bank" required="required" id="type">
                            <option value="">Select</option>';

                            foreach ($banks as $key => $bank) {
                                $output .='<option value="'.$bank->bank_account_id.'">'.$bank->bank_name .' ('.$bank->account_name.' ) ( '.$bank->account_no.')</option>';
                            }
                                                    
            $output .='</select></div>'; 
            if($type=='card'){                          
                $output .=' 
                        <div class="form-group">
                        <label>Card No </label>
                            <input type="text" name="cheque_or_card_no" class="form-control">
                        </div>';  
            }else if($type=='cheque'){
                $output .='
                    <div class="form-group">
                    <label>Cheque No </label>
                        <input type="text" name="cheque_or_card_no" class="form-control" required="required">
                    </div>';
            }
            echo $output;
        } 
    }
    public function list_donations(){ 
    	$this->data['page_title'] = lang('Loaner list');
        $bc = array(array('link' => '#', 'page' => lang('Loaner')));
        $meta = array('page_title' => lang('Loaner list'), 'bc' => $bc);
        $this->page_construct('donations/list_donationspay', $this->data, $meta);
    
    }  
}
