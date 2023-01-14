<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php //print_r($pay_info); ?>
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
     <?php echo form_open('sales/noteUpdate/'.$info->id); ?>
      <div class="modal-body">
        <div class="row">
          <?php if ($Admin) { ?>
          <div class="col-sm-12">
            <div class="form-group">
              <label for="note">Note</label>
              <?= form_textarea('note', set_value('note',$info->note), 'class="form-control tip redactor" id="note"'); ?>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit"  class="btn btn-primary" value="Save" name="add_payment">
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
   <?php echo form_close(); ?>
  </div>
