<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_purchases extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {            
            redirect('login');            
        }
        if(!$this->site->permission('mf_purchases'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }
        
        $this->load->library('form_validation');
        
        $this->load->model('mf_purchases_model');
        
        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';

        $incSequence = null;
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }
       
    function index() { 
        if(!$this->site->route_permission('mf_purchases_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['stores'] = $this->site->getAllStores();
        $this->data['page_title'] = lang('purchases');
        
        $bc = array(
            array(
                'link' => '#',
                'page' => lang('purchases')
            )
        );
        
        $meta = array(
            'page_title' => lang('purchases'),
            'bc' => $bc
        );
        
        $this->page_construct('mf_purchases/index', $this->data, $meta);
        
    }
    
    function get_purchases() { 
        $store_id = $this->input->get('store_id') ? $this->input->get('store_id') : 0;   
        $this->load->library('datatables');
        
        $this->datatables->select($this->db->dbprefix('mf_purchases') . ".id as id, " . 
                      
            $this->db->dbprefix('mf_purchases') . ".date as date , supplier_id," .  

            $this->db->dbprefix('mf_suppliers') . ".name as cname , total, paid , deu ", FALSE);
        
        $this->datatables->join('mf_suppliers', 'mf_suppliers.id=mf_purchases.supplier_id');
        $this->datatables->join('stores', 'stores.id=mf_purchases.store_id');         
        $this->datatables->from('mf_purchases');        
        $this->datatables->group_by('mf_purchases.id');

        $action="<div class='text-center'><div class='btn-group'>";
		if($this->site->route_permission('mf_purchases_view')) {
			$action.="<a onclick=\"window.open('" . site_url('mf_purchases/view/$1') . "', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print Purchase' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> ";
		}
		if($this->site->route_permission('mf_purchases_edit')) {
			$action.="<a href='" . site_url('mf_purchases/edit/$1') . "' title='" . lang("edit_purchase") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
		}
		if($this->site->route_permission('mf_purchases_delete')) {
			$action.="<a href='" . site_url('mf_purchases/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_purchase') . "')\" title='" . lang("delete_purchase") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

        $this->datatables->add_column("Actions",$action, "id , supplier_id , cname ");

        // if ($today != NULL) {
        //     $this->datatables->like('date', $today);            
        // }

        if($store_id){$this->datatables->where('mf_purchases.store_id',$store_id);}
        
        $this->datatables->unset_column('supplier_id');
        
        echo $this->datatables->generate();
        
    }
    
    function view($id = NULL) { 
        if(!$this->site->route_permission('mf_purchases_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->data['mf_purchase'] = $this->mf_purchases_model->getPurchaseByID($id);
        
        $supplier_id = $this->data['mf_purchase']->supplier_id;
        
        $this->data['s_name'] = $this->mf_purchases_model->getSupplierInfo($supplier_id)->name;
        
        $rows = $this->mf_purchases_model->getParchasePay($id);
        if ($rows == FALSE) {
            $totla_pay = 0;
        } else {
            $totla_pay = 0;
            foreach ($rows as $row) {
                $totla_pay = $totla_pay + $row->amount;
            }
            
        } 
        
        $this->data['paid_amount'] = $totla_pay;
        
        $totla_amount = $this->data['mf_purchase']->total;
        
        $this->data['due_amount'] = $totla_amount - $totla_pay;
        
        $pay = $this->mf_purchases_model->getParInfo($id);
        
        $this->data['pay'] = $pay;
        
        $this->data['items'] = $this->mf_purchases_model->getAllPurchaseItems($id);
        
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
        $this->data['page_title'] = lang('view_purchase');
        
        $this->load->view($this->theme . 'mf_purchases/view', $this->data);
        
    }
    
    function add() {  
        if(!$this->site->route_permission('mf_purchases_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->form_validation->set_rules('date', lang('date'), 'required');
        $this->form_validation->set_rules('mf_supplier_id', lang('supplier'), 'required');
        $this->form_validation->set_rules('store_id', lang('Store'), 'required');

        if ($this->form_validation->run() == true) {
            
            $total = 0;
            $store_id=$this->input->post('store_id');
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;            
            
            for ($r = 0; $r < $i; $r++) {  

                $item_id = $_POST['product_id'][$r];
                $item_qty = $_POST['quantity'][$r];              
                $item_cost = $_POST['cost'][$r]; 
                $brand_id = $_POST['brand_id'][$r]; 
                
                if ($item_id && $item_qty ) { 
                    
                    if (!$this->site->getMaterialByID($item_id)) {                        
                        $this->session->set_flashdata('error', $this->lang->line("product_not_found") . " ( " . $item_id . " ).");
                        redirect('mf_purchases/add');
                    }      

                    $products[] = array(           
                        'brand_id' => $brand_id,                    
                        'store_id' => $store_id,                    
                        'material_id' => $item_id,                    
                        'cost' => $item_cost,                    
                        'quantity' => $item_qty,                   
                        'subtotal' => ($item_cost * $item_qty),                        
                    ); 
                    $total += ($item_cost * $item_qty);                    
                }                
            }                        
            
            if (!isset($products) || empty($products)) {                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');
                $this->form_validation->set_rules('mf_supplier_id', lang("order_items"), 'required');
                
            } else {                
                krsort($products);                
            }            
            $total=$total+$this->input->post('transport_cost');
            $data = array(                
                'date' => $this->input->post('date'),                                             
                'supplier_id' => $this->input->post('mf_supplier_id'),          
                'transport_cost' => $this->input->post('transport_cost'),
                'total' => $total,                                                               
                'deu' => $total,
                'created_by' => $this->session->userdata('user_id'),               
                'store_id' => $this->input->post('store_id'),
                'created_at' =>  date('Y-m-d H:i:s'),               
            );
            // $this->tec->print_arrays($data, $products);
        }
        
        if ($this->form_validation->run() == true && $this->mf_purchases_model->addPurchase($data, $products)) {
            
            $this->session->set_userdata('remove_spo', 1);            
            $this->session->set_flashdata('message', lang('purchase_added'));
            
            redirect("mf_purchases");
            
        } else {           
                        
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));            
            $this->data['mf_suppliers'] = $this->site->getAllMfSuppliers();    
            $allBrands=$this->site->seleteQuery('mf_brands');       
            $this->data['allBrand'] = json_encode((array)$allBrands);      

            // print_r((array)$nnn);die;
            $this->data['page_title'] = lang('add_purchase');
            
            $bc = array(
                array(
                    'link' => site_url('purchases'),
                    'page' => lang('purchases')
                ),
                array(
                    'link' => '#',
                    'page' => lang('add_purchase')
                )
            );
            
            $meta = array(
                'page_title' => lang('add_purchase'),
                'bc' => $bc
            );
            $this->session->unset_userdata('squNo');
            $lastProSeque = $this->mf_purchases_model->lastProSeque();
            if(isset($lastProSeque->sequence))
            {
                $this->data['lastProSeque'] =  $startsqe = filter_var($lastProSeque->sequence, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            else{$this->data['lastProSeque'] = '';}
            $this->page_construct('mf_purchases/add', $this->data, $meta);
        }
        
    }       
    
    function edit($id = NULL) {
        
        if(!$this->site->route_permission('mf_purchases_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        
        if ($this->input->get('id')) {            
            $id = $this->input->get('id');            
        }
        
        $this->form_validation->set_rules('date', lang('date'), 'required');        
        
        if ($this->form_validation->run() == true) {
            
            $total = 0;
            
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;
            
            for ($r = 0; $r < $i; $r++) {
                
                $item_id = $_POST['product_id'][$r];
                $item_qty = $_POST['quantity'][$r];              
                $item_cost = $_POST['cost'][$r]; 
                $brand_id = $_POST['brand_id'][$r]; 
 
                if ($item_id && $item_qty) {
                    
                    if (!$this->site->getProductByID($item_id)) {
                        
                        $this->session->set_flashdata('error', $this->lang->line("product_not_found") . " ( " . $item_id . " ).");
                        redirect('mf_purchases/edit/' . $id);
                        
                    }
                    
                    $products[] = array( 
                        'material_id' => $item_id,                    
                        'brand_id' => $brand_id,                   
                        'cost' => $item_cost,                    
                        'quantity' => $item_qty,                   
                        'subtotal' => ($item_cost * $item_qty)
                    );
                    
                    $total += ($item_cost * $item_qty);
                    
                }
                
            }           
            
            
            if (!isset($products) || empty($products)) {                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');                
            } else {                
                krsort($products);                
            }         

            $paid = $this->mf_purchases_model->getParchaseInfo($id);        
            $paid = $paid->paid;
            
            $total=$total+$this->input->post('transport_cost');

            $data = array(
                'date' => $this->input->post('date'),                                                      
                'transport_cost' => $this->input->post('transport_cost'),
                'total' => $total,                                                               
                'deu' => $total - $paid, 
                'updated_by' => $this->session->userdata('user_id'),   
                'updated_at' =>  date('Y-m-d H:i:s'),              
            );                       
        }      

        if ($this->form_validation->run() == true && $this->mf_purchases_model->updatePurchase($id, $data, $products)) {           
                        
            $this->session->set_userdata('remove_spo', 1);            
            $this->session->set_flashdata('message', lang('purchase_updated'));            
            redirect("mf_purchases");
            
        } else {
            
            $this->data['mf_purchase'] = $this->mf_purchases_model->getPurchaseByID($id);            
            $inv_items = $this->mf_purchases_model->getAllPurchaseItems($id);             
            $c = rand(100000, 9999999);
       
            $transport_cost=0;
            foreach ($inv_items as $item) {
                $row = $this->site->getMaterialByID($item->material_id);        
                $row->qty = $item->quantity;                
                $row->cost = $item->cost;
                $row->brand = $item->brand_id;
 
                $ri = $this->Settings->item_addition ? $row->id : $c;
                
                $pr[$ri] = array(
                    'id' => $ri,
                    'item_id' => $row->id,
                    'label' => $row->name,
                    'row' => $row
                );
                
                $c++;
                $transport_cost=$item->transport_cost;
            }            
            
            $this->data['transport_cost'] = $transport_cost;           
            $this->data['items'] = json_encode($pr);           
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $allBrands=$this->site->seleteQuery('mf_brands');       
            $this->data['allBrand'] = json_encode((array)$allBrands);  
            
            $this->data['page_title'] = lang('edit_purchase');
            
            $bc = array(
                array(
                    'link' => site_url('purchases'),
                    'page' => lang('purchases')
                ),
                array(
                    'link' => '#',
                    'page' => lang('edit_purchase')
                )
            );
            
            $meta = array(
                'page_title' => lang('edit_purchase'),
                'bc' => $bc
            );
            
            $this->page_construct('mf_purchases/edit', $this->data, $meta);        
            
        }
        
    }       
    
    function delete($id = NULL) {
        
        if (DEMO) {            
            $this->session->set_flashdata('error', lang('disabled_in_demo'));            
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');            
        }
        
        if(!$this->site->route_permission('mf_purchases_delete')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        
        if ($this->input->get('id')) {            
            $id = $this->input->get('id');            
        }        
        
        if ($this->mf_purchases_model->deletePurchase($id)) {            
            $this->session->set_flashdata('message', lang("purchase_deleted"));            
            redirect('mf_purchases');            
        }
        
    }
    
    function suggestions($id = NULL) {
        
        if ($id) {
            
            $row = $this->site->getProductByID($id);
            
            $row->qty = 1;
            
            $pr = array(
                'id' => str_replace(".", "", microtime(true)),
                'item_id' => $row->id,
                'label' => $row->name . " (" . $row->code . ")",
                'row' => $row
            );
            
            echo json_encode($pr);
            
            die();
            
        }
        
        $term = $this->input->get('term', TRUE);
        
        $rows = $this->mf_purchases_model->getProductNames($term);
        
        if ($rows) {
            
            foreach ($rows as $row) {
                
                $row->qty = 1;
                
                $pr[] = array(
                    'id' => str_replace(".", "", microtime(true)),
                    'item_id' => $row->id,
                    'label' => $row->name,
                    'row' => $row
                );
                
            }
            
            echo json_encode($pr);
            
        } else {
            
            echo json_encode(array(
                array(
                    'id' => 0,
                    'label' => lang('no_match_found'),
                    'value' => $term
                )
            ));
            
        }
        
    }
    
    function listParPay($id) {
        
        $pay               = $this->mf_purchases_model->getParInfo($id);
        $this->data['pay'] = $pay;
        $this->load->view($this->theme . 'mf_purchases/list_par_pay', $this->data);
        
        
    }
    
    function add_payment($id = NULL) {
        
        $this->load->helper('security');
        
        $ParchaseInfo = $this->mf_purchases_model->getParchaseInfo($id);
        $supplier_id  = $ParchaseInfo->supplier_id;
        
        $paid = $ParchaseInfo->paid;
        
        $deu_amount = $ParchaseInfo->deu;
        
        $this->data['title'] = 'Add Payment';
        
        $this->form_validation->set_rules('amount-paid', lang("amount"));
        
        if ($this->input->post('add_payment')) {

            $payPaymentdata = array(
                        'payment_date' => date('Y-m-d H:i'),
                        'payment_amount' => $this->input->post('amount-paid'),
                        'supplier_id' => $supplier_id,
                        'payment_note' => $this->input->post('note'),
                        );
        
            $todayPurchasePayment = $this->mf_purchases_model->payPayment($payPaymentdata);
            
            $payment = array(
                
                'date' => $this->input->post('date'),
                
                'purchases_id' => $id,
                
                'supplier_id' => $supplier_id,
                
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

                'todayP_Payment' => $todayPurchasePayment,
                
            );
            
            
            $amountData = array(
                
                'paid' => $paid + $this->input->post('amount-paid'),
                
                'deu' => (($deu_amount) - ($this->input->post('amount-paid')))
                
                
            );
            
            
            $this->mf_purchases_model->updateAmount($amountData, $id);
            
            
            
            $this->session->set_flashdata('message', lang("payment_added"));
            
            $this->mf_purchases_model->addPayment($payment);
            
            redirect($_SERVER["HTTP_REFERER"]);
            
        } else {
            
            
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            //   $sale = $this->sales_model->getSaleByID($id);
            
            //  $this->data['inv'] = $sale;
            
            
            
            $rows = $this->mf_purchases_model->getParchasePay($id);
            
            
            if ($rows == FALSE) {
                $totla_pay = 0;
            } else {
                $totla_pay = 0;
                foreach ($rows as $row) {
                    $totla_pay = $totla_pay + $row->amount;
                }
                
            }
            $totla_amount = $this->mf_purchases_model->getParchaseInfo($id);
            
            $this->data['due_amount'] = $totla_amount->total - $totla_pay;
            
            $this->data['type'] = 'Add';
            
            $this->data['action'] = site_url('mf_purchases/add_payment/' . $id);
            
            if ($this->data['due_amount'] < 1) {
                
                $this->data['error_alert'] = ' Already payment paid ! ';
                
                $this->load->view($this->theme . 'mf_purchases/alert', $this->data);
                
            } else {
                
                $this->load->view($this->theme . 'mf_purchases/add_payment', $this->data);
            }
            
        }
        
    }    
    
    function edit_payment($id) {
        $this->load->helper('security');
        
        $payment = $this->mf_purchases_model->getPaymentSingel($id);
        
        
        $this->data['pay_info'] = $payment;
        
        $this->data['title'] = 'Edit Payment';
        
        $this->form_validation->set_rules('amount-paid', lang("amount"));
        
        if ($this->input->post('add_payment')) {
            
            $payment = array(
                
                'date' => $this->input->post('date'),
                
                'reference' => $this->input->post('reference'),
                
                'amount' => $this->input->post('amount-paid'),
                
                'note' => $this->input->post('note')
            );
            
            $this->session->set_flashdata('message', lang("payment_updated"));
            
            $this->mf_purchases_model->editPayment($payment, $id);
            
            $purchases_id = $this->mf_purchases_model->getPaymentSingel($id)->purchases_id;
            
            $total_amount = $this->mf_purchases_model->getParchaseInfo($purchases_id)->total;
            
            $rows = $this->mf_purchases_model->getParchasePay($purchases_id);
            
            if ($rows == FALSE) {
                $totla_pay = 0;
            } else {
                $totla_pay = 0;
                foreach ($rows as $row) {
                    $totla_pay = $totla_pay + $row->amount;
                }
                
            }
            
            $due_amount = $total_amount - $totla_pay;
            
            $amountData = array(
                
                'paid' => $totla_pay,
                
                'deu' => $due_amount
                
                
            );
            
            
            $this->mf_purchases_model->updateAmount($amountData, $purchases_id);
            
            redirect($_SERVER["HTTP_REFERER"]);
            
        } else {
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            $purchases_id = $this->mf_purchases_model->getPaymentSingel($id)->purchases_id;
            
            $due_amount = $this->mf_purchases_model->getParchaseInfo($purchases_id)->deu;
            
            $this->data['due_amount'] = $due_amount;
            
            $this->data['type'] = 'edit';
            
            $this->data['action'] = site_url('mf_purchases/edit_payment/' . $id);
            
            if ($payment->paid_by == 'cash') {
                
                
                $this->load->view($this->theme . 'mf_purchases/add_payment', $this->data);
                
            } else {
                
                $this->data['error_alert'] = 'Only cash payments can be edited ';
                
                $this->load->view($this->theme . 'mf_purchases/alert', $this->data);
                
            }
            
        }
        
    }

    public function checkDB($sequence, $seqId = NULL){        
      if($sequence==''){
         echo "this field is required";
      }else{
      $this->data['sequence'] = $this->mf_purchases_model->checkedSequence();  
            foreach ($this->data['sequence'] as $key => $value) {
                if($value->sequence==$sequence){ 
                    echo "<br>This sequence Already taken";
                }                   
            }   
        }
    
    }

    public function checkDBedit($sequence, $seqId = NULL){        
      if($sequence==''){
         echo "this field is required";
      }else{
      $sequenceCheck = $this->mf_purchases_model->checkDBedit($sequence, $seqId);  
             
        }
     if($sequenceCheck != FALSE){
        echo "<br>This sequence Already taken";
     }
    
    }
 
}