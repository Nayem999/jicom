<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><?= lang('enter_info'); ?></h3>
				</div> 
                <?php echo form_open_multipart("",'class="validation"'); ?>  
                <div class="box-body"> 
                    <div class="col-sm-6">
                        <div class="form-group">                         
                            <?= lang('Title *', 'Title'); ?>
                            <?php
                            $ncat[''] = lang("select")." ".lang("note_category");
                            foreach($note_category as $category) {
                                $ncat[$category->id] = $category->title;
                            }
                            ?>
                            <?= form_dropdown('note_category_id', $ncat, set_value('note_category_id',$info->note_category_id), 'class="form-control select2 tip" id="persons"  required="required" style="width:100%;"'); ?>
                        </div>  
                        <div class="form-group all">
                            <?= lang("Type", "type") ?>
                            <?php
                            $bs = array('receive' => 'Receive', 'send' => 'Send');
                            echo form_dropdown('type', $bs, set_value('type', $info->type), 'class="form-control select2" id="type" required="required" style="width:100%;"');
                            ?>
                        </div>
                        <div class="form-group">
                            <?= lang('Persons *', 'Persons'); ?>
                            <?php
                            $cat[''] = lang("select")." ".lang("person");
                            foreach($persons as $person) {
                                $cat[$person->id] = $person->name;
                            }
                            ?>
                            <?= form_dropdown('persons_id', $cat, set_value('persons',$info->persons_id), 'class="form-control select2 tip" id="persons"  required="required" style="width:100%;"'); ?>
                        </div>
                     	<div class="form-group"> 
                            <?= lang('attachment', 'attachment'); ?>
                            <input type="file" name="userfile" id="image">    
                            <?php if($info){ ?>
                                <br>
                                <img src="<?=base_url('uploads/attachment/'.$info->attachment) ?>" width="150">
                            <?php } ?>         	 
                        </div> 
                        <div class="form-group">
                            <?php 
                            $note ='';
                            if(isset($_POST['note'])){
                                $note = $_POST['note'];
                            }
                            if($info){
                                $note = $info->note;
                            }
                            ?>
                            <?= lang('details', 'details'); ?>
                            <?= form_textarea('note', $note, 'class="form-control tip redactor" id="note"'); ?>
                        </div>
                        <div class="form-group"> 
                            <input class="btn btn-primary" type="submit" value="Save" name="attachform" >
                        </div> 
                    </div> 				   
				</div>                
                <?php echo form_close();?>
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