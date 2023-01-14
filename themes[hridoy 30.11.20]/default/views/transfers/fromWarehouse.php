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
        <h4 class="modal-title" id="myModalLabel"><?php echo $page_title; ?></h4>
      </div> 
      <div class="modal-body">  
        <div class="row"> 
          <div class="col-sm-12">
          <?php echo form_open_multipart("transfers/selectFromWarehouse", 'class="validation"'); ?>
            <div class="form-group" id="some_div" onclick="update()">              
                <?php if($this->Admin){ ?>
                    <div class="form-group">
                          <?= lang('From Warehouse','From Warehouse'); ?>
                          <?php
                          $wr[''] = lang("select")." ".lang("warehouse");
                          foreach($warehouses as $warehouse) {
                              $wr[$warehouse->id] = $warehouse->name;
                          }
                          ?>
                          <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="fromwarehouse" required="required" style="width:100%;"'); ?> 
                </div>
            <?php } ?>
            </div>
            <div class="modal-footer">
          <input type="submit" id="submit"  class="btn btn-primary" value="Next" name="add_payment">
           
          </div>
          <?php echo form_close();?>
          </div>           
        </div> 
      </div>
    </div>
  </div> 
  </div>  