<style type="text/css">.table td:nth-child(3) { text-align: right; }</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <?php //$this->session->flashdata('success'); ?>

                </div>

                <div class="box-body"> 
                <div class="table-responsive">
 					<div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">

                        <div class="col-md-6">

                            <?php echo form_open_multipart("purchases/todayPurchasePayment", 'class="validation"'); ?>

                            <div class="form-group">
                               <?= lang('supplier', 'supplier'); ?>

                                <?php  $sp[''] = lang("select")." ".lang("supplier");

                                foreach($suppliers as $supplier) {

                                    $sp[$supplier->id] = $supplier->name;

                                } ?>

                                <?= form_dropdown('supplier', $sp, set_value('supplier'), 'class="form-control select2 tip" id="supplier"  required="required" style="width:100%;" '); ?>

                            </div>

                            <div class="form-group">
                                <?= lang("Paid Amount"); ?>

                                 <input type="text" name="paidamount" placeholder="<?= lang('Paid Amount'); ?>" id="paidamount" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <?= lang("note", 'note'); ?>

                                <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>

                            </div>
                            <div class="form-group">
                                <?= form_submit('add_purchase', lang('Purchase payment'), 'class="btn btn-primary"'); ?>

                                <button type="button" id="reset" class="btn btn-danger"><?= lang('reset'); ?></button>
                            </div>

                            <?php echo form_close();?>

                        </div>
                        <div class="col-md-6">                        
                            <span id="supplierInfo"><h3 class="box-title">Supplier information </h3></span>
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
     $("#supplier").change(function(){
         var supplierId = this.value;
         var url = '<?php echo base_url('purchases/supplierInfo') ?>'+'/'+supplierId;
         $('#supplierInfo').load(url);
         
        });
    });
</script>
<script type="text/javascript">    
        $(document).ready(function(){
        
          $("#paidamount").keyup(function(){            
             //alert(due_aamount);
            var amunt  = Number($( "#paidamount" ).val());
             if(amunt < 0 ){
                alert('Negative Value Not Allow');                
            }
             
            var due_aamount = Number($("#total_customer_deu").find(".due_amount").val());
              if(due_aamount < amunt){
                  $('#paidamount').val(due_aamount);
               }
          });
        });  
 </script>