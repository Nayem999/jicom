<script>
    $(document).ready(function () {
        function image(n) {
            if(n !== null) {
                return '<div style="width:80px; margin: 0 auto;"><a href="<?=base_url();?>uploads/gallery/'+n+'" class="open-image"><img src="<?=base_url();?>uploads/gallery/'+n+'" alt="" class="img-responsive"></a></div>';
            }
            return '';
        }
        function status(n) {
            if(n == 1) {
                return '<span class="label label-success">Enable</span>';
            }
            return '<span class="label btn-warning">Disabled</span>';
        }
        function title(n){
             return n ;
        } 
        $('#spData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "ASC" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('admin/gallery/get_gallery') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender":image,"bSortable":false}, null, null, null,  {"mRender":hrld}, {"mRender":status,"bSortable":false}, {"bSortable":false, "bSearchable": false}]
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
                    <table id="spData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr> 
                            <th><?php echo $this->lang->line("Image"); ?></th>
                            <th><?php echo $this->lang->line("Album Name"); ?></th>
                            <th><?php echo $this->lang->line("Caption"); ?></th>
                            <th><?php echo $this->lang->line("Order By"); ?></th> 
                            <th><?php echo $this->lang->line("Create Date"); ?></th>  
                            <th><?php echo $this->lang->line("Status"); ?></th> 
                            <th style="width:65px;"><?php echo $this->lang->line("actions"); ?></th>
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
