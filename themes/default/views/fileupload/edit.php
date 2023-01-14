<section class="content">
	<!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script> -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div>   
				<div class="box-body">
					<?php echo form_open_multipart("admin/fileupload/edit/{$data->id}");?> 
					<div class="col-md-12"> 
						<div id="group_div"></div>     
                    	<div class="col-md-8"> 
							<div class="form-group">
								<label class="control-label" for="content"><?= $this->lang->line("Order By"); ?></label> <samp class="required-star">*</samp>
								<?= form_input('order_by', set_value('order_by',$data->order_by), 'class="form-control input-sm" id="order_by"'); ?>
								<?php echo form_error('order_by', '<div class="error">', '</div>'); ?>
							</div>
						</div>  
						<div class="col-md-8">  
							<div class="form-group">
								<?php if($data->file_name){
									echo "<img width='150' src='".base_url('uploads/gallery')."/$data->file_name'>";
								} ?><br>
								<label class="control-label" for="content"><?= $this->lang->line(" Image(854X484)"); ?></label>
								<input type="file" name="userfile" value="">
							</div>
						</div>
						<div class="col-md-8"> 
							<div class="form-group">

	                            <?= lang('status', 'status'); ?><samp class="required-star">*</samp>

	                            <?php

	                            $opt = array('' => '', 1 => lang('Enable'), 0 => lang('Disable'));

	                            echo form_dropdown('status', $opt, set_value('status',$data->status), 'id="status" data-placeholder="' . lang("select") . ' ' . lang("status") . '" class="form-control input-tip select2" required="required" style="width:100%;"');

	                            ?>

	                        </div>
                    	</div>
						<div class="col-md-8">  
							<div class="form-group">
								<?php echo form_submit('add_now', $this->lang->line("Update"), 'class="btn btn-primary"');?>
							</div> 
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div> 

	<script type="text/javascript">
		function slugName(){
			var title = $('#title').val();
			str =  title.replace(/[^a-z0-9\s]/gi,'-').replace(/[_\s]/g,'-').replace(/ /g, '-');
			str = str.toLowerCase(str);
			$('#slug').val(str);


		}
	</script>

</section> 

