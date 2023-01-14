<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog modal-lg">


    <div class="modal-content" >
		

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i></button>
          

            <h4 id="myModalLabel" class="modal-title">View Invoice product</h4>

        </div>

        <div class="modal-body">

            <div class="table-responsive">
            
      
			<?php echo form_open(base_url('service/add'));?>
                <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover table-striped" id="CompTable">
				  <thead>

                    <tr>
                    
                    	<th style="width:20%;">Service</th>
                         
                        <th style="width:45%;">Description</th>

                        <th style="width:15%;">Quantity</th>

                        <th style="width:20%;">Price</th>

                        <th style="width:20%;">Subtotal</th>
                        
                        

                    </tr>

                    </thead>

                    <tbody>

                    		<?php 
							
								  
							$i= 0;
							if(isset($rows) && (count($rows) > 0) ){ 
							foreach($rows as $value){
							$i++;
							?>
                            <tr class="row<?php echo $i ; ?>">
                            	
                                <td><input type="checkbox" name="sela_item_id[]" value="<?php   echo  $value->id;?>" /></td>

                                <td><?php echo  $value->product_name ;?></td>

                                <td><?php echo $value->quantity ;?></td>
                                
                                <td>
                               <?php  if ($inv->total_discount != 0) {

                        $price_with_discount = $this->tec->formatMoney($value->net_unit_price + $this->tec->formatDecimal($value->item_discount / $row->quantity));

                        $pr_tax = $value->tax_method ?

                        $this->tec->formatDecimal((($price_with_discount) * $value->tax) / 100) :

                        $this->tec->formatDecimal((($price_with_discount) * $value->tax) / (100 + $value->tax));

                       // echo '<del>' . $this->tec->formatMoney($price_with_discount+$pr_tax) . '</del> ';

                    }



                    echo $this->tec->formatMoney($value->net_unit_price + ($value->item_tax / $value->quantity)) ;?>
                                </td>
                                
                                <td><?php echo  $value->subtotal ; ?></td>

                            </tr>
                            
							<?php }
							}?>
                        
                    </tbody>
                    
                    <tfoot>

                <tr>
                   <th></th>
                        
                    <th></th>

                    <th colspan="2"><?= lang("total"); ?></th>

                    <th colspan="2" class="text-right"><?= $this->tec->formatMoney($inv->total + $inv->product_tax); ?></th>

                </tr>

                <?php

                if ($inv->order_tax != 0) {

                    echo '<tr><th></th> <th></th><th colspan="2">' . lang("order_tax") . '</th><th colspan="2" class="text-right">' . $this->tec->formatMoney($inv->order_tax) . '</th></tr>';

                }

                if ($inv->total_discount != 0) {

                    echo '<tr><th></th><th></th><th colspan="2">' . lang("order_discount") . '</th><th colspan="2" class="text-right">' . $this->tec->formatMoney($inv->total_discount) . '</th></tr>';

                }



                if ($Settings->rounding) {

                    $round_total = $this->tec->roundNumber($inv->grand_total, $Settings->rounding);

                    $rounding = $this->tec->formatMoney($round_total - $inv->grand_total);

                ?>

                    <tr>
                        <th></th>
                        
                        <th></th>

                        <th colspan="2"><?= lang("rounding"); ?></th>

                        <th colspan="2" class="text-right"><?= $rounding; ?></th>

                    </tr>

                    <tr>
                    
                        <th></th>
                        
                        <th></th>

                        <th colspan="2"><?= lang("grand_total"); ?></th>

                        <th colspan="2" class="text-right"><?= $this->tec->formatMoney($inv->grand_total + $rounding); ?></th>

                    </tr>

                <?php

                } else {

                    $round_total = $inv->grand_total;

                    ?>

                    <tr>
                        <th></th>
                        
                        <th></th>

                        <th colspan="2"><?= lang("grand_total"); ?></th>

                        <th colspan="2" class="text-right"><?= $this->tec->formatMoney($inv->grand_total); ?></th>

                    </tr>

                <?php }

                if ($inv->paid < $round_total) { ?>

                    <tr>
                    
                        <th></th>
                        
                        <th></th>

                        <th colspan="2"><?= lang("paid_amount"); ?></th>

                        <th colspan="2" class="text-right"><?= $this->tec->formatMoney($inv->paid); ?></th>

                    </tr>

                    <tr>
                        	
                        <th></th>
                        
                        <th></th>

                        <th colspan="2">Due Amount</th>

                        <th colspan="2" class="text-right"><?= $this->tec->formatMoney($inv->grand_total - $inv->paid); ?></th>

                    </tr>

                <?php } ?>

                </tfoot>

                </table>
               <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Next" name="next">
                </div >
                
                </form>

            </div>

        </div>

    </div>

</div>

</div>
</div>

