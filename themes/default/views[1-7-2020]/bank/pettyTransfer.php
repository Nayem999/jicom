<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php //print_r($pay_info); ?>
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
     <?php echo form_open('bank/bankTopetty/'); ?>
      <div class="modal-body">
        <div class="row"> 
          <div class="col-sm-12">
              <div class="col-sm-8">
              <div class="form-group">
                  <?= lang('Warehouse','Warehouse'); ?>
                    <?php
                      $wr[''] = lang("select")." ".lang("warehouse");
                      foreach($warehouses as $warehouse) {
                          $wr[$warehouse->id] = $warehouse->name;
                      }
                      ?>
                     <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip warehouse" id="stores" required="required" style="width:100%;"'); ?> 
                </div>
              </div> 
            <div class="col-sm-8">
            <span id="getBnakInfo"></span>
              <!-- <div class="form-group">  
                <?= lang('Bank Name '); ?>
                    <?php  $sp[''] = lang("select")." ".lang("Bank");
                    foreach($bankAcount as $bank) {
                        $sp[$bank->bank_account_id] = $bank->bank_name .' ('.$bank->account_name.' ) ( '.$bank->account_no.')';
                    } ?>
                    <?= form_dropdown('bank', $sp, set_value('bank'), 'class="form-control select2 tip" required="required" style="width:100%;" '); ?>
              </div> -->
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                <label for="note">Amount</label>
                  <input type="text" name="amount" class="form-control tip">
                </div>
              </div>
              <div class="form-group">
              <div class="col-sm-10">
                <label for="note">Note</label>
                 <?= form_textarea('tran_note', set_value('tran_note',$transaction->tran_note), 'class="form-control tip redactor" id="tran_note"'); ?>
              </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
              <div class="modal-footer">
              <input type="submit"  class="btn btn-primary" value="Save" name="add_payment">
            </div> 
            </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </div>
   <?php echo form_close(); ?>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#stores').on('change', function () {
     var store_id = $("#stores option:selected").val();
     var site_url = "<?php echo site_url('bank/getbankByStoreID'); ?>/" +store_id; //append id at end
      $("#getBnakInfo").load(site_url); 
    }); 
    }); 
  </script>