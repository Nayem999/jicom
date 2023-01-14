<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog">

    <div class="modal-content">

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i>

            </button>

            <h4 id="myModalLabel" class="modal-title">Pay Share profit<?php if(isset($emplyee->name)){ echo '('.$emplyee->name.')' ; } ?> </h4>

        </div>

        <!--<form accept-charset="utf-8" method="post" enctype="multipart/form-data" action="http://localhost/spos/sales/add_payment/3/2">
<input type="hidden" style="display:none;" > -->
        <?php echo form_open($action);?>

        <div class="modal-body">

            <p>Please fill in the information below</p>
            <div class="row">                
                <div class="col-sm-6">
                    <div class="form-group">
					    <label for="year">Year</label>
                        <select name="year" class="form-control">
                           <?php $carrent_year = date('Y');
						        $start_year = $carrent_year - 1 ;
 						    ?>
                            <option value="<?php echo $carrent_year; ?>" selected="selected"> <?php echo $carrent_year; ?></option>
                            <option value="<?php echo $start_year; ?>"> <?php echo $start_year; ?></option>
                        </select>
                        <?php  echo form_error('month_id');?>
                        
                    </div>

                </div>

                
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="date">Month</label>
                         <?php 
						 function slectedMonth($month1,$month2){
							 if($month1 == $month2){
								 echo  $output = 'selected="selected"' ;
								}else{
								 echo  $output = '' ;
								}
							 }
						 $carrent_year = date('m'); ?>
                        <select name="month_id" class="form-control">
                        	<option value="" > Select </option>
                            <option value="01" <?php slectedMonth($paySalary->month_id,'01') ?>>January</option>
                            <option value="02" <?php slectedMonth($paySalary->month_id,'02') ?>>February</option>
                            <option value="03" <?php slectedMonth($paySalary->month_id,'03') ?>>March</option>
                            <option value="04" <?php slectedMonth($paySalary->month_id,'04') ?>>April</option>
                            <option value="05" <?php slectedMonth($paySalary->month_id,'05') ?>>May</option>
                            <option value="06" <?php slectedMonth($paySalary->month_id,'06') ?>>June</option>
                            <option value="07" <?php slectedMonth($paySalary->month_id,'07') ?>>July</option>
                            <option value="08" <?php slectedMonth($paySalary->month_id,'08') ?>>August</option>
                            <option value="09" <?php slectedMonth($paySalary->month_id,'09') ?>>September</option>
                            <option value="10" <?php slectedMonth($paySalary->month_id,'10') ?>>October</option>
                            <option value="11" <?php slectedMonth($paySalary->month_id,'11') ?>>November</option>
                            <option value="12" <?php slectedMonth($paySalary->month_id,'12') ?>>December</option>                            
                        </select>  

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

                                        <label for="amount">Amount</label>
                                       
                                        <input type="text" required="required" class="pa form-control kb-pad amount" 
                                        value="<?php if(isset($paySalary->amount)){ echo $paySalary->amount ; }else{ echo $emplyee->basic_salary ; } ?>" id="amount" name="amount">
                                        <?php  echo form_error('amount');?>

                                    </div>

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
         <?= form_textarea('note', set_value('note',$paySalary->note), 'class="form-control tip redactor" id="note"'); ?>
    </div>

</div>

<div class="modal-footer">

    <input type="submit"  class="btn btn-primary" value="Save" name="add_payment">

</div>

</form>
   </div>


</div>
</div>
