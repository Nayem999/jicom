<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog modal-lg">


    <div class="modal-content" >
		

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i></button>

            <h4 id="myModalLabel" class="modal-title">Add new occupation</h4>

        </div>

        <div class="modal-body">

            <div class="table-responsive">
                <?=  form_open('loan/designation_add/add', 'class="validation"') ?>
               <div class="col-lg-8">
                  <div class="form-group">
                    <label class="control-label">Occupation</label>*
                    <?= form_input('designation', set_value('designation'), 'class="form-control input-sm" id="cf2" required="required"');?>
                </div> 
                <div class="form-group">
                    <?php echo form_submit('add_loaner', $this->lang->line("Add Loaner"), 'class="btn btn-primary"');?>
                </div>
               </div>
               <?=  form_close() ?>
            </div>

        </div>

    </div>

</div>

</div>
</div>

