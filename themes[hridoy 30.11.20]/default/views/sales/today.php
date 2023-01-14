
<?php $today = date('Y-m-d') ; ?>
<script>
	$(document).ready(function () {
		function balance(value){
					if(value >= 0){
					var old_balance = $('#totalBlance').html();
					var t_balance = Number(old_balance) + Number(value);
					$('#totalBlance').html(t_balance);
				}

			return value ;
		}

		$('#SLData').dataTable({

			"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

			'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('sales/get_sales/'.$today) ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            }, 

            "aoColumns": [{"mRender":hrld}, null, null,  null,null, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat}, {"mRender":currencyFormat},null,{"mRender":currencyFormat},  null,null, {"bSortable":false, "bSearchable": false}]

		});

	});

</script>
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">

					<h3 class="box-title"><?= lang('list_results'); ?></h3>

					<?php if($this->session->userdata('group_id') == 3){

						$u_id = $this->session->userdata('user_id') ;
						}else{
							$u_id = NULL;
						 }; ?>

				</div>

				<div class="box-body">
				<div class="table-responsive">
                <div class="col-xs-6">
                	<table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th class="col-xs-5">Today Sales  Amount</th>
                            <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->sales_model->salesAmount('total',$u_id,$today)); ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Today Paid Amount</th>
                            <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->sales_model->salesAmount('paid',$u_id,$today)); ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Today Due Amount </th> 
                            <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->sales_model->salesDeu($u_id,$today));?></th>
                          </tr>                     
                        
                        </tbody>
                      </table>
                     </div>
 					<div class="clearfix"></div>
                    </div>

					<div class="table-responsive">

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

									<th><?php echo $this->lang->line("discount"); ?></th>

									<th style="width: 20px;"><?php echo $this->lang->line("grand_total"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("paid"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("P.By"); ?></th>

                                    <th class="col-xs-1"><?php echo $this->lang->line("balance"); ?></th>
                                    
									<th style="width: 40px;"><?php echo $this->lang->line("status"); ?></th>
                                    
                                    <th class="col-xs-1"><?php echo 'warranty'; ?></th>

									<th style="width:205px; text-align:center;"><?php echo $this->lang->line("actions"); ?></th>

								</tr>

							</thead>

							<tbody>

								<tr>

									<td colspan="9" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>

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

