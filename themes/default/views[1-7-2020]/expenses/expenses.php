<?php
 $catID ='';
 $v = "?v=1";

    if($this->input->post('start_date')){

        $v .= "&start_date=".$this->input->post('start_date');

    }

    if($this->input->post('end_date')) {

        $v .= "&end_date=".$this->input->post('end_date');
    }

    if ($this->input->post('category')) {

    $v .= "&category=" . $this->input->post('category');

    $catID = $this->input->post('category');

    }
    
?>

<script>
    $(document).ready(function () {
        function attach(x) {
            if(x !== null) {
                return '<a href="<?=base_url();?>uploads/'+x+'" target="_blank" class="btn btn-primary btn-block"><i class="fa fa-chain"></i></a>';
            }
            return '';
        }

        $('#expData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('expenses/get_expenses'.$v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender":hrld}, null, {"mRender":currencyFormat},null, null, null,null, {"mRender":attach, "bSortable":false, "bSearchable": false},{"bSortable":false, "bSearchable": false}]
        });

    });

</script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print report</button><br><br>
                    
                        <?=  form_open("expenses");?>

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <?= lang('category', 'category'); ?>
                                    <?php
                                    $cat[''] = lang("select")." ".lang("category");
                                    foreach($categories as $category) {
                                        $cat[$category->cat_id] = $category->name;
                                    }
                                    ?>
                                    <?= form_dropdown('category', $cat, set_value('category'), 'class="form-control select2 tip" id="category" style="width:100%;"'); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="date"><?= lang("Start date"); ?></label>

                                    <?= form_input('start_date', set_value('date'), 'class="form-control datepicker" id="start_date"');?>

                                </div>

                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="date"><?= lang("End date"); ?></label>

                                    <?= form_input('end_date', set_value('date'), 'class="form-control datepicker" id="end_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>
                        <?php 
                        $amount = ''; 
                        $cname = '';
                        $catNameByID ='';
                        foreach ($expenbyfilter as $key => $value) {

                           $amount = $amount+$value->amount;
                         }

                        $catNameByID = $this->categories_model->getCategoryByID($catID);

                        foreach ($catNameByID as $key => $catName) {
                         $cname = '('.$catName->name.')'; 

                        }
                        if($amount !=''){                           

                     ?><br>

                     <p class="box-title">Total Expenses Amount <?= $cname; ?> : <?= $this->tec->formatMoney($amount); ?></p>

                     <?php } ?>
                </div>
                <div class="box-body">
                    <div class="table-responsive" id="page_content">
                    <table id="expData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr class="active">
                            <th class="col-xs-2"><?php echo $this->lang->line("date"); ?></th>
                            <th class="col-xs-2"><?php echo $this->lang->line("reference"); ?></th>
                            <th class="col-xs-1"><?php echo $this->lang->line("amount"); ?></th>
                            <th class="col-xs-1"><?php echo $this->lang->line("Category"); ?></th>
                            <th class="col-xs-4"><?php echo $this->lang->line("note"); ?></th>
                            <th class="col-xs-4"><?php echo $this->lang->line("Store Name"); ?></th>
                            <th class="col-xs-2"><?php echo $this->lang->line("Created By"); ?></th>
                            <th style="min-width:30px; width: 30px; text-align: center;"><i class="fa fa-chain"></i></th>
                            <th style="width:100px;"><?php echo $this->lang->line("actions"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="7" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>
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
</script>
<script>
    $("#printWindow").click(function () {        
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><p style='text-align:center'>Expenses List</p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: center; padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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
