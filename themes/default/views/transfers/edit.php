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
                    <?php print_r($transfer) ; ?>
                        <?php echo form_open_multipart("transfers/edit/".$transfer->id, 'class="validation edit-po-form"'); ?>
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <?= lang('date', 'date'); ?>

                                    <?= form_input('date', set_value('date', $transfer->date), 'class="form-control tip" id="date"  required="required"'); ?>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <?= lang('reference', 'reference'); ?>

                                    <?= form_input('reference', set_value('reference', $transfer->reference), ' class="form-control tip" id="reference"'); ?>

                                </div> 

                            </div>

                        </div>

                        <!-- <div class="form-group">

                            <input type="text" placeholder="<?= lang('search_product_by_name_code'); ?>" id="add_item" class="form-control">

                        </div> -->

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

                                <?= form_input('shipping', set_value('shipping',$transfer->shipping), 'class="form-control tip" id="shipping"'); ?>

                                </div>

                            </div>
                            <input type="" name="to_warehouse_id" value="<?php echo $transfer->to_warehouse_id ; ?>" >
                            <input type="" name="from_warehouse_id" value="<?php echo $transfer->from_warehouse_id ; ?>" >
                        </div>
                        <div class="form-group">
                            <?= lang('attachment', 'attachment'); ?>
                            <input type="file" name="userfile" class="form-control tip" id="attachment">
                        </div>  
                        <div class="form-group">
                            <?= lang("note", 'note'); ?>
                            <?= form_textarea('note', $transfer->note, 'class="form-control redactor" id="note"'); ?>
                        </div>
                        <div class="form-group">
                            <?= form_submit('edit_transfers', 'Edit transfers', 'class="btn btn-primary" id="edit_transfers"'); ?>
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
var tspoitems = {};
    var lang = new Array();
    lang['code_error'] = '<?= lang('code_error'); ?>';
    lang['r_u_sure'] = '<?= lang('r_u_sure'); ?>';
    lang['no_match_found'] = '<?= lang('no_match_found'); ?>';

    $(document).ready(function() {
       store('tspoitems', JSON.stringify(<?= $items; ?>)); 
    });
    $(window).bind('beforeunload', function (e) {
        localStorage.setItem('remove_spo', true);
        var message = "You will loss data!";
        return message;

    });
    $('#reset').click(function (e) {
        $(window).unbind('beforeunload');
    });
    $('#edit_transfers').click(function () {


        $(window).unbind('beforeunload');
        $('form.edit-po-form').submit();
    });
</script>
<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?= $assets ?>dist/js/pages/tranfer.js" type="text/javascript"></script>
<script type="text/javascript">
 function sqTransfer(row_no,item_id,item_qty){ 
        var whfrom = "<?php echo $transfer->to_warehouse_id ; ?>";

       // alert(item_id);
        var sequence =  $('#getsequence-'+row_no).val(); 
        if(whfrom=='')alert('Please select from warehouse');
        var whto = $('#to-warehouse').val();
        if(whto=='')alert('Please select to warehouse');
        if((whfrom !='') && (whto !='')){
           var site_url = "<?php echo site_url('transfers/squenceOutEdit'); ?>/" +row_no+'/'+item_id+'/'+item_qty+'/'+ whfrom+'/'+sequence; 
          alert(site_url);
        }else{ 
            return false ;
        }
     $("#paySalary").load(site_url);
  }
  </script>