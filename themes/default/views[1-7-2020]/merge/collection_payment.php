<style type="text/css">.table td:nth-child(3) { text-align: right; }</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>

                </div>

                <div class="box-body"> 
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">

                        <div class="col-md-6">

                            <?php echo form_open_multipart("collection/todayCollectionPayment", 'class="validation"'); ?>

                            <div class="form-group">
                               <?= lang('Customer'); ?>

                                <?php  $sp[''] = lang("select")." ".lang("Customer");

                                foreach($customers as $customer) {

                                    $sp[$customer->id] = $customer->name;

                                } ?>

                                <?= form_dropdown('customer', $sp, set_value('customer'), 'class="form-control select2 tip" id="customer"  required="required" style="width:100%;" '); ?>

                            </div>

                            <div class="form-group">
                                <?= lang("Paid Amount"); ?>

                                 <input type="text" name="colAmount" placeholder="<?= lang('CollectionAmount'); ?>" id="colAmount" value="" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <?= lang("note", 'note'); ?>

                                <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>

                            </div>
                            <div class="form-group">
                                <?= form_submit('add_purchase', lang('Payment collection'), 'class="btn btn-primary"'); ?>

                                <button type="button" id="reset" class="btn btn-danger"><?= lang('reset'); ?></button>
                            </div>

                            <?php echo form_close();?>

                        </div>
                        <div class="col-md-6">                        
                            <span id="supplierInfo"><h3 class="box-title">Customer information </h3></span>
                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>

<script>
    $(function(){
     $("#customer").change(function(){
         $('#colAmount').val('0');
         var supplierId = this.value;
         var url = '<?php echo base_url('collection/customerInfo') ?>'+'/'+supplierId;
         $('#supplierInfo').load(url);
        // alert(url);
         
        });
    });
</script>

<script type="text/javascript">    
        $(document).ready(function(){
        
          $("#colAmount").keyup(function(){
            
             //alert(due_aamount);
            var amunt  = Number($("#colAmount").val());
            if(amunt < 0 ){
                alert('Negative Not Value Allow');
            }
            var due_aamount = Number($("#total_customer_deu").find(".due_amount").val());
              if(due_aamount < amunt){
                    $('#colAmount').val(due_aamount);
               }

          });
        });  
 </script>
