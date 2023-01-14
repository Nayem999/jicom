<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog">

    <div class="modal-content">
    <?php //print_r($pay_info); ?>

        <div class="modal-header">

            <button type="button" onclick="hide()"  class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i>

            </button>
            

            <h4 class="modal-title" id="myModalLabel"><?php echo $page_title; ?></h4>

        </div>
        <!-- <?//form_open_multipart($action); ?> -->
        <?= form_open_multipart("service/add"); ?>

        <div class="modal-body">

            <div class="row">

                <?php if ($Admin) { ?>

                <div class="col-sm-12">

                           
          			<label for="reference">Invoice No</label>
                        
                      <input id="value_item" class="form-control tip" type="text" onblur="sughide();" onkeyup="invoiceValue(this.value);" placeholder="Invoice no or customer name " name="search">
                      
                    
                </div>
                <div class="col-sm-12">
                <div class="invoiceName" id="invoiceName"></div>
                </div>
                <?php } ?>


            </div>

    </div>

</div>

</div>

<?php echo form_close(); ?>

</div>
<script>
 function invoiceValue(value) {
	  var inputString =  value.replace(/ /g, "__");
	  var site_url = "<?php echo site_url('service/ajaxValue'); ?>/" +inputString; 
	 $("#invoiceName").load(site_url);
}

	function invoicProduct(id) {
	 var dataString = 'id='+ id ;
	 var site_url = "<?php echo site_url('service/invoicProduct'); ?>/" +id; //append id at end
	 $("#paySalary").load(site_url);
	}
	
</script>




