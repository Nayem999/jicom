<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= lang('update_info'); ?></h3>
        </div>
        <div class="box-body"> 
          <?php echo form_open("loan/edit_loaner/".$loaner->id);?>

          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>
              <?= form_input('name', set_value('name', $loaner->name), 'class="form-control input-sm" id="name"'); ?> 
            </div>
            <div class="form-group add-occo">
               <?= lang('Occupation'); ?>*
                <?php   
                $sp[''] = 'Select Occupation';
                foreach($designation as $value) {
                    $sp[$value->destination] = $value->destination; 
                } ?>
                <?= form_dropdown('occupation', $sp, set_value('occupation', $loaner->occupation), 'class="form-control select2 tip" id="loaner"  required="required" style="width:100%;" '); ?>

                <a href="javascript:;" onclick="addDesignation()"><i class="fa fa-plus-circle" aria-hidden="true"></i> </a>
            </div>
             <div class="form-group">
              <label class="control-label" for="organization"> Organization</label>
              <?= form_input('organization', set_value('organization',$loaner->organization), ' class="form-control input-sm" id="organization"'); ?>
            </div> 
            <div class="form-group">
              <label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>
              <?= form_input('email', set_value('email', $loaner->email), 'class="form-control input-sm" id="email_address"'); ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>
              <?= form_input('phone', set_value('phone', $loaner->phone), 'class="form-control input-sm" id="phone"');?>
            </div>

            <div class="form-group">
              <label class="control-label" for="cf1"><?= $this->lang->line("ccf1"); ?></label>
              <?= form_input('cf1', set_value('cf1', $loaner->cf1), 'class="form-control input-sm" id="cf1"'); ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="cf2"><?= $this->lang->line("ccf2"); ?></label>
              <?= form_input('cf2', set_value('cf2', $loaner->cf2), 'class="form-control input-sm" id="cf2"');?>
            </div> 

            <div class="form-group">
              <?php echo form_submit('edit_loner', $this->lang->line("Edit Loner"), 'class="btn btn-primary"');?>
            </div>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
    
    .form-group.add-occo {
      position: relative;
    }
    .add-occo a {
      position: absolute;
      left: 100%;
      bottom: 0;
      font-size: 25px;
      color: #00a65a;
      margin-left: 10px;
      margin-bottom: 3px;
      line-height: normal;
    }
</style>
