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
                        <?php echo form_open_multipart("supplierpayment/todayPurchasePayment", 'class="validation"'); ?>
                            <div class="form-group">
                               <?= lang('supplier', 'supplier'); ?>

                                <?php  $sp[''] = lang("select")." ".lang("supplier");

                                foreach($suppliers as $supplier) {

                                    $sp[$supplier->id] = $supplier->name.' ('.$this->site->findeNameByID('stores','id',$supplier->store_id)->name.')';

                                } ?>

                                <?= form_dropdown('supplier', $sp, set_value('supplier'), 'class="form-control select2 tip" id="supplier"  required="required" style="width:100%;" '); ?>

                             </div>
                             

                             <div class="form-group">
                               <?= lang('Type', 'Type'); ?>
                               <select class="form-control select2 tip" name="type" required="required" id="type">
                                 <option value="">Select</option>
                                 <option value="cash">Cash</option>
                                 <option value="Cheque">Cheque</option>
                                 <option value="TT">TT</option>
                               </select>
                             </div>
                             <div>
                             <div class="form-group" id="bankInfo"></div> 
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
         var url = '<?php echo base_url('supplierpayment/supplierInfo') ?>'+'/'+supplierId;
         $('#supplierInfo').load(url); 
         //$('#type').val(NULL); 
        });
    }); 
</script>
<script>
    $(function(){
     $("#type").change(function(){
        document.getElementById("bankInfo").innerHTML = "";
         var supplier_id = $('#supplier').val();          
         var paymentType = this.value;         
         var url = '<?php echo base_url('supplierpayment/bankInfo') ?>'+'/'+paymentType+'/'+supplier_id;          
         $('#bankInfo').load(url);
         
        });
    });
    $(function(){
     $("#warehouse").change(function(){
         var store_id = this.value;         
         var url = '<?php echo base_url('supplierpayment/getSupplierByStore') ?>'+'/'+store_id;          
         $('#supplierinfo').load(url);
         
        });
    });

</script>
 