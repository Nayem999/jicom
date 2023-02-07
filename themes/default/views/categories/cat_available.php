<script>
    $(document).ready(function() {
        $('#catData').dataTable({
            'bProcessing': true,
            'bServerSide': false,
            "aaSorting": [
                [1, "asc"]
            ],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, //'bServerSide': true, 
        });
    });
</script>
<style type="text/css">
    .dataTables_length {
        display: none !important;
    }
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3><br><br>

                </div>

                <div class="panel panel-warning">

                    <div class="panel-body">

                        <?= form_open("categories/available_cat/"); ?>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <?= lang('Store', 'Store'); ?>
                                    <?php
                                    $wr[0] = lang("select") . " " . lang("Store");
                                    foreach ($stores as $store) {
                                        $wr[$store->id] = $store->name;
                                    }
                                    ?>
                                    <?= form_dropdown('store_id', $wr, set_value('store_id'), 'class="form-control select2 tip" id="store_id" required="required" style="width:100%;"'); ?>
                                </div>
                            </div>


                            <div class="clearfix"></div>
                            <div class="col-xs-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>
                        </div>

                        <?= form_close(); ?>

                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="catData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
                                <thead>
                                    <tr class="active">
                                        <th style="max-width:30px;"><?= lang("image"); ?></th>
                                        <th><?= lang('code'); ?></th>
                                        <th><?= lang('name'); ?></th>
                                        <th><?= lang('Parent Category'); ?></th>
                                        <th><?= lang('Qty'); ?></th>
                                        <th width="50px" style="text-align: center;"><?= lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($allcategories as $key => $category) {
                                        $subcats = $this->categories_model->getSubcategories($category->parent_id);
                                    ?>
                                        <tr>
                                            <td><img width="32px" src="<?php echo base_url('/uploads/thumbs/') . '/' . $category->image; ?>"></td>
                                            <td><?php echo $category->code; ?></td>
                                            <td><?php echo $category->name; ?></td>
                                            <td><?php if ($category->parent_id) echo $subcats->name;
                                                else echo '-'; ?></td>
                                            <td><?php echo $category->qty; ?></td>
                                            <td style="text-align: center;"><a target="_black" href="<?php echo base_url('categories/') . '/productListByCatId/' . $category->id ?>" class="tip btn btn-primary btn-xs" title="" data-original-title="Product List"> <i class="fa fa-list"></i>

                                                </a></td>

                                        </tr>

                                    <?php }   ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
</section>

<div class="modal fade" id="picModal" tabindex="-1" role="dialog" aria-labelledby="picModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body text-center">
                <img id="product_image" src="" alt="" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function productList(id) {
        var dataString = 'id=' + id;
        var site_url = "<?php echo site_url('categories/productListByCatId'); ?>/" + id; //append id at end
        $("#paySalary").load(site_url);
    }
</script>