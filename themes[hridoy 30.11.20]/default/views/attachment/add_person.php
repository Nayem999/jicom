
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
                            <label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>*
                            <?= form_input('name', set_value('name'), 'required="required" class="form-control input-sm" id="name"'); ?>
                        </div>  
                        <div class="form-group">
                            <label class="control-label" for="email"><?= $this->lang->line("email_address"); ?></label>
                            <?= form_input('email', set_value('email'), ' class="form-control input-sm" id="email"'); ?>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>
                            <?= form_input('phone', set_value('phone'), 'class="form-control input-sm" id="phone"');?>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="cf1"><?= $this->lang->line("Address 1"); ?></label>
                            <?= form_input('cf1', set_value('cf1'), 'class="form-control input-sm" id="cf1"'); ?>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="cf2"><?= $this->lang->line("Address 2"); ?></label>
                            <?= form_input('cf2', set_value('cf2'), 'class="form-control input-sm" id="cf2"');?>
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


<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function () {

        $('.datetimepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });

</script>