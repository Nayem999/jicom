<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="panel-body">
                        <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm pull-right" id="excelWindow">Download Report</button>
                        <button type="button" style="width:120px; float:right; display:none;" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button>
                        <?= form_open(""); ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>
                                    <?= form_input('start_date', set_value('start_date'), 'class="form-control datepicker" id="start_date"'); ?>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>
                                    <?= form_input('end_date', set_value('end_date'), 'class="form-control datepicker" id="end_date"'); ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                    <div class="table-responsive" >
                        <div style='text-align:center'><b>Date: <?=date('d-M-Y',strtotime($start_date)).' to '.date('d-M-Y',strtotime($end_date));?></b></div>
                        
                    </div>
                    <div class="table-responsive" id="print_content">
                        <div class="col-xs-12">
                            <?php
                            $salesItemQnty = $productArr = $storeArr = $cash_sale = $credit_sale = $cash_collection = $bank_collection = $chkArr = $chkArr2 = $chkArr3 = $chkArr4 = $chkArr5 = array();
                            if ($saleItem) {
                                foreach ($saleItem as $key => $result) {
                                  $productArr[$result->product_id] = $result->product_name;
                                  $storeArr[$result->store_id] = $result->store_name;
                                  if (in_array($result->store_name.'_'.$result->product_id, $chkArr)) {
                                    $salesItemQnty[$result->store_id][$result->product_id] += $result->quantity;
                                  } else {
                                    $chkArr[]=$result->store_name.'_'.$result->product_id;
                                    $salesItemQnty[$result->store_id][$result->product_id] = $result->quantity;
                                  }
                                }
                            }


                            if ($sale) {
                                foreach ($sale as $key => $result) {

                                    if($result->status=='due'){
                                        if (in_array($result->store_id, $chkArr3)) {
                                            $credit_sale[$result->store_id] += $result->grand_total;
                                        } else {
                                            $chkArr3[]=$result->store_id;
                                            $credit_sale[$result->store_id] = $result->grand_total;
                                        }
                                    }
                                    else
                                    {
                                        if($result->paid_by=='cash'){
                                            if (in_array($result->store_id, $chkArr2)) {
                                                $cash_sale[$result->store_id] += $result->paid;
                                            } else {
                                                $chkArr2[]=$result->store_id;
                                                $cash_sale[$result->store_id] = $result->paid;
                                            }
                                        }
                                    }
                                }
                            }

                            
                            if ($saleCollection) {
                                foreach ($saleCollection as $key => $result) {
                                    $storeArr[$result->store_id] = $result->store_name;
                                    if($result->paid_by=='cash'){
                                        if (in_array($result->store_id, $chkArr4)) {
                                            $cash_collection[$result->store_id] += $result->payment_amount;
                                        } else {
                                            $chkArr4[]=$result->store_id;
                                            $cash_collection[$result->store_id] = $result->payment_amount;
                                        }
                                    }
                                    else
                                    {
                                        if (in_array($result->store_id, $chkArr5)) {
                                            $bank_collection[$result->store_id] += $result->payment_amount;
                                        } else {
                                            $chkArr5[]=$result->store_id;
                                            $bank_collection[$result->store_id] = $result->payment_amount;
                                        }
                                    }
                                }
                            }
                            // print_r($cash_sale);print_r($credit_sale);die;
                            ?>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <?php
                                          foreach ($productArr as $key => $val) 
                                          {
                                              ?>
                                                  <th>
                                                    <?php echo $val ?>
                                                  </th> 
                                              <?php
                                          }
                                        ?>
                                        <th> Cash Sale </th>
                                        <th> Credit Sale</th>
                                        <th> Cash Collection</th>
                                        <th> Chq/TT Collection</th>
                                    </tr>
                                    <?php
                                    $total_cash_sale = $total_credit_sale = $total_cash_collection = $total_bank_collection = 0;
                                    // print_r($total_item_qty);die;
                                    $total_item_qty = array();
                                    if ($storeArr) {
                                        foreach ($storeArr as $storeId => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $result; ?></td>
                                                <?php
                                                foreach ($productArr as $key => $val) {
                                                ?><td><?php echo isset($salesItemQnty[$storeId][$key]) ? $salesItemQnty[$storeId][$key] : 0; ?></td> <?php
                                                  if (isset($salesItemQnty[$storeId][$key])) {
                                                    if (array_key_exists($key, $total_item_qty)) {
                                                      $total_item_qty[$key] += $salesItemQnty[$storeId][$key];
                                                    } else {
                                                      $total_item_qty[$key] = $salesItemQnty[$storeId][$key];
                                                    }
                                                  } else {
                                                    if (array_key_exists($key, $total_item_qty)) {
                                                      $total_item_qty[$key] += 0;
                                                    } else {
                                                      $total_item_qty[$key] = 0;
                                                    }
                                                  }
                                                }
                                              ?>
                                                <td>
                                                    <?php 
                                                        if(isset($cash_sale[$storeId])){
                                                            echo $cash_sale[$storeId];
                                                            $total_cash_sale +=$cash_sale[$storeId];
                                                        }else{ echo '0';}
                                                ?></td>
                                                <td>
                                                    <?php 
                                                        if(isset($credit_sale[$storeId])){
                                                            echo $credit_sale[$storeId];
                                                            $total_credit_sale +=$credit_sale[$storeId];
                                                        }else{ echo '0';}
                                                ?></td>
                                                <td>
                                                    <?php 
                                                        if(isset($cash_collection[$storeId])){
                                                            echo $cash_collection[$storeId];
                                                            $total_cash_collection +=$cash_collection[$storeId];
                                                        }else{ echo '0';}
                                                ?></td>
                                                <td>
                                                    <?php 
                                                        if(isset($bank_collection[$storeId])){
                                                            echo $bank_collection[$storeId];
                                                            $total_bank_collection +=$bank_collection[$storeId];
                                                        }else{ echo '0';}
                                                ?></td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> Grand Total</th>
                                        <?php
                                            foreach ($productArr as $key => $val) {
                                            ?><th><?php echo $total_item_qty[$key];?></th> <?php
                                            }
                                        ?>
                                        <th> <?php echo $total_cash_sale ;?>  </th>
                                        <th> <?php echo $total_credit_sale ;?> </th>
                                        <th> <?php echo $total_cash_collection ;?> </th>
                                        <th> <?php echo $total_bank_collection ;?> </th>
                                    </tr>
                                </tfoot>
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
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
</script>
<script>
    $("#printWindow").click(function() {
        $(".dataTables_info").css("display", "none");
        $(".dataTables_length, .dataTables_filter ").css("display", "none");

        $(".dataTables_paginate ").css("display", "none");
        $("#fileData_filter ").css("display", "none");
        var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Daily Statement | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
        content += document.getElementById("print_content").innerHTML;
        content += "</body>";
        content += "</html>";
        var printWin = window.open('', '', 'left=20,top=40,width=700,height=550 ');
        printWin.document.write(content);
        printWin.focus();
        printWin.print();
        printWin.close();
        $(".dataTables_info").css("display", "block");
        $(".dataTables_length, .dataTables_filter ").css("display", "block");
        $(".dataTables_paginate ").css("display", "block");
        $("#fileData_filter ").css("display", "block");
    });
    $("#excelWindow").click(function() {
        var data = $("#start_date").val() + '_' + $("#end_date").val();
        var url = '<?= site_url('reports/get_excel_sales/'); ?>' + '/' + data;
        location.replace(url);
    });
</script>