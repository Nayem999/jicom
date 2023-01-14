<script>
    $(document).ready(function() { 
        $('#SalaryData').dataTable({
            'bProcessing': true, 'bServerSide': false, 
            "aaSorting": [[ 1, "asc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, //'bServerSide': true, 
        });  
    });
</script>
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
    
    ?>

<style type="text/css">.table td:nth-child(3) { text-align: right; }</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <?php if($this->session->userdata('group_id') == 2){

                        $u_id = $this->session->userdata('user_id') ;
                        }else{
                            $u_id = NULL;
                         }; ?>

                </div>
                <div class="box-body"> 
                 <div id="form" class="panel panel-warning">

                        <div class="panel-body">                       

                        <?= form_open("reports/salaryReport");?>

                        <div class="row">

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="control-label" for="start_date"><?= lang("start_date"); ?></label>

                                    <?= form_input('start_date', set_value('start_date'), 'class="form-control datepicker" id="start_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="control-label" for="end_date"><?= lang("end_date"); ?></label>

                                    <?= form_input('end_date', set_value('end_date'), 'class="form-control datepicker" id="end_date"');?>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>

                            </div>

                        </div>

                        <?= form_close();?>

                    </div>

                    </div> 
                <div class="table-responsive">
          <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="SalaryData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                            <tr class="active">

                                <th class="col-xs-2">Date and Time</th>
                                
                                <th class="col-xs-2">Store Name</th> 

                                <th class="col-xs-2">Month & Year</th> 

                                <th class="col-xs-2">Amount</th>

                                <th class="col-xs-2">Employee Name</th>

                                <th class="col-xs-4">Note</th>

                            </tr>

                            </thead>                            

                            <tbody>
                            <?php if($results){ ?>
                            <?php foreach ($results as $key => $result) { ?> 
                                <tr>
                                    <td ><?php echo $this->tec->hrld($result->pay_date); ?></td>
                                     <?php $storeName = $this->site->getDataByElement('stores','id',$result->store_id); ?>
                                    <td><?php echo $storeName[0]->name; ?></td>
                                    <td ><?php echo monthName($result->month_id).' , '.$result->year; ?></td> 
                                    <td ><?php echo $result->amount; ?></td>
                                    <td ><?php echo $result->name; ?></td>
                                    <td ><?php echo $result->note; ?></td>
                                    
                                </tr>
                                <?php } } ?>

                            </tbody>

                        </table>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {

        $('.datepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });

</script>