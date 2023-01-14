<?php

if ($modal) {

    echo '<div class="modal-dialog no-modal-header"><div class="modal-content"><div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i></button>';

} else { ?>

    <!doctype html>

    <html>

    <head>

        <meta charset="utf-8">

        <title><?= $page_title . " " . lang("no") . " " . $parts[0]->service_id;; ?></title>

        <base href="<?= base_url() ?>"/>

        <meta http-equiv="cache-control" content="max-age=0"/>

        <meta http-equiv="cache-control" content="no-cache"/>

        <meta http-equiv="expires" content="0"/>

        <meta http-equiv="pragma" content="no-cache"/>

        <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>

        <link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <style type="text/css" media="all">

            body { color: #000; }

            #wrapper { max-width: 480px; margin: 0 auto; padding-top: 80px; }

            .btn { border-radius: 0; margin-bottom: 5px; }

            .table { border-radius: 3px; }

            .table th {
			   background: #f5f5f5; 
			   font-size: 13px;
			   }
			
            .table th, .table td { vertical-align: middle !important; }

            h3 { margin: 5px 0; }

			.signature {
  			  margin: 30px 0 20px;
			   padding-bottom: 70px;
			}
			
			.authorized{
				border: 1px solid #efefef;
				float: left;
				height: 75px;
				padding: 5px 0 0 8px;
				width: 40%;
			}
			.customer{
				border: 1px solid #efefef;
				float: right;
				height: 75px;
				padding: 5px 8px 0 0 ;
				width: 40%;
				margin-left: 3px;
				}
			.authorized > span , .customer > span  {
				border-top: 1px solid #a0a0a1;
			}
			.warranty, .text-data{
				font-size: 12px;
			}

            @media print {

                .no-print { display: none; }

                #wrapper { max-width: 480px; width: 100%; min-width: 250px; margin: 0 auto; }

            }

        </style>

    </head>



    <body>



<?php } ?>

<div id="wrapper" style="max-width: 700px;">

    <div id="receiptData">

    <div class="no-print">

        <?php if ($message) { ?>

            <div class="alert alert-success">

                <button data-dismiss="alert" class="close" type="button">×</button>

                <?= is_array($message) ? print_r($message, true) : $message; ?>

            </div>

        <?php } ?>

    </div>

    <div id="receipt-data">
    

        <div class="text">

                <?= $Settings->header; ?> 
     			<span style="float:left">
                <p>
                <?= lang("date").': '.$this->tec->hrld($parts[0]->date_submit); ?><br>
                <?= lang("customer").': '. $parts[0]->customer_name; ?> 
                </p>
                </span>
				<span style="float:right; font-weight: bold;">
                 Service invoice No: <?= $parts[0]->service_id; ?>
                </span>


            <div style="clear:both;"></div>

            <table class="table table-striped table-bordered">
                <thead>

                    <tr>

                        <th class="text-center col-xs-1">Model</th>

                        <th class="text-center col-xs-3">Description</th>

                        <th class="text-center col-xs-1">Quantity</th>

                        <th class="text-center col-xs-4">Problem</th>
                        
                        <th class="text-center col-xs-4">Suspect</th>
                        

                    </tr>

                </thead>

                <tbody>

                <?php

                $tax_summary = array();

                foreach ($saleItems as $row) {

                    echo '<tr  class="text-data"><td>' . $row->product_code . '</td>';

                    echo '<td>' . $row->product_name .  '</td>';

                    echo '<td>'.$row->quantity .'</td>';
					
				    echo '<td>'.$row->problem .'</td>';
					 
					echo '<td >'.$row->suspect .'</td></tr>';
					
                }

                ?>

                </tbody>

                

            </table>
            
            <?php   if((count($parts)>0) && ($parts[0]->parts_name !='')) { ?> 
            
            <table id="poTable" class="table table-striped table-bordered ">
              <thead>
                <tr class="active">
                  <th class="col-xs-3">Parts name</th>
                  <th class="col-xs-1">Quantity</th>
                  <th class="col-xs-1">Unit Cost</th>
                  <th class="col-xs-1">Subtotal</th>
                </tr>
              </thead>
              <tbody class="set">
              <?php 
			
				  // print_r($parts);
				  foreach($parts as $value){
				  ?>
              
                <tr class="text-data" >
                  <td><?php echo $value->parts_name ?></td>
                  <td class="text-right"><?php echo $value->quantity ?></td>
                  <td class="text-right"><?php echo $this->tec->formatMoney($value->unit_cost) ?></td>
                  <td class="text-right"><?php echo $this->tec->formatMoney($value->subtotal) ?></td>
                 
                </tr>
                
                <?php
				  }
				 ?>
              </tbody>
              <tfoot>
                <tr class="active">
                  <th colspan="2"></th>
                  <th class="col-xs-2 text-right">Total Amount</th>
                  <th class="col-xs-2 text-right"><?php echo $this->tec->formatMoney($parts[0]->total) ?></th>
                </tr>
                
                <tr class="active">
                  <th colspan="2"></th>
                  <th class="col-xs-2 text-right">Paid Amount</th>
                  <th class="col-xs-2 text-right"><?php echo $this->tec->formatMoney($parts[0]->paid) ?></th>
                </tr>
                
                <tr class="active">
                  <th colspan="2"></th>
                  <th class="col-xs-2 text-right">Due Amount</th>
                  <th class="col-xs-2 text-right"><?php echo $this->tec->formatMoney($parts[0]->total - $parts[0]->paid) ?></th>
                </tr>
              </tfoot>
            </table>

			<?php } ?>


            <?= $inv->note ? '<p class="text-center">' . $this->tec->decode_html($inv->note) . '</p>' : ''; ?>
            
            <div class="warranty" style="text-align:left">
            <?= $Settings->sarvice_info; ?>
            </div>
            <div class="signature" >
            <div class="authorized" ><br><br><span>Authorized Signature</span></div>
            <div class="customer"><br><br><span>Customer Signature <span></div>
            </div>
			<div style="clear:both;"></div>
            </div>

            <div class="well well-sm">

                <?= $Settings->footer; ?>

            </div>

        </div>

        <div style="clear:both;"></div>

    </div>
    
 

<?php if ($modal) {

    echo '</div></div></div></div>';

} else { ?>

<div id="buttons" style="padding-top:10px; text-transform:uppercase;" class="no-print">

    <hr>

    <?php if ($message) { ?>

    <div class="alert alert-success">

        <button data-dismiss="alert" class="close" type="button">×</button>

        <?= is_array($message) ? print_r($message, true) : $message; ?>

    </div>

<?php } ?>


         <div class="warranty-contect">
    <label>Sarvice information </label>
     <input type="radio" id="warranty"  name="warranty" checked >Yes
     <input type="radio" id="warranty-no" name="warranty">No
    
    </div>

    <?php if ($Settings->java_applet) { ?>

        <span class="col-xs-12"><a class="btn btn-block btn-primary" onClick="printReceipt()"><?= lang("print"); ?></a></span>

        <span class="col-xs-12"><a class="btn btn-block btn-info" type="button" onClick="openCashDrawer()"><?= lang('open_cash_drawer'); ?></a></span>

        <div style="clear:both;"></div>

    <?php } else { ?>

        <span class="pull-right col-xs-12">

        <a href="javascript:window.print()" id="web_print" class="btn btn-block btn-primary"

           onClick="window.print();return false;"><?= lang("web_print"); ?></a>

    </span>

    <?php } ?>

    <span class="pull-left col-xs-12"><a class="btn btn-block btn-success" href="#" id="email"><?= lang("email"); ?></a></span>



    <span class="col-xs-12">

        <a class="btn btn-block btn-warning" href="<?= site_url('pos'); ?>"><?= lang("back_to_pos"); ?></a>

    </span>

    <?php if (!$Settings->java_applet) { ?>

        <div style="clear:both;"></div>

        <div class="col-xs-12" style="background:#F5F5F5; padding:10px;">

            <p style="font-weight:bold;">Please don't forget to disble the header and footer in browser print

                settings.</p>



            <p style="text-transform: capitalize;"><strong>FF:</strong> File &gt; Print Setup &gt; Margin &amp;

                Header/Footer Make all --blank--</p>



            <p style="text-transform: capitalize;"><strong>chrome:</strong> Menu &gt; Print &gt; Disable Header/Footer

                in Option &amp; Set Margins to None</p></div>

    <?php } ?>

    <div style="clear:both;"></div>



</div>



</div>

<canvas id="hidden_screenshot" style="display:none;">



</canvas>

<div class="canvas_con" style="display:none;"></div>

<script src="<?= $assets ?>plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>

<?php if ($Settings->java_applet) {



        function drawLine($Settings)

        {

            $size = $Settings->char_per_line;

            $new = '';

            for ($i = 1; $i < $size; $i++) {

                $new .= '-';

            }

            $new .= ' ';

            return $new;

        }



        function printLine($str, $Settings, $sep = ":", $space = NULL)

        {

            $size = $space ? $space : $Settings->char_per_line;

            $lenght = strlen($str);

            list($first, $second) = explode(":", $str, 2);

            $new = $first . ($sep == ":" ? $sep : '');

            for ($i = 1; $i < ($size - $lenght); $i++) {

                $new .= ' ';

            }

            $new .= ($sep != ":" ? $sep : '') . $second;

            return $new;

        }



        function printText($text, $Settings)

        {

            $size = $Settings->char_per_line;

            $new = wordwrap($text, $size, "\\n");

            return $new;

        }



        function taxLine($name, $code, $qty, $amt, $tax)

        {

            return printLine(printLine(printLine(printLine($name . ':' . $code, '', 18) . ':' . $qty, '', 25) . ':' . $amt, '', 35) . ':' . $tax, ' ');

        }



        ?>



        <script type="text/javascript" src="<?= $assets ?>plugins/qz/js/deployJava.js"></script>

        <script type="text/javascript" src="<?= $assets ?>plugins/qz/qz-functions.js"></script>

        <script type="text/javascript">

            deployQZ('themes/<?=$Settings->theme?>/assets/plugins/qz/qz-print.jar', '<?= $assets ?>plugins/qz/qz-print_jnlp.jnlp');

            usePrinter("<?= $Settings->receipt_printer; ?>");

            <?php /*$image = $this->tec->save_barcode($inv->reference_no);*/ ?>

            function printReceipt() {

                //var barcode = 'data:image/png;base64,<?php /*echo $image;*/ ?>';

                receipt = "";

                receipt += chr(27) + chr(69) + "\r" + chr(27) + "\x61" + "\x31\r";

                receipt += "<?= printText(strip_tags(preg_replace('/\s+/',' ', $Settings->header)), $Settings); ?>" + "\n";

                receipt += " \x1B\x45\x0A\r ";

                receipt += "<?=drawLine($Settings);?>\r\n";

                //receipt += "<?php // if($Settings->invoice_view == 1) { echo lang('tax_invoice'); } ?>\r\n";

                //receipt += "<?php // if($Settings->invoice_view == 1) { echo drawLine(); } ?>\r\n";

                receipt += "\x1B\x61\x30";

                receipt += "<?= printLine(lang("sale_no") . ": " . $inv->id, $Settings) ?>" + "\n";

                receipt += "<?= printLine(lang("sales_person") . ": " . $created_by->first_name." ".$created_by->last_name, $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("customer") . ": " . $inv->customer_name, $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("date") . ": " . $this->tec->hrld($inv->date), $Settings); ?>" + "\n\n";

                receipt += "<?php $r = 1;

            foreach ($rows as $row): ?>";

                receipt += "<?= "#" . $r ." "; ?>";

                receipt += "<?= product_name(addslashes($row->product_name)); ?>" + "\n";

                receipt += "<?= printLine($this->tec->formatNumber($row->quantity)."x".$this->tec->formatMoney($row->net_unit_price+($row->item_tax/$row->quantity)) . ":  ". $this->tec->formatMoney($row->subtotal), $Settings, ' ') . ""; ?>" + "\n";

                receipt += "<?php $r++;

            endforeach; ?>";

                receipt += "\x1B\x61\x31";

                receipt += "<?=drawLine($Settings);?>\r\n";

                receipt += "\x1B\x61\x30";

                receipt += "<?= printLine(lang("total") . ": " . $this->tec->formatMoney($inv->total+$inv->product_tax), $Settings); ?>" + "\n";

                <?php if ($inv->order_tax != 0) { ?>

                receipt += "<?= printLine(lang("tax") . ": " . $this->tec->formatMoney($inv->order_tax), $Settings); ?>" + "\n";

                <?php } ?>

                <?php if ($inv->total_discount != 0) { ?>

                receipt += "<?= printLine(lang("discount") . ": " . $this->tec->formatMoney($inv->total_discount), $Settings); ?>" + "\n";

                <?php } ?>

                <?php if($Settings->rounding) { ?>

                receipt += "<?= printLine(lang("rounding") . ": " . $rounding, $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("grand_total") . ": " . $this->tec->formatMoney($inv->grand_total + $rounding), $Settings); ?>" + "\n";

                <?php } else { ?>

                receipt += "<?= printLine(lang("grand_total") . ": " . $this->tec->formatMoney($inv->grand_total), $Settings); ?>" + "\n";

                <?php } ?>

                <?php if($inv->paid < $inv->grand_total) { ?>

                receipt += "<?= printLine(lang("paid_amount") . ": " . $this->tec->formatMoney($inv->paid), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("due_amount") . ": " . $this->tec->formatMoney($inv->grand_total-$inv->paid), $Settings); ?>" + "\n\n";

                <?php } ?>

                <?php

                if($payments) {

                    foreach($payments as $payment) {

                        if ($payment->paid_by == 'cash' && $payment->pos_paid) { ?>

                receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("amount") . ": " . $this->tec->formatMoney($payment->pos_paid), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("change") . ": " . ($payment->pos_balance > 0 ? $this->tec->formatMoney($payment->pos_balance) : 0), $Settings); ?>" + "\n";

                <?php } if (($payment->paid_by == 'CC' || $payment->paid_by == 'ppp' || $payment->paid_by == 'stripe') && $payment->cc_no) { ?>

                receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("amount") . ": " . $this->tec->formatMoney($payment->pos_paid), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("card_no") . ": xxxx xxxx xxxx " . substr($payment->cc_no, -4), $Settings); ?>" + "\n";

                <?php  } if ($payment->paid_by == 'gift_card') { ?>

                receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("amount") . ": " . $this->tec->formatMoney($payment->pos_paid), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("card_no") . ": " . $payment->gc_no, $Settings); ?>" + "\n";

                <?php } if ($payment->paid_by == 'Cheque' && $payment->cheque_no) { ?>

                receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("amount") . ": " . $this->tec->formatMoney($payment->pos_paid), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("cheque_no") . ": " . $payment->cheque_no, $Settings); ?>" + "\n";

                <?php if ($payment->paid_by == 'other' && $payment->amount) { ?>

                receipt += "<?= printLine(lang("paid_by") . ": " . lang($payment->paid_by), $Settings); ?>" + "\n";

                receipt += "<?= printLine(lang("amount") . ": " . $this->tec->formatMoney($payment->amount), $Settings); ?>" + "\n";

                receipt += "<?= printText(lang("payment_note") . ": " . $payment->note, $Settings); ?>" + "\n";

                <?php }

            }



        }

    }



    /* if($Settings->invoice_view == 1) {

        if(!empty($tax_summary)) {

    ?>

                receipt += "\n" + "<?= lang('tax_summary'); ?>" + "\n";

                receipt += "<?= taxLine(lang('name'),lang('code'),lang('qty'),lang('tax_excl'),lang('tax_amt')); ?>" + "\n";

                receipt += "<?php foreach ($tax_summary as $summary): ?>";

                receipt += "<?= taxLine($summary['name'],$summary['code'],$this->tec->formatNumber($summary['items']),$this->tec->formatMoney($summary['amt']),$this->tec->formatMoney($summary['tax'])); ?>" + "\n";

                receipt += "<?php endforeach; ?>";

                receipt += "<?= printLine(lang("total_tax_amount") . ":" . $this->tec->formatMoney($inv->product_tax)); ?>" + "\n";

                <?php

                    }

                } */

                ?>

                receipt += "\x1B\x61\x31";

                <?php if ($inv->note) { ?>

                receipt += "<?= printText(strip_tags(preg_replace('/\s+/',' ', $this->tec->decode_html($inv->note))), $Settings); ?>" + "\n";

                <?php } ?>

                receipt += "<?= printText(strip_tags(preg_replace('/\s+/',' ', $Settings->footer)), $Settings); ?>" + "\n";

                receipt += "\x1B\x61\x30";

                <?php if(isset($Settings->cash_drawer_cose)) { ?>

                print(receipt, '', '<?=$Settings->cash_drawer_cose;?>');

                <?php } else { ?>

                print(receipt, '', '');

                <?php } ?>



            }



        </script>

    <?php } ?>

            <script type="text/javascript">

                $(document).ready(function () {

                    $('#email').click(function () {

                        var email = prompt("<?= lang("email_address"); ?>", "<?= $customer->email; ?>");

                        if (email != null) {

                            $.ajax({

                                type: "post",

                                url: "<?= site_url('pos/email_receipt') ?>",

                                data: {<?= $this->security->get_csrf_token_name(); ?>: "<?= $this->security->get_csrf_hash(); ?>", email: email, id: <?= $inv->id; ?>},

                                dataType: "json",

                                success: function (data) {

                                    alert(data.msg);

                                },

                                error: function () {

                                    alert('<?= lang('ajax_request_failed'); ?>');

                                    return false;

                                }

                            });

                        }

                        return false;

                    });

                });

        <?php if (!$Settings->java_applet && !$noprint) { ?>

        $(window).load(function () {

            window.print();

        });

    <?php } ?>

            </script>

</body>

</html>

<?php } ?>
<script>
$( "#warranty-no" ).click(function() {
   $(".warranty").css("display", "none");
});
$( "#warranty" ).click(function() {
   $(".warranty").css("display", "block");
});
</script>
