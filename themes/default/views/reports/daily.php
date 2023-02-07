<?php
$v = "?v=1";
if (isset($_POST['start_date'])) {
    $v .= "&start_date=" . $this->input->post('start_date');
    $start_date = $this->input->post('start_date');
}
// $previousBanance=$handcash->amount;
?>
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
                                    <?= lang('Store', 'Store'); ?>
                                    <?php
                                    $wr[0] = lang("select") . " " . lang("Store");
                                    foreach ($stores as $store) {
                                        $wr[$store->id] = $store->name;
                                    }
                                    ?>
                                    <?= form_dropdown('store_id', $wr, set_value('store_id'), 'class="form-control select2 tip" id="store_id" required="required" style="width:100%;"'); ?>
                                </div>
                            </div>
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
                    <div class="table-responsive" id="print_content">
                        <div class="col-xs-12">
                            <?php
                            $salesItemQnty = array();
                            $productArr = array();
                            if ($dailySaleItem) {
                                foreach ($dailySaleItem as $key => $result) {
                                  $productArr[$result->product_id] = $result->product_name;
                                  $salesItemQnty[$result->sale_id][$result->product_id] = $result->quantity;
                                }
                            }
                            // print_r($productArr);die;

                           
                            ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center"> SL</th>
                                        <th class="text-center"> Inv. No</th>
                                        <th class="text-center"> Customer</th>
                                        <?php
                                          foreach ($productArr as $key => $val) 
                                          {
                                              ?>
                                                  <th class="text-center">
                                                    <?php echo $val ?>
                                                  </th> 
                                              <?php
                                          }
                                        ?>
                                        <th class="text-center"> Cash </th>
                                        <th class="text-center"> CHEQ/TT</th>
                                        <th class="text-center"> Bank</th>
                                        <th class="text-center"> Credit</th>
                                    </tr>
                                    <?php
                                    $total_qnty = 0;
                                    $total_cash = 0;
                                    $total_cheque = 0;
                                    $total_cc = 0;
                                    // print_r($dailySale);die;
                                    $total_item_qnty = array();
                                    if ($dailySale) {
                                        $i = 1;
                                        foreach ($dailySale as $key => $result) {
                                        ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $result->sale_id; ?></td>
                                                <td><?= $result->customer_name; ?></td>
                                                <?php
                                                foreach ($productArr as $key => $val) {
                                                ?><td><?php echo isset($salesItemQnty[$result->sale_id][$key]) ? $salesItemQnty[$result->sale_id][$key] : 0; ?></td> <?php
                                                  if (isset($salesItemQnty[$result->sale_id][$key])) {
                                                    if (array_key_exists($key, $total_item_qnty)) {
                                                      $total_item_qnty[$key] += $salesItemQnty[$result->sale_id][$key];
                                                    } else {
                                                      $total_item_qnty[$key] = $salesItemQnty[$result->sale_id][$key];;
                                                    }
                                                  } else {
                                                    if (array_key_exists($key, $total_item_qnty)) {
                                                      $total_item_qnty[$key] += 0;
                                                    } else {
                                                      $total_item_qnty[$key] = 0;
                                                    }
                                                  }
                                                }
                                              ?>
                                                <td><?php if ($result->paid_by == "cash") {
                                                        echo $result->payment_amount;
                                                        $total_cash += $result->payment_amount;
                                                    } ?></td>
                                                <td><?php if ($result->paid_by == "Cheque" || $result->paid_by == "TT") {
                                                        echo $result->payment_amount;
                                                        $total_cheque += $result->payment_amount;
                                                    } ?></td>
                                                <td><?php if ($result->paid_by == "Cheque" || $result->paid_by == "TT") {
                                                        echo $result->bank_name;
                                                    } ?></td>
                                                <td><?php if ($result->status == "due") {
                                                        echo $result->grand_total;
                                                        $total_cc += $result->grand_total;
                                                    }else if ($result->status == "partial"){
                                                        echo $result->grand_total - $result->paid;
                                                        $total_cc += $result->grand_total - $result->paid;
                                                    }  ?></td>

                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th> </th>
                                        <th></th>
                                        <th class="text-center"> Grand Total</th>
                                        <?php
                                            foreach ($productArr as $key => $val) {
                                            ?><th class="text-center"><?php echo $total_item_qnty[$key];?></th> <?php
                                            }
                                        ?>
                                        <th class="text-center"> <?php echo $total_cash ;?>  </th>
                                        <th class="text-center"> <?php echo $total_cheque ;?> </th>
                                        <th class="text-center"> </th>
                                        <th class="text-center"> <?php echo $total_cc ;?> </th>
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
        var data = $("#start_date").val() + '_' + $("#end_date").val() + '_' + $("#store_id").val();
        var url = '<?= site_url('reports/excel_daily_sales/'); ?>' + '/' + data;
        location.replace(url);
    });
</script>