
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">

					<h3 class="box-title"><?= lang('enter_info'); ?></h3>

				</div>
                
                 <?php echo form_open_multipart("service/addservice"); ?>
                 

				<div class="box-body">


					<table cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover table-striped" id="CompTable">
				  <thead>

                    <tr>
                    
                    	<th style="width:10%;">Model</th>
                         
                        <th style="width:20%;">Description</th>

                        <th style="width:10%;">Quantity</th>

                        <th style="width:30%;">Problem</th>
                        
                        <th style="width:30%;">Suspect</th>
                        
                        

                    </tr>

                    </thead>

                    <tbody>

                    		<?php 
							
								  
							$i= 0;
							if(isset($saleItems) && (count($saleItems) > 0) ){
								
							//print_r($sale_info)  ;
					        ?>
							<input type="hidden" name="sale_id" value="<?php echo $saleItems[0]->sale_id ;?>" />
                            <input type="hidden" name="customer_name" value="<?php echo $sale_info->customer_name ;?>" />
                            <input type="hidden" name="customer_id" value="<?php echo $sale_info->customer_id ;?>" />
                            
							<?php foreach($saleItems as $value){
								
							//	print_r($value);
							$i++;
							?>
                            <tr class="row<?php echo $i ; ?>">
                            	
                                <td><?php   echo  $value->product_code;?></td>

                                <td><?php echo  $value->product_name ;?></td>

                                <td><?php echo $value->quantity ;?></td>
                                
                                <td><textarea name="problem[]" required="required" style="width:300px" placeholder="Problems........"></textarea></td>
                                
                                <td><textarea name="suspect[]" required="required" style="width:300px" placeholder="">5 YEAR WARRANTY WITHOUT PARTS</textarea></td>
                                <input type="hidden" name="product_id[]" value="<?php echo $value->product_id ;  ?>" />
                                <input type="hidden" name="item_id[]" value="<?php echo $value->id ;  ?>" />
                                <input type="hidden" name="quantity[]" value="<?php echo $value->quantity ;  ?>" />
                                
                                

                            </tr>
                            
							<?php }
							}?>
                        
                    </tbody>
                    

                </table>
                
				<div class="poTable_parts" style="display:none">
                 <table class="table table-striped table-bordered " id="poTable"  >

                        <thead>

                            <tr class="active">

                                <th>Parts name</th>

                                <th class="col-xs-2">Quantity</th>

                                <th class="col-xs-2">Unit Cost</th>

                                <th class="col-xs-2">Subtotal</th>

                                <th style="width:25px;"><i class="fa fa-trash-o"></i></th>

                            </tr>

                        </thead>
						<tbody class="set">
                            
						</tbody>	
                        <tfoot>

                            <tr class="active">

                                <th></th>

                                <th class="col-xs-2"></th>

                                <th class="col-xs-2">Total</th>

                                <th class="col-xs-2 text-right"><span id="gtotal">00</span></th>
                                <input type="hidden" name="total" value="00" id="totalhidden" /> 
                                <th style="width:25px;"></th>

                            </tr>

                        </tfoot>

                   </table>
                </div>
				<div class="form-group">
                        
                          <a href="javascript:;" onclick="newParts()" class="btn btn-primary">Add New parts</a>
                          
                          <input class="btn btn-primary" type="submit" value="Save" name="save_invoice" >
                </div >

				</div>
                
                 <?php echo form_close();?>

			</div>

		</div>

	</div>

</section>


<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>

<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script type="text/javascript">

    $(function () {

        $('.datetimepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });
function newParts(){
	var id = 1 + Math.floor(Math.random() * 10886);
	var fild = '<tr id="td_' + id + '"><td><input type="text" required="required" name="parts_name[]" style="width: 100%;"/></td><td><input type="number" name="qty[]" class="qty" onchange="costParts('+id+');" value="1"/></td><td><input type="text" class="unitcost" required="required" onchange="costParts('+id+');"  name="unit_cost[]"/></td><td><input type="text" id="subtotal_'+id+'" value="00" name="subtotal[]" class="readonly subtotal_service"  readonly="readonly" /></td><td> <a href="javascript:;" onclick="deleteParts('+id+')"><i class="fa fa-trash-o"></a></td></tr>';
	$(".poTable_parts").css("display","block")
	$(".set").append(fild);
	}
      function costParts(id){
		   var id= id ; 
		   var qty = $("#td_"+id).find(".qty").val();
		   var unitcost = $("#td_"+id).find(".unitcost").val();
		   var subtotal =  Number(qty) * Number(unitcost);
		   var total = 0 ;
		   $("#subtotal_"+id).attr('value', subtotal) ;
		  // var subtotal_valu = $("input[name=subtotal]").val();
		  $('input[name^="subtotal"]').each(function() {
				total  = Number(total) + Number(($(this).val()));
			});
			$('#gtotal').html(total);
			$("#totalhidden").attr('value', total) ;
			        
		   
	   }
	  function deleteParts(id){
		   var id= id ;
		    $("#td_"+id).remove();
		   var total = 0 ;
		   $('input[name^="subtotal"]').each(function() {
				total  = Number(total) + Number(($(this).val()));
			});
		   $('#gtotal').html(total);  
		   $("#totalhidden").attr('value', total) 
		  }
		  

   
</script>