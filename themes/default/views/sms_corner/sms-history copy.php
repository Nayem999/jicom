<?php
$cid ='';
 ?>
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
                    <h3 class="box-title"><?= lang('sms_history'); ?></h3>
                    <!-- <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="daily_sales">Print report</button> -->
                    <?php
                    //  if($this->session->userdata('group_id') == 2){

                    //     $u_id = $this->session->userdata('user_id') ;
                    //     }else{
                    //         $u_id = NULL;
                    //      }; 
                         ?>

                </div>
                <div class="box-body" > 
                 <div id="form" class="panel panel-warning">

                    <div class="panel-body">                       

                        

                    </div>

                </div>  
                <div class="table-responsive" >
                <div class="clearfix"></div>          
                  <div class="col-xs-6">
                  <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
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
                                
                                <th class="col-xs-2">date</th>

                                <th class="col-xs-2">Name</th>

                                <th class="col-xs-2">Type</th>

                                <th class="col-xs-3">Phone No</th>

                                <th class="col-xs-2">Message</th>

                            </tr>

                            </thead>

                            <tbody>
                            <td colspan="5" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
                            <?php  
                                 foreach ($sms_history as  $history) {
                                   ?>
                                <tr>
                                    <td class="td-center"><?= $history->created_at ?></td>
                                    <td class="td-center"><?= $history->name ?></td>
                                    <td class="td-center"><?= $history->user_type == 1 ? 'Customer' : 'Supplier' ?></td>
                                    <td class="td-center"><?= $history->phone_no  ?></td>
                                    <td class="td-center"><?= $history->message ?></td>
                                  
                                </tr>
                                <?php  } ?>
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
     var content = "<html> <br><p style='text-align:center'> <b class='box-title'>Account Receivable List | <?= $this->Settings->site_name ?> </b><br><b class='box-title'><p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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

 

</script>