<?php

$v = "?v=1";

    if($this->input->post('customer')){

        $v .= "&customer=".$this->input->post('customer');

    }

    if($this->input->post('user')){

        $v .= "&user=".$this->input->post('user');

    }

    if($this->input->post('start_date')){

        $v .= "&start_date=".$this->input->post('start_date');

    }

    if($this->input->post('end_date')) {

        $v .= "&end_date=".$this->input->post('end_date');

    }



?>



<script>

    $(document).ready(function () {

        $('#SLRData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('reports/get_sales/'. $v) ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [{"mRender":hrld}, null,null,null, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}]

        });

    });

</script>



<script type="text/javascript">

    $(document).ready(function(){

        $('#form').hide();

        $('.toggle_form').click(function(){

            $("#form").slideToggle();

            return false;

        });

    });

</script> 

<section class="content">

    <div class="row">

        <div class="col-sm-12">

            <div class="box box-primary">

                <div class="box-header">
					<button type="button" onclick="printIt()" style="width:120px; float:right" class="btn bg-navy btn-block btn-flat" id="daily_sales">Print report</button>
                    <a href="#" class="btn btn-default btn-sm toggle_form pull-right"><?= lang("show_hide"); ?></a>

                    <h3 class="box-title"><?= lang('customize_report'); ?></h3>

                </div>

                <div class="box-body">

                <div id="form" class="panel panel-warning">

                    <div class="panel-body">

                        <?= form_open("reports");?>

                        <div class="row">

                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="customer"><?= lang("customer"); ?></label>

                                    <?php

                                    $cu[0] = lang("select")." ".lang("customer");

                                    foreach($customers as $customer){

                                        $cu[$customer->id] = $customer->name;

                                    }

                                    echo form_dropdown('customer', $cu, set_value('customer'), 'class="form-control select2" style="width:100%" id="customer"'); ?>

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="control-label" for="user"><?= lang("user"); ?></label>

                                    <?php

                                    $us[""] = "";

                                    foreach ($users as $user) {
                                        if($user->store_id==0){
                                            $StoreName = 'Admin';
                                        }else{
                                            $storeName = $this->site->getDataByElement('stores','id',$user->store_id);
                                            $StoreName = $storeName[0]->name;
                                        }

                                        $us[$user->id] = $user->first_name . " " . $user->last_name .' ('.$StoreName.' )';

                                    }

                                    echo form_dropdown('user', $us, (isset($_POST['user']) ? $_POST['user'] : ""), 'class="form-control select2" id="user" data-placeholder="' . lang("select") . " " . lang("user") . '" style="width:100%;"');

                                    ?>

                                </div>

                            </div>



                            <div class="col-sm-2">

                                <div class="form-group">

                                    <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>

                                    <?= form_input('start_date', set_value('start_date'), 'class="form-control datetimepicker" id="start_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-2">

                                <div class="form-group">

                                    <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>

                                    <?= form_input('end_date', set_value('end_date'), 'class="form-control datetimepicker" id="end_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>

                    </div>

                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="table-responsive" id="page_content">

                                <table id="SLRData" class="table table-striped table-bordered table-condensed table-hover">

                                    <thead>

                                        <tr class="active">

                                            <th class="col-sm-2"><?= lang("date"); ?></th>

                                            <th class="col-sm-2"><?= lang("customer"); ?></th>

                                            <th class="col-sm-2"><?= lang("Store Name"); ?></th>

                                            <th class="col-sm-2"><?= lang("created_by"); ?></th>

                                            <th class="col-sm-1"><?= lang("total"); ?></th>

                                            <th class="col-sm-1"><?= lang("tax"); ?></th>

                                            <th class="col-sm-1"><?= lang("discount"); ?></th>

                                            <th class="col-sm-2"><?= lang("grand_total"); ?></th>

                                            <th class="col-sm-1"><?= lang("paid"); ?></th>

                                            <th class="col-sm-2"><?= lang("balance"); ?></th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>



                    <?php if($this->input->post('customer')) { ?>

                    <div class="row">

                        <div class="col-md-6"><button class="btn bg-purple btn-lg btn-block" style="cursor:default;"><strong><?=$total_sales?></strong> <?= lang("total_sales"); ?></button></div>

                        <div class="col-md-6"><button class="btn btn-success btn-lg btn-block" style="cursor:default;"><strong><?=$total_sales_value ? $total_sales_value : 0;?></strong> <?= lang("total_sales_value"); ?></button></div>

					
                      <div class="col-md-6"><button class="btn btn-success btn-lg btn-block" style="cursor:default; background:#d21010"><strong>
					  <?php  echo $total_sales_value - $total_sales_value_paid   ; ?>
                      </strong> Total Due </button></div>
                     
                      <div class="col-md-6"><button class="btn bg-purple btn-lg btn-block" style="cursor:default;"><strong><?=$total_sales_value_paid ? $total_sales_value_paid : 0;?></strong> Total Paid</button></div>
                      
                      
                        <div class="col-md-6"><button class="btn btn-success btn-lg btn-block" style="cursor:default;"><strong><?=$total_quantity ? $total_quantity : 0;?></strong> Total Quantity </button></div> 
                     
                      <div class="col-md-6"><button class="btn btn-success btn-lg btn-block" style="cursor:default;"><strong><?=$total_Item ? $total_Item : 0;?></strong> Total items  </button></div>    
                        
                        
                        


                       

                    <?php } ?>



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

