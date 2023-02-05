<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends MY_Controller

{
    function __construct() {

        parent::__construct();

        if (!$this->loggedIn) {

            redirect('login');

        }

        $this->load->library('form_validation');

        $this->load->model('employee_model');
		
		$this->load->model('purchases_model');

		$this->load->model('categories_model');

    }

    function index()  {

    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    	$this->data['page_title'] = 'Employee';

    	$bc = array(array('link' => '#', 'page' => 'Employee'));

    	$meta = array('page_title' => 'Employee', 'bc' => $bc);

    	$this->page_construct('employee/index', $this->data, $meta);

    }

    function get_employee() {

    	$this->load->library('datatables');

    	/*$this->datatables->select("id, name, phone, email, position, basic_salary");*/

    	$this->datatables->select($this->db->dbprefix('employee') . ".id as id,".
    		$this->db->dbprefix('employee') . ".name, ".    		
    		$this->db->dbprefix('employee') . ".phone, ".
    		$this->db->dbprefix('stores') . ".name as storename, ".
    		$this->db->dbprefix('employee') . ".email, ".    		
    		$this->db->dbprefix('employee') . ".position, ".
    		$this->db->dbprefix('employee') . ".basic_salary,", FALSE);
        
       $this->datatables->join('stores', 'employee.store_id=stores.id');

    	$this->datatables->from("employee");
    
    	$this->datatables->add_column("Actions", "
			<div class='text-center'><div class='btn-group'>
			
			  <a onclick=\"window.open('".site_url('employee/view/$1')."', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print pay salary ' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> 
			 
			 <a href='javascript:;' onClick='payLisy($1)'  class='tip btn btn-warning btn-xs'  title='Pay Salary list'>
			      <i class='fa fa-list'></i>
			  </a>
			  
			  <a href='" . site_url('employee/edit/$1') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("edit_employee")."'>
			      <i class='fa fa-edit'></i>
			  </a>
			  <a href='javascript:;' onClick='addPay($1)' class='tip btn btn-warning btn-xs' title='Pay Salary'>
			      <i class='fa fa-briefcase'></i>
			  </a>
		      <a href='" . site_url('employee/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("delete_employee")."'>
			    <i class='fa fa-trash-o'></i>
			  </a>
			  
			  </div></div>", "id");
    	if(!$this->Admin){
    		$this->datatables->where('store_id',$this->session->userdata('store_id'));
    	}

    	$this->datatables->unset_column('id');
    	
    	echo $this->datatables->generate();

    }
	function view($id){
		
		
		$this->data['emplyee'] = $this->employee_model->getEmplyeeByID($id);
		
		$this->data['list'] = $this->employee_model->getPaysalary($id);
		
        $this->data['page_title'] = 'Employee pay salarys ';
        $this->data['pay'] = array();
		
        $this->load->view($this->theme.'employee/view', $this->data);
		
		}

    function add() {		

		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
		
		$this->form_validation->set_rules('father_name', 'Father\'s Name', 'required');
		
		$this->form_validation->set_rules('mather_name', 'Mather\'s Name', 'required');

		$this->form_validation->set_rules('mather_name', 'Mather\'s Name', 'required');
		
		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'required|valid_email');
		
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		
		$this->form_validation->set_rules('position', 'Position', 'required');

		if ($this->form_validation->run() == true) { 
			
			$data = array('name' => $this->input->post('name'),

				'email'		 => $this->input->post('email'),
				
				'father_name'   => $this->input->post('father_name'),
				
				'mather_name'   => $this->input->post('mather_name'),
				
				'date_of_birth' => $this->input->post('date_of_birth'),
				
				'position'      => $this->input->post('position'),
				
				'address'       => $this->input->post('address'),
				
				'email'         => $this->input->post('email'),
				
				'basic_salary'  => $this->input->post('basic_salary'),
				
				'join_date'     => $this->input->post('join_date'), 

				'phone' 		 => $this->input->post('phone')

			);
			if(($this->session->userdata('store_id') !=0) && ($this->session->userdata('store_id') !='')){
				$data['store_id'] = $this->session->userdata('store_id');
			}else{
				$data['store_id'] = $this->input->post('warehouse');
			}

		}

		if ( $this->form_validation->run() == true && $cid = $this->employee_model->addEmployee($data)) {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'success', 'msg' =>  $this->lang->line("customer_added"), 'id' => $cid, 'val' => $data['name']));

                die();

            }

            $this->session->set_flashdata('message', $this->lang->line("customer_added"));

            redirect("employee");

		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }
			$date['submit_button'] = "Add Employee";
			
			$this->data['action'] = "employee/add" ;

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = 'Add Employee';

    		$bc = array(array('link' => site_url('Add Employee'), 'page' => 'Employee'), array('link' => '#', 'page' => 'Add Employee'));

    		$meta = array('page_title' => 'Add employee', 'bc' => $bc);

    		$this->data['warehouses'] = $this->site->getAllStores(); 

    		$this->page_construct('employee/form', $this->data, $meta);

		}

	}


	function edit($id = NULL){
        if ((!$this->Admin) && (!$this->Manager)) {
            $this->session->set_flashdata('error', $this->lang->line('access_denied'));
            redirect('pos');
        }
		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');		
		$this->form_validation->set_rules('father_name', 'Father\'s Name', 'required');		
		$this->form_validation->set_rules('mather_name', 'Mather\'s Name', 'required');
		$this->form_validation->set_rules('mather_name', 'Mather\'s Name', 'required');		
		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'required|valid_email');		
		$this->form_validation->set_rules('phone', 'Phone', 'required');		
		$this->form_validation->set_rules('position', 'Position', 'required');
		if ($this->form_validation->run() == true) { 			
			$data = array(
				'name' => $this->input->post('name'),
				'email'		 => $this->input->post('email'),				
				'father_name'   => $this->input->post('father_name'),				
				'mather_name'   => $this->input->post('mather_name'),				
				'date_of_birth' => $this->input->post('date_of_birth'),				
				'position'      => $this->input->post('position'),				
				'address'       => $this->input->post('address'),				
				'email'         => $this->input->post('email'),				
				'basic_salary'  => $this->input->post('basic_salary'),				
				'join_date'     => $this->input->post('join_date'), 
				'phone' 		 => $this->input->post('phone')
			);
			if(($this->session->userdata('store_id') !=0) && ($this->session->userdata('store_id') !='')){
				$data['store_id'] = $this->session->userdata('store_id');
			}else{
				$data['store_id'] = $this->input->post('warehouse');
			}
		}
		if($this->form_validation->run() == true && $cid = $this->employee_model->editEmployee($data,$id)) {
            if($this->input->is_ajax_request()) {
                echo json_encode(array('status' => 'success', 'msg' =>  $this->lang->line("customer_added"), 'id' => $cid, 'val' => $data['name']));
                die();
            }
            $this->session->set_flashdata('message', $this->lang->line("customer_added"));
            redirect("employee/edit/".$id);
		} else {
            if($this->input->is_ajax_request()) {
                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();
            }			
			$date['submit_button'] = "Update Employee";			
			$this->data['action'] = "employee/edit/".$id;			
			$this->data['emplyee'] = $this->employee_model->getEmplyeeByID($id);
			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
    		$this->data['page_title'] = 'Edit employee';
    		$bc = array(array('link' => site_url('employee'), 'page' => 'Employee'), array('link' => '#', 'page' => 'Edit employee'));
    		$meta = array('page_title' => 'Edit employee', 'bc' => $bc);
    		$this->data['warehouses'] = $this->site->getAllStores(); 
    		$this->page_construct('employee/form', $this->data, $meta);
		}

	}

    function payLisy($id){		
	    $this->load->helper('security');	
	    if((!$this->Admin) && (!$this->Manager)){
            $this->session->set_flashdata('error', $this->lang->line('access_denied'));
            redirect('pos');
        	}	
		$this->data['list'] = $this->employee_model->getPaysalary($id);		
		$this->data['emplyee'] = $this->employee_model->getEmplyeeByID($id);
		//$this->page_construct('employee/paylisy', $this->data);
		$this->load->view($this->theme . 'employee/paylisy',$this->data);  
	
	}
	
    function paySalary($id){	
	    if((!$this->Admin) && (!$this->Manager)){
            $this->session->set_flashdata('error', $this->lang->line('access_denied'));
            redirect('pos');
        }		
		if($id == NULL){			
			 redirect('pos');
		}		
		$this->form_validation->set_rules('month_id', 'Month', 'required');		
		$this->form_validation->set_rules('amount', 'amount', 'required');	
		if ($this->form_validation->run() == true) { 
			$payment_type = $this->input->post('type');
			$data = array(
			    'emp_id'        => $id,
				'month_id'	    => $this->input->post('month_id'),				
				'paid_by'       => $this->input->post('type'),
				'amount'        => $this->input->post('amount'),				
				'commission'    => $this->input->post('commission'),				
				'note'          => $this->input->post('note'),				
				'year'          => $this->input->post('year'),
				'store_id'		=> $this->input->post('store_id'),				
			);
			
			$emp_pay_id = $this->employee_model->paySalary($data);
			if(($payment_type == 'cheque') || ($payment_type == 'card')){
                $bankPending = array(
                    'paysalary_id' => $emp_pay_id,
                    'employee_id'  => $id,
                    'bank_id'      => $this->input->post('bank'),
                    'payment_type' => $this->input->post('type'),
                    'type'         => 'pay', 
                    'bank_status'  => 'Pending',
                    'cheque_or_card_no' => $this->input->post('cheque_no'),
                    'amount'       => $this->input->post('amount'),
                    'created_by'   => $this->session->userdata('user_id') 
                );
                $this->site->insertQuery('bank_pending_salary', $bankPending); 
				
				$bankPending = array(
					'amount'       => $this->input->post('amount'),
					'bank_id'      => $this->input->post('bank'),
					'insert_date'  => date('Y-m-d H:i:s'),
					'type'         => 'pending',
					'cheque_no'    => $this->input->post('cheque_no'),
					'store_id'     => $this->input->post('store_id'),
					'payment_type' =>  4,
				);
				
				$this->site->insertQuery('bank_pending',$bankPending);
            } 			
 			$date = date('Y-m-d H:i:s');
			$emplyee_name = $this->employee_model->getEmplyeeByID($id)->name;
			$emplyee_name = strtolower(trim($emplyee_name));
			$emplyee_name = str_replace(' ','_',$emplyee_name);

			$this->data['categories'] = $this->employee_model->getAllCategories(); 
			$catID ='';
			foreach ($this->data['categories'] as $key => $value) {
				$namesalery = $value->name;
				if(($namesalery =='salary') || ($namesalery =='Salary')) {
					$catID = $value->cat_id;
						break;
					}					
				} 
				if($catID !=''){
					 $catID = $catID;
				} else {
					$data = array(
						'code' =>'Salary',
						'name' =>'Salary',
						);
					$catID = $this->categories_model->addExpCategory($data);
				}
			
			  $data = array(
                'date' => $date,
                'reference' => $this->input->post('year').'-'.$this->input->post('month_id').'-'.$emplyee_name,
                'amount' => $this->input->post('amount')+$this->input->post('commission'),
                'created_by' => $this->session->userdata('user_id'),				
				'emp_pay_id' => $emp_pay_id,
				'c_id' => $catID,
				'store_id'	=> $this->input->post('store_id'),
            );			
			$this->purchases_model->addExpense($data);			
			redirect("employee");
		}			
		$this->data['action'] = 'employee/paySalary/'.$id ;		
		$this->data['emplyee'] = $this->employee_model->getEmplyeeByID($id);
		$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		//$this->page_construct('employee/paysalary', $this->data);
		$this->load->view($this->theme . 'employee/paysalary',$this->data);	
	}
	
	function paySalaryEtdit($id){		
	    if((!$this->Admin) && (!$this->Manager)){
            $this->session->set_flashdata('error', $this->lang->line('access_denied'));
            redirect('pos');
        }		
		if($id == NULL){			
			redirect('pos');
		}	
		$paysalary = $this->site->whereRow('paysalary','pay_id',$id);
	   	$this->data['paySalary'] = $this->employee_model->paySalarySingel($id);		
	   	$this->form_validation->set_rules('month_id', 'Month', 'required');		
		$this->form_validation->set_rules('amount', 'amount', 'required');
		if ($this->form_validation->run() == true) { 
			if(($paysalary->paid_by =='cheque') || ($paysalary->paid_by =='card')){
				$this->session->set_flashdata('error', $this->lang->line('Please delete this than again entry this data! (if paid by cheque or card)'));
	            redirect('employee');
			}
			$payment_type = $this->input->post('type');			
			$data = array(			
				'month_id'	    => $this->input->post('month_id'),				
				'amount'        => $this->input->post('amount'),				
				'commission'    => $this->input->post('commission'),				
				'note'          => $this->input->post('note'),				
				'year'          => $this->input->post('year'),
			);			
			$this->employee_model->paySalaryUpdate($data,$id);
			if(($payment_type == 'cheque') || ($payment_type == 'card')){
                $bankPending = array(
                    'paysalary_id' => $emp_pay_id,
                    'employee_id'  => $id,
                    'bank_id'      => $this->input->post('bank'),
                    'payment_type' => $this->input->post('type'),
                    'type'         => 'pay', 
                    'bank_status'  => 'Pending',
                    'cheque_or_card_no' => $this->input->post('cheque_or_card_no'),
                    'amount'       => $this->input->post('amount'),
                    'created_by'   => $this->session->userdata('user_id') 
                );
                $this->site->insertQuery('bank_pending_salary', $bankPending); 
            }
			$emplyee_name = $this->employee_model->getEmplyeeByID($this->data['paySalary']->emp_id)->name;
			$emplyee_name = strtolower(trim($emplyee_name));
			$emplyee_name = str_replace(' ','_',$emplyee_name);			
			$dataExpense = array(
                'reference' => $this->input->post('year').'-'.$this->input->post('month_id').'-'.$emplyee_name,
                'amount' => $this->input->post('amount') + $this->input->post('commission'),
            );
			$this->employee_model->updateSalaryExpense($dataExpense,$id);
			redirect("employee");
		}
		$this->data['action'] = 'employee/paySalaryEtdit/'.$id;	 
    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$this->load->view($this->theme . 'employee/paysalaryedit.php',$this->data);  
	 }
	 
	function delete($id = NULL){

		if(DEMO) {

			$this->session->set_flashdata('error', $this->lang->line("disabled_in_demo"));

			redirect('pos');

		}

		if($this->input->get('id')) { $id = $this->input->get('id', TRUE); }

		if((!$this->Admin) && (!$this->Manager)){

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('pos');

		}

		if ( $this->employee_model->deleteEmployee($id) ) {

			$this->session->set_flashdata('message', 'Employee deleted ');

			redirect("employee");

		}

	}

    function paySalarydelete($id){
		if(DEMO) {
			$this->session->set_flashdata('error', $this->lang->line("disabled_in_demo"));
			redirect('pos');
		}
		if((!$this->Admin) && (!$this->Manager)){
			$this->session->set_flashdata('error', lang("access_denied"));
			redirect('pos');
		}
		$paysalary = $this->site->whereRow('paysalary', 'pay_id', $id); 
		if ( $this->employee_model->paySalarydelete($id)) {	
			$pending = $this->site->whereRow('bank_pending_salary', 'paysalary_id', $id); 	
			if($pending){	              
	            if($pending->bank_status =='Approved'){
	                $transactions = $this->site->whereRow('tranjiction','tranjiction_id',$pending->transactions_id);  
	                $bank = $this->site->whereRow('bank_account', 'bank_account_id',$transactions->bank_account_id);  
	                $bkbalance = array('current_amount' => ($bank->current_amount + $transactions->tran_amount)); 
	                $this->site->updateQuery('bank_account',$bkbalance,array('bank_account_id'=>$bank->bank_account_id));
	                $this->site->deleteQuery('tranjiction',array('tranjiction_id' => $pending->transactions_id)); 
	            }
	            $this->site->deleteQuery('bank_pending_salary',array('paysalary_id' => $id)); 
	            $this->session->set_flashdata('message','Salary amount delete successfully'); 
	        } 
			redirect("employee");
		}
	}
}

