<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html>
    <head>
    <meta charset="UTF-8">
    <title>
    <?= $page_title.' | '.$Settings->site_name; ?>
    </title>
    <link rel="shortcut icon" href="<?= $assets ?>img/icon.png"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= $assets ?>plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?= $assets ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
body {
	background-color: #ecf0f5;
}
.table th {
	text-align: center;
}
</style>
    </head>

    <body>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <h1>
            <?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="'.$assets.'/images/icon.png" alt="'.$Settings->site_name.'" />'; ?>
          </h1>
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">
                <?= lang('purchase').' # '.$purchase->id; ?>
              </h3>
            </div>
            <div class="box-body">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="col-xs-2"><?= lang('date'); ?></td>
                            <td class="col-xs-10"><?= $this->tec->hrld($purchase->date); ?></td>
                          </tr>
                          <tr>
                            <td class="col-xs-2">S. Name</td>
                            <td class="col-xs-10"><?php echo $s_name; ?></td>
                          </tr>
                          <tr>
                            <td class="col-xs-2"><?= lang('reference'); ?></td>
                            <td class="col-xs-10"><?= $purchase->reference; ?></td>
                          </tr>
                         
                          <?php

                              if($purchase->attachment) {

                              ?>
                          <tr>
                            <td class="col-xs-2"><?= lang('attachment'); ?></td>
                            <td class="col-xs-10"><a href="<?=base_url('uploads/'.$purchase->attachment);?>">
                              <?= $purchase->attachment; ?>
                              </a></td>
                          </tr>
                          <?php

                              }

                              if($purchase->note) {

                             ?>
                          <tr>
                            <td class="col-xs-2"><?= lang('note'); ?></td>
                            <td class="col-xs-10"><?= $purchase->note; ?></td>
                          </tr>
                          <?php

                            }

                            ?>
                        </tbody>
                      </table>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr class="active">
                              <th><?= lang('product'); ?></th>
                              <th class="col-xs-2"><?= lang('quantity'); ?></th>
                              <th class="col-xs-2"><?= lang('store_name'); ?></th>
                              <th class="col-xs-2"><?= lang('Warranty'); ?></th>
                              <th class="col-xs-2"><?= lang('unit_cost'); ?></th>
                              <th class="col-xs-2"><?= lang('subtotal'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                          if($items) {

                            $ProQty = 0; 
                            //print_r($items );

                          foreach ($items as $item) { 

                            $ProQty = $ProQty+$item->quantity;

                              echo '<tr>';

                              echo '<td>'.$item->product_name.' ('.$item->product_code.')</td>';

                              echo '<td class="text-center">'.$item->quantity.'</td>';

                              echo '<td class="text-center">'. $this->site->findeNameByID('stores','id',$item->store_id)->name.'</td>';
                              $sequences = $this->site->getWhereDataByElement('pro_sequence','pro_id','purchases_id',$item->product_id,$item->purchase_id);   

                              echo '<td class="text-right">'; 
                              $expiry_year =  $item->expiry_year;
                              if($expiry_year=='0.00'){
                                echo "Not warranty";

                              }elseif($expiry_year=='1.00') {
                                echo $expiry_year.'year';
                              }else{
                                echo $expiry_year.'years';;
                              }

                              echo '</td>';

                              echo '<td class="text-right">'.$item->cost.'</td>';

                              echo '<td class="text-right">'.$item->quantity*$item->cost.'</td>';

                              echo '</tr>';

                              }

                            }

                            ?>
                          </tbody>
                          <thead>
                            <tr class="active">
                              <th class="col-xs-2" colspan="4"></th> 
                              <th style="text-align:right"><?= lang('Quantity'); ?>
                                </th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?php echo $ProQty; ?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="4"></th>
                              <th style="text-align:right"><?= lang('total'); ?>
                                </th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?= number_format($purchase->total,2);?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="4"></th>
                              <th style="text-align:right">Paid Amount</strong></th>
                              <th class="col-xs-2 text-right" style="text-align:right"> <?php echo number_format($paid_amount,2) ; ?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="4"></th>
                              <th style="text-align:right">Due Amount</strong></th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?php echo number_format($due_amount,2) ; ?></th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <?php if((count($pay) > 0) && ($pay[0]->amount !='')){ ?>
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 id="myModalLabel" class="modal-title">Payment Records</h4>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                      <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover table-striped" id="CompTable">
                        <thead>
                          <tr>
                            <th style="width:20%;">Date</th>
                            <th style="width:15%;">Note</th>
                            <th style="width:5%;">Reference</th>
                            <th style="width:15%;">Paid by</th>
                            <th style="width:15%;">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if(isset($pay) && (count($pay) > 0)){
                            foreach($pay as $value){
                                //print_r($value);
                                 ?>
                          <tr class="row13">
                            <td><?php echo  $this->tec->hrld($value->date); ?></td>
                            <td><?php echo $value->note ?></td>
                            <td><?php echo $value->reference ?></td>
                            <td><?php echo $value->paid_by ; 
										if($value->cc_no !=''){
											echo $value->cc_noho ;
											}
										
										?></td>
                      <th class="text-right"><?php echo $value->amount ?></th>
                    </tr>
                    <?php }
                          }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div
    ></section>
</body>
</html>
