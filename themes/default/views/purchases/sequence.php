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
                $errorCount = 0;
                $i = 0 ; 
                 //print_r($squNo);
                if($allSequence == 'add'){

                foreach ($squNo as $key => $value) {
                    $i++ ; 
                    echo '<div class="form-group"><label class="control-label">Sequence '.$i.' : </label>';
                    echo ' <input type="text" id="id_'. $i .'" onblur="checkDB('. $i .')"  name="sequencearry[]" value="'.$value.'">
                    <a id="erro_'. $i .'" class="error"></a><br>';
                    if (in_array($value,$filtersq)) {
                        $errorCount++;
                         echo '<span id="error'.$i.'" class="error error-dada">This sequence Already taken ('. $value.')</span>';
                      } 
                       echo '</div>';
                    };
                 }else{
                 
                  $allSequence = trim($allSequence,",");
                  $allSequence = (explode(",",$allSequence)) ;
                  
                  $seqCount = count($allSequence);
                  $newSeq = $qty- $seqCount ;
                  foreach ($allSequence as $key => $value) {
                    $i++ ; 
                    if($value !=''){
                    echo '<div class="form-group"><label class="control-label">Sequence '.$i.' : </label>';
                    echo ' <input type="text" id="id_'. $i .'" onblur="checkDB('. $i .')"  name="sequencearry[]" value="'.$value.'">
                    <a id="erro_'. $i .'" class="error"></a><br>';
                    if (in_array($value,$filtersq)) {
                        $errorCount++;
                         echo '<span id="error'.$i.'" class="error error-dada">This sequence Already taken ('. $value.')</span>';
                      } 
                       echo '</div>';
                    };
                    if($i == $qty){
                       break; 
                    }
                  }
                  $startsqe = $startsqe+$seqCount ;
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
                      $startsqe++ ;
                  }

                 }
                
                ?>
                  <input type="hidden" id="arry" name="arry" value="">
            </div>
          </div>
          <div class="modal-footer">
          <p id="erro_all"></p>
          <input type="submit" id="submit"  class="btn btn-primary" onclick="setsequence('<?php echo $row_no ?>')" value="Save" name="add_payment">
           
          </div> 
        </div> 
      </div>
    </div>
  </div> 
  </div> 
  <script type="text/javascript"> 
    function checkDB(data){ 
      var arry = '';
      var returndata ='';
      var errmsg='';
      $('input[name^="sequencearry"]').each(function() {
        arry = arry+$(this).val()+',';
      });
      //alert(arry);
      var value = $("#id_"+data).val(); 
      var site_url = "<?php echo site_url('purchases/checkDB'); ?>/"+value; //append id at end
     returndata =  $("#erro_"+data).load(site_url);

      $("#erro_"+data).val(arry);
      $("#error"+data).hide();     
      $("#arry").val(arry);
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
      var returndata ='';
      var errmsg='';
      $('input[name^="sequencearry"]').each(function() {
        arry = arry+$(this).val()+',';
      });

      $("#arry").val(arry);

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