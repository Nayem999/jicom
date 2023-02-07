<?php (defined('BASEPATH')) or exit('No direct script access allowed');
    $v = "?v=1"; 
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

            'sAjaxSource': '<?= site_url('purchases/get_purchases/' . $v) ?>',

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

            "aoColumns": [null, null, null, null, null, null, null, null, {
                "mRender": attach,
                "bSortable": false,
                "bSearchable": false
            }, {
                "bSortable": false,
                "bSearchable": false
            }]
            // "aoColumns": [null,{"mRender":hrld}, null, null,{"mRender":currencyFormat}, null, null,  null, {"mRender":attach, "bSortable":false, "bSearchable": false},{"bSortable":false, "bSearchable": false}]

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
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print report</button>

                </div>

                <div class="panel-body">

                    <?= form_open("purchases/"); ?>

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
                        <?php $totalAdAmount = $this->purchases_model->advPayAmount('adv_amount');
                        $tDueAmount    = $this->purchases_model->purchasesAmount('deu');
                        if ($tDueAmount < $totalAdAmount) {
                            $tdeu = 0;
                        } else {
                            $tdeu = $tDueAmount - $totalAdAmount;
                        }
                        ?>
                        <div class="col-xs-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="col-xs-5">Total Purchases Amount</th>
                                        <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->purchases_model->purchasesAmount('total', NULL, NULL,$store_id)); ?></th>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-5">Total Paid Amount</th>
                                        <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->purchases_model->purchasesAmount('paid', NULL, NULL,$store_id)); ?></th>
                                    </tr>
                                    <tr>
                                        <th class="col-xs-5">Total Due Amount </th>
                                        <th class="col-xs-7"><?php echo $this->tec->formatMoney($this->purchases_model->purchasesAmount('deu', NULL, NULL, $store_id)); ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive" id="page_content">
                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                                <tr class="active">

                                    <th class="col-xs-1">Inv No.</th>

                                    <th class="col-xs-3"><?= lang('date'); ?></th>

                                    <th class="col-xs-1">Ref.</th>

                                    <th class="col-xs-1">S. Name</th>

                                    <th class="col-xs-1"><?= lang('total'); ?></th>

                                    <th class="col-xs-1">Paid Amount </th>

                                    <th class="col-xs-1">Due Amount </th>

                                    <th class="col-xs-1"><?= lang('note'); ?></th>

                                    <th class="col-xs-1"><i class="fa fa-chain"></i></th>

                                    <th class="col-xs-1"><?= lang('actions'); ?></th>

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
<script>
    $("#printWindow").click(function() {
        $(".dataTables_info").css("display", "none");
        $(".dataTables_length, .dataTables_filter ").css("display", "none");
        $(".dataTables_paginate ").css("display", "none");
        $("#fileData_filter ").css("display", "none");
        var content = "<html> <br><p style='text-align:center'>Purchases List | <?= $this->Settings->site_name ?></p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
        content += document.getElementById("page_content").innerHTML;
        content += "</body>";
        content += "</html>";
        var printWin = window.open('', '', 'left=20,top=40,width=700,height=550 ');
        printWin.document.write(content);
        printWin.focus();
        printWin.print();
        printWin.close();
        $(".dataTables_info").css("display", "block");
        $(".dataTables_length, .dataTables_filter ").css("display", "block");
        $(".dataTables_paginate ").css("display", "block");
        $("#fileData_filter ").css("display", "block");
    });
</script>