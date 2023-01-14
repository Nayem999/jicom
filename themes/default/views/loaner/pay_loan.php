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
                            <?php echo form_open_multipart("loan/pay_loan", 'class="validation"'); ?>
                            <div class="form-group">
                               <?= lang('Loaner'); ?>*
                                <?php  $sp[''] = lang("select")." ".lang("Loaner");
                                foreach($loaner as $loan) {
                                    $sp[$loan->id] = $loan->name;
                                } ?>
                                <?= form_dropdown('loaner', $sp, set_value('loaner'), 'class="form-control select2 tip" id="loaner"  required="required" style="width:100%;" '); ?>

                            </div>
                            <div class="form-group">
                               <?= lang('Type', 'Type'); ?>
                               <select class="form-control select2 tip" name="payment_type" required="required" id="type">
                                 <option value="">Select</option>
                                 <option value="cash">Cash</option>
                                 <option value="cheque">Cheque</option>
                                 <option value="card">Card</option>
                               </select>
                            </div>
                            <div>
                                <div class="form-group" id="bankInfo"></div> 
                            </div>
                            <div class="form-group">
                                <?= lang("date"); ?>
                                 <input type="text" name="date" id="date" value="<?= date('Y-m-d H:i:s'); ?>" class="form-control datetimepicker">
                            </div>
                            <div class="form-group">
                                <?= lang("Amount"); ?>*
                                 <input type="text" name="amount" placeholder="<?= lang('Amount'); ?>" id="amount" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <?= lang("note", 'note'); ?>

                                <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>
                            </div>
                            <div class="form-group">
                                <?= form_submit('add_loan', lang('Save'), 'class="btn btn-primary"'); ?>
                                <button type="button" id="reset" class="btn btn-danger"><?= lang('reset'); ?></button>
                            </div>
                            <?php echo form_close();?>
                        </div>
                        <div class="col-md-6">                        
                            <span id="lonarInfo"><h3 class="box-title">Loaner information </h3></span>
                        </div>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
<script>
    $(function(){
     $("#loaner").change(function(){ 
         var loanerId = this.value;
         var url = '<?php echo base_url('loan/loanerInfo') ?>'+'/'+loanerId;
         $('#lonarInfo').load(url);          
        });
    });

    $("#type").change(function(){
        var supplier_id = $('#supplier').val();          
        var paymentType = this.value;         
        var url = '<?php echo base_url('loan/bankInfo') ?>'+'/'+paymentType+'/'+supplier_id;  
            
        $('#bankInfo').load(url);
     
    });
</script> 
