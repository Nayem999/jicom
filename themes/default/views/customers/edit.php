<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"><?= lang('update_info'); ?></h3>
        </div>
        <div class="box-body">
          <?php echo form_open("customers/edit/".$customer->id);?>

          <div class="col-md-6">
          <?php if($this->session->userdata('store_id')==0){ ?>
            <div class="form-group">
                <?= lang('From Store','From Store'); ?>
                <?php
                $wr[''] = lang("select")." ".lang("Store");
                foreach($stores as $store) {
                  $wr[$store->id] = $store->name;
                }
                ?>
                <?= form_dropdown('store_id', $wr, $customer->store_id, 'class="form-control select2 tip" id="from-store_id" required="required" style="width:100%;"'); ?> 
            </div>
            <?php } ?>
            <div class="form-group">
              <label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>
              <?= form_input('name', set_value('name', $customer->name), 'class="form-control input-sm" id="name"'); ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>
              <?= form_input('email', set_value('email', $customer->email), 'class="form-control input-sm" id="email_address"'); ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>
              <?= form_input('phone', set_value('phone', $customer->phone), 'class="form-control input-sm" id="phone"');?>
            </div>

            <div class="form-group">
              <label class="control-label" for="cf1"><?= $this->lang->line("ccf1"); ?></label>
              <?= form_input('cf1', set_value('cf1', $customer->cf1), 'class="form-control input-sm" id="cf1"'); ?>
            </div>

            <div class="form-group">
              <label class="control-label" for="cf2"><?= $this->lang->line("ccf2"); ?></label>
              <?= form_input('cf2', set_value('cf2', $customer->cf2), 'class="form-control input-sm" id="cf2"');?>
            </div>

            <div class="form-group">
              <label class="control-label" for="opening_blance"><?= $this->lang->line("Opening Balance "); ?></label>
              <?= form_input('opening_blance', set_value('opening_blance',$customer->opening_blance), 'class="form-control input-sm" id="cf2"');?>
            </div>

            <div class="form-group">
              <label class="control-label" for="credit_limit"><?= $this->lang->line("Credit Limit"); ?></label>
              <?= form_input('credit_limit', set_value('credit_limit',$customer->credit_limit), 'class="form-control input-sm" id="credit_limit"');?>
            </div>

            <div class="form-group">
              <?php echo form_submit('edit_customer', $this->lang->line("edit_customer"), 'class="btn btn-primary"');?>
            </div>
          </div>
          <?php echo form_close();?>
        </div>
      </div>
    </div>
  </div>
</section>
