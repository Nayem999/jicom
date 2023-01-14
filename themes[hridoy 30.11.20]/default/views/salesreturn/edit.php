
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">
            <?= lang('enter_info'); ?>
          </h3>
        </div>
        <?php echo form_open_multipart("service/edit/".$sevice_id); ?>
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
							
					        ?>
              <?php foreach($saleItems as $value){
								
								//print_r($value);
							$i++;
							?>
              <tr class="row<?php echo $i ; ?>">
                <td><?php   echo  $value->product_code;?></td>
                <td><?php echo  $value->product_name ;?></td>
                <td><?php echo $value->quantity ;?></td>
                <td><textarea name="problem[]"  required="required" style="width:300px" placeholder="Problems........"><?php echo $value->problem ;?></textarea></td>
                <td><textarea name="suspect[]" required="required" style="width:300px" placeholder=""><?php echo $value->suspect ;?></textarea></td>
                <input type="hidden" name="problem_id[]" value="<?php echo $value->problem_id; ?>">
              </tr>
              <?php }
							}?>
            </tbody>
          </table>
          <div style="display: block;" class="poTable_parts">
            <table id="poTable" class="table table-striped table-bordered ">
              <thead>
                <tr class="active">
                  <th class="col-xs-6">Parts name</th>
                  <th class="col-xs-1">Quantity</th>
                  <th class="col-xs-2">Unit Cost</th>
                  <th class="col-xs-2">Subtotal</th>
                  <th style="width:25px;"><i class="fa fa-trash-o"></i></th>
                </tr>
              </thead>
              <tbody class="set">
              <?php 
			  if(count($parts)>0){
				  
				  // print_r($parts);
				  foreach($parts as $value){
				  ?>
              
                <tr id="td_<?php echo $value->parts_id; ?>">
                  <td><input type="text" style="width: 100%;" value="<?php echo $value->parts_name ?>" name="parts_name[]" required="required"></td>
                  <td><input type="number"  value="<?php echo $value->quantity ?>" onchange="costParts('<?php echo $value->parts_id; ?>');" class="qty" name="quantity[]"></td>
                  
                  <td><input type="text"  value="<?php echo $value->unit_cost ?>" name="unit_cost[]" onchange="costParts('<?php echo $value->parts_id; ?>');" required="required" class="unitcost"></td>
                  
                  <td><input type="text"  readonly="readonly" class="readonly subtotal_service" name="subtotal[]"  value="<?php echo $value->subtotal ?>" id="subtotal_<?php echo $value->parts_id; ?>"></td>
                  <td> <a href="javascript:;" onclick="deletePartsItems('<?php echo $value->parts_id; ?>')"><i class="fa fa-trash-o"></a></td>
                  <input type="hidden" name="parts_id[]" value="<?php echo $value->parts_id; ?>">
                </tr>
                
                <?php
				  }
				 }else{ ?>
                  <tr id="td_8043">
                  <td colspan="5">No matching records found</td>
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr class="active">
                  <th class="col-xs-2"></th>
                  <th class="col-xs-2"></th>
                  <th class="col-xs-2">Total</th>
                  <th class="col-xs-2 text-right"><span id="gtotal"><?php echo $parts[0]->total ?></span></th>
                  <input type="hidden" id="totalhidden" value="<?php echo $parts[0]->total ?>" name="total">
                  <th style="width:25px;"></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="form-group"><a href="javascript:;" onclick="newParts()" class="btn btn-primary">Add New parts</a>
            <input class="btn btn-primary" type="submit" value="Update" name="save_invoice" >
          </div >
        </div>
        <?php echo form_close();?> </div>
    </div>
  </div>
</section>

<script type="text/javascript">

function newParts(){
	var id = 1 + Math.floor(Math.random() * 10886);
	var fild = '<tr id="td_' + id + '"><td><input type="text" required="required" name="parts_name_n[]" style="width: 100%;"/></td><td><input type="number" name="quantity_n[]" class="qty" onchange="costParts('+id+');" value="1"/></td><td><input type="text" class="unitcost" required="required" onchange="costParts('+id+');"  name="unit_cost_n[]"/></td><td><input type="text" id="subtotal_'+id+'" value="00" name="subtotal_n[]" class="readonly subtotal_service"  readonly="readonly" /></td><td> <a href="javascript:;" onclick="deleteParts('+id+')"><i class="fa fa-trash-o"></a></td></tr>';
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
			//alert(subtotal);
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
	 function deletePartsItems(id){
		 
		  var site_url = "<?php echo site_url('service/deletePartsItems'); ?>/" +id; //append id at end
	      $("#td_"+id).load(site_url);
		  $("#td_"+id).remove();
		  var total = 0 ;
		   $('input[name^="subtotal"]').each(function() {
				total  = Number(total) + Number(($(this).val()));
			});
		   $('#gtotal').html(total);  
		   $("#totalhidden").attr('value', total) 
		   
		  }
		
	
</script>