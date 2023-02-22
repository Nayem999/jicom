<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salereturn extends MY_Controller
{
    function __construct() {

        parent::__construct();

        if (!$this->loggedIn) {

            redirect('login');

        }
		if(!$this->site->permission('salereturn'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }

        $this->load->library('form_validation');

        $this->load->model('service_model');

        $this->load->model('salesreturn_model');
		
		$this->load->model('purchases_model');

		$this->load->model('categories_model');

		$this->load->model('sales_model');
		
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);

    }

    function index() {   
        if(!$this->site->route_permission('salereturn_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
    	$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

    	$this->data['page_title'] = 'Sales Return';

    	$bc = array(array('link' => '#', 'page' => 'Sales Return'));

    	$meta = array('page_title' => 'Sales Return', 'bc' => $bc);


    	$this->page_construct('salesreturn/index', $this->data, $meta);
    }

    function get_salereturn(){ 

		$this->load->library('datatables');

	    $this->datatables->select("sreturn_id, date_submit, customer_name,total_items, total, paid ");

	    $this->datatables->from('salesreturn'); 

		$action="<div class='text-center'><div class='btn-group'>";
		if($this->site->route_permission('salereturn_view')) {
			$action.="<a href='#' onClick=\"MyWindow=window.open('" . site_url('salereturn/view/$1/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("view invoice")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a>";
		}

		if($this->site->route_permission('salereturn_delete')) {
			$action.=" <a href='" . site_url('salereturn/delete/$1') . "' onClick=\"return confirm('You are going to delete Service, please click ok to delete')\" title='Delete service' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

	    $this->datatables->add_column("Actions", $action, "sreturn_id");
		
	    $this->datatables->unset_column('sreturn_id');

	    echo $this->datatables->generate();
	}
	 
    function selectInvoice() {

		$this->$data['action'] = "salereturn/add" ;
		$this->data['page_title'] = 'Sales Return';

		$bc = array(array('link' => site_url('Add service'), 'page' => 'Sales Return'), array('link' => '#', 'page' => 'Sales Return'));

		$meta = array('page_title' => 'Sales Return', 'bc' => $bc);
		// echo "<pre>".print_r($this->data);die;
		
	    $this->load->view($this->theme.'salesreturn/selectInvoice', $this->data);

	}
		
	function ajaxValue() {
			  
		$search = $this->uri->segment(3);
        
		$search =  str_replace("__"," ",$search);
		
		$results = $this->salesreturn_model->getInvoice($search);		
		
		if( count($results) >0 ){
		
		foreach($results as $result){  
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
			  <li class="invoice-code">No matching records found</li>
			</ul>
			<?php }
			

		}
		
	function invoicProduct($sale_id) {			 
		
		$this->load->model('pos_model');
		
		$inv = $this->pos_model->getSaleByID($sale_id);
		
		$this->data['inv'] = $inv;
		
		$this->data['rows'] = $this->pos_model->getAllSaleItems($sale_id);

		$bc = array(array('link' => site_url('Add Sales Return'), 'page' => 'Service'), array('link' => '#', 'page' => 'Add Sales Return'));

		$meta = array('page_title' => 'Add Sales Return', 'bc' => $bc);
		
	    $this->load->view($this->theme.'salesreturn/invoicProduct', $this->data);

	}		
		
	function add() {
		if(!$this->site->route_permission('salereturn_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
		/* $sela_item_id = $this->input->post('sela_item_id');
		$ids ='';
		  foreach($sela_item_id  as $id ){
			$ids = $ids ."'".$id."',";
		  } */
		$sela_item_id = isset($_POST['sela_item_id']) ? sizeof($_POST['sela_item_id']) : 0;
		$ids ='';
		for($i=0; $i< $sela_item_id ; $i++){
			$ids = $ids ."'".$_POST['sela_item_id'][$i]."',";
		}
		$ids = preg_replace('~,(?!.*,)~', '', $ids);  
		
		if($ids==''){ 
			
			redirect('salereturn');
			
		}
		
		$this->data['saleItems'] = $this->salesreturn_model->getSaleItems($ids); 

		$saleItems = $this->salesreturn_model->getSaleItems($ids); 
		
		$this->data['sale_info'] = $this->salesreturn_model->getSaleInfo($this->data['saleItems'][0]->sale_id );
		
		$this->data['page_title'] = 'Add Sales Return';

		$bc = array(array('link' => site_url('salereturn'), 'page' => 'Service'), array('link' => '#', 'page' => 'New Sales Return'));

		$meta = array('page_title' => 'Sales Return', 'bc' => $bc); 

		$this->page_construct('salesreturn/add', $this->data, $meta);		

	}

  	function addsalesreturn(){ 
		if(!$this->site->route_permission('salereturn_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
		if($this->input->post('save_invoice') !=''){

		$date = date('Y-m-d H:i:s'); 
			
			$data = array(
				
				'date_submit'   =>  $date,

				'sale_id'	   => $this->input->post('sale_id'),
				
				'customer_id'   => $this->input->post('customer_id'),
				
				'customer_name' => $this->input->post('customer_name'),
				
				'total'         => $this->input->post('total'),

				'total_quantity'=> $this->input->post('totalQty'),

				'paid' 			=> $this->input->post('paid'),
				
				'total_items'   => $this->input->post('total_item'),
				
				'created_by'    => $this->session->userdata('user_id'),

				'store_id'		=> $this->input->post('storeid'), 
				
			); 

			if($return_id = $this->salesreturn_model->addsalesreturn($data)){	

				$total_item = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;
				for($i=0; $i< $total_item ; $i++){ 			
					$product_id = $_POST['product_id'][$i];	
					$quantity = $_POST['quantity'][$i];		
					$unit_price = $_POST['unit_price'][$i];			
					$subtotal = $_POST['subtotal'][$i];
					$net_unit_price = $_POST['net_unit_price'][$i];
					$discount = $_POST['discount'][$i];
					$item_discount = $_POST['item_discount'][$i];
					$tax = $_POST['tax'][$i];
					$item_tax = $_POST['item_tax'][$i];
					$real_unit_price = $_POST['real_unit_price'][$i];		
					$cost = $_POST['cost'][$i];
					$store_id = $_POST['store_id'][$i];
					$sale_id = $_POST['sales_id'][$i];
					$return_amount = $_POST['return_amount'][$i];
					$return_qty = $_POST['return_qty'][$i];
					$problem = $_POST['problem'][$i];	
					$item_id = $_POST['item_id'][$i]; 
					//$pid = $_POST['product_id'];
                	$sequenceids = $_POST['sequenceid'][$i]; 

                    //$sequence = array_combine($pid,$sqno);

					$dataItems = array(			
						'sreturn_id'   	=> $return_id,
						'product_id'   	=> $product_id ,
						'quantity'     	=> $quantity,				
						'unit_price'    => $unit_price,
						'net_unit_price'=> $net_unit_price,
						'discount' 		=> $discount,
						'item_discount' => $item_discount,
						'tax'			=> $tax,
						'item_tax' 		=> $item_tax,
						'subtotal'		=> $subtotal,
						'real_unit_price'=> $real_unit_price,
						'cost'			=> $cost,
						'store_id'		=> $store_id,
						'return_amount' => $return_amount,
						'return_qty'	=> $return_qty,
						'sale_id'		=> $sale_id,
						'sale_item_id'  => $item_id,
						'problem'		=> $problem,
						'sequence_id'	=> $sequenceids,	
				   );				   
				$this->salesreturn_model->addSreturnItems($dataItems,$sequenceids); 
			  }
			 
			} 		 
			 
		} 
		redirect('salereturn');
		
	}

	public function sequencereturn($pid,$sid,$row,$qty,$storeSequence){ 
		$this->data['pid'] = $pid;
		$this->data['sid'] = $sid;
		$this->data['row_no'] = $row;
		$this->data['qty'] = $qty;
		$this->data['storeSequence'] = $storeSequence;
        $this->data['title'] = 'Return products sequence'; 
        $this->load->view($this->theme.'salesreturn/squencereturn', $this->data);
	} 
		
 	function view($id) {
		if(!$this->site->route_permission('salereturn_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
		//$this->data['parts'] = $this->service_model->getParts($id);
		 
		$saleItems = $this->salesreturn_model->getSaleItemsEdit($id); 
		
		$this->data['saleItems'] = $saleItems ;
		
		$sreturn_id  = $saleItems[0]->sreturn_id ; 
		
		$this->data['service_info'] = $this->salesreturn_model->getSeviceInfo($sreturn_id);	
		
		$this->data['page_title'] = 'Service invoice';

		$bc = array(array('link' => site_url('service'), 'page' => 'Service'), array('link' => '#', 'page' => 'Service invoice'));

		$meta = array('page_title' => 'Service invoice', 'bc' => $bc);
		 
		$this->load->view($this->theme.'salesreturn/view', $this->data);

	}
		
    function paymentsList($id){
		$this->data['pay'] =  $this->service_model->listPayment($id) ;
		  
		$this->data['title'] = 'Payments View';
		
		$this->load->view($this->theme . 'service/paymentsList', $this->data);	
	 }
	
    function delete($id = NULL){

		if(DEMO) {

            $this->session->set_flashdata('error', lang('disabled_in_demo'));

            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');

        }

		if($this->input->get('id')){ $id = $this->input->get('id'); }

		if(!$this->site->route_permission('salereturn_delete')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
		/* if (!$this->Admin) {
			$this->session->set_flashdata('error', lang("access_denied"));
			redirect('salereturn');
		} */

		$salesreturn =  $this->site->findeNameByID('salesreturn','sreturn_id',$id);

		//sale   update
		//print_r($salesreturn);
		$saleData =  $this->site->findeNameByID('sales','id',$salesreturn->sale_id);
		//print_r($saleData); 	

		$saleItemData =  array('return_id' =>NULL);
		$this->salesreturn_model->SelsUpdate($salesreturn->sale_id,$saleItemData); 

		$sreturn_id =  $this->site->getDataByElement('sreturn_items','sreturn_id',$id);

		$store_id = $salesreturn->store_id ;

		$sale_id = $salesreturn->sale_id ;

		foreach ($sreturn_id as $key => $value) {

			$sequence_id = $value->sequence_id;

			$quantity  = $value->quantity ;
			$product_id  = $value->product_id ;
			$this->salesreturn_model->storeProQtyDelete($product_id ,$value->return_qty,$store_id);
			$saleItemData =  array('return_item_id' => NULL);
			$this->salesreturn_model->SelsItemUpdate($value->sale_item_id,$saleItemData);

       		$proData =  $this->site->findeNameByID('products','id',$product_id );
       		$proQty = $proData->quantity - $value->return_qty;
       		$dataPro = array('quantity' =>$proQty );
       		$this->salesreturn_model->ProQtyUpdate($value->product_id,$dataPro);
       		$sequence = trim($sequence_id,",");
       		$sequence = (explode(",",$sequence)) ;
			foreach ($sequence as $key => $item) {
				$dataUpdate = array(
					'sales_id' => $sale_id,
					'status' => 1);
				$this->salesreturn_model->upadteSequence($item,$dataUpdate);
			}
		}

		if ( $this->salesreturn_model->deleteInvoice($id) ) {

			$this->session->set_flashdata('message', 'Sale return deleted');

			redirect('salereturn');

		}

	   }
	
 
}




