<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?php echo lang('add_payment'); ?></h4>           
        </div>        
        <?= form_open_multipart("merge/mergeLaser"); ?>
        <div class="modal-body">
            <p><?= lang('enter_info'); ?></p>
            <div class="col-sm-6">
                <p><strong>Suplier Information</strong></p>
                <?php foreach ($suppInfo as $key => $value) {
                    echo " Name : ".$value->name .'<br>';
                    echo " Phone : ".$value->phone.'<br>';
                    echo " Email : ".$value->email.'<br>';
                      $suppID = $value->id;
                } ?>
                <p><?php  echo "Payable Amount : " .$payAmount; ?></p>
                 
            </div>
            <div class="col-sm-6">
                <p><strong>Customer information</strong></p>
                <?php foreach ($cusInfo as $key => $value) {
                    echo " Name : ".$value->name .'<br>';
                    echo " Phone : ".$value->phone.'<br>';
                    echo " Email : ".$value->email.'<br>';
                      $cusID = $value->id;
                } ?>
                <p><?php  echo "Receivable Amount : " .$recAmount; ?></p>
            </div> 

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?= lang("amount", "Amount"); ?>
                        <?= form_input('amount', set_value('amount'), 'class="form-control tip" id="amount"'); ?>
                    </div>
                    <input type="hidden" name="cid" value="<?php echo $cusID ;?>">
                    <input type="hidden" name="sid" value="<?php echo $suppID ;?>">
                    <input type="hidden" class="sup_amount" value="<?= $payAmount; ?>">
                    <input type="hidden" class="cus_amount" value="<?= $recAmount; ?>">
                </div>
            </div> 
    <div class="form-group">
        <?= lang("note", "note"); ?>
        <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ""), 'class="form-control redactor" id="note"'); ?>
    </div>

</div>
<div class="modal-footer">
    <?php echo form_submit('add_payment', lang('add_payment'), 'class="btn btn-primary"'); ?>
</div>
</div>
<?php echo form_close(); ?>
</div>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= $assets ?>dist/js/parse-track-data.js" type="text/javascript"></script>
<script src="<?= $assets ?>dist/js/pages/modal.js" type="text/javascript"></script>
  <script type="text/javascript">    
        $(document).ready(function(){
        
          $("#amount").keyup(function(){
            
             //alert(due_aamount);
            var amunt  = Number($("#amount").val());
            var supamount  = Number($(".sup_amount").val());
            var cusamount  = Number($(".cus_amount").val());
            if(amunt < 0 ){
                alert('Negative Not Value Allow');
                $('#amount').val('');
            } 
            if(supamount > cusamount){
                var due_aamount = Number($(".cus_amount").val());
                  if(due_aamount < amunt){
                      $('#amount').val(due_aamount);
                   }
            }

            if(supamount < cusamount){
                var due_aamount = Number($(".sup_amount").val());
                  if(due_aamount < amunt){
                      $('#amount').val(due_aamount);
                   }
            }

          });
        });  
 </script>  