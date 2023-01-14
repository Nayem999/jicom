<style>

.table td { width: 8.333%; }

.table tr:first-child td { text-align:center; }

.table tr:last-child td { text-align:right; }

</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">
					<button type="button" onclick="printIt()" style="width:120px; float:right" class="btn bg-navy btn-block btn-flat" id="daily_sales">Print report</button>
                    <h3 class="box-title"><span class='text-warning'><?=$this->lang->line('tax')?> = <?= lang('orange'); ?></span>, <?=$this->lang->line('discount')?> = <?= lang('grey'); ?> &amp; <span class='text-success'><?=$this->lang->line('total')?> = <?= lang('green'); ?></span></h3>


                <?= form_open("reports/monthly_sales/"); ?>
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
                            <?= form_dropdown('warehouse', $wr, set_value('warehouse'), 'class="form-control select2 tip" id="warehouse" required="required" style="width:100%;"'); ?> 
                        </div>
                        </div>
                        <div class="col-xs-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>
                    <?php } ?>
                    </div>
                <?= form_close();?>

                </div>

                <div class="box-body">

                    <div class="col-sm-12">

                        <div class="row">

                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <div class="info-box bg-aqua">

                                    <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                                    <div class="info-box-content">

                                        <span class="info-box-text"><?= lang('sales_value'); ?></span>

                                        <span class="info-box-number"><?= $this->tec->formatMoney($total_sales->total_amount) ?></span>

                                        <div class="progress">

                                            <div style="width: 100%" class="progress-bar"></div>

                                        </div>

                                        <span class="progress-description">

                                            <?= $total_sales->total .' ' . lang('sales'); ?> |

                                            <?= $this->tec->formatMoney($total_sales->paid) . ' ' . lang('received') ?> |

                                            <?= $this->tec->formatMoney($total_sales->tax) . ' ' . lang('tax') ?>

                                        </span>

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <div class="info-box bg-yellow">

                                    <span class="info-box-icon"><i class="fa fa-plus"></i></span>

                                    <div class="info-box-content">

                                        <span class="info-box-text"><?= lang('purchases_value'); ?></span>

                                        <span class="info-box-number"><?= $this->tec->formatMoney($total_purchases->total_amount) ?></span>

                                        <div class="progress">

                                            <div style="width: 0%" class="progress-bar"></div>

                                        </div>

                                        <span class="progress-description">

                                            <?= $total_purchases->total ?> <?= lang('purchases'); ?>

                                        </span>

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <div class="info-box bg-red">

                                    <span class="info-box-icon"><i class="fa fa-circle-o"></i></span>

                                    <div class="info-box-content">

                                        <span class="info-box-text"><?= lang('expenses_value'); ?></span>

                                        <span class="info-box-number"><?= $this->tec->formatMoney($total_expenses->total_amount) ?></span>

                                        <div class="progress">

                                            <div style="width: 0%" class="progress-bar"></div>

                                        </div>

                                        <span class="progress-description">

                                            <?= $total_expenses->total ?> <?= lang('expenses'); ?>

                                        </span>

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <div class="info-box bg-green">

                                    <span class="info-box-icon"><i class="fa fa-dollar"></i></span>

                                    <div class="info-box-content">

                                        <span class="info-box-text"><?= lang('profit_loss'); ?></span>

                                        <span class="info-box-number"><?= $this->tec->formatMoney($total_sales->total_amount-$total_purchases->total_amount-$total_expenses->total_amount) ?></span>

                                        <div class="progress">

                                            <div style="width: 100%" class="progress-bar"></div>

                                        </div>

                                        <span class="progress-description">

                                            <?= $total_sales->total_amount.' - '.$total_purchases->total_amount.' - '.$total_expenses->total_amount;?>

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="clearfix"></div>

                        <div class="calendar table-responsive" id="page_content">



                            <table class="table table-bordered" style="min-width:522px;">

                                <thead>

                                    <tr class="active">

                                        <th><div class="text-center"> <a href="<?= site_url('reports/monthly_sales/'.($year-1)); ?>">&lt;&lt;</a> </div></th>

                                        <th colspan="10"><div class="text-center"> <?php echo $year; ?> </div></td>

                                            <th><div class="text-center"> <a href="<?= site_url('reports/monthly_sales/'.($year+1)); ?>">&gt;&gt;</a> </div></th>

                                        </th>

                                    </tr>

                                </thead>

                                <tr>

                                    <td><?= lang('cal_january'); ?></td>

                                    <td><?= lang('cal_february'); ?></td>

                                    <td><?= lang('cal_march'); ?></td>

                                    <td><?= lang('cal_april'); ?></td>

                                    <td><?= lang('cal_may'); ?></td>

                                    <td><?= lang('cal_june'); ?></td>

                                    <td><?= lang('cal_july'); ?></td>

                                    <td><?= lang('cal_august'); ?></td>

                                    <td><?= lang('cal_september'); ?></td>

                                    <td><?= lang('cal_october'); ?></td>

                                    <td><?= lang('cal_november'); ?></td>

                                    <td><?= lang('cal_december'); ?></td>

                                </tr>

                                <tr>

                                    <?php

                                    if(!empty($sales)) {



                                        foreach($sales as $value) {

                                            $array[$value->date] = "<span class='text-warning'>". $value->tax."</span><br>".$value->discount."<br><span class='text-success'>".$value->total."</span><br><span style='border-top:1px solid #DDD; display:block;'>".$value->grand_total."</span>";

                                        }



                                        for ($i = 1; $i <= 12; $i++){

                                            echo "<td>";

                                            if(isset($array[$i])) {

                                                echo $array[$i];

                                            } else {

                                                echo "<span class='text-warning'>0.00</span><br>0.00<br><span class='text-success'>0.00</span><br><span style='border-top:1px solid #DDD;display:block;'>0.00</span>";

                                            }

                                            echo "</td>";

                                        }



                                    } else {

                                        for($i=1; $i<=12; $i++) {

                                            echo "<td><span class='text-warning'>0.00</span><br>0.00<br><span class='text-success'>0.00</span><br><span style='border-top:1px solid #DDD;display:block;'>0.00</span></td>";

                                        }

                                    }

                                    ?>

                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
<script>

 $("#daily_sales").click(function () {
	 
	$(".text-center a ").css("display", "none");
	
	 var content = "<html> <br> <h2 style='text-align:center'> Monthly Sales <br></h2>";
	 content += document.getElementById("page_content").innerHTML ;
     content += "</body>";
     content += "</html>";
	 var printWin = window.open('','','left=20,top=40,width=850,height=700,toolbar=12,scrollbars=50,status =0');
	 printWin.document.write('<link rel="stylesheet" href="http://localhost/spos-new/themes/default/assets/bootstrap/css/bootstrap.min.css" type="text/css" />');

     printWin.document.write(content);
     
	 printWin.focus();
     printWin.print();
	 printWin.close();
   
    // window.print();            
            
  });

</script>
