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

                        <?php echo form_open_multipart("group/edit/".$groups->id);?>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <?= lang('name', 'name'); ?>
                                    <?= form_input('name', $groups->name, 'class="form-control tip" id="name"  required="required"'); ?>
                                </div> 
                                
                                <div class="form-group">
                                    <?= lang('description', 'description'); ?>
                                    <?= form_input('description', $groups->description, 'class="form-control tip" id="description"  required="required"'); ?>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <?= form_submit('edit_group', lang('edit_group'), 'class="btn btn-primary"'); ?>
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
