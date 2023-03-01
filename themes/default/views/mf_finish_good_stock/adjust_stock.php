<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php //print_r($pay_info); 
            ?>
            <div class="modal-header">
                <button type="button" onclick="hide()" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>
            </div>
            <?php echo form_open('mf_finish_good_stock/adjust_stock/' . $id); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4 text-right">
                        <label>Name </label>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-7">
                        <?php echo $finish_good_info->product_name; ?>
                        <input type="hidden" name="finish_good_id" id="finish_good_id" value="<?= $finish_good_info->id; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-right">
                        <label>Stock Qnty </label>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-7">
                        <?php echo $finish_good_info->quantity; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-right">
                        <label>Adj. Type </label>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-7">
                        <?php
                        $adjust_type = array(1 => "Increase", 2 => "Decrease");
                        ?>
                        <div class="form-group">
                            <?= form_dropdown('adjust_type', $adjust_type, set_value('adjust_type', 1), 'class="form-control select2 tip" id="adjust_type" required="required" style="width:100%;"'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-right">
                        <label>Adj. Qnty </label>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <?= form_input('adjust_qty', set_value('adjust_qty'), 'class="form-control input-sm" required id="adjust_qty"'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 text-right">
                        <label>Reason </label>
                    </div>
                    <div class="col-sm-1">:</div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <?= form_input('adjust_reason', set_value('adjust_reason'), 'class="form-control input-sm" required id="adjust_reason"'); ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Adjust" name="adjust_btn">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
</div>