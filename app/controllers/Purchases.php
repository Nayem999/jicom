<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchases extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {
            
            redirect('login');
            
        }
        
        $this->load->library('form_validation');
        
        $this->load->model('purchases_model');
        
        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';

        $incSequence = null;
        
    }
    
    public function today() { 
        
        $this->data['page_title'] = 'Today Purchases';
        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Today Purchases'
            )
        );
        
        $meta = array(
            'page_title' => 'Today Purchases',
            'bc' => $bc
        );
        
        $this->page_construct('purchases/today', $this->data, $meta);
    }    
    
    function index() { 
        
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
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
        
        $this->page_construct('purchases/index', $this->data, $meta);
        
    }
    
    function get_purchases($today = NULL) { 
        $this->load->library('datatables');
        
        $this->datatables->select($this->db->dbprefix('purchases') . ".id as id, " . 
                      
            $this->db->dbprefix('purchases') . ".date as date , reference,  " .  
            $this->db->dbprefix('suppliers') . ".name as cname , total, paid , deu , note, attachment", FALSE);
        
        $this->datatables->join('suppliers', 'suppliers.id=purchases.supplier_id');
        $this->datatables->join('stores', 'stores.id=purchases.store_id'); 
        
        $this->datatables->from('purchases');
        
        $this->datatables->group_by('purchases.id');

        if($data = $this->session->userdata('group_id')==1){
            $actdata = "<a onclick=\"window.open('" . site_url('purchases/view/$1') . "', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print Purchase' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> ";
            $actdata .= "<a href='" . site_url('purchases/edit/$1') . "' title='" . lang("edit_purchase") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>"; 

            $actdata .= " <a href='" . site_url('suppliers/purchases/$2') . "'   title='List of ($3)'  class='tip btn btn-warning btn-xs'><i class='fa fa-user'></i>";
            $actdata .= "<a href='" . site_url('purchases/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_purchase') . "')\" title='" . lang("delete_purchase") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
          }else {
          $actdata = "<a onclick=\"window.open('" . site_url('purchases/view/$1') . "', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print Purchase' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> ";

          }
           $this->datatables->add_column("Actions", "
        <div class='text-center'>
          <div class='btn-group'>".$actdata."</div></div>", "id , supplier_id , cname ");
        
        if ($today != NULL) {
            
            $this->datatables->like('date', $today);
            
        }

        if(!$this->Admin){
           $this->datatables->where('purchases.store_id',$this->session->userdata('store_id'));
        }
        
        //$this->datatables->unset_column('id')->unset_column('supplier_id');
        $this->datatables->unset_column('supplier_id');
        
        echo $this->datatables->generate();
        
    }
    
    function view($id = NULL) { 

        $this->data['purchase'] = $this->purchases_model->getPurchaseByID($id);
        
        $supplier_id = $this->data['purchase']->supplier_id;
        
        $this->data['s_name'] = $this->purchases_model->getSupplierInfo($supplier_id)->name;
        
        $rows = $this->purchases_model->getParchasePay($id);
        if ($rows == FALSE) {
            $totla_pay = 0;
        } else {
            $totla_pay = 0;
            foreach ($rows as $row) {
                $totla_pay = $totla_pay + $row->amount;
            }
            
        } 
        
        $this->data['paid_amount'] = $totla_pay;
        
        $totla_amount = $this->data['purchase']->total;
        
        $this->data['due_amount'] = $totla_amount - $totla_pay;
        
        $pay = $this->purchases_model->getParInfo($id);
        
        $this->data['pay'] = $pay;
        
        $this->data['items'] = $this->purchases_model->getAllPurchaseItems($id);
        
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
        $this->data['page_title'] = lang('view_purchase');
        
        $this->load->view($this->theme . 'purchases/view', $this->data);
        
    }
    
    function add() {  
        
        $this->form_validation->set_rules('date', lang('date'), 'required');
        $this->form_validation->set_rules('supplier', lang('supplier'), 'required');
        
        if ($this->form_validation->run() == true) {
            
            $total = 0;
            
            $quantity = "quantity";
            
            $product_id = "product_id";
            
            $unit_cost = "cost";  
            
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;            
            
            for ($r = 0; $r < $i; $r++) {
                
                $item_id = $_POST['product_id'][$r];

                $sqfrom = $_POST['sqfrom'][$r]; 

                $pid = $_POST['product_id'];

                $sqno = $_POST['getsequence']; 

                $sequence = array_combine($pid,$sqno); 

                $item_qty = $_POST['quantity'][$r];

                $expiry_year = $_POST['expiry_year'][$r];
                
                $item_cost = $_POST['cost'][$r]; 
                
                if ($item_id && $item_qty && $unit_cost && $sequence) { 
                    
                    if (!$this->site->getProductByID($item_id)) {
                        
                        $this->session->set_flashdata('error', $this->lang->line("product_not_found") . " ( " . $item_id . " ).");
                        
                        redirect('purchases/add');
                    }               
                $products[] = array(
                    
                    'product_id' => $item_id,
                    
                    'cost' => $item_cost,
                    
                    'quantity' => $item_qty,

                    'expiry_year' =>$expiry_year,
                    
                    'subtotal' => ($item_cost * $item_qty),
                    
                );                      
                    
                    $total += ($item_cost * $item_qty);
                    
                }
                
            }
                        
            
            if (!isset($products) || empty($products)) {                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');
                $this->form_validation->set_rules('supplier', lang("order_items"), 'required');
                
            } else {
                
                krsort($products);
                
            }
            
            $data = array(
                
                'date' => $this->input->post('date'),
                
                'reference' => $this->input->post('reference'),
                
                'note' => $this->input->post('note', TRUE),
                
                'supplier_id' => $this->input->post('supplier'),
                
                'received' => $this->input->post('received'),
                
                'total' => $total,                
                
                'deu' => $total,

                'created_by' => $this->session->userdata('user_id'),               
                
            );  
            if(!$this->Admin){
                 $data['store_id'] = $this->session->userdata('store_id');
            }else{
                 $data['store_id'] =$this->input->post('warehouse');
            }
            
            if ($_FILES['userfile']['size'] > 0) {
                
                $this->load->library('upload');
                
                $config['upload_path'] = 'uploads/';
                
                $config['allowed_types'] = $this->allowed_types;
                
                $config['max_size'] = '2000';
                
                $config['overwrite'] = FALSE;
                
                $config['encrypt_name'] = TRUE;
                
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload()) {
                    
                    $error = $this->upload->display_errors();
                    
                    $this->upload->set_flashdata('error', $error);
                    
                    redirect("purchases/add");
                    
                }
                
                $data['attachment'] = $this->upload->file_name;
                
            }
            
            // $this->tec->print_arrays($data, $products);
            
        }
        
        if ($this->form_validation->run() == true && $this->purchases_model->addPurchase($data, $products,$sequence)) {
            
            $this->session->set_userdata('remove_spo', 1);
            
            $this->session->set_flashdata('message', lang('purchase_added'));
            
            redirect("purchases");
            
        } else {           
            
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            $this->data['suppliers'] = $this->site->getAllSuppliers();

            $this->data['warehouses'] = $this->site->getAllStores(); 
            
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
            $lastProSeque = $this->purchases_model->lastProSeque();
            if(isset($lastProSeque->sequence))
            {
                $this->data['lastProSeque'] =  $startsqe = filter_var($lastProSeque->sequence, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
            }
            else{$this->data['lastProSeque'] = '';}
            $this->page_construct('purchases/add', $this->data, $meta);
        }
        
    }       
    
    function edit($id = NULL) {
        
        if (!$this->Admin) {
            
            $this->session->set_flashdata('error', lang('access_denied'));
            
            redirect('pos');
            
        }
        
        if ($this->input->get('id')) {
            
            $id = $this->input->get('id');
            
        }
        
        $paid = $this->purchases_model->getParchaseInfo($id);        
        
        $paid = $paid->paid;
        
        $this->form_validation->set_rules('date', lang('date'), 'required');        
        
        if ($this->form_validation->run() == true) {
            
            $total = 0;
            
            $quantity = "quantity";
            
            $product_id = "product_id";
            
            $unit_cost = "cost";
            
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;
            
            for ($r = 0; $r < $i; $r++) {
                
                $item_id = $_POST['product_id'][$r];
                
                $item_qty = $_POST['quantity'][$r];
                
                $item_cost = $_POST['cost'][$r];

                $expiry_year = $_POST['expiry_year'][$r]; 

                $sqno = $_POST['getsequence'][$r];

               // $sequence = array_combine($pid,$sqno);

                $this->purchases_model->deleteSequence($id,$item_id);
                $this->purchases_model->AddSequence($id,$item_id,$sqno);
                
                if ($item_id && $item_qty && $unit_cost) {
                    
                    if (!$this->site->getProductByID($item_id)) {
                        
                        $this->session->set_flashdata('error', $this->lang->line("product_not_found") . " ( " . $item_id . " ).");
                        
                        redirect('purchases/edit/' . $id);
                        
                    }
                    
                    $products[] = array(
                        
                        'product_id' => $item_id,
                        
                        'cost' => $item_cost,
                        
                        'quantity' => $item_qty,

                        'expiry_year' =>$expiry_year,
                        
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
            
            
            $data = array(
                
                'date' => $this->input->post('date'),
                
                'reference' => $this->input->post('reference'),
                
                'note' => $this->input->post('note', TRUE),
                
                'total' => $total,
                
                'deu' => $total - $paid               
                
                
            );           
            
            
            if ($_FILES['userfile']['size'] > 0) {                                
                
                $this->load->library('upload');
                
                $config['upload_path'] = 'uploads/';
                
                $config['allowed_types'] = $this->allowed_types;
                
                $config['max_size'] = '2000';
                
                $config['overwrite'] = FALSE;
                
                $config['encrypt_name'] = TRUE;
                
                $this->upload->initialize($config);
                
                if (!$this->upload->do_upload()) {
                    
                    $error = $this->upload->display_errors();
                    
                    $this->upload->set_flashdata('error', $error);
                    
                    redirect("purchases/add");
                    
                }
                
                $data['attachment'] = $this->upload->file_name;
                
            }
            
            // $this->tec->print_arrays($data, $products);
            
        }
        
        
        
        if ($this->form_validation->run() == true && $this->purchases_model->updatePurchase($id, $data, $products)) {           
            
            
            $this->session->set_userdata('remove_spo', 1);
            
            $this->session->set_flashdata('message', lang('purchase_updated'));
            
            redirect("purchases");
            
        } else {
            
            $this->data['purchase'] = $this->purchases_model->getPurchaseByID($id);

            $this->data['sequence'] = $this->site->getDataByElement('pro_sequence','purchases_id',$id);
            
            $inv_items = $this->purchases_model->getAllPurchaseItems($id); 
            
            $c = rand(100000, 9999999);
           
            // $paidss = $this->purchases_model->getLastSequence($id);        
            
            foreach ($inv_items as $item) {
                
                $row = $this->site->getProductByID($item->product_id);
                
                $row->qty = $item->quantity;
                
                $row->cost = $item->cost;

                $row->expiry_year = $item->expiry_year;

                $row->setval = $this->purchases_model->getAllSequence($id, $item->product_id);

                $row->set = $this->purchases_model->getLastSequence($id, $item->product_id);

                $ri = $this->Settings->item_addition ? $row->id : $c;
                
                $pr[$ri] = array(
                    'id' => $ri,
                    'item_id' => $row->id,
                    'label' => $row->name . " (" . $row->code . ")",
                    'row' => $row
                );
                
                $c++;
                
            }            
            
            $this->data['items'] = json_encode($pr);

            $this->data['segment'] = $this->uri->segment(3);
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            $this->data['suppliers'] = $this->site->getAllSuppliers();
            
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
            
            $this->page_construct('purchases/edit', $this->data, $meta);
            
            
            
        }
        
    }       
    
    function delete($id = NULL) {
        
        if (DEMO) {
            
            $this->session->set_flashdata('error', lang('disabled_in_demo'));
            
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');
            
        }
        
        if (!$this->Admin) {
            
            $this->session->set_flashdata('error', lang('access_denied'));
            
            redirect('pos');
            
        }
        
        if ($this->input->get('id')) {
            
            $id = $this->input->get('id');
            
        }        
        
        if ($this->purchases_model->deletePurchase($id)) {
            
            $this->session->set_flashdata('message', lang("purchase_deleted"));
            
            redirect('purchases');
            
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
        
        $rows = $this->purchases_model->getProductNames($term);
        
        if ($rows) {
            
            foreach ($rows as $row) {
                
                $row->qty = 1;
                
                $pr[] = array(
                    'id' => str_replace(".", "", microtime(true)),
                    'item_id' => $row->id,
                    'label' => $row->name . " (" . $row->code . ")",
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
        
        $pay               = $this->purchases_model->getParInfo($id);
        $this->data['pay'] = $pay;
        $this->load->view($this->theme . 'purchases/list_par_pay', $this->data);
        
        
    }
    
    function add_payment($id = NULL) {
        
        $this->load->helper('security');
        
        $ParchaseInfo = $this->purchases_model->getParchaseInfo($id);
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
        
            $todayPurchasePayment = $this->purchases_model->payPayment($payPaymentdata);
            
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
            
            
            $this->purchases_model->updateAmount($amountData, $id);
            
            
            
            $this->session->set_flashdata('message', lang("payment_added"));
            
            $this->purchases_model->addPayment($payment);
            
            redirect($_SERVER["HTTP_REFERER"]);
            
        } else {
            
            
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            //   $sale = $this->sales_model->getSaleByID($id);
            
            //  $this->data['inv'] = $sale;
            
            
            
            $rows = $this->purchases_model->getParchasePay($id);
            
            
            if ($rows == FALSE) {
                $totla_pay = 0;
            } else {
                $totla_pay = 0;
                foreach ($rows as $row) {
                    $totla_pay = $totla_pay + $row->amount;
                }
                
            }
            $totla_amount = $this->purchases_model->getParchaseInfo($id);
            
            $this->data['due_amount'] = $totla_amount->total - $totla_pay;
            
            $this->data['type'] = 'Add';
            
            $this->data['action'] = site_url('purchases/add_payment/' . $id);
            
            if ($this->data['due_amount'] < 1) {
                
                $this->data['error_alert'] = ' Already payment paid ! ';
                
                $this->load->view($this->theme . 'purchases/alert', $this->data);
                
            } else {
                
                $this->load->view($this->theme . 'purchases/add_payment', $this->data);
            }
            
        }
        
    }    
    
    function edit_payment($id) {
        $this->load->helper('security');
        
        $payment = $this->purchases_model->getPaymentSingel($id);
        
        
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
            
            $this->purchases_model->editPayment($payment, $id);
            
            $purchases_id = $this->purchases_model->getPaymentSingel($id)->purchases_id;
            
            $total_amount = $this->purchases_model->getParchaseInfo($purchases_id)->total;
            
            $rows = $this->purchases_model->getParchasePay($purchases_id);
            
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
            
            
            $this->purchases_model->updateAmount($amountData, $purchases_id);
            
            redirect($_SERVER["HTTP_REFERER"]);
            
        } else {
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            $purchases_id = $this->purchases_model->getPaymentSingel($id)->purchases_id;
            
            $due_amount = $this->purchases_model->getParchaseInfo($purchases_id)->deu;
            
            $this->data['due_amount'] = $due_amount;
            
            $this->data['type'] = 'edit';
            
            $this->data['action'] = site_url('purchases/edit_payment/' . $id);
            
            if ($payment->paid_by == 'cash') {
                
                
                $this->load->view($this->theme . 'purchases/add_payment', $this->data);
                
            } else {
                
                $this->data['error_alert'] = 'Only cash payments can be edited ';
                
                $this->load->view($this->theme . 'purchases/alert', $this->data);
                
            }
            
        }
        
    }
    public function pSequence($qty,$id,$row_no,$sequence,$allSequence  = NULL){ 
        $lastProSeque = $this->purchases_model->lastProSeque();
        $this->data['lastProSeque'] = $lastProSeque; 
        $this->data['qty'] = $qty;
       
        //$startsqe = filter_var($sequence, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        //$startcr = filter_var($sequence,  FILTER_SANITIZE_STRING);

        $words = preg_replace('/\D/', '=', $sequence );
        $startsqe  = preg_replace("/.*=/", "", $words); 
        $strlen = strlen($startsqe) ;
        $this->data['startsqe'] = $startsqe; 
        $startcr = substr($sequence, 0, - $strlen );
 
        $this->data['startcr'] = $startcr; 
        $squNo=''; 
        $lastItem= ''; 
            $qty = $qty+$startsqe;
               for ($sq=$startsqe; $sq < $qty; $sq++) { 
               $squNo[] = $startcr.$sq;
               $this->data['sequence'] = $this->purchases_model->checkedSequence();  
                foreach ($this->data['sequence'] as $key => $value) {
                    if($value->sequence==$startcr.$sq){ 
                        $filtersq[] = $value->sequence;
                    }                   
                } 
                
            }   
             
        $this->data['allSequence'] = $allSequence;
        $this->data['squNo'] = $squNo;
        $this->data['filtersq'] = $filtersq;
        $this->data['row_no'] = $row_no;
        $this->data['segment'] = $this->uri->segment(3);
        $this->data['title'] = 'Generate products sequence'; 
        $this->load->view($this->theme.'purchases/sequence', $this->data,$squNo, $qty,$row_no,$allSequence,$startsqe , $startcr);
    
    }
 public function pSequenceEdit($qty,$id,$row_no,$sequence, $purchases_id = NULL ,$allSequence  = NULL){ 
        $lastProSeque = $this->purchases_model->lastProSeque();
        $this->data['lastProSeque'] = $lastProSeque; 
        $this->data['qty'] = $qty;
       
        //$startsqe = filter_var($sequence, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        //$startcr = filter_var($sequence,  FILTER_SANITIZE_STRING);

        $words = preg_replace('/\D/', '=', $sequence );
        $startsqe  = preg_replace("/.*=/", "", $words); 
        $strlen = strlen($startsqe) ;
        $this->data['startsqe'] = $startsqe; 
        $startcr = substr($sequence, 0, - $strlen );
 
        $this->data['startcr'] = $startcr; 
        $squNo=''; 
        $lastItem= ''; 
            $qty = $qty+$startsqe;
               for ($sq=$startsqe; $sq < $qty; $sq++) { 
               $squNo[] = $startcr.$sq;
               $this->data['sequence'] = $this->purchases_model->checkedSequence();  
                foreach ($this->data['sequence'] as $key => $value) {
                    if($value->sequence==$startcr.$sq){ 
                        $filtersq[] = $value->sequence;
                    }                   
                } 
                
            }   
        if($purchases_id){
        $data  = $this->purchases_model->getAllSequenceS($purchases_id, $id);
        $this->data['results'] = $data ;
        }

        $this->data['purchases_id'] = $purchases_id ;     
        $this->data['allSequence'] = $allSequence;
        $this->data['squNo'] = $squNo;
        $this->data['filtersq'] = $filtersq;
        $this->data['row_no'] = $row_no;
        $this->data['segment'] = $this->uri->segment(3);
        $this->data['title'] = 'Generate products sequence'; 
        $this->load->view($this->theme.'purchases/sequenceEdit', $this->data);
    
    }




    public function checkDB($sequence, $seqId = NULL){        
      if($sequence==''){
         echo "this field is required";
      }else{
      $this->data['sequence'] = $this->purchases_model->checkedSequence();  
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
      $sequenceCheck = $this->purchases_model->checkDBedit($sequence, $seqId);  
             
        }
     if($sequenceCheck != FALSE){
        echo "<br>This sequence Already taken";
     }
    
    }

    public function SeqcheckDB($sequence){  
        $sequence = trim($sequence,",");
        $sequence = (explode(",",$sequence)) ;
           $result = $this->purchases_model->SequenceCheck($sequence);
           if($result != FALSE){
                echo "Please add your correct sequence number";
           }
    }

    public function SeqcheckDBedit($sequence, $sequenceId){  
        $sequence = trim($sequence,",");
        $sequence = (explode(",",$sequence)) ;

        $sequenceId = trim($sequenceId,",");
        $sequenceId = (explode(",",$sequenceId)) ;

           $result = $this->purchases_model->SequenceCheckEdit($sequence , $sequenceId );
           if($result != FALSE){
                echo "Please add your correct sequence number";
           }
    }

    public function suppliserInfoByStore($store_id) { 
      $suppliers = $this->site->getAllSuppliers($store_id);
        ?>
        
    <label class="control-label" for="supplier"><?= lang("supplier"); ?></label>

    <?php

    $cu[''] = lang("select")." ".lang("supplier");

    foreach($suppliers as $supplier){

        $cu[$supplier->id] = $supplier->name .' ('.$this->site->findeNameByID('stores','id',$supplier->store_id)->name.')';

    }

    echo form_dropdown('supplier', $cu, set_value('supplier'), 'class="form-control select2" style="width:100%" id="supplier"'); ?>

   <?php  }
}