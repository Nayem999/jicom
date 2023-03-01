
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive" id="print_content">
                        <div class="col-xs-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center"> Product Name</th>           
                                        <th class="text-center"> Quantity</th>
                                        <th class="text-center"> Action</th>
                                    </tr>
                                    <?php
                                    foreach ($finish_good_list as $key => $result) {
                                        ?>
                                        <tr>
                                            <td><?=$result->product_name; ?></td>
                                            <td><?=$result->qty; ?></td>
                                            <td><a href='javascript:;' onClick="finishGoodStockAdjust(<?=$result->id;?>)" title='Adjust' class='tip btn btn-primary btn-xs'><i class='fa fa-edit'></i></a></td>
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
