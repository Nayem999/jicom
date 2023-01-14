<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<?php // print_r($emplyee) ; ?>
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
          
          <div class="box box-primary">
           <br><br>
           <div class="box-header">
              <h3 class="box-title">
                <?php  echo 'Employee pay salary' ; ?>
              </h3>
            </div>
            
            <div class="box-body">
              <div class="col-lg-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="table-responsive">
                    <?php
                    function monthName($id){
								if($id == 01){
									$output = 'January';
								   }elseif($id == 02){
									$output = 'February';	
								   }elseif($id == 03){
									$output = 'March';	
								   }elseif($id == 04){
									$output = 'April';	
								   }elseif($id == 05){
									$output = 'May';	
								   }elseif($id == 06){
									$output = 'June';	
								   }elseif($id == 07){
									$output = 'July';	
								   }elseif($id == 08){
									$output = 'August';	
								   }elseif($id == 09){
									$output = 'September';	
								   }elseif($id == 10){
									$output = 'October';	
								   }elseif($id == 11){
									$output = 'November';	
								   }elseif($id == 12){
									$output = 'December';	
								   }
								   return $output;
								   
								}  ?>
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="col-xs-2"> Name </td>
                            <td class="col-xs-10"><?php echo $emplyee->name ; ?></td>
                          </tr>
                          <tr>
                            <td class="col-xs-2">Position </td>
                            <td class="col-xs-10"><?php echo $emplyee->position ; ?></td>
                          </tr>
                          <tr>
                            <td class="col-xs-2">Email/Phone</td>
                            <td class="col-xs-10"><?php echo $emplyee->email ; ?> / <?php echo $emplyee->phone ; ?></td>
                          </tr>
                          <tr>
                            <td class="col-xs-2">Basic salary</td>
                            <td class="col-xs-10"> <?php echo $emplyee->basic_salary ; ?></td>
                          
                        </tbody>
                      </table>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr class="active">
                              <th>Month/Year </th>
                              <th class="col-xs-2">Basic salary</th>
                              <th class="col-xs-2">Commission</th>
                              <th class="col-xs-2">Note</th>
                              <th class="col-xs-2">Submit Date</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
						     $total_amount ='';
							 $total_commission ='';
						   if(isset($list) && (count($list) > 0)){
							  foreach($list as $value ){
								  $total_amount  =$total_amount + $value->amount ;
								  $total_commission  =$total_commission + $value->commission ;
							   ?>
                             <tr> 
                              	<td><?php echo monthName($value->month_id).'-'.$value->year ?></td>
                                <td><?php echo $value->amount ; ?></td>
                                <td><?php echo $value->commission ; ?></td>
                                <td><?php echo $value->note ; ?></td>
                                <td><?php echo $this->tec->hrld($value->pay_date) ; ?></td>
                             </tr>
                             <?php
							    }
							  } ?>
                          </tbody>
                          <thead>
                            <tr class="active">
                              <th class="col-xs-2"></th>
                              <th class="col-xs-2"></th>
                              <th class="col-xs-2"></th>
                              <th style="text-align:right">Salary </strong></th>
                              <th class="col-xs-2 text-right" style="text-align:right"><?= number_format($total_amount,2);?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2"></th>
                              <th class="col-xs-2"></th>
                              <th class="col-xs-2"></th>
                              <th style="text-align:right">Commission</strong></th>
                              <th class="col-xs-2 text-right" style="text-align:right"> <?php echo number_format($total_commission,2) ; ?></th>
                            </tr>
                            <tr class="active">
                              <th class="col-xs-2"></th>
                              <th class="col-xs-2"></th>
                              <th class="col-xs-2"></th>
                              <th style="text-align:right">Total pay</strong></th>
                              <th class="col-xs-2 text-right" style="text-align:right"> 
							  <?php echo number_format($total_commission+$total_amount,2) ; ?></th>
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
