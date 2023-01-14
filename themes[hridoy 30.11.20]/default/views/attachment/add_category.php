
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div> 
                <div class="box-body">
                    <?php echo form_open("",'class="validation"');?> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="title"><?= $this->lang->line("Title"); ?></label>*
                            <?= form_input('title', set_value('title'), 'required="required" class="form-control input-sm" id="title"'); ?>
                        </div>  
                        <div class="form-group">
                            <?php echo form_submit('add_loaner', $this->lang->line("Add Now"), 'class="btn btn-primary"');?>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
			</div>

		</div> 
	</div> 
</section>  