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

            'sAjaxSource': '<?= site_url('mf_production/get_production') ?>',

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

                </div>

                <div class="box-body">
                    <div class="table-responsive" id="page_content">
                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>
                                <tr class="active">
                                    <th class="col-xs-2">Batch No</th>
                                    <th class="col-xs-2">Recipe Name</th>
                                    <th class="col-xs-3">Product</th>
                                    <th class="col-xs-2">Status</th>
                                    <th class="col-xs-2">Action</th>
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