
<script>

    $(document).ready(function () {

        $('#CuData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('bank/get_pending_salary') ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [{"mRender":hrld},null,null, null, null,null, null,null,null, {"bSortable":false, "bSearchable": false}]

        });

    });

</script>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="daily_sales">Print report</button>

                </div>

                <div class="box-body">

                    <div class="table-responsive" id="page_content">

                    <table id="CuData" class="table table-bordered table-hover table-striped">

                        <thead>

                        <tr>

                            <th><?php echo 'Date & Time' ; ?></th>                            
                            <th><?php echo 'Name'; ?></th>
                            <th><?php echo 'Payment by'; ?></th> 
                            <th><?php echo 'Bank Name'; ?></th>                            
                            <th><?php echo 'Account Name'; ?></th>                            
                            <th><?php echo 'Cheque No'; ?></th> 
                            <th><?php echo 'Type'; ?></th>                           
                            <th><?php echo 'Amount' ?></th>
                            <th><?php echo 'Status'; ?></th>
 
                            <th style="width:100px;"><?php echo $this->lang->line("actions"); ?></th>

                        </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td colspan="6" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>

                            </tr>

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
     var content = "<html> <br><p style='text-align:center'> <b class='box-title'>Bank pending donations amount list |  <?php echo $this->Settings->site_name; ?></b><br><b class='box-title'><p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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