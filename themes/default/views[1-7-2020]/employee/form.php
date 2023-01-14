
<section class="content">

	<div class="row">

		<div class="col-xs-12">

			<div class="box box-primary">

				<div class="box-header">

					<h3 class="box-title"><?= lang('enter_info'); ?></h3>

				</div>

				<div class="box-body">

					<?php echo form_open($action);?>



					<div class="col-md-6">
					    <?php if($this->session->userdata('store_id')==0){ ?> 
                            <div class="form-group">

                                <?= lang('Warehouse','Warehouse'); ?>

                                <?php  $wr[''] = lang("select")." ".lang("warehouse");

                                foreach($warehouses as $warehouse) {

                                    $wr[$warehouse->id] = $warehouse->name;

                                } ?>

                                <?= form_dropdown('warehouse', $wr, $emplyee->store_id, 'class="form-control select2 tip" id="supplier" required="required" style="width:100%;"'); ?>

                            </div> 
                        <?php } ?>

						<div class="form-group">

							<label class="control-label" for="code"><?= $this->lang->line("name"); ?></label>

							<?= form_input('name', set_value('name',$emplyee->name), 'class="form-control input-sm" id="name"'); ?>

						</div>
                        
                        
                        <div class="form-group">

							<label class="control-label" for="code">Father's name</label>

							<?= form_input('father_name', set_value('father_name',$emplyee->father_name), 'class="form-control input-sm" id="father_name"'); ?>

						</div>
                        
                        
                        <div class="form-group">

							<label class="control-label" for="code">Mother's name</label>

							<?= form_input('mather_name', set_value('mather_name', $emplyee->mather_name), 'class="form-control input-sm" id="mather_name"'); ?>

						</div>



						<div class="form-group">

							<label class="control-label" for="email_address"><?= $this->lang->line("email_address"); ?></label>

							<?= form_input('email', set_value('email' , $emplyee->email), 'class="form-control input-sm" id="email_address"'); ?>

						</div>



						<div class="form-group">

							<label class="control-label" for="phone"><?= $this->lang->line("phone"); ?></label>

							<?= form_input('phone', set_value('phone' , $emplyee->phone), 'class="form-control input-sm" id="phone"');?>

						</div>



						<div class="form-group">

							<label class="control-label" for="cf1">Position</label>
                            
                            <select name="position" class="form-control input-sm" >
                            	
                                <option value="" >Select</option>
                                <?php  $str = $Settings->position; 
								      $position =   explode(",",$str); 
									  foreach($position as $value){?>
                                      <option value="<?php echo $value; ?>" <?php if($emplyee->position == $value){ echo 'selected="selected"';} ?>><?php echo $value; ?></option>  
								      <?php   }  ?>

                             </select>

						</div>



						<div class="form-group">

							<label class="control-label" for="address">Address</label>

							<?= form_input('address', set_value('address' ,  $emplyee->address), 'class="form-control input-sm" id="address"');?>

						</div>

						<div class="form-group">

							<label class="control-label" for="address">Basic salary </label>

							<?= form_input('basic_salary', set_value('basic_salary',  $emplyee->basic_salary), 'class="form-control input-sm" id="basic_salary"');?>

						</div>
                        
                       
            			 <div class="form-group">

                               <label class="control-label" for="address">Date of Birth </label>

                                <?= form_input('date_of_birth', set_value('date_of_birth', $emplyee->date_of_birth), 'class="form-control " placeholder="YYYY-MM-DD" '); ?>

    					 </div>
                         
                         <div class="form-group">

                               <label class="control-label" for="address">Join Date </label>

                                <?= form_input('join_date', set_value('join_date', $emplyee->join_date), 'class="form-control "  placeholder="YYYY-MM-DD" '); ?>

                            </div>

						<div class="form-group">

							<?php echo form_submit('add_employee','Save', 'class="btn btn-primary"');?>

						</div>

					</div>

					<?php echo form_close();?>

				</div>

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


</script>