<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                
                    <h3 class="box-title"><?= lang('update_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <?php echo form_open_multipart("purchases/edit/".$purchase->id, 'class="validation edit-po-form"'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang('date', 'date'); ?>
                                    <?= form_input('date', set_value('date', $purchase->date), 'class="form-control tip" id="date"  required="required"'); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?= lang('reference', 'reference'); ?>
                                    <?= form_input('reference', $purchase->reference, 'class="form-control tip" id="reference"'); ?>
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

                                                <th class="col-xs-4"><?= lang('product'); ?></th>

                                                <th class="col-xs-1"><?= lang('quantity'); ?></th>

                                                <!-- <th class="col-xs-2">Expiry year</th> -->

                                                <!-- <th class="col-xs-2">Sequence</th> -->

                                                <th class="col-xs-1">Generate</th>

                                                <th class="col-xs-2"><?= lang('unit_cost'); ?></th>

                                                <th class="col-xs-1"><?= lang('subtotal'); ?></th>

                                                <th style="width:20px;"><i class="fa fa-trash-o"></i></th>

                                            </tr>

                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr class="active">

                                                <th class="col-xs-4 text-center"><?= lang('total'); ?></th>

                                                <th class="col-xs-1 text-center"><span id="prqty" class=" text-center">0</span></th>

                                                <!-- <th class="col-xs-2"></th> -->

                                                <!-- <th class="col-xs-1"></th> -->

                                                <th class="col-xs-1"></th>

                                                <th class="col-xs-2"></th>

                                                <th class="col-xs-1 text-right text-center"><span id="gtotal">0.00</span></th>

                                                <th style="width:20px;"></th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= lang('attachment', 'attachment'); ?>
                            <input type="file" name="userfile" class="form-control tip" id="attachment">
                        </div>  
                        <div class="form-group">
                            <?= lang("note", 'note'); ?>
                            <?= form_textarea('note', $purchase->note, 'class="form-control redactor" id="note"'); ?>
                        </div>
                        <div class="form-group">
                            <?= form_submit('edit_purchase', lang('edit_purchase'), 'class="btn btn-primary" id="edit_purchase"'); ?>
                            <button type="button" id="reset" class="btn btn-danger"><?= lang('reset'); ?></button>
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var spoitems = {};
    var lang = new Array();
    lang['code_error'] = '<?= lang('code_error'); ?>';
    lang['r_u_sure'] = '<?= lang('r_u_sure'); ?>';
    lang['no_match_found'] = '<?= lang('no_match_found'); ?>';

    $(document).ready(function() {
       store('spoitems', JSON.stringify(<?= $items; ?>)); 
    });
    $(window).bind('beforeunload', function (e) {
        localStorage.setItem('remove_spo', true);
        var message = "You will loss data!";
        return message;

    });
    $('#reset').click(function (e) {
        $(window).unbind('beforeunload');
    });
    $('#edit_purchase').click(function () {
        $(window).unbind('beforeunload');
        $('form.edit-po-form').submit();
    });
 /*   function pSequGenerat(qty,id,row_no){ 
        var sequence = $('#sequence'+row_no).val(); 
        var site_url = "<?php echo site_url('purchases/pSequence'); ?>/"+qty+"/"+id+"/"+row_no+"/"+sequence; //append id at end
      
     $("#paySalary").load(site_url);
    }*/
     function pSequGenerat(qty,id,row_no){ 
        var str = $( "#sequence"+row_no ).val();

        var purchases_id = <?php if($segment){ echo $segment ; }else{ echo "";} ?>;
        
        
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
                var site_url = "<?php echo site_url('purchases/pSequenceEdit'); ?>/"+qty+"/"+id+"/"+row_no+"/"+sequence+"/"+purchases_id+'/'+allSequence; //append id at end

                 $("#paySalary").load(site_url);
                // alert(site_url);
             }else{
              var sequence = '';
                sequence = $('#sequence'+row_no).val(); 
               
                var site_url = "<?php echo site_url('purchases/pSequenceEdit'); ?>/"+qty+"/"+id+"/"+row_no+"/"+sequence+'/'+purchases_id+"/add"; 
                //append id at end
                //alert(site_url); 
                 $("#paySalary").load(site_url);
             }

        }
    }

</script>

<style type="text/css">
    .red-btu{
        color: red;
    }
</style>

<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= $assets ?>dist/js/pages/purchases.js" type="text/javascript"></script>