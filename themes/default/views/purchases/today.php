<?php (defined('BASEPATH')) or exit('No direct script access allowed');
    $v = "?v=1";
    $today= date('Y-m-d'); 
    $store_id=0;
    if ($this->input->post('store_id')) {

        $v .= "&store_id=" . $this->input->post('store_id');
        $store_id=$this->input->post('store_id');
    }


?>
<script>
    $(document).ready(function() {

        if (get('remove_spo')) {

            if (get('spoitems')) {

                remove('spoitems');

            }

            remove('remove_spo');

        }

        <?php if ($this->session->userdata('remove_spo')) { ?>

            if (get('spoitems')) {

                remove('spoitems');

            }

        <?php $this->tec->unset_data('remove_spo');
        } ?>

        function attach(x) {

            if (x !== null) {

                return '<a href="<?= base_url(); ?>uploads/' + x + '" target="_blank" class="btn btn-primary btn-block btn-xs"><i class="fa fa-chain"></i></a>';

            }

            return '';

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

            'sAjaxSource': '<?= site_url('purchases/today_get_purchases/' . $v) ?>',

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
                "mRender": currencyFormat
            }, null, null, null, {
                "mRender": attach,
                "bSortable": false,
                "bSearchable": false
            }, {
                "bSortable": false,
                "bSearchable": false
            }]
            // "aoColumns": [{"mRender":hrld}, null,  null, null,{"mRender":currencyFormat}, null, null,  null, {"mRender":attach, "bSortable":false, "bSearchable": false},{"bSortable":false, "bSearchable": false}]

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


                <div class="panel-body">

                    <?= form_open("purchases/today/"); ?>

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
                        <div class="col-xs-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="col-xs-5">Today Purchases Amount</th>
                                        <?= $today; ?>
                                        <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->purchases_model->purchasesAmount('total', NULL, $today, NULL, $store_id)); ?></th>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-5">Today Paid Amount</th>
                                        <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->purchases_model->purchasesAmount('paid', NULL, $today, NULL, $store_id)); ?></th>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-5">Today Due Amount </th>
                                        <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->purchases_model->purchasesAmount('deu', NULL, $today, NULL, $store_id)); ?></th>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">

                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                                <tr class="active">

                                    <th class="col-xs-2"><?= lang('date'); ?></th>

                                    <th>Ref.</th>

                                    <th>Store Name</th>

                                    <th>S. Name</th>

                                    <th class="col-xs-1"><?= lang('total'); ?></th>

                                    <th class="col-xs-1">Paid Amount </th>

                                    <th class="col-xs-1">Due Amount </th>

                                    <th><?= lang('note'); ?></th>

                                    <th style="width:20px; padding-right:5px;"><i class="fa fa-chain"></i></th>

                                    <th style="width:125px;"><?= lang('actions'); ?></th>

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