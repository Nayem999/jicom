<script>
    $(document).ready(function() { 
        $('#catData').dataTable({
            'bProcessing': true, 'bServerSide': false, 
            "aaSorting": [[ 1, "asc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, //'bServerSide': true, 
        });  
    });
</script>
 <style type="text/css">
    .dataTables_length {
        display: none !important ;
    } 
}
</style>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3><br><br>
                    <?php if($products) { 
                        foreach ($products as $key => $product) {
                           $countProduct = $countProduct+$product->quantity;
                        }
                    echo '<p class="box-title"> Total Products : <strong>'.$countProduct.'</strong></p>'; }?>
                                        
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="catData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
                            <thead>

                            <tr class="active">

                                <th style="max-width:30px;"><?= lang("image"); ?></th>

                                <th class="col-xs-1"><?= lang("code"); ?></th>

                                <th><?= lang("name"); ?></th>

                                <th class="col-xs-1"><?= lang("type"); ?></th> 

                                <th class="col-xs-1"><?= lang("quantity"); ?></th>

                                <th class="col-xs-1"><?= lang("tax"); ?></th> 

                                <?php if($Admin) { ?>

                                <th class="col-xs-1"><?= lang("cost"); ?></th>

                                <?php } ?>

                                <th class="col-xs-1"><?= lang("price"); ?></th> 

                                <th class="col-xs-1"><?= lang("action"); ?></th>

                            </tr>

                            </thead>
                            <tbody>
                                <?php  
                                foreach ($products as $key => $product) { ?>
                                    <tr>
                                        <td><img width="32px" src="<?php echo base_url('/uploads/thumbs/').'/'.$product->image; ?>"></td>
                                        <td><?php echo $product->code; ?></td>
                                        <td><?php echo $product->name; ?></td> 
                                        <td><?php echo $product->type; ?></td>
                                        <td><?php echo $product->quantity; ?></td>
                                        <td><?php echo $product->tax; ?></td>
                                        <?php if($Admin) { ?>
                                        <td><?php echo $product->cost; ?></td>
                                        <?php } ?>                                        
                                        <td><?php echo $product->price; ?></td>
                                        <td><a href="<?php echo site_url('products/view/').'/'.$product->id ?>" title="view details" class="tip btn btn-primary btn-xs" data-toggle='ajax'><i class='fa fa-file-text-o'></i></a></td>
                                    </tr>    

                                <?php }   ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="picModal" tabindex="-1" role="dialog" aria-labelledby="picModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body text-center">
                <img id="product_image" src="" alt="" />
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function productList(id) {
     var dataString = 'id='+ id ; 
     var site_url = "<?php echo site_url('categories/productListByCatId'); ?>/" +id; //append id at end
     $("#paySalary").load(site_url);
    }
</script>