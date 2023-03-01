
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel-body">
                        <!-- <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button> -->
                    </div>
                    <div class="table-responsive" id="print_content">
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center"> Name</th>      
                                        <th class="text-center"> Reason</th>          
                                        <th class="text-center"> Adj. Qty Type</th>
                                        <th class="text-center"> Adj. Qty</th>
                                    </tr>
                                    <?php
                                    foreach ($finish_goods_stock_adjust_list as $key => $result) {
                                        ?>
                                        <tr>
                                            <td><?=$result->product_name; ?></td>
                                            <td><?=$result->note; ?></td>
                                            <td><?=($result->adjust_type==1)?'Increase':'Decrease'; ?></td>
                                            <td><?=$result->quantity; ?></td>
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
        var url = '<?= site_url('mf_material_stock/excel_stock_log_list/'); ?>';
        location.replace(url);
    });
</script>