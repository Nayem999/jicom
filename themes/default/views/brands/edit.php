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

                        <?php echo form_open_multipart("brands/edit/".$brands->id);?>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <?= lang('code', 'code'); ?>
                                    <?= form_input('code', $brands->code, 'class="form-control tip" id="code"  required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <?= lang('name', 'name'); ?>
                                    <?= form_input('name', $brands->name, 'class="form-control tip" id="name"  required="required"'); ?>
                                </div> 
                                <div class="form-group" style="display:none;">
                                    <?= lang('image', 'image'); ?>
                                    <input type="file" name="userfile" id="image">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= form_submit('edit_category', lang('Edit_Brand'), 'class="btn btn-primary"'); ?>
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
