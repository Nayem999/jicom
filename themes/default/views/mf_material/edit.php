<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= lang('update_info'); ?></h3>
        </div>
        <div class="box-body">
          <?php echo form_open("mf_material/edit/".$material->id);?>

          <div class="col-md-6">

            <div class="form-group">
              <label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>
              <?= form_input('name', set_value('name', $material->name), 'class="form-control input-sm" required id="name"'); ?>
            </div>

						<div class="form-group">
							<label class="control-label" for="uom_id"><?= lang('From Category','From Category'); ?> <span class="text-danger">*</span></label>	                        
              <?php
								// $uom_arr=array(''=>"Select UOM",1=>"PCS",2=>"KG",3=>"GM",4=>"LR",5=>"ML");
								$uom_arr[0] = lang("select")." ".lang("UOM");
								if(is_array($all_uom))
								{
									foreach($all_uom as $uom_val) {
										$uom_arr[$uom_val->id] = $uom_val->name;
									}
								}
	              ?>
                <?= form_dropdown('uom_id', $uom_arr, set_value('uom_id',$material->uom_id), 'class="form-control select2 tip" id="uom_id" required="required" style="width:100%;"'); ?> 
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
                <?= form_dropdown('category_id', $cr, set_value('category_id',$material->category_id), 'class="form-control select2 tip" id="from-category_id" required="required" style="width:100%;"'); ?> 
						</div>

						<div class="form-group">
							<label class="control-label" for="descriptions"><?= $this->lang->line("descriptions"); ?></label>
							<?= form_input('descriptions', set_value('descriptions',$material->descriptions), 'class="form-control input-sm" id="descriptions"');?>
						</div>

            <div class="form-group">
              <?php echo form_submit('edit_material', $this->lang->line("edit_material"), 'class="btn btn-primary"');?>
            </div>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
  </div>
</section>
