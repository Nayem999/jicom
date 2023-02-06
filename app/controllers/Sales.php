<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales extends MY_Controller {

	function __construct(){

		parent::__construct();

		if (!$this->loggedIn) {

			redirect('login');

		}

		$this->load->library('form_validation');

		$this->load->model('sales_model');

        $this->load->model('pos_model');

		$this->digital_file_types = 'zip|pdf|doc|docx|xls|xlsx|jpg|png|gif';
        
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);

	}

	function index(){         

		$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

		$this->data['page_title'] = lang('sales');

		$bc = array(array('link' => '#', 'page' => lang('sales')));

		$meta = array('page_title' => lang('sales'), 'bc' => $bc);

        $this->data['customers'] = $this->site->getAllCustomers(); 

        $this->data['warehouses'] = $this->site->getAllStores();

		$this->page_construct('sales/index', $this->data, $meta);

	}

    function today(){

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

        $this->data['page_title'] = 'Today sales';

        $bc = array(array('link' => '#', 'page' => 'Today sales'));

        $meta = array('page_title' => 'Today sales', 'bc' => $bc);

        $this->page_construct('sales/today', $this->data, $meta);

    }

	function get_sales($today = NULL){

        $warehouse = $this->input->get('warehouse') ? $this->input->get('warehouse') : NULL; 
        $customer = $this->input->get('customer') ? $this->input->get('customer') : NULL; 
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : NULL; 
		 
		$this->load->library('datatables');

        $this->datatables->select($this->db->dbprefix('sales').".id as id , ". 
            $this->db->dbprefix('sales').".date, ".$this->db->dbprefix('sales').".id as invoice , ".
            $this->db->dbprefix('sales').".customer_name, ".$this->db->dbprefix('stores').".name as storename, ".
            $this->db->dbprefix('customers').".phone , total, ".
            $this->db->dbprefix('sales').".total_tax, ".$this->db->dbprefix('sales').".total_discount,".
            $this->db->dbprefix('sales').".grand_total,".$this->db->dbprefix('sales').".paid, ".
            $this->db->dbprefix('sales').".paid_by,(".$this->db->dbprefix('sales').".grand_total -".
            $this->db->dbprefix('sales').".paid) as deu ," .$this->db->dbprefix('sales').".status, ".$this->db->dbprefix('bank_pending').".type"); 
	   
	    $this->datatables->join('customers', 'customers.id=sales.customer_id');  
        $this->datatables->join('stores', 'stores.id=sales.store_id');	     
        $this->datatables->join('payments', 'payments.sale_id=sales.id', 'LEFT');	    
        $this->datatables->join('bank_pending', 'bank_pending.collection_id=payments.collect_id and bank_pending.payment_type=1', 'LEFT');	     

        $this->datatables->from('sales');

        $this->datatables->group_by('sales.id');            

         if(($this->Admin) || ($this->Manager)){

        	$actdata = "<a href='javascript:;' onClick='bankChack($1)' title='Bank' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>";

            $actdata .= "<a href='#' onClick=\"MyWindow=window.open('" . site_url('pos/view/$1/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("view_invoice")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a>";
         
            $actdata .= "<a href='javascript:;' onClick='noteEdit($1)' title='Edit Note' class='tip btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>";
         
            $actdata .= "<a style='display:none;' href='" . site_url('pos/?edit=$1') . "' title='".lang("edit_invoice")."' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
         
            $actdata .= "<a href='" . site_url('sales/delete/$1') . "' onClick=\"return confirm('". lang('alert_x_sale') ."')\" title='".lang("delete_sale")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";

        } else {

            $actdata = "<a href='#' onClick=\"MyWindow=window.open('" . site_url('pos/view/$1/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("view_invoice")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a>";
           
            $actdata .= "<a href='javascript:;' onClick='noteEdit($1)' title='Edit Note' class='tip btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>";

        }

        if($this->session->userdata('store_id') !=0){
           $this->datatables->where('sales.store_id',$this->session->userdata('store_id'));
        } 

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>".$actdata."</div></div>", "id");

        $this->datatables->unset_column('id');
		
		$this->datatables->where('sales_type', 'sale');

        if($warehouse) { $this->datatables->where('sales.store_id', $warehouse); }
        if($customer) { $this->datatables->where('sales.customer_id', $customer); }
        if($start_date) { $this->datatables->where('sales.date >=', $start_date.' 00:00:00'); }
        if($end_date) { $this->datatables->where('sales.date <=', $end_date.' 23:59:59'); } 

        if($today !=NULL){ 
            // $this->datatables->like('sales.date', $today); 
            $this->datatables->where('sales.date >=', $today.' 00:00:00'); 
            $this->datatables->where('sales.date <=', $today.' 23:59:59');
        }
        echo $this->datatables->generate();

	}
    function sale_log(){     
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Sales log');
        $bc = array(array('link' => '#', 'page' => lang('Sales log')));
        $meta = array('page_title' => lang('Sales log'), 'bc' => $bc);
        $this->data['customers'] = $this->site->getAllCustomers();
        $this->page_construct('sales/sale_log', $this->data, $meta);

    }
    function get_sales_log(){    
        $this->load->library('datatables');
        $this->datatables->select(
            $this->db->dbprefix('sales_log').".id as id , ".
            $this->db->dbprefix('sales_log').".date, ".
            $this->db->dbprefix('sales_log').".sale_id as invoice , ".
            $this->db->dbprefix('sales_log').".customer_name, ".
            $this->db->dbprefix('customers').".phone , total, ".
            $this->db->dbprefix('sales_log').".total_tax, ".
            $this->db->dbprefix('sales_log').".total_discount, ".
            $this->db->dbprefix('sales_log').".grand_total,".
            $this->db->dbprefix('sales_log').".paid, ".
            $this->db->dbprefix('sales_log').".paid_by, (".
            $this->db->dbprefix('sales_log').".grand_total -".
            $this->db->dbprefix('sales_log').".paid) as deu ," .
            $this->db->dbprefix('sales_log').".status, ".
            $this->db->dbprefix('sales_log').".type");  
        $this->datatables->join('customers', 'customers.id=sales_log.customer_id'); 
        $this->datatables->from('sales_log'); 
        $this->datatables->group_by('sales_log.id');            
        $this->datatables->where('sales_type', 'sale');
        $this->datatables->add_column("Actions", 
            "<div class='text-center'><div class='btn-group'><a href='" . site_url('sales/salelogview/$1') . "' title='".lang("View Details")."' class='tip btn btn-info btn-xs'><i class='fa fa-th-large'></i></a> </div></div>", "id") 
        ->unset_column('id');  
        echo $this->datatables->generate();
    } 
    function salelogview($sale_id = NULL)
    { 
        if($this->input->get('id')){ $sale_id = $this->input->get('id'); } 
        $inv = $this->site->findeNameByID('sales_log','id',$sale_id);  
        $this->data['rows'] = $this->pos_model->getAllSaleLogItems($sale_id); 
        $this->data['customer'] = $this->pos_model->getCustomerByID($inv->customer_id); 
        $this->data['inv'] = $inv;
        $this->data['sid'] = $sale_id;
        $this->data['noprint'] = '';
        $this->data['modal'] = false;  
        $this->data['page_title'] = lang("Invoice Log");
        $this->load->view($this->theme.'sales/view', $this->data);

    }
	function opened(){
		$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
		$this->data['page_title'] = lang('opened_bills');
		$bc = array(array('link' => '#', 'page' => lang('opened_bills')));
		$meta = array('page_title' => lang('opened_bills'), 'bc' => $bc);
		$this->page_construct('sales/opened', $this->data, $meta);
	}

	function get_opened_list(){
		$this->load->library('datatables');
		$this->datatables
		->select("id, date, customer_name, hold_ref, CONCAT(total_items, ' (', total_quantity, ')') as items, grand_total", FALSE)
		->from('suspended_sales');
        if(!$this->Admin) {			
            $user_id = $this->session->userdata('user_id');
            $this->datatables->where('created_by', $user_id);
        }
		$this->datatables->add_column("Actions",
			"<div class='text-center'><div class='btn-group'><a href='" . site_url('pos/?hold=$1') . "' title='".lang("click_to_add")."' class='tip btn btn-info btn-xs'><i class='fa fa-th-large'></i></a>
			<a href='" . site_url('sales/delete_holded/$1') . "' onClick=\"return confirm('". lang('alert_x_holded') ."')\" title='".lang("delete_sale")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id")
		->unset_column('id');
		echo $this->datatables->generate();
	}

	function noteEdit($id = NULL){			
    	$this->data['info']  = $this->sales_model->getSaleByID($id);		
		$this->data['title'] = 'Edit Note';
		$bc = array(array('link' => site_url('Edit Note'), 'page' => 'Note'), array('link' => '#', 'page' => 'Edit Note'));
		$meta = array('page_title' => 'Edit Note', 'bc' => $bc);			
	    $this->load->view($this->theme.'sales/noteEdit', $this->data);
	}

	function noteUpdate($id = NULL){
	    $this->load->model('sales_model');
	    $this->load->helper('security');
		if($id ==''){	
		   redirect('sales');
		}
		$note = $this->input->post('note');
		 $noteData = array(
			'note' => $note 
		);
		$this->sales_model->editNote($noteData,$id);
		$this->session->set_flashdata('message', "Sale note successfully updated ");
		redirect('sales'); 
	}

	function bankChack($id = NULL){ 
    	$this->data['info']  = $this->sales_model->getSaleByID($id);		
		$this->data['title'] = 'Bank Cheque Payment'; 
	    $this->load->view($this->theme.'sales/bankChack', $this->data);
	}

	function bankChackUpdate($id = NULL){ 
		$this->load->helper('security');
		if($id ==''){	
		   redirect('sales');
		}
		$paid_by = $this->input->post('paid_by');
		 $ckData = array(
			'paid_by' => $paid_by 
		); 
		$this->sales_model->editNote($ckData,$id);
		$this->session->set_flashdata('message', "Sale note successfully updated ");
		redirect('sales'); 
	}	
	
    function delete($id = NULL){ 
		if(DEMO) { 
            $this->session->set_flashdata('error', lang('disabled_in_demo')); 
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome'); 
        }

        $getSaleItemsBySaleId = $this->sales_model->getSaleItemsBySaleId($id);
        //print_r();
       /* foreach ($getSaleItemsBySaleId as $key => $value) {
           
          $saleItmetbQty = $value->quantity;

          $getProductById = $this->sales_model->getProductById($value->product_id);

          foreach ($getProductById as $key => $value) {
              $saleItmetbQty ;
              $proID = $value->id;
              $proQty = $value->quantity + $saleItmetbQty;
              $data = array('quantity' =>$proQty , );
              $ProQtyUpdate = $this->sales_model->ProQtyUpdate($proID,$data);

          }          
          
        } */
        $getSaleItemsBySaleId = $this->sales_model->getSaleItemsBySaleId($id);
        
        $dataSale  =  $this->site->getDataByElement('sales','id',$id);

        $store_id = $dataSale[0]->store_id ;

        $dataUpdate  = array(
            'sales_id' => 0 ,
            'status' => 0 );
        $this->sales_model->sequenceUpdate($id,$dataUpdate);

        foreach ($getSaleItemsBySaleId as $key => $value) {
           
          $saleItmetbQty = $value->quantity;

          $this->sales_model->storeProQtyUpdate($value->product_id,$saleItmetbQty,$store_id);
          $getProductById = $this->sales_model->getProductById($value->product_id);

          foreach ($getProductById as $key => $value) {
              $saleItmetbQty ;
              $proID = $value->id;
              $proQty = $value->quantity + $saleItmetbQty;
              $data = array('quantity' =>$proQty , );
              $ProQtyUpdate = $this->sales_model->ProQtyUpdate($proID,$data);

          }  
          
        }
		if($this->input->get('id')){ $id = $this->input->get('id'); }

		if (!$this->Admin) {

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('sales');

		}

		if ( $this->sales_model->deleteInvoice($id) ) {

			$this->session->set_flashdata('message', lang("invoice_deleted"));

			redirect('sales');

		}

	}

	function delete_holded($id = NULL){

		if($this->input->get('id')){ $id = $this->input->get('id'); }

		if (!$this->Admin) {

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('sales/opened');

		}

		if ( $this->sales_model->deleteOpenedSale($id) ) {

			$this->session->set_flashdata('message', lang("opened_bill_deleted"));

			redirect('sales/opened');

		}

	}

    public function customerInfoByStore($store_id) { 
      $customers = $this->site->getAllCustomers($store_id);
        ?>
        
    <label class="control-label" for="customer"><?= lang("customer"); ?></label>

    <?php

    $cu[0] = lang("select")." ".lang("customer");

    foreach($customers as $customer){

        $cu[$customer->id] = $customer->name .' ('.$this->site->findeNameByID('stores','id',$customer->store_id)->name.')';

    }

    echo form_dropdown('customer', $cu, set_value('customer'), 'class="form-control select2" style="width:100%" id="customer"'); ?>

   <?php  }

	/* -------------------------------------------------------------------------------- */

    function payments($id = NULL){

        $this->data['payments'] = $this->sales_model->getSalePayments($id);

        $this->load->view($this->theme . 'sales/payments', $this->data);

    }

    function payment_note($id = NULL){

        $payment = $this->sales_model->getPaymentByID($id);

        $inv = $this->sales_model->getSaleByID($payment->sale_id);

        $this->data['customer'] = $this->site->getCompanyByID($inv->customer_id);

        $this->data['inv'] = $inv;

        $this->data['payment'] = $payment;

        $this->data['page_title'] = $this->lang->line("payment_note");

        $this->load->view($this->theme . 'sales/payment_note', $this->data);

    }

    function add_payment($id = NULL, $cid = NULL){

        $this->load->helper('security');

        if ($this->input->get('id')) {

            $id = $this->input->get('id');

        }

        $this->form_validation->set_rules('amount-paid', lang("amount"), 'required');

        $this->form_validation->set_rules('paid_by', lang("paid_by"), 'required');

        $this->form_validation->set_rules('userfile', lang("attachment"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            if ($this->Admin) {

                $date = $this->input->post('date');

            } else {

                $date = date('Y-m-d H:i:s');

            }

            $payment = array(

                'date' => $date,

                'sale_id' => $id,

                'customer_id' => $cid,

                'reference' => $this->input->post('reference'),

                'amount' => $this->input->post('amount-paid'),

                'paid_by' => $this->input->post('paid_by'),

                'cheque_no' => $this->input->post('cheque_no'),

                'gc_no' => $this->input->post('gift_card_no'),

                'cc_no' => $this->input->post('pcc_no'),

                'cc_holder' => $this->input->post('pcc_holder'),

                'cc_month' => $this->input->post('pcc_month'),

                'cc_year' => $this->input->post('pcc_year'),

                'cc_type' => $this->input->post('pcc_type'),

                'note' => $this->input->post('note'),

                'created_by' => $this->session->userdata('user_id'),

            );

            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'files/';

                $config['allowed_types'] = $this->digital_file_types;

                $config['max_size'] = 2048;

                $config['overwrite'] = FALSE;

                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('error', $error);

                    redirect($_SERVER["HTTP_REFERER"]);

                }

                $photo = $this->upload->file_name;

                $payment['attachment'] = $photo;

            }

            //$this->sma->print_arrays($payment);

        } elseif ($this->input->post('add_payment')) {

            $this->session->set_flashdata('error', validation_errors());

            $this->tec->dd();

        }


        if ($this->form_validation->run() == true && $this->sales_model->addPayment($payment)) {

            $this->session->set_flashdata('message', lang("payment_added"));

            redirect($_SERVER["HTTP_REFERER"]);

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $sale = $this->sales_model->getSaleByID($id);

            $this->data['inv'] = $sale;

            $this->load->view($this->theme . 'sales/add_payment', $this->data);

        }

    }

    function edit_payment($id = NULL, $sid = NULL){

    	if (!$this->Admin) {

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect($_SERVER["HTTP_REFERER"]);

		}

        $this->load->helper('security');

        if ($this->input->get('id')) {

            $id = $this->input->get('id');

        }

        $this->form_validation->set_rules('amount-paid', lang("amount"), 'required');

        $this->form_validation->set_rules('paid_by', lang("paid_by"), 'required');

        $this->form_validation->set_rules('userfile', lang("attachment"), 'xss_clean');

        if ($this->form_validation->run() == true) {

            $payment = array(

                'sale_id' => $sid,

                'reference' => $this->input->post('reference'),

                'amount' => $this->input->post('amount-paid'),

                'paid_by' => $this->input->post('paid_by'),

                'cheque_no' => $this->input->post('cheque_no'),

                'gc_no' => $this->input->post('gift_card_no'),

                'cc_no' => $this->input->post('pcc_no'),

                'cc_holder' => $this->input->post('pcc_holder'),

                'cc_month' => $this->input->post('pcc_month'),

                'cc_year' => $this->input->post('pcc_year'),

                'cc_type' => $this->input->post('pcc_type'),

                'note' => $this->input->post('note'),

                'updated_by' => $this->session->userdata('user_id'),

                'updated_at' => date('Y-m-d H:i:s'),

            );



            if ($this->Admin) {

                $payment['date'] = $this->input->post('date');

            }



            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'files/';

                $config['allowed_types'] = $this->digital_file_types;

                $config['max_size'] = 2048;

                $config['overwrite'] = FALSE;

                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('error', $error);

                    redirect($_SERVER["HTTP_REFERER"]);

                }

                $photo = $this->upload->file_name;

                $payment['attachment'] = $photo;

            }



            //$this->sma->print_arrays($payment);



        } elseif ($this->input->post('edit_payment')) {

            $this->session->set_flashdata('error', validation_errors());

            $this->tec->dd();

        }

        if ($this->form_validation->run() == true && $this->sales_model->updatePayment($id, $payment)) {

            $this->session->set_flashdata('message', lang("payment_updated"));

            redirect("sales");

        } else {



            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $payment = $this->sales_model->getPaymentByID($id);

            if($payment->paid_by != 'cash') {

            	$this->session->set_flashdata('error', lang('only_cash_can_be_edited'));

            	$this->tec->dd();

            }

            $this->data['payment'] = $payment;

            $this->load->view($this->theme . 'sales/edit_payment', $this->data);

        }

    }

    function delete_payment($id = NULL) {

		if($this->input->get('id')){ $id = $this->input->get('id'); }

		if (!$this->Admin) {

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect($_SERVER["HTTP_REFERER"]);

		}

		if ( $this->sales_model->deletePayment($id) ) {

			$this->session->set_flashdata('message', lang("payment_deleted"));

			redirect('sales');

		}

    }

}

