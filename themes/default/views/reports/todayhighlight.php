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

                          <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button> 

                        <?= form_open("reports/todayhighlight/");?>

                        <div class="row">

                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="control-label" for="date"><?= lang("date"); ?></label>

                                    <?= form_input('date', set_value('date'), 'class="form-control datepicker" id="start_date"');?>

                                </div>

                            </div>
                            <?php if($this->Admin){ ?>
                              <div class="col-sm-4">
                              <div class="form-group">
                                   <?= lang('Store','Store'); ?>
                                  <?php
                                  $wr[''] = lang("select")." ".lang("Store");
                                  foreach($stores as $store) {
                                      $wr[$store->id] = $store->name;
                                  }
                                  ?>
                                  <?= form_dropdown('store_id', $wr, set_value('store_id'), 'class="form-control select2 tip" id="store_id" required="required" style="width:100%;"'); ?> 
                              </div>
                              </div> 
                            <?php } ?>
                            <div class="col-sm-4">
                                   <h3 class="box-title">Date : <?= $this->tec->hrsd($today); ?></h3>                             
                            </div>


                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>

                    </div>
                <div class="table-responsive" id="print_content">
                    <div class="col-xs-4"> 
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                              <th colspan="2" style="text-align:center" >
                              <div class="btn-lg bg-purple btn-block"><h4 class="box-title"><?= $todayresult; ?> Sales information</h4></div></th>
                            </tr>
                              <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Sales Amount</th>
                                <th class="col-xs-2"><?php echo $this->tec->formatMoney($salesAmount); ?></th>
                              </tr>                              
                              <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Collection Amount </th>                                     
                                <th class="col-xs-2"><?php echo $this->tec->formatMoney($collectAmount); ?></th>
                              </tr>
                              <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Sales Due Amount</th>                                     
                                <th class="col-xs-2"><?php
                                 echo $this->tec->formatMoney($deuAmount); ?></th>
                              </tr>                           
                               <!-- <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Total Cash Received</th>                                     
                                <th class="col-xs-2"><?php
                                 echo $this->tec->formatMoney($totaleceived); ?></th>
                              </tr> -->      
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-4">
                     
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                              <th colspan="2" style="text-align:center" >
                              <div class="btn-lg btn-success btn-block"><h4 class="box-title"><?= $todayresult; ?> Purchases information</h4></div></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3"><?= $todayresult; ?> Purchases Amount</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($purchAmount); ?></th>
                            </tr>
                             <tr>
                              <th class="col-xs-3"><?= $todayresult; ?> Purchases Due Amount</th>
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($purchDue); ?></th>
                            </tr>
                            <tr>
                              <th class="col-xs-3"><?= $todayresult; ?> Paid Amount </th>                                     
                              <th class="col-xs-2"><?php echo $this->tec->formatMoney($paymentAmount); ?></th>
                            </tr>
                         </tbody>
                        </table>
                    </div>
                    <div class="col-xs-4"> 
                        <table class="table table-bordered">
                          <tbody>
                          <tr>
                              <th colspan="2" style="text-align:center" >
                              <div class="btn-lg btn-block" style="cursor:default; background:#d21010; color:#fff;"><h4 class="box-title"><?= $todayresult; ?> Expenses information</h4></div></th>
                          </tr>
                            <tr>
                                <th class="col-xs-3"><?= $todayresult; ?> Expenses </th>                                     
                                <th class="col-xs-2"><?php echo $this->tec->formatMoney($expensAmount); ?></th>
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

<script>
    $("#printWindow").click(function () {   
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");

    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Today's Highlights | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
     content += document.getElementById("print_content").innerHTML;
     content += "</body>";
     content += "</html>";
     var printWin = window.open('','','left=20,top=40,width=700,height=550 '); 
     printWin.document.write(content);     
     printWin.focus();
     printWin.print();
     printWin.close(); 
     $(".dataTables_info").css("display", "block"); 
     $(".dataTables_length, .dataTables_filter ").css("display", "block");
     $(".dataTables_paginate ").css("display", "block");
     $("#fileData_filter ").css("display", "block");  
   });  
</script> 


<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function () {
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });

    });

</script> 