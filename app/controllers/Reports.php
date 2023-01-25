<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if ( ! $this->loggedIn) {
            redirect('login');
        }
        $this->load->model('reports_model');
        $this->load->model('sales_model');
        $this->load->model('purchases_model');
        $this->load->model('bank_model');
        $this->load->library('form_validation');
    }
    public function cash_book(){
        $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : NULL; 
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL; 
        $results = array(); 
        $this->data['todaySale'] = $this->reports_model->todaySale($start_date,$store_id);
        $this->data['todayCollection'] = $this->reports_model->todayCollection($start_date,$store_id); 
        $this->data['expenses'] = $this->reports_model->expenses($store_id,$start_date); 
        $this->data['banks'] =  $this->sales_model->banks2($start_date); 
        $this->data['bankCash'] = $this->bank_model->totalBankCash($store_id); 
        $this->data['withdrow'] = $this->reports_model->banksWithdrow($start_date);
        $this->data['payment'] = $this->reports_model->supplierPayment($store_id,$start_date);  
        $this->data['loanPay'] = $this->reports_model->loanPay($start_date);
        $this->data['loanCollect'] = $this->reports_model->loanCollect($start_date);
        $this->data['assetPay'] = $this->reports_model->assetPay($start_date);
        $this->data['assetCollect'] = $this->reports_model->assetCollect($start_date);
        $this->data['expansesPay'] = $this->reports_model->expansesPay($start_date);
        $this->data['incomeCollect'] = $this->reports_model->incomeCollect($start_date);
        $this->data['donations'] = $this->reports_model->donationsPay($start_date);
        $this->data['results'] = $results;
        $this->data['warehouses'] = $this->site->getAllStores(); 
        $this->data['date_range'] = $start_date;
        $bc = array(array('link' => '#', 'page' => lang('Cash Book')), array('link' => '#', 'page' => lang('Cash Book')));
        $meta = array('page_title' => lang('Cash Book'), 'bc' => $bc);
        $this->page_construct('reports/cash_book', $this->data, $meta); 
    }

    public function daily_statement(){
        $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : NULL;  
        $end_date = $this->input->post('end_date') ? $this->input->post('end_date') : NULL;  
        $results = array(); 
        $this->data['todaySale'] = $this->reports_model->todaySale($start_date,$end_date);
        $this->data['todayCollection'] = $this->reports_model->todayCollection($start_date,$end_date); 
        $this->data['expenses'] = $this->reports_model->expenses($start_date,$end_date); 
        $this->data['bankPays'] =  $this->reports_model->bankPays($start_date,$end_date);  
        $this->data['bankCash'] = $this->reports_model->totalBankCash2(null, $start_date,$end_date);  
        $this->data['bankWithdrow'] = $this->reports_model->banksWithdrow($start_date,$end_date);
        $this->data['payment'] = $this->reports_model->supplierPayment($start_date,$end_date);  
        $this->data['loanPay'] = $this->reports_model->loanPays($start_date,$end_date);
        $this->data['loanCollect'] = $this->reports_model->loanCollect($start_date,$end_date); 
        $this->data['donations'] = $this->reports_model->donationsPay($start_date,$end_date);
        $this->data['results'] = $results; 
        $this->data['date_range'] = $start_date;
        $bc = array(array('link' => '#', 'page' => lang('daily_Statement')), array('link' => '#', 'page' => lang('Daily_Report')));
        $meta = array('page_title' => lang('Daily_Statement'), 'bc' => $bc);
        $this->page_construct('reports/daily_statement', $this->data, $meta); 
    }

    public function excel_daily_statement($data=''){
        $data_arr=explode("_",$data);

        $start_date = $data_arr[0] ? $data_arr[0] : NULL;  
        $end_date = $data_arr[1] ? $data_arr[1] : NULL;  
        $results = array(); 
        $todaySale = $this->reports_model->todaySale($start_date,$end_date);
        $todayCollection = $this->reports_model->todayCollection($start_date,$end_date); 
        $expenses = $this->reports_model->expenses($start_date,$end_date); 
        $bankPays =  $this->reports_model->bankPays($start_date,$end_date);  
        $bankWithdrow = $this->reports_model->banksWithdrow($start_date,$end_date);
        $payment = $this->reports_model->supplierPayment($start_date,$end_date);  
        $loanPay = $this->reports_model->loanPays($start_date,$end_date);
        $loanCollect = $this->reports_model->loanCollect($start_date,$end_date); 
        $donations = $this->reports_model->donationsPay($start_date,$end_date);
        $this->data['bankCash'] = $this->reports_model->totalBankCash2(null, $start_date,$end_date);  
        $this->data['results'] = $results; 
        $this->data['date_range'] = $start_date;
        

        $fileName = "daily_statement_" . date('Y-m-d_h_i_s') . ".xls"; 
        // Column names 
        $fields = array('Date', 'Cusrtomer', 'Collections', 'Cash Sale', 'Total Cash', 'Exp-Descriptions', 'Bank Pay', 'Expenses');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        $totalCcolled=0;
        $totalCashColled = 0;  
        $totalExpenses = 0;
        $totalBank = 0;
        $previousBanance =0;
        if(count($todayCollection) > 0){ 
            foreach($todayCollection as $row){
                $totalCcolled += $row->payment_amount;   
                $collDate = date('Y-m-d', strtotime($row->payment_date));  
                $lineData = array($collDate, $row->customer_name, $row->payment_amount, '', $row->payment_amount, '', '', ''); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($todaySale) > 0){ 
            foreach($todaySale as $row){
                $totalCashColled += $row->payment_amount;   
                $collDate = date('Y-m-d', strtotime($row->date));  
                $lineData = array($collDate, $row->customer_name, '', $row->payment_amount, $row->payment_amount, '', '', ''); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($loanCollect) > 0){ 
            foreach($loanCollect as $row){
                $totalCcolled += $row->amount;   
                $collDate = date('Y-m-d', strtotime($row->entry_date));  
                $lineData = array($collDate, $row->name, '', $row->amount, 0, 0, 0, 0); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($bankWithdrow) > 0){ 
            foreach($bankWithdrow as $row){
                $totalCcolled += $row->tran_amount;   
                $collDate = date('Y-m-d', strtotime($row->tran_date));  
                $lineData = array($collDate, $row->bank_name, $row->tran_amount, 0, 0, 0, 0, 0); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($loanPay) > 0){ 
            foreach($loanPay as $row){
                $totalExpenses += $row->amount;   
                $collDate = date('Y-m-d', strtotime($row->entry_date));  
                $lineData = array($collDate, '', '', 0, 0,$row->name, 0, $row->amount); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($bankPays) > 0){ 
            foreach($bankPays as $row){
                $totalBank += $row->tran_amount;   
                $collDate = date('Y-m-d', strtotime($row->tran_date));  
                $lineData = array($collDate, '-', '-', '-', '-', $row->bank_name.'('.$row->account_name.')' ,$row->tran_amount, '-'); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($expenses) > 0){ 
            foreach($expenses as $row){
                $totalExpenses += $row->amount;   
                $collDate = date('Y-m-d', strtotime($row->date));  
                $lineData = array($collDate, '-', '-', '-', '-', $row->name, '-', $row->amount); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($donations) > 0){ 
            foreach($donations as $row){
                $totalExpenses += $row->amount;   
                $collDate = date('Y-m-d', strtotime($row->entry_date));  
                $lineData = array($collDate, '-', '-', '-', '-', $row->name, '-', $row->amount); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
        if(count($payment) > 0){ 
            foreach($payment as $row){
                $totalExpenses += $row->payment_amount;   
                $collDate = date('Y-m-d', strtotime($row->payment_date));  
                $lineData = array($collDate, '', '', 0, 0, $row->name .' '.$row->payment_note, 0, $row->payment_amount); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }
          
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
         
        // Render excel data 
        echo $excelData; 
    }
    public function daily_statement_csv(){
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : NULL;  
        $results = array(); 
        $todaySale = $this->reports_model->todaySale($start_date);
        $todayCollection = $this->reports_model->todayCollection($start_date); 
        $expenses = $this->reports_model->expenses($start_date); 
        $bankPays =  $this->reports_model->bankPays($start_date);  
        $bankCash = $this->reports_model->totalBankCash2(null, $start_date);  
        $bankWithdrow = $this->reports_model->banksWithdrow($start_date);
        $payment = $this->reports_model->supplierPayment($start_date);  
        $loanPay = $this->reports_model->loanPays($start_date);
        $loanCollect = $this->reports_model->loanCollect($start_date); 
        $donations = $this->reports_model->donationsPay($start_date);
        $results = $results; 
        $date_range = $start_date;
        $file_name  = 'daily_statement_report_'.date('d_m_Y');
        header('Content-type: text/xls');
        header('Content-disposition: attachment;filename='.$file_name.'.xls');  
        ?>
        <h2 style="text-align: center; margin: 0; padding: 0;"><?= $this->Settings->site_name ?> <br>
              Daily Statement
        </h2>
        <table width="1000px" style="border: none;">
        <tbody>
          <tr>
              <th colspan="11" style="text-align: right;border:none;">Print Date: <?=date('d/m/Y') ?></th>  
          </tr>
        </tbody>
        </table>
        <table width="1000px" border="1" style="border-bottom: none; border-right: none; border-left: none; border-top: none;"> 
            <tbody> 
                <tr>
                   <td> Date</td>
                   <td> Cusrtomer</td>  
                   <td> Collections </td> 
                   <td> Cash Sale </td> 
                   <td> Total Cash</td>
                   <td> Exp-Descriptions</td>
                   <td> Bank Pay</td>
                   <td> Expenses </td> 
                 </tr>  
                 <?php 
                  $totalCcolled = 0;
                  $totalCashColled = 0;  
                  $totalExpenses = 0;
                  $totalBank = 0;
                  $del = '';
                  if($todayCollection){ 
                    foreach ($todayCollection as $key => $result) { 
                      $totalCcolled += $result->payment_amount;   
                      $collDate = date('Y-m-d', strtotime($result->payment_date)); 
                      ?>
                      <tr>
                        <td><?= $collDate ?></td>
                        <td><?= $del.$result->customer_name ?></td> 
                        <td><?= $result->payment_amount ?></td> 
                        <td></td>
                        <td><?= $result->payment_amount ?></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td> 
                      </tr>
                    <?php
                    $del ='';
                    }
                  }
                  if($todaySale){ 
                    foreach ($todaySale as $key => $result) {   
                      $totalCashColled += $result->payment_amount;   
                      $collDate = date('Y-m-d', strtotime($result->date)); 
                      ?>
                      <tr>
                        <td><?= $collDate ?></td>
                        <td><?= $del.$result->customer_name ?></td>                      
                        <td></td> 
                        <td><?= $result->payment_amount;?></td>
                        <td><?= $result->payment_amount ?></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td> 
                      </tr>
                      <?php
                      $del ='';
                    }
                  } 
                                             
                  if($loanCollect){  
                    foreach ($loanCollect as $key => $loanCollec) { 
                      $totalCcolled +=$loanCollec->amount;
                    ?>
                    <tr>
                       <td><?= date('Y-m-d',strtotime($loanCollec->entry_date)) ?></td>
                       <td colspan="2"><?= $loanCollec->name ?></td>
                       <td><?= $loanCollec->amount; ?></td>  
                       <td>0</td> 
                       <td>0</td>                               
                       <td>0</td>
                       <td>0</td> 
                    </tr>
                   <?php } 
                  }  
                  if($bankWithdrow){
                    foreach ($bankWithdrow as $key => $withdro) { 
                      $totalCcolled += $withdro->tran_amount ?>
                     <tr>
                       <td><?= date('Y-m-d',strtotime($withdro->tran_date)) ?></td>
                       <td><?= $withdro->bank_name ?></td>
                       <td><?= $withdro->tran_amount; ?></td>    
                       <td>0</td>
                       <td>0</td> 
                       <td>0</td>                               
                       <td>0</td>
                       <td>0</td> 
                     </tr> 
                     <?php }
                  }
                  if($loanPay){  
                    foreach ($loanPay as $key => $loanPays) { 
                      $totalExpenses +=$loanPays->amount;
                    ?>
                     <tr>
                      <td><?= date('Y-m-d',strtotime($loanPays->entry_date)) ?></td>
                       <td colspan="2"></td> 
                       <td>0</td>   
                       <td>0</td> 
                       <td><?= $loanPays->name ?></td>                              
                       <td>0</td>
                       <td><?= $loanPays->amount; ?></td> 
                     </tr>
                   <?php } 
                  } 
                  if($bankPays){ 
                    foreach ($bankPays as $key => $result) {  
                      $totalBank += $result->tran_amount;   
                      $collDate = date('Y-m-d', strtotime($result->tran_date)); 
                      ?>
                      <tr>
                        <td><?= $collDate ?></td> 
                        <td>-</td>                                  
                        <td>-</td> 
                        <td>-</td>
                        <td>-</td>
                        <td><?= $result->bank_name.'('.$result->account_name.')';?></td>
                        <td><?= $result->tran_amount ?></td>
                        <td>-</td>                                    
                      </tr>
                    <?php
                    $del ='';
                    }
                  } 
                  if($expenses){ 
                    foreach ($expenses as $key => $result) {  
                      $totalExpenses += $result->amount;   
                      $collDate = date('Y-m-d', strtotime($result->date)); 
                      ?>
                      <tr>
                        <td><?= $collDate ?></td>
                        <td>-</td>                                
                        <td>-</td> 
                        <td>-</td>
                        <td>-</td>
                        <td><?= $result->reference;?></td>
                        <td>-</td>
                        <td><?= $result->amount ?></td> 
                      </tr>
                    <?php
                    $del ='';
                    }
                  }
                  if($donations){ 
                    foreach ($donations as $key => $donation) {  
                      $totalExpenses += $donation->amount;   
                      $collDate = date('Y-m-d', strtotime($donation->entry_date)); 
                      ?>
                      <tr>
                        <td><?= $collDate ?></td>
                        <td>-</td>                                
                        <td>-</td> 
                        <td>-</td>
                        <td>-</td>
                        <td><?= $donation->name;?></td>
                        <td>-</td>
                        <td><?= $donation->amount ?></td> 
                      </tr>
                    <?php
                    $del ='';
                    }
                  }
                  if($payment){
                    foreach($payment as $key => $paymet){
                    $totalExpenses +=$paymet->payment_amount; ?> 
                    <tr>
                      <td><?= date('Y-m-d',strtotime($paymet->payment_date)) ?></td>
                      <td colspan="2"></td> 
                      <td>0</td>  
                      <td>0</td> 
                      <td><?= $paymet->name .' '.$paymet->payment_note?></td>                           
                      <td>0</td>
                      <td><?= $paymet->payment_amount; ?></td> 
                    </tr> 
                    <?php } 
                  } ?> 
                 <tr>
                   <td colspan="2">Total SUM </td>
                   <td><?= $totalCcolled; ?></td>
                   <td><?= $totalCashColled; ?></td>   
                   <td><?= $totalCcolled+$totalCashColled; ?> </td> 
                   <td> </td>                               
                   <td><?= $totalBank; ?></td>
                   <td><?= $totalExpenses; ?></td>                              
                 </tr>
                 <?php
                  if(isset($_POST['start_date'])){ 
                    $start_date = $this->input->post('start_date'); 
                    $pdate = date( "Y-m-d", strtotime( $start_date . "-1 day")); 
                    $handcash = $this->site->whereRow('handcash','entry_date',$pdate);
                  }else{
                    $pdate = date( "Y-m-d", strtotime( date('Y-m-d') . "-1 day")); 
                    $handcash = $this->site->whereRow('handcash','entry_date',$pdate);
                  } 

                 ?>
                 <tr>
                   <td colspan="2" style="border:none; border-left: 1px solid #fff;"></td> 
                   <td colspan="2"> Previous Balance </td>  
                   <td><?= $previousBanance = $handcash->amount; ?> </td> 
                   <td> </td>                               
                   <td style="border:none;"> </td>
                   <td style="border:none;"> </td>                                
                 </tr>
                 <tr>
                   <td colspan="2" style="border:none; border-left: 1px solid #fff;"></td> 
                   <td colspan="2"> Total Cash </td>  
                   <td><?= $totalCcolled+$totalCashColled + $previousBanance; ?> </td> 
                   <td> Bank Cash</td>                               
                   <td> <?=  $bankCash; ?></td>
                   <td style="border:none;"> </td>                                 
                 </tr>
                 <tr>
                   <td colspan="2" style="border:none; border-left: 1px solid #fff; border-bottom: 1px solid #fff;"></td> 
                   <td colspan="2"> Expenses + Bank Pay </td>  
                   <td><?= $totalExpenses+$totalBank; ?></td> 
                   <td> Hand Cash</td>                               
                   <td> <?= $handCash = ($totalCcolled+$totalCashColled + $previousBanance) - ($totalExpenses+$totalBank); ?></td>
                   <td> <?= ($totalCcolled+$totalCashColled + $previousBanance+$bankCash) - ($totalExpenses+$totalBank); ?> </td>                              
                 </tr>   
            </tbody>
        </table> 
      <?php 
    }

    function daily_sales($year = NULL, $month = NULL)  {
        $this->data['warehouses'] = $this->site->getAllStores();
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;
        if (!$year) { $year = date('Y'); }
        if (!$month) { $month = date('m'); }
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->lang->load('calendar');
        $config = array(
            'show_next_prev' => TRUE,
            'next_prev_url' => site_url('reports/daily_sales'),
            'month_type' => 'long',
            'day_type' => 'long'
            );
        $config['template'] = '

        {table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="min-width:522px;">{/table_open}

        {heading_row_start}<tr class="active">{/heading_row_start}

        {heading_previous_cell}<th><div class="text-center"><a href="{previous_url}">&lt;&lt;</div></a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}"><div class="text-center">{heading}</div></th>{/heading_title_cell}
        {heading_next_cell}<th><div class="text-center"><a href="{next_url}">&gt;&gt;</a></div></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td class="cl_equal"><div class="cl_wday">{week_day}</div></td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}

        {cal_cell_content}<div class="cl_left">{day}</div><div class="cl_right">{content}</div>{/cal_cell_content}
        {cal_cell_content_today}<div class="cl_left highlight">{day}</div><div class="cl_right">{content}</div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
        ';

        $this->load->library('calendar', $config);

        $sales = $this->reports_model->getDailySales($year, $month,$store_id);

        if(!empty($sales)) {
            foreach($sales as $sale){
                $daily_sale[$sale->date] = "<span class='text-warning'>". $sale->tax."</span><br>".$sale->discount."<br><span class='text-success'>".$sale->total."</span><br><span style='border-top:1px solid #DDD;'>".$sale->grand_total."</span>";
            }
        } else {
            $daily_sale = array();
        }

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['calender'] = $this->calendar->generate($year, $month, $daily_sale);

        $start = $year.'-'.$month.'-01 00:00:00';
        $end = $year.'-'.$month.'-'.days_in_month($month, $year).' 23:59:59';
        $this->data['total_purchases'] = $this->reports_model->getTotalPurchases($start, $end,$store_id);
        $this->data['total_sales'] = $this->reports_model->getTotalSales($start, $end,$store_id);
        $this->data['total_expenses'] = $this->reports_model->getTotalExpenses($start, $end,$store_id);

        $this->data['page_title'] = $this->lang->line("daily_sales");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('daily_sales')));
        $meta = array('page_title' => lang('daily_sales'), 'bc' => $bc);
        $this->page_construct('reports/daily', $this->data, $meta);

    }
    public function hand_cash($id=NULL){
        $this->form_validation->set_rules('amount', lang('amount'), 'required'); 
          if ($this->form_validation->run() == true) {
            $data = array(
                'entry_date' => $this->input->post('entry_date'),  
                'amount' => $this->input->post('amount'),
                'note' => $this->input->post('note')
            );
            if($id){
              $this->site->updateQuery('handcash',$data, array('id'=>$id));
              $this->session->set_flashdata('message', lang('Hand Cash successfully Updated '));
              redirect("reports/hand_cash");
            }else{
              $this->site->insertQuery('handcash',$data);
              $this->session->set_flashdata('message', lang('Hand Cash successfully added '));
              redirect("reports/hand_cash");
            }
          } 
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Hand Cash');
        if($id){
          $this->data['info'] = $this->site->whereRow('handcash','id',$id);
        }        
        $bc = array(array('link' => '#', 'page' => lang('Hand Cash')));
        $meta = array('page_title' => lang('Hand Cash'), 'bc' => $bc);
        $this->page_construct('reports/hand_cash', $this->data, $meta); 
    }
    public function get_hand_cash(){ 
        $this->load->library('datatables');
        $this->datatables->select($this->db->dbprefix('handcash').".id as id , ". 
        $this->db->dbprefix('handcash').".entry_date, ".
        $this->db->dbprefix('handcash').".amount, ". 
        $this->db->dbprefix('handcash').".note"); 
        $this->datatables->from('handcash');
        $this->db->order_by('entry_date','desc');  
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
            <a href='" . site_url('reports/hand_cash/$1') . "' title='" . lang("edit_category") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a> 
            <a href='" . site_url('reports/hand_cash_delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_category') . "')\" title='" . lang("delete_category") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();
    }
    public function hand_cash_delete($id){
        $this->site->deleteQuery('handcash', array('id'=>$id));
        redirect('reports/hand_cash');
    }


    function monthly_sales($year = NULL) {
        $this->data['warehouses'] = $this->site->getAllStores();
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;

        if(!$year) { $year = date('Y'); }
        $this->lang->load('calendar');
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $start = $year.'-01-01 00:00:00';
        $end = $year.'-12-31 23:59:59';
        $this->data['total_purchases'] = $this->reports_model->getTotalPurchases($start, $end,$store_id);
        $this->data['total_sales'] = $this->reports_model->getTotalSales($start, $end,$store_id);
        $this->data['total_expenses'] = $this->reports_model->getTotalExpenses($start, $end,$store_id);
        $this->data['year'] = $year;
        $this->data['sales'] = $this->reports_model->getMonthlySales($year,$store_id);
        $this->data['page_title'] = $this->lang->line("monthly_sales");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('monthly_sales')));
        $meta = array('page_title' => lang('monthly_sales'), 'bc' => $bc);
        $this->page_construct('reports/monthly', $this->data, $meta);
    }

    function index() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

        if($this->input->post('customer')) {
            $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : NULL;
            $end_date = $this->input->post('end_date') ? $this->input->post('end_date') : NULL;
            $user = $this->input->post('user') ? $this->input->post('user') : NULL;
            $this->data['total_sales'] = $this->reports_model->getTotalSalesforCustomer($this->input->post('customer'), $user, $start_date, $end_date);
            $this->data['total_sales_value'] = $this->reports_model->getTotalSalesValueforCustomer($this->input->post('customer'), $user, $start_date, $end_date);
			
			$this->data['total_sales_value_paid'] = $this->reports_model->getTotalPaidSalesValueforCustomer($this->input->post('customer'), $user, $start_date, $end_date);
			
			$this->data['total_quantity'] = $this->reports_model->getTotalQuantityValueforCustomer($this->input->post('customer'), $user, $start_date, $end_date);
			
			$this->data['total_Item'] = $this->reports_model->getTotalItemValueforCustomer($this->input->post('customer'), $user, $start_date, $end_date);
			
        }
        $this->data['customers'] = $this->reports_model->getAllCustomers();
        $this->data['users'] = $this->reports_model->getAllStaff();
        $this->data['page_title'] = $this->lang->line("sales_report");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('sales_report')));
        $meta = array('page_title' => lang('sales_report'), 'bc' => $bc);
        $this->page_construct('reports/sales', $this->data, $meta);
    }

    function get_sales()  {
        $customer = $this->input->get('customer') ? $this->input->get('customer') : NULL;
        //$paid_by = $this->input->get('paid_by') ? $this->input->get('paid_by') : NULL;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : NULL;
        $user = $this->input->get('user') ? $this->input->get('user') : NULL;
        $this->load->library('datatables');

        $this->datatables->select($this->db->dbprefix('sales').".id as sid , ". 
        $this->db->dbprefix('sales').".date, ".$this->db->dbprefix('sales').".customer_name, ".
        $this->db->dbprefix('stores').".name as storename, ".
        $this->db->dbprefix('users').".username as createdby, ".
        $this->db->dbprefix('sales').".total, ".
        $this->db->dbprefix('sales').".total_tax, ".$this->db->dbprefix('sales').".total_discount,".
        $this->db->dbprefix('sales').".grand_total, ".$this->db->dbprefix('sales').".paid, (".$this->db->dbprefix('sales').".grand_total -".
        $this->db->dbprefix('sales').".paid) as balance"); 
        $this->datatables->from('sales');
        
        $this->datatables->join('stores', 'stores.id=sales.store_id');
        $this->datatables->join('users', 'users.id=sales.created_by');    
        $this->datatables->unset_column('sid');

        if($customer) { $this->datatables->where('customer_id', $customer); }
        if($user) { $this->datatables->where('sales.created_by', $user); }
        if($start_date) { $this->datatables->where('date >=', $start_date.' 00:00:00'); }
        if($end_date) { $this->datatables->where('date <=', $end_date.' 23:59:59'); }
        if(!$this->Admin){
           $this->datatables->where('sales.store_id',$this->session->userdata('store_id'));
        }

        echo $this->datatables->generate();

    }

    function get_excel_sales($data='')  {
        $data_arr=explode("_",$data);

        $customer = $data_arr[0] ? $data_arr[0] : NULL;
        $user = $data_arr[1] ? $data_arr[1] : NULL;
        $start_date = $data_arr[2] ? $data_arr[2] : NULL;
        $end_date = $data_arr[3] ? $data_arr[3] : NULL;

        $this->db->select(
            $this->db->dbprefix('sales').".id as sid , ". 
            $this->db->dbprefix('sales').".date, ".
            $this->db->dbprefix('sales').".customer_name, ".
            $this->db->dbprefix('stores').".name as storename, ".
            $this->db->dbprefix('users').".username as createdby, ".
            $this->db->dbprefix('sales').".total, ".
            $this->db->dbprefix('sales').".total_tax, ".
            $this->db->dbprefix('sales').".total_discount,".
            $this->db->dbprefix('sales').".grand_total, ".
            $this->db->dbprefix('sales').".paid, (".$this->db->dbprefix('sales').".grand_total -".$this->db->dbprefix('sales').".paid) as balance");
        $this->db->from('sales');
        $this->db->join('stores', 'stores.id=sales.store_id');
        $this->db->join('users', 'users.id=sales.created_by');  
        if($customer) { $this->db->where('customer_id', $customer); }
        if($user) { $this->db->where('sales.created_by', $user); }
        if($start_date) { $this->db->where('date >=', $start_date.' 00:00:00'); }
        if($end_date) { $this->db->where('date <=', $end_date.' 23:59:59'); }
        if(!$this->Admin){
           $this->db->where('sales.store_id',$this->session->userdata('store_id'));
        }
        $query_data = $this->db->get()->result();
        $fileName = "sales_report_" . date('Y-m-d_h_i_s') . ".xls"; 
        $fields = array('DATE', 'CUSTOMER', 'STORE NAME', 'CREATED BY', 'TOTAL', 'TAX', 'DISCOUNT', 'GRAND TOTAL', 'PAID', 'BALANCE');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query_data) > 0){ 
            foreach($query_data as $row){ 
                $lineData = array($row->date, $row->customer_name, $row->storename, $row->createdby, $row->total, $row->total_tax, $row->total_discount, $row->grand_total, $row->paid, $row->balance); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
            
        // Headers for download 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
            
        // Render excel data 
        echo $excelData;    

    }

    function products() {
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $warehouse = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;
        $this->data['products'] = $this->reports_model->getAllProducts();
        $this->data['warehouses'] = $this->site->getAllStores();
        $this->data['page_title'] = $this->lang->line("products_report");
        $this->data['page_title'] = $this->lang->line("products_report");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('products_report')));
        $meta = array('page_title' => lang('products_report'), 'bc' => $bc);
        $this->page_construct('reports/products', $this->data, $meta);
    }

    function get_products()  {
        $store_id = $this->input->get('warehouse') ? $this->input->get('warehouse') : NULL;
        $product = $this->input->get('product') ? $this->input->get('product') : NULL;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : NULL;
 
        $this->load->library('datatables');
        $this->datatables
        ->select($this->db->dbprefix('products').".name, ".
            $this->db->dbprefix('stores').".name as storename , ".
            $this->db->dbprefix('products').".code, COALESCE(sum(".
            $this->db->dbprefix('sale_items').".quantity), 0) as sold, ROUND(COALESCE(((sum(".
            $this->db->dbprefix('sale_items').".subtotal)*".
            $this->db->dbprefix('products').".tax)/100), 0), 2) as tax, COALESCE(sum(".
            $this->db->dbprefix('sale_items').".quantity)*".
            $this->db->dbprefix('sale_items').".cost, 0) as cost, COALESCE(sum(".
            $this->db->dbprefix('sale_items').".subtotal), 0) as income, ROUND((COALESCE(sum(".
            $this->db->dbprefix('sale_items').".subtotal), 0)) - COALESCE(sum(".
            $this->db->dbprefix('sale_items').".quantity)*".
            $this->db->dbprefix('sale_items').".cost, 0) -COALESCE(((sum(".
            $this->db->dbprefix('sale_items').".subtotal)*".
            $this->db->dbprefix('products').".tax)/100), 0), 2)
            as profit", FALSE)
        ->from('sale_items')
        ->join('products', 'sale_items.product_id=products.id', 'left' )
        ->join('stores', 'stores.id=sale_items.store_id', 'left' )
        ->group_by('products.id');

        if($product) { $this->datatables->where('products.id', $product); }
        if($start_date) { $this->datatables->where('sale_items.date >=', $start_date.' 00:00:00'); }
        if($end_date) { $this->datatables->where('sale_items.date <=', $end_date.' 23:59:59'); }
        if($store_id !=NULL) { $this->datatables->where('sale_items.store_id',$store_id); }
        if(!$this->Admin){
            $this->datatables->where('sale_items.store_id',$this->session->userdata('store_id'));
        }

        echo $this->datatables->generate();

    } 

    function get_excel_products($data='')  {
        $data_arr=explode("_",$data);
        $store_id =$data_arr[0] ?$data_arr[0] : NULL;
        $product = $data_arr[1] ? $data_arr[1] : NULL;
        $start_date = $data_arr[2] ? $data_arr[2] : NULL;
        $end_date = $data_arr[3] ? $data_arr[3] : NULL;
 
       
        $this->db->select(
            $this->db->dbprefix('products').".name, ".
            $this->db->dbprefix('stores').".name as storename , ".
            $this->db->dbprefix('products').".code, COALESCE(sum(".
            $this->db->dbprefix('sale_items').".quantity), 0) as sold, ROUND(COALESCE(((sum(".
            $this->db->dbprefix('sale_items').".subtotal)*".
            $this->db->dbprefix('products').".tax)/100), 0), 2) as tax, COALESCE(sum(".
            $this->db->dbprefix('sale_items').".quantity)*".
            $this->db->dbprefix('sale_items').".cost, 0) as cost, COALESCE(sum(".
            $this->db->dbprefix('sale_items').".subtotal), 0) as income, ROUND((COALESCE(sum(".
            $this->db->dbprefix('sale_items').".subtotal), 0)) - COALESCE(sum(".
            $this->db->dbprefix('sale_items').".quantity)*".
            $this->db->dbprefix('sale_items').".cost, 0) -COALESCE(((sum(".
            $this->db->dbprefix('sale_items').".subtotal)*".
            $this->db->dbprefix('products').".tax)/100), 0), 2)
            as profit");
        $this->db->from('sale_items');
        $this->db->join('products', 'sale_items.product_id=products.id', 'left' );
        $this->db->join('stores', 'stores.id=sale_items.store_id', 'left' );
        $this->db->group_by('products.id');
        if($product) { $this->datatables->where('products.id', $product); }
        if($start_date) { $this->datatables->where('sale_items.date >=', $start_date.' 00:00:00'); }
        if($end_date) { $this->datatables->where('sale_items.date <=', $end_date.' 23:59:59'); }
        if($store_id !=NULL) { $this->datatables->where('sale_items.store_id',$store_id); }
        if(!$this->Admin){
            $this->db->where('sale_items.store_id',$this->session->userdata('store_id'));
        }
        
        $query_data = $this->db->get()->result();
        $fileName = "product_report_" . date('Y-m-d_h_i_s') . ".xls"; 
        $fields = array('NAME', 'STORE NAME', 'CODE', 'SOLD', 'TAX', 'COST', 'INCOME', 'PROFIT');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query_data) > 0){ 
            foreach($query_data as $row){ 
                $lineData = array($row->name, $row->storename, $row->code, $row->sold, $row->tax, $row->cost, $row->income, $row->profit); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
            
        // Headers for download 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
            
        // Render excel data 
        echo $excelData;        

    } 
    function sold_purchase() { 

        if((!$this->Admin) && (!$this->Manager)){

            $this->session->set_flashdata('error', lang("access_denied"));

            redirect($_SERVER["HTTP_REFERER"]);

        }
        
        if(!$this->Admin){
            $warehouse = $this->session->userdata('store_id');
        }else{
            $warehouse = $this->input->post('warehouse'); 
        }
        
        $this->data['warehouses'] = $this->site->getAllStores();
        $this->data['results'] = $this->reports_model->saleAndPurseCount($warehouse);  
        $this->data['products'] = $this->reports_model->getAllProducts();
        $this->data['page_title'] = $this->lang->line("products_report");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('products_report')));
        $meta = array('page_title' => lang('products_report'), 'bc' => $bc);
        $this->page_construct('reports/reports_purchses', $this->data, $meta);
    } 

    function excel_sold_purchase($data='') { 

        if((!$this->Admin) && (!$this->Manager)){
            $this->session->set_flashdata('error', lang("access_denied"));
            redirect($_SERVER["HTTP_REFERER"]);
        }
        
        if(!$this->Admin){
            $warehouse = $this->session->userdata('store_id');
        }else{
            $warehouse = $data; 
        }     
            
        $query_data = $this->reports_model->saleAndPurseCount($warehouse); 
        $fileName = "sold_purchase_report_" . date('Y-m-d_h_i_s') . ".xls";  
        $fields = array('NAME', 'CODE', 'SOLD', 'PURCHASES');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query_data) > 0){ 
            foreach($query_data as $row){ 
                $soldValue=$row['sold'] - $row['sreturn'];
                $lineData = array($row['name'], $row['code'], $soldValue, $row['purchase']); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
            
        // Headers for download 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
            
        // Render excel data 
        echo $excelData;        
    } 

    function productQuery() {
        $type = $this->input->post('type');    
        $pcode = $this->input->post('pcode');   //49w750d'; 
        $warehouse = $this->input->post('warehouse');        
        $this->data['products'] = $this->reports_model->getAllProducts();
        $this->data['results'] = $this->reports_model->pquery($type,$pcode,$warehouse);
        // echo "<pre>".print_r($this->reports_model->pquery($type,$pcode,$warehouse));die;
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('products_report')));
        $meta = array('page_title' => lang('products_report'), 'bc' => $bc);
        $this->data['warehouses'] = $this->site->getAllStores();
        $this->page_construct('reports/report_pquery', $this->data, $meta);
    }

    function products_staff() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

        $this->data['products'] = $this->reports_model->getAllProducts();
        $this->data['page_title'] = $this->lang->line("products_report");
        $this->data['page_title'] = $this->lang->line("products_report");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('products_report')));
        $meta = array('page_title' => lang('products_report'), 'bc' => $bc);
        $this->page_construct('reports/products_staff', $this->data, $meta);
    }

    function products_all() {
	
		$this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

		$this->data['products'] = $this->reports_model->getAllProducts();
		$this->data['quantity'] = $this->reports_model->getAllquantity();
		$costs = $this->reports_model->getAllcost();
		$cost = 0;
		foreach($costs as $costs_value){
			if($costs_value->quantity >0 ){
			 $cost += $costs_value->cost * $costs_value->quantity ;
			}
		 }
		$this->data['cost'] = $cost;
		
		$this->data['page_title'] = $this->lang->line("products_report");
		$bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('products_report')));
		$meta = array('page_title' => lang('products_report'), 'bc' => $bc);
		$this->page_construct('reports/products_all', $this->data, $meta);
	}
 
	function get_products_staff() {
         $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('products').".id as pid,
		  ".$this->db->dbprefix('products').".name as pname ,
		  ".$this->db->dbprefix('categories').".name as cname, 
		  ".$this->db->dbprefix('products').".code as code, 
		   price ", FALSE);

         $this->datatables->join('categories', 'categories.id=products.category_id')

         ->from('products')

         ->group_by('products.id');
		
         $this->datatables->unset_column('pid');
		
		 $this->datatables->where('products.quantity >', 0);

         echo $this->datatables->generate();

    }

	function get_excel_products_staff() {
        $this->db->select(
            $this->db->dbprefix('products').".id as pid,".
            $this->db->dbprefix('products').".name as pname ,".
            $this->db->dbprefix('categories').".name as cname,".
            $this->db->dbprefix('products').".code as code, 
		   price ");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id=products.category_id');
        $this->db->group_by('products.id');;
        $this->db->where('products.quantity >', 0);
            
        $query_data = $this->db->get()->result();
        $fileName = "products_report_staff_" . date('Y-m-d_h_i_s') . ".xls"; 			
        $fields = array('NAME', 'CATEGORY', 'CODE', 'SALE PRICE');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query_data) > 0){ 
            // Output each row of the data 
            foreach($query_data as $row){ 
                $lineData = array($row->pname, $row->cname, $row->code, $row->price); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 

        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 

        echo $excelData;  

    }
	
	function get_products_all() {
         $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('products').".id as pid,
		  ".$this->db->dbprefix('products').".name as pname ,
		  ".$this->db->dbprefix('categories').".name as cname, 
		  ".$this->db->dbprefix('products').".code as code, 
		    quantity, cost, price  ", FALSE);

         $this->datatables->join('categories', 'categories.id=products.category_id')

         ->from('products')

         ->group_by('products.id');
		
         $this->datatables->unset_column('pid');
		
         echo $this->datatables->generate();
    }

	function get_excel_products_all() {
        $this->db->select(
            $this->db->dbprefix('products').".id as pid,".
            $this->db->dbprefix('products').".name as pname ,".
            $this->db->dbprefix('categories').".name as cname, ".
            $this->db->dbprefix('products').".code as code, quantity, cost, price");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id=products.category_id');
        $this->db->group_by('products.id');;
            
        $query_data = $this->db->get()->result();
        $fileName = "products_report_all_" . date('Y-m-d_h_i_s') . ".xls"; 			
        $fields = array('NAME', 'CATEGORY', 'CODE', 'QUANTITY', 'COST', 'SALE PRICE');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query_data) > 0){ 
            // Output each row of the data 
            foreach($query_data as $row){ 
                $lineData = array($row->pname, $row->cname, $row->code, $row->quantity, $row->cost, $row->price); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 

        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 

        echo $excelData; 
    }

	function get_excel_products_stock() {
        $this->db->select(
            $this->db->dbprefix('products').".id as pid,".
            $this->db->dbprefix('products').".name as pname ,".
            $this->db->dbprefix('categories').".name as cname, ".
            $this->db->dbprefix('products').".code as code, quantity, cost, price");
        $this->db->from('products');
        $this->db->join('categories', 'categories.id=products.category_id');
        $this->db->group_by('products.id');;
            
        $query_data = $this->db->get()->result();
        $fileName = "products_stock_report_" . date('Y-m-d_h_i_s') . ".xls"; 			
        $fields = array('NAME', 'CATEGORY', 'CODE', 'QUANTITY');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query_data) > 0){ 
            // Output each row of the data 
            foreach($query_data as $row){ 
                $lineData = array($row->pname, $row->cname, $row->code, $row->quantity); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 

        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 

        echo $excelData; 
    }

    function profit( $income, $cost, $tax) {
        return floatval($income)." - ".floatval($cost)." - ".floatval($tax);
    }

    function top_products() {
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;

        $this->data['topProducts'] = $this->reports_model->topProducts($store_id);
        $this->data['topProducts1'] = $this->reports_model->topProducts1($store_id);
        $this->data['topProducts3'] = $this->reports_model->topProducts3($store_id);
        $this->data['topProducts12'] = $this->reports_model->topProducts12($store_id);
        $this->data['warehouses'] = $this->site->getAllStores();

        $this->data['page_title'] = $this->lang->line("top_products");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('top_products')));
        $meta = array('page_title' => lang('top_products'), 'bc' => $bc);
        $this->page_construct('reports/top', $this->data, $meta);
    }

    function registers() {

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['users'] = $this->reports_model->getAllStaff();
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('registers_report')));
        $meta = array('page_title' => lang('registers_report'), 'bc' => $bc);
        $this->page_construct('reports/registers', $this->data, $meta);
    }

    function get_register_logs()  {

        $user = $this->input->get('user') ? $this->input->get('user') : NULL;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : NULL;

        $this->load->library('datatables');
        $this->datatables
        ->select("date, closed_at, CONCAT(" . $this->db->dbprefix('users') . ".first_name, ' ', " . $this->db->dbprefix('users') . ".last_name, '<br>', " . $this->db->dbprefix('users') . ".email) as user, cash_in_hand, CONCAT(total_cc_slips, ' (', total_cc_slips_submitted, ')') as cc_slips, CONCAT(total_cheques, ' (', total_cheques_submitted, ')') as total_cheques, CONCAT(total_cash, ' (', total_cash_submitted, ')') as total_cash, note", FALSE)
        ->from("registers")
        ->join('users', 'users.id=registers.user_id', 'left');

        if ($user) {
            $this->datatables->where('registers.user_id', $user);
        }
        if ($start_date) {
            $this->datatables->where('date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
        }

        echo $this->datatables->generate();


    }

    function payments() {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['users'] = $this->reports_model->getAllStaff();
        $this->data['customers'] = $this->reports_model->getAllCustomers();
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('payments_report')));
        $meta = array('page_title' => lang('payments_report'), 'bc' => $bc);
        $this->page_construct('reports/payments', $this->data, $meta);
    }

    function get_payments() {
        $user = $this->input->get('user') ? $this->input->get('user') : NULL;
        $ref = $this->input->get('payment_ref') ? $this->input->get('payment_ref') : NULL;
        $sale_id = $this->input->get('sale_no') ? $this->input->get('sale_no') : NULL;
        $customer = $this->input->get('customer') ? $this->input->get('customer') : NULL;
        $paid_by = $this->input->get('paid_by') ? $this->input->get('paid_by') : NULL;
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : NULL;

        $this->load->library('datatables');
        $this->datatables
        ->select($this->db->dbprefix('payments') . ".date, " . $this->db->dbprefix('payments') . ".reference as ref, " . $this->db->dbprefix('sales') . ".id as sale_no, paid_by, amount")
        ->from('payments')
        ->join('sales', 'payments.sale_id=sales.id', 'left')
        ->group_by('payments.id');

        if ($user) {
            $this->datatables->where('payments.created_by', $user);
        }
        if ($ref) {
            $this->datatables->where('payments.reference', $ref);
        }
        if ($paid_by) {
            $this->datatables->where('payments.paid_by', $paid_by);
        }
        if ($sale_id) {
            $this->datatables->where('sales.id', $sale_id);
        }
        if ($customer) {
            $this->datatables->where('sales.customer_id', $customer);
        }
        if ($customer) {
            $this->datatables->where('sales.customer_id', $customer);
        }
        if ($start_date) {
            $this->datatables->where($this->db->dbprefix('payments').'.date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
        }

        echo $this->datatables->generate();

    }

    function alerts() {
        $data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('stock_alert');
        $bc = array(array('link' => '#', 'page' => lang('stock_alert')));
        $meta = array('page_title' => lang('stock_alert'), 'bc' => $bc);
        $this->page_construct('reports/alerts', $this->data, $meta);

    }

    public function get_alerts() {

        $this->load->library('datatables');
        $this->datatables->select($this->db->dbprefix('products').".id as pid, ".$this->db->dbprefix('products').".image as image, ".$this->db->dbprefix('products').".code as code, ".$this->db->dbprefix('products').".name as pname, type, ".$this->db->dbprefix('categories').".name as cname, quantity, alert_quantity, tax, tax_method, cost, price", FALSE)
        ->join('categories', 'categories.id=products.category_id')
        ->from('products')
        ->where('quantity < alert_quantity', NULL, FALSE)
        ->group_by('products.id');
        /*<a href='#' class='btn btn-xs btn-primary ap tip' data-id='$1' title='".lang('add_to_purcahse_order')."'><i class='fa fa-plus'></i></a>*/
        $this->datatables->add_column("Actions", "<div class='text-center'>
            </div>", "pid");
        $this->datatables->unset_column('pid');
        echo $this->datatables->generate();

    }

    public function todayhighlight(){
        if((!$this->Admin) && (!$this->Manager)) {            
            $this->session->set_flashdata('error', lang('access_denied'));            
            redirect('pos');            
            } 
            $this->data['warehouses'] = $this->site->getAllStores();
            if(!$this->Admin){
                $store_id =$this->session->userdata('store_id');
            }else{
                $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;
            }
           
            // $date ='';
            $date = $this->input->post('date');
             if ($date !='') { 
                $today = $this->input->post('date');               
            } else {
                 $today= date('Y-m-d');                
            }

          $this->data['today'] =$today;           
          $this->data['salesAmount'] = $this->sales_model->salesAmount('total',NULL,$today,$store_id);
          $this->data['collectAmount'] = $this->sales_model->collectAmountByCustomer('payment_amount',NULL,$today,$store_id);
          $this->data['deuAmount'] = $this->sales_model->salesDeuByCustomer(NULL,$today,$store_id);
		  $this->data['totaleceived'] = $this->data['salesAmount']-$this->data['deuAmount'];

          $this->data['purchAmount'] = $this->purchases_model->purchasesAmount('total',NULL,$today,$store_id);
          $this->data['purchDue'] = $this->purchases_model->purchasesAmount('deu',NULL,$today,$store_id);
          $this->data['paymentAmount'] = $this->purchases_model->purcAmountByCustomer('payment_amount',$today,$store_id);

          $this->data['expensAmount'] = $this->purchases_model->expenAmountByCustomer('amount',$today,$store_id);

       $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));        
       $this->data['page_title'] = 'Today\'s Highlights';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Today\'s Highlights'
            )
        );        
        $meta = array(
            'page_title' => 'Today\'s Highlights',
            'bc' => $bc
        );    
        $this->page_construct('reports/todayhighlight', $this->data, $meta);       

    }

    public function pettycash(){          
        $amount = '';
        $amount = $this->input->post('amount');
        if($amount !=''){
            $amount = $this->input->post('amount');
            $note = $this->input->post('note');
            $data = array(
                'entry_date' => date('Y-m-d H:i'),
                'amount'  => $amount,
                'note' => $note
                ); 
            $insPettyCash = $this->sales_model->inspattycash($data);
            $this->session->set_flashdata('message', lang('Patty cash saved successfully'));
            redirect('reports/pettycash'); 

            }
            $this->data['warehouses'] = $this->site->getAllStores();
            $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;
            $cashSale = $this->sales_model->salesPaidAmount(NULL,NULL,$store_id);

            $advPayment = $this->purchases_model->advPayAmount('adv_amount',NULL,NULL,$store_id); 

            $this->data['advCollect'] = $this->sales_model->advCollecAmount('adv_collection');       

            $this->data['cashSales'] = $cashSale + $this->data['advCollect'];

            $this->data['salesreturn'] = $this->reports_model->salesReturnAmount($store_id);

            $this->data['pendinBankAmount'] = $this->bank_model->pendinBankAmount();

            //$cashpayment = $this->purchases_model->purchasesPaidAmount(); //This is old Petty cash query from purchases SUM(paid) 

            $cashpayment = $this->purchases_model->purchasesPaidAmountPay($store_id); //This is new Petty cash query from purchase_payments SUM(amount)  

            $this->data['cashPurchase'] = $advPayment + $cashpayment;

            $this->data['pettyTobank'] = $this->bank_model->tPettyTobankAmount($store_id);

            $this->data['bankTopetty'] = $this->bank_model->banktopettyAmount($store_id);
         
            $this->data['expensAmount'] = $this->purchases_model->expenTotal(NULL,$store_id);

            $this->data['donations'] = $this->reports_model->donations()->amount;

            if($store_id){
                $cashInHand = $this->reports_model->cashInHand($store_id)[0]->cash_in_hand;
            }else {
                if($this->Admin){
                    $cashInHand = $this->reports_model->cashInHand()[0]->cash_in_hand;
                }else{
                   $cashInHand = $this->session->userdata('cash_in_hand');  
                }
               
            }
            $this->data['cashInHand'] = $cashInHand;

            $this->data['pettyCash'] = $this->data['cashSales'] - ($this->data['pettyTobank']-$this->data['bankTopetty'])- ($this->data['cashPurchase'] + $this->data['expensAmount'] + $this->data['donations'])+$cashInHand;

            $this->data['bankCash'] = $this->bank_model->totalBankCash($store_id);
            
            $this->data['loanRecieveAmount'] = $this->reports_model->loanRecieve();
            $this->data['loanPayAmount'] = $this->reports_model->loanPay();
            $this->data['bankloanRecieveAmount'] = $this->reports_model->bankLoanRecieve();
            $this->data['bankloanPayAmount'] = $this->reports_model->bankLoanPay();
             
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));        
        $this->data['page_title'] = 'Petty Cash';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Petty Cash'
            )
        );        
        $meta = array(
            'page_title' => 'Petty Cash',
            'bc' => $bc
        );    
        $this->page_construct('reports/pettycash', $this->data, $meta);       

    } 

    public function pettycashview() {

        if (!$this->Admin) {            
                $this->session->set_flashdata('error', lang('access_denied'));            
                redirect('pos');            
            }
         
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date')." 00:00:00": NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') ." 23:59:59": NULL;
         
        $this->load->library('datatables');
        
        $this->datatables->select($this->db->dbprefix('pettycash') . ".pettycash_id as id,entry_date,amount,note", FALSE);        
        
        $this->datatables->from('pettycash');
        
        $this->datatables->group_by('pettycash_id');  
        if($start_date) { $this->datatables->where('entry_date >=', $start_date); }
        if($end_date) { $this->datatables->where('entry_date <=', $end_date); }       
          
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
                
         <a href='" . site_url('reports/pattycashdelete/$1') . "' onClick=\"return confirm('". lang('You are going to delete collection, please click ok to delete') ."')\" title='".lang("delete_collection")."' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id");      
        $this->datatables->unset_column('id');        
        echo $this->datatables->generate();  
    }

    public function pettycashlist(){
       if (!$this->Admin) {            
        $this->session->set_flashdata('error', lang('access_denied'));            
        redirect('pos');            
        } 
       $this->data['page_title'] = 'Petty Cash';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Petty Cash'
            )
        );        
        $meta = array(
            'page_title' => 'Petty Cash',
            'bc' => $bc
        );    
        $this->page_construct('reports/pettycashlist', $this->data, $meta); 
    }

    public function pattycashdelete($id){

        $this->sales_model->pattycashdelete($id);

        redirect('reports/pettycashlist');

    }

    public function netprofit(){
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
          if((!$this->Admin) && (!$this->Manager)) {            
            $this->session->set_flashdata('error', lang('access_denied'));            
            redirect('pos');            
            }  
        $this->data['warehouses'] = $this->site->getAllStores();
        $store_id = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;
        $stdate=$endate='';
        $this->data['betwDateSale'] = 0;
        $this->data['betwDateExpans'] = 0;
        $this->data['bwtwDateNetProfit'] = 0;
        if($this->input->post('start_date') !='') {
             $stdate = $this->input->post('start_date')." 00:00:00" ;

              if($this->input->post('end_date') ==''){
                $endate = "";
                $stdate = $this->input->post('start_date');
              } else{
                $endate = $this->input->post('end_date')." 23:59:59" ;
              }

            $this->data['betwDateSale'] = $this->sales_model->salesProfitByDate($stdate,$endate,$store_id);
            $this->data['betwDateExpans'] = $this->purchases_model->expenAmoByBetwDate($stdate,$endate,$store_id);

            $this->data['bwtwDateNetProfit'] = $this->data['betwDateSale'] - $this->data['betwDateExpans'];

        }  
        $this->data['stdate'] = $stdate;

        $this->data['endate'] = $endate;
          $today = date('Y-m-d'); 
           
          $this->data['today'] = $today;
           
          $this->data['dailySalesProfitAmount'] = $this->sales_model->salesProfitAmount(NULL,$today);
          $this->data['totalSalesProfitAmount'] = $this->sales_model->salesProfitAmount(NULL,NULL);

          $this->data['dailyExpensAmount'] = $this->purchases_model->expenAmountByCustomer('amount',$today);
          $this->data['totalExpensAmount'] = $this->purchases_model->expenAmountByCustomer('amount',NULL);

          $this->data['dailyNetProfit'] = $this->data['dailySalesProfitAmount'] - $this->data['dailyExpensAmount'];

          $this->data['totalNetProfit'] = $this->data['totalSalesProfitAmount'] - $this->data['totalExpensAmount'];

       $this->data['page_title'] = 'Net Profit';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Net Profit'
            )
        );        
        $meta = array(
            'page_title' => 'Net Profit',
            'bc' => $bc
        );    
        $this->page_construct('reports/netprofit', $this->data, $meta);         

    }

    public function product_stock() { 
    if(!$this->Admin) {        
        $this->session->set_flashdata('error', lang('access_denied'));            
        redirect('pos');            
        }     
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

        $this->data['products'] = $this->reports_model->getAllProducts();
        $this->data['quantity'] = $this->reports_model->getAllquantity();        
        $costs = $this->reports_model->getAllcost();
        $cost = 0;
        foreach($costs as $costs_value){
            if($costs_value->quantity >0 ){
                $cost += $costs_value->cost * $costs_value->quantity ;
            }
         }
        $this->data['cost'] = $cost;
        
        $this->data['page_title'] = $this->lang->line("Products_stock");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('Products_stock')));
        $meta = array('page_title' => lang('Products_stock'), 'bc' => $bc);
        $this->page_construct('reports/products_stock', $this->data, $meta);
    }

    public function store_product_stock(){        
        if((!$this->Admin) && (!$this->Manager)) {        
        $this->session->set_flashdata('error', lang('access_denied'));            
        redirect('pos');            
        }
        if(!$this->Admin){
            $warehouse = $this->session->userdata('store_id');
        } else {
            $warehouse = $this->input->post('warehouse') ? $this->input->post('warehouse') : NULL;       
        }
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['products'] = $this->reports_model->getAllProducts();
        $this->data['quantity'] = $this->reports_model->getAllquantityByStore($warehouse);
        $this->data['warehouses'] = $this->site->getAllStores();
        $costs = $this->reports_model->getAllcost();
        $cost = 0;
        foreach($costs as $costs_value){
            if($costs_value->quantity >0 ){
              $cost += $costs_value->cost * $costs_value->quantity ;
            }
         }
        $this->data['cost'] = $cost;
        
        $this->data['page_title'] = $this->lang->line("Products_stock");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('Products_stock')));
        $meta = array('page_title' => lang('Products_stock'), 'bc' => $bc);
        $this->page_construct('reports/products_stock_store', $this->data, $meta);

    }

    public function get_store_product_stock() {
        $warehouse = $this->input->get('warehouse') ? $this->input->get('warehouse') : NULL;

        $this->load->library('datatables');
        $this->datatables->select($this->db->dbprefix('product_store_qty').".id as pid,
          ".$this->db->dbprefix('products').".name as pname ,
          ".$this->db->dbprefix('products').".code as code ,
          ".$this->db->dbprefix('stores').".name as sname, 
          ".$this->db->dbprefix('product_store_qty').".quantity as quantity,", FALSE);

        $this->datatables->join('stores', 'stores.id=product_store_qty.store_id');
        $this->datatables->join('products', 'products.id=product_store_qty.product_id');

        $this->datatables->from('product_store_qty');

        $this->datatables->group_by('product_store_qty.id');
        $this->datatables->where('products.quantity !=', '0.00');
        if($warehouse) { $this->datatables->where('store_id', $warehouse); }   
        if(!$this->Admin) {
            $this->datatables->where('store_id', $this->session->userdata('store_id'));
           }
        
        $this->datatables->unset_column('pid');  
        echo $this->datatables->generate();
    }

    public function get_excel_products_stock_store($data='') {
        $warehouse = $data ? $data : NULL;
        $this->db->select(
            $this->db->dbprefix('product_store_qty').".id as pid,
            ".$this->db->dbprefix('products').".name as pname ,
            ".$this->db->dbprefix('products').".code as code ,
            ".$this->db->dbprefix('stores').".name as sname, 
            ".$this->db->dbprefix('product_store_qty').".quantity as quantity ");
        $this->db->from('product_store_qty');
        $this->db->join('stores', 'stores.id=product_store_qty.store_id');
        $this->db->join('products', 'products.id=product_store_qty.product_id'); 
        $this->db->group_by('product_store_qty.id');
        $this->db->where('products.quantity !=', '0.00');
        if($warehouse) { $this->db->where('store_id', $warehouse); }   
        if(!$this->Admin) {
            $this->db->where('store_id', $this->session->userdata('store_id'));
           }
        if($this->session->userdata('store_id') !=0){
            $this->db->where('expenses.store_id', $this->session->userdata('store_id'));
        } 
        
        $query = $this->db->get()->result();
        // Excel file name for download 
        $fileName = "products_stock_store_" . date('Y-m-d_h_i_s') . ".xls"; 
        $fields = array('PRODUCT NAME', 'CODE', 'STORE', 'QUANTITY');
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query) > 0){ 
            foreach($query as $row){ 
                $lineData = array($row->pname, $row->code, $row->sname, $row->quantity); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
        echo $excelData;  
    }

    public function receivablelist(){
        if((!$this->Admin) && (!$this->Manager)) {        
        $this->session->set_flashdata('error', lang('access_denied'));            
        redirect('pos');            
        } 
       
        if($this->input->post('customer')) 
        $cID = $this->input->post('customer');
        else
        $cID = NULL; 

        $this->data['recivabl'] = $this->reports_model->recablelist();  
        $customer = $this->reports_model->recablelist($cID); 
        $this->data['tDue'] = $customer[0]['due']; 
        $this->data['cID'] = $this->site->findMergeIdbycp('customer_id',$this->input->post('customer'));
        $this->data['page_title'] = 'Account Receivable';        
        $bc = array( array( 
            'link' => '#',
                'page' => 'Account Receivable'
            )
        );        
        $meta = array(
            'page_title' => 'Account Receivable',
            'bc' => $bc
        );    
        $this->page_construct('reports/ac_receivable', $this->data, $meta,$cID); 
    }

    public function payablelist(){
        if((!$this->Admin) && (!$this->Manager)) {            
        $this->session->set_flashdata('error', lang('access_denied'));            
        redirect('pos');            
        } 
       
        if($this->input->post('customer')) 
        $cID = $this->input->post('customer');
        else
        $cID = NULL; 

        $this->data['payabl'] = $this->reports_model->payablelist(); 
        $this->data['cID'] = $this->site->findMergeIdbycp('supplier_id',$this->input->post('customer'));
        $total_due =0;
        $aPay = $this->purchases_model->acPayable($cID);
        $aPayAd = $this->purchases_model->acPayableAd($cID);
        foreach ($aPayAd as $key => $aPayAdval)  
        foreach ($aPay as $key => $value) {
           $total_due = $total_due + $value->due; 
        }  
        if($total_due !=''){
        $this->data['tDue'] = ($total_due-$aPayAdval->adv_amount);
        } else{
        $this->data['tDue'] = $aPayAdval->adv_amount;
        }          
        $this->data['aPay'] = $this->purchases_model->acPayable();        
        $this->data['page_title'] = 'Account Payable';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Account Payable'
            )
        );        
        $meta = array(
            'page_title' => 'Account Payable',
            'bc' => $bc
        );    
        $this->page_construct('reports/ac_payable', $this->data, $meta); 
    }

    public function invoiceProfit(){ 
        $this->data['page_title'] = 'Invoice Profit';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Invoice Profit'
            )
        );        
        $meta = array(
            'page_title' => 'Invoice Profit',
            'bc' => $bc
        ); 
        $this->data['results'] = $this->reports_model->invoiceProfit();
        $this->page_construct('reports/invoiceFrofit', $this->data, $meta);  
    }
    
    public function excel_invoiceProfit(){ 

        $query_data = $this->reports_model->invoiceProfit();
        $fileName = "invoice_profit_data_" . date('Y-m-d_h_i_s') . ".xls"; 			
		$fields = array('Date', 'Store Name', 'Inv NO', 'Quentity', 'Customer Name', 'Grand Total', 'Cost Price', 'Profit');
		$excelData = implode("\t", array_values($fields)) . "\n"; 
		
		if(count($query_data) > 0){ 
			foreach($query_data as $key => $result){ 
                $storeName = $this->site->getDataByElement('stores','id',$result['store_id']);
				$lineData = array($result['date'], $storeName[0]->name, $result['id'], $result['qty'], $result['customer_name'], $result['total'], $result['cost_price'], $result['total']-$result['cost_price']); 
				$excelData .= implode("\t", array_values($lineData)) . "\n"; 
			} 
		}else{ 
			$excelData .= 'No records found...'. "\n"; 
		} 
			
		// Headers for download 
		header("Content-Type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=\"$fileName\""); 
			
		// Render excel data 
		echo $excelData;  
    }

    public function salaryReport(){
        $sd = $this->input->post('start_date');
        $ed = $this->input->post('end_date');       
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Salary Report'
            )
        );        
        $meta = array(
            'page_title' => 'Salary Report',
            'bc' => $bc
        ); 
        $this->data['results'] = $this->reports_model->salaryReport($sd,$ed); 
        $this->page_construct('reports/salaryReport', $this->data, $meta);  
    }

    public function excel_salaryReport($data){
        $data_arr=explode("_",$data);

        $sd = $data_arr[0];
        $ed = $data_arr[1];
        $query_data = $this->reports_model->salaryReport($sd,$ed); 
        $fileName = "salary_report_" . date('Y-m-d_h_i_s') . ".xls"; 			
		$fields = array('Date and Time', 'Store Name', 'Month & Year', 'Amount', 'Employee Name', 'Note');
		$excelData = implode("\t", array_values($fields)) . "\n"; 
		
		if(count($query_data) > 0){ 
			foreach($query_data as $key => $result){ 
                $storeName = $this->site->getDataByElement('stores','id',$result->store_id);
                $mont_id=$result->month_id;
                if($mont_id == '01'){ $output = 'January'; }
                elseif($mont_id == '02'){ $output = 'February'; }
                elseif($mont_id == '03'){ $output = 'March';}
                elseif($mont_id == '04'){ $output = 'April';}
                elseif($mont_id == '05'){ $output = 'May';  }
                elseif($mont_id == '06'){ $output = 'June'; }
                elseif($mont_id == '07'){ $output = 'July'; }
                elseif($mont_id == '08'){ $output = 'August';}
                elseif($mont_id == '09'){ $output = 'September';}
                elseif($mont_id == '10'){ $output = 'October';  }
                elseif($mont_id == '11'){ $output = 'November'; }
                elseif($mont_id == '12'){ $output = 'December'; }
                else{$output='';}
                $m_y=$output.' , '.$result->year;
				$lineData = array($this->tec->hrld($result->pay_date), $storeName[0]->name , $m_y, $result->amount, $result->name, $result->note); 
				$excelData .= implode("\t", array_values($lineData)) . "\n"; 
			} 
		}else{ 
			$excelData .= 'No records found...'. "\n"; 
		} 
			
		// Headers for download 
		header("Content-Type: application/vnd.ms-excel"); 
		header("Content-Disposition: attachment; filename=\"$fileName\""); 
			
		// Render excel data 
		echo $excelData; 
    }

    public function sequenceReport(){ 
        $this->data['page_title'] = 'Product Sequence';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Product Sequence'
            )
        );        
        $meta = array(
            'page_title' => 'Product Sequence',
            'bc' => $bc
        );  
        $this->page_construct('reports/sequenceReport', $this->data, $meta);  
    }

    public function get_sequence(){
         $this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('pro_sequence').".sequence_id as seid,
          ".$this->db->dbprefix('pro_sequence').".entry_date,
          ".$this->db->dbprefix('products').".name as productname ,
          ".$this->db->dbprefix('products').".code as productcode ,
          ".$this->db->dbprefix('stores').".name as storename, 
          ".$this->db->dbprefix('pro_sequence').".sequence,  
          ".$this->db->dbprefix('pro_sequence').".sales_id,           
          ".$this->db->dbprefix('pro_sequence').".purchases_id as purchases_id", FALSE);

         $this->datatables->join('stores', 'stores.id=pro_sequence.store_id');
         $this->datatables->join('products', 'products.id=pro_sequence.pro_id');

         $this->datatables->from('pro_sequence');

         $this->datatables->group_by('pro_sequence.sequence_id');
        
         $this->datatables->unset_column('seid');
        
         echo $this->datatables->generate();
    }

    public function warrentyReport(){ 
        $this->data['page_title'] = 'Warranty';        
        $bc = array(
            array(
                'link' => '#',
                'page' => 'Warranty'
            )
        );       
        $meta = array(
            'page_title' => 'Sales And Purchases Warranty',
            'bc' => $bc
        ); 
        $this->data['warranty'] = $this->reports_model->warrantyReport();  
        $this->page_construct('reports/warrenty_reports', $this->data, $meta);  
    }

    public function get_warrenty(){
         $this->load->library('datatables');
         $this->datatables->select($this->db->dbprefix('pro_sequence').".sequence_id as seid,
          ".$this->db->dbprefix('pro_sequence').".entry_date,
          ".$this->db->dbprefix('purchase_items').".expiry_year as expiry_year ,
          ".$this->db->dbprefix('sale_items').".warranty_year as warranty_year ,
          ".$this->db->dbprefix('products').".code as productcode ,
          ".$this->db->dbprefix('stores').".name as storename, 
          ".$this->db->dbprefix('pro_sequence').".sequence, 
          ".$this->db->dbprefix('pro_sequence').".purchases_id as purchases_id, 
          ".$this->db->dbprefix('pro_sequence').".sales_id,           
          ".$this->db->dbprefix('pro_sequence').".status", FALSE);
         $this->datatables->join('stores', 'stores.id=pro_sequence.store_id');
         $this->datatables->join('purchase_items', 'purchase_items.purchase_id=pro_sequence.purchases_id');
         $this->datatables->join('sale_items', 'sale_items.sale_id=pro_sequence.sales_id');
         $this->datatables->join('products', 'products.id=pro_sequence.pro_id');
         $this->datatables->from('pro_sequence');
         $this->datatables->group_by('pro_sequence.sequence_id');        
         $this->datatables->unset_column('seid');        
         echo $this->datatables->generate();
    }
}
