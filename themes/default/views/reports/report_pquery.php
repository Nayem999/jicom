<?php 
isset($_POST['type'])?$type =$_POST['type']:$type ='';
?>
 

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title">Sold and Purchase</h3>

                </div>

                <div class="box-body">

                    <div  class="panel panel-warning">

                        <div class="panel-body">

                        <?= form_open("reports/productQuery"); ?>

                        <div class="row">
                         <?php if($this->Admin){ ?>
                            <div class="col-sm-4">
                                 <?= lang('From Store','From Store'); ?>
                                <?php
                                $wr[''] = lang("Select")." ".lang("Store");
                                foreach($stores as $store) {
                                    $wr[$store->id] = $store->name;
                                }
                                ?>
                                <?= form_dropdown('store_id', $wr, set_value('store_id'), 'class="form-control select2 tip" id="store_id" required="required" style="width:100%;"'); ?> 
                            </div>
                            <?php } ?>
                            <div class="col-xs-4">

                                <div class="form-group">

                                    <label class="control-label"><?= lang("Type"); ?></label>

                                    <?php
                                    $pr[0] = lang("select")." ".lang("type");
                                        $pr['sales'] = 'Sales';
                                        $pr['purchase'] = 'Purchase';

                                    echo form_dropdown('type', $pr, set_value('type'), 'class="form-control select2" style="width:100%" id="type" required="required"');

                                    ?>


                                </div>

                            </div> 

                            <div class="col-xs-4">
                                <div class="form-group">

                                    <label class="control-label" for="pcode"><?= lang("Product Code"); ?></label>

                                    <?php

                                    $cu[0] = lang("select")." ".lang("Product code");

                                    foreach($products as $pcodes){

                                        $cu[$pcodes->code] = $pcodes->code;

                                    }

                                    echo form_dropdown('pcode', $cu, set_value('pcode'), 'class="form-control select2" style="width:100%" id="pcode"'); ?>

                                </div>
                            </div>

                            <div class="col-xs-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>

                    </div>

                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-xs-12">

                            <div class="table-responsive" id="page_content">
                                <?php if($type=='sales'){?>
                                <table id="fileData" class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">
                                
                                    <thead>
                                        <tr class="active">
                                            <th class="col-xs-1">Inv id</th>
                                            <th class="col-xs-1">Product Code</th>
                                            <th class="col-xs-3">Sequence</th>
                                            <th class="col-xs-1">Quantity</th>
                                            <th class="col-xs-1">unit price</th>
                                            <th class="col-xs-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  
                                        $selsQty = 0;             
                                        if(isset($results)){
                                            foreach ($results as $key => $result) { 
                                                $selsQty = $selsQty + $result->quantity; 
                                                ?>
                                                <tr>
                                                    <td><?php echo $result->sale_id; ?></td>
                                                    <td><?php echo $_POST['pcode']; ?> </td>
                                                    <?php
                                                    $sequences = $this->site->getWhereDataByElement('pro_sequence','pro_id','sales_id',$result->product_id,$result->sale_id); ?>
                                                    <td> <?php 
                                                        if(!is_bool($sequences))
                                                        {
                                                            foreach ($sequences as $key => $sequence) {
                                                            echo $sequence->sequence.', ';
                                                            } 
                                                        }
                                                        ?> 
                                                    </td>
                                                    <td><?php echo $result->quantity; ?> </td>
                                                    <td><?php echo $result->unit_price; ?></td> 
                                                    <td><div class="btn-group">                
                                                        <a href="#" onclick="MyWindow=window.open('<?php echo site_url('pos/view/') .'/'.$result->sale_id; ?>', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;" title="" class="tip btn btn-primary btn-xs" data-original-title="view collection"><i class="fa fa-list"></i></a> 
                                                        </div></td>
                                                </tr>                                      
                                                <?php 
                                            } 
                                        }?>
                                     <tr>  
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;">Total Qty</td>
                                        <td><?php echo $selsQty; ?></td>                                        
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    </tbody> 
                                    <?php } ?>

                                    <?php if($type=='purchase'){?>
                                    <table class="table table-striped table-bordered table-hover" style="margin-bottom:5px;">
                                    <thead>
                                        <tr class="active">
                                            <th class="col-xs-1">Purchase id</th>
                                            <th class="col-xs-1">Product Code</th>
                                            <th class="col-xs-3">Sequence</th>
                                            <th class="col-xs-1">Quantity</th>
                                            <th class="col-xs-1">Cost price</th>
                                            <th class="col-xs-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php //print_r($results); 
                                        $purQty = 0;   
                                        if(isset($results)){       
                                            foreach ($results as $key => $result) { 
                                                $purQty =  $purQty+$result->quantity;
                                                ?>
                                                <tr>
                                                    <td><?php echo $result->purchase_id; ?></td>
                                                    <td><?php echo $_POST['pcode']; ?> </td>
                                                    <?php
                                                    $sequences = $this->site->getWhereDataByElement('pro_sequence','pro_id','purchases_id',$result->product_id,$result->purchase_id); ?>
                                                    <td> <?php  
                                                        if(!is_bool($sequences))
                                                        {
                                                            foreach ($sequences as $key => $sequence) {
                                                            echo $sequence->sequence.', ';
                                                            } 
                                                        }
                                                    ?> 
                                                    </td>
                                                    <td><?php echo $result->quantity; ?> </td>
                                                    <td><?php echo $result->cost; ?></td>
                                                    <td><div class="btn-group">                
                                                        <a href="#" onclick="MyWindow=window.open('<?php echo site_url('purchases/view/') .'/'.$result->purchase_id; ?>', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;" title="" class="tip btn btn-primary btn-xs" data-original-title="view collection"><i class="fa fa-list"></i></a> 
                                                        </div></td>
                                                </tr>                                       
                                            <?php }
                                        } 
                                        ?>
                                         <tr>  
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;">Total Qty</td>
                                        <td><?php echo $purQty; ?></td>                                        
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tr>
                                    </tbody> 
                                    <?php } ?>

                                </table> 
                            </div>

                        </div>

                    </div>
                    
                </div>

            </div>

        </div>

    </div>

</section> 

