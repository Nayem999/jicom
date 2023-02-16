
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel-body">
                        <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button>
                    </div>
                    <div class="table-responsive" id="print_content">
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center"> Name</th>      
                                        <th class="text-center"> Brand</th>      
                                        <th class="text-center"> Store</th>      
                                        <th class="text-center"> Quantity</th>
                                    </tr>
                                    <?php
                                    foreach ($matarial_list as $key => $result) {
                                        ?>
                                        <tr>
                                            <td><?=$result->material_name; ?></td>
                                            <td><?=$result->brand_name; ?></td>
                                            <td><?=$result->store_name; ?></td>
                                            <td><?=$result->quantity.' '.$result->unit_name; ?></td>
                                        </tr>
                                        <?php
                                    }
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
<script>
    $("#excelWindow").click(function() {
        var url = '<?= site_url('mf_material_stock/excel_stock_list/'); ?>';
        location.replace(url);
    });
</script>