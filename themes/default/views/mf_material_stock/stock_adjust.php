
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
                                        <th class="col-xs-3 text-center"> Name</th>      
                                        <th class="col-xs-3 text-center"> Brand</th>      
                                        <th class="col-xs-3 text-center"> Store</th>      
                                        <th class="col-xs-2 text-center"> Quantity</th>
                                        <th class="col-xs-1 text-center"> Action</th>
                                    </tr>
                                    <?php
                                    foreach ($matarial_list as $key => $result) {
                                        ?>
                                        <tr>
                                            <td><?=$result->material_name; ?></td>
                                            <td><?=$result->brand_name; ?></td>
                                            <td><?=$result->store_name; ?></td>
                                            <td><?=$result->quantity.' '.$result->unit_name; ?></td>
                                            <td><a href='javascript:;' onClick="stockAdjust(<?=$result->id;?>)" title='Adjust' class='tip btn btn-primary btn-xs'><i class='fa fa-edit'></i></a></td>
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
