<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Customers extends MY_Controller
{
    function __construct() {
        parent::__construct();
        if (!$this->loggedIn) {
            redirect('login');
        }
		if(!$this->site->permission('customers'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }
        $this->load->library('form_validation');
        $this->load->model('customers_model');
        $this->load->model('sales_model');
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }
    function index()
    {
		if(!$this->site->route_permission('customers_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
    	$this->data['page_title'] = lang('customers');
    	$bc = array(array('link' => '#', 'page' => lang('customers')));
    	$meta = array('page_title' => lang('customers'), 'bc' => $bc);
    	$this->page_construct('customers/index', $this->data, $meta);
    }

    function get_customers() {
    	$this->load->library('datatables');
    	$this->datatables->select($this->db->dbprefix('customers') . ".id as cid,".
    		$this->db->dbprefix('customers') . ".name, ".    		
    		$this->db->dbprefix('customers') . ".phone, ".
    		$this->db->dbprefix('customers') . ".email, ".
    		$this->db->dbprefix('stores') . ".name as storename, ".
    		$this->db->dbprefix('customers') . ".cf1, ".
    		$this->db->dbprefix('customers') . ".cf2,", FALSE);        
       $this->datatables->join('stores', 'customers.store_id=stores.id'); 
    	$this->datatables->from("customers");

		$action="<div class='text-center'><div class='btn-group'>";
		if($this->site->route_permission('customers_edit')) {
			$action.="<a href='" . site_url('customers/edit/$1') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("edit_customer")."'><i class='fa fa-edit'></i></a>";
		}
		if($this->site->route_permission('customers_delete')) {
			$action.="<a href='" . site_url('customers/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("delete_customer")."'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

    	$this->datatables->add_column("Actions", $action, "cid");
    	// $this->datatables->unset_column('cid');
    	if(!$this->Admin){
    		$this->datatables->where('store_id',$this->session->userdata('store_id'));
    	}
    	echo $this->datatables->generate();

    }

	function add() { 

		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'valid_email');
		$this->form_validation->set_rules('phone', $this->lang->line("phone"), 'required');
		$this->form_validation->set_rules('store_id', 'Store Name', 'required');

		if(!$this->site->route_permission('customers_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
		/* if ($this->Admin){
			$this->form_validation->set_rules('store_id', 'Store Name', 'required');
		} */

		if ($this->form_validation->run() == true) {
			if($this->input->post('credit_limit')){$credit_limit=$this->input->post('credit_limit');}else{$credit_limit=0;}
			if($this->input->post('opening_blance')){$opening_blance=$this->input->post('opening_blance');}else{$opening_blance=0;}

			$data = array('name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'cf1' => $this->input->post('cf1'),
				'cf2' => $this->input->post('cf2'), 
				'credit_limit' => $credit_limit, 
				'opening_blance' => $opening_blance,
			);
			if($this->session->userdata('store_id') !=0){
				$data['store_id'] = $this->session->userdata('store_id');
			}else{
				$data['store_id'] = $this->input->post('store_id');
			}

		}

		if ( $this->form_validation->run() == true && $cid = $this->customers_model->addCustomer($data)) {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'success', 'msg' =>  $this->lang->line("customer_added"), 'id' => $cid, 'val' => $data['name']));

                die();

            }

            $this->session->set_flashdata('message', $this->lang->line("customer_added"));

            redirect("customers");

		} else {

            if($this->input->is_ajax_request()) {

                echo json_encode(array('status' => 'failed', 'msg' => validation_errors())); die();

            }

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = lang('add_customer');

    		$bc = array(array('link' => site_url('customers'), 'page' => lang('customers')), array('link' => '#', 'page' => lang('add_customer')));

    		$meta = array('page_title' => lang('add_customer'), 'bc' => $bc);

    		// $this->data['warehouses'] = $this->site->getAllStores(); 

    		$this->page_construct('customers/add', $this->data, $meta);



		}

	}



	function edit($id = NULL)
	{
		if(!$this->site->route_permission('customers_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}

        /* if((!$this->Admin) && (!$this->Manager)){

            $this->session->set_flashdata('error', $this->lang->line('access_denied'));

            redirect('pos');

        }     */     

		if($this->input->get('id')) { $id = $this->input->get('id', TRUE); }

		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');

		$this->form_validation->set_rules('email', $this->lang->line("email_address"), 'valid_email');



		if ($this->form_validation->run() == true) {

			$data = array(

				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'cf1' => $this->input->post('cf1'),
				'cf2' => $this->input->post('cf2'),				
				'credit_limit' => $this->input->post('credit_limit'), 
				'opening_blance' => $this->input->post('opening_blance')
			); 
			if(($this->session->userdata('store_id') !=0) && ($this->session->userdata('store_id') !='')){
				$data['store_id'] = $this->session->userdata('store_id');
			}else{
				$data['store_id'] = $this->input->post('store_id');
			}

		}

		if ( $this->form_validation->run() == true && $this->customers_model->updateCustomer($id, $data)) {

			$this->session->set_flashdata('message', $this->lang->line("customer_updated"));

			redirect("customers");

			} else {

			$this->data['customer'] = $this->customers_model->getCustomerByID($id);

			$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    		$this->data['page_title'] = lang('edit_customer');

    		$bc = array(array('link' => site_url('customers'), 'page' => lang('customers')), array('link' => '#', 'page' => lang('edit_customer')));

    		$meta = array('page_title' => lang('edit_customer'), 'bc' => $bc);

    		// $this->data['warehouses'] = $this->site->getAllStores(); 

    		$this->page_construct('customers/edit', $this->data, $meta);



		}

	}



	function delete($id = NULL) { 
		if($this->input->get('id')) { $id = $this->input->get('id', TRUE); }
		if(!$this->site->route_permission('customers_delete')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
		/* if (!$this->Admin)
		{
			$this->session->set_flashdata('error', lang("access_denied"));
			redirect('pos');
		} */

		if ( $this->customers_model->deleteCustomer($id) )
		{
			$this->session->set_flashdata('message', lang("customer_deleted"));
			redirect("customers");
		}
	}

	public function customer_laser($id){
		$this->data['results'] = '';  
		$this->data['customer'] = $this->sales_model->getCustomerByID($id);    
        if($id !=''){ 
        $this->data['results'] = $this->customers_model->getCustomerLaserByCid($id);  
        }  
        $this->data['page_title'] = $this->lang->line("Customer Laser List"); 
        $bc = array(array('link' => '#', 'page' => lang('merge')), array('link' => '#', 'page' => lang('Customer Laser list')));
        $meta = array('page_title' => lang('Customer Laser List'), 'bc' => $bc);        
        $this->page_construct('customers/customer_laser', $this->data, $meta);
	} 
	public function excel_customer_laser($id){
 
		$customer = $this->sales_model->getCustomerByID($id);    
        if($id !=''){ 
        	$results = $this->customers_model->getCustomerLaserByCid($id);  
        }  
		$emptyvalue = 0;
		$gtotal =0;
		$pgtotal = 0;
		$sgtotal = 0;
		$i= 1; 
		if($results !=''){
			foreach ($results as $key => $part) {
				$sort[$key] = strtotime($part['datetime']); 
			} 
		}
		array_multisort($sort, SORT_ASC, $results);

		// Excel file name for download 
        $fileName = "customer_laser_" . date('Y-m-d_h_i_s') . ".xls"; 
        $fields = array('Name : '. $customer[0]->name);
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        $fields = array('Phone : '.$customer[0]->phone);
        $excelData .= implode("\t", array_values($fields)) . "\n"; 
        $fields = array('Sl. No', 'Date & Time', 'Type', 'Dr', 'Cr','Balance');
        $excelData .= implode("\t", array_values($fields)) . "\n"; 
        
        if(count($results) > 0){ 
            foreach($results as $key => $value){ 
				if(($value['type'] == 'Opening balance') && (1>$value['total'])){ 
					// echo '<td class="center">4*'.$emptyvalue.'</td>' ;
				}else{
					$dr_val=$cr_val=$this->tec->formatMoney($value['total']) ;
				} 

				if(($value['type'] =='collection') ||($value['type'] =='Advance Collection') || ($value['type'] =='Sales Return')) {  ;
					$dr_val=$emptyvalue ;
					$pgtotal = $pgtotal + $value['total'];
				}

				if(($value['type'] == 'sale') || ($value['type'] == 'service') || ($value['type'] =='Opening balance')||($value['type'] =='Sales Return Amount')){
				   if(($value['type'] == 'Opening balance') && (1>$value['total'])){ 
						// echo '<td class="center">6*'.abs($value['total']).'</td>' ;
				   }else{
						$cr_val=$emptyvalue;
				   }
				   $sgtotal = $sgtotal + $value['total'];
				}

				$gtotal = $sgtotal - $pgtotal;

                $lineData = array($i++,$this->tec->hrld($value['datetime']), $value['type'] , $dr_val, $cr_val, $gtotal); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 

			$lineData = array('','','' ,$sgtotal, $pgtotal, ''); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
        echo $excelData;  

	} 

}

