<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div>
				<div class="box-body">
					<?php echo form_open("suppliers/add");?>

					<div class="col-md-6">
					<?php if($this->session->userdata('store_id')==0){ ?>
						<div class="form-group">
	                        <?= lang('From Warehouse','From Warehouse'); ?>
	                        <?php
	                        $wr[''] = lang("select")." ".lang("warehouse");
	                        foreach($warehouses as $warehouse) {
	                            $wr[$warehouse->id] = $warehouse->name;
	                        }
	                        ?>
	                        <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="from-warehouse" required="required" style="width:100%;"'); ?> 
						</div>
						<?php } ?>
						<div class="form-group">
							<label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>
							<?= form_input('name', set_value('name'), 'class="form-control input-sm" id="name"'); ?>
						</div>

						<div class="form-group">
							<label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>
							<?= form_input('email', set_value('email'), 'class="form-control input-sm" id="email_address"'); ?>
						</div>

						<div class="form-group">
							<label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>
							<?= form_input('phone', set_value('phone'), 'class="form-control input-sm" id="phone"');?>
						</div>

						<div class="form-group">
							<label class="control-label" for="cf1"><?= $this->lang->line("scf1"); ?></label>
							<?= form_input('cf1', set_value('cf1'), 'class="form-control input-sm" id="cf1"'); ?>
						</div>

						<div class="form-group">
							<label class="control-label" for="cf2"><?= $this->lang->line("scf2"); ?></label>
							<?= form_input('cf2', set_value('cf2'), 'class="form-control input-sm" id="cf2"');?>
						</div>

						<div class="form-group">
							<label class="control-label" for="opening_blance"><?= $this->lang->line("Opening Balance"); ?></label>
							<?= form_input('opening_blance', set_value('opening_blance'), 'class="form-control input-sm" id="cf2"');?>
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
