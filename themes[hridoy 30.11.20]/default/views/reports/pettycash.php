<?php

$v = "?v=1";

    if($this->input->post('product')){

        $v .= "&product=".$this->input->post('product');
 
    }

    if($this->input->post('warehouse')){

        $v .= "&warehouse=".$this->input->post('warehouse');

    }

    if($this->input->post('start_date')){

        $v .= "&start_date=".$this->input->post('start_date');

    }

    if($this->input->post('end_date')) {

        $v .= "&end_date=".$this->input->post('end_date');

    }
?>



<script>

    $(document).ready(function() {

        function image(n) {

            if(n !== null) {

                return '<div style="width:32px; margin: 0 auto;"><a href="<?=base_url();?>uploads/'+n+'" class="open-image"><img src="<?=base_url();?>uploads/thumbs/'+n+'" alt="" class="img-responsive"></a></div>';

            }

            return '';

        }

        function method(n) {

            return (n == 0) ? '<span class="label label-primary"><?= lang('inclusive'); ?></span>' : '<span class="label label-warning"><?= lang('exclusive'); ?></span>';

        }

        $('#fileData').dataTable( {

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 1, "asc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('reports/get_products/'. $v) ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [null, null,null, {"bSearchable": false},{"mRender":currencyFormat, "bSearchable": false},{"mRender":currencyFormat, "bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false},]

        });



});



</script>



<script type="text/javascript">

    $(document).ready(function(){

        $('#form').hide();

        $('.toggle_form').click(function(){

            $("#form").slideToggle();

            return false;

        });

    });

</script>



<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header"> 

                    <h3 class="box-title"><?= lang('customize_report'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button> 

                </div>

                <div class="box-body"> 

                  <div class="row">
                      <div class="col-sm-12">
                        <div class="table-responsive" >
                            <div class="col-xs-6" id="print_content"> 
                                <table class="table table-bordered" >
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
                                        <th class="col-xs-3">Total Donations Amount</th>
                                        <th class="col-xs-2"><?php echo $this->tec->formatMoney($donations); ?></th>
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
                                <input type="hidden" name="amount" value="<?= ($pettyCash-$salesreturn[0]->return_amount + $loanActualAmount) ?>">
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

                  <div class="clearfix"></div> 
                    
                </div>

            </div>

        </div>

    </div>

</section>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {

        $('.datetimepicker').datetimepicker({

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
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Petty Cash  | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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
</script> 