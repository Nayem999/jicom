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
                               <?= lang('Customer'); ?>*

                                <?php  $sp[''] = lang("select")." ".lang("Customer");

                                foreach($customers as $customer) {

                                    $sp[$customer->id] = $customer->name.' ('.$this->site->findeNameByID('stores','id',$customer->store_id)->name.')';

                                } ?>

                                <?= form_dropdown('customer', $sp, set_value('customer'), 'class="form-control select2 tip" id="customer"  required="required" style="width:100%;" '); ?>

                            </div>

                            <div class="form-group">
                               <?= lang('Type', 'Type'); ?>*
                               <select class="form-control select2 tip" name="type" required="required" id="type">
                                 <option value="">Select</option>
                                 <option value="cash">Cash</option>
                                 <option value="cheque">Cheque</option>
                                 <option value="TT">TT</option>
                                 <option value="card">Card</option>
                               </select>
                            </div>
                            <div id="bankInfo"></div>
                            <div class="form-group">
                                <?= lang("Paid Amount"); ?>*

                                <input type="text" name="colAmount" placeholder="<?= lang('Collection Amount'); ?>" id="colAmount" value="" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <?= lang("note", 'note'); ?>

                                <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>

                            </div>
                            <div class="form-group">
                                <?= form_submit('add_purchase', lang('Collect Now'), 'class="btn btn-primary"'); ?>

                                 
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
        // $('#colAmount').val('0');
         var supplierId = this.value;
         var url = '<?php echo base_url('collection/customerInfo') ?>'+'/'+supplierId;
         $('#supplierInfo').load(url);
        // alert(url);
         
        });
    });

    $(function(){

        $("#type").change(function(){
         var supplier_id = $('#supplier').val();          
         var paymentType = this.value;         
         var url = '<?php echo base_url('collection/bankInfo') ?>/'+paymentType;   
           
         $('#bankInfo').load(url, function(e){
            console.log(e);
         });

         
        });
    });
</script>



