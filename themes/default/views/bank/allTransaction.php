
<script>

    $(document).ready(function () {

        $('#CuData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url($path) ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

            "aoColumns": [{"mRender":hrld}, null, null, {"bSortable":false, "bSearchable": false}]

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
                      <ul class="nav nav-tabs">
                            <li class="<?php if($active == 1){ echo 'active' ;} ?>"><a href="<?php echo base_url($tabPath.'/1') ?>"  >Cash in</a></li>
                            <li class="<?php if($active == 0){ echo 'active' ;} ?>"><a href="<?php echo base_url($tabPath.'/0') ?>"  >Cash Out</a></li>
                      </ul>
                      <br /><br />

                      <div class="table-responsive">
                        

                    <table id="CuData" class="table table-bordered table-hover table-striped">

                        <thead>

                        <tr>
                        
                            <th><?php echo 'Date' ?></th>

                            <th><?php echo 'Amount' ; ?></th>

                            <th><?php echo 'Note'; ?></th>

                            <th style="width:100px;"><?php echo $this->lang->line("actions"); ?></th>

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



