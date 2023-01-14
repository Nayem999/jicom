<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog modal-lg">


    <div class="modal-content" >
		

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i></button>

            <h4 id="myModalLabel" class="modal-title"><?php echo $quotation->quotation_title; ?></h4>

        </div>

        <div class="modal-body"> 

        <?= form_open_multipart("quotation/sentMail", 'class="validation"');?>
             
                <div class="form-group">
                    <?= lang('Subject', 'Subject'); ?>
                    <?= form_input('subject', set_value('subject'), 'class="form-control tip" id="subject"  required="required"'); ?>
                   
                </div>
                <div class="form-group">
                    <?= lang('to', 'To'); ?>
                    <?= form_input('to', set_value('to'), 'class="form-control tip" id="to"  required="required"'); ?>
                     <span>*Please use comma separated email address for more then one email  &nbsp &nbsp</span>
                    <span> (i.e - example1@example.com, example2@example.com)</span>
                </div>
                <div class="form-group">
                    <?= lang('Cc', 'Cc'); ?>
                    <?= form_input('cc', set_value('cc'), 'class="form-control tip" id="cc"'); ?>
                     <span>*Please use comma separated email address for more then one email  &nbsp &nbsp</span>
                    <span> (i.e - example1@example.com, example2@example.com)</span>
                </div>
                <input type="hidden" name="quotation_id" value="<?php echo $quotation->quotation_id; ?>"> 
            
        <div class="form-group">
            <?= form_submit('Sent_mail', lang('Sent mail'), 'class="btn btn-primary"'); ?>
        </div>
        <?= form_close();?> 
        <p id="getMail"></p>
        <br>
        </div> 

    </div> 
</div>
</div>
</div> 
 
