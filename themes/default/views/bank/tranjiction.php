<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i>

            </button>

            <h4 id="myModalLabel" class="modal-title">Transaction</h4>

        </div>

        <!--<form accept-charset="utf-8" method="post" enctype="multipart/form-data" action="http://localhost/spos/sales/add_payment/3/2">
<input type="hidden" style="display:none;" > -->
        <!-- <?php form_open($action);?> -->
        <?php echo form_open("bank/editTransaction/".$transaction->tranjiction_id);?>

        <div class="modal-body">

            <p>Please fill in the information below</p>          

            <div class="clearfix"></div>

            <div id="payments">

                <div class="well well-sm well">

                    <div class="col-sm-12">

                        <div class="row">

                            <div class="col-sm-6">

                                <div class="payment">

                                    <div class="form-group">

                                        <label for="tran_amount">Amount</label>
                                       
                                        <input type="text" required="required" class="pa form-control kb-pad amount" 
                                        value="<?php if(isset($transaction->tran_amount)){ echo $transaction->tran_amount ; }?>" id="tran_amount" name="tran_amount">
                                        <?php  echo form_error('tran_amount');?>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
						
                        <label for="date">Tranjiction  Type</label>
                        <?php if($transaction->tranjiction_id ==''){ ?> 
                        <select name="tran_type" class="form-control" >
                            <option value="1">Cash In</option>
                            <option value="0">Cash Out</option>
                        </select>
                        <?php }else{ ?>
                         <input type="text" name="tran_type" class="pa form-control kb-pad amount" readonly="readonly" value="<?php if($transaction->tran_type == 0){ echo'Cash Out';  }else{ echo 'Cash In'; } ?>" />
                        <?php } ?>
                        <?php  echo form_error('tran_type');?>

                    </div>

                        </div>


                    </div>

                    <div class="clearfix"></div>

            </div>

            <div class="clearfix"></div>

        </div>



    </div>

    <div class="form-group">

        <label for="note">Note</label>
         <?= form_textarea('tran_note', set_value('tran_note',$transaction->tran_note), 'class="form-control tip redactor" id="tran_note"'); ?>
    </div>

</div>

<div class="modal-footer">

    <input type="submit"  class="btn btn-primary" value="Save" name="add_payment">

</div>

</form>
   </div>


</div>
</div>
