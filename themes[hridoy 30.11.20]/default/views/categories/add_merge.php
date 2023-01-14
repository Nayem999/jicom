<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<section class="content">
<div class="row">

<div class="col-sm-12">

<div class="box box-primary">

<div class="box-body">

  <div id="form" class="panel panel-warning">

    <div class="panel-body">

      <?= form_open_multipart("merge/add_merge" );?>

      <div class="row"> 
        <div class="col-sm-4">
          <div class="form-group">  
              <label class="control-label" for="supplier"><?= lang("Supplier"); ?></label>
              <?php

              $cu[''] = lang("select")." ".lang("Supplier");

                  foreach($allsuppliers as $supplier){

                     $cu[$supplier->id] = $supplier->name;

                   }

              echo form_dropdown('supplier', $cu, set_value('supplier'), 'class="form-control select2 tip" style="width:100%" id="supplier" required="required"');  
              ?> 
          </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="control-label" for="customer"><?= lang("customer"); ?></label>
                <?php
                $cu = array();

                $cu[''] = lang("select")." ".lang("customer");

                    foreach($allcustomars as $customars){

                       $cu[$customars->id] = $customars->name;

                     }

                echo form_dropdown('customer', $cu, set_value('customer'), 'class="form-control select2 tip" style="width:100%" id="customer" required="required"');  
                ?>
            </div> 
        </div>
        <div class="col-sm-12">

          <button type="submit" class="btn btn-primary" name="submit"><?= lang("submit"); ?></button>

        </div>

      </div>

      <?= form_close();?>

    </div>

  </div>  

<div class="row">

<div class="col-sm-12">

<div class="table-responsive" id="page_content">

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</section>
<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script> 

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

 $("#daily_sales").click(function () {
	 
	$(".text-center a ").css("display", "none");
	
	 var content = "<html> <br> <h2 style='text-align:center'>Sales Report <br></h2>";
	 content += document.getElementById("page_content").innerHTML ;
     content += "</body>";
     content += "</html>";
	 var printWin = window.open('','','left=20,top=40,width=600,height=500,toolbar=0,scrollbars=0,status =0');
	 printWin.document.write('<link rel="stylesheet" href="http://localhost/spos-new/themes/default/assets/bootstrap/css/bootstrap.min.css" type="text/css" />');

     printWin.document.write(content);
     
	 printWin.focus();
     printWin.print();
	 printWin.close();
   
    // window.print();            
            
  });

</script> 
