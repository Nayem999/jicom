 
<script>

    $(document).ready(function () {

        $('#CuData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('bank/get_pettyTranReport') ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [ null,null,null,null,null, { "bSearchable": false},{"mRender":hrld}]

        });

    });

</script>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?> </h3>

                </div>

                <div class="box-body">                      

                      <div class="table-responsive">
                        

                    <table id="CuData" class="table table-bordered table-hover table-striped">

                        <thead>

                        <tr>
                          <th style="width:15%;">Bank Name</th>

                          <th style="width:15%;">Store Name</th>

                          <th style="width:15%;">Account Name</th>

                          <th style="width:15%;">Account No</th> 
                        
                          <th style="width:10%;">Amount</th> 

                          <th style="width:25%;">Note</th>
                            
                          <th style="width:20%;">Submit Date</th>  

                        </tr>

                        </thead>

                         <tbody>

                            <tr>

                                <td colspan="6" class="dataTables_empty"><?= lang('loading_data_from_server') ?></td>

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




