<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div>
				<div class="box-body">
					<?php echo form_open("mf_suppliers/add");?>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="code"><?= $this->lang->line("name"); ?> <span class="text-danger">*</span></label>
							<?= form_input('name', set_value('name'), 'class="form-control input-sm" required id="name"'); ?>
						</div>

						<div class="form-group">
							<label class="control-label" for="phone"><?= $this->lang->line("phone"); ?> <span class="text-danger">*</span></label>
							<?= form_input('phone', set_value('phone'), 'class="form-control input-sm" required id="phone"');?>
						</div>

						<div class="form-group">
							<label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>
							<?= form_input('email', set_value('email'), 'class="form-control input-sm" id="email_address"'); ?>
						</div>



						<div class="form-group">
							<label class="control-label" for="address"><?= $this->lang->line("address"); ?> <span class="text-danger">*</span></label>
							<?= form_input('address', set_value('address'), 'class="form-control input-sm" required id="address"'); ?>
						</div>

						<div class="form-group">
							<label class="control-label" for="descriptions"><?= $this->lang->line("descriptions"); ?></label>
							<?= form_input('descriptions', set_value('descriptions'), 'class="form-control input-sm" id="descriptions"');?>
						</div>

						<div class="form-group">
							<?php echo form_submit('add_supplier', $this->lang->line("add_supplier"), 'class="btn btn-primary"');?>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</section>
