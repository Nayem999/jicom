<?php

$v = "?v=1";

    if($this->input->post('product')){

        $v .= "&product=".$this->input->post('product');

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

            'bProcessing': true, 'bServerSide': false,  

            "aaSorting": [[ 1, "asc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>, 

            "aoColumns": [null, null, {"bSearchable": false}, {"mRender":currencyFormat, "bSearchable": false}]

        });

});

</script>
 
<style type="text/css">
    .dataTables_length {
        display: none !important ;
    }
    /*#fileData_length {
    display: none !important;}*/

</style>


<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header"> 

                    <h3 class="box-title">Sold and Purchase</h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button>
                </div>

                <div class="box-body">
                     <?php if($this->Admin){ ?>
                    <div id="form" class="panel panel-warning">

                        <div class="panel-body">
                       

                         <?= form_open("reports/sold_purchase");?>

                        <div class="row">
                        
                            <div class="col-sm-4">
                                <div class="form-group">
                                     <?= lang('Store','Store'); ?>
                                    <?php
                                    $wr[''] = lang("select")." ".lang("Store");
                                    foreach($stores as $store) {
                                        $wr[$store->id] = $store->name;
                                    }
                                    ?>
                                    <?= form_dropdown('store_id', $wr, set_value('store_id'), 'class="form-control select2 tip" id="store_id" required="required" style="width:100%;"'); ?> 
                                </div>
                            </div>                           

                            <div class="col-xs-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>  


                    </div>

                    </div>
                    <?php } ?>

                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="table-responsive" id="page_content">

                                <table id="fileData" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">

                                    <thead>

                                        <tr class="active">

                                            <th class="col-xs-2"><?= lang("name"); ?></th>

                                            <th class="col-xs-2"><?= lang("code"); ?></th>

                                            <th class="col-xs-1"><?= lang("sold"); ?></th>

                                            <th class="col-xs-1"><?= lang("Purchases"); ?></th>  
                                            
                                        </tr>

                                    </thead>

                                    <tbody>
                                    <?php //print_r($results);               
                                        foreach ($results as $key => $resul) {         
                                           ?>
                                        <tr>
                                            <td><?php echo $resul['name']; ?></td>
                                            <td><?php echo $resul['code']; ?> </td>
                                            <td><?php echo $resul['sold']-$resul['sreturn']; ?> </td>
                                            <td><?php echo $resul['purchase']; ?></td> 
                                        </tr>
                                        <?php } ?>

                                    </tbody>

                                </table>

                            </div>

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

        $('.datetimepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });

</script>
<script>

 $("#daily_sales").click(function () {
	 
	$(".text-center a ").css("display", "none");
    $(".dataTables_length ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none");  
	
	 var content = "<html> <br> <h2 style='text-align:center'> Products Report <br></h2>";
	 content += document.getElementById("page_content").innerHTML ;
     content += "</body>";
     content += "</html>";
	 var printWin = window.open('','','left=20,top=40,width=700,height=550,toolbar=0,scrollbars=0,status =0');
	 printWin.document.write('<link rel="stylesheet" href="http://localhost/spos-new/themes/default/assets/bootstrap/css/bootstrap.min.css" type="text/css" />');

     printWin.document.write(content);
     
	 printWin.focus();
     printWin.print();
	 printWin.close();
   
    // window.print();   

    $(".dataTables_paginate ").css("display", "block");
    $("#fileData_filter ").css("display", "block");         
            
  });
  $("#excelWindow").click(function () {  
        var data=$("#warehouse").val();    
        var url='<?=site_url('reports/excel_sold_purchase/');?>'+'/'+data;
        location.replace(url);

    });
</script>

