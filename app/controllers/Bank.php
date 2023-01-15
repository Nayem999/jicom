<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends MY_Controller

{
    function __construct() {

        parent::__construct();



        if (!$this->loggedIn) {

            redirect('login');

        }

        $this->load->library('form_validation');

        $this->load->model('bank_model');
		
		$this->load->model('purchases_model');
		

    }

    function index() {

    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    	$this->data['page_title'] = 'Bank';

    	$bc = array(array('link' => '#', 'page' => 'bank'));

    	$meta = array('page_title' => 'Bank', 'bc' => $bc);

    	$this->page_construct('bank/index', $this->data, $meta);

    }

    function get_bank() {
		
    	$this->load->library('datatables');

    	//$this->datatables->select("bank_account_id, bank_name, account_name, account_no, current_amount");
    	$this->datatables->select($this->db->dbprefix('bank_account') . ".bank_account_id as bank_account_id,".
    		$this->db->dbprefix('bank_account') . ".bank_name, ".    		
    		$this->db->dbprefix('bank_account') . ".account_name, ".
    		$this->db->dbprefix('bank_account') . ".account_no, ".
    		$this->db->dbprefix('stores') . ".name as storename, ".
    		$this->db->dbprefix('bank_account') . ".current_amount,", FALSE);
        
       $this->datatables->join('stores', 'bank_account.store_id=stores.id'); 

    	$this->datatables->from("bank_account");
    
    	$this->datatables->add_column("Actions", "
			<div class='text-center'><div class='btn-group'>
			
			  <a href='" . site_url('bank/edit/$1') . "' class='tip btn btn-primary btn-xs' title='Edit Bank Information'>
			      <i class='fa fa-edit'></i>
			  </a>
			 
			 <a href='javascript:;' onClick='tranjictionList($1)'  class='tip btn btn-warning btn-xs'  title='Transaction List'>
			      <i class='fa fa-list'></i>
			  </a>
			  
			  
			  <a href='javascript:;' onClick='addTranjiction($1)' class='tip btn btn-warning btn-xs' title='Transaction'>
			      <i class='fa fa-briefcase'></i>
			  </a>
		      <a href='" . site_url('bank/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='Delete bank Account'>
			    <i class='fa fa-trash-o'></i>
			  </a>
			  
			  </div></div>", "bank_account_id");
    	if(!$this->Admin){
    		$this->datatables->where('store_id', $this->session->userdata('store_id'));
    	}

    	$this->datatables->unset_column('bank_account_id');
		$this->datatables->where('status', '1');

    	echo $this->datatables->generate();

    }
	function view($id){
		
		
		$this->data['emplyee'] = $this->employee_model->getEmplyeeByID($id);
		
		$this->data['list'] = $this->employee_model->getPaysalary($id);
		
        $this->data['page_title'] = 'Employee pay salarys ';
		
        $this->load->view($this->theme.'employee/view', $this->data);
		
		}

    function add() { 
		
		$this->form_validation->set_rules('bank_name','Bank Name', 'required');
		
		$this->form_validation->set_rules('account_name', 'Account Name', 'required');
		
		$this->form_validation->set_rules('account_no', 'Account No', 'required'); 

		if ($this->Admin){

			$this->form_validation->set_rules('warehouse', 'Store Name', 'required');

			$store_id = $this->input->post('warehouse');

		} else {
			$store_id = $this->session->userdata('store_id');
		}

		if ($this->form_validation->run() == true) {
			
			$data = array('bank_name' => $this->input->post('bank_name'),
			
				'account_name'		 => $this->input->post('account_name'),

				'account_no'		 => $this->input->post('account_no'),
				
				'current_amount'     => 0 ,
				
				'create_date'		=> date('Y-m-d'),

				'store_id' 			=> $store_id,
			);

		

			$cid = $this->bank_model->addBank($data);
			 
            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'success', 'msg' => 'Add New bank account ', 'id' => $cid, 'val' => $data['name']));

                die();
            }

            $this->session->set_flashdata('message', 'Add New bank account');

            redirect("bank");

		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }
			$date['submit_button'] = "New Bank Account ";
			
			$this->data['action'] = "bank/add" ;

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = 'Add Employee';

    		$bc = array(array('link' => site_url('bank'), 'page' => 'Bank'), array('link' => '#', 'page' => 'New Bank Account '));

    		$meta = array('page_title' => 'New Bank Account ', 'bc' => $bc);
    		$this->data['warehouses'] = $this->site->getAllStores(); 

    		$this->page_construct('bank/form', $this->data, $meta);

		}

	}

	function edit($id = NULL){	

        if ((!$this->Admin) && (!$this->Manager)) {

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');

        }

		$this->form_validation->set_rules('bank_name','Bank Name', 'required');
		
		$this->form_validation->set_rules('account_no', 'Account No', 'required'); 
		
		$this->form_validation->set_rules('account_name', 'Account Name', 'required');

		if ($this->Admin){

			$this->form_validation->set_rules('warehouse', 'Store Name', 'required');

			$store_id = $this->input->post('warehouse');

		} else {
			$store_id = $this->session->userdata('store_id');
		}

		if ($this->form_validation->run() == true) { 
			
			$data = array(
				'bank_name' => $this->input->post('bank_name'),
			
				'account_name'		 => $this->input->post('account_name'),

				'account_no'		 => $this->input->post('account_no'), 

				'store_id' 			=> $store_id,
				
			);

			$cid = $this->bank_model->editBank($data,$id) ;

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'success', 'msg' =>  'Update bank information', 'id' => $cid, 'val' => $data['name']));

                die();

            }

            $this->session->set_flashdata('message', 'Update bank information');

            redirect("bank/edit/".$id);



		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }
			
			$data['action'] = "bank/edit/".$id ;
			
			$date['submit_button'] = "Update Bank Information";
			
			$this->data['bank'] = $this->bank_model->getBankByID($id);

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = 'Update Bank Information';

    		$bc = array(array('link' => site_url('bank'), 'page' => 'Bank'), array('link' => '#', 'page' => 'Update Bank Information'));

    		$meta = array('page_title' => 'Update Bank Information', 'bc' => $bc);

    		$this->data['warehouses'] = $this->site->getAllStores(); 

    		$this->page_construct('bank/form', $this->data, $meta);

		}

	}

   
	 
	function delete($id = NULL){

		if(DEMO) {

			$this->session->set_flashdata('error', $this->lang->line("disabled_in_demo"));

			redirect('pos');

		}



		if($this->input->get('id')) { $id = $this->input->get('id', TRUE); }



		if (!$this->Admin)

		{

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('pos');

		}



		if ( $this->bank_model->deleteBank($id) )

		{

			$this->session->set_flashdata('message', 'Bank Accounty deleted ');

			redirect("bank");

		}

	}
	
  	function addTranjiction($id){
	  
	 
	  	$bank_info = $this->bank_model->getBankByID($id) ;
		
		$current_amount = $bank_info->current_amount;
		
		$account_name = $bank_info->account_name;
		
	    $this->form_validation->set_rules('tran_amount', 'Amount', 'required');
		
		$this->form_validation->set_rules('tran_type', 'Type', 'required');
		

		if ($this->form_validation->run() == true) { 
			
			$data = array(
			    'bank_account_id'   => $id,

				'tran_amount'  => $this->input->post('tran_amount'),
				
				'tran_type'    => $this->input->post('tran_type'),
				
				'tran_note'    => $this->input->post('tran_note'),
				
				'tran_date'    => date('Y-m-d H:i:s'),
				
			);
			
			$tran_id = $this->bank_model->addTranjiction($data) ;
			
			if($this->input->post('tran_type') == 1){
				
			   $bankData = array(
			    'current_amount'   => $current_amount+ $this->input->post('tran_amount')
				);
				
			   $this->bank_model->editBank($bankData,$id) ;
			}
			if($this->input->post('tran_type') == 0){
				$bankData = array(
			    'current_amount'   => $current_amount - $this->input->post('tran_amount')
				);
				
			   $this->bank_model->editBank($bankData,$id) ;
				
			
			}
			
			 redirect("bank");

		}

		$this->data['action'] = "bank/addTranjiction/".$id;
	  	$this->load->view($this->theme . 'bank/tranjiction',$this->data); 
	  
	}
	
	function editTransaction($id){
	 
	 	$bank_id = $this->bank_model->getTransactionByID($id,'1');
		
		//print_r($bank_id);
		
		$edit_old_amount = $bank_id->tran_amount ;
		
		$tran_type = $bank_id->tran_type ;
		
		$bank_account_id = $bank_id->bank_account_id ;
		
		$bank_info = $this->bank_model->getBankByID($bank_account_id);
		
		$current_amount = $bank_info->current_amount;
		
	 	$this->form_validation->set_rules('tran_amount', 'Amount', 'required');
		
		if ($this->form_validation->run() == true) { 
			
			$data = array(
			
				'tran_amount'  => $this->input->post('tran_amount'),
				
				'tran_note'    => $this->input->post('tran_note'),
				
			);
			
			$tran_id = $this->bank_model->editTransaction($data,$id) ;
			
			
			
			if($tran_type == 1){
				
			   $bankDataAdd = array(
			    'current_amount'   => ($current_amount-$edit_old_amount)+$this->input->post('tran_amount')
				);
				
			   $this->bank_model->editBank($bankDataAdd,$bank_account_id) ;
			}
			if($tran_type == 0){
				$bankDataAdd = array(
			    'current_amount'   => ($current_amount+$edit_old_amount)-$this->input->post('tran_amount')
				);
			
			   $this->bank_model->editBank($bankDataAdd,$bank_account_id) ;
			}
			 redirect("bank");
			
		}
	 
	 	$this->data['transaction'] = $this->bank_model->getTransactionByID($id);
	 	$this->data['action'] = "bank/editTransaction/".$id;
		$this->load->view($this->theme . 'bank/tranjiction',$this->data);  
 	}
 	function tranjictionList($id){
	  $this->load->helper('security');
	
	    if ((!$this->Admin) && (!$this->Manager)) {

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');
        }
		
		$this->data['list'] = $this->bank_model->getTranjiction($id,'20');
	
		$this->data['bank_info'] = $this->bank_model->getBankByID($id);
	    $this->load->view($this->theme . 'bank/tranjictionList',$this->data); 
	 }
 	function allTransaction($account_id,$tran_type = NULL ){
	 
	 if($tran_type == NULL){
		 $tran_type = 1;
	  }
	
	    $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
	
		$this->data['path'] = 'bank/get_Transaction/'.$account_id.'/'.$tran_type;
		
		$this->data['tabPath'] = 'bank/allTransaction/'.$account_id;
		
		$bank_id = $this->bank_model->getTranjiction($account_id,'1');
		
		$bank_info = $this->bank_model->getBankByID($bank_id[0]->bank_account_id);
		
		$this->data['active'] = $tran_type ;
		
    	$this->data['page_title'] = 'All Transaction';

    	$bc = array(array('link' => '#', 'page' => 'All Transaction'));

    	$meta = array('page_title' => 'All Transaction ('.$bank_info->bank_name.', '.$bank_info->account_name.', '.$bank_info->account_no .' )', 'bc' => $bc);

    	$this->page_construct('bank/allTransaction', $this->data, $meta);
	}
 	function get_Transaction($account_id,$tran_type = NULL) {
		
    	$this->load->library('datatables');

    	$this->datatables

    	->select("tranjiction_id, tran_date, tran_amount, tran_note")

    	->from("tranjiction")
    
    		->add_column("Actions", "
			<div class='text-center'><div class='btn-group'>
			
			      <a class='tip btn btn-warning btn-xs' data-toggle='ajax' onclick='editTransaction($1)' href='javascript:;'>
			      <i class='fa fa-edit'></i>
			  </a>
			 
		      <a href='" . site_url('bank/deleteTransaction/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='Delete bank Transaction'>
			    <i class='fa fa-trash-o'></i>
			  </a>
			  
			  </div></div>", "tranjiction_id")

    	->unset_column('tranjiction_id');
		$this->datatables->where('bank_account_id', $account_id);
		$this->datatables->where('tran_type', $tran_type);

    	echo $this->datatables->generate();

    }
	
	function deleteTransaction($id = NULL){

		if (!$this->Admin)

		{

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('pos');

		}

		$Transaction_inf =  $this->bank_model->getTransactionByID($id) ;
		
		$tran_type = $Transaction_inf->tran_type ;
		
		$account_id = $Transaction_inf->bank_account_id ;
		
		$delete_amount = $Transaction_inf->tran_amount  ;
		
		$bank_info = $this->bank_model->getBankByID($account_id) ;
		
		$current_amount = $bank_info->current_amount;
		
		if($tran_type ==0){
			
		$bankData = array(
			    'current_amount'   => $current_amount + $delete_amount
				);
				
		$this->bank_model->editBank($bankData,$account_id) ;
			
			
		}
		if($tran_type ==1){
			
			$bankData = array(
			    'current_amount'   => $current_amount - $delete_amount
				);
				
			$this->bank_model->editBank($bankData,$account_id) ;
			
		}
		
		if ( $this->bank_model->deleteTransaction($id) )

		{

			$this->session->set_flashdata('message', 'Bank Transaction deleted ');

			redirect("bank/allTransaction/".$account_id.'/'.$tran_type);

		}

	}

	function bankTransfer(){
		$this->data['warehouses'] = $this->site->getAllStores();
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;		 
		$this->data['bankAcount']  = $this->site->getAllBanks();		
		$this->data['title'] = 'Pettycash to bank Payment Transfer'; 
	    $this->load->view($this->theme.'bank/bankTransfer', $this->data);
	
	}
	function getbankByStoreID($store_id){
		$bankAcount = $this->site->getAllBanks($store_id);
		 
		$output = '<div class="form-group">'; 
        $output .=  lang('Bank Name ');  
              $sp[''] = lang("select")." ".lang("Bank");
                foreach($bankAcount as $bank) {
                    $sp[$bank->bank_account_id] = $bank->bank_name .' ('.$bank->account_name.' ) ( '.$bank->account_no.')';
                }  
            $output .= form_dropdown('bank', $sp, set_value('bank'), 'class="form-control select2 tip" required="required" style="width:100%;" '); 
          $output .= '</div>';

        echo $output;
		 
	}

	public function pettyTobank(){
		$bankID = $this->input->post('bank');
		$amount = $this->input->post('amount');
		$data = array(
		    'bank_account_id'   => $bankID,
			'tran_amount'  		=> $amount,			
			'pettytobankt' 		=> '1',
			'tran_type'	   		=> '1',		
			'tran_note'   		=> $this->input->post('tran_note'),
			'tran_date'    		=> date('Y-m-d H:i:s'),
			'store_id'			=> $this->input->post('warehouse'),		
			); 
		$bank = $this->bank_model->getBankByID($this->input->post('bank'));
		$bankTAmount = $bank->current_amount+$this->input->post('amount');
		$bankData = array(
			'current_amount' => $bankTAmount,
			);
		
		$this->bank_model->editBank($bankData,$bankID);	 
		$this->bank_model->pettyTobank($data);
		$this->session->set_flashdata('message', lang('Pettycash Bank to payment transfer success!'));
		redirect('reports/pettycash');

	}

	public function pettyTransfer(){ 
		$this->data['warehouses'] = $this->site->getAllStores();
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;
		$this->data['bankAcount']  = $this->site->getAllBanks();		
		$this->data['title'] = 'Bank To Petty cash Payment Transfer'; 
	    $this->load->view($this->theme.'bank/pettyTransfer', $this->data);
	
	}

	public function bankTopetty(){
		$bankID = $this->input->post('bank');
		$amount = $this->input->post('amount');
		$data = array(
		    'bank_account_id'   => $bankID,
			'tran_amount'  		=> $amount,			
			'pettytobankt' 		=> '0',
			'tran_type'	   		=> '0',		
			'tran_note'   		=> $this->input->post('tran_note'),
			'tran_date'    		=> date('Y-m-d H:i:s'),
			'store_id'			=> $this->input->post('warehouse'),	
			);
 
		$bank = $this->bank_model->getBankByID($this->input->post('bank'));
		if($bank->current_amount >= $amount){
			$bankTAmount = $bank->current_amount-$this->input->post('amount');
		} else {
			$this->session->set_flashdata('error', lang('Bank to pettycash payment transfer error ! Your Amount Exceeds the limit '));
            redirect("reports/pettycash");
		}
		
		$bankData = array(
			'current_amount' => $bankTAmount,
			);
		
		$this->bank_model->editBank($bankData,$bankID);	 
		$this->bank_model->pettyTobank($data);
		$this->session->set_flashdata('message', lang('Bank to pettycash payment transfer success!'));
		redirect('reports/pettycash');
	
	}

	public function bankTranReport(){ 	
		$this->data['title'] = 'Bank To Petty cash Payment Transfer'; 
		$this->page_construct('bank/bankTranReport', $this->data);
	   
	}

	public function get_bankTranReport(){
		 $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('bank_account').".bank_account_id as bid,
		  ".$this->db->dbprefix('bank_account').".bank_name as bank_name ,
		  ".$this->db->dbprefix('stores').". name as storename ,
		  ".$this->db->dbprefix('bank_account').".account_name as account_name ,
		  ".$this->db->dbprefix('bank_account').".account_no as acno ,
		  ".$this->db->dbprefix('tranjiction').".tran_amount as tamount ,
		  ".$this->db->dbprefix('tranjiction').".tran_note as note, 
		  ".$this->db->dbprefix('tranjiction').".tran_date as tran_date", FALSE);

         $this->datatables->join('tranjiction', 'tranjiction.bank_account_id=bank_account.bank_account_id');
         $this->datatables->join('stores', 'stores.id=tranjiction.store_id');

         $this->datatables->from('bank_account');
         $this->datatables->where('pettytobankt','0');
         if(!$this->Admin){$this->datatables->where('bank_account.stores',$this->session->userdata('store_id'));}
         $this->datatables->group_by('tranjiction.tranjiction_id');
		
         $this->datatables->unset_column('bid');
		
         echo $this->datatables->generate();
	
	}

	public function pettyTranReport(){ 	
		$this->data['title'] = 'Bank To Petty cash Payment Transfer'; 
		$this->page_construct('bank/pettyTranReport', $this->data);
	     		
	}

	public function get_pettyTranReport(){
		 $this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('bank_account').".bank_account_id as bid,
		  ".$this->db->dbprefix('bank_account').".bank_name as bank_name ,
		  ".$this->db->dbprefix('stores').". name as storename ,
		  ".$this->db->dbprefix('bank_account').".account_name as account_name ,
		  ".$this->db->dbprefix('bank_account').".account_no as acno ,
		  ".$this->db->dbprefix('tranjiction').".tran_amount as tamount ,
		  ".$this->db->dbprefix('tranjiction').".tran_note as note, 
		  ".$this->db->dbprefix('tranjiction').".tran_date as tran_date", FALSE);

         $this->datatables->join('tranjiction', 'tranjiction.bank_account_id=bank_account.bank_account_id');
         $this->datatables->join('stores', 'stores.id=bank_account.store_id');

         $this->datatables->from('bank_account');
         $this->datatables->where('pettytobankt','1');
         if(!$this->Admin){$this->datatables->where('bank_account.stores',$this->session->userdata('store_id'));}
         $this->datatables->group_by('tranjiction.tranjiction_id');		
         $this->datatables->unset_column('bid');		
         echo $this->datatables->generate();
	
	}

	public function pendingCheque(){ 	
		$this->data['page_title'] = lang('Panding Cheque List');
        $bc = array(array('link' => '#', 'page' => lang(' List')));
        $meta = array('page_title' => lang('Panding Cheque List'), 'bc' => $bc);
		$this->page_construct('bank/pendingCheque', $this->data); 		
	}

	public function get_pendingCheque(){
		 $this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('bank_pending').".pending_id as bid,
          ".$this->db->dbprefix('bank_pending').".insert_date  as insert_date ,        
          ".$this->db->dbprefix('bank_account').".bank_name as bname,
          ".$this->db->dbprefix('bank_account').".account_name as acname,          
		  ".$this->db->dbprefix('bank_pending').".cheque_no as cheque_no ,		  
		  ".$this->db->dbprefix('bank_pending').".payment_type,		  
		  ".$this->db->dbprefix('suppliers').".name as sname ,
		  ".$this->db->dbprefix('customers').".name as cname ,
		  ".$this->db->dbprefix('bank_pending').".amount as amount ,
		  ".$this->db->dbprefix('bank_pending').".type as type ", FALSE);

         $this->datatables->join('suppliers', 'suppliers.id=bank_pending.supplier_id', 'left');
         $this->datatables->join('bank_account', 'bank_account.bank_account_id=bank_pending.bank_id', 'left');
         $this->datatables->join('customers', 'customers.id=bank_pending.customer_id', 'left'); 

         $this->datatables->from('bank_pending'); 

         if(!$this->Admin){
         	$this->datatables->where('bank_account.store_id',$this->session->userdata('store_id'));
         }
          $this->datatables->where('bank_pending.type', 'pending');
         $this->datatables->group_by('bank_pending.pending_id');
		
         $this->datatables->unset_column('bid');

         $actdata = "<a href='javascript:;' onClick='approveCheque($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>";

         $actdata .= "<a href='" . site_url('bank/ChequeDelete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='Delete Peding Cheque'>
			    <i class='fa fa-trash-o'></i>
			  </a>";

         $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "bid");
		
         echo $this->datatables->generate();
	
	} 

	public function approved_cheque(){ 	
		$this->data['page_title'] = lang('Approved Cheque List');
        $bc = array(array('link' => '#', 'page' => lang(' List')));
        $meta = array('page_title' => lang('Approved Cheque List'), 'bc' => $bc);
		$this->page_construct('bank/approvedCheque', $this->data); 		
	}

	public function get_approvedCheque(){
		 $this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('bank_pending').".pending_id as bid,
          ".$this->db->dbprefix('bank_pending').".insert_date  as insert_date ,
          
          ".$this->db->dbprefix('bank_account').".bank_name as bname,
          ".$this->db->dbprefix('bank_account').".account_name as acname,          
		  ".$this->db->dbprefix('bank_pending').".cheque_no as cheque_no ,	
		   ".$this->db->dbprefix('bank_pending').".payment_type,		  
		  ".$this->db->dbprefix('suppliers').".name as sname ,
		  ".$this->db->dbprefix('customers').".name as cname ,
		  ".$this->db->dbprefix('bank_pending').".amount as amount ,
		  ".$this->db->dbprefix('bank_pending').".type as type ", FALSE);

         $this->datatables->join('suppliers', 'suppliers.id=bank_pending.supplier_id', 'left');
         $this->datatables->join('bank_account', 'bank_account.bank_account_id=bank_pending.bank_id', 'left');
         $this->datatables->join('customers', 'customers.id=bank_pending.customer_id', 'left'); 

         $this->datatables->from('bank_pending'); 

         if(!$this->Admin){
         	$this->datatables->where('bank_account.store_id',$this->session->userdata('store_id'));
         }
         $this->datatables->where('bank_pending.type', 'Approved');
         $this->datatables->group_by('bank_pending.pending_id');
		
         $this->datatables->unset_column('bid');

         $actdata = "<a href='javascript:;' onClick='approveCheque($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>";

         $actdata .= "<a href='" . site_url('bank/ChequeDelete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='Delete Peding Cheque'>
			    <i class='fa fa-trash-o'></i>
			  </a>";

         $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "bid");
		
         echo $this->datatables->generate();
	
	}

	public function pending_loan(){ 	
		$this->data['page_title'] = lang('Bank Loan');
        $bc = array(array('link' => '#', 'page' => lang('Pending loan')));
        $meta = array('page_title' => lang('Pending loan'), 'bc' => $bc);
		$this->page_construct('bank/pending_loan', $this->data); 		
	}

	public function get_pending_loan(){
		 $this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('bank_pending_loan').".id as pid,
          ".$this->db->dbprefix('payloaner').".entry_date ,
          ".$this->db->dbprefix('loaner').".name ,
          ".$this->db->dbprefix('bank_pending_loan') . ".payment_type, 
          ".$this->db->dbprefix('bank_account').".bank_name,          
          ".$this->db->dbprefix('bank_account').".account_name as acname,          
		  ".$this->db->dbprefix('bank_pending_loan').".cheque_or_card_no,	
		  ".$this->db->dbprefix('bank_pending_loan').".type,	 
		  ".$this->db->dbprefix('bank_pending_loan').".amount,		 
		  ".$this->db->dbprefix('bank_pending_loan').".bank_status ", FALSE);

         $this->datatables->join('payloaner', 'payloaner.id=bank_pending_loan.loan_id','left');
         $this->datatables->join('bank_account', 'bank_account.bank_account_id=bank_pending_loan.bank_id','left');
         $this->datatables->join('loaner', 'loaner.id=bank_pending_loan.loner_id','left'); 

         $this->datatables->from('bank_pending_loan'); 

         // if(!$this->Admin){
         // 	$this->datatables->where('bank_account.store_id',$this->session->userdata('store_id'));
         // }
         //$this->datatables->where('bank_pending.type', 'Approved');
         $this->datatables->group_by('bank_pending_loan.id');
		
         $this->datatables->unset_column('pid');

         $actdata = "<a href='javascript:;' onClick='loan_cheque_approve($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>";

         $actdata .= "<a href='" . site_url('bank/loan_cheque_delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='Delete Peding Cheque'>
			    <i class='fa fa-trash-o'></i>
			  </a>";

         $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "pid");
		
         echo $this->datatables->generate();
	
	}
	public function pending_donations(){ 	
		$this->data['page_title'] = lang('Pending donations');
        $bc = array(array('link' => '#', 'page' => lang('Pending donations')));
        $meta = array('page_title' => lang('Pending donations'), 'bc' => $bc);
		$this->page_construct('bank/pending_donations', $this->data); 		
	}

	public function get_pending_donations(){
		$this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('bank_pending_donations').".id as pid, ".
         	$this->db->dbprefix('donations_pay').".entry_date , ".
         	$this->db->dbprefix('donations_persons').".name , ".
         	$this->db->dbprefix('bank_pending_donations').".payment_type, ".
         	$this->db->dbprefix('bank_account').".bank_name,".
         	$this->db->dbprefix('bank_account').".account_name as acname, ".
         	$this->db->dbprefix('bank_pending_donations').".cheque_or_card_no, ".
         	$this->db->dbprefix('bank_pending_donations').".type, ".
         	$this->db->dbprefix('bank_pending_donations').".amount, ".
         	$this->db->dbprefix('bank_pending_donations').".bank_status ", FALSE); 
        $this->datatables->join('donations_pay', 'donations_pay.id=bank_pending_donations.donations_pay_id','left');
        $this->datatables->join('bank_account', 'bank_account.bank_account_id=bank_pending_donations.bank_id','left');
        $this->datatables->join('donations_persons', 'donations_persons.id=bank_pending_donations.donations_persons_id','left'); 
  		$this->datatables->from('bank_pending_donations');  
        $this->datatables->group_by('bank_pending_donations.id');
		$this->datatables->unset_column('pid');
		$actdata = "<a href='javascript:;' onClick='donations_cheque_approve($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>"; 
		$this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "pid");		
        echo $this->datatables->generate();
	
	}	 
	public function approveCheque($id){
		$this->data['info'] = $this->bank_model->getPendingChequeByID($id);
		$this->data['title'] = 'Cheque Approve';
		$this->data['id'] = $id;
		$this->load->view($this->theme.'bank/approveCheque', $this->data,$id);	
	}
	public function chequeApproed($id){
		$bank_id = $this->input->post('bank_id'); 
		$info = $this->bank_model->getPendingChequeByID($id); 

		if($bank_id != $info->bank_id){
			$bankId = $bank_id;
			$this->site->updateQuery('bank_pending', array('bank_id'=>$bankId), array('pending_id'=>$id)); 
		}else{
			$bankId = $info->bank_id;
		}

		$bankInfo = $this->bank_model->getBankByID($bankId);
		 
		 
		$amount = $this->input->post('amount');


		$dataAppr = array( 'type' => $this->input->post('paid_by') );
		
		if($info->payment_type == 1){
			 
			if($this->input->post('paid_by') == 'Approved'){

				if($amount > 0){ 
					$bankTAmount = $bankInfo->current_amount + $this->input->post('amount');
					$bankData = array(
						'current_amount' => $bankTAmount,
						);
					$this->bank_model->editBank($bankData,$bankId);	

					$data = array(
					    'bank_account_id'   => $bankId,
						'tran_amount'  => $this->input->post('amount'),				
						'tran_type'    => 1,				
						'tran_date'    => date('Y-m-d H:i:s'),
						'pedding_cheque' =>	$info->pending_id,		
					);
				
					$this->bank_model->addTranjiction($data) ;	
				} else {				 
					$this->session->set_flashdata('error', lang('Bank Cheque Approve error === 1'));
		            redirect("bank/pendingCheque");
				}
					
			}

			if($this->input->post('paid_by') == 'pending'){
			 	$tranInfo = $this->bank_model->getAlltranjection();

			 	foreach ($tranInfo as $key => $tranin) {
			 		if($tranin->pedding_cheque == $info->pending_id){
			 		$bankTAmount = $bankInfo->current_amount-$this->input->post('amount');
					$bankData = array(
					    'current_amount' => $current_amount + $bankTAmount,
						);
					$delPen = $this->bank_model->deletePeddingChque($info->pending_id);  
					$this->bank_model->editBank($bankData,$bankId);
				}
					 
			 	}		
			
			}
		}else if($info->payment_type == 2){

			if($this->input->post('paid_by')=='Approved'){

				if($amount > 0){ 
					$bankTAmount = $bankInfo->current_amount-$this->input->post('amount');
					$bankData = array(
						'current_amount' => $bankTAmount,
						);
					$this->bank_model->editBank($bankData,$bankId);	

					$data = array(
					    'bank_account_id'   => $bankId,
						'tran_amount'  => $this->input->post('amount'),				
						'tran_type'    => '0',				
						'tran_date'    => date('Y-m-d H:i:s'),
						'pedding_cheque' =>	$info->pending_id,		
					);
				
					$this->bank_model->addTranjiction($data) ;	
				} else {				 
					$this->session->set_flashdata('error', lang('Bank Cheque Approve error'));
		            redirect("bank/pendingCheque");
				}
					
			}

			if($this->input->post('paid_by')=='pending'){
			 	$tranInfo = $this->bank_model->getAlltranjection();

			 	foreach ($tranInfo as $key => $tranin) {
			 		if($tranin->pedding_cheque == $info->pending_id){
			 		$bankTAmount = $bankInfo->current_amount+$this->input->post('amount');
					$bankData = array(
					    'current_amount' => $current_amount + $bankTAmount,
						);
					$delPen = $this->bank_model->deletePeddingChque($info->pending_id);  
					$this->bank_model->editBank($bankData,$bankId);
				}
					 
			 	}		
			
			}
		}

		$this->bank_model->updateChequeByID($dataAppr,$id);	
		 
		redirect('bank/pendingCheque'); 
	
	}
	public function loan_cheque_approve($id){
		$this->data['info'] = $this->site->whereRow('bank_pending_loan', 'id', $id); 
		$this->data['title'] = 'Change Cheque Status';
		$this->data['id'] = $id;
		$this->load->view($this->theme.'bank/loan_approve', $this->data,$id);
	
	}
	public function loan_cheque_approved($id){
		$info = $this->site->whereRow('bank_pending_loan', 'id', $id); 
		$bankId = '';
		$formBank = $this->input->post('bank_id');

		if(!$info->bank_id || $formBank != $info->bank_id){
			$bankId = $formBank;
			$this->site->updateQuery('bank_pending_loan', array('bank_id'=>$formBank), array('id'=>$id)); 
		}else{
			$bankId = $info->bank_id;
		}
		$bankInfo = $this->bank_model->getBankByID($bankId); 
		
		$amount = $info->amount; 
		
		if($this->input->post('paid_by')=='Approved' && $info->type == 'pay'){
				 
			if($amount > 0){  
				$bankTAmount = $bankInfo->current_amount - $amount;
				$bankData = array(
					'current_amount' => $bankTAmount,
					);
				$this->bank_model->editBank($bankData,$bankId);	

				$data = array(
				    'bank_account_id'   => $bankId,
					'tran_amount'  => $amount,				
					'tran_type'    => '1',				
					'tran_date'    => date('Y-m-d H:i:s'),
					'loan_pending_id' =>	$info->id,		
				);
			
				if($this->bank_model->addTranjiction($data)){
					$this->site->updateQuery('bank_pending_loan', array('bank_status'=>'Approved'), array('id'=>$info->id));	
				}
				
			} else {				 
				$this->session->set_flashdata('error', lang('Bank Cheque Approve error'));
	            redirect("bank/pending_loan");
			}
				
		}
		if($this->input->post('paid_by')=='Approved' && $info->type == 'receive'){
				 
			if($amount > 0){  
				$bankTAmount = $bankInfo->current_amount + $amount;
				$bankData = array(
					'current_amount' => $bankTAmount,
					);
				$this->bank_model->editBank($bankData,$bankId);	

				$data = array(
				    'bank_account_id'   => $bankId,
					'tran_amount'  => $amount,				
					'tran_type'    => '1',				
					'tran_date'    => date('Y-m-d H:i:s'),
					'loan_pending_id' =>	$info->id,		
				);
			
				if($this->bank_model->addTranjiction($data)){
					$this->site->updateQuery('bank_pending_loan', array('bank_status'=>'Approved'), array('id'=>$info->id));	
				}
			} else {				 
				$this->session->set_flashdata('error', lang('Bank Cheque Approve error'));
	            redirect("bank/pending_loan");
			}
				
		}
		if($this->input->post('paid_by')=='Pending' && $info->type == 'pay'){
		 	$tranInfo = $this->bank_model->getAlltranjection();

		 	foreach ($tranInfo as $key => $tranin) {
		 		if($tranin->loan_pending_id == $info->id){
			 		$bankTAmount = $bankInfo->current_amount+$tranin->tran_amount;
					$bankData = array(
					    'current_amount' => $bankTAmount,
						);
					$this->bank_model->deletePeddingLoan($info->id);  
					$this->bank_model->editBank($bankData, $bankId);
					$this->site->updateQuery('bank_pending_loan', array('bank_status'=>'Pending'), array('id'=>$info->id));	
				}
				 
		 	}	 
		} 
		if($this->input->post('paid_by')=='Pending' && $info->type == 'receive'){
		 	$tranInfo = $this->bank_model->getAlltranjection();

		 	foreach ($tranInfo as $key => $tranin) {
		 		if($tranin->loan_pending_id == $info->id){
			 		$bankTAmount = $bankInfo->current_amount-$tranin->tran_amount;
					$bankData = array(
					    'current_amount' => $bankTAmount,
						);
					$this->bank_model->deletePeddingLoan($info->id);  
					$this->bank_model->editBank($bankData,$bankId);
					$this->site->updateQuery('bank_pending_loan', array('bank_status'=>'Pending'), array('id'=>$info->id));	
				}
				 
		 	}	 
		} 
		$this->bank_model->updateChequeByID($dataAppr,$id);	
		 
		redirect('bank/pending_loan'); 
	
	}
	public function donations_cheque_approve($id){
		$this->data['info'] = $this->site->whereRow('bank_pending_donations', 'id', $id); 
		$this->data['title'] = 'Change Cheque Status';
		$this->data['id'] = $id;
		$this->load->view($this->theme.'bank/donations_approve', $this->data,$id);	
	}
	
	public function donations_cheque_approved($id){
		$info = $this->site->whereRow('bank_pending_donations', 'id', $id); 
		$bankId = '';
		$formBank = $this->input->post('bank_id');
		if(!$info->bank_id || $formBank != $info->bank_id){
			$bankId = $formBank;
			$this->site->updateQuery('bank_pending_donations', array('bank_id'=>$formBank), array('id'=>$id)); 
		}else{
			$bankId = $info->bank_id;
		}
		$bankInfo = $this->bank_model->getBankByID($bankId); 		
		$amount = $info->amount;		
		if($this->input->post('paid_by')=='Approved'){ 
			if($amount > 0){  
				$bankTAmount = $bankInfo->current_amount - $amount;
				$bankData = array(
					'current_amount' => $bankTAmount,
					);
				$this->bank_model->editBank($bankData,$bankId);	
				$data = array(
				    'bank_account_id' => $bankId,
					'tran_amount'  => $amount,				
					'tran_type'    => '0',				
					'tran_date'    => date('Y-m-d H:i:s'),	
				);			
				if($traid = $this->site->insertQuery('tranjiction',$data)){
					$this->site->updateQuery('bank_pending_donations', array('bank_status'=>'Approved','transactions_id'=>$traid), array('id'=>$info->id));	
				}				
			} else { 
				$this->session->set_flashdata('error', lang('Bank Cheque Approve error'));
	            redirect("bank/pending_donations");
			}				
		} 
		if($this->input->post('paid_by')=='Pending'){ 
		 	$tranInfo = $this->site->whereRow('tranjiction','tranjiction_id',$info->transactions_id);
		 	if($tranInfo->tranjiction_id == $info->transactions_id){
		 		$bankTAmount = ($bankInfo->current_amount+$tranInfo->tran_amount);
				$bankData = array(
				    'current_amount' => $bankTAmount
				);
				$this->site->updateQuery('bank_account',$bankData, array('bank_account_id'=>$bankId));
				$this->site->deleteQuery('tranjiction',array('id' => $info->transactions_id)); 		
				$this->site->updateQuery('bank_pending_donations', array('bank_status'=>'Pending','transactions_id'=>NULL), array('id'=>$info->id)); 
			}
		}		 
		redirect('bank/pending_donations'); 
	
	}

	public function loan_cheque_delete($id)
	{
		$info = $this->site->whereRow('bank_pending_loan', 'id', $id); 
		$bankInfo = $this->bank_model->getBankByID($info->bank_id); 

		if($info->bank_status =='Approved' &&  $info->type == 'pay'){
			$tranInfo = $this->bank_model->getAlltranjection();
			foreach ($tranInfo as $key => $tranin) {
		 		if($tranin->loan_pending_id == $info->id){
			 		$bankTAmount = $bankInfo->current_amount+$tranin->tran_amount;
					$bankData = array(
					    'current_amount' => $bankTAmount,
						);
					$this->bank_model->deletePeddingLoan($info->id);  
					$this->bank_model->editBank($bankData, $info->bank_id);
					if($this->site->deleteQuery('bank_pending_loan', array('id'=>$info->id))){
						$this->session->set_flashdata('message', lang('Cheque deleted'));
	            		redirect("bank/pending_loan");
					}
				}
				 
		 	}	
		}
		if($info->bank_status =='Approved' &&  $info->type == 'receive'){
			$tranInfo = $this->bank_model->getAlltranjection();
			foreach ($tranInfo as $key => $tranin) {
		 		if($tranin->loan_pending_id == $info->id){
			 		$bankTAmount = $bankInfo->current_amount-$tranin->tran_amount;
					$bankData = array(
					    'current_amount' => $bankTAmount,
						);
					$this->bank_model->deletePeddingLoan($info->id);  
					$this->bank_model->editBank($bankData,$info->bank_id);
					if($this->site->deleteQuery('bank_pending_loan', array('id'=>$info->id))){
						$this->session->set_flashdata('message', lang('Cheque deleted'));
	            		redirect("bank/pending_loan");
					}
				}
				 
		 	}
		}

		if($info->bank_status =='Pending'){
			if($this->site->deleteQuery('bank_pending_loan', array('id'=>$info->id))){
				$this->session->set_flashdata('message', lang('Cheque deleted'));
	            redirect("bank/pending_loan");	 
			}
			 	
		}
		 

	}


	public function ChequeDelete($id){
		$info = $this->bank_model->getPendingChequeByID($id);
		$bankInfo = $this->bank_model->getBankByID($info->bank_id);
		if($info->type =='Approved'){
			if($info->payment_type ==2){
				$tranInfo = $this->bank_model->getAlltranjection();			 
			 	foreach ($tranInfo as $key => $tranin) {
			 		if($tranin->pedding_cheque == $info->pending_id){		 			
				 		$bankTAmount = $bankInfo->current_amount+$info->amount;		 		 
						$bankData = array(
						    'current_amount' => $bankTAmount,
							);
						$delPen = $this->bank_model->deletePeddingChque($info->pending_id);  
						$this->bank_model->editBank($bankData,$info->bank_id);
					}				 
			 	}
			}
			if($info->payment_type ==1){
				$tranInfo = $this->bank_model->getAlltranjection();			 
			 	foreach ($tranInfo as $key => $tranin) {
			 		if($tranin->pedding_cheque == $info->pending_id){		 			
				 		$bankTAmount = $bankInfo->current_amount-$info->amount;		 		 
						$bankData = array(
						    'current_amount' => $bankTAmount,
							);
						$delPen = $this->bank_model->deletePeddingChque($info->pending_id);  
						$this->bank_model->editBank($bankData,$info->bank_id);
					}				 
			 	}
			}
			
		} 
		$this->bank_model->ChequeDelete($id);
		redirect('bank/pendingCheque'); 
	}
	public function pending_salary(){ 	
		$this->data['page_title'] = lang('Pending Salary');
        $bc = array(array('link' => '#', 'page' => lang('Pending Salary')));
        $meta = array('page_title' => lang('Pending Salary'), 'bc' => $bc);
		$this->page_construct('bank/pending_salary', $this->data); 		
	}

	public function get_pending_salary(){
		$this->load->library('datatables'); 
        $this->datatables->select($this->db->dbprefix('bank_pending_salary').".id as pid, ". 
        	$this->db->dbprefix('paysalary').".pay_date, ".
         	$this->db->dbprefix('employee').".name , ".
         	$this->db->dbprefix('bank_pending_salary').".payment_type, ".
         	$this->db->dbprefix('bank_account').".bank_name,".
         	$this->db->dbprefix('bank_account').".account_name as acname, ".
         	$this->db->dbprefix('bank_pending_salary').".cheque_or_card_no, ".
         	$this->db->dbprefix('bank_pending_salary').".type, ".
         	$this->db->dbprefix('bank_pending_salary').".amount, ".
         	$this->db->dbprefix('bank_pending_salary').".bank_status ", FALSE); 
        $this->datatables->join('paysalary', 'paysalary.pay_id=bank_pending_salary.paysalary_id','left');
        $this->datatables->join('bank_account', 'bank_account.bank_account_id=bank_pending_salary.bank_id','left');
        $this->datatables->join('employee', 'employee.id=bank_pending_salary.employee_id','left'); 
  		$this->datatables->from('bank_pending_salary');  
        $this->datatables->group_by('bank_pending_salary.id');
		$this->datatables->unset_column('pid');
		$actdata = "<a href='javascript:;' onClick='salary_cheque_approve($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>"; 
		$this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "pid");		
        echo $this->datatables->generate();	
	}
	public function salary_cheque_approve($id){
		$this->data['info'] = $this->site->whereRow('bank_pending_salary', 'id', $id); 
		$this->data['title'] = 'Change Cheque Status';
		$this->data['id'] = $id;
		$this->load->view($this->theme.'bank/salary_approve', $this->data,$id);	
	}
	
	public function salary_cheque_approved($id){
		$info = $this->site->whereRow('bank_pending_salary', 'id', $id); 
		$bankId = '';
		$formBank = $this->input->post('bank_id');
		if(!$info->bank_id || $formBank != $info->bank_id){
			$bankId = $formBank;
			$this->site->updateQuery('bank_pending_salary', array('bank_id'=>$formBank), array('id'=>$id)); 
		}else{
			$bankId = $info->bank_id;
		}
		$bankInfo = $this->bank_model->getBankByID($bankId); 		
		$amount = $info->amount;		
		if($this->input->post('paid_by')=='Approved'){ 
			if($amount > 0){  
				$bankTAmount = $bankInfo->current_amount - $amount;
				$bankData = array(
					'current_amount' => $bankTAmount,
					);
				$this->bank_model->editBank($bankData,$bankId);	
				$data = array(
				    'bank_account_id' => $bankId,
					'tran_amount'  => $amount,				
					'tran_type'    => '0',				
					'tran_date'    => date('Y-m-d H:i:s'),	
				);			
				if($traid = $this->site->insertQuery('tranjiction',$data)){
					$this->site->updateQuery('bank_pending_salary', array('bank_status'=>'Approved','transactions_id'=>$traid), array('id'=>$info->id));	
				}				
			} else { 
				$this->session->set_flashdata('error', lang('Bank Cheque Approve error'));
	            redirect("bank/pending_salary");
			}				
		} 
		if($this->input->post('paid_by')=='Pending'){ 
		 	$tranInfo = $this->site->whereRow('tranjiction','tranjiction_id',$info->transactions_id);
		 	if($tranInfo->tranjiction_id == $info->transactions_id){
		 		$bankTAmount = ($bankInfo->current_amount+$tranInfo->tran_amount);
				$bankData = array(
				    'current_amount' => $bankTAmount
				);
				$this->site->updateQuery('bank_account',$bankData, array('bank_account_id'=>$bankId));
				$this->site->deleteQuery('tranjiction',array('tranjiction_id' => $info->transactions_id));	
				$this->site->updateQuery('bank_pending_salary', array('bank_status'=>'Pending','transactions_id'=>NULL), array('id'=>$info->id)); 
			}
		}		 
		redirect('bank/pending_salary'); 	
	}
	public function pending_expenses(){ 
		$this->data['page_title'] = lang('Pending Salary');
        $bc = array(array('link' => '#', 'page' => lang('Pending Salary')));
        $meta = array('page_title' => lang('Pending Salary'), 'bc' => $bc);
		$this->page_construct('bank/pending_expenses', $this->data); 		
	}

	public function get_pending_expenses(){
		$this->load->library('datatables'); 
        $this->datatables->select($this->db->dbprefix('bank_pending_expenses').".id as pid, ". 
        	$this->db->dbprefix('expenses').".date, ".
         	$this->db->dbprefix('expens_category').".name, ".
         	$this->db->dbprefix('bank_pending_expenses').".payment_type, ".
         	$this->db->dbprefix('bank_account').".bank_name,".
         	$this->db->dbprefix('bank_account').".account_name as acname, ".
         	$this->db->dbprefix('bank_pending_expenses').".cheque_or_card_no, ".
         	$this->db->dbprefix('bank_pending_expenses').".type, ".
         	$this->db->dbprefix('bank_pending_expenses').".amount, ".
         	$this->db->dbprefix('bank_pending_expenses').".bank_status ", FALSE); 
        $this->datatables->join('expens_category', 'expens_category.cat_id=bank_pending_expenses.expens_category_id','left');
        $this->datatables->join('bank_account', 'bank_account.bank_account_id=bank_pending_expenses.bank_id','left');
        $this->datatables->join('expenses', 'expenses.id=bank_pending_expenses.expenses_id','left'); 
  		$this->datatables->from('bank_pending_expenses');  
        $this->datatables->group_by('bank_pending_expenses.id');
		$this->datatables->unset_column('pid');
		$actdata = "<a href='javascript:;' onClick='expenses_cheque_approve($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>"; 
		$this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "pid");		
        echo $this->datatables->generate();	
	}
	public function expenses_cheque_approve($id){
		$this->data['info'] = $this->site->whereRow('bank_pending_expenses', 'id', $id); 
		$this->data['title'] = 'Change Cheque Status';
		$this->data['id'] = $id;
		$this->load->view($this->theme.'bank/expenses_approve', $this->data,$id);	
	}
	
	public function expenses_cheque_approved($id){
		$info = $this->site->whereRow('bank_pending_expenses', 'id', $id); 
		$bankId = '';
		$formBank = $this->input->post('bank_id');
		if(!$info->bank_id || $formBank != $info->bank_id){
			$bankId = $formBank;
			$this->site->updateQuery('bank_pending_expenses', array('bank_id'=>$formBank), array('id'=>$id)); 
		}else{
			$bankId = $info->bank_id;
		}
		$bankInfo = $this->bank_model->getBankByID($bankId); 		
		$amount = $info->amount;		
		if($this->input->post('paid_by')=='Approved'){ 
			if($amount > 0){  
				$bankTAmount = $bankInfo->current_amount - $amount;
				$bankData = array(
					'current_amount' => $bankTAmount,
					);
				$this->bank_model->editBank($bankData,$bankId);	
				$data = array(
				    'bank_account_id' => $bankId,
					'tran_amount'  => $amount,				
					'tran_type'    => '0',				
					'tran_date'    => date('Y-m-d H:i:s'),	
				);			
				if($traid = $this->site->insertQuery('tranjiction',$data)){
					$this->site->updateQuery('bank_pending_expenses', array('bank_status'=>'Approved','transactions_id'=>$traid), array('id'=>$info->id));	
				}				
			} else { 
				$this->session->set_flashdata('error', lang('Bank Cheque Approve error'));
	            redirect("bank/pending_expenses");
			}				
		} 
		if($this->input->post('paid_by')=='Pending'){ 
		 	$tranInfo = $this->site->whereRow('tranjiction','tranjiction_id',$info->transactions_id);
		 	if($tranInfo->tranjiction_id == $info->transactions_id){
		 		$bankTAmount = ($bankInfo->current_amount+$tranInfo->tran_amount);
				$bankData = array(
				    'current_amount' => $bankTAmount
				);
				$this->site->updateQuery('bank_account',$bankData, array('bank_account_id'=>$bankId));
				$this->site->deleteQuery('tranjiction',array('tranjiction_id' => $info->transactions_id));
				$this->site->updateQuery('bank_pending_expenses', array('bank_status'=>'Pending','transactions_id'=>NULL), array('id'=>$info->id)); 
			}
		}		 
		redirect('bank/pending_expenses'); 	
	}

}

