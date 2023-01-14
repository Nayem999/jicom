<?php
$cid ='';
 ?>
<style type="text/css">
    .td-center{
        text-align: center;
    }
</style>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/> -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

<script>



    // $('document').ready(function()
// {
    // $.ajax({
    // type : 'get',
    // url  : '',
    // dataType: 'json',
    // cache: false,
    // success :  function(result)
    //     {
    //         //pass data to datatable
    //         console.log(result); // just to see I'm getting the correct data.
    //         $('#purData').DataTable({
    //             "searching": false, //this is disabled because I have a custom search.
    //             "aaData": [result], //here we get the array data from the ajax call.
    //             // "aoColumns": [
    //             //   { "Date": "date" },
    //             //   { "Name": "name" },
    //             //   { "sTitle": "phone_no" }
    //             // ] //this isn't necessary unless you want modify the header
    //               //names without changing it in your html code. 
    //               //I find it useful tho' to setup the headers this way.

    //                columns: [
    //         // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //         {data: 'name', name: 'name'},
    //         {data: 'date', name: 'created_at'},
    //         {data: 'type', name: 'user_type'},
    //         {data: 'phone', name: 'phone_no'},
    //         {data: 'message', name: 'message'},
    //         {data: 'action', name: 'action', orderable: false, searchable: false},
    //     ]
    //         });
    //     }
    // });





// });

$(document).ready(function() {
    $('#purData').DataTable({
        "ajax": {
            url : "<?= site_url('smscorner/sms_history_list/') ?>",
            type : 'GET'
        },
    });
});
</script>

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
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                          
                          </tr>  
                                             
                        </tbody>
                      </table>
                     </div>
                    </div>
                    
                  
                     <div class="table-responsive" id="page_content"> 
                  <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                            <tr class="active">
                                
                                <th class="col-xs-2">Date</th>

                                <th class="col-xs-2">Name</th>

                                <th class="col-xs-2">Type</th>

                                <th class="col-xs-3">Phone No</th>

                                <th class="col-xs-2">Message</th>

                            </tr>

                            </thead>

                            <tbody>
                                  <td colspan="5" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
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