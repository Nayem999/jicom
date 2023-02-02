<style type="text/css">
    .seqFound{

    }
</style>
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">

					<h3 class="box-title"><?= lang('enter_info'); ?></h3>

				</div>
                
                 <?php echo form_open_multipart("salereturn/addsalesreturn"); ?>               

				<div class="box-body">

					<table cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover table-striped" id="CompTable">
				  <thead>

                    <tr>
                    
                    	<th style="width:10%;">Model</th>
                         
                        <th style="width:20%;">Product Name</th>

                        <th style="width:10%;">Return Qty</th>

                        <th style="width:20%;">Problem</th>

                        <th style="width:20%;">Sequence</th>
                        
                        <th style="width:10%;">Price</th>

                        <th style="width:10%;">Unit Price</th>

                        <th style="width:10%;">Return Amount</th>

                    </tr>

                    </thead>

                    <tbody>

                		<?php 						
							  
						$i= 0;
						if(isset($saleItems) && (count($saleItems) > 0) ){
							
						//print_r($sale_info) ;

				        ?>
						<input type="hidden" name="sale_id" value="<?php echo $saleItems[0]->sale_id ;?>" />
                        <input type="hidden" name="customer_name" value="<?php echo $sale_info->customer_name ;?>" />
                        <input type="hidden" name="customer_id" value="<?php echo $sale_info->customer_id ;?>" />
                        <input type="hidden" name="paid" value="<?php echo $sale_info->paid; ?>"> 
                        <input type="hidden" name="totalQty" value="<?php echo $sale_info->total_quantity; ?>">
                        <input type="hidden" name="total" value="<?php echo $sale_info->total; ?>">
                        <input type="hidden" name="storeid" value="<?php echo $sale_info->store_id; ?>">
                        
						<?php 
						$total=0;
						foreach($saleItems as $value){
						//print_r($value);
                        $proSequs='';
                        $seqFound='';
						$i++;
                        $proSequs = $this->site->getWhereDataByElement('pro_sequence','sales_id','pro_id',$value->sale_id,$value->product_id); 
                        //$proSequs = $this->site->getWhereDataByElement('pro_sequence','sales_id','pro_id','225','140');
                        if($proSequs){
                           /*  $totalSequence = count($proSequs); 
                            if($totalSequence >0){
                                $seqFound = 'sequence-match'; 
                            }else{
                                $seqFound = ''; 
                            } */
                        } 
						?>
                        <tr class="row<?php echo $i; ?> <?= $seqFound; ?>" id="row<?php echo $i; ?>">

                            <td>
                                <input type="hidden" value="<?// $totalSequence; ?>" name="totalSequence">
                                <?php echo $value->product_code;?> </td>

                            <td><?php echo $value->product_name ;?></td>

                            <td> <input id="returnqty<?php echo $i; ?>" type="text" name="return_qty[]" value="<?php echo $value->quantity ;?>"></td>
                            <td><textarea name="problem[]" required="required" style="width: 200px; height: 24px;" placeholder="Problems........"></textarea></td>
                            <td> <a href="javascript:;" id="sqto" onclick="rSequence(<?php echo $value->product_id ?>,<?php echo $saleItems[0]->sale_id ?>,<?php echo $i ?>)" class=""><i class="fa fa-barcode tip pointer spodel"><i></i></i></a>   
                            <td><?php echo $value->subtotal; ?></td>
                            <td><?php echo $value->unit_price; ?></td>
                            <td><input type="text" id="returnAmount<?php echo $i; ?>" name="return_amount[]" value=""></td>
                            <input type="hidden" name="product_id[]" value="<?php echo $value->product_id; ?>" />
                            <input type="hidden" name="item_id[]" value="<?php echo $value->id; ?>" />
                            <input type="hidden" name="quantity[]" value="<?php echo $value->quantity; ?>" />
                            <input type="hidden" name="subtotal[]" value="<?php echo $value->subtotal; ?>" />
                            <input type="hidden" name="unit_price[]" value="<?php echo $value->unit_price; ?>" />
                            <input type="hidden" name="net_unit_price[]" value="<?php echo $value->net_unit_price; ?>" />
                            <input type="hidden" name="discount[]" value="<?php echo $value->discount; ?>" />
                            <input type="hidden" name="item_discount[]" value="<?php echo $value->item_discount; ?>" />
                            <input type="hidden" name="tax[]" value="<?php echo $value->tax; ?>" />
                            <input type="hidden" name="item_tax[]" value="<?php echo $value->item_tax; ?>" />
                            <input type="hidden" name="real_unit_price[]" value="<?php echo $value->real_unit_price; ?>" />
                            <input type="hidden" name="cost[]" value="<?php echo $value->cost; ?>" />
                            <input type="hidden" name="store_id[]" value="<?php echo $value->store_id; ?>" /> 
                            <input type="hidden" name="sequenceid[]" value="" id="sequenceid<?php echo $i; ?>" /> 
                            <input type="hidden" name="total_item" value="<?php echo $i ; ?>">
                            <input type="hidden" name="sales_id[]" value="<?php echo $saleItems[0]->sale_id ;?>">                        
                        </tr>                             
                        
						<?php }
						}?>
						<tr>
	                    	<td colspan="5"></td>
	                    	<td colspan="2">Total Quantity</td> 
	                    	<td><?php echo $sale_info->total_quantity; ?></td> 
	                    </tr>
	                    <tr>
	                        <td colspan="5"></td>
	                    	<td colspan="2">Total Paid</td> 
	                    	<td><?php echo $sale_info->paid; ?></td>  
	                    </tr>
	                    <tr>
	                    	<td colspan="5"></td>
	                    	<td colspan="2">Total Due</td> 
	                    	<td><?php echo $sale_info->grand_total - $sale_info->paid; ?></td>  
	                    </tr>
                        
                    </tbody> 
                </table> 
				<div class="form-group">                           
                    <input class="btn btn-primary" id="payment" type="submit" value="Return" name="save_invoice" >
                </div >

				</div>
                
                <?php echo form_close();?>

			</div>

		</div>

	</div> 
</section>   
<script type="text/javascript">
function rSequence(pid,sid,row_no){  
    var returnqty = $("#returnqty"+row_no).val(); 
    var sequenceid = $("#sequenceid"+row_no).val();   
    if(sequenceid.length !=0){
       var storeSequence = sequenceid;
    } else {
      var storeSequence = 0;
    }  
    
    var site_url = "<?php echo site_url('salereturn/sequencereturn'); ?>/"+pid+"/"+sid+"/"+row_no+"/"+returnqty+"/"+storeSequence;
    $("#paySalary").load(site_url);  
    }
function reSquOut(row_no){ 
    var sequence = $('#posarry').val();
    $('#sequenceid'+row_no).val(sequence);
    var returnqty = $("#returnqty"+row_no).val(); 
    if(returnqty > 0){          
        $( '#row' + row_no ).removeClass( "sequence-match" );
        $('#payment').removeAttr('disabled', true ); 
    }else{
        $('#row' + row_no).addClass('sequence-match'); 
        $('#payment').attr('disabled', true );            
    }  
    $( ".posModal" ).hide();
}
$(document).ready(function(){ 
    $("#sequenceid")
    $("p").mouseout(function(){
       var returnqty = $("#returnqty"+row_no).val();
    });
    var seqFound = '<?= $totalSequence ?>';
    if(seqFound){
        $('#payment').attr('disabled', true );       
    }
    var sequenceid = [];

    $("input[name='sequenceid[]']").each(function() {
        var value = $(this).val();
        if (value) {
            sequenceid.push(value);
        }
    });
    
});

</script>
 