<style type="text/css">.center{ text-align: center; }</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">
                <?php
                    

                 if ($this->uri->segment(3) === FALSE)
                    {
                        $product_id = '';
                    }
                    else
                    {
                        $product_id = $this->uri->segment(3);
                    } ?>
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3><br><br> 
                    <div class="padding">                        
                       <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print</button>
                        <a href="<?= base_url('loan/loaner_ledger_csv/'.$product_id) ?>" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right">Download CSV</a>
                        </div>
                </div>
                <div class="box-body" id="page_content">  
                <div class="table-responsive" >
                    <?php  
                        $loaner = $this->site->whereRow('loaner', 'id', $loaner_id);
                       // / print_r($loaner);
                    ?>
                    <p><b>Loaner Name:</b> <?=  $loaner->name; ?></p>  
                    <p><b>Loaner Phone:</b> <?=  $loaner->phone; ?></p> 
                     
                    <p><b>Address Field 1:</b> <?=  $loaner->cf1; ?></p> 
                    <p><b>Address Field 2:</b> <?=  $loaner->cf2; ?></p> 
                    <div class="clearfix"></div>
                </div>
                    <?php
                        $emptyvalue = '0.00';
                        $gtotal ='';
                        $pgtotal = '';
                        $sgtotal = '';
                        $i= 0; 
                        if($loanerinfo !=''){ 

                          ?>
                    <div class="table-responsive">
                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">
                            <thead>
                                <tr class="active">
                                    <th class="col-xs-1">Sl. No</th>
                                    <th class="col-xs-2">Date & Time </th> 
                                    <th class="col-xs-2">Payment by</th>        
                                    <th class="col-xs-2">Type</th>                                    
                                    <th class="col-xs-2">Dr</th>
                                    <th class="col-xs-3">Cr</th>
                                    <th class="col-xs-2">Balance</th>
                                </tr>
                            </thead>  
                            <tbody>
                                <?php 
                                foreach ($loanerinfo as $key => $value) {
                                    $loaner = $this->site->whereRow('loaner','id',$value->loaner_id);
                                    $i++;
                                    $gtotal = $gtotal;
                                    echo '<tr>' ;
                                        echo '<td class="center">'.$i .'</td>' ;
                                        echo '<td class="center">'.$this->tec->hrld($value->entry_date) .'</td>';  
                                        echo "<td class=\"center\">".$value->payment_type .'</td>' ; 
                                        echo "<td class=\"center\">".$value->type .'</td>' ; 
                                        if(($value->type == 'pay')){ 
                                            echo '<td class="center">'.$emptyvalue.'</td>' ;
                                        }else{
                                            echo '<td class="center">'.$this->tec->formatMoney($value->amount) .'</td>' ;
                                            $sgtotal = $sgtotal + $value->amount;                                       
                                        } 
                                        if(($value->type == 'receive')){   
                                            echo '<td class="center">'.$emptyvalue.'</td>' ;
                                        }else{
                                            echo '<td class="center">'.abs($value->amount).'</td>';
                                            $pgtotal = $pgtotal + $value->amount;
                                        }                                        
                                        $gtotal = $pgtotal - $sgtotal;
                                        echo '<td class="center">'.$gtotal. '</td>' ;
                                    echo '</tr>';                                 
                                } 
                            ?>
                            <tr>
                                <td colspan="4"></td> 
                                <td class="center"><?php echo $sgtotal; ?></td>
                                <td class="center"><?php echo $pgtotal;?></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>
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
    var content = "<html> <br><img width='800px' src='<?= base_url('themes/default/assets/images/chalan.png'); ?>'><br><p style='text-align:center'>Loaner Ledger | <?php echo $this->Settings->site_name; ?></p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
     content += document.getElementById("page_content").innerHTML;
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