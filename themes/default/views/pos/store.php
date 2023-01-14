<style type="text/css">
  .error{
    color: red;
  }
</style>
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header"> 
        <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
      </div> 
      <?= form_open_multipart($action); ?>
      <div class="modal-body">  
        <div class="row"> 
          <div class="col-sm-10">



            
                    <?php
                              
                    //  $store[''] = lang("select")." Select store";
                     $store1[] = "Select store";

                     foreach($store as $storeInfo){  
                       
                      //$store1[$storeInfo->id] = $storeInfo->name.$cPhone; 
                      $store1[$storeInfo->id] = $storeInfo->name; 
                      } 
                      // echo "<pre>".print_r($store);
                      
                      ?>
                    <?= form_dropdown('store_id', $store1, set_value('store_id'), 'id="spos_store"  data-placeholder="Select store" required="required" class="form-control select2" style="width:100%;"'); ?>
                 
                  
                  <div style="clear:both;"></div>
                
            <div class="form-group" id="some_div" onclick="update()">      
            </div>
          </div>
          <div class="modal-footer">
          <p id="erro_all"></p>
          <input type="submit" id="submit"  class="btn btn-primary"  value="Save" name="add_payment">
           
          </div> 
        </div> 
      </div>
      <?php echo form_close(); ?>
    </div>
  </div> 
  </div> 
  <script type="text/javascript"> 
   
  </script>