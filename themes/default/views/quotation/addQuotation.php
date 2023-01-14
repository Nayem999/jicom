<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
 <!--  <img src="'.base_url(themes/default/assets/images/invoice-logo.png).'" /> -->
 
<?php $details = '
<div class="inv-logo"> 
    <img src="'.base_url("themes/default/assets/images/quotation-logo.png").'" align="center"/> 
</div>
<p>Quotation No: 201606011 '.nbs(100).' Date: '.date('d-m-Y').' </p> 
<p>To</p>
<p>Deputy Assistant director</p>
<p>IT-Administration </p>
<p>Bangladesh Telecommunication Regulatory Commision</p>

<p><strong> Subject: Price quotation for supply of CCTV Camera, Spare parts & installation
IEB Bhaban Level:5,6,7, Dhaka-1000</strong><p>
<p>Dear Sir,</p>
<p>We are pleased to quote as follows</p>
<table border="1" cellpadding="10">
    <thead>
        <th>SL#</th>
        <th>Items Name</th>
        <th>Qty</th>
        <th>UNIT PRICE (Tk.)</th>
        <th>Total Price(Tk.)</th>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>CCTV Camera Brand: Hikvision,Model: DS-2CE16A2P-IT5P  3.6mm-700TVL, Day & Night vision IR,Origin: Taiwan, Made in China (1 year warranty)</td>
            <td>4</td>
            <td>9000</td>
            <td>36,000</td>
        </tr>
        <tr>
            <td colspan="4" >Total</td>
            <td>36000</td>
        </tr>
    </tbody>
</table> 
<p>In word: Sixty six thousand one hundred only.</p>     

 <p>** Including Vat </p>
 <p>If you need any further information please feel free contact with us.</p>
  <strong>Thanks & Regards</strong> <br><br>
 <p><strong>Sham Das</strong></p>
<p>Proprietor</p>
<p>The Computer Today</p>
<p>Phone: +88-02-9634050,Call: +88-01678-141274, Cell: +88-01676-406170</p>
<p>Shop#: 121-122,level-2, Suvasto Arcade, New Elephant Road, Dhaka-1205</p>
<p>E-mail: computer_tdy@yahoo.com</p>';
?> 
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('enter_info'); ?></h3>
                </div>
                <div class="box-body">
                    <div class="col-lg-12">
                        <?= form_open_multipart("quotation/addQuotation", 'class="validation"');?>
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <?= lang('name', 'name'); ?>
                                    <?= form_input('name', set_value('name'), 'class="form-control tip" id="name"  required="required"'); ?>
                                </div>   
                            </div> 
                        </div> 
                        <div class="form-group">
                            <?= lang('details', 'details'); ?>
                            <?= form_textarea('details', $details, 'class="form-control tip redactor" id="details"'); ?>
                        </div>
                        <div class="form-group">
                            <?= form_submit('quotation', lang('Add_Quotation'), 'class="btn btn-primary"'); ?>
                        </div>
                        <?= form_close();?>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script> 
</script>
