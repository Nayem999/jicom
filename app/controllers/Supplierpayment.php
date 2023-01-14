<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplierpayment extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {
            
            redirect('login');
            
        }
        
        $this->load->library('form_validation');
        
        $this->load->model('purchases_model');

        $this->load->model('suppliers_model');

        $this->load->model('bank_model');

        $this->load->model('marge_model');

        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';
        
    }
    function getSupplierByStore($id){
      return $id;
    }

    public function purchase_payment() { 

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        //$suid = $this->getSupplierByStore();
            
        $this->data['suppliers'] = $this->site->getAllSuppliers();

        $this->data['warehouses'] = $this->site->getAllStores();
        
        $this->data['page_title'] = 'Supplier Payments';
        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Supplier Payments'
            )
        );
        
        $meta = array(
            'page_title' => 'Supplier Payments',
            'bc' => $bc
        );
        
        $this->page_construct('supplierpayment/purchases_payment', $this->data, $meta);
    }
    public function supplierInfo($id){

       $suppliers = $this->purchases_model->getSupplierByID($id);
       
       $SupPro = $this->suppliers_model->getSupplierByID($id);         
       
       $today = date("Y-m-d");
       $total =0;
       $deu =0;
       $paid =0;

       $todayTotalPurchases = $this->purchases_model->purchasesAmount('total',$id,$today);
       $todayPaidpurchases = $this->purchases_model->purchasesAmount('paid',$id,$today);
       $todayDeupurchases = $this->purchases_model->purchasesAmount('deu',$id,$today);
       $todayAdAmount = $this->purchases_model->advPayAmount('adv_amount',$id,$today);
       $totalAdAmount = $this->purchases_model->advPayAmount('adv_amount',$id);

       
       foreach ($suppliers as $key => $value) {
           $total = $total+ $value->total;
           $deu = $deu+ $value->deu;
           $paid = $paid+ $value->paid;
       }
       $tpaid = $paid + $totalAdAmount;
        

       $todpuPaid = $todayPaidpurchases+$todayAdAmount;


       if($todayAdAmount > $todayDeupurchases){
       	$todypurdeu = 0;
       } else {
       	$todypurdeu = $todayDeupurchases - $todayAdAmount;
       } 
       if($todayAdAmount < $deu){
       	$todayAdblc = 0;
       } else {
       	$todayAdblc = $todayAdAmount-$deu;
       }

      $margeInfo = $this->marge_model->getMergeByIdCustomer(NULL, $id);

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


      $returnData = '';
      $returnData .= '<div class="col-xs-10">
            <div class="box-header"><p class="box-title" >Supplier information ('.$SupPro->name.')</p><br><br>
            <strong>Store Name : '.$this->site->findeNameByID('stores','id',$SupPro->store_id)->name.'</strong>
            <p>Today Supplier information</p>
            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td class="col-xs-8">Today Purchases  Amount</td>
                    <?= $today; ?>
                    <td class="col-xs-4">'.$this->tec->formatMoney($todayTotalPurchases).'</td>
                  </tr>
                  <tr>
                    <td class="col-xs-8">Today Purchases Paid Amount</td>
                    <td class="col-xs-4">'.$this->tec->formatMoney(($todpuPaid)).'</td>
                  </tr>
                  <!--<tr>
                    <td class="col-xs-8">Today Purchases Advance Payment</td>
                    <td class="col-xs-4">'.$this->tec->formatMoney($todayAdAmount).'</td>
                  </tr>-->
                  <tr>
                    <td class="col-xs-8">Today Balance</td>
                    <td class="col-xs-4">'.$this->tec->formatMoney(($todayAdAmount-$todayDeupurchases)).'</td>
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
                        <th class="col-xs-7">Total Purchases  Amount</th>
                        <th class="col-xs-5" >'.$this->tec->formatMoney($pgtotal).'</th>
                      </tr>
                      <tr>
                        <th class="col-xs-7">Total Sale/Payment Amount</th>
                        <th class="col-xs-5">'.$this->tec->formatMoney($sgtotal).'</th>
                      </tr>
                      
                       
                       <tr>
                        <th class="col-xs-7">Total Balance</th>
                        <th class="col-xs-5">'.$this->tec->formatMoney($gtotal).'</th>
                      </tr>
                    </tbody>
                  </table>
                 </div>';
             }else{
              $returnData .= '<p>Total Supplier information</p>
                <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td class="col-xs-8">Total Purchases  Amount</td>
                        <td class="col-xs-4">'.$this->tec->formatMoney($total).'</td>
                      </tr>
                      <tr>
                        <td class="col-xs-8">Total Purchases Paid Amount</td>
                        <td class="col-xs-4">'.$this->tec->formatMoney($tpaid).'</td>
                      </tr>
                      <!--<tr>
                        <td class="col-xs-8">Total Purchases Advance Payment</td>
                        <td class="col-xs-4">'.$this->tec->formatMoney($totalAdAmount).'
                      </tr>-->
                      <tr>
                        <td class="col-xs-8">Total Balance</td>
                        <td class="col-xs-4">'.$this->tec->formatMoney(($totalAdAmount-$deu - $SupPro->opening_blance)).'</td>
                      </tr>
                    </tbody>
                </table>
                </div>
                </div>';
          }

          echo $returnData;
    }
    public function bankInfo($type,$sid){  
      $suppliers = $this->purchases_model->getSupplierByID($sid);
      foreach ($suppliers as $key => $supplier)  
    	$banks = $this->site->getAllBanks($supplier->store_id);	
    	if($type=='Cheque'){
    	$output= '<div class="form-group">
	            <p>Bank information </p> 
	               <select class="form-control select2 tip" name="bank" required="required" id="type">
						<option value="">Select</option>';

						foreach ($banks as $key => $bank) {
							$output .='<option value="'.$bank->bank_account_id.'">'.$bank->bank_name .' ('.$bank->account_name.' ) ( '.$bank->account_no.')</option>';
						}
						 						
		$output .='</select></div>
	            <div class="form-group">
	            <label>Cheque No </label>
					<input type="text" name="cheque_no" class="form-control" required="required">
	            </div>'; 
	    echo $output;
        }
    }

    //function getSupplierByStore($id){
      //$suppliers = $this->site->getAllSuppliers($id);
      /*$output= '<div class="form-group">
              <p>Bank information</p> 
              <select name="supplier" class="form-control select2 tip" required="required" id="supplier">
             <option value="">Select</option>';

            foreach ($suppliers as $key => $supplier) {
              $output .='<option value="'.$supplier->id.'">'.$supplier->name .'</option>';
            }
                        
    $output .='</select></div>';*/ 
     //echo $id;

    //}
    public function todayPurchaseslist(){
        if (!$this->Admin) {            
            $this->session->set_flashdata('error', lang('access_denied'));            
            redirect('pos');            
        }
        $this->load->library('datatables');
        
        $this->datatables->select($this->db->dbprefix('today_purchase_payment') . ".today_payment_id as id, " . 
          $this->db->dbprefix('suppliers') . ".name as name, " .
         $this->db->dbprefix('today_purchase_payment') . ".payment_date as payment_date ,  " . $this->db->dbprefix('today_purchase_payment') . ".payment_amount, " . $this->db->dbprefix('today_purchase_payment') . ".payment_note", FALSE);        
        $this->datatables->join('suppliers', 'suppliers.id=today_purchase_payment.supplier_id');        
        $this->datatables->from('today_purchase_payment');        
        $this->datatables->group_by('today_collect_id');        
        if ($today != NULL) {            
            $this->datatables->like('date', $today);            
        }        
        $this->datatables->unset_column('id');        
        echo $this->datatables->generate();             
    }
    public function todayPurchases() {

       if (!$this->Admin) {            
            $this->session->set_flashdata('error', lang('access_denied'));            
            redirect('pos');            
        }        
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
        $this->page_construct('supplierpayment/todayPurchaseslist', $this->data, $meta);
    }
    public function todayPurchasePayment(){
    	$bankID='';
    	$cheque_no='';
        $paidamount = $this->input->post('paidamount');
        $supplierid = $this->input->post('supplier');
        $note       = $this->input->post('note');
        $type       = $this->input->post('type'); 
        $bankID		  = $this->input->post('bank');
        $cheque_no	= $this->input->post('cheque_no');
        $getSupplierID = $this->purchases_model->getSupplierByID($supplierid);
        foreach ($getSupplierID as $key => $SupplierID);
        $supplierStore_id = $SupplierID->store_id; 

        if($type=='Cheque'){
        	if(($bankID=='')||($cheque_no=='')){
        		$this->session->set_flashdata('error', lang('Bank or Cheque no empty'));
        		redirect('supplierpayment/purchase_payment');
        	} else { 
        	}
        }     
        $date       = date('Y-m-d');
        $total      = 0;
        $deu        = 0;
        $paid       = 0;
        $totalDeu 	= 0;
        $suppliers = $this->purchases_model->getSupplierDeu($supplierid);
        foreach ($suppliers as $key => $value) {
           $totalDeu = $totalDeu + $value->deu;
         }
        if(($totalDeu < $this->input->post('paidamount'))) {
            $paymentAmount = $totalDeu;           
        } else {
             $paymentAmount = $this->input->post('paidamount');             
        }        
        $payPaymentdata = array(
                        'payment_date' => date('Y-m-d H:i:s'),
                        'payment_amount' => $this->input->post('paidamount'),
                        'supplier_id' => $supplierid,
                        'payment_note' => $this->input->post('note'),
                        'type'			=> $type,
                        'cheque_no'	=> $cheque_no,
                        'store_id'  => $supplierStore_id,
                        );
        
        //if($totalDeu =='0'){redirect('supplierpayment/purchase_payment');}
        $todayPurchasePayment = $this->purchases_model->payPayment($payPaymentdata);

        foreach ($suppliers as $key => $value) {
           $purchase = $value->purchase_id;
           $total = $value->total;
           $deu = $value->deu;
           $paid = $value->paid; 
           if(($total > $paid) && ($paidamount  > 0) ){
                if($paidamount < $value->deu ){                   
                    $payAmount = $paidamount;
                    $newpaid = $value->paid+$paidamount;
                    $newDeu = $value->deu - $paidamount;
                    $data  = array(
                        'paid' => $newpaid,
                        'deu' => $newDeu, 
                        );
                    $this->purchases_model->UpdateSupplierDeu($data,$value->id);
                    $addPayData = array(
                        'date' => date('Y-m-d H:i'),
                        'purchases_id' => $value->id,
                        'supplier_id' => $this->input->post('supplier'),
                        'paid_by' => $type,
                        'cheque_no' => $cheque_no,
                        'amount' => $paidamount,
                        'created_by' => $this->session->userdata('user_id'),
                        'store_id'        => $supplierStore_id,
                        'todayP_Payment' => $todayPurchasePayment,
                        );
                    $this->purchases_model->addPayment($addPayData);
                    
                    $paidamount = 0;                   
                } else {                   
                   $payAmount = $value->deu;
                   $bigAmount = $paidamount - $value->deu;
                   $odlNewPaid = $value->paid + $value->deu;
                   
                   $data  = array(
                        'paid' => $odlNewPaid,
                        'deu' => '0');
                   $this->purchases_model->UpdateSupplierDeu($data,$value->id);
                   $addPayData = array(
                        'date' => date('Y-m-d H:i'),
                        'purchases_id' => $value->id,
                        'supplier_id' => $this->input->post('supplier'),
                        'paid_by' => $type, 
                        'cheque_no' => $cheque_no,
                        'amount' => $value->deu,
                        'created_by' => $this->session->userdata('user_id'),
                        'store_id'       => $supplierStore_id,
                        'todayP_Payment' => $todayPurchasePayment,
                        );   
                             
                   $this->purchases_model->addPayment($addPayData);                  
                   $paidamount = $bigAmount;
                      
                }        

            }
                    
        } 
        $advData = array(
        	'suppliers_id'  => $this->input->post('supplier'),
        	'adv_amount'    => $paidamount,
        	'total_payment' => $this->input->post('paidamount'),
        	'add_date'      => date('Y-m-d H:i:s'),
        	'today_payment_id' => $todayPurchasePayment,
        	'note'		    => $this->input->post('note'),
          'store_id'    => $supplierStore_id,
        	);        
        $this->purchases_model->addAdvPayment($advData);
        $odlNewPaid = $value->paid + $value->deu;
        $total      = 0;
        if($type=='Cheque'){
	        $bankPending = array(
	        	'supplier_id'  => $this->input->post('supplier'),
	        	'amount'  	   => $this->input->post('paidamount'),
	        	'bank_id'      => $this->input->post('bank'),
	        	'cheque_no'    => $this->input->post('cheque_no'),
	        	'insert_date'  => date('Y-m-d H:i:s'),
	        	'type' 		     => 'pending',
	        	'todayP_Payment' => $todayPurchasePayment,
            'store_id'       => $supplierStore_id,
            'payment_type' =>  2,
	        	);
	        $this->bank_model->bankPendingTranjection($bankPending);
    		}
        $this->session->set_flashdata('message', lang('Purchases Payment submited successfully'));
        redirect('supplierpayment/purchase_payment');
    }
    public function purchasesPaymentlist(){ 

        $supplier = $this->input->get('supplier') ? $this->input->get('supplier') : NULL;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date').' 00:00:00' : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date').' 23:59:59' : NULL;                
        $this->load->library('datatables');
        
        $this->datatables->select($this->db->dbprefix('today_purchase_payment') . ".today_payment_id as id, " . 
        	$this->db->dbprefix('suppliers') . ".name as name, " .  
        	$this->db->dbprefix('today_purchase_payment') . ".payment_date as payment_date ,  " . 
        	$this->db->dbprefix('today_purchase_payment') . ".payment_amount, " .
        	$this->db->dbprefix('today_purchase_payment') . ".type, " .
        	$this->db->dbprefix('today_purchase_payment') . ".cheque_no, " . 
        	$this->db->dbprefix('today_purchase_payment') . ".payment_note", FALSE);        
        $this->datatables->join('suppliers', 'suppliers.id=today_purchase_payment.supplier_id');
        $this->datatables->join('stores', 'suppliers.store_id=stores.id');  

        if(!$this->Admin){
          $this->datatables->where('today_purchase_payment.store_id',$this->session->userdata('store_id'));
        }

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
                
         <a href='" . site_url('supplierpayment/purchasesdelete/$1') . "' onClick=\"return confirm('". lang('You are going to delete payment , please click ok to delete') ."')\" title='".lang("delete_payment")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id"); 
        
        $this->datatables->from('today_purchase_payment'); 

        if($supplier) { $this->datatables->where('supplier_id', $supplier); }
        if($start_date) { $this->datatables->where('payment_date >=', $start_date); }
        if($end_date) { $this->datatables->where('payment_date <= ', $end_date); }       
        
        /* if ($today != NULL) {            
            $this->datatables->like('payment_date', $today);            
        }  */       
        $this->datatables->unset_column('id');        
        echo $this->datatables->generate(); 
	  }
    public function paymentList() { 

       $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : NULL;
       $end_date = $this->input->post('end_date') ? $this->input->post('end_date') : NULL;
       $supplier = $this->input->post('Supplier') ? $this->input->post('Supplier') : NULL;

       $this->data['suppliers'] = $this->site->getAllSuppliers();    
       $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));        
       $this->data['page_title'] = 'Suppliers Payemnt List';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Suppliers Payemnt List'
            )
        );        
        $meta = array(
            'page_title' => 'Suppliers Payemnt List',
            'bc' => $bc
        );    
        $this->page_construct('supplierpayment/purchasesPayemntList', $this->data, $meta);
    }
    public function purchasesdelete($id = null){
       
      $getSalesIdfpaytb = $this->purchases_model->getAllpaymentID($id);

      foreach ($getSalesIdfpaytb as $key => $value) {
         $saleIDptb =  $value->purchases_id ;
         $saleAmountptb = $value->amount ;
        
         $getSalesIdfSaltb = $this->purchases_model->getPurchaseByID($value->purchases_id);

         $newPaid = $getSalesIdfSaltb->paid - $saleAmountptb; 
         $newDue = $getSalesIdfSaltb->deu + $saleAmountptb; 

         $dataUpdate  = array(
                        'paid' => $newPaid,
                        'deu'  => $newDue,
                        );
         $this->purchases_model->UpdateSupplierDeu($dataUpdate,$getSalesIdfSaltb->id); 

         $this->purchases_model->deletePaymentForPurchase($id);

         $this->purchases_model->deleteTodayPurPay($id);
         
         $newPaid = 0;
         $newDue = 0;

         $this->session->set_flashdata('message', lang('Purchases delete successfully'));         
      } 
      $this->purchases_model->deleteAdvSupPay($id);
      redirect('supplierpayment/paymentList/');
    }
}