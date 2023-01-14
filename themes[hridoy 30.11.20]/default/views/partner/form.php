
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">

					<h3 class="box-title"><?= lang('enter_info'); ?></h3>

				</div>

				<div class="box-body">

					<?php echo form_open($action);?>

					<div class="col-md-6">

						<div class="form-group">

							<label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>

							<?= form_input('name', set_value('name',$emplyee->name), 'class="form-control input-sm" id="name"'); ?>

						</div>
						<div class="form-group">

							<label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>

							<?= form_input('email', set_value('email' , $emplyee->email), 'class="form-control input-sm" id="email_address"'); ?>

						</div>
						<div class="form-group">

							<label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>

							<?= form_input('phone', set_value('phone' , $emplyee->phone), 'class="form-control input-sm" id="phone"');?>

						</div> 

						<div class="form-group">

							<label class="control-label" >Address</label>

							<?= form_input('address', set_value('address' ,  $emplyee->address), 'class="form-control input-sm" id="address"');?>

						</div>

						<div class="form-group">

							<label class="control-label" >Partner part ( % included)</label>

							<?= form_input('partner_part', set_value('partner_part',  $emplyee->partner_part), 'class="form-control input-sm" id="basic_salary"  placeholder="Partner part ( % )"');?>

						</div>   

						<div class="form-group">

							<?php echo form_submit('add_employee','Save', 'class="btn btn-primary"');?>

						</div>

					</div>

					<?php echo form_close();?>

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