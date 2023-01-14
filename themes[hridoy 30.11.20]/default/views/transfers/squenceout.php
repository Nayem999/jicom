
<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php //print_r($pay_info); ?>
      <div class="modal-header">
        <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title .'('.$item_qty.')'; ?></h4>
      </div>
    
      <div class="modal-body">       
        <div class="row"> 
            <div class="col-sm-12">    
             
              <?php  
                 $squenceValArray  = explode(',', $sequence) ;
                // print_r($squenceValArray); 
                // print_r($info);
               ?>          
                <select id="sequout" name="sequencearry[]" multiple="multiple">
           

                  <?php foreach ($info as $key => $value){ 

                  if($value->status ==0 ){

                    if(in_array($value->sequence,$squenceValArray)) { ?>

                    <option value="<?php echo $value->sequence; ?>" selected disable="disable" ><?php echo $value->sequence; ?></option>
                     <?php }else{ ?>
                      <option value="<?php echo $value->sequence; ?>"  disable="disable" ><?php echo $value->sequence; ?></option> 
                      <?php 
                          } ?>
                <?php } 
                }
                ?>   



                </select> 
            </div>
            <div class="col-sm-12">
            <div class="form-group">
              <div class="modal-footer">
                  <input type="hidden" id="transferSqArry" name="transferSqArry">
                  <input type="submit" id="submit" class="btn btn-primary" onclick="transferSquOut('<?php echo $row_no ?>')" value="Save" name="add_payment">
              </div> 
            </div>
        </div> 
        <script type="text/javascript">

          $(document).ready(function () {     
              // Options displayed in comma-separated list
              $("#sequout").ultraselect({oneOrMoreSelected: '*'}); 
              $('input[type="submit"]').attr('disabled',true );
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
            $("#transferSqArry").val(arry);

          }); 

        function transferSquOut(row){ 
              var sequence = $('#transferSqArry').val(); 
              var row = $('#getsequence-'+row).closest('tr');
              var new_setval = $('#transferSqArry').val(),
              item_id = row.attr('data-item-id');
              tspoitems[item_id].row.sqtrans = new_setval;  
              store('tspoitems', JSON.stringify(tspoitems));
              trnsid = '';
              loadItems(trnsid);
              $( ".posModal" ).hide();    
            }
        </script>  
        </div>             
    </div>     
    </div>   
  </div>
</div> 



