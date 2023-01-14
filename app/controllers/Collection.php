<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {            
            redirect('login');            
        }        
        $this->load->library('form_validation');       
        $this->load->model('sales_model');
        $this->load->model('bank_model');
        $this->load->model('purchases_model');
        $this->load->model('marge_model');
        
    }
    
    public function collectionlist($today=NULL) {    
        $customer = $this->input->get('customer') ? $this->input->get('customer') : NULL;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date').' 00:00:00' : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date').' 23:59:59' : NULL;

        $this->load->library('datatables');

        $this->datatables->select($this->db->dbprefix('today_collection') . ".today_collect_id as id, " . 
        $this->db->dbprefix('customers') . ".name as name, ". 
        $this->db->dbprefix('stores') . ".name as storename, ".
        $this->db->dbprefix('today_collection') . ".payment_date as payment_date," . 
        $this->db->dbprefix('today_collection') . ".payment_amount, " .  
        $this->db->dbprefix('today_collection') . ".payment_note", FALSE);
        $this->datatables->join('customers', 'customers.id=today_collection.customer_id');
        $this->datatables->join('stores', 'customers.store_id=stores.id'); 
        if(!$this->Admin){
          $this->datatables->where('today_collection.store_id',$this->session->userdata('store_id'));
        }
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
                
         <a href='#' onClick=\"MyWindow=window.open('" . site_url('collection/view/$1/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("view collection")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a>

         <a href='" . site_url('collection/collectdelete/$1') . "' onClick=\"return confirm('". lang('You are going to delete payment , please click ok to delete') ."')\" title='".lang("delete_payment")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>

         </div></div>", "id "); 
        
        $this->datatables->from('today_collection');     

        if($customer) { $this->datatables->where('customer_id', $customer); }
        if($start_date) { $this->datatables->where('payment_date >=', $start_date); }
        if($end_date) { $this->datatables->where('payment_date <=', $end_date); }       
        
        if ($today != NULL) {            
            $this->datatables->like('payment_date', $today);            
        }  
        // $this->datatables->add_column();      
        $this->datatables->unset_column('id');        
        echo $this->datatables->generate();              
        
    } 

    function index() {    
       $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : NULL;
       $end_date = $this->input->post('end_date') ? $this->input->post('end_date') : NULL;
       $supplier = $this->input->post('Supplier') ? $this->input->post('customer') : NULL;

       $this->data['customers'] = $this->site->getAllCustomers();      
       $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));        
       $this->data['page_title'] = 'Collection';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Collection'
            )
        );        
        $meta = array(
            'page_title' => 'Collection',
            'bc' => $bc
        );    
        $this->page_construct('collection/collectionlist', $this->data, $meta);
        
    }
 
    public function collectionpayment() {
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));            
        $this->data['customers'] = $this->site->getAllCustomers();        
        $this->data['page_title'] = 'Payments Collection';
        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Payments Collection'
            )
        );
        
        $meta = array(
            'page_title' => 'Payments Collection',
            'bc' => $bc
        );
        
        $this->page_construct('collection/collection_payment', $this->data, $meta);
    }
    public function customerInfo($id){
      //  $customers = $this->sales_model->getAllCustomers($id);
      //  echo "<pre>".print_r($customers);
       $this->load->model('suppliers_model');
       $SupPro = $this->sales_model->getAllCustomers($id);
       
       $today = date("Y-m-d");
       $total =0;
       $deu =0;
       $paid =0;

       $todayTotalSales = $this->sales_model->salesAmountByCustomer('total',$id,$today);
       $todayPaidSales = $this->sales_model->salesAmountByCustomer('paid',$id,$today);
       $TotalSales = $this->sales_model->salesAmountByCustomer('total',$id);
       $PaidSales = $this->sales_model->salesAmountByCustomer('paid',$id);
       $todayAdAmount = $this->sales_model->advCollecAmount('adv_collection',$id,$today);
       $totalAdAmount = $this->sales_model->advCollecAmount('adv_collection',$id);
       $Return = $this->sales_model->salesReturn($id);
        $ReturnAmount = $this->sales_model->salesReturnAmount($id);
        $ReturnDue = $Return-$ReturnAmount; 

       if($this->sales_model->salesDeuByCustomer($id,$today) =='')
            $todaySalesDeu = 0; 
            else
            $todaySalesDeu = $this->sales_model->salesDeuByCustomer($id,$today);
       
       /* foreach ($customers as $key => $value) {
           $total = $total+ $value->total;
           $deu = $deu+ $value->deu;
           $paid = $paid+ $value->paid;
       } */

      $tpaid = $PaidSales + $totalAdAmount;
        

      $todyPaid = $todayPaidSales + $todayAdAmount;
        
      //  $todpuPaid = $todayPaidpurchases+$todayAdAmount;
       $todpuPaid = $todayAdAmount;
       if($total < $todpuPaid){
        $todpuPaid = $total;
       } else {
        // $todpuPaid = $todayPaidpurchases+$todayAdAmount;
        $todpuPaid = $todayAdAmount;
       }
        
      $tAdAmount = ($this->sales_model->salesDeuByCustomer($id) - $totalAdAmount);

      // Sahin marge able customer balance
       
      $margeInfo = $this->marge_model->getMergeByIdCustomer($id, NULL);

      $gtotal =0;
      $pgtotal =0;
      $sgtotal =0;

      if($margeInfo){

        $margeResult = $this->marge_model->getSalesPurseByCidAndSupid($margeInfo->supplier_id, $margeInfo->customer_id);
        foreach ($margeResult as $key => $margevalue) {

          if(($margevalue['type'] == 'purchases') ||($margevalue['type'] =='collection') ||($margevalue['type'] =='Advance Collection') || ($margevalue['type'] == 'Supplier Opening balance') ) {  ; 

               $pgtotal = $pgtotal + $margevalue['total'];
          }

          if(($margevalue['type'] == 'sale') || ($margevalue['type'] =='payment') || ($margevalue['type'] =='Advance Payment') || ($margevalue['type'] == 'Customer Opening balance')){
                
                $sgtotal = $sgtotal + $margevalue['total'];
           }
        }
         $gtotal = $sgtotal - $pgtotal;

      }

      // $this->sales_model->salesDeu($u_id);
      $returnData = '';
      /* <th class="col-xs-5">Today Due Amount </th>
      <th class="col-xs-7">'.$this->tec->formatMoney($todypurdeu).'</th> */
      $returnData .= '<div class="col-xs-10">
            <h3 class"box-title">Customer information ('.$SupPro->name.')</h3>
            <strong>Store Name : '.$this->site->findeNameByID('stores','id',$SupPro->store_id)->name.'</strong>
            <p>Today Customer information</p>
            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th class="col-xs-5">Today Sales  Amount</th>
                    <?= $today; ?>
                    <th class="col-xs-7">'.$this->tec->formatMoney($todayTotalSales).'</th>
                  </tr>
                  <tr>
                    <th class="col-xs-5">Today Collection Amount</th>
                    <th class="col-xs-7">'.$this->tec->formatMoney($todyPaid).'</th>
                  </tr>
                  <!--<tr>
                    <th class="col-xs-5">Today Due Amount </th>
                    <th class="col-xs-7">'.$this->tec->formatMoney($todaySalesDeu).'</th>
                  </tr>-->
                  <tr>
                    <th class="col-xs-5">Today Balance</th>
                    <th class="col-xs-7">'.$this->tec->formatMoney($todaySalesDeu - $todayAdAmount).'</th>
                  </tr>
                </tbody>
              </table>
             </div>
             <div class="col-xs-10">';

        if($margeInfo){
               $returnData .= '<p>Total Customer information</p>
                <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <th class="col-xs-7">Total Sales  Amount</th>
                        <th class="col-xs-5">'.$this->tec->formatMoney($sgtotal).'</th>
                      </tr>
                      <tr>
                        <th class="col-xs-7">Total Purchases/Collection Amount</th>
                        <th class="col-xs-5" >'.$this->tec->formatMoney($pgtotal).'</th>
                      </tr>
                       
                       <tr>
                        <th class="col-xs-7">Total Balance</th>
                        <th class="col-xs-5">'.$this->tec->formatMoney($gtotal).'</th>
                      </tr>
                    </tbody>
                  </table>
                 </div>';
             }else{ 
             
          $returnData .= '<p>Total Customer information</p>
            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th class="col-xs-5">Total Sales  Amount</th>
                    <th class="col-xs-7">'.$this->tec->formatMoney($this->sales_model->salesAmountByCustomer('grand_total',$id)-$ReturnDue).'</th>
                  </tr>
                  <tr>
                    <th class="col-xs-5">Total Collection Amount</th>
                    <th class="col-xs-7" >'.$this->tec->formatMoney($tpaid).'</th>
                  </tr> 
                   <tr>
                    <th class="col-xs-5">Total Balance</th>
                    <th class="col-xs-7">'.$this->tec->formatMoney($tAdAmount + $SupPro->opening_blance-$ReturnDue).'</th>
                  </tr>
                </tbody>
              </table>
             </div>';
        }
            echo $returnData;

    }
    public function todayCollectionPayment(){
        $paidamount = $this->input->post('colAmount');
        $customerid = $this->input->post('customer');
        $note       = $this->input->post('note');      
        $type       = $this->input->post('type'); 
        $date       = date('Y-m-d');
        $total      = 0;
        $deu        = 0;
        $paid       = 0;
        $totalDeu   = 0;
        $salesCustomers = $this->sales_model->getCustomerDeu($customerid);
        $customers = $this->sales_model->getAllCustomers($customerid);
        if($type=='Cheque'){
            if((!$bankID)||(!$cheque_no)){
              $this->session->set_flashdata('error', lang('Bank or Cheque no empty'));
              redirect('collection/collectionpayment');
            } 
        }
        foreach ($salesCustomers as $key => $value) {
           $totalDeu = $totalDeu + $value->deu;
         }
        if(($totalDeu < $this->input->post('colAmount'))) {
            $paymentAmount = $totalDeu;           
        } else {
            $paymentAmount = $this->input->post('colAmount');             
        }

         $payPaymentdata = array(
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_amount' => $this->input->post('colAmount'),
            'customer_id' => $customerid,
            'payment_note' => $this->input->post('note'),
            'store_id'  => $customers->store_id,
          ); 
        $collect_id = $this->sales_model->payPayment($payPaymentdata);

        foreach ($salesCustomers as $key => $value) {
          //  $purchase = $value->customer_id;
           $total = $value->grand_total;
           $deu = $value->deu;
           $paid = $value->paid;  

           if(($total > $paid) && ($paidamount  > 0) ){
                if($paidamount < $value->deu ){                   
                    $payAmount = $paidamount;
                    $newpaid = $value->paid + $paidamount;
                    $newDeu = $value->deu - $paidamount;

                    if($value->grand_total == $newpaid){
                        $status = 'paid';
                      } else {
                          $status = 'partial';
                      }
                    $data  = array(
                        'paid' => $newpaid,
                        'status' => $status
                        );                   
                    $this->sales_model->UpdateCustomerDeu($data,$value->id);
                    $addPayData = array(
                          'date' => date('Y-m-d H:i'),
                          'sale_id' => $value->id,
                          'customer_id' => $this->input->post('customer'),
                          'paid_by' => $type,
                          'amount' => $paidamount,
                          'created_by' => $this->session->userdata('user_id'),
                          'store_id' => $customers->store_id,
                          'payment_type' => 'sale',
                          'collect_id'  => $collect_id
                        );                    
                   $this->sales_model->addPayment($addPayData);                     
                   $paidamount = 0;                   
                } else {  

                   $payAmount = $value->deu;
                   $bigAmount = $paidamount - $value->deu;
                   $odlNewPaid = $value->paid + $value->deu;
                   
                   $data  = array(
                        'paid' => $odlNewPaid,
                        'status' => $status);
                   $this->sales_model->UpdateCustomerDeu($dataUpdate,$value->id);
                   $addPayData = array(
                          'date' => date('Y-m-d H:i'),
                          'sale_id' => $value->id,
                          'customer_id' => $this->input->post('customer'),
                          'paid_by' => $type,
                          'amount' => $value->deu,
                          'created_by' => $this->session->userdata('user_id'),
                          'store_id' => $customers->store_id,
                          'payment_type' => 'sale',
                          'collect_id'  => $collect_id
                        );            
                    $this->sales_model->addPayment($addPayData);                  
                   $paidamount = $bigAmount;
                      
                }        

            }
                    
        } 
        $advData = array(
          'customer_id'     => $this->input->post('customer'),
          'adv_collection'  => $paidamount,
          'total_collection' => $this->input->post('colAmount'),
          'add_date'        => date('Y-m-d H:i:s'),
          'today_collect_id' => $collect_id,
          'store_id'        => $customers->store_id,
          'note'            => $this->input->post('note'),
        );
        $this->sales_model->addAdvCollec($advData);

        $odlNewPaid = $value->paid + $value->deu;
        
        $grand_total  = 0;

        if($type=='cheque' || $type=='card'){
          $bankPending = array(
            'customer_id'  => $this->input->post('customer'),
            'amount'       => $this->input->post('colAmount'),
            'bank_id'      => $this->input->post('bank'),
            'cheque_no'    => $this->input->post('cheque_no'),
            'insert_date'  => date('Y-m-d H:i:s'),
            'type'         => 'pending',
            'collection_id' => $collect_id,
            'store_id'       => 1,
            'payment_type' =>  1,
          );

          $this->bank_model->bankPendingTranjection($bankPending);
          
        }


        
        $this->session->set_flashdata('message', lang('Payment Collection submited successfully'));
        redirect('collection/collectionpayment');
    }

  public function collectdelete($id = null){
       
      $getSalesIdfpaytb = $this->sales_model->getAllsalesID($id);

      foreach ($getSalesIdfpaytb as $key => $value) {
         $saleIDptb =  $value->sale_id ;
         $saleAmountptb = $value->amount ;
        
         $getSalesIdfSaltb = $this->sales_model->getSaleByID($value->sale_id);

         $newPaid = $getSalesIdfSaltb->paid - $saleAmountptb; 

         if($newPaid==0){
          $status = 'due';
         } else {
          $status = 'partial';
         }

         $dataUpdate  = array(
                        'paid' => $newPaid,
                        'status' => $status,
                        );
         $this->sales_model->UpdateCustomerDeu($dataUpdate,$getSalesIdfSaltb->id); 

         $this->sales_model->deletePaymentForCollect($id);
         

         $this->session->set_flashdata('message', lang('Collection delete successfully'));         
      } 
      $this->sales_model->deleteAdvCusPay($id);
      $this->sales_model->deleteCollect($id);
      
      redirect('collection/');
    
  }

   function view($collect_id = NULL, $noprint = NULL) { 
    if($this->input->get('collect_id')){ $collect_id = $this->input->get('collect_id'); }  
    $this->data['message'] = $this->session->flashdata('message');
    $invs = $this->sales_model->getCollectByID($collect_id);
    $this->data['invColl'] = $this->sales_model->getAllCustomers($invs->customer_id);  
    $this->data['customer'] = $this->sales_model->getCollectByID($collect_id);;
    $this->data['advamount'] = $this->sales_model->getCusAdv($invs->customer_id);   
    $this->data['deuamount'] = $this->sales_model->salesDeuByCustomer($invs->customer_id);    
    $this->data['admin'] = $this->sales_model->getUserInfo($this->session->userdata('user_id'));
    $this->data['page_title'] = lang("Collection invoice");


    $this->load->view($this->theme.'collection/view', $this->data);

  } 

  public function bankInfo($type){   
      //$suppliers = $this->purchases_model->getSupplierByID($sid);
      
      $banks = $this->site->wheres_rows('bank_account',null); 
    
      if($type == 'cheque'){
        $output= '<div class="form-group">
              <p>Bank information </p> 
                 <select class="form-control select2 tip" name="bank" required="required" id="type">
            <option value="">Select Bank</option>';

            foreach ($banks as $key => $bank) {
              $output .='<option value="'.$bank->bank_account_id.'">'.$bank->bank_name .' ('.$bank->account_name.' ) ( '.$bank->account_no.')</option>';
            }
                        
        $output .='</select></div>
                <div class="form-group">
                <label>Cheque No </label>
            <input type="text" name="cheque_no" class="form-control" required="required">
                </div>'; 
        echo $output;
      }else if($type == 'card'){

        $output= '<div class="form-group">
              <p>Bank information </p> 
                 <select class="form-control select2 tip" name="bank" required="required" id="type">
            <option value="">Select Bank</option>';

            foreach ($banks as $key => $bank) {
              $output .='<option value="'.$bank->bank_account_id.'">'.$bank->bank_name .' ('.$bank->account_name.' ) ( '.$bank->account_no.')</option>';
            }
                        
        $output .='</select></div>
                <div class="form-group">
                <label>Card No </label>
            <input type="text" name="cheque_no" class="form-control" required="required">
                </div>'; 
        echo $output;
      } 
      
         
    } 

    
}