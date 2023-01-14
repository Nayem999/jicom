<?php

$v = "?v=1";

    if($this->input->post('start_date')){

        $v .= "&start_date=".$this->input->post('start_date');

    }

    if($this->input->post('end_date')) {

        $v .= "&end_date=".$this->input->post('end_date');
    }
    
?>
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
            "aaSorting": [[ 2, "desc" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('reports/pettycashview/'. $v) ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {

                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });

                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});

            },
            "aoColumns": [  {"mRender":hrld}, null, null, null]

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
                    <?php if($this->session->userdata('group_id') == 2){

                        $u_id = $this->session->userdata('user_id') ;
                        }else{
                            $u_id = NULL;
                         }; ?>

                </div>
                <div class="box-body"> 
                 <div id="form" class="panel panel-warning">

                        <div class="panel-body">                       

                        <?= form_open("reports/pettycashlist");?>

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
                        <table id="purData" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                            <tr class="active">

                                <th class="col-xs-2">Date and Time</th>
                                
                                <th class="col-xs-2">Amount</th>

                                <th class="col-xs-3">Note</th>

                                <th class="col-xs-2">Action</th>

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
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {

        $('.datepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });

</script>