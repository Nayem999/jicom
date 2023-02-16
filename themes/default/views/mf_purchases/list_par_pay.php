<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog modal-lg">

    <div class="modal-content">

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()"  data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i></button>

            <h4 id="myModalLabel" class="modal-title">View Payments</h4>

        </div>

        <div class="modal-body">

            <div class="table-responsive">

                <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover table-striped" id="CompTable">

                    <thead>

                    <tr>

                        <th style="width:30%;">Date</th>

                        <th style="width:30%;">Reference</th>

                        <th style="width:15%;">Amount</th>

                        <th style="width:15%;">Paid by</th>

                        <th style="width:10%;">Actions</th>

                    </tr>

                    </thead>

                    <tbody>
                    <?php 
					if(isset($pay) && (count($pay) > 0)){
					foreach($pay as $value){
						//print_r($value);
						 ?>
                            <tr class="row13">

                                <td><?php echo  $this->tec->hrld($value->date); ?></td>

                                <td><?php echo $value->reference ?></td>

                                <td class="text-right"><?php echo $value->amount ?></td>

                                <td><?php echo $value->paid_by ; ?></td>

                                <td>

                                    <div class="text-center">

                                            <a data-toggle="ajax"  href='javascript:;' onClick='editParPay(<?php echo $value->p_pay_id ?>)' class="tip"><i class="fa fa-edit"></i></a>
                                            <a onclick="return confirm('You are going to delete payment, please click ok to delete.')" href="<?php echo site_url('purchases/delete_payment/'.$value->p_pay_id) ?>" title="Delete Payment" class="tip"><i class="fa fa-trash-o"></i></a>

                                        
                                    </div>

                                </td>

                            </tr>
                     <?php }
					    }
					  ?>
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>
</div>