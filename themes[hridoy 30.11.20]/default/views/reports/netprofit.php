
<section class="content">
    <div class="row">

        <div class="col-sm-12">

            <div class="box box-primary">                

                <?php if($this->session->userdata('group_id') == 2){

                        $u_id = $this->session->userdata('user_id') ;
                        }else{
                            $u_id = NULL;
                         };                 
                      $day = date('Y-m-d');
                      if($today == date('Y-m-d')) {
                        $todayresult = 'Today\'s ';
                      } else {
                        $todayresult = 'Date : '.$this->tec->hrsd($today);
                      }
                      ?>
                <div class="box-body">
                <div id="form" class="panel panel-warning">

                        <div class="panel-body">

                        <?= form_open("reports/netprofit/");?>

                        <div class="row">
                        <?php if($this->Admin){ ?>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang('Warehouse','Warehouse'); ?>
                                <?php
                                $wr[''] = lang("select")." ".lang("warehouse");
                                foreach($warehouses as $warehouse) {
                                    $wr[$warehouse->id] = $warehouse->name;
                                }
                                ?>
                                <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="warehouse" style="width:100%;"'); ?> 
                            </div>
                          </div> 
                        <?php } ?>

                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="date"><?= lang("Start date"); ?></label>

                                    <?= form_input('start_date', set_value('date'), 'class="form-control datepicker" id="start_date"');?>

                                </div>

                            </div>
                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="date"><?= lang("End date"); ?></label>

                                    <?= form_input('end_date', set_value('date'), 'class="form-control datepicker" id="end_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>

                    </div>
                <div class="table-responsive">
                    <div class="col-xs-6"> 
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                              <th colspan="2" style="text-align:center" >
                              <div class="btn-lg bg-purple btn-block"><h4 class="box-title"><?= $todayresult; ?> Profit information</h4></div></th>
                            </tr>
                              <tr>
                                <th class="col-xs-3"><?php echo $todayresult; ?> Sales Profit</th>
                                <th class="col-xs-2"><?php echo $this->tec->formatMoney($dailySalesProfitAmount); ?></th>
                              </tr>                              
                              <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Expense Amount </th>                                     
                                <th class="col-xs-2"><?php echo $this->tec->formatMoney($dailyExpensAmount); ?></th>
                              </tr>
                              <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Net Profit</th>                                     
                                <th class="col-xs-2"><?php
                                 echo $this->tec->formatMoney($dailyNetProfit); ?></th>
                              </tr>                           
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-6">                     
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                              <th colspan="2" style="text-align:center" >
                              <div class="btn-lg btn-success btn-block"><h4 class="box-title">Total Profit information</h4></div></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3">Total Sale Profit</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($totalSalesProfitAmount); ?></th>
                            </tr>
                             <tr>
                              <th class="col-xs-3">Total Expense</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($totalExpensAmount); ?></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3">Total Net Profit </th>                                     
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($totalNetProfit); ?></th>
                            </tr>
                         </tbody>
                        </table>
                    </div>
                    <?php
                    if($endate !=''){
                        $enddate = ' To '. $this->tec->hrsd($endate);
                    }else{
                      $enddate = '';
                    }
                    if($stdate !='')
                      $startDate = $this->tec->hrsd($stdate);
                      else
                      $startDate ='';
                    if($startDate ==''){
                      $staticStr = "Search Result";
                    }
                    ?>
                    <div class="col-xs-6">                     
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                              <th colspan="2" style="text-align:center" >
                              <div class="btn-lg btn-success btn-block"><h4 class="box-title"><?= $startDate.$enddate.$staticStr; ?> Profit information</h4></div></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3"> Sale Profit</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($betwDateSale) ; ?></th>
                            </tr>
                             <tr>
                              <th class="col-xs-3">  Expense</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($betwDateExpans); ?></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3"> Net Profit </th>                                     
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($bwtwDateNetProfit); ?></th>
                            </tr>
                         </tbody>
                        </table>
                    </div>
                   
                    <div class="clearfix"></div>
                </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-sm-12">

                            <div class="table-responsive" id="page_content">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function () {

        $('.datepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });

</script>
<script>

 $("#daily_sales").click(function () {
   
  $(".text-center a ").css("display", "none");
  
   var content = "<html> <br> <h2 style='text-align:center'>Sales Report <br></h2>";
   content += document.getElementById("page_content").innerHTML ;
     content += "</body>";
     content += "</html>";
   var printWin = window.open('','','left=20,top=40,width=600,height=500,toolbar=0,scrollbars=0,status =0');
   printWin.document.write('<link rel="stylesheet" href="http://localhost/spos-new/themes/default/assets/bootstrap/css/bootstrap.min.css" type="text/css" />');

     printWin.document.write(content);
     
   printWin.focus();
     printWin.print();
   printWin.close();
   
    // window.print();            
            
  });

</script>

