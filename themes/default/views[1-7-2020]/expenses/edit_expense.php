

<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?> 

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('update_info'); ?></h3>

                </div>

                <div class="box-body">

                    <div class="col-md-6">

                        <?= form_open_multipart("expenses/edit_expense/".$expense->id); ?>

                        <?php if (($Admin) || ($Manger)) { ?>

                            <div class="form-group">

                                <?= lang("date", "date"); ?>

                                 <?php 
                                  if($expense->emp_pay_id !=NULL){ ?>
                                   <?= form_input('date', (isset($_POST['date']) ? $_POST['date'] : $expense->date), 'class="form-control datetimepicker" id="date" readonly="readonly" required="required"'); ?>
                                <?php }else{ ?>
                                  <?= form_input('date', (isset($_POST['date']) ? $_POST['date'] : $expense->date), 'class="form-control datetimepicker" id="date" required="required"'); ?>
                                <?php } ?>

                            </div>

                            <?php } ?> 

                            <?php if($this->session->userdata('store_id')==0){ ?>
                            <div class="form-group">
                                <?= lang('From Warehouse','From Warehouse'); ?>
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
                                    <?= form_dropdown('category', $cat, $expense->c_id, 'class="form-control select2 tip" id="category"  required="required"'); ?>
                                </div>

                            <div class="form-group">

                                <?= lang("reference", "reference"); ?>

                             
                                 <?php 
                                  if($expense->emp_pay_id !=NULL){ ?>
                                   <?= form_input('reference', (isset($_POST['reference']) ? $_POST['reference'] : $expense->reference), 'class="form-control tip" readonly="readonly" id="reference"'); ?>
                                <?php }else{ ?>
                                  <?= form_input('reference', (isset($_POST['reference']) ? $_POST['reference'] : $expense->reference), 'class="form-control tip" id="reference"'); ?>
                                <?php } ?>

                            </div>



                            <div class="form-group">

                                <?= lang("amount", "amount"); ?>
                                <?php 
                                  if($expense->emp_pay_id !=NULL){ ?>
                                <?= form_input('amount', (isset($_POST['amount']) ? $_POST['amount'] : $expense->amount), 'class="form-control tip" readonly="readonly"  id="amount"'); ?>
                                <?php }else{ ?>
                                <?= form_input('amount', (isset($_POST['amount']) ? $_POST['amount'] : $expense->amount), 'class="form-control tip"  id="amount"'); ?>
                                <?php } ?>
                             

                            </div>



                            <div class="form-group">

                                <?= lang("attachment", "attachment") ?>

                                <input type="file" name="userfile" class="form-control file">

                            </div>



                            <div class="form-group">

                                <?= lang("note", "note"); ?>

                                <?php echo form_textarea('note', (isset($_POST['note']) ? $_POST['note'] : $expense->note), 'class="form-control redactor" id="note"'); ?>

                            </div>



                            <div class="form-group">

                                <?php echo form_submit('edit_expense', lang('edit_expense'), 'class="btn btn-primary"'); ?>

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

