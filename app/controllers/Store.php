<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Store extends MY_Controller
{

    function __construct() {

        parent::__construct();

        if (!$this->loggedIn) {

            redirect('login');

        }
        $this->load->library('form_validation'); 
        $this->load->model('store_model');
		
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);       

    }

    function index() {

    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    	$this->data['page_title'] = lang('stores');

    	$bc = array(array('link' => '#', 'page' => lang('stores')));

    	$meta = array('page_title' => lang('Stores'), 'bc' => $bc);

    	$this->page_construct('stores/index', $this->data, $meta);

    }

    function get_stores() {

    	$this->load->library('datatables');
 
    	$this->datatables->select("id, name, phone,  email, address1, address2");

    	$this->datatables->from("stores");

    	$action = "<a href='" . site_url('store/edit/$1') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("edit_customer")."'><i class='fa fa-edit'></i></a>";

    	if($this->session->userdata('store_id') ==0){
    		$action .= "<a href='" . site_url('store/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("delete_customer")."'><i class='fa fa-trash-o'></i></a>";
    	}   	 

    	$this->datatables->add_column("Actions", "<div class='text-center'>
    		<div class='btn-group'>".$action."</div></div>", "id");

    	$this->datatables->unset_column('id');
    	if($this->session->userdata('store_id') !=0){
    		$this->datatables->where('id',$this->session->userdata('store_id'));
    	}	

    	echo $this->datatables->generate();

    }

	function add() {
		 if (!$this->Admin) {
            $this->session->set_flashdata('error', $this->lang->line('access_denied'));
            redirect('pos');
        }
		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'required|valid_email|trim|is_unique[stores.email]');
		$this->form_validation->set_rules('phone', $this->lang->line("phone"), 'required');
		$this->form_validation->set_rules('city', $this->lang->line("city"), 'required');
		$this->form_validation->set_rules('state', $this->lang->line("state"), 'required');
		$this->form_validation->set_rules('postal_code', $this->lang->line("postal_code"), 'required');
		$this->form_validation->set_rules('country', $this->lang->line("country"), 'required'); 
		$this->form_validation->set_rules('store_type', $this->lang->line("Store Type"), 'required'); 

		if ($this->form_validation->run() == true) {

			$data = array(
				'name' => $this->input->post('name'),
				'store_type' => $this->input->post('store_type'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address1'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'postal_code' => $this->input->post('postal_code'),
				'country' => $this->input->post('country'),
				'currency_code' => $this->input->post('currency_code'),
				'receipt_header' => $this->input->post('receipt_header'),
				'receipt_footer' => $this->input->post('receipt_footer'), 	
			); 
			 
		}

		if ( $this->form_validation->run() == true) { 
			$this->store_model->addStores($data);
            $this->session->set_flashdata('message', $this->lang->line("customer_added"));

            redirect("store");

		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = lang('Add_store');

    		$bc = array(array('link' => site_url('stores'), 'page' => lang('stores')), array('link' => '#', 'page' => lang('add_store')));

    		$meta = array('page_title' => lang('Add_store'), 'bc' => $bc);

    		$this->page_construct('stores/add', $this->data, $meta);
		}

	}

	function edit($id = NULL) {       

		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required'); 

		if ($this->form_validation->run() == true) {

			$data = array(
				'name' => $this->input->post('name'),
				'store_type' => $this->input->post('store_type'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address1'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'postal_code' => $this->input->post('postal_code'),
				'country' => $this->input->post('country'),
				'currency_code' => $this->input->post('currency_code'),
				'receipt_header' => $this->input->post('receipt_header'),
				'receipt_footer' => $this->input->post('receipt_footer'), 	
			); 
			 
		}

		if ( $this->form_validation->run() == true && $this->store_model->storeEditByID($id, $data)) {			 

			$this->session->set_flashdata('message', $this->lang->line("store_updated"));

			redirect("store");

		} else {

			$this->data['store'] = $this->store_model->getStoreByID($id); 

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = lang('Edit_store');

    		$bc = array(array('link' => site_url('store'), 'page' => lang('store')), array('link' => '#', 'page' => lang('Edit_store')));

    		$meta = array('page_title' => lang('Edit_store'), 'bc' => $bc);

    		$this->page_construct('stores/edit', $this->data, $meta);

		}

	}

	function delete($id = NULL)	{

		if(DEMO) {

			$this->session->set_flashdata('error', $this->lang->line("disabled_in_demo"));

			redirect('pos');

		} 

		if($this->input->get('id')) { $id = $this->input->get('id', TRUE); }

		if (!$this->Admin) {

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('pos');

		}
		if ( $this->store_model->deleteStore($id) ) {

			$this->session->set_flashdata('message', lang("customer_deleted"));

			redirect("store");

		}

	}

}

