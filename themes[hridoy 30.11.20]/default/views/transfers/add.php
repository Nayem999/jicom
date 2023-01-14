<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('enter_info'); ?></h3>

                </div>

                <div class="box-body">

                    <div class="col-lg-12">
                    <?php
                    $from_warehouseID =  $this->session->userdata('from_warehouse') ;

                    $from_warehouseInfo =  $this->site-> findeNameByID('stores','id',$from_warehouseID);
                    

                     
                     echo form_open_multipart("transfers/add", 'class="validation"'); ?>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <?= lang('date', 'date'); ?>

                                    <?= form_input('date', set_value('date', date('Y-m-d H:i')), 'class="form-control tip" id="date"  required="required"'); ?>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <?= lang('reference', 'reference'); ?>

                                    <?= form_input('reference', set_value('reference'), ' class="form-control tip" id="reference"'); ?>

                                </div> 

                            </div>

                        </div>

                        <div class="form-group">

                            <input type="text" placeholder="<?= lang('search_product_by_name_code'); ?>" id="add_item" class="form-control">

                        </div>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="table-responsive">

                                     <table id="transferTable" class="table table-striped table-bordered">

                                        <thead>

                                            <tr class="active">

                                                <th class="col-xs-3"><?= lang('product'); ?></th>

                                                <th class="col-xs-1"><?= lang('quantity'); ?></th> 

                                                <th class="col-xs-2"><?= lang('unit_cost'); ?></th>

                                                <th class="col-xs-2"><?= lang('Sequence'); ?></th>

                                                <th class="col-xs-2"><?= lang('subtotal'); ?></th>

                                                <th style="width:25px;"><i class="fa fa-trash-o"></i></th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td colspan="6"><?= lang('add_product_by_searching_above_field'); ?></td>

                                            </tr>

                                        </tbody>

                                        <tfoot>

                                            <tr class="active">

                                                <th><?= lang('total'); ?></th>

                                                <th class="col-xs-2"><span id="prqty">0</span></th> 

                                                <th class="col-xs-1"></th>

                                                <th class="col-xs-1"></th>

                                                <th class="col-xs-2 text-right"><span id="gtotal">0.00</span></th>

                                                <th style="width:25px;"></th>

                                            </tr>

                                        </tfoot>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                <?= lang('Shipping','Shipping'); ?>

                                <?= form_input('shipping', set_value('shipping'), 'class="form-control tip" id="shipping"'); ?>

                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="form-group">

                                    <?= lang('Form Warehouse','Form Warehouse'); ?>
                                    <p>
                                    <?php 
                                     echo $from_warehouseInfo->name ;
                                    ?></p><a href="javascript:;" onclick="productsTransfer()">Change Warehouse</a>

                                </div>                                

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <?= lang('To Warehouse','To Warehouse'); ?>

                                    <?php

                                    $wr[''] = lang("select")." ".lang("warehouse");

                                    foreach($warehouses as $warehouse) {
                                        if($warehouse->id != $from_warehouseID){
                                           $wr[$warehouse->id] = $warehouse->name;  
                                       }
                                    }

                                    ?>

                                    <?= form_dropdown('towarehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="to-warehouse" style="width:100%;" required="required"'); ?>

                                </div>                                

                            </div>

                            <!-- <div class="col-md-4"> 
                                <div class="form-group">

                                    <?= lang('From Warehouse','From Warehouse'); ?>

                                    <?php 

                                    $wr[''] = lang("select")." ".lang("warehouse");

                                    foreach($warehouses as $warehouse) {

                                        $wr[$warehouse->id] = $warehouse->name;

                                    }

                                    ?>

                                    <?= form_dropdown('fromwarehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="from-warehouse" required="required" style="width:100%;"'); ?>

                                </div>

                            </div> -->

                        </div> 
                        <div class="form-group">

                            <?= lang("note", 'note'); ?>

                            <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>

                        </div>

                        <div class="form-group">

                            <?= form_submit('add_transfers', lang('Add Transfers'), 'class="btn btn-primary" id="add_transfers"'); ?>

                            <button type="button" id="reset" class="btn btn-danger sqcount"><?= lang('reset'); ?></button>

                        </div>

                        <?php echo form_close();?>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>

<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/pages/tranfer.js" type="text/javascript"></script>
<script type="text/javascript">  
    $(document).ready(function()
    {
        $("#to-warehouse").change(function() {            
            var whto =$(this).val();
            var empty ='';
            var whfrom = "<?php echo $this->session->userdata('from_warehouse'); ?>"; 
            if(whto == whfrom) {
                $('#to-warehouse').val(empty);
                alert('This store selected in From Warehouse'); return false;

            } 
        }); 
    });
</script> 

<script type="text/javascript">

    var tspoitems = {};

    var lang = new Array(); 

    lang['code_error'] = '<?= lang('code_error'); ?>';

    lang['r_u_sure'] = '<?= lang('r_u_sure'); ?>';

    lang['no_match_found'] = '<?= lang('no_match_found'); ?>'; 

    function sqTransfer(row_no,item_id,item_qty){ 
        var whfrom = "<?php echo $this->session->userdata('from_warehouse'); ?>";
        if(whfrom=='')alert('Please select from warehouse');
        var whto = $('#to-warehouse').val();
        if(whto=='')alert('Please select to warehouse');
        var sequence =  $('#getsequence-'+row_no).val(); 
        if((whfrom !='') && (whto !='')){
           var site_url = "<?php echo site_url('transfers/squenceOut'); ?>/" +row_no+'/'+item_id+'/'+item_qty+'/'+whfrom+'/'+sequence;  
          // alert(site_url);
        }else{ 
            return false ;
        }
     $("#paySalary").load(site_url);
  }
</script>

