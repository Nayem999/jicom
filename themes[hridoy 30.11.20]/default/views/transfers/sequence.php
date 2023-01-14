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
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div> 
      <div class="modal-body">  
        <div class="row"> 
          <div class="col-sm-12">
            <div class="form-group" id="some_div" onclick="update()">              
                <?php
                 $i = 0 ;  
                  <input type="hidden" id="arry" name="arry" value="">
            </div>
          </div>
          <div class="modal-footer">
          <input type="submit" id="submit"  class="btn btn-primary" onclick="transferSequence('<?php echo $row_no ?>')" value="Save" name="add_payment">
           
          </div> 
        </div> 
      </div>
    </div>
  </div> 
  </div> 
  
  <script type="text/javascript">  
 function transferSequence(row_no){
            var sequence = $('#arry').val();
            var site_url = "<?php echo site_url('purchases/SeqcheckDB'); ?>/"+sequence; 
            $("#erro_all").load(site_url, function(e){              
              if(e ==''){
                var row = $('#getsequence-'+row_no).closest('tr');
                var new_setval = $('#arry').val(),
                item_id = row.attr('data-item-id');
                tspoitems[item_id].row.setval = new_setval;
                store('tspoitems', JSON.stringify(spoitems));
                prid22 = '';
                loadItems(prid22);
                 $( ".posModal" ).hide()
              }

            });

    }
  </script>