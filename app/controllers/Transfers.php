<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {
            
            redirect('login');
            
        }
        
        $this->load->library('form_validation');
        
        $this->load->model('purchases_model');

        $this->load->model('transfers_model');
        
        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';

        $incSequence = null;

        if (!$this->Admin) {
            
            $this->session->set_flashdata('error', lang('access_denied'));
            
            redirect('pos');
            
        }
        
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
        
    } 

    function index() { 
        
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        
        $this->data['page_title'] = lang('purchases');
        
        $bc = array(
            array(
                'link' => '#',
                'page' => lang('transfers')
            )
        );
        
        $meta = array(
            'page_title' => lang('transfers'),
            'bc' => $bc
        );
        
        $this->page_construct('transfers/index', $this->data, $meta); 
        
    }     

    function get_transfers($today = NULL) { 

        $this->load->library('datatables');
        
        $this->datatables->select($this->db->dbprefix('transfers') . ".id as id, " . 
            $this->db->dbprefix('transfers') . ".date as date,to_warehouse_name, from_warehouse_name, total, note, attachment", FALSE); 

        $this->datatables->from('transfers');
        
        $this->datatables->group_by('transfers.id'); 

          if($data = $this->session->userdata('group_id')==1){         

          //  $actdata = "<a href='" . site_url('transfers/edit/$1') . "' title='View' class='tip btn btn-warning btn-xs'><i class='fa fa-file-text-o'></i></a>";
            
            $actdata .= "<a href='" . site_url('transfers/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_purchase') . "')\" title='" . lang("delete_purchase") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
          }  

         $this->datatables->add_column("Actions", "
        <div class='text-center'>
        <div class='btn-group'>".$actdata."</div></div>", "id");
        
        if ($today != NULL) {
            
            $this->datatables->like('date', $today);
            
        }
        
        $this->datatables->unset_column('id')->unset_column('supplier_id');
        
        echo $this->datatables->generate();
        
    }

    function add() {
        if(!$this->session->userdata('from_warehouse')){
            $this->form_validation->set_rules('warehouse', lang('warehouse'), 'required');
            if ($this->form_validation->run() == true) {

                $fromwarehouse = array(
                           'from_warehouse'  => $this->input->post('warehouse'),
                            );

                $this->session->set_userdata($fromwarehouse);  
                 redirect('transfers/add');
            }
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
            $this->data['page_title'] = lang('Products Transfers');
            $this->data['warehouses'] = $this->site->getAllStores(); 
            $this->load->view($this->theme.'transfers/fromWarehouse', $this->data, $meta); 
        } else {
        $this->form_validation->set_rules('date', lang('date'), 'required');
        if ($this->form_validation->run() == true) {
            
            $total = 0;
            
            $quantity = "quantity";
            
            $product_id = "product_id";
            
            $unit_cost = "cost"; 
            
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;            
            
            for ($r = 0; $r < $i; $r++) {
                
                $item_id = $_POST['product_id'][$r]; 

                $sequenceStr = $_POST['sqtrans'][$r]; 

                $sqno = $_POST['sqtrans']; 

                $towarehouseID = $this->input->post('towarehouse');

                $fromwarehouseID = $this->session->userdata('from_warehouse') ;

                $sequence[] = array(
                    'pro_id' =>$item_id ,
                    'store_id' => $this->input->post('towarehouse'),
                    'sequence' => $_POST['sqtrans'][$r]
                 );

                $item_qty = $_POST['quantity'][$r];
                
                $item_cost = $_POST['cost'][$r]; 
                
                if ($item_id && $item_qty && $unit_cost && $sequence) { 
                    
                    if (!$this->site->getProductByID($item_id)) {
                        
                        $this->session->set_flashdata('error', $this->lang->line("product_not_found") . " ( " . $item_id . " ).");
                        
                        redirect('transfers/add');
                        
                    }
               
                $products[] = array(
                    
                    'product_id' => $item_id,
                    
                    'cost' => $item_cost,
                    
                    'quentity' => $item_qty,

                    'sequence' => $sequenceStr , 
                    
                    'subtotal' => ($item_cost * $item_qty),
                    
                );                      
                    
                    $total += ($item_cost * $item_qty);
                    
                }
                
            }
                        
            
            if (!isset($products) || empty($products)) {
                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');
                
            } else {
                
                krsort($products);
                
            }

            $fromwarehouse = $this->transfers_model->getSroteByID($this->session->userdata('from_warehouse'));
            $towarehouse = $this->transfers_model->getSroteByID($this->input->post('towarehouse')); 
            
            $data = array(
                
                'date' => $this->input->post('date'), 
                
                'note' => $this->input->post('note', TRUE),
                
                'from_warehouse_id' => $this->session->userdata('from_warehouse'),

                'to_warehouse_id' => $this->input->post('towarehouse'), 

                'from_warehouse_name' =>$fromwarehouse->name,

                'to_warehouse_name' => $towarehouse->name,
                
                'total' => $total,

                'status' => 'complate',

                'reference' =>  $this->input->post('reference'), 

                'created_by' => $this->session->userdata('user_id'),               
                
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
                    
                    redirect("transfers/add");
                    
                }
                
                $data['attachment'] = $this->upload->file_name;
                
            }

         //$this->tec->print_arrays($data, $products);
                     
        }

         if ($this->form_validation->run() == true && $this->transfers_model->addtransfers($data, $products,$sequence,$towarehouseID,$fromwarehouseID)) { 

            $this->session->set_userdata('remove_spo', 1);

            $this->session->set_flashdata('message', lang('transfer_added'));
            
            redirect("transfers");
            
        }
            
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            $this->data['suppliers'] = $this->site->getAllSuppliers();

            $this->data['warehouses'] = $this->site->getAllStores(); 
            
            $this->data['page_title'] = lang('Add Transfers');
            
            $bc = array(
                array(
                    'link' => site_url('transfers'),
                    'page' => lang('Add Transfers')
                ),
                array(
                    'link' => '#',
                    'page' => lang('Add_transfers')
                )
            );
            
            $meta = array(
                'page_title' => lang('Add_transfers'),
                'bc' => $bc
            ); 
            $this->page_construct('transfers/add', $this->data, $meta); 
        }
        
    } 

    function edit($id){

        $this->form_validation->set_rules('date', lang('date'), 'required');

        if ($this->form_validation->run() == true) {

         $total = 0;
            
            $quantity = "quantity";
            
            $product_id = "product_id";
            
            $unit_cost = "cost"; 
            
            $i = isset($_POST['product_id']) ? sizeof($_POST['product_id']) : 0;            
            
            for ($r = 0; $r < $i; $r++) {
                
                $item_id = $_POST['product_id'][$r]; 

                $sequenceStr = $_POST['sqtrans'][$r]; 

                //$pid = $_POST['product_id'];

                $sqno = $_POST['sqtrans']; 

                //$sequence = array_combine($pid,$sqno); 

                $sequence[] = array(
                    'pro_id' =>$item_id ,
                    'store_id' => $this->input->post('to_warehouse_id'),
                    'sequence' => $_POST['sqtrans'][$r]
                 );

                $item_qty = $_POST['quantity'][$r];
                
                $item_cost = $_POST['cost'][$r]; 
                
                if ($item_id && $item_qty && $unit_cost && $sequence) { 
                    
                    if (!$this->site->getProductByID($item_id)) {
                        
                        $this->session->set_flashdata('error', $this->lang->line("product_not_found") . " ( " . $item_id . " ).");
                        
                        redirect('transfers/add');
                        
                    }
               
                $products[] = array(
                    
                    'product_id' => $item_id,
                    
                    'cost' => $item_cost,
                    
                    'quentity' => $item_qty,

                    'transfers_id' =>  $id ,

                    'sequence' => $sequenceStr , 
                    
                    'subtotal' => ($item_cost * $item_qty),
                    
                );                      
                    
                    $total += ($item_cost * $item_qty);
                    
                }
                
            }
                        
            
            if (!isset($products) || empty($products)) {
                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');
                
            } else {
                
                krsort($products);
                
            }

            $fromwarehouse = $this->input->post('from_warehouse_id');
            $towarehouse = $this->input->post('to_warehouse_id'); 
            
            $data = array(
                
                'date' => $this->input->post('date'), 
                
                'note' => $this->input->post('note', TRUE),
               
                'total' => $total,

                'reference' =>  $this->input->post('reference'),             
                
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
                    
                    redirect("transfers/add");
                    
                }
                
                $data['attachment'] = $this->upload->file_name;
                
            }


        }
        if ($this->form_validation->run() == true && $this->transfers_model->UpdateTransfers($id,$data, $products,$sequence,$fromwarehouse,$towarehouse)) { 

            $this->session->set_userdata('remove_spo', 1);

            $this->session->set_flashdata('message', lang('transfer_added'));
            
            redirect("transfers");
            
        }

            $this->data['transfer'] = $this->transfers_model->getTransfersByID($id);
            
            $inv_items = $this->transfers_model->getAllTransfersItems($id); 

            $c = rand(100000, 9999999);
            
            foreach ($inv_items as $item) {

                $row = $this->site->getProductByID($item->product_id); 

                $row->id = $item->product_id;

                $row->qty = $item->quentity;
                
                $row->cost = $item->cost;

                $row->sqtrans = $item->sequence;

                $ri = $this->Settings->item_addition ? $row->id : $c;

          
                $pr[$ri] = array(
                    'id' => $ri,
                    'item_id' => $item->product_id,
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
                'page_title' => 'Update transfers',
                'bc' => $bc
            ); 
        $this->page_construct('transfers/edit', $this->data, $meta); 

    }

   public function delete($id){
    $transfer = $this->transfers_model->getTransfersByID($id);

     //print_r($transfer) ;
       $to_warehouse_id = $transfer->to_warehouse_id ;
      
       $from_warehouse_id = $transfer->from_warehouse_id ;

       $this->transfers_model->Delete($id ,$to_warehouse_id , $from_warehouse_id );

        redirect('transfers');
    
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
        
        $rows = $this->transfers_model->getProductNames($term);

        if ($rows) {
            
            foreach ($rows as $row) {
                $rowSequence = $this->transfers_model->getSequenceByPrpID($row->id);
               

                if( $rowSequence !=FALSE){
                     $sequence = '';
                     foreach ($rowSequence as $key => $value) {
                       
                         $sequence .= $value->sequence.','; 
                    }

                    $sequence = rtrim($sequence,",");
                    $row->SeqAll = $sequence ;

                    $row->SeqCount = sizeof($rowSequence) ;

                }else{
                     $row->SeqAll = '' ;
                     $row->SeqCount = 0 ;
                }
                 
            
                
                
                $row->qty = 1;
                
                $pr[] = array(
                    'id' => str_replace(".", "", microtime(true)),
                    'item_id' => $row->id,
                    'label' => $row->name . " (" . $row->code . ") Qty".$row->store_qty,
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
    function squenceOut($row_no,$item_id,$item_qty,$store_id,$sequence = NULL){
        $this->data['info'] = $this->transfers_model->getSequence($item_id,$store_id);
        $this->data['title'] = 'Sequence';
        $this->data['row_no'] = $row_no; 
        $this->data['id'] = $item_id;
        $this->data['item_qty'] = $item_qty;
        $this->data['sequence'] = $sequence ;
        $this->load->view($this->theme.'transfers/squenceout', $this->data,$id);
    }

   function squenceOutEdit($row_no,$item_id,$item_qty,$store_id,$sequence = NULL){
        $this->data['info'] = $this->transfers_model->getSequence($item_id,$store_id);

        $this->data['title'] = 'Sequence';
        $this->data['row_no'] = $row_no; 
        $this->data['id'] = $item_id;
        $this->data['item_qty'] = $item_qty;
        $this->data['sequence'] = $sequence ;
        $this->load->view($this->theme.'transfers/squenceout', $this->data,$id);
    }

    function selectFromWarehouse(){
        $this->form_validation->set_rules('warehouse', lang('warehouse'), 'required');
        if ($this->form_validation->run() == true) {

            $fromwarehouse = array(
               'from_warehouse'  => $this->input->post('warehouse'),
            );

            $this->session->set_userdata($fromwarehouse);  
            redirect('transfers/add');
        }
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('Products Transfers');
        $this->data['warehouses'] = $this->site->getAllStores();
        $this->load->view($this->theme.'transfers/fromWarehouse', $this->data, $meta); 
    }

    function testquery(){

        $data = $this->transfers_model->getSroteByID(2);

        print_r($data );
    }

}