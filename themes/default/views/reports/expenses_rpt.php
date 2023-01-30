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
                            $expData = array();
                            $chkArr = array();$chkArr2 = array();$chkArr3 = array();$chkArr4 = array();
                            $userArr = array();
                            $cashAmt=$bankAmt=$grandAmt=array();
                            if ($expensesData) {
                                foreach ($expensesData as $key => $result) {
                                        $userArr[$result->user]=$result->user;
                                    if (array_key_exists($result->user.'_'.$result->category_id, $chkArr)) {
                                        $expData[$result->user][$result->category_id] += $result->amount;
                                    }
                                    else{
                                        $chkArr[]=$result->user.'_'.$result->category_id;
                                        $expData[$result->user][$result->category_id] = $result->amount;
                                    }

                                    if($result->paid_by=="cash")
                                    {
                                        if (array_key_exists($result->category_id, $chkArr2)) {
                                            $cashAmt[$result->category_id] += $result->amount;
                                        }
                                        else{
                                            $chkArr2[]=$result->category_id;
                                            $cashAmt[$result->category_id] = $result->amount;
                                        }
                                    }
                                    elseif($result->paid_by=="cheque" || $result->paid_by=="card"){
                                        if (array_key_exists($result->category_id, $chkArr3)) {
                                            $bankAmt[$result->category_id] += $result->amount;
                                        }
                                        else{
                                            $chkArr3[]=$result->category_id;
                                            $bankAmt[$result->category_id] = $result->amount;
                                        }
                                    }

                                    if (array_key_exists($result->category_id, $chkArr4)) {
                                        $grandAmt[$result->category_id] += $result->amount;
                                    }
                                    else{
                                        $chkArr4[]=$result->category_id;
                                        $grandAmt[$result->category_id] = $result->amount;
                                    }
                                }

                            }
                            ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center"> Name</th>
                                        <?php
                                            foreach ($categories as $key => $val) {
                                            ?><th class="text-center"><?= $val->name; ?></th> <?php
                                            }
                                        ?>        
                                        <th class="text-center"> Total</th>
                                    </tr>
                                    <?php
                                    $cash_total = $bank_total = $grand_total = 0;
                                    // print_r($dailySale);die;
                                    $total_item_amount = array();
                                    foreach ($userArr as $key => $result) {
                                        $total=0;
                                    ?>
                                        <tr>
                                            <td><?= $result; ?></td>
                                            <?php
                                                foreach ($categories as $key => $val) {
                                                    
                                                    ?>
                                                    <td>
                                                        <?php
                                                            if(isset($expData[$result][$val->cat_id]))
                                                            {
                                                                echo $expData[$result][$val->cat_id];
                                                                $total+=$expData[$result][$val->cat_id];
                                                            }
                                                            else
                                                            {
                                                                echo '0';
                                                            }
                                                     
                                                    ?></td> <?php
                                                }
                                            ?>  
                                            <td><?=$total; ?></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-center"> Cash Total</th>
                                        <?php
                                            foreach ($categories as $key => $val) {
                                                ?>
                                                <th class="text-center">
                                                    <?php                                                     
                                                    if(isset($cashAmt[$val->cat_id]))
                                                    {
                                                        echo $cashAmt[$val->cat_id];
                                                        $cash_total+=$cashAmt[$val->cat_id];
                                                    }
                                                    else
                                                    {
                                                        echo '0';
                                                    }
                                                    ?>
                                                </th> <?php
                                            }
                                        ?>  
                                        <th class="text-center"> <?=$cash_total ;?>  </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"> Bank Total</th>
                                        <?php
                                            foreach ($categories as $key => $val) {
                                                ?>
                                                <th class="text-center">
                                                    <?php 
                                                        if(isset($bankAmt[$val->cat_id]))
                                                        {
                                                            echo $bankAmt[$val->cat_id];
                                                            $bank_total+=$bankAmt[$val->cat_id];
                                                        }
                                                        else
                                                        {
                                                            echo '0';
                                                        }
                                                    ?>
                                                </th> <?php
                                            }
                                        ?>  
                                        <th class="text-center"> <?=$bank_total ;?>  </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center"> Grand Total</th>
                                        <?php
                                            foreach ($categories as $key => $val) {
                                                ?>
                                                <th class="text-center">
                                                    <?php 
                                                        if(isset($grandAmt[$val->cat_id]))
                                                        {
                                                            echo $grandAmt[$val->cat_id];
                                                            $grand_total+=$grandAmt[$val->cat_id];
                                                        }
                                                        else
                                                        {
                                                            echo '0';
                                                        }
                                                    ?>
                                                </th> <?php
                                            }
                                        ?>  
                                        <th class="text-center"> <?=$grand_total ;?>  </th>
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
        var url = '<?= site_url('reports/excel_expenses_rpt/'); ?>' + '/' + data;
        location.replace(url);
    });
</script>