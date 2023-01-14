<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog modal-lg">


    <div class="modal-content" >
		

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i></button>

            <h4 id="myModalLabel" class="modal-title">View Payments salary (<?php echo $emplyee->name ; ?>)</h4>

        </div>

        <div class="modal-body">

            <div class="table-responsive">

                <table cellspacing="0" cellpadding="0" border="0" class="table table-bordered table-hover table-striped" id="CompTable">

                    <thead>

                    <tr>
                        <th style="width:15%;">Month/year</th>

                        <th style="width:15%;">Amount</th>

                        <th style="width:15%;">Paid By</th>

                        <th style="width:15%;">Commission</th>

                        <th style="width:30%;">Note</th>
                        
                        <th style="width:25%;">Submit Date</th>
                        
                        <th style="width:20%;">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    		<?php 
							function monthName($id){
								if($id == 01){
									$output = 'January';
								   }elseif($id == 02){
									$output = 'February';	
								   }elseif($id == 03){
									$output = 'March';	
								   }elseif($id == 04){
									$output = 'April';	
								   }elseif($id == 05){
									$output = 'May';	
								   }elseif($id == 06){
									$output = 'June';	
								   }elseif($id == 07){
									$output = 'July';	
								   }elseif($id == 08){
									$output = 'August';	
								   }elseif($id == 09){
									$output = 'September';	
								   }elseif($id == 10){
									$output = 'October';	
								   }elseif($id == 11){
									$output = 'November';	
								   }elseif($id == 12){
									$output = 'December';	
								   }
								   return $output;
								   
								} 
								  
							$i= 0;
							if(isset($list) && (count($list) > 0) ){ 
							foreach($list as $value){
							$i++;
							?>
                            <tr class="row<?php echo $i ; ?>">

                                <td><?php echo monthName($value->month_id).', '.$value->year ; ?></td>

                                <td><?php echo $value->amount ?></td>

                                <td><?php echo $value->paid_by ?></td>
                                
                                <td><?php echo $value->commission ?></td>

                                <td><?php echo $value->note ?></td>

                                <td><?php echo $value->pay_date ?></td>
                                
                                <td>
                                <a class="tip" data-toggle="ajax" onclick="editPay(<?php echo $value->pay_id ; ?>)" href="javascript:;">
                                	<i class="fa fa-edit"></i>
                                </a>
                                <a class="tip" onclick="return confirm('You are going to delete paysalary, please click ok to delete.')" href="<?php echo site_url('employee/paySalarydelete/'.$value->pay_id); ?>" title="Delete Payment">
                                <i class="fa fa-trash-o"></i>
                                </a>
                                
                                </td>

                            </tr>
                            
							<?php }
							}?>
                        
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</div>
</div>

