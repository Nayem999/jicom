
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php //print_r($pay_info); ?>
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title .' ('.$qty.')'; ?></h4>
      </div>
    <?php y  ;?>
      <div class="modal-body">       
        <div class="row"> 
            <div class="col-sm-12">  
                <select id="sequout" name="sequence[]" multiple="multiple" >
                <?php $sequence = $this->site->getWhereDataByElement('pro_sequence','pro_id','sales_id',$pid,$sid); 
                
                  foreach ($sequence as $key => $value){  ?>
                  <option value="<?php echo $value->sequence_id; ?>"><?php echo $value->sequence;?></option>
                  <?php } ?>                    
                </select>
                <input type="hidden" name="" value="" id="posarry">
            </div>
            <div class="col-sm-12">
            <div class="form-group">
              <div class="modal-footer">
                  <input type="submit"  id="submit" class="btn btn-primary" onclick="reSquOut('<?php echo $row_no ?>')" value="Save" name="add_payment">
              </div> 
            </div>
        </div> 
        <script type="text/javascript">          

          $(document).ready(function () {       
              $("#sequout").ultraselect({oneOrMoreSelected: '*'}); 
              $(".selectAll").hide(); 

              $('#sequout').on('change',function() {
              var squearray = $(this).val(); 
              var qty = "<?php echo $qty ?>"; 
              var arry = $(this).val(); 
              if(squearray.length==qty) { 
                $("input[type='checkbox']").attr("disabled", true); 
                $("input:checked").removeAttr("disabled",true); 
                // 
              } else { 
                $("input[type='checkbox']").removeAttr("disabled",true);             
            }  
            $("#posarry").val(arry);

          }); 

          });

        </script>  
        </div>             
    </div>     
    </div>   
  </div>
</div> 



