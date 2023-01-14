<section class="content"> 
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div> 
				<div class="box-body">
					<?php echo form_open_multipart("",  'class="validation"');?>

					<div class="col-md-12"> 
						<div id="group_div"></div>     
                    	<div class="col-md-8"> 
							<div class="form-group">
								<label class="control-label" for="title"><?= $this->lang->line("Album Title"); ?></label> <samp class="required-star">*</samp>
								<?php if($album){ ?>
								<?= form_input('title', set_value('title',$album->title), 'class="form-control input-sm" id="title" required="required"'); ?>
								<?php }else{ ?>
								<?= form_input('title', set_value('title'), 'class="form-control input-sm" id="title" required="required"'); ?>
								<?php } ?>
								<?php echo form_error('title', '<div class="error">', '</div>'); ?>
							</div>
						</div>  
						<div class="col-md-8">  
							<div class="form-group">
								<?php if($album){ ?>
									<img src="<?= base_url('uploads/gallery/'.$album->thumb_image);?>" width ="150">
								<?php } ?><br>
								<label class="control-label" for="userfile"><?= $this->lang->line("Image(300X320)"); ?></label><samp class="required-star">*</samp>
								<input type="file" required="required" name="userfile">
							</div>
						</div> 
						<div class="col-md-8">  
							<div class="form-group">
								<?php echo form_submit('add_now', $this->lang->line("Save"), 'class="btn btn-primary"');?>
							</div> 
						</div>
					</div>
					<?php echo form_close();?>
					<div class="col-md-12">
						<?php 
							if($albums){
								foreach ($albums as $key => $album) { ?> 
								<div class="album_glry">
									<img src="<?= base_url('uploads/gallery/'.$album->thumb_image);?>" width ="150">
									<br>
									<a href="<?= base_url('admin/gallery/album_edit/'.$album->id); ?>"><?= $album->title ? $album->title : ''; ?></a>		
									<div class="edit_remove">
										<div class="edits">
											<a href="<?= base_url('admin/gallery/album_edit/'.$album->id); ?>">
												<i class="fas fa-edit" aria-hidden="true"></i>
											</a>
										</div>
										<div class="deleteds">
											<a href="<?= base_url('admin/gallery/album_delete/'.$album->id); ?>">
												<i class="fas fa-trash-alt" aria-hidden="true"></i>
											</a>
										</div>
									</div>					
								</div>
							<?php }
							} ?>
					</div>
				</div>
			</div>
		</div>
	</div>  
</section> 

