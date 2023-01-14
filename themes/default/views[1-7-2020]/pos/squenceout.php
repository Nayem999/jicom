
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php //print_r($pay_info); ?>
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title .' ('.$item_qty.')'; ?></h4>
      </div>
    <?php y  ;?>
      <div class="modal-body">       
        <div class="row"> 
            <div class="col-sm-12">  
            <div class="form-group">
            <label class="control-label" for="code">Sequence</label>
              <?php  
                 $squenceValArray  = explode(',', $squenceVal) ;
              ?>
                <select id="sequout" name="sequencearry[]" multiple="multiple">
                <?php foreach ($info as $key => $value){ 

                  if(in_array($value->sequence_id,$squenceValArray)) { ?>

                <option value="<?php echo $value->sequence_id; ?>" selected disable="disable" ><?php echo $value->sequence; ?></option>
                 <?php }else{

                  if($value->status == 0  ){
                  ?>
                  <option value="<?php echo $value->sequence_id; ?>"  disable="disable" ><?php echo $value->sequence; ?></option>
                  <?php 
                          }
                        } ?>
                <?php } ?>                     
                </select>
                <input type="hidden" name="" value="<?= $squenceVal ?>" id="posarry">
               </div>
             
            </div>


            <div class="col-sm-12">
            <div class="form-group">
              <div class="modal-footer">
                  <input type="submit"  id="submit" class="btn btn-primary" onclick="posSquOut('<?php echo $row_no ?>')" value="Save" name="add_payment">
              </div> 
            </div>
        </div> 
        <script type="text/javascript">

          $(document).ready(function () {     
              // Options displayed in comma-separated list
              $('input[type="submit"]').attr('disabled',true );
              $("#sequout").ultraselect({oneOrMoreSelected: '*'}); 
              $(".selectAll").hide(); 

          });
          $('#sequout').on('change',function() {
          var squearray = $(this).val();
          var qty = "<?php echo $item_qty ?>"; 
          var arry = $(this).val(); 
          if(squearray.length==qty) {
            $('input[type="submit"]').removeAttr('disabled', true );
            $("input[type='checkbox']").attr("disabled", true); 
            $("input:checked").removeAttr("disabled",true); 
            // 
          } else {
            $("input[type='submit']").attr('disabled', true );
            $("input[type='checkbox']").removeAttr("disabled",true);
          
          }  
            $("#posarry").val(arry);

          }); 


         /* $(function() {
            enable_cb();
            $(".selectable").click(enable_cb);
          });

        function enable_cb() {
          if (this.checked) {
            $("input").removeAttr("disabled");
          } else {
            $("input").attr("disabled", true);
          }
        }*/

        </script>  
        </div>             
    </div>     
    </div>   
  </div>
</div> 



