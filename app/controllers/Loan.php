<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Loan extends MY_Controller
{
	
	function __construct(){
		parent::__construct();
        if (! $this->loggedIn) {
            redirect('login');
        } 
        $this->load->library('form_validation');
        $this->load->model('bank_model');
        
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
	}

	public function index() {  
        $this->data['page_title'] = lang('Loaner list');
        $bc = array(array('link' => '#', 'page' => lang('Loaner')));
        $meta = array('page_title' => lang('Loaner list'), 'bc' => $bc);
        $this->page_construct('loaner/list_loaner', $this->data, $meta);
    } 

    public function get_loaner() { 
        $this->load->library('datatables');
    	$this->datatables
    	->select("id, name, phone, email, cf1, cf2")
    	->from("loaner") 
    	->add_column("Actions", "<div class='text-center'>
    		<div class='btn-group'>
    		<a href='" . site_url('loan/loaner_ledger/$1') . "' class='tip btn btn-primary btn-xs' title='Loaner ledger'><i class='fa fa-file-text-o'></i></a>  
    		<a href='" . site_url('loan/edit_loaner/$1') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("edit_loaner")."'><i class='fa fa-edit'></i></a> 
    		<a href='" . site_url('loan/delete_loaner/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_loaner') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("delete_loaner")."'><i class='fa fa-trash-o'></i></a></div></div>", "id")
        ->where('loaner.status', 1)
    	->unset_column('id'); 
    	echo $this->datatables->generate();
    } 

    public function add_loaner(){ 
        if($this->input->post('add_loaner')){            
            $this->form_validation->set_rules('name', 'Loaner Name', 'required'); 
            $data = array(
                'name' => $this->input->post('name'),
                'organization' => $this->input->post('organization'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'cf1' => $this->input->post('cf1'),
                'cf2' => $this->input->post('cf2'), 
				'occupation' => $this->input->post('occupation'), 
			); 
            if(($this->form_validation->run() == true) &&($this->site->insertQuery('loaner',$data))){
                $this->session->set_flashdata('message', 'Loaner Added Successfully');
                redirect('loan');
            }
        }  
        $this->data['designation'] = $this->site->wheres_rows('designation'); 
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Add Loaner Person';
        $bc = array(array('link' => site_url('loan'), 'page' => 'Add Loaner Person'), array('link' => '#', 'page' => 'New LC'));
        $meta = array('page_title' => 'Add Loaner Person', 'bc' => $bc); 
        $this->page_construct('loaner/add_loaner', $this->data, $meta); 
         
    } 
    public function edit_loaner($id){ 
        if($this->input->post('edit_loner')){            
            $this->form_validation->set_rules('name', 'Loaner Name', 'required'); 
            $data = array(
                'name' => $this->input->post('name'),
                'organization' => $this->input->post('organization'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'cf1' => $this->input->post('cf1'),
				'cf2' => $this->input->post('cf2'), 
			);  
            if(($this->form_validation->run() == true) &&($this->site->updateQuery('loaner',$data,array('id'=>$id)))){
                $this->session->set_flashdata('message', 'Loaner Added Successfully');
                redirect('loan');
            }
        }
        $this->data['loaner'] = $this->site->findeNameByID('loaner','id',$id);
        $this->data['designation'] = $this->site->wheres_rows('designation'); 
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Edit Loaner Person';
        $bc = array(array('link' => site_url('loan'), 'page' => 'Edit Loaner Person'), array('link' => '#', 'page' => 'Add Loaner'));
        $meta = array('page_title' => 'Edit Loaner Person', 'bc' => $bc); 
        $this->page_construct('loaner/edit_loaner', $this->data, $meta); 
         
    } 

    public function list_loan(){ 
    	$this->data['page_title'] = lang('All Transaction list');
        $bc = array(array('link' => '#', 'page' => lang('Loaner')));
        $meta = array('page_title' => lang('All Transaction list'), 'bc' => $bc);
        $this->page_construct('loaner/list_loanpay', $this->data, $meta);
    
    }

    public function get_loan(){ 
    	$this->load->library('datatables');
    	$this->datatables->select($this->db->dbprefix('payloaner').".id as payid, ".
            $this->db->dbprefix('payloaner').".entry_date, ".
            $this->db->dbprefix('loaner').".name, ".
            $this->db->dbprefix('payloaner').".type, ".
            $this->db->dbprefix('payloaner').".payment_type, ".
            $this->db->dbprefix('payloaner').".amount, ".
            $this->db->dbprefix('payloaner').".note")
    	->from("payloaner") 
    	->add_column("Actions", "<div class='text-center'>
    		<div class='btn-group'>
            <a href='javascript:;' onClick='loanNoteEdit($1)' title='Edit Note' class='tip btn btn-primary btn-xs'><i class='fa fa-edit'></i></a>
    		<a href='" . site_url('loan/delete_loan/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("delete_customer")."'><i class='fa fa-trash-o'></i></a></div></div>", "payid")
    	->join('loaner','loaner.id=payloaner.loaner_id')
    	->unset_column('payid'); 
    	echo $this->datatables->generate(); 
    
    }

    public function noteEdit($id){  
        $this->data['info']  = $this->site->findeNameByID('payloaner','id',$id);    
        $this->data['title'] = 'Edit Note';
        $bc = array(array('link' => site_url('Edit Note'), 'page' => 'Note'), array('link' => '#', 'page' => 'Edit Note'));
        $meta = array('page_title' => 'Edit Note', 'bc' => $bc);        
        $this->load->view($this->theme.'loaner/noteEdit', $this->data);
    }
    public function noteUpdate($id = NULL){  
        if($id ==''){   
           redirect('sales');
        }
        $note = $this->input->post('note');
        $noteData = array(
            'note' => $note 
        );
        $this->site->updateQuery('payloaner',$noteData,$array = array('id'=>$id));
        $this->session->set_flashdata('message', "Sale note successfully updated ");
        redirect('loan/list_loan');        
    }

    public function pay_loan(){ 
    	if($this->input->post('add_loan')){
    		$this->form_validation->set_rules('loaner', 'Loaner Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required'); 
            $date = $this->input->post('date') ? $this->input->post('date') : date('Y-m-d H:i:s');
            $payment_type = $this->input->post('payment_type');
            $data = array(
                'amount'    => $this->input->post('amount'),
            	'payment_type' 	=> $this->input->post('payment_type'),
                'cheque_or_card_no'    => $this->input->post('cheque_or_card_no'),
                'bank_id'      => $this->input->post('bank'),
            	'loaner_id' => $this->input->post('loaner'),
                'note'      => $this->input->post('note'),
            	'entry_date'=> $date,
                'bankname'      => $this->input->post('bankname'),
            	'type'		=> 'pay',
            ); 
            if($payment_type == 'cheque' || $payment_type == 'card'){
              $data['bank_id']  =  $this->input->post('bank');
              $data['cheque_or_card_no']  =  $this->input->post('cheque_or_card_no');
            }
            if(($this->form_validation->run() ==true) && ($loanId = $this->site->insertQuery('payloaner',$data))){

                if($payment_type == 'cheque'){
                    $bankPending = array(
                        'loan_id'  => $loanId,
                        'loner_id'       => $this->input->post('loaner'),
                        'bank_id'      => $this->input->post('bank'),
                        'payment_type' => $this->input->post('payment_type'),
                        'type' => 'pay', 
                        'bank_status' => 'Pending',
                        'cheque_or_card_no'    => $this->input->post('cheque_or_card_no'),
                        'amount'    => $this->input->post('amount'),
                        'created_by' => $this->session->userdata('user_id') 
                    ); 
                }
                $this->site->insertQuery('bank_pending_loan', $bankPending);
            	$this->session->set_flashdata('message','Loan add Successfully');
            	redirect('loan/pay_loan');
            }
    	}        
        $this->data['loaner'] = $this->site->wheres_rows('loaner', array('status'=>1));        
        $this->data['page_title'] = 'Loan Pay';
        $bc = array(array('link' => '#','page' => 'Loan Pay' ) );        
        $meta = array('page_title' => 'Loan Pay','bc' => $bc);        
        $this->page_construct('loaner/pay_loan', $this->data, $meta);
    
    }

    public function add_loan(){  
    	if($this->input->post('add_loan')){
    		$this->form_validation->set_rules('loaner', 'Loaner Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required'); 
            $date = $this->input->post('date') ? $this->input->post('date') : date('Y-m-d H:i:s');
            $payment_type = $this->input->post('payment_type');
            $data = array(
            	'amount' 	=> $this->input->post('amount'),
            	'loaner_id' => $this->input->post('loaner'),
                'payment_type'  => $this->input->post('payment_type'),
                'cheque_or_card_no'    => $this->input->post('cheque_or_card_no'),
                'bank_id'      => $this->input->post('bank'),
                'note'      => $this->input->post('note'),
            	'entry_date'=> $date,
            	'type'		=> 'receive',
                'bankname'      => $this->input->post('bankname'),
            );
            if(($this->form_validation->run() ==true) && ($loanId = $this->site->insertQuery('payloaner',$data))){ if($payment_type == 'cheque'){
                    $bankPending = array(
                        'loan_id'  => $loanId,
                        'loner_id'       => $this->input->post('loaner'), 
                        'payment_type' => $this->input->post('payment_type'),
                        'type' => 'receive',
                        'bank_id' => $this->input->post('bank'),
                        'bank_status' => 'Pending',
                        'cheque_or_card_no'    => $this->input->post('cheque_or_card_no'),
                        'amount'    => $this->input->post('amount'),
                        'created_by' => $this->session->userdata('user_id') 
                    ); 
                }
                $this->site->insertQuery('bank_pending_loan', $bankPending);
            	$this->session->set_flashdata('message','Loan add Successfully');
            	redirect('loan/add_loan');
            }
    	}        
        //$this->data['loaner'] = $this->site->seleteQuery('loaner');    
        $this->data['loaner'] = $this->site->wheres_rows('loaner', array('status'=>1));       
        $this->data['page_title'] = 'Loan Receive';
                $bc = array(array('link' => '#','page' => 'Loan Receive'
            )
        );        
        $meta = array('page_title' => 'Loan Receive','bc' => $bc);        
        $this->page_construct('loaner/add_loan', $this->data, $meta);    
    }

    public function loanerInfo($id){
    	$loanerPerson = $this->site->findeNameByID('loaner','id',$id);
    	$loanerinfo = $this->site->getDataByElement('payloaner','loaner_id',$id);
    	$in=0;
    	$ount=0;
    	foreach ($loanerinfo as $key => $loaner) {
    		if($loaner->type=='receive'){
    			$in +=$loaner->amount;
    		}else{
    			$ount +=$loaner->amount;
    		}
    	} 
    	echo '<div class="col-xs-10">
            <h3 class"box-title">Loan information ('. $loanerPerson->name.')</h3>
            <p>Loaner information</p>
            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td class="col-xs-5">Receive loan amount</td>
                    <?= $today; ?>
                    <td class="col-xs-7">'.$in.'</td>
                  </tr>
                  <tr>
                    <td class="col-xs-5">Pay loan amount</td>
                    <td class="col-xs-7">'.$ount.'</td>
                  </tr> 
                  <tr>
                    <td class="col-xs-5">Total Balance</td>
                    <td class="col-xs-7">'.($ount-$in).'</td>
                  </tr>
                </tbody>
              </table>
             </div>
             <div class="col-xs-10">';
             
    }

    public function loaner_ledger($id=NULL){ 
        if($id){
            $this->data['loanerinfo'] = $this->site->whereRows('payloaner','loaner_id',$id); 
             
        }else{
            $this->data['loanerinfo'] = $this->site->seleteQuery('payloaner'); 
        }  
        $this->data['loaner_id'] = $id;
    	$meta = array('page_title' => 'Loan Ledger','bc' => $bc);        
        $this->page_construct('loaner/loner_ledger', $this->data, $meta);
    }

    public function delete_loaner($id){ 
        if($this->site->updateQuery('loaner',array('status'=>0),array('id' => $id))){            
           $this->session->set_flashdata('message','Loaner Delete Successfully');
        }else{
           $this->session->set_flashdata('error','Loaner Delete Successfully');
        }
        redirect("loan");    
    }

    public function delete_loan($id){       
        if($this->site->deleteQuery('payloaner',array('id' => $id))){            
           $this->session->set_flashdata('message','Pay loaner Delete Successfully');
        }else{
           $this->session->set_flashdata('error','Pay loaner Successfully');
        }
        redirect("loan/list_loan");
    }
    public function loaner_ledger_csv($id=NULL){
        $lonerName = '';
        if($id){
            $loanerinfo = $this->site->whereRows('payloaner','loaner_id',$id); 
            $loaner = $this->site->whereRow('loaner','id',$id); 
            $lonerName = $loaner->name;
            $lonerNames = str_replace(' ','_',$loaner->name).'_';
        }else{
            $loanerinfo = $this->site->seleteQuery('payloaner'); 
        } 
        $emptyvalue = '0.00';
        $gtotal ='';
        $pgtotal = '';
        $sgtotal = '';
        $i = 0; 
        $file_name  = 'loan_ledger_'.$lonerNames.date('d_m_Y');
        header('Content-type: text/xls');
        header('Content-disposition: attachment;filename='.$file_name.'.xls');  
        ?>
         <h2 style="text-align: center; margin: 0; padding: 0;">M/S.SHARNA ELECTRONICS <br>
            Loan Ledger <?= $lonerName ? '<br>'. $lonerName : '';?>
        </h2>
        <table width="1000px" style="border: none; float: left;">
            <tbody>
              <tr>
                <td colspan="7" style="text-align: right;">
                  Print Date: <?= date('d/m/Y'); ?>
                </td>
              </tr>
            </tbody>
          </table>
        <table width="1000px" border="1"> 
            <thead>
                <tr class="active">
                    <th class="col-xs-1">Sl. No</th>
                    <th class="col-xs-2">Date & time </th>
                    <th class="col-xs-2">Name</th>
                    <th class="col-xs-2">Type</th>                                    
                    <th class="col-xs-2">Dr</th>
                    <th class="col-xs-3">Cr</th>
                    <th class="col-xs-2">Balance</th>
                </tr>
            </thead>  
            <tbody>
                <?php 
                foreach ($loanerinfo as $key => $value) {
                    $loaner = $this->site->whereRow('loaner','id',$value->loaner_id);
                    $i++; 
                    $gtotal = $gtotal;
                    echo '<tr>' ;
                        echo '<td class="center">'.$i .'</td>' ;
                        echo '<td class="center">'. date('d/m/Y',strtotime($value->entry_date)) .'</td>';
                        echo '<td class="center">'. $loaner->name .'</td>' ; 
                        echo "<td class=\"center\">".$value->type .'</td>' ; 
                        if(($value->type == 'pay')){ 
                            echo '<td class="center">'.$emptyvalue.'</td>' ;
                        }else{
                            echo '<td class="center">'.$this->tec->formatMoney($value->amount) .'</td>' ;
                            $sgtotal = $sgtotal + $value->amount;                                       
                        } 
                        if(($value->type == 'receive')){   
                            echo '<td class="center">'.$emptyvalue.'</td>' ;
                        }else{
                            echo '<td class="center">'.abs($value->amount).'</td>';
                            $pgtotal = $pgtotal + $value->amount;
                        }                                        
                        $gtotal = $sgtotal - $pgtotal;
                        echo '<td class="center">'.$gtotal. '</td>' ;
                    echo '</tr>';                                 
                } 
            ?>
            <tr>
                <td colspan="4"></td> 
                <td class="center"><?php echo $sgtotal; ?></td>
                <td class="center"><?php echo $pgtotal;?></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <!-- <table width="1000px">
        <tr>
          <td colspan="2" style="text-align: left;">Manager</td>
          <td colspan="2" style="text-align: center;">Exclutive Director</td>
          <td colspan="3" style="text-align: right;">Director</td> 
        </tr>
      </table> -->

        <?php
    }
    public function loan_report(){ 
        $this->data['loanerinfo'] = $this->site->seleteQuery('loaner'); 
        $this->data['page_title'] = lang('Loaner Report');
        $bc = array(array('link' => '#', 'page' => lang('Loaner Report')));
        $meta = array('page_title' => lang('Loaner Report'), 'bc' => $bc);       
        $this->page_construct('loaner/loan_report', $this->data, $meta);
    } 
    public function loan_report_csv(){
        $loanerinfo = $this->site->seleteQuery('loaner'); 
        $file_name  = 'loan_report_'.date('d/m/Y');
        header('Content-type: text/xls');
        header('Content-disposition: attachment;filename='.$file_name.'.xls');  
        ?>
        <h2 style="text-align: center; margin: 0; padding: 0">Electro House <br>
            Loan Reports
        </h2> 
        <table width="1000px" style="border: none;">
            <tbody>
              <tr>
                  <th colspan="4" style="text-align: right;border:none;">Print Date: <?= date('d/m/Y') ?></th>  
              </tr>
            </tbody>
        </table> 
        <table width="1000px" border="1"> 
            <thead>
            <tr> 
                <th style="width: 200px"><?php echo $this->lang->line("Name"); ?></th>
                <th style="width: 200px"><?php echo $this->lang->line("Pay"); ?></th>
                <th style="width: 200px"><?php echo $this->lang->line("Receive"); ?></th>
                <th style="width: 200px"><?php echo $this->lang->line("Balance"); ?></th> 
            </tr>
            </thead>
            <tbody> 
                <?php 
                if($loanerinfo){
                    foreach ($loanerinfo as $key => $value) { 
                        $out = $this->bank_model->loanOut($value->id);
                        $in = $this->bank_model->loanIn($value->id);
                        $totalout +=$out;
                        $totalin +=$in; 
                ?>
                <tr>
                    <td><?= $value->name?></td>
                    <td><?= $out ? $out : 0; ?> </td>
                    <td><?= $in ? $in : 0; ?> </td>
                    <td><?= ($out-$in) ?> </td>
                </tr>
                <?php } ?>
                <tr>
                    <td>Total</td>
                    <td><?= $totalout ?> </td>
                    <td><?= $totalin ?> </td>
                    <!-- <td><?= ($totalout-$totalin) ?> </td> -->
                    <td> </td>
                </tr>
                <?php } ?> 
            </tbody>
        </table>
       <!--  <table width="1000px">
            <tr>
              <td>Manager</td>
              <td>Exclutive Director</td>
              <td></td>
              <td>Director</td>
            </tr>
        </table> -->
       <?php 
    } 

    function designation_add($p){
        if($p == 'add'){ 
            $this->site->insertQuery('designation', array('destination'=>$this->input->post('designation')));
            $this->session->set_flashdata('message','Occupation Added');
            redirect('loan/add_loaner');
        }        
        $this->load->helper('security'); 
            
            $this->load->view($this->theme . 'loaner/designation',$this->data);   
    }


    public function bankInfo($type,$sid){  

     // $suppliers = $this->purchases_model->getSupplierByID($sid);
      //foreach ($suppliers as $key => $supplier)  
        $banks = $this->site->getAllBanks(); 
        if($type=='cheque'){
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
                        <input type="text" name="cheque_or_card_no" class="form-control" required="required">
                    </div>'; 
            echo $output;
        }else if($type=='card'){
           $output= ' <div class="form-group">
                    <label>Bank Name </label>
                        <input type="text" name="bankname" class="form-control">
                    </div>
                    ';        
                                                    
            $output .=' 
                    <div class="form-group">
                    <label>Card No </label>
                        <input type="text" name="cheque_or_card_no" class="form-control">
                    </div>'; 
            echo $output; 
        }
    }
    
}
