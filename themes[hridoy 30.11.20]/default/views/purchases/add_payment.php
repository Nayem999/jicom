<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog">

    <div class="modal-content">
    <?php //print_r($pay_info); ?>

        <div class="modal-header">

            <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>

            </button>

            <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4>

        </div>
        <?= form_open_multipart($action); ?>

        <div class="modal-body">

            <p><?= lang('enter_info'); ?></p>

            <div class="row">

                <?php if ($Admin) { ?>

                <div class="col-sm-6">

                    <div class="form-group">

                        <?= lang("date", "date"); ?>
                         <input name="date" type="text" id="date" value="<?php if($pay_info->date !=''){ echo $pay_info->date ;}else{ echo date('Y-m-d H:i') ; } ?>" class="form-control datetimepicker" required="required"/>

                    </div>

                </div>

                <?php } ?>

                <div class="col-sm-6">

                    <div class="form-group">

                        <?= lang("reference", "reference"); ?>
                        
                        <?= form_input('reference', set_value('reference',$pay_info->reference), 'class="form-control tip" id="reference"'); ?>

                    </div>

                </div>



            </div>

            <div class="clearfix"></div>

            <div id="payments">



                <div class="well well-sm well">

                    <div class="col-sm-12">

                        <div class="row">

                            <div class="col-sm-6">

                                <div class="payment">

                                    <div class="form-group">

                                        <?= lang("amount", "amount"); ?>

                                        <input name="amount-paid" type="text" id="amount"

                                        value="<?php if($pay_info->amount){ echo $pay_info->amount ;}else{ echo $due_amount ; } ?>"

                                        class="pa form-control kb-pad amount" required="required"/>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                <?php 
								function paid_type($data){
									if($data == 'cash'){
										$out = '<option value="cash">'.lang("cash").'</option>';
									 }else if($data == 'CC'){
										 $out =  '<option value="cash">'.lang("cc").'</option>';
										 
									  }else if($data == 'Cheque'){
										 $out =  '<option value="Cheque">'.lang("cheque").'</option>';
										 
									  }else if($data == 'gift_card'){
										 $out = '<option value="gift_card">'.lang("gift_card").'</option>';
										 
									  }else if($data == 'other'){
										 $out =  '<option value="other">'.lang("other").'</option>';
										 
									  }
									  return $out  ;
									  
									}
								
								?>

                                    <?= lang("paying_by", "paid_by"); ?>

                                    <select name="paid_by" id="paid_by" class="form-control paid_by " style="width:100%" 

                                    required="required">

                                    <?php if($pay_info->paid_by !=''){ echo paid_type($pay_info->paid_by);}else{ ?>
                                    
                                     <option value="cash"><?= lang("cash"); ?></option>

                                    <option value="CC"><?= lang("cc"); ?></option>

                                    <option value="Cheque"><?= lang("cheque"); ?></option>

                                    <option value="gift_card"><?= lang("gift_card"); ?></option>

                                    <?= isset($Settings->stripe) ? '<option value="stripe">' . lang("stripe") . '</option>' : ''; ?>

                                    <option value="other"><?= lang("other"); ?></option>
                                    
                                    <?php } ?>

                                </select>

                            </div>

                        </div>



                    </div>

                    <div class="clearfix"></div>

                    <div class="form-group gc" style="display: none;">

                        <?= lang("gift_card_no", "gift_card_no"); ?>

                        <input name="gift_card_no" type="text" id="gift_card_no" class="pa form-control kb-pad"/>



                        <div id="gc_details"></div>

                    </div>

                    <div class="pcc" style="display:none;">

                        <div class="form-group">

                            <input type="text" id="swipe" class="form-control swipe swipe_input"

                            placeholder="<?= lang('focus_swipe_here') ?>"/>

                        </div>

                        <div class="row">

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <input name="pcc_no" type="text" id="pcc_no" class="form-control"

                                    placeholder="<?= lang('cc_no') ?>"/>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">



                                    <input name="pcc_holder" type="text" id="pcc_holder" class="form-control"

                                    placeholder="<?= lang('cc_holder') ?>"/>

                                </div>

                            </div>

                            <div class="col-sm-3">

                                <div class="form-group">

                                    <select name="pcc_type" id="pcc_type" class="form-control pcc_type select2" style="width:100%"

                                    placeholder="<?= lang('card_type') ?>">

                                    <option value="Visa"><?= lang("Visa"); ?></option>

                                    <option value="MasterCard"><?= lang("MasterCard"); ?></option>

                                    <option value="Amex"><?= lang("Amex"); ?></option>

                                    <option value="Discover"><?= lang("Discover"); ?></option>

                                </select>

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-group">

                                <input name="pcc_month" type="text" id="pcc_month" class="form-control"

                                placeholder="<?= lang('month') ?>"/>

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-group">



                                <input name="pcc_year" type="text" id="pcc_year" class="form-control"

                                placeholder="<?= lang('year') ?>"/>

                            </div>

                        </div>

                        <div class="col-sm-3">

                            <div class="form-group">

                                <input name="pcc_ccv" type="text" id="pcc_cvv2" class="form-control" placeholder="<?= lang('cvv2') ?>" />

                            </div>

                        </div>

                    </div>

                </div>

                <div class="pcheque" style="display:none;">

                    <div class="form-group"><?= lang("cheque_no", "cheque_no"); ?>

                        <input name="cheque_no" type="text" id="cheque_no" class="form-control cheque_no"/>

                    </div>

                </div>

            </div>

            <div class="clearfix"></div>

        </div>

    </div>

     <!--  <div class="form-group">

        <?= lang("attachment", "attachment") ?>

        <input id="attachment" type="file" name="userfile" class="form-control file">

    </div> -->

    <div class="form-group">

        <?= lang("note", "note"); ?>

        <?php echo form_textarea('note',$pay_info->note, 'class="form-control redactor" id="note"'); ?>

    </div>

