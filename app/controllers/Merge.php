<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Merge extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if ( ! $this->loggedIn) {
            redirect('login');
        }

        $this->load->model('marge_model');
        $this->load->model('sales_model');
        $this->load->model('purchases_model');
        $this->load->model('pos_model');
        $this->load->library('form_validation');
    }

    public function mergelist() { 

        $this->load->library('datatables'); 

        $this->datatables->select($this->db->dbprefix('marge') . ".marge_id as id, ". $this->db->dbprefix('marge') . ".marge_title as marge_title, ".  $this->db->dbprefix('marge') . ".mage_date, " . $this->db->dbprefix('customers') . ".name as cname, ".$this->db->dbprefix('suppliers') . ".name as sname ", FALSE);        
        $this->datatables->join('suppliers', 'marge.supplier_id=suppliers.id');
        $this->datatables->join('customers', 'marge.customer_id=customers.id');
        
        $this->datatables->from('marge'); 

        $url = base_url("merge/saleandpucrchases") ;

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
                       
         <a href='".site_url('merge/adjustment/$1')."' title='". lang("Adjustment") ."' class='tip btn btn-primary btn-xs' data-toggle='ajax'><i class='fa fa-briefcase'></i></a> 
         <a href='".site_url('merge/salepucrchaslist/$1')."' title='". lang("View report") ."' class='tip btn btn-primary btn-xs'><i class='fa fa-money'></i></a>
         <a href='" . site_url('merge/mergedelete/$1') . "' onClick=\"return confirm('". lang('You are going to delete merge, please click ok to delete') ."')\" title='".lang("delete_collection")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a> 

         </div></div>", "id");      
        $this->datatables->unset_column('id');        
        echo $this->datatables->generate();  

    }

    public function index () {
        $this->data['page_title'] = $this->lang->line("Merge List");
        $this->data['page_title'] = $this->lang->line("Merge List");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('Add Marge')));
        $meta = array('page_title' => lang('Merge List'), 'bc' => $bc);
        $this->page_construct('merge/mergelist', $this->data, $meta);

    }  
    
    public function salepucrchaslist($id) {         
        $this->data['results'] = '';
        $merges = $this->marge_model->getMergeById($id);
        foreach ($merges as $key => $merg) {
            $supID = $merg->supplier_id;
            $cusID = $merg->customer_id;         
        }          
        if(($supID !='') && ($cusID !='')){
        $this->data['results'] = $this->marge_model->getSalesPurseByCidAndSupid($supID, $cusID); 
         
        }            
         
        $this->data['page_title'] = $this->lang->line("Laser List");
        $this->data['page_title'] = $this->lang->line("Laser List");
        $bc = array(array('link' => '#', 'page' => lang('merge')), array('link' => '#', 'page' => lang('Laser list')));
        $meta = array('page_title' => lang('Laser List'), 'bc' => $bc);        
        $this->page_construct('merge/saleandpucrchases', $this->data, $meta);
         
    }
    
    public function test($supplier =1 , $cusromer =2 ) {

        $this->marge_model->GetMergeTotalVal($supplier,$cusromer);

    }
    public function mergereport($id) {     
         $type = $this->uri->segment(3, 0);
         $id = $this->uri->segment(4, 0); 

        if($type == 'payment'){

            $this->data['purchase'] = $this->purchases_model->getPaymentSingel($id);
            
            $supplier_id = $this->data['purchase']->supplier_id;
            $purchases_id = $this->data['purchase']->purchases_id; 
            
            $this->data['s_name'] = $this->purchases_model->getSupplierInfo($supplier_id)->name;
            
            $rows = $this->purchases_model->getParchaseInfo($purchases_id);  
            
            $this->data['paid_amount'] = $rows->paid;

            $this->data['total_amount'] = $rows->total;
            
            $totla_amount = $rows->total;
            
            $this->data['due_amount'] = $rows->deu; 
            
            $this->load->view($this->theme . 'merge/view_payment', $this->data); 
        }
        if($type == 'purchases'){
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
        if($type == 'sale'){
            $inv = $this->pos_model->getSaleByID($id);
            $this->tec->view_rights($inv->created_by);
            $this->load->helper('text');
            $this->data['rows'] = $this->pos_model->getAllSaleItems($id);
            $this->data['customer'] = $this->pos_model->getCustomerByID($inv->customer_id);
            $this->data['inv'] = $inv;
            $this->data['sid'] = $sale_id;
            $this->data['noprint'] = $noprint;
            $this->data['modal'] = false;
            $this->data['payments'] = $this->pos_model->getAllSalePayments($id);
            $this->data['created_by'] = $this->site->getUser($inv->created_by);
            $this->data['page_title'] = lang("invoice");
            $this->load->view($this->theme.'pos/view', $this->data);
        }
        if($type == 'collection'){
            $this->data['payemnt'] = $this->sales_model->getPaymentByID($id); 
            $sale_id = $this->data['payemnt']->sale_id;
            $customer_id = $this->data['payemnt']->customer_id; 
            
            $this->data['s_name'] = $this->sales_model->getSaleByID($sale_id)->customer_name;
            
            $rows = $this->sales_model->getSaleByID($sale_id);  
            
            $this->data['paid_amount'] = $rows->paid;

            $this->data['total_amount'] = $rows->total;
            
            $totla_amount = $rows->total;
            
            $this->data['due_amount'] = $rows->total - $rows->paid; 
            
            $this->load->view($this->theme . 'merge/view_collection', $this->data); 
        }        
         
    }

    public function laserlist() {
        $this->load->library('datatables');

        $this->datatables->select($this->db->dbprefix('marge_laser') . ".laser_id as id, ".  $this->db->dbprefix('marge_laser') . ".laser_date, " . $this->db->dbprefix('customers') . ".name as cname, ".$this->db->dbprefix('suppliers') . ".name as sname,amount,laser_note ", FALSE);        
        $this->datatables->join('suppliers', 'marge_laser.supplier_id=suppliers.id');
        $this->datatables->join('customers', 'marge_laser.customer_id=customers.id');
        
        $this->datatables->from('marge_laser'); 

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
                
         <a href='" . site_url('merge/laserdelete/$1') . "' onClick=\"return confirm('". lang('You are going to delete laser, please click ok to delete') ."')\" title='".lang("delete_collection")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>         
        
         </div></div>", "id");      
        $this->datatables->unset_column('id');        
        echo $this->datatables->generate(); 
    }

    public function laser() {
        $this->data['page_title'] = $this->lang->line("Laser List");
        $this->data['page_title'] = $this->lang->line("Laser List");
        $bc = array(array('link' => '#', 'page' => lang('merge')), array('link' => '#', 'page' => lang('Laser list')));
        $meta = array('page_title' => lang('Laser List'), 'bc' => $bc);
        $this->page_construct('merge/laserlist', $this->data, $meta);

    }

    public function add_merge () {  

        $this->form_validation->set_rules('supplier', lang("supplier"), 'required|is_unique[marge.supplier_id]');

        $this->form_validation->set_rules('customer', lang("customer"), 'required|is_unique[marge.customer_id]'); 

         if ($this->form_validation->run() == true) {
 
            $suppName = $this->purchases_model->getSuppByID($this->input->post('supplier'));
            foreach ($suppName as $key => $supName) 
             $sName = $supName->name;
             
            $cusName = $this->sales_model->getAllCustomers($this->input->post('customer'));

            $data = array( 
                'marge_title' => $cusName->name.' <=> '. $sName, 
                'supplier_id' => $this->input->post('supplier'),
                'customer_id' => $this->input->post('customer'),
                'mage_date' => date('Y-m-d H:i')
                );  
            if ($this->form_validation->run() == true && $this->marge_model->addMarge($data))
            ;
            $this->session->set_flashdata('message', lang("Merge successfully added"));
            redirect('merge/add_merge');

        } else { 
           $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        }
        $this->data['allsuppliers'] = $this->purchases_model->getAllSupper();
        $this->data['allcustomars'] = $this->sales_model->getAllCustomer();
        $this->data['page_title'] = $this->lang->line("Add Merge");
        $this->data['page_title'] = $this->lang->line("Add Merge");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('Add Merge')));
        $meta = array('page_title' => lang('Add Merge'), 'bc' => $bc);
        $this->page_construct('merge/add_merge', $this->data, $meta);

    }

    public function adjustment($id){ 

        $merges = $this->marge_model->getMergeById($id);
        foreach ($merges as $key => $value) {
            $customer_id = $value->customer_id;
            $supplier_id = $value->supplier_id;
        }
                
        $this->data['suppInfo'] = $this->purchases_model->getSuppByID($supplier_id);

        $payAmount = 0;
        $aPay = $this->purchases_model->acPayable($supplier_id);
            foreach ($aPay as $key => $value) {
               $payAmount = $payAmount + $value->due;                                   
                }
        $this->data['payAmount'] = $payAmount; 

        $this->data['cusInfo'] = $this->sales_model->getCustomerByID($customer_id);
        $total_due = 0;
        $acrcv = $this->sales_model->acReceivable($customer_id);
            foreach ($acrcv as $key => $value) {
               $total_due = $total_due + $value->due;               
            } 
         $this->data['recAmount'] = $total_due;         

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

        $sale = $this->sales_model->getSaleByID($id);

        $this->data['inv'] = $sale;

        $this->load->view($this->theme . 'merge/adjustment', $this->data);

    }

    public function mergeLaser(){

        if($this->input->post('add_payment')){
           $cid =  $this->input->post('cid') ;
           $sid =  $this->input->post('sid') ;
           $note = $this->input->post('note') ;
           $amount = $this->input->post('amount') ;

           $paidamount = $this->input->post('amount') ;
           //Customers pyments
           $salesCustomers = $this->sales_model->getCustomerDeu($cid); 
            $i =0 ;
            foreach ($salesCustomers as $key => $cvalue) {
               $Deu = $cvalue->grand_total - $cvalue->paid;
               $cTotalDeu = $cTotalDeu + $Deu;
            }

            if(($cTotalDeu < $this->input->post('amount'))) {
                $amount = $cTotalDeu;
            } else {
                 $amount = $this->input->post('amount');
            }
            //Supplier pyments
            $total      = 0;
            $deu        = 0;
            $paid       = 0;
            $suppliers = $this->purchases_model->getSupplierDeu($sid);

            foreach ($suppliers as $key => $svalue) {
               $stotalDeu = $stotalDeu + $svalue->deu;
             }
            if(($stotalDeu < $this->input->post('amount'))) {
                $paymentAmount = $stotalDeu;           
            } else {
                $paymentAmount = $this->input->post('amount');             
            } 
            //Add maerg laser
            $payPaymentdata = array(
                      'laser_date'   => date('Y-m-d H:i'),
                      'amount'       => $amount,
                      'supplier_id'  => $sid,
                      'customer_id'  => $cid,
                      'laser_note'   => $note,
                   );
            //if($cTotalDeu =='0'){redirect('marge');}
            $laser_id = $this->sales_model->laserPayment($payPaymentdata);
            foreach ($salesCustomers as $key => $cvalue) {
              $i++;
               if($amount  > 0){
                    if(($amount > $cvalue->deu ) ){
                      $paidAmount =  $cvalue->deu;
                       if($cvalue->grand_total == $paidAmount){
                            $status = 'paid';
                        } else {
                            $status = 'partial';
                        }
                        $dataSUp  = array(
                            'paid' => $paidAmount,
                            'updated_by' => date('Y-m-d H:i'),
                            'status'    => $status,
                            ); 

                         $this->sales_model->UpdateCustomerDeu($dataSUp,$cvalue->id);   
                         $amount = $amount - $cvalue->deu ;              
                         $addPayData = array(
                            'date' => date('Y-m-d H:i'),
                            'sale_id' => $cvalue->id,
                            'customer_id' => $this->input->post('cid'),
                            'paid_by' => 'cash',
                            'amount' => $paidAmount,
                            'created_by' => $this->session->userdata('user_id'),
                            'note'  => $this->input->post('note'),
                            'store_id' => 1,
                            'payment_type' => 'sale'
                            );

                       $this->sales_model->addPayment($addPayData);                      

                    } else {                   

                        $paidAmount = $amount ; 

                        if($cvalue->grand_total == $paidAmount){
                            $status = 'paid';
                        } else {
                            $status = 'partial';
                        }
                        $dataUpdate  = array(
                            'paid' => $paidAmount,
                            'updated_by' => date('Y-m-d H:i'),   
                            'status'    => $status
                            );
                        $this->sales_model->UpdateCustomerDeu($dataUpdate,$cvalue->id); 

                        $addPayData = array(
                            'date' => date('Y-m-d H:i'),
                            'sale_id' => $cvalue->id,
                            'customer_id' => $this->input->post('customer'),
                            'paid_by' => 'cash',
                            'cc_type' => 'Visa',
                            'amount' => $amount,
                            'created_by' => $this->session->userdata('user_id'),
                            'note'  => $this->input->post('note'),
                            'store_id' => 1,
                            'payment_type' => 'sale'
                            );            
                        $this->sales_model->addPayment($addPayData);
                        $amount = 0;

                    }

                }
                        
            } 

            foreach ($suppliers as $key => $svalue) {
               $purchase = $svalue->purchase_id;
               $total = $svalue->total;
               $deu = $svalue->deu;
               $paid = $svalue->paid; 
               
               if(($total > $paid) && ($paidamount  > 0) ){

                    if($paidamount < $svalue->deu ){                   
                        $payAmount = $paidamount;
                        $newpaid = $svalue->paid+$paidamount;
                        $newDeu = $svalue->deu - $paidamount;
                        $data  = array(
                            'paid' => $newpaid,
                            'deu' => $newDeu,
                            'date' => date('Y-m-d H:i'),
                            );
                        $this->purchases_model->UpdateSupplierDeu($data,$svalue->id);
                        $addPayData = array(
                            'date' => date('Y-m-d H:i'),
                            'purchases_id' => $svalue->id,
                            'supplier_id' => $this->input->post('sid'),
                            'paid_by' => 'cash',
                            'cc_type' => 'Visa',
                            'amount' => $paidamount,
                            'created_by' => $this->session->userdata('user_id'),
                            'todayP_Payment' => $todayPurchasePayment,
                            );                    
                        
                        $this->purchases_model->addPayment($addPayData);
                        $paidamount = 0;
                    } else {                   
                       $payAmount = $svalue->deu;
                       $bigAmount = $paidamount -$svalue->deu;
                       $odlNewPaid = $svalue->paid + $svalue->deu;
                       $data  = array(
                            'paid' => $odlNewPaid,
                            'deu' => '0');
                       $this->purchases_model->UpdateSupplierDeu($data,$svalue->id);
                       $addPayData = array(
                            'date' => date('Y-m-d H:i'),
                            'purchases_id' => $svalue->id,
                            'supplier_id' => $this->input->post('supplier'),
                            'paid_by' => 'cash',
                            'cc_type' => 'Visa',
                            'amount' => $svalue->deu,
                            'created_by' => $this->session->userdata('user_id'),
                            'todayP_Payment' => $todayPurchasePayment,
                            );                   
                       $this->purchases_model->addPayment($addPayData);                  
                       $paidamount = $bigAmount;
                    }

                }
                        
            } 
            $odlNewPaid = $svalue->paid + $svalue->deu;
            $total      = 0;
            $grand_total  = 0;
            
            $this->session->set_flashdata('message', lang('Payment Collection submited successfully'));
            redirect('merge');

        }

    }

    public function mergedelete($id){

        $this->marge_model->mergedelete($id);

        redirect('merge');
    
    }

    public function laserdelete($id){

        $this->marge_model->laserdelete($id);

        redirect('merge/laser');
    
    }

}
