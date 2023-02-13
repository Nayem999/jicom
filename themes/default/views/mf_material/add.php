<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div>
				<div class="box-body">
					<?php echo form_open("mf_material/add");?>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="code"><?= $this->lang->line("name"); ?> <span class="text-danger">*</span></label>
							<?= form_input('name', set_value('name'), 'class="form-control input-sm" required id="name"'); ?>
						</div>

						<div class="form-group">
							<label class="control-label" for="category_id"><?= lang('From Category','From Category'); ?> <span class="text-danger">*</span></label>
	                        <?php
								$cr[0] = lang("select")." ".lang("Category");
								if(is_array($categories))
								{
									foreach($categories as $categories_arr) {
										$cr[$categories_arr->id] = $categories_arr->name;
									}
								}
	                        ?>
	                        <?= form_dropdown('category_id', $cr, set_value('category_id'), 'class="form-control select2 tip" id="from-category_id" required="required" style="width:100%;"'); ?> 
						</div>

						<div class="form-group">
							<label class="control-label" for="descriptions"><?= $this->lang->line("descriptions"); ?></label>
							<?= form_input('descriptions', set_value('descriptions'), 'class="form-control input-sm" id="descriptions"');?>
						</div>

						<div class="form-group">
							<?php echo form_submit('add_material', $this->lang->line("add_material"), 'class="btn btn-primary"');?>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</section>