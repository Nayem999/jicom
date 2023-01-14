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
       <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button> 
        <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
      </div> 
      <div class="modal-body">  
        <div class="row"> 
          <div class="col-sm-12">
            <div class="form-group" id="some_div" onclick="update()">              
                <?php
                $errorCount = 0;
                $i = 0 ; 
                  //$allSequence = trim($allSequence,",");
                  //$allSequence = (explode(",",$allSequence)) ;
                  if($results){
                    $seqCount = count($results);
                  }else{
                   $seqCount = 0 ; 
                  }
                  
                  $newSeq = $qty- $seqCount ;

                  foreach ($results as $key => $value) {
                    $i++ ; 
                    $out = '';
                    if($value !=''){
                    $out .= '<div class="form-group"><label class="control-label">Sequence '.$i.' : </label>';
                    if($value->status == 0){
                      $out .=  ' <input type="text" id="id_'. $i .'" onblur="checkDB('. $i .')"  name="sequencearry[]" value="'.$value->sequence.'"> ';
                      $out .=  ' <input type="hidden" id="id2_'. $i .'" onblur="checkDB('. $i .')"  name="sequenId[]" value="'.$value->sequence_id.'">';
                      $out .=  '<a id="erro_'. $i .'" class="error"></a><br>'; 
                    }else{

                      $out .=  ' <input type="text" id="id_'. $i .'"  readonly="" class="readonly" value="'.$value->sequence.'"> Sale';
                      $out .=  '<a id="erro_'. $i .'" class="error"></a><br>'; 

                    }
                     $out .=  '</div>';
                     echo $out ;
                    };
                    if($i == $qty){
                     //  $startsqe ++ ;
                       break; 
                    }
                  }
                  if($results){
                   $startsqe = $startsqe + 1 ;
                  }
                 
                  for($i2 = 0 ; $i2 < $newSeq ; $i2++){
                     $i++;

                     echo '<div class="form-group"><label class="control-label">Sequence '.$i.' : </label>';
                     echo ' <input type="text" id="id_'. $i .'" onblur="checkDB('. $i .')"  name="sequencearry[]" value="'.$startcr.$startsqe.'">
                     <a id="erro_'. $i .'" class="error"></a><br>';
                      if (in_array($startcr.$startsqe,$filtersq)) {
                        $errorCount++;
                         echo '<span id="error'.$i.'" class="error error-dada">This sequence Already taken ('. $startcr.$startsqe.')</span>';
                      }
                      echo '</div>';

                      $startsqe ++ ;
                      
                  }

                ?>
                  <input type="hidden" id="arry" name="arry" value="">

                  <input type="hidden" id="arryID" name="arryID" value="">
            </div>
          </div>
          <div class="modal-footer">
          <p id="erro_all"></p>
          <input type="submit" id="submit"  class="btn btn-primary" onclick="setsequenceEdit('<?php echo $row_no ?>')" value="Save" name="add_payment">
           
          </div> 
        </div> 
      </div>
    </div>
  </div> 
  </div> 
  <script type="text/javascript"> 
    function checkDB(data){ 
      var arry = '';
      var arryID = '';
      var returndata ='';
      var errmsg='';
      $('input[name^="sequencearry"]').each(function() {
        arry = arry+$(this).val()+',';
      });

      $('input[name^="sequenId"]').each(function() {
        arryID = arryID+$(this).val()+',';
      });
      //alert(arryID);
      
      //alert(arry);
      var value = $("#id_"+data).val(); 
      var seqId = $("#id2_"+data).val(); 
     // alert(seqId);
      var site_url = "<?php echo site_url('purchases/checkDBedit'); ?>/"+value+'/'+seqId; //append id at end
     // alert(site_url);
     returndata =  $("#erro_"+data).load(site_url);

      $("#erro_"+data).val(arry);

      $("#error"+data).hide();     
      $("#arry").val(arry);
      $("#arryID").val(arryID);
      
      //submit button control

      
       
      var errorCount = $("#errorCount").val();

      errmsg = $("#erro_"+data).text();
     // alert(errmsg);

      if( Number(errorCount)  > 0){
        // alert(errorCount); 
          $("#submit").hide();
      }else {
         $("#submit").show();
      } 
    } 

    $( document ).ready(function() {

      var arry = '';
      var arryID = '';
      var returndata ='';
      var errmsg='';
      $('input[name^="sequencearry"]').each(function() {
        arry = arry+$(this).val()+',';
      });

      $('input[name^="sequenId"]').each(function() {
        arryID = arryID+$(this).val()+',';
      });

      $("#arry").val(arry);
      $("#arryID").val(arryID);
       var  errorCount = $("#errorCount").val();

     
      //if( Number(errorCount)  > 0){
         //alert(errorCount); 
       //   $("#submit").hide();
      //}else {
      //   $("#submit").show();
      //} 

      //submit button control     
    });
  </script>
  <style type="text/css">
    .readonly{
      background: #efefef;
      border: none;
      color: #e77979;
      }
  </style>