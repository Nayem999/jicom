 
<script>

	$(document).ready(function () {

		$('#SLData').dataTable({

			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],			 

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

			'bProcessing': true, 'bServerSide': true,		 	 

            'sAjaxSource': '<?= site_url('sales/get_sales_log/') ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});


            },


            "aoColumns": [{"mRender":hrld}, null, null,  null, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat},null,{"mRender":currencyFormat},  null,null,null ]

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
				<?php if($this->session->userdata('group_id') == 2){

						$u_id = $this->session->userdata('user_id') ;
						}else{
							$u_id = NULL;
						 }; ?>

				<div class="box-body"> 
				<div class="table-responsive"> 
 						<div class="clearfix"></div>
                    </div>
					<div class="table-responsive">

						<table id="SLData" class="table table-striped table-bordered table-condensed table-hover">

							<thead>

								<tr class="active">

									<th style="width: 150px;" ><?php echo $this->lang->line("date"); ?></th>
                                    
                                    <th>Inv NO </th>

									<th><?php echo $this->lang->line("customer"); ?></th>
                                    
                                    <th title="Customer phone number">C.Phone</th>

									<th class="col-xs-1"><?php echo $this->lang->line("total"); ?></th>

									<th style="width: 20px;"><?php echo $this->lang->line("tax"); ?></th>

									<th><?php echo $this->lang->line("dis"); ?></th>

									<th style="width: 20px;"><?php echo $this->lang->line("grand_total"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("paid"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("P.By"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("balance"); ?></th>
                                    
									<th style="width: 40px;"><?php echo $this->lang->line("status"); ?></th>
                                    
                                    <th class="col-xs-1"><?php echo 'Sale Type'; ?></th> 

                                    <th style="width: 40px;"><?php echo $this->lang->line("Action"); ?></th>

								</tr> 

							</thead>

							<tbody>

								<tr>

									<td colspan="13" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>

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
</script>

