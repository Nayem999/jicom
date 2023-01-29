 
<style type="text/css"> 
     .td-center{
        text-align: center;
    }
    </style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>

                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button>


                </div>
                <div class="box-body"> 
                 <div id="form" class="panel panel-warning">

                    <div class="panel-body">                       

                        <?= form_open("");?> 

                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="bank_id"><?= lang("Bank Name"); ?></label>
                                <?php 
                            

                                $cu[0] = lang("select")." ".lang("Bank");
                                       foreach ($bank_name as $key => $sname) {
                                            $cu[$sname->bank_account_id] = $sname->bank_name .'( '.$sname->account_no .' )';
                                       } 
                                echo form_dropdown('bank_id', $cu, set_value('bank_id'), 'class="form-control select2" style="width:100%" id="bank_id"');  
                                ?>
                            </div>
                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>

                </div>  
                <div class="table-responsive">
                <div class="clearfix"></div>          
                  <div class="col-xs-6">
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                        

                          </tr>                        
                        </tbody>
                      </table>
                     </div>
                    </div> 

                    <div class="table-responsive" id="page_content"> 
                        <table class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                            <tr class="active">
                                
                                <th class="col-xs-2">Date</th>

                                <th class="col-xs-2">Bank name</th>

                                <th class="col-xs-3">Dr.</th>

                                <th class="col-xs-2">Cr.</th>

                                <th class="col-xs-2">Balance </th>
                            </tr>

                            </thead>

                            <tbody>

                            <?php   
                            $total_balance=array(); $chkArr=array();
                                     foreach($bank_data as $key => $val)
                                     {
                                        
                                        ?>
                                            <tr>
                                                <td><?=$val->create_date;?></td>
                                                <td><?=$val->bank_name;?></td>
                                                <td>
                                                    <?php
                                                        if($val->payment_type==1)
                                                        {
                                                            echo $val->amount;
                                                        }

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($val->payment_type==2)
                                                        {
                                                            echo $val->amount;
                                                        }

                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($val->payment_type==1)
                                                        {
                                                            if (array_key_exists($val->bank_id, $chkArr)) {
                                                                $total_balance[$val->bank_id] += $val->amount;
                                                            }
                                                            else{
                                                                $chkArr[]=$val->bank_id;
                                                                $total_balance[$val->bank_id] = $val->amount;
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if (array_key_exists($val->bank_id, $chkArr)) {
                                                                $total_balance[$val->bank_id] -= $val->amount;
                                                            }
                                                            else{
                                                                $chkArr[]=$val->bank_id;
                                                                $total_balance[$val->bank_id] = -$val->amount;
                                                            }
                                                        }
                                                        echo  $total_balance[$val->bank_id] ;
                                                    ?>

                                                        
                                                </td>
                                            </tr>
                                        <?php
                                     }                     
                                  ?>
                            </tbody>

                        </table>

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

        $('.datepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });
 $("#daily_sales").click(function () {        
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none");
     var content = "<html> <br><p style='text-align:center'> <b class='box-title'>Account Payable list | <?= $this->Settings->site_name ?></b><br><b class='box-title'><p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
     content += document.getElementById("page_content").innerHTML;
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
  $("#excelWindow").click(function() {
        var data = $("#bank_id").val() ;
        var url = '<?= site_url('reports/excel_bank_balance/'); ?>' + '/' + data;
        location.replace(url);
    });
</script>