<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#UTable').dataTable();
    });
</script>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                    <button type="button" style="width:120px; float:right" class="btn btn-default btn-sm toggle_form pull-right" id="printWindow">Print report</button>
                </div> 
                <div class="box-body" id="page_content">
                    <table id="UTable" class="table table-bordered table-striped table-hover">
                        <thead class="cf">
                        <tr>
                            <th><?php echo lang('first_name'); ?></th>
                            <th><?php echo lang('last_name'); ?></th>
                            <th><?php echo lang('email'); ?></th>
                            <th><?php echo lang('group'); ?></th>
                            <th><?php echo "Store Name"; ?></th>
                            <th style="width:100px;"><?php echo lang('status'); ?></th>
                            <th style="width:80px;"><?php echo lang('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($users as $user) {
                            $userinfo=$this->site->findeNameByID('stores','id',$user->store_id);
                            echo '<tr>';
                            echo '<td>' . $user->first_name . '</td>';
                            echo '<td>' . $user->last_name . '</td>';
                            echo '<td>' . $user->email . '</td>';
                            echo '<td>' . $user->group . '</td>'; 
                            echo '<td>';
                            echo is_bool($userinfo)?null:$userinfo->name;
                            echo '</td>';
                            echo '<td class="text-center" style="padding:6px;">' . ($user->active ? '<span class="label label-success">' . lang('active') . '</span' : '<span class="label label-danger">' . lang('inactive') . '</span>') . '</td>';
                            echo '<td class="text-center" style="padding:6px;"><div class="btn-group btn-group-justified" role="group"><div class="btn-group btn-group-xs" role="group"><a class="tip btn btn-warning btn-xs" title="' . lang("profile") . '" href="' . site_url('users/profile/' . $user->id) . '"><i class="fa fa-edit"></i></a></div>
                            <div class="btn-group btn-group-xs" role="group"><a class="tip btn btn-danger btn-xs" title="' . lang("delete_user") . '" href="' . site_url('auth/delete/' . $user->id) . '" onclick="return confirm(\''.lang('alert_x_user').'\')"><i class="fa fa-trash-o"></i></a></div></div></td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $("#printWindow").click(function () {        
    $(".dataTables_info").css("display", "none"); 
    $(".dataTables_length, .dataTables_filter ").css("display", "none");
    $(".dataTables_paginate ").css("display", "none");
    $("#fileData_filter ").css("display", "none"); 
    var content = "<html> <br><p style='text-align:center'>User List </p><style> table {font-family: arial, sans-serif;border-collapse: collapse;width: 100%;}td, th {border: 1px solid #dddddd;text-align: left;padding: 2px;} tr:nth-child(even) {background-color: #dddddd;} </style>";
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
</script>
