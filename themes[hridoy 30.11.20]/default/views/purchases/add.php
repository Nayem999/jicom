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

                        <?php echo form_open_multipart("purchases/add"); ?>

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

                                    <?= form_input('reference', set_value('reference'), 'class="form-control tip" id="reference"'); ?>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <input type="text" placeholder="<?= lang('search_product_by_name_code'); ?>" id="add_item" class="form-control">

                        </div>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="table-responsive">

                                    <table id="poTable" class="table table-striped table-bordered">

                                        <thead>

                                            <tr class="active">

                                                <th class="col-xs-3"><?= lang('product'); ?></th>

                                                <th class="col-xs-1"><?= lang('quantity'); ?></th>

                                                <th class="col-xs-2">Expiry year</th>

                                                <th class="col-xs-2">Sequence</th>

                                                <th class="col-xs-1">Generate</th>

                                                <th class="col-xs-1"><?= lang('unit_cost'); ?></th>

                                                <th class="col-xs-1"><?= lang('subtotal'); ?></th>

                                                <th style="width:20px;"><i class="fa fa-trash-o"></i></th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr>

                                                <td colspan="8"><?= lang('add_product_by_searching_above_field'); ?></td>

                                            </tr>

                                        </tbody>

                                        <tfoot>

                                            <tr class="active">

                                                <th><?= lang('total'); ?></th>

                                                <th class="col-xs-2"><span id="prqty">0</span></th>

                                                <th class="col-xs-2" colspan="4"></th> 

                                                <th class="col-xs-2 text-right"><span id="gtotal">0.00</span></th>

                                                <th style="width:25px;"></th>

                                            </tr>

                                        </tfoot>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <?php if($this->Admin){ ?>
                            <div class="col-sm-4">
                                 <?= lang('From Warehouse','From Warehouse'); ?>
                                <?php
                                $wr[''] = lang("select")." ".lang("warehouse");
                                foreach($warehouses as $warehouse) {
                                    $wr[$warehouse->id] = $warehouse->name;
                                }
                                ?>
                                <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" required="required" id="warehouse" style="width:100%;"'); ?> 
                            </div>
                            <?php } ?>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <?= lang('received', 'received'); ?>

                                    <?php $sts = array(1 => lang('received'), 0 => lang('not_received_yet')); ?>

                                    <?= form_dropdown('received', $sts, set_value('received'), 'class="form-control select2 tip" id="received"  required="required" style="width:100%;"'); ?>

                                </div>

                            </div>
                           <div class="col-md-4" id="suppliserInfo">

                                <div class="form-group">

                                    <?= lang('supplier', 'supplier'); ?>

                                    <?php

                                    $sp[''] = lang("select")." ".lang("supplier");

                                    foreach($suppliers as $supplier) {

                                        $sp[$supplier->id] = $supplier->name;

                                    }

                                    ?>

                                    <?= form_dropdown('supplier', $sp, set_value('supplier'), 'class="form-control select2" id="supplier" required="required" style="width:100%;"'); ?>

                                </div>

                            </div>

                        </div>

                        <div class="form-group">

                            <?= lang('attachment', 'attachment'); ?>

                            <input type="file" name="userfile" class="form-control tip" id="attachment">

                        </div>

                        <div class="form-group">

                            <?= lang("note", 'note'); ?>

                            <?= form_textarea('note', set_value('note'), 'class="form-control redactor" id="note"'); ?>

                        </div>

                        <div class="form-group">

                            <?= form_submit('add_purchase', lang('add_purchase'), 'class="btn btn-primary" id="add_purchase"'); ?>

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

<script src="<?= $assets ?>dist/js/pages/purchases.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">

    /*$(function () {

        $('.expirydate').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });*/

</script>
<style type="text/css">
    .red-btu{
        color: red;
    }
</style>
<script type="text/javascript">


    var spoitems = {};

    var lang = new Array(); 

    lang['code_error'] = '<?= lang('code_error'); ?>';

    lang['r_u_sure'] = '<?= lang('r_u_sure'); ?>';

    lang['no_match_found'] = '<?= lang('no_match_found'); ?>';

    function pSequGenerat(qty,id,row_no){ 
        var str = $( "#sequence"+row_no ).val();
        
        var number = str.substring(str.length -1 , str.length); // parseFloat(
        var last =  parseFloat(number) ; 
        if(isNaN(last) || str =='' ){
            alert('Please add your correct sequence number') ;
        }else{
            var allSequence =  $('#getsequence-'+row_no).val(); 
            //alert(allSequence);
             if(allSequence !=''){
                
                var sequence = '';
                sequence = $('#sequence'+row_no).val(); 
                var site_url = "<?php echo site_url('purchases/pSequence'); ?>/"+qty+"/"+id+"/"+row_no+"/"+sequence+"/"+allSequence; //append id at end

                 $("#paySalary").load(site_url);
                // alert(site_url);
             }else{
              var sequence = '';
                sequence = $('#sequence'+row_no).val(); 
               
                var site_url = "<?php echo site_url('purchases/pSequence'); ?>/"+qty+"/"+id+"/"+row_no+"/"+sequence+"/add"; //append id at end
                //alert(site_url);
                 $("#paySalary").load(site_url);
             }

        }
    }

    function sequenceFild(id){
        var sequenceName = $( "#sequence"+id ).val();
        var getsequence = $( "#getsequence-"+id ).val();
        var quantity = $( "#quantity_"+id ).val();
        /*if(sequenceName !=null){

            if(getsequence !=null){
            var sequenceArray = getsequence.split(","); 
            var sequenceCount = sequenceArray.length -1 ;
                if(sequenceCount != quantity){
                    alert(quantity);
                     $('#' + id).addClass('sequence-match');
                }
            
         }

        }*/
        var number = sequenceName.substring(sequenceName.length -1 , sequenceName.length); // parseFloat(
        var last =  parseFloat(number) ; 
        if(isNaN(last) || str =='' ){
           // $(   ).addClass("code-error" );
            //$("#sqto_"+id).attr('readonly', true);
            $( "#sequence"+id  ).addClass("code-error" );
        }else{
            //$("#sqto_"+id).attr('readonly', false);
            $( "#sequence"+id ).removeClass("code-error" )
        }      

    }

    $("#warehouse").change(function(){ 
         var warehouse = this.value;        
         var url = '<?php echo base_url('purchases/suppliserInfoByStore') ?>'+'/'+warehouse;
         
         $('#suppliserInfo').load(url);          
        });
</script>

