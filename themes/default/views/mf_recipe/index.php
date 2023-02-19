<script>
    $(document).ready(function() {

        if (get('recipe_items')) {
            if (get('recipe_items')) {
                remove('recipe_items');
            }
            remove('recipe_items');
        }

        $('#purData').dataTable({

            "aLengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, '<?= lang('all'); ?>']
            ],

            "aaSorting": [
                [0, "desc"]
            ],
            "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true,
            'bServerSide': true,

            'sAjaxSource': '<?= site_url('mf_recipe/get_recipe') ?>',

            'fnServerData': function(sSource, aoData, fnCallback) {

                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });

                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });

            },

            "aoColumns": [null, null, null, null, {
                "bSortable": false,
                "bSearchable": false
            }]

        });

    });
</script>

<style type="text/css">
    .table td:nth-child(3) {
        text-align: right;
    }
</style>



<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <!-- <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print report</button> -->

                </div>

                <!-- <div class="panel-body">

                    <?= form_open("mf_purchases/"); ?>

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

                </div> -->

                <div class="box-body">
                    <div class="table-responsive" id="page_content">
                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>
                                <tr class="active">
                                    <th class="col-xs-2">Recipe Code</th>
                                    <th class="col-xs-2">Recipe Name</th>
                                    <th class="col-xs-3">Product</th>
                                    <th class="col-xs-3">Description</th>
                                    <th class="col-xs-1">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>

                                    <td colspan="6" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>