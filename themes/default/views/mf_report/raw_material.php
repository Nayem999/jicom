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
                                    <?= lang('Brand', 'Brand'); ?>
                                    <?php
                                    $wr[0] = lang("select") . " " . lang("Material Brand");
                                    foreach ($brands as $brand) {
                                        $wr[$brand->id] = $brand->name;
                                    }
                                    ?>
                                    <?= form_dropdown('brand_id', $wr, set_value('brand_id'), 'class="form-control select2 tip" id="brand_id" required="required" style="width:100%;"'); ?>
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

                                        <th style="width: 150px;" >SL</th>

                                        <th>Name </th>

                                        <!-- <th>Category </th> -->

                                        <th>Brand</th>

                                        <th>Store</th>	

                                        <th >QTY</th>

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

                                                <td><?= $material->name; ?></td>

                                                <!-- <td><?= $material->cat_name; ?></td> -->

                                                <td><?= $material->brand_name; ?></td>

                                                <td><?= $material->store_name; ?></td>

                                                <td><?= $material->qty . ' ' . @$material->unit; ?></td>

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
        let brand = $("#brand_id").val();
        let brandName = $("#brand_id").find(":selected").text();
        var url = '<?= site_url('mf_report/exp_material_report/'); ?>' + '/' + brand + '?brand_name='+ brandName;
        location.replace(url);
    });
</script>