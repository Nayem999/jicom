<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= lang('update_info'); ?></h3>
        </div>
        <div class="box-body">
          <?php echo form_open("store/edit/".$store->id);?>
          <div class="col-md-6"> 
            <div class="form-group">
              <label class="control-label" for="name"><?= $this->lang->line("name"); ?></label>
              <?= form_input('name', set_value('name',$store->name), 'class="form-control input-sm" id="name"'); ?>
            </div>

            <div class="form-group">
							<div class="form-group">
								<label class="control-label" for="store_type"><?= lang('Store Type', 'Store Type'); ?></label>
								<?php $store_type=array(''=>"Select Type",1=>"OUTLET",2=>"FACTORY"); ?>
								<?= form_dropdown('store_type', $store_type, set_value('store_type',$store->store_type), 'class="form-control" id="store_type" required="required" style="width:100%;"'); ?>
							</div>
						</div>
            
            <div class="form-group">
              <label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>
              <?php if($this->Admin){ ?>
              <?= form_input('email', set_value('email',$store->email), 'class="form-control input-sm" id="email_address"'); ?>
              <?php } else {?>
              <?= form_input('email', set_value('email',$store->email), 'class="form-control input-sm" id="email_address" readonly'); ?>
              <?php } ?>
            </div>
            

            <div class="form-group">
              <label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>
              <?= form_input('phone', set_value('phone',$store->phone), 'class="form-control input-sm" id="phone"');?>
            </div>

            <div class="form-group">
              <label class="control-label" for="address1"><?= $this->lang->line("Address1"); ?></label>
              <?= form_input('address1', set_value('address1',$store->address1), 'class="form-control input-sm" id="address1"'); ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="address2"><?= $this->lang->line("Address2"); ?></label>
              <?= form_input('address2', set_value('address2',$store->address2), 'class="form-control input-sm" id="address2"');?>
            </div>
            <div class="form-group">
              <label class="control-label" for="receipt_header"><?= $this->lang->line("Bill Header"); ?></label>
              <?= form_textarea('receipt_header', set_value('receipt_header',$store->receipt_header), 'class="form-control redactor" id="receipt_header"'); ?>
            </div> 
            <div class="form-group">
              <?php echo form_submit('add_store', $this->lang->line("add_store"), 'class="btn btn-primary"');?>
            </div>
          </div>
          <div class="col-md-6"> 
            <div class="form-group">
              <label class="control-label" for="city"><?= $this->lang->line("City"); ?></label>
              <?= form_input('city', set_value('city',$store->city), 'class="form-control input-sm" id="city"');?>
            </div>
            <div class="form-group">
              <label class="control-label" for="state"><?= $this->lang->line("State"); ?></label>
              <?= form_input('state', set_value('state',$store->state), 'class="form-control input-sm" id="state"');?>
            </div>
            <div class="form-group">
              <label class="control-label" for="postal_code"><?= $this->lang->line("Postal_code"); ?></label>
              <?= form_input('postal_code', set_value('postal_code',$store->postal_code), 'class="form-control input-sm" id="postal_code"');?>
            </div>
            <div class="form-group">
              <label class="control-label" for="country"><?= $this->lang->line("Country"); ?></label>
              <?= form_input('country', set_value('country',$store->country), 'class="form-control input-sm" id="country"');?>
            </div>
            <div class="form-group">
              <label class="control-label" for="currency_code"><?= $this->lang->line("currency_code"); ?></label>
              <?= form_input('currency_code', set_value('currency_code',$store->currency_code), 'class="form-control input-sm" id="currency_code"');?>
            </div>
            <div class="form-group">
              <label class="control-label" for="receipt_footer"><?= $this->lang->line("Bill Footer"); ?></label>
            <?= form_textarea('receipt_footer', set_value('receipt_footer',$store->receipt_footer), 'class="form-control redactor" id="receipt_footer"'); ?>
            </div>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
  </div>
</section>
