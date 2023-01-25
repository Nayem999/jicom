  <script>

    $(document).ready(function() {

        function image(n) {

            if(n !== null) {

                return '<div style="width:32px; margin: 0 auto;"><a href="<?=base_url();?>uploads/'+n+'" class="open-image"><img src="<?=base_url();?>uploads/thumbs/'+n+'" alt="" class="img-responsive"></a></div>';

            }

            return '';

        }

        function method(n) {

            return (n == 0) ? '<span class="label label-primary"><?= lang('inclusive'); ?></span>' : '<span class="label label-warning"><?= lang('exclusive'); ?></span>';

        }

        $('#SLData').dataTable( { 
            "aaSorting": [[ 2, "asc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,  
        });

});

</script>
<script type="text/javascript">

    $(document).ready(function(){

        /* $('#form').hide();

        $('.toggle_form').click(function(){

            $("#form").slideToggle();

            return false;

        }); */

    });

</script>
<style type="text/css">
    .dataTables_length {
        display: none !important ;
    }
    /*#fileData_length {
    display: none !important;*/

</style>
 
<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <a href="<?= site_url('reports/excel_invoiceProfit'); ?>" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="excelWindow">Download Report</a> 

                </div>
                <?php if($this->session->userdata('group_id') == 2){

                        $u_id = $this->session->userdata('user_id') ;
                        }else{
                            $u_id = NULL;
                         }; ?>

                <div class="box-body"> 
                    <div class="table-responsive">

                        <table id="SLData" class="table table-striped table-bordered table-condensed table-hover">

                            <thead>

                                <tr class="active">
                                    <th style="width: 150px;" ><?php echo $this->lang->line("date"); ?></th>
                                    <th>Store Name</th>
                                    <th>Inv NO </th>
                                    <th>Quentity</th>                                    
                                    <th ><?php echo $this->lang->line("Customer Name"); ?></th> 
                                    <th ><?php echo $this->lang->line("grand_total"); ?></th> 
                                    <th ><?php echo $this->lang->line("Cost Price"); ?></th> 
                                    <th ><?php echo $this->lang->line("Profit"); ?></th>
                                    <th ><?php echo $this->lang->line("Action"); ?></th>  

                                </tr> 

                            </thead>

                            <tbody>
                            <?php foreach ($results as $key => $result) { ?>
                                <tr>
                                    <td><?php echo $this->tec->hrld($result['date']); ?></td>
                                    <?php $storeName = $this->site->getDataByElement('stores','id',$result['store_id']); ?>
                                    <td><?php echo $storeName[0]->name; ?></td>
                                    <td><?php echo $result['id']; ?></td>
                                    <td><?php echo $result['qty']; ?></td>                                    
                                    <td><?php echo $result['customer_name']; ?></td>
                                    <td><?php echo $result['total']; ?></td>
                                    <td><?php echo $result['cost_price']; ?></td> 
                                    <td><?php echo ($result['total']-$result['cost_price']); ?></td>
                                     <?php
                                        $actdata = "<a href='#' onClick=\"MyWindow=window.open('" . site_url('pos/view/'.$result['id'].'/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("view_invoice")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a>";

                                     ?>
                                    <td><?php echo $actdata; ?> </td> 
                                </tr>

                                <?php } ?>

                            </tbody>

                        </table>
                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section> 

