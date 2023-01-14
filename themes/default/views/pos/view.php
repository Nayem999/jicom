<?php

function product_name($name){
    return character_limiter($name, (isset($Settings->char_per_line) ? ($Settings->char_per_line-8) : 35));
}
if ($modal) {

    echo '<div class="modal-dialog no-modal-header"><div class="modal-content"><div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">&times;</i></button>';

} else { ?>

    <!doctype html>

    <html>

    <head>

        <meta charset="utf-8">

        <title><?= $page_title . " " . lang("no") . " " . $inv->id; ?></title>

        <base href="<?= base_url() ?>"/>

        <meta http-equiv="cache-control" content="max-age=0"/>

        <meta http-equiv="cache-control" content="no-cache"/>

        <meta http-equiv="expires" content="0"/>

        <meta http-equiv="pragma" content="no-cache"/>

        <link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>

        <link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <style type="text/css" media="all">

            body { color: #000; }
            #receipt-data {margin: 195px 0px 0 0;}

            #wrapper { max-width: 660px; margin: 0 auto; padding-top: 80px; }

            .btn { border-radius: 0; margin-bottom: 5px; }

            .table, .table tr, .table th, .table td{  
                border: 1px solid #000 !important;
             } 

            .table th {
               background: #f5f5f5;  
               font-size: 11px;
               }

            h3 { margin: 5px 0; }

            .signature {
              margin: 50px 0px 0px 0px;
            }
            
            .authorized{
                border: 1px solid #efefef;
                float: right;
                height: 75px;
                padding: 5px 0 0 8px;
                width: 40%;
            }
            .customer{
                border: 1px solid #efefef;
                float: left;
                height: 75px;
                padding: 5px 8px 0 0 ;
                width: 40%;
                margin-left: 3px;
                }
            .authorized > span , .customer > span  {
                border-top: 1px solid #a0a0a1;
            }
            .authorized span { 
                float: right;
            }
            .warranty {
                font-size: 12px;
            }
            #word-of-amount {
                text-transform: uppercase;
                font-size: 11px;
            }
            .hrber {
                border-bottom: 1px solid #000;
                width: 100%; }
            .text{
                margin-top: -125px !important; 
                font-size:11px;
            }
            .inv-logo {
                text-align: center;
            }
            .inv-logo img {
                width: 85%;
                height: 30%;
            }
            @media print {

                .no-print { display: none; }

                #wrapper { max-width: 680px; width: 100%; min-width: 330px; margin: 0 auto; }

            } 

        </style>

    </head>

    <body>

<?php } ?>

