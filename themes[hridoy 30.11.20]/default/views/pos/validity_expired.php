<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<div class="modal-dialog">
    <div class="modal-content"> 
        <?= form_open("pos/validityExpired/"); ?>
        <div class="modal-body"> 
                <hr>
                <?php //echo $encryMsg .' <br> '. $decryMsg; ?>
                <div class="row"> 
                    <div class="col-sm-12"> 
                        <div class="form-group"> 
                            <?= lang("Expire Code"); ?> 
                             
                            <?= form_input('expired',$settings->expired_date, 'class="form-control input-tip" id="expired" required="required"'); ?>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><?=lang('close')?></button>
                <?= form_submit('close_register', lang('Submit'), 'class="btn btn-primary"'); ?>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2({minimumResultsForSearch:6});
    });
</script>
