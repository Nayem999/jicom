<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel-body">
                        <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button>
                        <button type="button" style="width:120px; float:right; display:none;" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button>
                        <?= form_open(""); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>
                                    <?= form_input('start_date', $start_date, 'class="form-control datepicker" id="start_date"'); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>
                                    <?= form_input('end_date', $end_date, 'class="form-control datepicker" id="end_date"'); ?>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                    <div class="table-responsive" id="print_content">
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">

                                        <th> SL </th>

                                        <th> S.Name </th>

                                        <th> Store Name </th>

                                        <th> Total </th>

                                        <th> Paid Amount </th>	

                                        <th> Due Amount </th>

                                    </tr>
                                </thead>
                                </tbody>
                                    <?php
                                    
                                        if(count($materials) > 0):
                                        $i=0;
                                        foreach ($materials as $key => $material):
                                        ?>
                                            <tr style="">

                                                <td><?= ++$i ?></td>

                                                <td><?= $material->supplier_name; ?></td>

                                                <td><?= $material->store_name; ?></td>

                                                <td><?= $material->total; ?></td>

                                                <td><?= $material->paid ?> </td>

                                                <td><?= $material->deu ?> </td>

                                            </tr>
                                    <?php
                                        endforeach;
                                        endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
<script type="text/javascript">

    $("#excelWindow").click(function() {
        let stDate = $("#start_date").val();
        let endDate = $("#end_date").val();
        var url = '<?= site_url('mf_report/exp_material_purchase_report/'); ?>' + '/' + stDate + '/'+ endDate;
        location.replace(url);
    });
</script>