<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php //print_r($pay_info); ?>
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
     <?php echo form_open('sales/bankChackUpdate/'.$info->id); ?>
      <div class="modal-body">
        <div class="row"> 
          <?php if(($info->paid_by =="Cheque ✓") ||($info->paid_by =="Cheque")) { ?>
          <div class="col-sm-12">
            <div class="form-group">                
                <label>Bank Cheque:</label> <br>                 
                <input id="paid_by" name="paid_by" type="radio" class="" <?php if($info->paid_by =="Cheque ✓") echo "checked='checked'"; ?> value='Cheque ✓' />
                <label for="paid_by" class="">Approved</label>

                <input id="paid_by" name="paid_by" type="radio" class="" <?php if(($info->paid_by =="Cheque")||($info->paid_by=='')) echo "checked='checked'"; ?> value="Cheque" />
                <label for="paid_by" class="">No</label>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit"  class="btn btn-primary" value="Save" name="add_payment">
          </div>
          <?php } else echo '<p style="color:red; margin: 0px 20px 0px 50px">This is not Cheque Payment</p>';   ?>
        </div>
      </div>
    </div>
  </div>
   <?php echo form_close(); ?>
  </div>
