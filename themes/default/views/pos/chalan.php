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
            #receipt-data {margin-top: 30px;}

            #wrapper { max-width: 660px; margin: 0 auto; padding-top: 100px; }

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
               margin: 100px 0px 0px 0px;
            }
            
            .authorized{
                border: 1px solid #efefef;
                float: left;
                height: 75px;
                padding: 5px 0 0 0px;
                width: 40%;
            }
            .customer{
                border: 1px solid #efefef;
                float: right;
                height: 75px;
                padding: 5px 0px 0 110px ; 
                margin-left: 3px;
                }
            .authorized > span , .customer > span  {
                border-top: 1px solid #a0a0a1;
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
                width: 100%; 
            }
            .row-item1 {
                height: 225px;
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


        <?php if ($Settings->java_applet) { ?>

        <span class="col-xs-3"><a class="btn btn-block btn-primary" onClick="printReceipt()"><?= lang("print"); ?></a></span>

        <span class="col-xs-3"><a class="btn btn-block btn-info" type="button" onClick="openCashDrawer()"><?= lang('open_cash_drawer'); ?></a></span>

        <div style="clear:both;"></div>

        <?php } else { ?>

        <span class="pull-right col-xs-3">

        <a href="javascript:window.print()" id="web_print" class="btn btn-block btn-primary"

        onClick="window.print();return false;"><?= lang("web_print"); ?></a>

        </span> 

        <span class="pull-right col-xs-3">

        <a href="<?= site_url('pos/chalan/6'); ?>" id="web_print" class="btn btn-block btn-primary">Chalan</a>

        </span>


        <?php } ?>

        <span class="pull-left col-xs-3"><a class="btn btn-block btn-success" href="#" id="email"><?= lang("email"); ?></a></span>



        <span class="col-xs-3">

        <a class="btn btn-block btn-warning" href="<?= site_url('pos'); ?>"><?= lang("back_to_pos"); ?></a>

        </span>

    </div>



 


    <div id="receipt-data">   

        <div class="text">
                <?php $result =  $this->pos_model->customer_info($inv->customer_id) ; 
                
                //print_r($result );
                
                ?>

                <div class="inv-logo"> 
                        <img src="<?= base_url('themes/default/assets/images/chalan.png') ?>" alt="<?=$Settings->site_name ?>" /> 
                </div>  
                <span style="text-align:center;">
                    <h2>Challan/ Invoice</h2>
                </span>
                <br><br>
                <span style="float:left">
                <p>
                    <strong> Challan No:</strong>  <?= $inv->id; ?><br>
                <?= '<strong> Buyer Name: </strong> '. $result->name;  ?> <br>
                
                <?php if($result->cf1){ echo '<strong> Address: </strong> '.$result->cf1.'<br>'; }?>
                <?php if($result->cf2){ echo '<strong> Address: </strong> '.$result->cf2.'<br>'; }?>
                <?= '<strong> Phone: </strong> '.$result->phone; ?><br>  
                </p>
                </span>
                <span style="float:right;">
                <?php 
                    $datetime = explode(" ",$inv->date);
                    echo '<strong>Date: </strong>'.$this->tec->hrsd($datetime[0]).'<br>';
                    echo '<strong>Time: </strong>'.$this->tec->hrst($datetime[1]).'<br>'; 
                    echo '<strong> Store Name: </strong> '.$store_info[0]->name.'<br>'; 
                    //$userifo = $this->tec->getUser($this->session->userdata('user_id'));
                    $userifo = $this->tec->getUser($inv->created_by);
                    //print_r($payments);
                      
                    foreach ($userifo as $key => $value)  {                  
                    echo '<strong>Sold By: </strong>'.$value->first_name.' '.$value->last_name; }
                    echo isset($inv->delivery_date)? '<br><strong> Delivery Date: </strong> '.$this->tec->hrsd($inv->delivery_date):'';
                    //echo $this->tec->hrld($inv->date); ?> 
                </span>


            <div style="clear:both;"></div>

            <table class="table table-bordered table-condensed" width="1000px">

                <thead>

                    <tr>

                        <th class="text-center col-xs-2">Sl. No.</th>

                        <th class="text-center col-xs-3"><?=lang('description');?></th>

                       <!--  <th class="text-center col-xs-3"><?=lang('Warranty');?></th> -->
                       <th class="text-center col-xs-3">Specification</th>
                        <th class="text-center col-xs-2"><?=lang('quantity');?></th>

                         <!-- <th class="text-center col-xs-1"><?=lang('price');?></th>

                        <th class="text-center col-xs-2"><?=lang('subtotal');?></th>  -->

                    </tr>

                </thead>

                <tbody>

                <?php
                $i =0;
                $tax_summary = array();
                $countItem  =  sizeof($rows);

                if($countItem ==1){
                   $rowClass = 'class="row-item1"'; 
                }else{
                  $rowClass = 'class="row-itemall"'; 
                }
                
                foreach ($rows as $row) {
                    $sequence = $this->site->getWhereDataByElement('pro_sequence','pro_id','sales_id',$row->product_id,$row->sale_id); 
                    $i++;
                    echo '<tr '.$rowClass.' >
                        <td style="text-align:center">'.$i.'</td>
                        <td class="text-left">' . product_name($row->product_name);
                       echo '<br>';
                       // print_r($sequence);
                       if($sequence)
                       {
                           foreach ($sequence as $key => $seque) {
                               if($seque->sequence !=''){
                                   echo 'S/L No: ('.$seque->sequence.') <br>';
                               } 
                            }
                       }
                    echo '</td>';                   

                    echo '<td class="text-center">';
                     
                    if($row->qnty_type){echo $qnty_type[$row->qnty_type]." (".$row->per_type_qnty.")";}

                    echo'</td>';

                    echo '<td class="text-center">' . str_replace('.00','',$row->quantity) . '</td>';

                   
                 echo '</tr>';

                }

                ?>

                </tbody>

                
                <!-- <?php

                
                if ($Settings->rounding) {

                    $round_total = $this->tec->roundNumber($inv->grand_total, $Settings->rounding);

                    $rounding = $this->tec->formatMoney($round_total - $inv->grand_total);

                ?> -->

                    <!-- <tr>
                        <td></td>
                        <td colspan="4"><?= lang("rounding"); ?></td>
                        <td colspan="1" class="text-right"><?= $rounding; ?></td>

                    </tr> -->

                    <!-- <tr>
                        <td></td>

                        <td colspan="4"><?= lang("grand_total"); ?></td>

                        <td colspan="1" class="text-right"><?= $this->tec->formatMoney($inv->grand_total + $rounding); ?></td>

                    </tr>-->
           

                    

                  

                <?php }

                
                
                /* if($retunVal->pos_balance>0){ ?>
                    
                    <?php }  */
                    ?>
                </tfoot>

            </table>

           

           
            <!-- <div style="border: 1px solid black; width: 220px; padding: 8px">
            <table class="tables">
                <tbody>
                    <tr>
                        <td>Sales</td>
                        <td style="text-align: right;"><?= $this->tec->formatMoney($inv->grand_total); ?></td>
                    </tr>
                    <tr>
                        <td>Collected</td>
                        <td style="text-align: right;"><?= $this->tec->formatMoney($inv->paid); ?></td>
                    </tr>
                    <tr>
                        <td width="150px">Current Dues</td>
                        <td style="text-align: right;"><?= $this->tec->formatMoney($currentDue); ?></td>
                    </tr>
                    <tr>
                        <td width="150px">Previous Dues</td>
                        <td style="text-align: right;"><?= $this->tec->formatMoney($tAdAmount-$currentDue); ?></td>
                    </tr>                    
                    <tr><td colspan="2" id="hrber"></td></tr>
                     <tr>
                        <td width="150px">Net OutStanding</td> 
                        <td style="text-align: right;">
                        <?= $this->tec->formatMoney($net); ?></td>
                    </tr>
                </tbody>
            </table>             
            </div>    -->   

            <?= $inv->note ? '<p class="text-center">' . $this->tec->decode_html($inv->note) . '</p>' : ''; ?>
            
            <div class="warranty" style="text-align:left; <?php if($inv->warranty == 'Not'){  echo  'display:none;'; }?> " >
            <?= $Settings->warranty; ?>
            </div>
            <div class="signature" >
            <div class="authorized" ><br><br><span>Customer Signature</span></div>
            <div class="customer"><br><br><span>Authorized Signature <span></div>
            </div>
            <div style="clear:both;"></div>
            </div>
            <br>
            <br>
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


    <!-- <div class="warranty-contect" onClick="warranty()">
    <div id="warrantydd"></div>
     <label>Warranty</label>
      <input type="radio" class="radioBtnClass" value="1" id="warranty" 
       name="warranty" <?php if($inv->warranty == 'War'){echo  'checked'; }?>  >Yes
      <input type="radio" class="radioBtnClass"  <?php if($inv->warranty == 'Not'){echo  'checked'; }?>  value="0" id="warranty-no" name="warranty">No
    
    </div> -->


    <?php if (!$Settings->java_applet) { ?>

        <div style="clear:both;"></div>

        <div class="col-xs-12" style="display: none; background:#F5F5F5; padding:10px;">

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
      $('#word-of-amount').html(out);  
    

});

    </script>
