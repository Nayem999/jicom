<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

</div>

<div class="modal" data-easein="flipYIn" id="posModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div id="paySalary"></div>
<footer class="main-footer">

    <div class="pull-right hidden-xs">

        Version <strong>b<?= $Settings->version; ?></strong>

    </div>

    <a href="https://jicom.gdnserver.com/">Copyright &copy; <?= date('Y') . ' jicom ' //. $Settings->site_name; ?>. All rights reserved.</a>

</footer>



</div>

<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>

<script type="text/javascript">

    var base_url = '<?=base_url();?>';

    var dateformat = '<?=$Settings->dateformat;?>', timeformat = '<?= $Settings->timeformat ?>';

    <?php unset($Settings->protocol, $Settings->smtp_host, $Settings->smtp_user, $Settings->smtp_pass, $Settings->smtp_port, $Settings->smtp_crypto, $Settings->mailpath, $Settings->timezone, $Settings->setting_id, $Settings->default_email, $Settings->version, $Settings->stripe, $Settings->stripe_secret_key, $Settings->stripe_publishable_key); ?>

    var Settings = <?= json_encode($Settings); ?>;

    $(window).load(function () {

        $('.mm_<?=$m?>').addClass('active');

        $('#<?=$m?>_<?=$v?>').addClass('active');

    });

</script>



<script src="<?= $assets ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/fastclick/fastclick.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/redactor/redactor.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/select2/select2.full.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/formvalidation/js/formValidation.popular.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/formvalidation/js/framework/bootstrap.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/common-libs.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/app.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/custom.js" type="text/javascript"></script> 

<script src="<?= $assets ?>dist/js/pages/all.js" type="text/javascript"></script>

<script src="<?= $assets ?>dist/js/jquery.ultraselect.js" type="text/javascript"></script> 

<script type="text/javascript">
   function addPay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('employee/paySalary'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}

	function liftProfit(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('partner/liftProfit'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}

	
	function editPay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('employee/paySalaryEtdit'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}

	function editLiftPofit(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('partner/payProfitEtdit'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function liftProfitlist(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('partner/liftProfitlist'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}

	function payLisy(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('employee/payLisy'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function addParPay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('purchases/add_payment'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function addSarvicePay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('service/add_payment'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	function addTranjiction(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('bank/addTranjiction'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	function tranjictionList(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('bank/tranjictionList'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function editTransaction(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('bank/editTransaction'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function editParPay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('purchases/edit_payment'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function listParPay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('purchases/listParPay'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function sarvicePayments(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('service/paymentsList'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function editSarvicePay(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('service/editSarvicePay'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	function noteEdit(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('sales/noteEdit'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}

	function bankChack(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('sales/bankChack'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}

	function bankTransferf() { 
	
	 var site_url = "<?php echo site_url('bank/bankTransfer'); ?>/"; //append id at end
	 $("#paySalary").load(site_url);
	}	

	function pettyTransferf() { 		 
	 var site_url = "<?php echo site_url('bank/pettyTransfer'); ?>/"; //append id at end
	 $("#paySalary").load(site_url);
	}

	function approveCheque(id) { 		 
	 var site_url = "<?php echo site_url('bank/approveCheque'); ?>/"+id; //append id at end
	 $("#paySalary").load(site_url);
	}
	function loan_cheque_approve(id) {         
     var site_url = "<?php echo site_url('bank/loan_cheque_approve'); ?>/"+id; //append id at end
     $("#paySalary").load(site_url);
    }
    function donations_cheque_approve(id) {         
     var site_url = "<?php echo site_url('bank/donations_cheque_approve'); ?>/"+id; //append id at end
     $("#paySalary").load(site_url);
    }
    function salary_cheque_approve(id) {         
     var site_url = "<?php echo site_url('bank/salary_cheque_approve'); ?>/"+id; //append id at end
     $("#paySalary").load(site_url);
    }
    function expenses_cheque_approve(id) {         
     var site_url = "<?php echo site_url('bank/expenses_cheque_approve'); ?>/"+id; //append id at end
     $("#paySalary").load(site_url);
    }
	
	function servicePage(id) {
	 var site_url = "<?php echo site_url('service/selectInvoice'); ?>/"; //append id at end
	 $("#paySalary").load(site_url);
	}
	
	function salereturnPage(id) {
	 var site_url = "<?php echo site_url('salereturn/selectInvoice'); ?>/"; //append id at end
	 $("#paySalary").load(site_url);
	}

	function productsTransfer() { 
	 var site_url = "<?php echo site_url('transfers/selectFromWarehouse'); ?>/"; //append id at end 
	 $("#paySalary").load(site_url);
	}
	   
	function hide() {
	  $( ".posModal" ).hide();
	  // $( ".posModal" ).style.display = "none";
	}
    function setsequence(row_no){
            var sequence = $('#arry').val();
            var site_url = "<?php echo site_url('purchases/SeqcheckDB'); ?>/"+sequence; 
            $("#erro_all").load(site_url, function(e){            	
            	if(e ==''){
            		var row = $('#getsequence-'+row_no).closest('tr');
		            var new_setval = $('#arry').val(),
		            item_id = row.attr('data-item-id');
		            spoitems[item_id].row.setval = new_setval;
		            store('spoitems', JSON.stringify(spoitems));
		            prid22 = '';
		            loadItems(prid22);
		             $( ".posModal" ).hide()
            	}

            });

    }

  function setsequenceEdit(row_no){
            var sequence = $('#arry').val();
            var sequenceId = $('#arryID').val();

            var site_url = "<?php echo site_url('purchases/SeqcheckDBedit'); ?>/"+sequence+"/"+sequenceId; 
            //alert(site_url);
            $("#erro_all").load(site_url, function(e){            	
            	if(e ==''){
            		var row = $('#getsequence-'+row_no).closest('tr');
		            var new_setval = $('#arry').val(),
		            item_id = row.attr('data-item-id');
		            spoitems[item_id].row.setval = new_setval;
		            store('spoitems', JSON.stringify(spoitems));
		            prid22 = '';
		            loadItems(prid22);
		             $( ".posModal" ).hide()
            	}

            });

    }

    $('#SequenceSearch').keyup(function(){
    	var val =$('#SequenceSearch').val();
    	var site_url = "<?php echo site_url('products/SequenceSearch'); ?>/"+val;
    	$("#SequenceResult").load(site_url) ;
    });
</script>

</body>

</html>