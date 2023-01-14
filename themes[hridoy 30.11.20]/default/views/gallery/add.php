<section class="content"> 
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div> 
				<div class="box-body">
					<?php echo form_open_multipart("admin/gallery/add",  'class="validation"');?>

					<div class="col-md-12"> 
						<div id="group_div"></div>     
                    	<div class="col-md-8"> 
							<div class="form-group">
								<label class="control-label" for="title"><?= $this->lang->line("Caption"); ?></label> <samp class="required-star">*</samp>
								<?= form_input('title', set_value('title'), 'class="form-control input-sm" id="title" required="required"'); ?>
								<?php echo form_error('title', '<div class="error">', '</div>'); ?>
							</div>
						</div> 
						<div class="col-md-8"> 
							<div class="form-group">
	                            <?= lang('Album', 'Album'); ?><samp class="required-star">*</samp>
	                            <?php
	                            $al[] = 'Select Album'; 
	                            $albums = $this->site->selectQuery('gallery_album');
	                            if($albums){
	                            	foreach ($albums as $key => $album) {
	                            		$al[$album->id] = $album->title;
	                            	}
	                            }
	                            echo form_dropdown('album_id', $al, set_value('album_id'), 'id="album_id" data-placeholder="' . lang("select") . ' ' . lang("album_id") . '" class="form-control input-tip select2" required="required" style="width:100%;"');

	                            ?>
	                        </div>
                    	</div> 
						<div class="col-md-8"> 
							<div class="form-group">
								<label class="control-label" for="order_by"><?= $this->lang->line("Order By"); ?></label> <samp class="required-star">*</samp>
								<?= form_input('order_by', set_value('order_by'), 'class="form-control input-sm" id="order_by" required="required"'); ?>
								<?php echo form_error('order_by', '<div class="error">', '</div>'); ?>
							</div>
						</div> 
						<div class="col-md-8">  
							<div class="form-group">
								<label class="control-label" for="userfile"><?= $this->lang->line("Image(854X484)"); ?></label><samp class="required-star">*</samp>
								<input type="file" required="required" name="userfile[]" multiple >
							</div>
						</div>
						<div class="col-md-8"> 
							<div class="form-group">
	                            <?= lang('status', 'status'); ?><samp class="required-star">*</samp>
	                            <?php
	                            $opt = array('' => '', 1 => lang('Enable'), 0 => lang('Disable'));
	                            echo form_dropdown('status', $opt, set_value('status'), 'id="status" data-placeholder="' . lang("select") . ' ' . lang("status") . '" class="form-control input-tip select2" required="required" style="width:100%;"');
	                            ?>
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

