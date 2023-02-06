<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends MY_Controller

{
    function __construct() {

        parent::__construct();

        if (!$this->loggedIn) {

            redirect('login');

        }

        $this->load->library('form_validation');

        $this->load->model('service_model');
		
		$this->load->model('purchases_model');

		
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);

    }

    function index()

    {

    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    	$this->data['page_title'] = 'Service';

    	$bc = array(array('link' => '#', 'page' => 'Service'));

    	$meta = array('page_title' => 'Service', 'bc' => $bc);

    	$this->page_construct('service/listservice', $this->data, $meta);
		
      

    }

function get_service() { 
		$this->load->library('datatables');
        $this->datatables->select("service_id, date_submit, customer_name,total_items, total, paid ");
        $this->datatables->from('service'); 
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
		<a href='#' onClick=\"MyWindow=window.open('" . site_url('service/view/$1/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("view_invoice")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a> 
		
		<a href='" . site_url('service/edit/$1') . "' title='Edit service' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>

		<a href='javascript:;' onClick='sarvicePayments($1)' class='tip btn btn-warning btn-xs' title='Payments view'><i class='fa fa-money'></i> </a>
		 
		<a href='javascript:;' onClick='addSarvicePay($1)' class='tip btn btn-warning btn-xs' title='Pay Payment'>  <i class='fa fa-briefcase'></i></a>
		 
		<a href='" . site_url('service/delete/$1') . "' onClick=\"return confirm('You are going to delete Service, please click ok to delete')\" title='Delete service' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>

		</div></div>", "service_id");
        $this->datatables->unset_column('service_id');
        echo $this->datatables->generate();
	}

    function selectInvoice() {
			$data['action'] = "service/add" ;
    		$this->data['page_title'] = 'Add service';
    		$bc = array(array('link' => site_url('Add service'), 'page' => 'Service'), array('link' => '#', 'page' => 'Add service'));
    		$meta = array('page_title' => 'Add service', 'bc' => $bc);			
		    $this->load->view($this->theme.'service/selectInvoice', $this->data);
		}
		
	function ajaxValue() {			  
		$search = $this->uri->segment(3);            
		$search =  str_replace("__"," ",$search);			
		$results = $this->service_model->getInvoice($search);			
		if( count($results) >0 ){			
		foreach($results as $result){ 
		//print_r($result);
		?>
		<ul class="invoice-list">
		  <li class="invoice-code"> <a href="javascript:;" onclick="invoicProduct(<?php echo $result->id ; ?>)"> <strong> Invoice No: <?php echo $result->id ; ?></strong><br />
		    <span class="customer"> Customer: <?php echo $result->customer_name; ?></span><br />
		    <span class="date"> Date: <?php echo $this->tec->hrld($result->date); ?> </span><br />
		    </a> </li>
		</ul>
		<?php  }
		}else{ ?>
		<ul class="invoice-list">
		  <li class="invoice-code">No matching record found</li>
		</ul>
		<?php } 
	}
		
	function invoicProduct($sale_id) {
		$this->load->model('pos_model');		
		$inv = $this->pos_model->getSaleByID($sale_id);		
		$this->data['inv'] = $inv;		
		$this->data['rows'] = $this->pos_model->getAllSaleItems($sale_id);
		$bc = array(array('link' => site_url('Add service'), 'page' => 'Service'), array('link' => '#', 'page' => 'Add service'));
		$meta = array('page_title' => 'Add service', 'bc' => $bc);		
	    $this->load->view($this->theme.'service/invoicProduct', $this->data);
	}		
		
	function add() {			 
		$sela_item_id = $this->input->post('sela_item_id');
		$ids ='';
		foreach($sela_item_id  as $id ){
			$ids = $ids ."'".$id."',";
		}
		$ids = preg_replace('~,(?!.*,)~', '', $ids); 		
		if($ids==''){			
			redirect('service');			
		} 
		$this->data['saleItems'] = $this->service_model->getSaleItems($ids); 	
		$this->data['sale_info'] = $this->service_model->getSaleInfo($this->data['saleItems'][0]->sale_id );	
		$this->data['page_title'] = 'Add service invoice';
		$bc = array(array('link' => site_url('service'), 'page' => 'Service'), array('link' => '#', 'page' => 'New Service'));
		$meta = array('page_title' => 'Service', 'bc' => $bc);
		$this->page_construct('service/add', $this->data, $meta); 
	}

  	function addservice(){		
		if($this->input->post('save_invoice') !=''){ 
			$date = date('Y-m-d H:i:s');
			$data = array(				
			'date_submit'   =>  $date,
			'sale_id'	   => $this->input->post('sale_id'),				
			'customer_id'   => $this->input->post('customer_id'),				
			'customer_name' => $this->input->post('customer_name'),				
			'total'         =>$this->input->post('total'),				
			'total_items'   => count($_POST['parts_name']),				
			'created_by'    => $this->session->userdata('user_id')				
		);
		
		$service_id = $this->service_model->addservice($data) ; 
		$countparts_name = count($_POST['parts_name']);			
		for($i=0; $i< $countparts_name ; $i++){			
		$parts_name = $_POST['parts_name'][$i];			
		$quantity = $_POST['qty'][$i];			
		$unit_cost = $_POST['unit_cost'][$i];			
		$subtotal = $_POST['subtotal'][$i];			
		$dataParts = array(				
			'service_id'   => $service_id,
			'parts_name'   => $parts_name ,				
			'quantity'     => $quantity,				
			'unit_cost'    => $unit_cost,				
			'subtotal'     => $subtotal				
		   );			   
		    $this->service_model->addserviceParts($dataParts) ;
		
		}
			
		$count_problem = count($_POST['problem']);			
		for($i=0; $i< $count_problem ; $i++){				
		$problem = $_POST['problem'][$i];			
		$suspect =$_POST['suspect'][$i];			
		$product_id = $_POST['product_id'][$i];			
		$item_id = $_POST['item_id'][$i];			
		$quantity = $_POST['quantity'][$i];			
		$data = array(				
			'service_id'   => $service_id,
			'problem'	  => $problem ,				
			'suspect'      => $suspect,				
			'item_id'      => $item_id,				
			'quantity'     => $quantity,				
			'product_id'   => $product_id				
		    );
		    $this->service_model->addservicePromlem($data) ;
		}			
		if(count($_POST['parts_name']) >0){
		 $SaleDtattype = 'Add';				   
		   $saleData = array(
			 'date' => $date,
			 'customer_id' =>$this->input->post('customer_id'),
			 'customer_name' =>$this->input->post('customer_name'),
			 'total' => $this->input->post('total'),
			 'product_discount' => '0.00',
			 'order_discount'=> '0.00',
			 'total_discount'=> '0.00',
			 'grand_total' => $this->input->post('total'),
			 'product_tax'=> '0.00',
			 'order_tax_id' => '0.00',
			 'total_items' => count($_POST['parts_name']),
			 'paid' => '0',
			 'created_by' => $this->session->userdata('user_id'),
			 'sales_type' => 'service',
			 'service_id' => $service_id
		   );			  
		$this->service_model->AddSaleInfo($saleData,NULL,$SaleDtattype);			
		}			
		redirect('service');
		}else{				
			redirect('service');				
		}
	}
		
	function edit($id) { 			
		if($_POST['problem_id'] !=''){
			$dataService = array(
		         'total'         =>$this->input->post('total'),
			     'total_items'   => count($_POST['parts_name'])+ count($_POST['parts_name_n'])
			);
		    $this->service_model->editservice($dataService,$id) ;
			$count_problem = count($_POST['problem_id']);			
			for($i=0; $i< $count_problem ; $i++){				
			$problem = $_POST['problem'][$i];			
			$suspect = $_POST['suspect'][$i];			
			$problem_id =$_POST['problem_id'][$i];			
			$data = array(
				'problem'	  => $problem ,				
				'suspect'      => $suspect				
			    );
			    $this->service_model->editservicePromlem($data,$problem_id) ;			
			}			
			$countparts_name = count($_POST['parts_name']);			
			for($i=0; $i< $countparts_name ; $i++){			
			$parts_name = $_POST['parts_name'][$i];			
			$quantity = $_POST['quantity'][$i];			
			$unit_cost = $_POST['unit_cost'][$i];			
			$subtotal = $_POST['subtotal'][$i];			
			$parts_id =$_POST['parts_id'][$i];			
			$dataParts = array(
				'parts_name'   => $parts_name ,				
				'quantity'     => $quantity,				
				'unit_cost'    => $unit_cost,				
				'subtotal'     => $subtotal				
			   );			   
			   $this->service_model->editserviceParts($dataParts,$parts_id) ;			
			}		  	
			$countparts_name_n = count($_POST['parts_name_n']);			
			for($i=0; $i< $countparts_name_n ; $i++){			
			$parts_name_n = $_POST['parts_name_n'][$i];			
			$quantity_n = $_POST['quantity_n'][$i];			
			$unit_cost_n = $_POST['unit_cost_n'][$i];			
			$subtotal_n = $_POST['subtotal_n'][$i];			
			$parts_id_n =$_POST['parts_id_n'][$i];			
			$dataParts_n = array(			
				'service_id'   => $id,
				'parts_name'   => $parts_name_n ,				
				'quantity'     => $quantity_n,				
				'unit_cost'    => $unit_cost_n,				
				'subtotal'     => $subtotal_n				
			);			   
			$this->service_model->addserviceParts($dataParts_n);			
			}
			$saleData = array(
			  	'total' => $this->input->post('total'),
			  	'grand_total' => $this->input->post('total')
		    );
		    $SaleDtattype = 'edit';			
			$this->service_model->AddSaleInfo($saleData,$id,$SaleDtattype);			
				redirect('service');			
			}			
			$this->data['sevice_id'] = $id ;			
			$this->data['saleItems'] = $this->service_model->getSaleItemsEdit($id);			
			$this->data['parts'] = $this->service_model->getParts($id);			
			$this->data['parts'] = $this->service_model->getParts($id);			
			$this->data['page_title'] = 'Service Update invoice';
    		$bc = array(array('link' => site_url('service'), 'page' => 'Service'), array('link' => '#', 'page' => 'Service Update'));
    		$meta = array('page_title' => 'Service Update', 'bc' => $bc);
			$this->page_construct('service/edit', $this->data, $meta);
		}
		
		
 	function view($id) {			 
		$this->data['parts'] = $this->service_model->getParts($id);			 
		$saleItems = $this->service_model->getSaleItemsEdit($id);			
		$this->data['saleItems'] = $saleItems ;			
		$service_id  = $saleItems[0]->service_id ; 			
		$this->data['service_info'] = $this->service_model->getSeviceInfo($service_id);				
		$this->data['page_title'] = 'Service invoice';
		$bc = array(array('link' => site_url('service'), 'page' => 'Service'), array('link' => '#', 'page' => 'Service invoice'));
		$meta = array('page_title' => 'Service invoice', 'bc' => $bc);			 
		$this->load->view($this->theme.'service/view', $this->data);
	}
		
    function paymentsList($id){
		$this->data['pay'] =  $this->service_model->listPayment($id) ;		  
		$this->data['title'] = 'Payments View';		
		$this->load->view($this->theme . 'service/paymentsList', $this->data);	
	}
	 
	function delete_payment($service,$payment){	
		$payment_info = $this->service_model->getPaymentSingel($payment); 
		$service_info = $this->service_model->ChechSaleSarvice($service);		
	    $currecn_paid = $service_info->paid - $payment_info->amount ;		
		$delete_ammount  = $data_info->amount ;		
		$saleData = array(
			'paid' => $currecn_paid,
		);
	    $this->service_model->AddSaleInfo($saleData,$service,'edit');
		$editservice = array(
			'paid' => $currecn_paid			
		);			
		$this->service_model->editservice($editservice,$service) ;		
		$this->service_model->PaymentDelete($payment) ;	
		if($payment_info->collect_id){ 
		$this->site->deleteQuery('today_collection',$data=array('today_collect_id'=>$payment_info->collect_id));
		}	
		$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
		redirect('service');		 
	 }
    function add_payment($id = NULL){
        $this->load->helper('security');		
		$this->data['SeviceInfo'] = $this->service_model->getSeviceInfo($id) ;	
		$this->data['total'] = $this->data['SeviceInfo']->total;		
		$this->data['paid']  =  $this->data['SeviceInfo']->paid;		
		$this->data['deu'] = $this->data['total'] - $this->data['paid'] ;		
		$this->data['title'] = 'Add Payment';		
        $this->form_validation->set_rules('amount-paid', lang("amount"));		
        if($this->input->post('add_payment')){
            if ($this->Admin) {
                $date = $this->input->post('date');
            } else {
                $date = date('Y-m-d H:i:s');
            }			
			$SaleInfo = $this->service_model->ChechSaleSarvice($id);			
			if($SaleInfo == FALSE){				
			    $SaleDtattype = 'Add';				   
			    $saleData = array(
					'date' => $date,
					'customer_id' =>$this->data['SeviceInfo']->customer_id,
					'customer_name' => $this->data['SeviceInfo']->customer_name,
					'total' => $this->data['SeviceInfo']->total,
					'product_discount' => '0.00',
					'order_discount'=> '0.00',
					'total_discount'=> '0.00',
					'grand_total' => $this->data['SeviceInfo']->total,
					'product_tax'=> '0.00',
					'order_tax_id' => '0.00',
					'total_items' => $this->data['SeviceInfo']->total_items,
					'paid' => $this->data['paid']+$this->input->post('amount-paid'),
					'created_by' => $this->session->userdata('user_id'),
					'sales_type' => 'service',
					'service_id' => $id
			   );			   
			}else{
				$saleData = array(
				'updated_at' => date('Y-m-d H:i:s'),
				'paid' => $this->data['paid']+$this->input->post('amount-paid'),
			);
			$SaleDtattype = 'edit';			   
			}	
			$collData = array(
				'payment_amount'=> $this->input->post('amount-paid'),
				'customer_id' => $this->data['SeviceInfo']->customer_id,
				'payment_date' => $date,
				'store_id' => $SaleInfo->store_id
			);		
			$collect_id = $this->site->insertQuery('today_collection',$collData);
			$this->service_model->AddSaleInfo($saleData,$id,$SaleDtattype);			
            $payment = array(
                'date' => $date,
                'sale_id' => $this->data['SeviceInfo']->sale_id,
                'customer_id' => $this->data['SeviceInfo']->customer_id,				
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
				'payment_type' => 'service',				
				'service_id'  => $id,
				'collect_id'  => $collect_id,
            );			
            $this->session->set_flashdata('message', lang("payment_added"));			
			$this->service_model->addPayment($payment) ;			
			$editservice = array(
				'paid' => $this->data['paid']+$this->input->post('amount-paid')			
			);			
			$this->service_model->editservice($editservice,$id) ;
            redirect($_SERVER["HTTP_REFERER"]);
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
		   $rows =  $this->purchases_model->getParchasePay($id) ;		 
		   $totla_amount =  $this->purchases_model->getParchaseInfo($id) ;		  
		   $this->data['due_amount'] = $totla_amount->total - $totla_pay;		  
		   $this->data['type'] = 'Add';			
		   $this->data['action'] = site_url('service/add_payment/'.$id);		   
		   if(($this->data['deu'] =='') || ($this->data['deu'] == 0)){			   
			    $this->data['error_alert']='Already payment paid ! ';			   
			    $this->load->view($this->theme . 'service/alert', $this->data);			   
			}else{		  
		 		$this->load->view($this->theme . 'service/add_payment', $this->data);	   
			}		  
	    }
	}
	
	function editSarvicePay($payment){
		
		$this->load->helper('security');
		 
		$payment_info = $this->service_model->getPaymentSingel($payment) ;
		
		$service_info = $this->service_model->ChechSaleSarvice($payment_info->service_id) ;
		
		$this->data['payinfo'] =  $payment_info;
		
	    $total = $service_info->total;
		
		$paid  = $service_info->paid;
		
	    $this->data['deu'] =  $payment_info->amount;
		
		$this->data['currect_due'] = ($total-$paid) + $payment_info->amount;
		
		
        $this->form_validation->set_rules('amount-paid', lang("amount"));
		
		
       if($this->input->post('add_payment')){
		 //  echo $paid;
		   
		   $edit_amount = (($paid - $payment_info->amount) + $this->input->post('amount-paid'));
			
			   $saleData = array(
				 'paid' => $edit_amount,
			   );
			  
			$this->service_model->AddSaleInfo($saleData,$payment_info->service_id,'edit');
			
			$editservice = array(
			     'paid' => $edit_amount
			
			 );
			
	     	$this->service_model->editservice($editservice,$payment_info->service_id) ;
			
			
            $paymentData = array(

                'amount' => $this->input->post('amount-paid'),

            );
			
			$this->service_model->editPayment($paymentData,$payment) ;
			
            $this->session->set_flashdata('message', lang("payment_added"));
			
            redirect($_SERVER["HTTP_REFERER"]);

        } else {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

	    $this->data['type'] = 'edit';
			
		$this->data['action'] = site_url('service/editSarvicePay/'.$payment);
		   
		
		$this->data['edit_amoun'] = $payment_info->amount;
		
		$payment_type =$payment_info->paid_by ;
		
	   	if($payment_type =='cash'){
			
			$this->data['due_amount'] = $totla_amount->total - $totla_pay;
		  
		    $this->data['type'] = 'edit';
			
			$this->load->view($this->theme . 'service/add_payment', $this->data);
			
	      }else{
			
				$this->data['error_alert']='Only cash payments can be edited ! ';
			   
		        $this->load->view($this->theme . 'service/alert', $this->data);
			   
			
			}
		  
	      }
		
		
		
		}
		
    function delete($id = NULL){

		if(DEMO) {

            $this->session->set_flashdata('error', lang('disabled_in_demo'));

            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');

        }

		if($this->input->get('id')){ $id = $this->input->get('id'); }



		if (!$this->Admin) {

			$this->session->set_flashdata('error', lang("access_denied"));

			redirect('service');

		}



		if ( $this->service_model->deleteInvoice($id) ) {

			$this->session->set_flashdata('message', lang("invoice_deleted"));

			redirect('service');

		}

	   }
	function deletePartsItems($id){
		
		$Partst_info = $this->service_model->servicePartsSingel($id) ;
		
		$service_info = $this->service_model->getSeviceInfo($Partst_info->service_id) ;
		
		$subtotal = $Partst_info->subtotal;
		
		$total = $service_info->total;
		
		$current_total  =  $total-$subtotal ;
		
		$total_items =  $service_info->total_items - 1 ;
		
		$service_id = $Partst_info->service_id;
		
		
		$saleData = array(
				 'total' => $current_total,
				 'grand_total' => $current_total,
			   );
			  
		$this->service_model->AddSaleInfo($saleData,$service_id,'edit');
		
		$editservice = array(
			     'total' => $current_total,
				 'total_items' => $total_items
			
			 );
			
	    $this->service_model->editservice($editservice,$service_id) ;
	
		$this->service_model->deleteParts($id) ;
		
	 }	
 
}




