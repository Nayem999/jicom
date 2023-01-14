<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends MY_Controller

{
    function __construct() {

        parent::__construct();

        if (!$this->loggedIn) {

            redirect('login');

        }

        $this->load->library('form_validation');

        $this->load->model('partner_model');
		
		$this->load->model('purchases_model');

		$this->load->model('categories_model');

    }

    function index()  {

    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    	$this->data['page_title'] = 'Partner';

    	$bc = array(array('link' => '#', 'page' => 'Partner'));

    	$meta = array('page_title' => 'Partner', 'bc' => $bc);

    	$this->page_construct('partner/index', $this->data, $meta);

    }

    function get_partner() {

    	$this->load->library('datatables');

    	$this->datatables

    	->select("id, name, phone, email, partner_part")

    	->from("partner")
    
    		->add_column("Actions", "
			<div class='text-center'><div class='btn-group'>			
			  <a onclick=\"window.open('".site_url('partner/view/$1')."', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print lift part profits' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> 
			 
			  <a href='javascript:;' onClick='liftProfitlist($1)'  class='tip btn btn-warning btn-xs'  title='Lift Part profits list'>
			      <i class='fa fa-list'></i>
			  </a>
			  
			  <a href='" . site_url('partner/edit/$1') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("edit_partner")."'>
			      <i class='fa fa-edit'></i>
			  </a>
			  <a href='javascript:;' onClick='liftProfit($1)' class='tip btn btn-warning btn-xs' title='Lift Part profits'>
			      <i class='fa fa-briefcase'></i>
			  </a>
		      <a href='" . site_url('partner/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("delete_employee")."'>
			    <i class='fa fa-trash-o'></i>
			  </a>
			  
			  </div></div>", "id")

    	->unset_column('id');

    	echo $this->datatables->generate();

    }
	function view($id){		
		
		$this->data['partner'] = $this->partner_model->getPartnerByID($id);
		
		$this->data['list'] = $this->partner_model->getLiftprofit($id);
		
        $this->data['page_title'] = 'Lift Part of the profits ';
		
        $this->load->view($this->theme.'partner/view', $this->data);
		
		}

    function add() {	 	

		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
		
		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'required|valid_email');
		
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		
		$this->form_validation->set_rules('partner_part', 'Partner part', 'required');

		if ($this->form_validation->run() == true) { 
			
			$data = array('name' => $this->input->post('name'),

				'email'		 => $this->input->post('email'), 
				
				'address'       => $this->input->post('address'),
				
				'email'         => $this->input->post('email'),
				
				'partner_part'  => $this->input->post('partner_part'),
				
				'join_date'     => date("Y-m-d H:i:s"),

				'phone' 		 => $this->input->post('phone')

			);
		}

		if ( $this->form_validation->run() == true && $cid = $this->partner_model->addPartner($data)) {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'success', 'msg' =>  $this->lang->line("customer_added"), 'id' => $cid, 'val' => $data['name']));

                die();

            }

            $this->session->set_flashdata('message', $this->lang->line("customer_added"));

            redirect("partner");

		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }
			$date['submit_button'] = "Add Partner";
			
			$data['action'] = "partner/add" ;

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = 'Add Partner';

    		$bc = array(array('link' => site_url('Add Partner'), 'page' => 'Partner'), array('link' => '#', 'page' => 'Add Partner'));

    		$meta = array('page_title' => 'Add Partner', 'bc' => $bc);

    		$this->page_construct('partner/form', $this->data, $meta);

		}

	}


	function edit($id = NULL){		

        if (!$this->Admin) {

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');

        }

		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required'); 
		
		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'required|valid_email');
		
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		
		$this->form_validation->set_rules('partner_part', 'Partner Part', 'required');

		if ($this->form_validation->run() == true) { 
			
			$data = array('name' => $this->input->post('name'),

				'email'		 => $this->input->post('email'),
				
				'address'       => $this->input->post('address'), 
				
				'partner_part'  => $this->input->post('partner_part'), 

				'phone' 		 => $this->input->post('phone')

			);

		}

		if ( $this->form_validation->run() == true && $cid = $this->partner_model->editPartner($data,$id)) {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'success', 'msg' =>  $this->lang->line("partner_added"), 'id' => $cid, 'val' => $data['name']));

                die();

            }

            $this->session->set_flashdata('message', $this->lang->line("partner_added"));

            redirect("partner");



		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }
			
			$data['action'] = "partner/edit/".$id ;
			
			$date['submit_button'] = "Update Employee";
			
			$this->data['emplyee'] = $this->partner_model->getPartnerByID($id);

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = 'Edit employee';

    		$bc = array(array('link' => site_url('employee'), 'page' => 'Employee'), array('link' => '#', 'page' => 'Edit employee'));

    		$meta = array('page_title' => 'Edit employee', 'bc' => $bc);

    		$this->page_construct('partner/form', $this->data, $meta);

		}

	}

    function liftProfitlist($id){
		
	    $this->load->helper('security');
	
	    if (!$this->Admin) {

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');

        }
	
			$this->data['list'] = $this->partner_model->getLiftprofit($id);			
			
			$this->data['emplyee'] = $this->partner_model->getPartnerByID($id); 

			$this->load->view($this->theme . 'partner/liftProfitlist',$this->data);  
	
	}
	
    function liftProfit($id){
	
	    if (!$this->Admin) {

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');

        }
		
		if($id == NULL){
			
			 redirect('pos');
		}
		
		$this->form_validation->set_rules('month_id', 'Month', 'required');
		
		$this->form_validation->set_rules('amount', 'amount', 'required');		

		if ($this->form_validation->run() == true) { 
			
			$data = array(
			    'partner_id'        => $id,

				'month_id'	  => $this->input->post('month_id'),
				
				'amount'        => $this->input->post('amount'),
				
				'note'          => $this->input->post('note'),
				
				'year'          => $this->input->post('year'), 
				
			);
			
			$par_id = $this->partner_model->payProfit($data) ;
			
 			$date = date('Y-m-d H:i:s');

			$emplyee_name = $this->partner_model->getPartnerByID($id)->name;
			$emplyee_name = strtolower(trim($emplyee_name));
			$emplyee_name = str_replace(' ','_',$emplyee_name);

			$this->data['categories'] = $this->partner_model->getAllCategories(); 
			$catID = '';
			foreach ($this->data['categories'] as $key => $value) {
				if(($value->name=='Partner') || ($value->name =='partner')){
					$catID = $value->cat_id;
						break;
					}					
				}
				if($catID !=''){
					$catID = $catID;
				} else {
					$data = array(
						'code' =>'Partner',
						'name' =>'Partner',
						);
				$catID = $this->categories_model->addExpCategory($data); 
				 }
			
			  $data = array(

                'date' => $date,

                'reference' => $this->input->post('year').'-'.$this->input->post('month_id').'-'.$emplyee_name,

                'amount' => $this->input->post('amount'),

                'created_by' => $this->session->userdata('user_id'),
				
				'partner_id' => $par_id,

				'c_id' => $catID

            );
			
			$this->purchases_model->addExpense($data);
			
			 redirect("partner");

		}
			
			$this->action = 'partner/liftProfit/'.$id ;
			
			$this->data['emplyee'] = $this->partner_model->getPartnerByID($id);
			$this->load->view($this->theme . 'partner/payProfite',$this->data);  
	
	
	}
	
	function payProfitEtdit($id){
	    if (!$this->Admin) {

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');

        }
		
		if($id == NULL){
			
			 redirect('pos');
		}
		
	   $this->data['paySalary'] = $this->partner_model->payProfiteSingel($id);
		
	   $this->form_validation->set_rules('month_id', 'Month', 'required');
		
		$this->form_validation->set_rules('amount', 'amount', 'required');
		

		if ($this->form_validation->run() == true) {
			
			$data = array(
			
				'month_id'	  => $this->input->post('month_id'),
				
				'amount'        => $this->input->post('amount'),
				
				'note'          => $this->input->post('note'),
				
				'year'          => $this->input->post('year'),
				
			);
			
			$this->partner_model->payLeftprofitUpdate($data,$id) ;
			$emplyee_name = $this->partner_model->getPartnerByID($this->data['paySalary']->liftprofit_id)->name;
			$emplyee_name = strtolower(trim($emplyee_name));
			$emplyee_name = str_replace(' ','_',$emplyee_name);
			
			  $dataExpense = array(

                'reference' => $this->input->post('year').'-'.$this->input->post('month_id').'-'.$emplyee_name,

                'amount' => $this->input->post('amount'),

            );			
			
			$this->partner_model->updatePartnerExpense($dataExpense,$id);		
			
			 redirect("partner");

		}
	 	$this->action = 'partner/payProfiteEdit/'.$id ; 
		$this->load->view($this->theme . 'partner/payProfiteEdit',$this->data);  
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
		if ( $this->partner_model->deletePartner($id) ) {

			$this->session->set_flashdata('message', 'Partner deleted ');

			redirect("partner");

		}

	}

    function payProfitdelete($id){

		if(DEMO) {

			$this->session->set_flashdata('error', $this->lang->line("disabled_in_demo"));

			redirect('pos');

		} 

		if (!$this->Admin)

		{

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('pos');

		} 

		if ( $this->partner_model->payProfitdelete($id) )

		{ 
			redirect("partner");

		}

	}

}

