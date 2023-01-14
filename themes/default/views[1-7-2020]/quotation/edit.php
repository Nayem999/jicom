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
                        <?= form_open_multipart("quotation/edit/".$quotation->quotation_id, 'class="validation"');?>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <?= lang('name', 'name'); ?>
                                    <?= form_input('name', $quotation->quotation_title, 'class="form-control tip" id="name"  required="required"'); ?>
                                </div>  
                            </div> 
                        </div>
                        <div class="form-group">
                            <?= lang('details', 'details'); ?>
                            <?= form_textarea('details', $quotation->quotation_details, 'class="form-control tip redactor" id="details"'); ?>
                        </div>
                        <div class="form-group">
                            <?= form_submit('edit_product', lang('edit_product'), 'class="btn btn-primary"'); ?>
                        </div>
                        <?= form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>
 
