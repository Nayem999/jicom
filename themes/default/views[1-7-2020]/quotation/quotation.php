<div aria-hidden="false" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="posModal" 
data-easein="flipYIn" class="modal posModal in" style="display: block; padding-left: 17px;">
<div class="modal-dialog modal-lg">


    <div class="modal-content" >
		

        <div class="modal-header">

            <button aria-hidden="true" onclick="hide()" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i></button>

            <h4 id="myModalLabel" class="modal-title"><?php echo $quotation->quotation_title; ?></h4>

        </div>

        <div class="modal-body"> 

        <?php echo $quotation->quotation_details; ?> 
        <!-- <button class="btn btn-primary" onclick="sentMail(<?php echo $quotation->quotation_id; ?>)">Sent mail</button> 
        <p id="getMail"></p> -->
        <br>
        </div> 

    </div> 
</div>
</div>
</div> 
<!-- <script type="text/javascript">
     function sentMail(id){
        var txt; 
        var mailTo = prompt("Please enter your email:", "");
        var trimEmail = mailTo.trim();
        if (trimEmail == null || trimEmail == "") {
            txt = "User cancelled the prompt.";
        } else {   

            var mailTo = trimEmail.replace("@", "___");
            var site_url = "<?php echo site_url('quotation/sentMail'); ?>/" +mailTo+'/'+id; //append id at end 
            $("#getMail").load(site_url);   
        }
        document.getElementById("getMail").innerHTML = txt;
     }
</script> -->
