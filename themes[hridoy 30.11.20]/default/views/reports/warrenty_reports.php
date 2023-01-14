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
                                   
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="catData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
                            <thead>
                            <tr class="active"> 
                                <th><?= lang('Sales_Warranty'); ?></th>
                                <th><?= lang('Purchases warranty'); ?></th>
                                <th><?= lang('Sequence'); ?></th>
                                <th><?= lang('Stores Name'); ?></th> 
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($warranty as $key => $warran) { ?>
                                <tr> 
                                    <?php
                                    $salesItems = $this->site->getDataByElement('sale_items','sale_id',$warran->sales_id);
                                    $sales = $this->site->getDataByElement('sales','id',$warran->sales_id);

                                    if($warran->status !=0){ 
                                        if($salesItems[0]->warranty_year !='0.00'){
                                           $modifyDateWarrenty = date("Y-m-d", strtotime(date("Y-m-d", strtotime($sales[0]->date)) .'+'.number_format($salesItems[0]->warranty_year).'year'));

                                           $saleWarr = date("Y-m-d", strtotime($sales[0]->date)).' < '. $modifyDateWarrenty;
                                        } else {
                                            $saleWarr = 'No entry date';
                                        } 
                                    }else{
                                        $saleWarr = 'Not sell';
                                    }
                                        
                                    //$sales[0]->warranty_year?$sales[0]->warranty_year:'Not sell'; 
                                     ?>
                                    

                                    <td><?= $saleWarr; //$salesItems[0]->warranty_year?$salesItems[0]->warranty_year:'Not sell'; ?></td>
                                    <?php $purchases = $this->site->getDataByElement('purchase_items','purchase_id',$warran->purchases_id);

                                    $modifyDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($warran->entry_date)) .'+'. number_format($purchases[0]->expiry_year) .'year'));

                                        if($purchases[0]->expiry_year !='0.00'){
                                            $purWarranty = date("Y-m-d", strtotime($warran->entry_date)).' < '. $modifyDate;
                                        } else { $purWarranty = 'No entry date'; }?>
                                    <td><?= $purWarranty; ?></td>
                                    <td><?= $warran->sequence?></td>
                                    <?php $stores = $this->site->getDataByElement('stores','id',$warran->store_id);?>
                                    <td><?= $stores[0]->name ; ?></td>
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
