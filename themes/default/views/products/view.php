<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>
            </button>
            <h4 class="modal-title" id="myModalLabel"><?= $product->name; ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-3">
                    <img id="pr-image" src="<?= base_url() ?>uploads/<?= $product->image ?>"
                    alt="<?= $product->name ?>" class="img-responsive img-thumbnail"/>
                </div>
                <?php //print_r($storeList); ?>
                <div class="col-xs-9">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped dfTable table-right-left">
                            <tbody>
                                <tr>
                                    <td class="col-xs-3"><?= lang("product_type"); ?></td>
                                    <td class="col-xs-9"><?= lang($product->type); ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang("product_name"); ?></td>
                                    <td><?= $product->name; ?></td>
                                </tr>
                                

                                <tr>
                                    <td><?= lang("product_code"); ?></td>
                                    <td><?= $product->code; ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang("category"); ?></td>
                                    <td><?= $category->name.' ('.$category->code.')'; ?></td>
                                </tr>
                                <?php if ($Admin) {
                                    echo '<tr><td>' . lang("cost") . '</td><td>' . $this->tec->formatMoney($product->cost) . '</td></tr>';
                                }
                                ?>

                                <tr>
                                    <td><?= lang("price"); ?></td>
                                    <td><?= $this->tec->formatMoney($product->price) ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang("tax_rate"); ?></td>
                                    <td><?= $product->tax; ?></td>
                                </tr>
                                <tr>
                                    <td><?= lang("tax_method"); ?></td>
                                    <td><?= $product->tax_method == 0 ? lang('inclusive') : lang('exclusive'); ?></td>
                                </tr>
                                <?php if ($product->type == 'standard') { ?>
                                <tr>
                                    <td><?= lang("quantity"); ?></td>
                                    <td><?= $this->tec->formatNumber($product->quantity); ?></td>
                                </tr>
                                <?php } ?>

                                <?php // print_r($ProSequence) ; ?>

                                <?php if(!$Admin){ ?>
                                <tr>
                                    <td class="col-xs-2">Sequence</td>
                                    <td class="col-xs-10">
                                        <table class="table table-borderless table-striped dfTable table-right-left">

                                            <tbody>
                                            <th >Sequence </th>
                                            <th> Purchases Date </th>
                                            <?php foreach ($ProSequence as $key => $values) {
                                                ?>

                                                <tr>
                                                    <td class="col-xs-5"> <?php echo $values->sequence ; ?> </td>
                                                    <td class="col-xs-7"> <?php echo $this->tec->hrld($values->entry_date) ; ?> </td>
                                                </tr>

                                            <?php } ?>   
                                            </tbody>
                                           
                                        </table>
                                    </td>
                                </tr>

                                <?php } ?>
                                <?php if($Admin){ ?>
                                <tr>
                                    <td class="col-xs-2">Sequence</td>
                                    <td class="col-xs-10">
                                        <table class="table table-borderless table-striped dfTable table-right-left">

                                        <?php 
                                            if(is_array($storeList))
                                            {
                                                foreach ($storeList as $key => $value) {
                                                    ?>
                                                    <thead>
                                                    <tr>
                                                        <th colspan="2"> <?php echo $value['store']->name .'('. count($value['sequence']).')' ; ?> </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <th >Sequence </th>
                                                    <th> Purchases Date </th>
                                                    <?php foreach ($value['sequence'] as $key => $values) {
                                                        ?>

                                                        <tr>
                                                            <td class="col-xs-5"> <?php echo $values->sequence ; ?> </td>
                                                            <td class="col-xs-7"> <?php echo $this->tec->hrld($values->entry_date) ; ?> </td>
                                                        </tr>

                                                    <?php 
                                                }
                                            } ?>   
                                            </tbody>
                                            <?php } ?>
                                        </table>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($product->type == 'combo') { ?>
                    <h4 class="bold"><?= lang('combo_items') ?></h4>
                    <div class="table-responsive">
                        <table
                        class="table table-bordered table-striped table-condensed dfTable two-columns">
                        <thead>
                            <tr>
                                <th><?= lang('product_name') ?></th>
                                <th><?= lang('quantity') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($combo_items as $combo_item) {
                                echo '<tr><td>' . $combo_item->name . ' (' . $combo_item->code . ') </td><td>' . $this->tec->formatNumber($combo_item->qty) . '</td></tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
            </div>

            <div class="col-xs-12">
                <?= $product->details ? '<div class="panel panel-primary"><div class="panel-heading">' . lang('product_details') . '</div><div class="panel-body">' . $product->details . '</div></div>' : ''; ?>
            </div>
        </div>

    </div>
</div>
</div>