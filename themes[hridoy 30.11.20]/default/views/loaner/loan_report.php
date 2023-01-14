<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">  

                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button>

                    <a href="<?= base_url('loan/loan_report_csv/') ?>" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right">Download CSV</a>
                    <div id="print_data">  
                    <table id="CuData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr> 
                            <th><?php echo $this->lang->line("Name"); ?></th>
                            <th><?php echo $this->lang->line("Receive"); ?></th>
                            <th><?php echo $this->lang->line("Pay"); ?></th>
                            
                            <th><?php echo $this->lang->line("Balance"); ?></th> 
                        </tr>
                        </thead>
                        <tbody> 
                            <?php if($loanerinfo){
                                foreach ($loanerinfo as $key => $value) { ?>
                            <tr>
                                <td><?= $value->name?></td>
                                <td><?= $in = $this->bank_model->loanIn($value->id); ?> </td>
                                <td><?= $out = $this->bank_model->loanOut($value->id); ?> </td>
                                
                                <td><?= ($out-$in) ?> </td>
                            </tr>
                            <?php   }
                            } ?> 
                        </tbody>
                    </table>
                </div>
                </div>
                <div class="clearfix"></div>
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
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>loaner Report | <?php echo $this->Settings->site_name; ?> </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
     content += document.getElementById("print_data").innerHTML;
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