<script>

    $(document).ready(function () {
        function image(n) {
            if(n !== null) {
                return '<div style="width:80px; margin: 0 auto;"><a href="<?=base_url();?>uploads/fileupload/'+n+'" class="open-image"><img src="<?=base_url();?>uploads/fileupload/'+n+'" alt="" class="img-responsive"></a></div>';
            }
            return '';
        }
        function status(n) {
            if(n == 1) {
                return '<span class="label label-success">Enable</span>';
            }
            return '<span class="label btn-warning">Disabled</span>';
        }
        function copyTest(n){
             return '<input type="text" value="'+n+'" id="image_url"><p id="url"> </p><a class="copy-text" onclick="myFunction()">Copy Text</a>';
        } 
        $('#spData').dataTable({
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, '<?= lang('all'); ?>']],
            "aaSorting": [[ 0, "ASC" ]], "iDisplayLength": <?= $Settings->rows_per_page ?>,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': '<?= site_url('admin/fileupload/get_gallery') ?>',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "<?= $this->security->get_csrf_token_name() ?>",
                    "value": "<?= $this->security->get_csrf_hash() ?>"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            "aoColumns": [{"mRender":image,"bSortable":false}, {"mRender":copyTest}, {"mRender":status,"bSortable":false}, {"bSortable":false, "bSearchable": false}]
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
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr> 
                            <th><?= $this->lang->line("Image"); ?></th> 
                            <th><?= $this->lang->line("Url"); ?></th>   
                            <th><?php echo $this->lang->line("actions"); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          if($data){
                            foreach ($data as $key => $value) {
                            $file_parts = pathinfo($value->file_name); ?> 
                            <tr>
                              <td> 
                                <?php if($file_parts['extension'] =='pdf'){ ?>
                                  <img src="<?=base_url('uploads/fileupload/pdf.png');?>" alt="" class="img-responsive" width="80">
                                <?php }else if($file_parts['extension'] =='doc'){ ?>
                                  <img src="<?=base_url('uploads/fileupload/');?>doc.png" alt="" class="img-responsive" width="80">
                                <?php }else if($file_parts['extension'] =='docx'){ ?>
                                  <img src="<?=base_url('uploads/fileupload/docx.png');?>" alt="" class="img-responsive" width="80">
                                <?php }else if($file_parts['extension'] =='xls'){ ?>
                                  <img src="<?=base_url('uploads/fileupload/xls.png');?>" alt="" class="img-responsive" width="80">
                                <?php }else if($file_parts['extension'] =='zip'){ ?>
                                  <img src="<?=base_url('uploads/fileupload/zip.png');?>" alt="" class="img-responsive" width="80">
                                <?php }else{ ?>
                                  <img src="<?=base_url('uploads/fileupload/');?><?= $value->file_name ?>" alt="" class="img-responsive" width="80">
                                <?php } ?>                                  
                              </td>
                              <td><input type="text" value="<?= site_url().$value->url ?>" id="image_url<?= $value->id ?>"><p id="url"> </p><a class="copy-text" onclick="myFunction('<?= $value->id ?>')">Copy Text</a></td>
                              <td><a href="<?= site_url('admin/fileupload/delete/').$value->id ?>" onClick="return confirm('Are you sure to delete?')" class='tip btn btn-danger btn-xs' title="Delete"><i class='fas fa-trash'></i></a>
                              </td>
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
<script type="text/javascript">
    function copy(selector){
      var $temp = $("<div>");
      $("body").append($temp);
      $temp.attr("contenteditable", true)
           .html($(selector).html()).select()
           .on("focus", function() { document.execCommand('selectAll',false,null); })
           .focus();
      document.execCommand("copy");
      $temp.remove();
    }
    function myFunction(id) {
      /* Get the text field */
      var copyText = document.getElementById("image_url"+id);

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    } 
</script>