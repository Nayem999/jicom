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
                        <?php echo form_open_multipart("mf_material_unit/edit/".$unit_info[0]->id);?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Unit Name</label>
                                    <?= form_input('name', $unit_info[0]->name, 'class="form-control tip" id="name"  required="required"'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <?= form_input('description', $unit_info[0]->description, 'class="form-control tip" id="description" '); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= form_submit('edit_unit', lang('edit_unit'), 'class="btn btn-primary"'); ?>
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
