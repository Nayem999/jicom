<script>
     function attach(x) {
            if(x){
                return '<div style="width:80px; margin: 0 auto;"><a href="<?=base_url();?>uploads/attachment/'+x+'" class="open-image"><img src="<?=base_url();?>uploads/attachment/'+x+'" alt="" class="img-responsive"></a></div>'; 
            } else{
                return '';
            }
        }
    $(document).ready(function () {        
        $('#spData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('attachment/get_docs_log_list') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [null, null, null, null, {"mRender":attach,"bSortable":false}, null, null]
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
                    <div class="table-responsive" id="print_content">
                    <table id="spData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th><?= 'Title'; ?></th>
                            <th><?= 'Created date'; ?></th>
                            <th><?= 'Created By'; ?></th>
                            <th><?= 'Persons name'; ?></th>
                            <th><?= 'Attachment' ?></th> 
                            <th><?= 'Type' ?></th> 
                            <th><?= 'Note' ?></th>  
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
    $("#printWindow").click(function () {   
    $(".dataTables_info").css("display", "none");
    $(".img-responsive").attr("width", "80");  
    $(".dataTables_length, .dataTables_filter ").css("display", "none");

    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Attachment log List | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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
