<?php

$v = "?v=1";

    if($this->input->post('customer')){

        $v .= "&customer=".$this->input->post('customer');

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

		$('#SLData').dataTable({

			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],			 

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

			'bProcessing': true, 'bServerSide': true,		 	 

            'sAjaxSource': '<?= site_url('sales/get_sales/'. $v) ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});


            },


            "aoColumns": [{"mRender":hrld}, null, null,  null,null, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat},null,{"mRender":currencyFormat},  null,null, {"bSortable":false, "bSearchable": false}]

		}); 
		$('div.dataTables_filter input').addClass('input-search-box');
		$('div.dataTables_filter div').addClass('input-group datepicker sales-search-box');
		$('div.dataTables_filter em').addClass('form-control sales-search');
		$('div.dataTables_filter span').addClass('input-group-addon');
		$('div.dataTables_filter span span').removeClass('input-group-addon');
		$('div.dataTables_filter span span').addClass('glyphicon glyphicon-calendar'); 


	});
</script>
<style type="text/css">
	.input-search-box  {
	    width: 150px !important;
		height: 30px !important;
	} 
	.bootstrap-datetimepicker-widget  {		 
		top:50px !important;
		background-color: #fff !important;
		width: 250px !important;
		height: 250px !important;
		 
	}
	.sales-search-box {
	    width: 100%;
	}
	.sales-search-box label{
	    width: 53%;
	}
	.sales-search {
		border: 0;
		font-style: normal;
	}
	 
</style>
 
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">

                    <h3 class="box-title"><?= lang('customize_report'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print report</button>

                </div>
				<?php if($this->session->userdata('group_id') == 3){

						$u_id = $this->session->userdata('user_id') ;
						}else{
							$u_id = NULL;
						 }; ?>

				<div class="box-body">

				<div class="panel-body">

                        <?= form_open("sales");?>

                        <div class="row">
                        <?php if($this->Admin){ ?>
                            <div class="col-sm-3">
                                 <?= lang('From Warehouse','From Warehouse'); ?>
                                <?php
                                $wr[''] = lang("select")." ".lang("warehouse");
                                foreach($warehouses as $warehouse) {
                                    $wr[$warehouse->id] = $warehouse->name;
                                }
                                ?>
                                <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="warehouse" required="required" style="width:100%;"'); ?> 
                            </div>
                            <?php } ?>
                            <div class="col-sm-3" id="customerInfo">

                                <div class="form-group">

                                    <label class="control-label" for="customer"><?= lang("customer"); ?></label>

                                    <?php

                                    $cu[0] = lang("select")." ".lang("customer");

                                    foreach($customers as $customer){

                                        $cu[$customer->id] = $customer->name .' ('.$this->site->findeNameByID('stores','id',$customer->store_id)->name.')';

                                    }

                                    echo form_dropdown('customer', $cu, set_value('customer'), 'class="form-control select2" style="width:100%" id="customer"'); ?>

                                </div> 
                            </div> 

                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>

                                    <?= form_input('start_date', set_value('start_date'), 'class="form-control datepicker" style="width:100%" id="start_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>

                                    <?= form_input('end_date', set_value('end_date'), 'class="form-control datepicker" style="width:100%" id="end_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>
				<div class="table-responsive" >
                <div class="col-xs-6">
                	<table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="col-xs-5">Total Sales  Amount</th>
                            <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->sales_model->salesAmount('grand_total',$u_id)); ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Total Paid Amount</th>
                            <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->sales_model->salesAmount('paid',$u_id)); ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Total Due Amount </th>
                            <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->sales_model->salesDeu($u_id)); ?></th>
                          </tr>                     
                        
                        </tbody>
                      </table>                      
                     </div> 
 						<div class="clearfix"></div>
                    </div>
					<div class="table-responsive" id="page_content">

						<table id="SLData" class="table table-striped table-bordered table-condensed table-hover">

							<thead>

								<tr class="active">

									<th style="width: 150px;" ><?php echo $this->lang->line("date"); ?></th>
                                    
                                    <th>Inv NO </th>

                                    <th><?php echo $this->lang->line("customer"); ?></th>

                                    <th>Store Name</th>									
                                    
                                    <th title="Customer phone number">C.Phone</th>

									<th class="col-xs-1"><?php echo $this->lang->line("total"); ?></th>

									<th style="width: 20px;"><?php echo $this->lang->line("tax"); ?></th>

									<th><?php echo $this->lang->line("dis"); ?></th>

									<th style="width: 20px;"><?php echo $this->lang->line("grand_total"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("paid"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("P.By"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("balance"); ?></th>
                                    
									<th style="width: 40px;"><?php echo $this->lang->line("status"); ?></th>
                                    
                                    <th class="col-xs-1"><?php echo 'War'; ?></th>

									<th style="width:205px; text-align:center;"><?php echo $this->lang->line("actions"); ?></th>

								</tr> 

							</thead>

							<tbody>

								<tr>

									<td colspan="11" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>

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
            format: 'YYYY-MM-DD',  
        });

    }); 

$(document).ready(function(){
	$('#datePicker').change(function(){
		var curval = $(this).attr('id');
        alert(curval);
	});
}); 
    $(function(){
     $("#warehouse").change(function(){ 
         var warehouse = this.value; 
         var url = '<?php echo base_url('sales/customerInfoByStore') ?>'+'/'+warehouse;
         $('#customerInfo').load(url);
        // alert(url);
         
        });
    });  
</script>
<script>
    $("#printWindow").click(function () {        
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><p style='text-align:center'>Sales List | <?= $this->Settings->site_name ?></p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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
