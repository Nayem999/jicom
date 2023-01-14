
<script>

    $(document).ready(function () {

        $('#CuData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('quotation/get_quotation') ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [{"mRender":hrld}, null,null, {"bSortable":false, "bSearchable": false}]

        });

    });

</script>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>

                </div>

                <div class="box-body">

                    <div class="table-responsive">

                    <table id="CuData" class="table table-bordered table-hover table-striped">

                        <thead>

                        <tr>

                            <th class="col-xs-2"><?php echo 'Date' ; ?></th> 
                            <th class="col-xs-2"><?php echo 'Title' ?></th> 
                            <th class="col-xs-2"><?php echo 'Sent mail' ?></th>  
                            <th style="width:50px;"><?php echo $this->lang->line("actions"); ?></th>

                        </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td colspan="4" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>

<script type="text/javascript">
    function quotation(id) {
     var dataString = 'id='+ id ; 
     var site_url = "<?php echo site_url('quotation/quotation'); ?>/" +id; //append id at end
     $("#paySalary").load(site_url);
    }
</script>
<script type="text/javascript">
    function sentMail(id) {
     var dataString = 'id='+ id ; 
     var site_url = "<?php echo site_url('quotation/sentMail'); ?>/" +id; //append id at end
     $("#paySalary").load(site_url);
    }
</script>