</div>

<div class="modal-footer">

    <?php echo form_submit('add_payment', 'Submit', 'class="btn btn-primary"'); ?>

</div>

</div>

<?php echo form_close(); ?>

</div>
</div>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/parse-track-data.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/pages/modal.js" type="text/javascript"></script>

<script type="text/javascript" charset="UTF-8">
    <?php
	if($type=='edit'){
		  $due_amount = $due_amount+$pay_info->amount ;
		}
	 ?>

		$(document).ready(function(){
		var due_aamount = <?php echo $due_amount  ?>;
		
		  $("#amount").keyup(function(){
		   var amunt  = $( "#amount" ).val();
			if( due_aamount < amunt){
				$('#amount').val(due_aamount);
			 }
		  });
		});
 $("#amount").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
		

    $(document).ready(function () {



        $('#gift_card_no').inputmask("9999 9999 9999 9999");

        $(document).on('change', '.paid_by', function () {

            var p_val = $(this).val();

            if (p_val == 'gift_card') {

                $('.gc').slideDown();

                $('.ngc').slideUp('fast');

                setTimeout(function(){ $('#gift_card_no').focus(); }, 10);

                $('#amount').attr('readonly', true);

            } else {

                $('.ngc').slideDown();

                $('.gc').slideUp('fast');

                $('#gc_details').html('');

                $('#amount').attr('readonly', false);

            }

            if (p_val == 'cash' || p_val == 'other') {

                $('.pcash').slideDown();

                $('.pcheque').slideUp('fast');

                $('.pcc').slideUp('fast');

                setTimeout(function(){ $('#amount').focus(); }, 10);

            } else if (p_val == 'CC' || p_val == 'stripe') {

                $('.pcc').slideDown();

                $('.pcheque').slideUp('fast');

                $('.pcash').slideUp('fast');

                setTimeout(function(){ $('#swipe').val('').focus(); }, 10);

            } else if (p_val == 'Cheque') {

                $('.pcheque').slideDown();

                $('.pcc').slideUp('fast');

                $('.pcash').slideUp('fast');

                setTimeout(function(){ $('#cheque_no').focus(); }, 10);

            } else {

                $('.pcheque').hide();

                $('.pcc').hide();

                $('.pcash').hide();

            }

        });



        $(document).on('change', '#gift_card_no', function () {

            var cn = $(this).val() ? $(this).val() : '';

            if (cn != '') {

                $.ajax({

                    type: "get", async: false,

                    url: base_url + "pos/validate_gift_card/" + cn,

                    dataType: "json",

                    success: function (data) {

                        if (data === false) {

                            bootbox.alert('<?= lang('incorrect_gift_card'); ?>');

                        } else {

                            $('#gc_details').html('<?= lang('card_no'); ?>: ' + data.card_no + '<br><?= lang('value'); ?>: ' + data.value + '<?= lang('balance'); ?>: ' + data.balance);

                            var g_total = <?= $this->tec->formatDecimal($inv->grand_total - $inv->paid); ?>;

                            $('#amount').val((g_total > data.balance) ? data.balance : g_total).change().focus();

                        }

                    }

                });

            }

            return false;

        });



        $('.swipe').keypress( function (e) {

            var TrackData = $(this).val() ? $(this).val() : '';

            if(TrackData != '') {

                if (e.keyCode == 13) {

                    e.preventDefault();

                    var p = new SwipeParserObj(TrackData);



                    if(p.hasTrack1)

                    {



                        var CardType = null;

                        var ccn1 = p.account.charAt(0);

                        if(ccn1 == 4)

                            CardType = 'Visa';

                        else if(ccn1 == 5)

                            CardType = 'MasterCard';    

                        else if(ccn1 == 3)

                            CardType = 'Amex';

                        else if(ccn1 == 6)

                            CardType = 'Discover';

                        else

                            CardType = 'Visa';



                        $('#pcc_no').val(p.account).change();

                        $('#pcc_holder').val(p.account_name).change();

                        $('#pcc_month').val(p.exp_month).change();

                        $('#pcc_year').val(p.exp_year).change();

                        $('#pcc_cvv2').val('');

                        $('#pcc_type').select2('val', CardType);



                    } else {

                        $('#pcc_no').val('').change();

                        $('#pcc_holder').val('').change();

                        $('#pcc_month').val('').change();

                        $('#pcc_year').val('').change();

                        $('#pcc_cvv2').val('').change();

                        $('#pcc_type').val('').change(); 

                    }



                    $('#pcc_cvv2').focus();

                }

            }



        }).blur(function (e) {

            $(this).val('');

        }).focus( function (e) {

            $(this).val('');

        });



        $('#pcc_no').change(function (e) {

            var cn = $(this).val();

            var ccn1 = cn.charAt(0);

            if(ccn1 == 4)

                CardType = 'Visa';

            else if(ccn1 == 5)

                CardType = 'MasterCard';    

            else if(ccn1 == 3)

                CardType = 'Amex';

            else if(ccn1 == 6)

                CardType = 'Discover';

            else

                CardType = 'Visa';



            $('#pcc_type').select2('val', CardType);

        });



    });

</script>



<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function () {

        $('.datetimepicker').datetimepicker({

            format: 'YYYY-MM-DD HH:mm'

        });

    });

</script>



