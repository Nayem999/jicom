<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div>
      <?php //print_r($info); ?>
     <?php echo form_open('bank/salary_cheque_approved/'.$id, 'class="validation"'); ?>
      <div class="modal-body">
        <div class="row">
          <?php if ($Admin) { 
            $banks = $this->site->getAllBanks(); 
            ?>
          <div class="col-sm-10"> 
              <div class="form-group">
                <label for="note">Amount = <?php echo $info->amount; ?></label>
                <input type="hidden" name="amount" value="<?php echo $info->amount; ?>">
               </div>   
              <div class="form-group">                
                <label>Bank Cheque:</label> <br>                 
                <input id="paid_by" name="paid_by" type="radio" class="" <?php if($info->bank_status =="Approved") echo "checked='checked'"; ?> value='Approved' />
                <label for="paid_by" class="">Approved</label>

                <input id="paid_by2" name="paid_by" type="radio" class="" <?php if(($info->bank_status =="Pending") ) echo "checked='checked'"; ?> value="Pending"   />
                <label for="paid_by" class="">No</label>
              </div>
              <div class="form-group">
                 <label for="paid_by" class=""><?= lang('Select Bank'); ?>*</label>
                 
                  <?php   
                  $bk[''] = 'Select Bank';
                  foreach($banks as $value) {
                      $bk[$value->bank_account_id] = $value->bank_name .' ('.$value->account_name.' ) ( '.$value->account_no.')'; 
                  } ?>
                  <?= form_dropdown('bank_id', $bk, set_value('bank_id', $info->bank_id), 'class="form-control select2 tip" id="bank_id"  required="required" style="width:100%;" '); ?> 
                   
              </div>
                
              </div> 
              <div class="col-sm-12">
                <div class="form-group">
                  <div class="modal-footer">
                    <input type="submit" id="submit_button" class="btn btn-primary" value="Save" name="add_payment">
                  </div> 
                </div>
              </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
   <?php echo form_close(); ?>
  </div>
  <script type="text/javascript">
    
    $("#submit_button").attr("disabled", "disabled");
    $("#paid_by").change(function(){ 
      var status = "<?= $info->bank_status; ?>";
        if( $(this).is(":checked") ){ 
            var val = $(this).val();
            
          if(val == status){
            alert("This cheque is approved!");  
            $("#submit_button").attr("disabled", "disabled");
          }else{
            $("#submit_button").attr("disabled", false);
          }
        }
    });
    $("#paid_by2").change(function(){ 
      var status = "<?= $info->bank_status; ?>";
        if( $(this).is(":checked") ){ 
            var val = $(this).val();  
            
            if(val == status){
               alert("This cheque is pending!");  
              $("#submit_button").attr("disabled", "disabled");
            }else{
              $("#submit_button").attr("disabled", false);
            }
        }

    });
  </script>
