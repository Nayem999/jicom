<section class="content"> 
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div> 
				<div class="box-body">
					<?= form_open_multipart("admin/fileupload/add",  'class="validation"');?>

					<div class="col-md-12"> 
						<div id="group_div"></div>    
						<div class="col-md-8">
							<span>Allowed Types = gif|jpg|png|jpeg|pdf|doc|docx|xls|zip</span> 
							<div class="form-group">
								<input type="hidden" name="status" value="1">
								<label class="control-label" for="userfile"> 
								<input type="file" required="required" name="userfile" multiple >
							</div>
						</div> 
						<div class="col-md-8">  
							<div class="form-group">
								<?php echo form_submit('add_now', $this->lang->line("Add_Now"), 'class="btn btn-primary"');?>
							</div> 
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>  
</section> 

