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
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="active">

                                        <th style="width: 150px;" ><?php echo $this->lang->line("date"); ?></th>

                                        <th>Inv NO </th>

                                        <th><?php echo $this->lang->line("customer"); ?></th>

                                        <th>Store Name</th>	

                                        <th title="Customer phone number">C.Phone</th>

                                        <th class="col-xs-1"><?php echo $this->lang->line("total"); ?></th>

                                        <th style="width: 20px;"><?php echo $this->lang->line("tax"); ?></th>

                                        <th><?php echo $this->lang->line("discount"); ?></th>

                                        <th style="width: 20px;"><?php echo $this->lang->line("grand_total"); ?></th>

                                        <th class="col-xs-1"><?php echo $this->lang->line("paid"); ?></th>

                                        <th class="col-xs-1"><?php echo $this->lang->line("P.By"); ?></th>

                                        <th class="col-xs-1"><?php echo $this->lang->line("balance"); ?></th>

                                        <th style="width: 40px;"><?php echo $this->lang->line("status"); ?></th>

                                        <th class="col-xs-1"><?php echo 'Cheque Status'; ?></th>
                                        <th class="col-xs-1"><?php echo 'Aging Day'; ?></th>

                                        <th style="width:205px; text-align:center;"><?php echo $this->lang->line("actions"); ?></th>

                                    </tr>
                                </thead>
                                </tbody>
                                    <?php
    
                                    if ($agingRpt) {
                                        foreach ($agingRpt as $key => $result) {
                                            $date1=date_create(date('Y-m-d',strtotime($result->date)));
                                            $date2=date_create(date('Y-m-d'));
                                            $diff=date_diff($date1,$date2);
                                            $day_diff=$diff->format("%d");
                                            if($day_diff>$result->aging_day)
                                            {
                                                $bg_clr="background-color: #FFFF00";
                                            }
                                            else
                                            {
                                                $bg_clr="";
                                            }

                                        ?>
                                            <tr style="<?=$bg_clr?>">
                                                <td><?= date('d-M-Y',strtotime($result->date)); ?></td>
                                                <td><?= $result->invoice; ?></td>
                                                <td><?= $result->customer_name; ?></td>
                                                <td><?= $result->storename; ?></td>
                                                <td><?= $result->phone; ?></td>
                                                <td><?= $result->total; ?></td>
                                                <td><?= $result->total_tax; ?></td>
                                                <td><?= $result->total_discount; ?></td>
                                                <td><?= $result->grand_total; ?></td>
                                                <td><?= $result->paid; ?></td>
                                                <td><?= $result->paid_by; ?></td>
                                                <td><?= $result->grand_total-$result->paid; ?></td>
                                                <td><?= $result->status; ?></td>
                                                <td><?= $result->type; ?></td>
                                                <td><?= $day_diff.'/'.$result->aging_day; ?></td>
                                                <td><button class="btn" type="checkbox" name="tickervalda" onclick="tickerval(<?=$result->invoice?>)" >Change Status</button ></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
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
<script type="text/javascript">

    function tickerval(id){
        var url = '<?php echo base_url("pos/aging_status"); ?>/'+id;
        location.replace(url);
    }

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
        var data = $("#start_date").val() + '_' + $("#end_date").val()+ '_' + $("#store_id").val();
        var url = '<?= site_url('reports/excel_aging_rpt/'); ?>' + '/' + data;
        location.replace(url);
    });
</script>