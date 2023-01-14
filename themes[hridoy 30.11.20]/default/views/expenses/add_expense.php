
<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('enter_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <?= form_open_multipart("expenses/add_expense"); ?>

                        <?php if (($Admin) || ($Manager)) { ?>
                            <div class="form-group">
                                <?= lang("date", "date"); ?>
                                <?= form_input('date', (isset($_POST['date']) ? $_POST['date'] : ""), 'class="form-control datetimepicker" id="date" required="required"'); ?>
                            </div>
                            <?php } ?> 
                            <div class="form-group">
                               <?= lang('Type', 'Type'); ?>*
                               <select class="form-control select2 tip" name="type" required="required" id="type">
                                 <option value="">Select</option>
                                 <option value="cash">Cash</option>
                                 <option value="cheque">Cheque</option>
                                 <option value="card">Card</option>
                               </select>
                            </div>
                            <div id="bankInfo"></div> 
                            <?php if($this->session->userdata('store_id')==0){ ?>
                            <div class="form-group">
                                <?= lang('Warehouse','Warehouse'); ?>
                                <?php
                                $wr[''] = lang("select")." ".lang("warehouse");
                                foreach($warehouses as $warehouse) {
                                    $wr[$warehouse->id] = $warehouse->name;
                                }
                                ?>
                                <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="from-warehouse" required="required" style="width:100%;"'); ?> 
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                    <?= lang('category', 'category'); ?>
                                    <?php
                                    $cat[''] = lang("select")." ".lang("category");
                                    foreach($categories as $category) {
                                        $cat[$category->cat_id] = $category->name;
                                    }
                                    ?>
                                    <?= form_dropdown('category', $cat, set_value('category'), 'class="form-control select2 tip" id="category"  required="required" style="width:100%;"'); ?>
                                </div>

                            <div class="form-group">
                                <?= lang("reference", "reference"); ?>
                                <?= form_input('reference', (isset($_POST['reference']) ? $_POST['reference'] : ''), 'class="form-control tip" id="reference" required="required"'); ?>
                            </div>

                            <div class="form-group">
                                <?= lang("amount", "amount"); ?>
                                <input name="amount" type="text" id="amount" value="" class="pa form-control kb-pad amount"
                                required="required"/>
                            </div>

                            <div class="form-group">
                                <?= lang("attachment", "attachment") ?>
                                <input id="attachment" type="file" name="userfile" data-show-upload="false" data-show-preview="false"
                                class="form-control file">
                            </div>

                            <div class="form-group">
                                <?= lang("note", "note"); ?>
                                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : ""), 'class="form-control redactor" id="note"'); ?>
                            </div>

                            <div class="form-group">
                                <?php echo form_submit('add_expense', lang('add_expense'), 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</section>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>
<script type="text/javascript">
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