<div id="wrapper">

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
                <?php $result =  $this->pos_model->customer_info($inv->customer_id); 
                // print_r($result);
                ?> 
                <div class="inv-logo"> 
                        <img src="<?= base_url('themes/default/assets/images/chalan.png') ?>" alt="<?=$Settings->site_name ?>" /> 
                </div>  
                <span style="text-align:center;">
                    <p><h3>Invoice / Bill</h3> </p>
                </span> 
                <span style="float:left">                
                <p>
                <strong> Invoice No:</strong>  <?= $inv->id; ?><br>
                <?
                    if($result)
                    {
                        ?>
                        <?= '<strong> Buyer Name:</strong> '. $result->name;  ?> <br>
                        <?= '<strong> Address:</strong> '.$result->cf1; ?><br> 
                        <?= '<strong> Phone: </strong> '.$result->phone; ?><br>  
                        <?
                    }

                ?>

                
                </p>
                </span>
                <span style="float:right;">
                <?php 
                    $datetime = explode(" ",$inv->date);
                    echo '<strong> Date: </strong> '.$this->tec->hrsd($datetime[0]).'<br>';
                    echo '<strong> Time: </strong> '.$this->tec->hrst($datetime[1]).'<br>'; 
                    //$userifo = $this->tec->getUser($this->session->userdata('user_id'));
                    $userifo = $this->tec->getUser($inv->created_by);
                    //print_r($userifo);
                      
                    foreach ($userifo as $key => $value)                    
                    echo '<strong> Sold By: </strong> '.$value->first_name.' '.$value->last_name;
                    //echo $this->tec->hrld($inv->date); ?> 
                </span>


            <div style="clear:both;"></div>

            <table class="table table-bordered table-condensed" width="1000px">

                <thead>

                    <tr>

                        <th class="text-center col-xs-1">Sl. No.</th>

                        <th class="text-center col-xs-3"><?=lang('description');?></th>

                        <th class="text-center col-xs-3"><?=lang('Warranty');?></th>

                        <th class="text-center col-xs-1"><?=lang('quantity');?></th>

                        <th class="text-center col-xs-1"><?=lang('price');?></th>

                        <th class="text-center col-xs-2"><?=lang('subtotal');?></th>

                    </tr>

                </thead>

                <tbody>

                <?php
                $i =0;
                $tax_summary = array();
                $warranty_year='';
                foreach ($rows as $row) {
                    $sequence = $this->site->getWhereDataByElement('pro_sequence','pro_id','sales_id',$row->product_id,$row->sale_id); 
                    // echo $this->db->last_query();
                    $i++;
                    echo '<tr>
                        <td  style="text-align: center;">'.$i.'</td>
                        <td class="text-left">' . product_name($row->product_name);
                        echo '<br> S/N : ';
                        // print_r($sequence);
                        if(is_array($sequence)){
                                foreach ($sequence as $key => $seque) {
                                echo $seque->sequence.', ';
                            }
                        }
                    echo '</td>';                   

                    echo '<td class="text-center">';
                     
                        if($row->warranty_year){ 
                            echo $row->warranty_year;
                            $warranty_year = $row->warranty_year;
                        }else{
                            echo 'No warranty';
                        }
                    echo'</td>';

                    echo '<td class="text-center">' . str_replace('.00','',$row->quantity) . '</td>';

                    echo '<td class="text-right">';

                    if ($inv->total_discount != 0) {

                        $price_with_discount = $this->tec->formatMoney($row->net_unit_price + $this->tec->formatDecimal($row->item_discount / $row->quantity));

                        $pr_tax = $row->tax_method ?

                        $this->tec->formatDecimal((($price_with_discount) * $row->tax) / 100) :

                        $this->tec->formatDecimal((($price_with_discount) * $row->tax) / (100 + $row->tax)); 

                    }
                    echo $this->tec->formatMoney($row->real_unit_price + ($row->item_tax / $row->quantity)) . '</td>
                    <td class="text-right">' . $this->tec->formatMoney($row->real_unit_price*$row->quantity) . '</td></tr>';

                }

                ?>

                </tbody>

                <tfoot>

                <tr>

                    <td> </td>
                    <td colspan="4"><strong><?= lang("total"); ?></strong></td>
                    <td colspan="1" class="text-right"><strong><?= $this->tec->formatMoney($inv->total + $inv->product_tax+$inv->product_discount); ?></strong></td>

                </tr>

                <?php

                if ($inv->order_tax != 0) {

                    echo '<tr>
                        <td> </td>
                        <td colspan="4">' . lang("order_tax") . '</th>
                        <th colspan="1" class="text-right">' . $this->tec->formatMoney($inv->order_tax) . ' ('.$inv->order_tax_id.')</td>
                        </tr>';

                }

                if ($inv->total_discount != 0) {

                    echo '<tr>
                        <td></td>
                        <td colspan="4">' . lang("order_discount") . '</td>
                        <td colspan="1" class="text-right">' . $this->tec->formatMoney($inv->total_discount) . '</td></tr>';

                }

                if ($Settings->rounding) {

                    $round_total = $this->tec->roundNumber($inv->grand_total, $Settings->rounding);

                    $rounding = $this->tec->formatMoney($round_total - $inv->grand_total);

                ?>

                    <!-- <tr>
                        <td></td>
                        <td colspan="4"><?= lang("rounding"); ?></td>
                        <td colspan="1" class="text-right"><?= $rounding; ?></td>

                    </tr> -->

                    <tr>
                        <td></td>

                        <td colspan="4"><?= lang("grand_total"); ?></td>

                        <td colspan="1" class="text-right"><?= $this->tec->formatMoney($inv->grand_total + $rounding); ?></td>

                    </tr>

                <?php

                } else {

                    $round_total = $inv->grand_total;

                    ?>

                    <tr>
                        <td></td>
                        <td colspan="4"><?= lang("grand_total"); ?></td>

                        <td colspan="1" class="text-right"><?= $this->tec->formatMoney($inv->grand_total); ?></td>

                    </tr>

                <?php }

                if ($inv->paid < $round_total) { ?>

                    <tr>
                        <td></td>

                        <td colspan="4"><?= lang("paid_amount"); ?></td>

                        <td colspan="1" class="text-right"><?= $this->tec->formatMoney($inv->paid); ?></td>

                    </tr>

                    <tr>
                        <td></td>
                        <td colspan="4">Due Amount</td>
                        <?php $currentDue = $inv->grand_total - $inv->paid; ?>

                        <td colspan="1" class="text-right"><?= $this->tec->formatMoney($inv->grand_total - $inv->paid); ?></td>

                    </tr>
                  

                <?php } ?>
                  <tr>
                        <td></td>
                        <td colspan="1">In Words</td>

                        <td colspan="4" class="text-right"><div id="word-of-amount"></div></td>

                    </tr>
                <?php  
                // if($retunVal->pos_balance>0){ 
                if(isset($retunVal->pos_balance)){ 
                    ?>
                    <tr>
                        <th></th>
                        <td colspan="1">Returns</td>

                        <td colspan="4" class="text-right"><?php echo $this->tec->formatMoney($retunVal->pos_balance); ?></td>

                    </tr>
                    <?php } ?>
                </tfoot>

            </table>

            <?php

            if ($payments) {

                echo '<table class="table table-striped table-condensed" style="margin-bottom: -1px;"><tbody>';

                foreach ($payments as $payment) {

                    echo '<tr>';

                    if ($payment->paid_by == 'cash' && $payment->pos_paid) {

                        echo '<td colspan="3">' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
 
                        
                        echo '<td style="width: 170px; text-align: right;">' . lang("amount") . ': ' . $this->tec->formatMoney($payment->pos_paid == 0 ? $payment->amount : $payment->pos_paid) . '</td>';

                    }
                    
                    

                    if (($payment->paid_by == 'CC' || $payment->paid_by == 'ppp' || $payment->paid_by == 'stripe')
                     || $payment->cc_no) {

                        echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                        
                        echo '<td>' . lang("no") . ': ' . '-' . substr($payment->cc_no, -4) . '</td>';

                        echo '<td>' . lang("name") . ': ' . $payment->cc_holder . '</td>';
                        
                        echo '<td style="width: 170px; text-align: right;">' . lang("amount") . ': ' . $this->tec->formatMoney($payment->amount) . '</td>';

                    }

                    if ($payment->paid_by == 'Cheque' && $payment->cheque_no) {

                        echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                        
                        echo '<td>' . lang("cheque_no") . ': ' . $payment->cheque_no . '</td>';
                        
                        echo '<td></td>';
                        
                        echo '<td style="width: 170px; text-align: right;">' . lang("amount") . ': ' . $this->tec->formatMoney($payment->amount) . '</td>';

                    }

                    if ($payment->paid_by == 'gift_card' && $payment->pos_paid) {

                        echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';

                        echo '<td>' . lang("no") . ': ' . $payment->gc_no . '</td>';
                        
                        echo '<td>' . lang("balance") . ': ' . ($payment->pos_balance > 0 ? $this->tec->formatMoney($payment->pos_balance) : 0) . '</td>';
                        
                        echo '<td style="width: 170px; text-align: right;">' . lang("amount") . ': ' . $this->tec->formatMoney($payment->amount) . '</td>';

                    }

                    if ($payment->paid_by == 'other' && $payment->amount) {

                        echo '<td>' . lang("paid_by") . ': ' . lang($payment->paid_by) . '</td>';
                        
                        echo $payment->note ? '<td colspan="2">' . lang("payment_note") . ': ' . $payment->note . '</td>' : '<td></td>';
                        
                        if($payment->note ==''){echo '<td></td>'; };

                        echo '<td style="width: 170px; text-align: right;">' . lang("amount") . ': ' . $this->tec->formatMoney($payment->amount == 0 ? $payment->amount : $payment->amount) . '</td>';

                          }
                        

                    echo '</tr>';

                }  
                echo '</tbody></table>'; 
            } 
            if($warranty_year){
                echo '<table class="table table-striped table-condensed"><tbody>';
                echo '<tr><td colspan="5"> *Warranty Will Be Void Due To Burn, Physical Demange, Mishandaling & Natural Disester </td></tr>';
                 echo '</tbody></table>';
            }
            

            $totalAdAmount = $this->sales_model->advCollecAmount('adv_collection',$inv->customer_id);
           
            $totalSalDue = $this->sales_model->salesDeuByCustomer($inv->customer_id);
             
            if(is_array($cID) && $cID[0]->customer_id !=''){
               $tAdAmount =  $mergeval;             
            }else{
               $tAdAmount = $totalSalDue - $totalAdAmount; 
               //$tAdAmount = ($totalSalDue - $totalAdAmount) -$inv->grand_total+$inv->paid;
                if($tAdAmount > 0){  
                }elseif($tAdAmount == 0){
                    $tAdAmount = $tAdAmount;
                } else {
                  $tAdAmount = $tAdAmount-$inv->paid;              
                }
             
            } 

            $net = $tAdAmount;

           /* $tAdAmount = ($totalSalDue - $totalAdAmount) -$inv->grand_total+$inv->paid;
            if($tAdAmount > 0){  
            }elseif($tAdAmount == 0){
                $tAdAmount = $tAdAmount;
            } else {
              $tAdAmount = $tAdAmount-$inv->paid;              
            }*/

            ?>     
            <?= $inv->note ? '<p class="text-center">' . $this->tec->decode_html($inv->note) . '</p>' : ''; ?>
            
            <div class="warranty" style="text-align:left; <?php if($inv->warranty == 'Not'){  echo  'display:none;'; }?> " >
            <?= $Settings->warranty; ?>
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
    <?php if ($Settings->java_applet) { ?>

        <span class="col-xs-12"><a class="btn btn-block btn-primary" onClick="printReceipt()"><?= lang("print"); ?></a></span>

        <span class="col-xs-12"><a class="btn btn-block btn-info" type="button" onClick="openCashDrawer()"><?= lang('open_cash_drawer'); ?></a></span>

        <div style="clear:both;"></div>

    <?php } else { ?>

        <span class="pull-right col-xs-12">

        <a href="javascript:window.print()" id="web_print" class="btn btn-block btn-primary"

           onClick="window.print();return false;"><?= lang("web_print"); ?></a>

    </span>

    <span class="pull-right col-xs-12">

        <a href="<?= site_url('pos/chalan/'.$inv->id); ?>" id="web_print" class="btn btn-block btn-primary">Chalan</a>

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

<?php
?>

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
function warranty(){
        $( "#warrantydd" ).html( "<p>Waiting....</p>" );
        if($("input[type='radio'].radioBtnClass").is(':checked')) {
             var card_type = $("input[type='radio'].radioBtnClass:checked").val();
             //alert (card_type);
             var site_url = "<?php echo site_url('pos/warranty/'.$inv->id); ?>/" + card_type; //append id at end
            // alert(site_url);
             $("#warrantydd").load(site_url);
        }
    }
</script>


<script type="text/javascript">
// American Numbering System
var th = ['', 'thousand', 'million', 'billion', 'trillion'];

var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

 $(document).ready(function () {
    s = <?php echo $inv->grand_total ; ?>;
    s = s.toString();
    s = s.replace(/[\, ]/g, '');
    if (s != parseFloat(s)) return 'not a number';
    var x = s.indexOf('.');
    if (x == -1) x = s.length;
    if (x > 15) return 'too big';
    var n = s.split('');
    var str = '';
    var sk = 0;
    for (var i = 0; i < x; i++) {
        if ((x - i) % 3 == 2) {
            if (n[i] == '1') {
                str += tn[Number(n[i + 1])] + ' ';
                i++;
                sk = 1;
            } else if (n[i] != 0) {
                str += tw[n[i] - 2] + ' ';
                sk = 1;
            }
        } else if (n[i] != 0) {
            str += dg[n[i]] + ' ';
            if ((x - i) % 3 == 0) str += 'hundred ';
            sk = 1;
        }
        if ((x - i) % 3 == 1) {
            if (sk) str += th[(x - i - 1) / 3] + ' ';
            sk = 0;
        }
    }
    if (x != s.length) {
        var y = s.length;
        str += 'point ';
        for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
    }
     var out =  str.replace(/\s+/g, ' ');
     
     //alert(out);
     //return out;
      $('#word-of-amount').html(out +' '+ 'Taka Only');  
    

});

    </script>
