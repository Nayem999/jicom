
<script>

    $(document).ready(function () {

        $('#CuData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('employee/get_employee') ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [null, null, null, null, null,null, {"bSortable":false, "bSearchable": false}]

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

                            <th><?php echo $this->lang->line("name"); ?></th>

                            <th><?php echo $this->lang->line("phone"); ?></th>

                            <th><?php echo $this->lang->line("Store Name"); ?></th>

                            <th><?php echo $this->lang->line("email_address"); ?></th>
 
                            <th><?php echo 'Position' ; ?></th>

                            <th><?php echo 'Basic salary' ; ?></th>

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
<script>

 $("#daily_sales").click(function () {        
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none");
     var content = "<html> <br><p style='text-align:center'> <b class='box-title'>Employee List</b><br><b class='box-title'><p><style>.table{ width: 100%; margin: 0px auto; background: #000; } .table, .table th, .table td{   border: 0px solid #000 !important; } td { background: #fff; text-align:center} th {background: #fff; } </style>";
     content += document.getElementById("page_content").innerHTML;
     content += "</body>";
     content += "</html>";
     var printWin = window.open('','','left=20,top=40,width=700,height=550 '); 
     printWin.document.write(content);     
     printWin.focus();
     printWin.print();
     printWin.close();  
  });

</script>



