<script>

    $(document).ready(function() {

        if (get('remove_spo')) {

            if (get('spoitems')) {

                remove('spoitems');

            }

            remove('remove_spo');

        }

        <?php if($this->session->userdata('remove_spo')) { ?>

        if (get('spoitems')) {

            remove('spoitems');

        }

        <?php $this->tec->unset_data('remove_spo'); } ?>

        function attach(x) {

            if(x !== null) {

                return '<a href="<?=base_url();?>uploads/'+x+'" target="_blank" class="btn btn-primary btn-block btn-xs"><i class="fa fa-chain"></i></a>';

            }

            return '';

        }

        $('#purData').dataTable({

            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],

            "aaSorting": [[ 0, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,

            'bProcessing': true, 'bServerSide': true,

            'sAjaxSource': '<?= site_url('suppliers/get_purchases/'.$suppliers_id) ?>',

            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({

                    "name": "<?= $this->security->get_csrf_token_name() ?>",

                    "value": "<?= $this->security->get_csrf_hash() ?>"

                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },

             "aoColumns": [{"mRender":hrld}, null,  null, {"mRender":currencyFormat}, null, null,  null, {"mRender":attach, "bSortable":false, "bSearchable": false},{"bSortable":false, "bSearchable": false}]

        });

    });

</script>

<style type="text/css">.table td:nth-child(3) { text-align: right; }</style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('list_results'); ?></h3>

                </div>

                <div class="box-body">
                      <div class="table-responsive">
                <div class="col-xs-6">
                	<table class="table table-bordered">
                        <tbody>
                         
                         <tr>
                            <th class="col-xs-5">S. Name </th>
                            <th class="col-xs-7"><?php echo $this->purchases_model->getSupplierInfo($suppliers_id)->name;; ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Total Purchases  Amount</th>
                            <th class="col-xs-7"><?php echo $this->purchases_model->purchasesAmount('total', $suppliers_id ); ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Paid Amount</th>
                            <th class="col-xs-7"><?php echo $this->purchases_model->purchasesAmount('paid', $suppliers_id ); ?></th>
                          </tr>
                          <tr>
                            <th class="col-xs-5">Due Amount </th>
                            <th class="col-xs-7"><?php echo $this->purchases_model->purchasesAmount('deu', $suppliers_id ); ?></th>
                          </tr>
                         
                        
                        </tbody>
                      </table>
                     </div>
 					<div class="clearfix"></div>
                    </div>

                    <div class="table-responsive">

                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                            <tr class="active">

                                <th class="col-xs-2"><?= lang('date'); ?></th>

                                <th>Ref.</th>
                                
                                <th>S. Name</th>

                                <th class="col-xs-1"><?= lang('total'); ?></th>
                                
                                <th class="col-xs-1">Paid Amount </th>
                                
                                <th class="col-xs-1">Due Amount </th>

                                <th><?= lang('note'); ?></th>

                                <th style="width:25px; padding-right:5px;"><i class="fa fa-chain"></i></th>

                                <th style="width:115px;"><?= lang('actions'); ?></th>

                            </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td colspan="6" class="dataTables_empty"><?= lang('loading_data_from_server'); ?></td>

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

