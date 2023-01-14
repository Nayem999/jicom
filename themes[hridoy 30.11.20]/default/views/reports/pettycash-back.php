<style type="text/css">
  .col-sm-7 .fa.fa-university {
    font-size: 25px;
    margin: 3px 6px 6px 0;
}
.tip.btn.btn-primary.btn-xs {
    font-size: 20px;
}
</style>
<section class="content">
    <div class="row"> 
      <div class="box box-primary">  
          <div class="box-body">
            <div class="col-sm-12">
            <?php if($this->Admin){ ?>
                <?= form_open("reports/pettycash/"); ?>
                  <div class="col-sm-4">
                  <div class="form-group">
                       <?= lang('Warehouse','Warehouse'); ?>
                      <?php
                      $wr[''] = lang("select")." ".lang("warehouse");
                      foreach($warehouses as $warehouse) {
                          $wr[$warehouse->id] = $warehouse->name;
                      }
                      ?>
                      <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="warehouse" required="required" style="width:100%;"'); ?> 
                  </div>
                  </div> 
                  <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                  </div>
                <?= form_close();?>
            <?php } ?>
            </div>
            <div class="col-sm-12">
              <div class="table-responsive">
                  <div class="col-xs-6"> 
                      <table class="table table-bordered">
                          <tbody>
                          <tr>
                            <th colspan="2" style="text-align:center" >
                            <div class="btn-lg bg-purple btn-block"><h4 class="box-title">Petty cash information</h4></div></th>
                          </tr>
                            <tr>
                              <th class="col-xs-3">Total Cash Collection</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($cashSales); ?></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3">Total Cash in Hand</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($cashInHand); ?></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3">Total Sales Return Amount</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($salesreturn[0]->return_amount);
                               ?></th>
                            </tr>                           
                            <tr>
                              <th class="col-xs-3">Total Cash Payments</th>                                     
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($cashPurchase); ?></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3">Total Expense Amount</th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($expensAmount); ?></th>
                            </tr> 
                             <tr>
                              <th class="col-xs-3">Loan Receive Amount</th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($loanRecieveAmount); ?></th>
                            </tr> 
                             <tr>
                              <th class="col-xs-3">Loan Pay Amount</th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($loanPayAmount);
                               ?></th>
                               <?php $loanActualAmount = $loanRecieveAmount -  $loanPayAmount; ?>
                            </tr> 
                            <tr>
                              <th class="col-xs-3">Total Petty Cash</th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($pettyCash-$salesreturn[0]->return_amount + $loanActualAmount ); ?></th>
                            </tr> 
                            <tr>
                              <th class="col-xs-3">Total Bank Cash </th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($bankCash); ?></th>
                            </tr>


                            <tr>
                              <th class="col-xs-3">Loan Receive in Bank</th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($bankloanRecieveAmount); ?></th>
                            </tr> 
                            <tr>
                              <th class="col-xs-3">Loan Pay From Bank </th>                                    
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($bankloanPayAmount); ?></th>
                            </tr>


                            <tr>
                              <th class="col-xs-3">Total Petty Cash To Bank Amount </th> 
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($pettyTobank); ?></th>
                            </tr>
                             <tr>
                              <th class="col-xs-3">Total Bank To Petty Cash Amount </th> 
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($bankTopetty); ?></th>
                            </tr>                        
                            
                          </tbody>
                      </table>

                  </div>
                  <div class="col-sm-6">

                      <div class="table-responsive" id="page_content">

                      <?php echo form_open_multipart("reports/pettycash", 'class="validation"'); ?>
                      <div class="form-group">
                          <?= lang("note", 'note'); ?>

                          <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>

                      </div>

                      <input type="hidden" name="amount" value="<?= $pettyCash ?>">

                      <div class="form-group">
                          <?= form_submit('pettycash', lang('Save Petty Cash'), 'class="btn btn-primary"'); ?>
                      </div>

                      <?php echo form_close();?>

                      </div>

                      </div>
                  <div class="clearfix"></div>
              </div> 
              <div class="row">
                <div class="col-sm-7">
                  <a href='javascript:;' onClick='bankTransferf()' title='Bank' class='tip btn btn-primary btn-xs'> <i class='fa fa-university'></i>Petty cash to bank  Transfer</a>
                 
                  <a href="<?php echo base_url('bank/pettyTranReport') ?>" title='Bank' class='tip btn btn-primary btn-xs'> <i class='fa fa-university'></i>Transaction/Reports</a>
                  <br><br>
                </div>

                 <div class="col-sm-7">
                  <a href='javascript:;' onClick='pettyTransferf()' title='Bank' class='tip btn btn-primary btn-xs'> <i class='fa fa-university'></i>Bank to Petty cash Transfer</a>
                 
                  <a href='<?php echo base_url('bank/bankTranReport') ?>' title='Bank' class='tip btn btn-primary btn-xs'> <i class='fa fa-university'></i>Transaction/Reports</a>
                </div>
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

 $("#daily_sales").click(function () {
	 
	$(".text-center a ").css("display", "none");
	
	 var content = "<html> <br> <h2 style='text-align:center'>Sales Report <br></h2>";
	 content += document.getElementById("page_content").innerHTML ;
     content += "</body>";
     content += "</html>";
	 var printWin = window.open('','','left=20,top=40,width=600,height=500,toolbar=0,scrollbars=0,status =0');
	 printWin.document.write('<link rel="stylesheet" href="http://localhost/spos-new/themes/default/assets/bootstrap/css/bootstrap.min.css" type="text/css" />');

     printWin.document.write(content);
     
	 printWin.focus();
     printWin.print();
	 printWin.close();
   
    // window.print();            
            
  });

</script>

