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
        .inv-logo {
          text-align: center;
        }
        .inv-logo img {
          width: 100%; 
        }
    </style>
    </head> 
    <body>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- <h1>
            <?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="'.$assets.'/images/icon.png" alt="'.$Settings->site_name.'" />'; ?>
          </h1> -->
          <div class="inv-logo"> 
            <img src="<?= base_url('themes/default/assets/images/chalan.png') ?>" height="200px;" alt="<?=$Settings->site_name ?>" /> 
          </div>  
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">
                <strong><?= 'Purchase # '.$mf_purchase->id; ?></strong>
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
                            <td class="col-xs-2"><strong><?= lang('date'); ?></strong></td>
                            <td class="col-xs-10"><?= $this->tec->hrld($mf_purchase->date); ?></td>
                          </tr>
                          <tr>
                            <td class="col-xs-2"><strong>S. Name</strong></td>
                            <td class="col-xs-10"><?php echo $s_name; ?></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr class="active">
                              <th><?= lang('product'); ?></th>
                              <th class="col-xs-2"><?= lang('quantity'); ?></th>
                              <th class="col-xs-2"><?= lang('Store Name'); ?></th>
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

                              echo '<td>'.$item->product_name.'</td>';

                              echo '<td class="text-center">'.str_replace('.00','',$item->quantity).'</td>';

                              echo '<td class="text-center">'. $this->site->findeNameByID('stores','id',$item->store_id)->name.'</td>';

                              echo '<td class="text-right">'.$item->cost.'</td>';

                              echo '<td class="text-right">'.$item->quantity*$item->cost.'</td>';

                              echo '</tr>';

                              }

                            }

                            ?>
                          </tbody>
                          <thead>
                            <tr class="active">
                              <th class="col-xs-2" colspan="3"></th> 
                              <th style="text-align:right"><?= lang('Quantity'); ?>
                                </th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?php echo $ProQty; ?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="3"></th>
                              <th style="text-align:right"><?= lang('total'); ?>
                                </th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?= number_format($mf_purchase->total-$mf_purchase->transport_cost,2);?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="3"></th>
                              <th style="text-align:right">Transport Cost</th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?= number_format($mf_purchase->transport_cost,2);?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="3"></th>
                              <th style="text-align:right">Grand Total</th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?= number_format($mf_purchase->total,2);?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="3"></th>
                              <th style="text-align:right">Paid Amount</strong></th>
                              <th class="col-xs-2 text-right" style="text-align:right"> <?php echo number_format($paid_amount,2) ; ?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2" colspan="3"></th>
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
                <?php if(is_array($pay) && ($pay[0]->amount !='')){ ?>
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
                            if(isset($pay) && is_array($pay)){
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
