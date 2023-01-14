 
<style type="text/css"> 
     .td-center{
        text-align: center;
    }
    </style>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="daily_sales">Print report</button>
                    <?php if($this->session->userdata('group_id') == 2){

                        $u_id = $this->session->userdata('user_id') ;
                        }else{
                            $u_id = NULL;
                         }; ?>

                </div>
                <div class="box-body"> 
                 <div id="form" class="panel panel-warning">

                    <div class="panel-body">                       

                        <?= form_open("smscorner/payablelist");?> 

                        <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="customer"><?= lang("Supplier"); ?></label>
                                <?php 
                                $supname = $this->purchases_model->getAllSupper();                               

                                $cu[0] = lang("select")." ".lang("Supplier");
                                       foreach ($supname as $key => $sname) {
                                        $storeName = $this->site->getDataByElement('stores','id',$sname->store_id);  
                                        $storeName = $storeName[0]->name; 
                                            $cu[$sname->id] = $sname->name .'( '.$storeName.' )';
                                       } 
                                echo form_dropdown('customer', $cu, set_value('customer'), 'class="form-control select2" style="width:100%" id="customer"');  
                                ?>
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
                  <div class="col-xs-6">
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <?php foreach ($cID as $key => $cIDgetby) {
                              $cIDgetby->supplier_id;

                            }
                            $linkID = base_url('merge/salepucrchaslist').'/'.$cIDgetby->marge_id;
                            $sids = $_POST['customer'];
                            $snames = $this->purchases_model->getSuppByID($sids);
                            foreach ($snames as $key => $snam) {
                                # code...
                            } 
                            ?>
                            
                            <?php if($cIDgetby->supplier_id !=''){
                                echo '<th class="col-xs-3">'.$snam->name.'</th>';
                                echo '<th class="col-xs-3">
                                    <a target="_blank" href="'.$linkID.'">View</a></th>';
                            } else { ?>
                           <?php if($snam->name !=''){ 
                            echo  '<th class="col-xs-2">'.$snam->name.'</th>
                                   <th class="col-xs-2">'.($tDue - $snam->opening_blance).'</th>
                                   <th class="col-xs-2"><a href='.site_url('suppliers/supplier_laser').'/'.$sids.' target="_blank">Report</a></th>';
                            } } ?>
                          </tr>                        
                        </tbody>
                      </table>
                     </div>
                    </div> 
                     <?php 
                        $ord = $_GET['order'];
                        if($payabl !=''){
                           foreach ($payabl as $key => $part) {
                                   $sort[$key] = $part['tdue']; 
                              }
                            if($ord =='desc'){
                                array_multisort($sort, SORT_DESC, $payabl); 
                            } else if($ord =='asc'){
                               array_multisort($sort, SORT_ASC, $payabl);                                
                            } else{
                              array_multisort($sort, SORT_DESC, $payabl);   
                            }
                            }

                        ?>
                    <div class="table-responsive" id="page_content"> 
                        <table class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:5px;">

                            <thead>

                            <tr class="active">
                                
                                <th class="col-xs-2">Supplier Name</th>

                                <th class="col-xs-2">Store name</th>

                                <!-- <th class="col-xs-3">Grand total</th> -->

                                <!-- <th class="col-xs-2">Paid</th> -->

                                <th class="col-xs-2">Balance <a title="Descending " href="?order=desc"><span>&#8593;</span> </a>
                                <a title="Ascending" href="?order=asc"><span>&#8595;</span> </a></th>
                                <th class="col-xs-2">Action</th>


                            </tr>

                            </thead>

                            <tbody>

                            <?php                                 
                                 foreach ($payabl as $key => $pyabl) { ?>
                                <tr>
                                <!-- <td><?= $pyabl['id']; ?></td> -->
                                    <td class="td-center"><?= $pyabl['name']; ?></td>
                                    <td class="td-center"><?= $this->site->findeNameByID('stores','id',$pyabl['store_id'])->name  ?></td>
                                    <?php   
                                     $laser_url = site_url('suppliers/supplier_laser').'/'.$pyabl['id'];
                                    if($pyabl['marge_id'] !='') { 
                                        $linkID = base_url('merge/salepucrchaslist').'/'.$pyabl['marge_id'];
                                     ?>

                                    <td class="td-center"><a target="_blank" href="<?php echo $linkID; ?>">View</a></td>
                                    <td class="td-center"><a target="_blank" href="<?php echo $linkID; ?>">View</a></td>
                                    <td class="td-center"><a target="_blank" href="<?php echo $linkID; ?>">View</a></td>
                                    <?php } else { ?>
                                    <td class="td-center"><?= $this->tec->formatMoney($pyabl['tdue']); ?></td>
                                    <td class="td-center">
                                        <a target="_blank" href="<?php echo $laser_url; ?>" class="tip btn btn-primary btn-xs"><i class='fa fa-file-text-o'></i></a>
                                        <a data-toggle="modal" onclick="sendSms(<?= $pyabl['id'] ?>,'<?= $pyabl['name']; ?>')" data-target="#myModal" href="javscript:void(0)" class="tip btn btn-primary btn-xs"><i class='fa fa-paper-plane'></i></a>
                                    </td>
                                    <?php } ?>

                                </tr>
                                <?php  } ?>
                            </tbody>

                        </table>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Sms</h4>
      </div>
      <div class="modal-body">
        <form action="<?=base_url()?>smscorner/sms_send">
            <div class="form-group">
                <label for="">Supplier Name</label>
                <input type="text" name="supplier_name" class="form-control" id="supplierName">
                <input type="hidden" name="supplier_id" class="form-control" id="supplierId">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <small>&nbsp;&nbsp;(NB: Must use Country Code & (,) comma seperator for multiple number.)</small>
                <input type="tel" name="phone" class="form-control" id="phone">
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <textarea name="message" class="form-control" id="message" ></textarea>
                
            </div>
            <div class="form-group">
                <input type="submit" value="Send Sms" class="btn btn-primary">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function () {

        $('.datepicker').datetimepicker({

            format: 'YYYY-MM-DD'

        });

    });
 $("#daily_sales").click(function () {        
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none");
     var content = "<html> <br><p style='text-align:center'> <b class='box-title'>Account Payable list | <?= $this->Settings->site_name ?></b><br><b class='box-title'><p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
     content += document.getElementById("page_content").innerHTML;
     content += "</body>";
     content += "</html>";
     var printWin = window.open('','','left=20,top=40,width=700,height=550 '); 
     printWin.document.write(content);     
     printWin.focus();
     printWin.print();
     printWin.close();
     $(".dataTables_info").css("display", "block"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "block");
    $(".dataTables_paginate ").css("display", "block");
    $("#fileData_filter ").css("display", "block");   
  });


  function sendSms(supplier_id,name){
    var supplierId = supplier_id;
    //   alert(supplier_id);
    $.ajax({
               type:'get',
               url:'<?=base_url()?>smscorner/openmodal',
               headers: {'X-Requested-With': 'XMLHttpRequest'},
               data:{supplier_id : supplierId},
               dataType : "json",
               success:function(data) {
                  // $("#msg").html(data.msg);
                //   console.log(data);
                $('#supplierName').val(data.supplier_name);
                $('#phone').val(data.phone);
                $('#message').val(data.message);
                $('#supplierId').val(data.supplier_id);
                  console.log(data.supplier_name);
               }
            });
    //   $('#supplierName').val(name);
  }



  
 
//  $('#sel_user').change(function(){
//   var username = $(this).val();
//   $.ajax({
//    url:'index.php/User/userDetails',
//    method: 'post',
//    data: {username: username},
//    dataType: 'json',
//    success: function(response){
//      var len = response.length;
//      $('#suname,#sname,#semail').text('');
//      if(len > 0){
//        // Read values
//        var uname = response[0].username;
//        var name = response[0].name;
//        var email = response[0].email;

//        $('#suname').text(uname);
//        $('#sname').text(name);
//        $('#semail').text(email);

//      }

//    }
//  });
// });

</script>