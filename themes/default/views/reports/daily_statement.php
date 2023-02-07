<?php
$v = "?v=1";
if(isset($_POST['start_date'])){
  $v .= "&start_date=".$this->input->post('start_date');
  $start_date = $this->input->post('start_date');
}  
// $previousBanance=$handcash->amount;
?>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">          
                <div class="box-body"> 
                  <div class="panel-body">
                  <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button>
                    <button type="button" style="width:120px; float:right; display:none;" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button> 
                    <?= form_open("");?>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= lang('Store', 'Store'); ?>
                                <?php
                                $wr[0] = lang("select") . " " . lang("Store");
                                foreach ($stores as $store) {
                                    $wr[$store->id] = $store->name;
                                }
                                ?>
                                <?= form_dropdown('store_id', $wr, set_value('store_id'), 'class="form-control select2 tip" id="store_id" required="required" style="width:100%;"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>
                                <?= form_input('start_date', set_value('start_date'), 'class="form-control datepicker" id="start_date"');?>
                            </div>
                        </div>   
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>
                                <?= form_input('end_date', set_value('end_date'), 'class="form-control datepicker" id="end_date"');?>
                            </div>
                          <!-- <h3 class="box-title">Date : <?= $date_range ? $date_range : 'Today\'s'; ?></h3> -->
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                            <!-- <a href="<?= base_url('reports/daily_statement_csv/'.$v) ?>" class="btn btn-primary pull-right"><?= lang("Download CSV"); ?></a> -->
                        </div> 
                    </div>
                    <?= form_close();?>
                  </div>   
                  <div class="table-responsive" id="print_content">  
                    <div class="col-xs-12"> 
                        <table class="table table-bordered">
                            <tbody> 
                             <tr>
                               <td> Date</td>
                               <td> Customer</td>  
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
                              $previousBanance =0;
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
                                    <!-- <td><?// $result->name.' '.$result->c_id ;?></td> -->
                                    <td><?= $result->name;?></td>
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
                               <td><?
                               
                               if(is_bool($handcash)){
                                $previousBanance =0; 
                                echo $previousBanance;
                              }
                              else
                              {
                                foreach($handcash as $val){
                                  $previousBanance += $val['amount']; 
                                }

                                echo $previousBanance;
                              }
                               ?> </td> 
                               <td> </td>                               
                               <td style="border:none;"></td>
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
                    </div>  
                    <div class="clearfix"></div>
                  </div> 
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
<script>
    $("#printWindow").click(function () {   
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");

    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Daily Statement | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
     content += document.getElementById("print_content").innerHTML;
     content += "</body>";
     content += "</html>";
     var printWin = window.open('','','left=20,top=40,width=700,height=550 '); 
     printWin.document.write(content);     
     printWin.focus();
     printWin.print();
     printWin.close(); 
     $(".dataTables_info").css("display", "block"); 
     $(".dataTables_length, .dataTables_filter ").css("display", "block");
     $(".dataTables_paginate ").css("display", "block");
     $("#fileData_filter ").css("display", "block");  
   }); 
   $("#excelWindow").click(function () {  
        var data=$("#start_date").val()+'_'+$("#end_date").val() + '_' + $("#store_id").val();   
        var url='<?=site_url('reports/excel_daily_statement/');?>'+'/'+data;
        location.replace(url);

    }); 
</script> 