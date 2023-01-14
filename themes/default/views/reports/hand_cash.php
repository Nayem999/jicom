<script>
    $(document).ready(function() {  
      function status(n) {
            if(n !== null) {
              if(n == 1) {
                return '<samp class="label label-success" >Active</samp>';
              }else{  
        return '<samp class="label label-danger">Inactive</samp>';  
        }
            }
            return '';
        }
        $('#catData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 1, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('reports/get_hand_cash') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
      "aoColumns": [ null, null, null, {"bSortable":false, "bSearchable": false},]      

        });

    });

</script>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">  
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button> 
                </div>
                <div class="box-body">
                    <div class="table-responsive col-lg-6" id="print_content">
                        <table id="catData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
                            <thead>
                            <tr class="active">
                                <th>Date</th>  
                                <th>Amount </th> 
                                <th>Note </th> 
                                <th style="width:60px;"><?= lang('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    <div class="col-lg-6">
                    <?php if(isset($info)){ ?>
                        <?= form_open_multipart("",'class="validation fv-form fv-form-bootstrap"'); ?>  
                        <div class="form-group">
                            <?= lang('Date', 'entry_date'); ?><span class="required-star">*</span>
                            <?= form_input('entry_date', set_value('entry_date',$info->entry_date), 'class="form-control tip datepicker" id="entry_date" required="required"'); ?>
                        </div> 
                        <div class="form-group">
                            <?= lang('Hand Cash', 'amount'); ?><span class="required-star">*</span>
                            <?= form_input('amount', set_value('amount',$info->amount), 'class="form-control tip" id="amount" required="required"'); ?>
                        </div>  
                        <div class="form-group">
                            <?= lang('Note', 'note'); ?><span class="required-star">*</span>
                            <?= form_input('note', set_value('note',$info->note), 'class="form-control tip" id="note"'); ?>
                        </div>   
                        <div class="form-group">
                            <?= form_submit('add_user', lang('Update Now'), 'class="btn btn-primary"'); ?>
                        </div>
                        <?= form_close(); ?>

                       <?php }else{ ?>

                        <?= form_open_multipart("",'class="validation fv-form fv-form-bootstrap"'); ?> 
                        <div class="form-group">
                            <?= lang('Date', 'entry_date'); ?><span class="required-star">*</span>
                            <?= form_input('entry_date', set_value('entry_date'), 'class="form-control tip datepicker" id="entry_date" required="required"'); ?>
                        </div> 
                        <div class="form-group">
                            <?= lang('Hand Cash', 'amount'); ?><span class="required-star">*</span>
                            <?= form_input('amount', set_value('amount'), 'class="form-control tip" id="amount" required="required"'); ?>
                        </div> 
                        <div class="form-group">
                            <?= lang('Note', 'note'); ?> 
                            <?= form_input('note', set_value('note'), 'class="form-control tip" id="note"'); ?>
                        </div> 
                        <div class="form-group">
                            <?= form_submit('add_user', lang('Add Now'), 'class="btn btn-primary"'); ?>
                        </div>
                        <?= form_close(); ?>
                    <?php } ?>
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
</script>
<script>
    $("#printWindow").click(function () {   
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");

    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Hand Cash  | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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