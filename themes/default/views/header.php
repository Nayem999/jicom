<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<title>
<?= $page_title.' | '.$Settings->site_name; ?>
</title>
<link rel="shortcut icon" href="<?= $assets ?>images/icon.png"/>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>plugins/iCheck/square/green.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>plugins/redactor/redactor.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>dist/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css"/>
<link href="<?= $assets ?>dist/css/custom.css" rel="stylesheet" type="text/css" />
<link href="<?= $assets ?>dist/css/jquery.ultraselect.css" rel="stylesheet" type="text/css"/>
<script src="<?= $assets ?>plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
</head>

<body class="skin-green fixed sidebar-mini">
<div class="wrapper">
<header class="main-header"> <a href="<?= site_url(); ?>" class="logo"> <span class="logo-mini">POS</span> <span class="logo-lg">
  <?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="'.$assets.'/images/icon.png" alt="'.$Settings->site_name.'" />'; ?>
  </span> </a>
  <nav class="navbar navbar-static-top" role="navigation"> <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> 
      
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="hidden-xs hidden-sm"><a href="#" class="clock"></a></li>
        <li class="hidden-xs"><a href="<?= site_url(); ?>"><i class="fa fa-dashboard"></i></a></li>
          <?php 
          if($Admin) 
          { ?>
            <li class="hidden-xs"><a href="<?= site_url('settings'); ?>"><i class="fa fa-cogs"></i></a></li>
            <?php 
          } ?>
        <li><a href="<?= site_url('pos/view_bill'); ?>" target="_blank"><i class="fa fa-file-text-o"></i></a></li>
        <li><a href="<?= site_url('pos'); ?>"><i class="fa fa-th"></i></a></li>
          <?php 
          if($Admin && $qty_alert_num) 
          { ?>
            <li> <a href="<?= site_url('reports/alerts'); ?>"> <i class="fa fa-bullhorn"></i> <span class="label label-warning">
              <?= $qty_alert_num; ?>
              </span> </a> </li>
            <?php 
          } 
          if($suspended_sales) 
          { ?>
            <li class="dropdown notifications-menu"> 
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i> <span class="label label-warning"><?=sizeof($suspended_sales);?></span> </a>
              <ul class="dropdown-menu">
                <li class="header">
                  <?=lang('recent_suspended_sales');?>
                </li>
                <li>
                  <ul class="menu">
                    <li>
                      <?php
                        foreach ($suspended_sales as $ss) {
                          echo '<a href="'.site_url('pos/?hold='.$ss->id).'" class="load_suspended">'.$this->tec->hrld($ss->date).' ('.$ss->customer_name.')<br><strong>'.$ss->hold_ref.'</strong></a>'; 

                          } 
                      ?>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="<?= site_url('sales/opened'); ?>">
                  <?= lang('view_all'); ?>
                  </a></li>
              </ul>
            </li>
            <?php 
          } ?>
        <li class="dropdown user user-menu" style="padding-right:5px;"> 
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
            <img src="<?= base_url('uploads/avatars/thumbs/'.($this->session->userdata('avatar') ? $this->session->userdata('avatar') : $this->session->userdata('gender').'.png')) ?>" class="user-image" alt="Avatar" /> 
            <span class="hidden-xs"> <?= $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span> 
          </a>
          <ul class="dropdown-menu" style="padding-right:3px;">
            <li class="user-header"> 
              <img src="<?= base_url('uploads/avatars/'.($this->session->userdata('avatar') ? $this->session->userdata('avatar') : $this->session->userdata('gender').'.png')) ?>" class="img-circle" alt="Avatar" />
              <p>
                <?= $this->session->userdata('email'); ?>
                <small>
                <?= lang('member_since').' '.$this->session->userdata('created_on'); ?>
                </small> </p>
            </li>
            <li class="user-footer">
              <div class="pull-left"> <a href="<?= site_url('users/profile/'.$this->session->userdata('user_id')); ?>" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> <a href="<?= site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a> </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu"> 
      <li class="mm_welcome"><a href="<?= site_url(); ?>"><i class="fa fa-dashboard"></i> <span>
        <?= lang('dashboard'); ?>
        </span></a></li>
      <li class="mm_pos"><a href="<?= site_url('pos'); ?>"><i class="fa fa-th"></i> <span>
        <?= lang('pos'); ?>
        </span></a></li>
      <?php 
      if(($Admin) || ($Manager)) 
      { 
        ?>
        <li class="treeview mm_products"> <a href="#"> <i class="fa fa-barcode"></i> <span>
          <?= lang('products'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="products_index"><a href="<?= site_url('products'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_products'); ?>
              </a></li>
            <li id="products_add"><a href="<?= site_url('products/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_product'); ?>
              </a></li>
            <li id="products_import"><a href="<?= site_url('products/import'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('import_products'); ?>
              </a></li>
            <li id="products_print_barcodes"><a onclick="window.open('<?= site_url('products/print_barcodes'); ?>', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;" href="#"><i class="fa fa-circle-o"></i>
              <?= lang('print_barcodes'); ?>
              </a></li>
            <li id="products_print_labels"><a onclick="window.open('<?= site_url('products/print_labels'); ?>', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;" href="#"><i class="fa fa-circle-o"></i>
              <?= lang('print_labels'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_categories"> <a href="#"> <i class="fa fa-folder"></i> <span>
          <?= lang('categories'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="categories_index"><a href="<?= site_url('categories'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_categories'); ?>
              </a></li>
            <li id="categories_index"><a href="<?= site_url('categories/available_cat'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Available Cat Qty'); ?>
              </a></li>
            <li id="categories_add"><a href="<?= site_url('categories/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_category'); ?>
              </a></li>
            <li id="categories_import"><a href="<?= site_url('categories/import'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('import_categories'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_brands"> <a href="#"> <i class="fa fa-folder"></i> <span>
          <?= lang('Brands'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="brands_index"><a href="<?= site_url('brands'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('List_Brands'); ?>
              </a></li> 
            <li id="brands_add"><a href="<?= site_url('brands/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add_Brands'); ?>
              </a></li> 
          </ul>
        </li>

        <li class="treeview mm_sales"> <a href="#"> <i class="fa fa-shopping-cart"></i> <span>
          <?= lang('sales'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="sales_today"><a href="<?= site_url('sales/today'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Today sales'); ?> </a></li>
            <li id="sales_index"><a href="<?= site_url('sales'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_sales'); ?> </a></li>
            <li id="sales_sale_log"><a href="<?= site_url('sales/sale_log'); ?>"><i class="fa fa-circle-o"></i> <?= lang('Sale log '); ?> </a></li>  
            <li id="sales_opened"><a href="<?= site_url('sales/opened'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_opened_bills'); ?> </a></li>
          </ul>
        </li>
      
        <li class="treeview mm_salereturn"> <a href="#"> <i class="fa fa-shopping-cart"></i> <span>
          <?= lang('Sales_Return'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu"> 
              <li id="sales_index"><a href="<?= site_url('salereturn'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_sales_return'); ?>
              </a></li>
              <li id="sales_opened"><a href="javascript:;" onClick="salereturnPage('return')"><i class="fa fa-circle-o"></i> Add sales return</a></li> 
          </ul>
        </li>

        <!-- <li class="treeview mm_service"> <a href="#"><i class="fa fa-tree" aria-hidden="true"></i><span>Service</span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="sales_index"><a href="<?// site_url('service'); ?>"><i class="fa fa-circle-o"></i> List Service</a></li>
            <li id="sales_opened"><a href="javascript:;" onClick="servicePage('Service')"><i class="fa fa-circle-o"></i> Add Service</a></li>
          </ul>
        </li> -->

        <li class="treeview mm_purchases"> <a href="#"> <i class="fa fa-plus"></i> <span>
          <?= lang('Product purchases'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="purchases_index"><a href="<?= site_url('purchases/today'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Today\'s Purchases'); ?>
              </a></li>
            <li id="purchases_index"><a href="<?= site_url('purchases'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_purchases'); ?>
              </a></li>
            <li id="purchases_add"><a href="<?= site_url('purchases/add'); ?>"><i class="fa fa-circle-o"></i>
                <?= lang('add_purchase'); ?>
                </a></li>
            <li class="divider"></li>         
          </ul>
        </li>

        <?php 
          if($Admin) 
          { ?>
            <!-- <li class="treeview mm_transfers"> <a href="#"> <i class="fa fa-folder"></i> <span>
              <?= lang('Transfers'); ?>
              </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu"> 
                <li id="transfers_index"><a href="<?= site_url('transfers'); ?>"><i class="fa fa-circle-o"></i>
                  <?= lang('Transfers'); ?>
                  </a></li> 
                <li id="transfers_add"><a href="javascript:;" onClick="productsTransfer()"><i class="fa fa-circle-o"></i> Add Transfers</a></li>
              </ul>
            </li> -->
            <?php 
          } 
        ?>
        <li class="treeview mm_supplierpayment"> <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>
          <?= lang('Supplier\'s payments'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="supplierpayment_payment"><a href="<?= site_url('supplierpayment/purchase_payment'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add Payments'); ?>
              </a></li>
            <li id="supplierpayment_paymentList"><a href="<?= site_url('supplierpayment/paymentList'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Payments list'); ?>
              </a></li>
            <li class="divider"></li>         
          </ul>
        </li>
     
        <li class="treeview mm_expenses"> <a href="#"><i class="fa fa-delicious" aria-hidden="true"></i><span>
          <?= lang('Expenses'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
          <li id="expenses_add_category"><a href="<?= site_url('expenses/add_category'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add category'); ?>
              </a></li>
              <li id="expenses_listcategory"><a href="<?= site_url('expenses/listcategory'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Category list'); ?>
              </a></li>
              <li id="expenses_index"><a href="<?= site_url('expenses'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_expenses'); ?>
              </a></li>
            <li id="expenses_add_expense"><a href="<?= site_url('expenses/add_expense'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_expense'); ?>
              </a></li>
          </ul>
        </li>
        
        <li class="treeview mm_collection"> <a href="#"><i class="fa fa-reply" aria-hidden="true"></i> <span>
          <?= lang('Collections'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="collection_index"><a href="<?= site_url('collection'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Collections list'); ?>
              </a></li>
            <li id="collection_collectionpayment"><a href="<?= site_url('collection/collectionpayment'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add Collections'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_reports"> <a href="#"> <i class="fa fa-bar-chart-o"></i> <span>
          <?= lang('reports'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="reports_daily_statement"><a href="<?= site_url('reports/daily_statement'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Daily Statement'); ?>
              </a></li>
              <!-- <li id="reports_hand_cash"><a href="<?= site_url('reports/hand_cash'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Hand Cash'); ?>
              </a></li> -->
              <li id="reports_todayhighlight"><a href="<?= site_url('reports/todayhighlight'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Today\'s Highlights'); ?>
              </a></li>
              <!-- <li id="reports_pettycash"><a href="<?= site_url('reports/pettycash'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Petty Cash'); ?></a></li>
              <li id="reports_pettycashlist"><a href="<?= site_url('reports/pettycashlist'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Petty Cash list'); ?> </a></li>-->
              <li id="reports_payablelist"><a href="<?= site_url('reports/payablelist'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Account Payable'); ?></a></li>
              <li id="reports_receivablelist"><a href="<?= site_url('reports/receivablelist'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Acount Receivable'); ?>
              </a></li>
              <!-- <li id="reports_netprofit"><a href="<?= site_url('reports/netprofit'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Net Profit'); ?>
              </a></li> -->
            <li id="reports_daily_sales"><a href="<?= site_url('reports/daily_sales'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('daily_sales'); ?>
              </a></li>
            <!-- <li id="reports_monthly_sales"><a href="<?= site_url('reports/monthly_sales'); ?>"><i class="fa fa-circle-o"></i>
              <?// lang('monthly_sales'); ?>
              </a></li> -->
            <li id="reports_index"><a href="<?= site_url('reports'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('sales_report'); ?>
              </a></li>
            <!-- <li class="divider"></li>
            <li id="reports_payments"><a href="<?= site_url('reports/payments'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('payments_report'); ?>
              </a></li> -->
            <!-- <li class="divider"></li> -->
            <!-- <li id="reports_registers"><a href="<?= site_url('reports/registers'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('registers_report'); ?>
              </a></li> -->
            <li class="divider"></li>
            <li id="reports_top_products"><a href="<?= site_url('reports/top_products'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('top_products'); ?>
              </a></li>
            <li id="reports_products"><a href="<?= site_url('reports/products'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('products_report'); ?>
              </a></li>
              <li id="reports_sold_purchase"><a href="<?= site_url('reports/sold_purchase'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Sold & Purchase'); ?>
              </a></li>
            <li id="reports_productQuery"><a href="<?= site_url('reports/productQuery'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Product Query'); ?>
              </a></li>
            <!-- <li id="reports_sequenceReport"><a href="<?= site_url('reports/sequenceReport'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Sequence Report'); ?>
              </a></li> -->
            <li id="reports_products_staff"><a href="<?= site_url('reports/products_staff'); ?>"><i class="fa fa-circle-o"> </i>Products list (Staff) </a></li>
            <li id="reports_products_all"><a href="<?= site_url('reports/products_all'); ?>"><i class="fa fa-circle-o"> </i>Products list (All) </a></li>
            <li id="reports_product_stock"><a href="<?= site_url('reports/product_stock'); ?>"><i class="fa fa-circle-o"> </i>Products Stock </a></li>
            <li id="reports_store_product_stock"><a href="<?= site_url('reports/store_product_stock'); ?>"><i class="fa fa-circle-o"> </i>Store Stock Product </a></li>
            <li id="reports_invoiceProfit"><a href="<?= site_url('reports/invoiceProfit'); ?>"><i class="fa fa-circle-o"> </i>Invoice Profit</a></li>
            <li id="reports_salaryReport"><a href="<?= site_url('reports/salaryReport'); ?>"><i class="fa fa-circle-o"> </i>Salary Report</a></li>
            <!-- <li id="reports_warrentyReport"><a href="<?= site_url('reports/warrentyReport'); ?>"><i class="fa fa-circle-o"> </i>Warranty Report</a></li> -->
            <li id="reports_expensesReport"><a href="<?= site_url('reports/expenses_rpt'); ?>"><i class="fa fa-circle-o"> </i>Expenses Report</a></li>
            <li id="reports_creditCollectionReport"><a href="<?= site_url('reports/credit_collection_rpt'); ?>"><i class="fa fa-circle-o"> </i>Credit Collection</a></li>
            <li id="reports_bank_balanceReport"><a href="<?= site_url('reports/bank_balance'); ?>"><i class="fa fa-circle-o"> </i>Bank Balance </a></li>
          </ul>
        </li>

        <!--<li class="treeview mm_quotation"> <a href="#"><i class="fa fa-comment"></i>-->
        <!--   <span>-->
        <!--    <?// lang('Sms Corner'); ?>-->
        <!--   </span> <i class="fa fa-angle-left pull-right"></i> </a>-->
        <!--    <ul class="treeview-menu">-->
        <!--    <li id="smscorner_paymentList"><a href="<?= site_url('smscorner/paymentList'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Supplier Payments'); ?>-->
        <!--      </a></li>-->
        <!--      <li id="smscorner_receivablelist"><a href="<?= site_url('smscorner/receivablelist'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Customer Payment'); ?>-->
        <!--      </a></li> -->
        <!--      <li id="smscorner_history"><a href="<?= site_url('smscorner/history'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Sms History'); ?>-->
        <!--      </a></li> -->
        <!--  </ul>-->
        <!--</li>-->
        <!--<li class="treeview mm_quotation"> <a href="#"><i class="fa fa-exchange"></i>-->
        <!--   <span>-->
        <!--    <?// lang('Quotation'); ?>-->
        <!--   </span> <i class="fa fa-angle-left pull-right"></i> </a>-->
        <!--    <ul class="treeview-menu">-->
        <!--    <li id="quotation_index"><a href="<?= site_url('quotation'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Quotation list'); ?>-->
        <!--      </a></li>-->
        <!--      <li id="quotation_addQuotation"><a href="<?= site_url('quotation/addQuotation'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Add Quotation'); ?>-->
        <!--      </a></li> -->
        <!--  </ul>-->
        <!--</li>-->
        <!--<li class="treeview mm_merge"> <a href="#"><i class="fa fa-exchange"></i>-->
        <!--   <span>-->
        <!--    <?// lang('Merge'); ?>-->
        <!--   </span> <i class="fa fa-angle-left pull-right"></i> </a>-->
        <!--    <ul class="treeview-menu">-->
        <!--    <li id="merge_index"><a href="<?= site_url('merge'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Merge list'); ?>-->
        <!--      </a></li>-->
        <!--      <li id="merge_add_merge"><a href="<?= site_url('merge/add_merge'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Add merge'); ?>-->
        <!--      </a></li>-->
        <!--    <li id="merge_laser"><a href="<?= site_url('merge/laser'); ?>"><i class="fa fa-circle-o"></i>-->
        <!--      <?// lang('Laser list'); ?>-->
        <!--      </a></li>-->
        <!--  </ul>-->
        <!--</li>-->
        <!-- <li class="treeview mm_gift_cards"> <a href="#"> <i class="fa fa-credit-card"></i> <span>
          <?// lang('gift_cards'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="gift_cards_index"><a href="<?= site_url('gift_cards'); ?>"><i class="fa fa-circle-o"></i>
              <?// lang('list_gift_cards'); ?>
              </a></li>
            <li id="gift_cards_add"><a href="<?= site_url('gift_cards/add'); ?>"><i class="fa fa-circle-o"></i>
              <?// lang('add_gift_card'); ?>
              </a></li>
          </ul>
        </li> -->   

        <li class="treeview mm_bank"> <a href="#"><i class="fa fa-university" aria-hidden="true"></i>
          <span>Bank Account</span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="bank_index"><a href="<?= site_url('bank'); ?>"><i class="fa fa-circle-o"></i>List Bank Account</a></li>
            <li id="bank_add"><a href="<?= site_url('bank/add'); ?>"><i class="fa fa-circle-o"></i>New Bank Account</a></li>
            <li id="bank_pendingCheque"><a href="<?= site_url('bank/pendingCheque'); ?>"><i class="fa fa-circle-o"></i>Peding Cheque</a></li>
            <li id="bank_approved_cheque"><a href="<?= site_url('bank/approved_cheque'); ?>"><i class="fa fa-circle-o"></i>Approved Cheque</a></li>
            <!--<li id="bank_pending_loan"><a href="<?= site_url('bank/pending_loan'); ?>"><i class="fa fa-circle-o"></i>Bank Loan</a></li>-->
            <!--<li id="bank_pending_donations"><a href="<?= site_url('bank/pending_donations'); ?>"><i class="fa fa-circle-o"></i>Bank Pending Donations </a></li>-->
            <!--<li id="bank_pending_salary"><a href="<?= site_url('bank/pending_salary'); ?>"><i class="fa fa-circle-o"></i>Bank Pending salary </a></li>-->
            <!--<li id="bank_pending_expenses"><a href="<?= site_url('bank/pending_expenses'); ?>"><i class="fa fa-circle-o"></i>Bank Pending expenses </a></li>-->
          </ul>
        </li>

        <!--<li class="treeview mm_loan"> <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i>-->
        <!--  <span>Loan Module</span> <i class="fa fa-angle-left pull-right"></i> </a>-->
        <!--  <ul class="treeview-menu">  -->
        <!--    <li id="loan_add_loaner"><a href="<?= site_url('loan/add_loaner'); ?>"><i class="fa fa-circle-o"></i>Add Loaner</a></li>-->
        <!--    <li id="loan_index"><a href="<?= site_url('loan'); ?>"><i class="fa fa-circle-o"></i>List Loaner</a></li>  -->
        <!--    <li id="loan_pay_loan"><a href="<?= site_url('loan/pay_loan'); ?>"><i class="fa fa-circle-o"></i> <?= lang('Pay Loan'); ?>-->
        <!--    </li>-->
        <!--    <li id="loan_add_loan"><a href="<?= site_url('loan/add_loan'); ?>"><i class="fa fa-circle-o"></i>Receive Loan</a>-->
        <!--    </li> -->
        <!--    <li id="loan_loan_report"><a href="<?= site_url('loan/loan_report'); ?>"><i class="fa fa-circle-o"></i>Loaner Report </a>-->
        <!--    </li> -->
        <!--    <li id="loan_list_loan"><a href="<?= site_url('loan/list_loan'); ?>"><i class="fa fa-circle-o"></i>All Loan Transcation</a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->
        <!--<li class="treeview mm_donations"> <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i>-->
        <!--  <span>Donations Module</span> <i class="fa fa-angle-left pull-right"></i> </a>-->
        <!--  <ul class="treeview-menu">  -->
        <!--    <li id="donations_add"><a href="<?= site_url('donations/add'); ?>"><i class="fa fa-circle-o"></i>Add Persons or Organizations</a></li>-->
        <!--    <li id="donations_index"><a href="<?= site_url('donations'); ?>"><i class="fa fa-circle-o"></i>Persons or Organizations List</a></li>  -->
        <!--    <li id="donations_pay"><a href="<?= site_url('donations/pay'); ?>"><i class="fa fa-circle-o"></i> Pay</a> </li>   -->
        <!--    <li id="donations_pay_list"><a href="<?= site_url('donations/pay_list'); ?>"><i class="fa fa-circle-o"></i>Pay List</a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->
        <!--<li class="treeview mm_attachment"> <a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i>-->
        <!--  <span>Attachment Module</span> <i class="fa fa-angle-left pull-right"></i> </a>-->
        <!--  <ul class="treeview-menu">  -->
        <!--    <li id="attachment_add_person"><a href="<?= site_url('attachment/add_person'); ?>"><i class="fa fa-circle-o"></i>Add Name</a></li>-->
        <!--    <li id="attachment_index"><a href="<?= site_url('attachment'); ?>"><i class="fa fa-circle-o"></i>Name List</a></li> -->
        <!--    <li id="attachment_add_category"><a href="<?= site_url('attachment/add_category'); ?>"><i class="fa fa-circle-o"></i>Add Note Category</a></li>-->
        <!--    <li id="attachment_category"><a href="<?= site_url('attachment/category'); ?>"><i class="fa fa-circle-o"></i>Note Category List</a></li>  -->
        <!--    <li id="attachment_docs"><a href="<?= site_url('attachment/docs'); ?>"><i class="fa fa-circle-o"></i>Note Recived/Send</a> </li>   -->
        <!--    <li id="attachment_docs_list"><a href="<?= site_url('attachment/docs_list'); ?>"><i class="fa fa-circle-o"></i>Note List</a>-->
        <!--    </li>-->
        <!--    <li id="attachment_docs_log_list"><a href="<?= site_url('attachment/docs_log_list'); ?>"><i class="fa fa-circle-o"></i>Note log List</a>-->
        <!--    </li>-->
        <!--  </ul>-->
        <!--</li>-->
        <!-- sahin -->  

        <li class="treeview mm_auth mm_customers mm_suppliers"> <a href="#"> <i class="fa fa-users"></i> <span>
          <?= lang('people'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
        
          <ul class="treeview-menu">
          <?php if($Admin) { ?>
            <li id="auth_users"><a href="<?= site_url('users'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_users'); ?>
              </a></li>
            <li id="auth_add"><a href="<?= site_url('users/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_user'); ?>
              </a></li>
            <?php } ?> 
            <li class="divider"></li>
            <li id="auth_users"><a href="<?= site_url('employee'); ?>"><i class="fa fa-circle-o"></i> List Employee</a></li>
            <li id="auth_add"><a href="<?= site_url('employee/add'); ?>"><i class="fa fa-circle-o"></i> Add Employee </a></li>
            <li class="divider"></li>
            <li id="customers_index"><a href="<?= site_url('customers'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_customers'); ?>
              </a></li>
            <li id="customers_add"><a href="<?= site_url('customers/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_customer'); ?>
              </a></li>
            <li class="divider"></li>
            <li id="suppliers_index"><a href="<?= site_url('suppliers'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_suppliers'); ?>
              </a></li>
            <li id="suppliers_add"><a href="<?= site_url('suppliers/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_supplier'); ?>
              </a></li>
          </ul>
        </li>  

        <li class="treeview mm_store"> <a href="#"> <i class="fa fa-sitemap"></i> <span>
          <?= lang('Stores'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="store_index"><a href="<?= site_url('store'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Stores'); ?>
              </a></li>
              <?php if($Admin) { ?>          
              <li id="store_add"><a href="<?= site_url('store/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('Add Store'); ?></a></li>  
              <?php } ?>
            
          </ul>
        </li>

        <li class="treeview mm_settings"> <a href="#"> <i class="fa fa-cogs"></i> <span>
          <?= lang('settings'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="settings_index"><a href="<?= site_url('settings'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('settings'); ?>
              </a></li>
            
              <li id="settings_backups"><a href="<?= site_url('settings/backups'); ?>"><i class="fa fa-circle-o"></i> <?= lang('backups'); ?></a></li>  
            
          </ul>
        </li>
      
        <?php 
      } 
      else 
      {    //  Staff
        ?>
      
      
        <li class="treeview mm_products"> <a href="#"> <i class="fa fa-barcode"></i> <span>
          <?= lang('products'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="products_index"><a href="<?= site_url('products'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_products'); ?>
              </a></li>
            <li id="products_add"><a href="<?= site_url('products/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_product'); ?>
              </a></li>
            <li id="products_import"><a href="<?= site_url('products/import'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('import_products'); ?>
              </a></li>
            <li id="products_print_barcodes"><a onclick="window.open('<?= site_url('products/print_barcodes'); ?>', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;" href="#"><i class="fa fa-circle-o"></i>
              <?= lang('print_barcodes'); ?>
              </a></li>
            <li id="products_print_labels"><a onclick="window.open('<?= site_url('products/print_labels'); ?>', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;" href="#"><i class="fa fa-circle-o"></i>
              <?= lang('print_labels'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_categories"> <a href="#"> <i class="fa fa-folder"></i> <span>
          <?= lang('categories'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="categories_index"><a href="<?= site_url('categories'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_categories'); ?>
              </a></li>         
            <li id="categories_add"><a href="<?= site_url('categories/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_category'); ?>
              </a></li>          
          </ul>
        </li>

        <!-- </span></a>
        </li> -->

        <li class="treeview mm_sales"> <a href="#"> <i class="fa fa-shopping-cart"></i> <span>
          <?= lang('sales'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
          <li id="sales_index"><a href="<?= site_url('sales/today'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Today sales'); ?>
            <li id="sales_index"><a href="<?= site_url('sales'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_sales'); ?>
              </a></li>
            <li id="sales_opened"><a href="<?= site_url('sales/opened'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_opened_bills'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_purchases"> <a href="#"> <i class="fa fa-plus"></i> <span>
          <?= lang('Product purchases'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="purchases_index"><a href="<?= site_url('purchases/today'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Today\'s Purchases'); ?>
              </a></li>
            <li id="purchases_index"><a href="<?= site_url('purchases'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_purchases'); ?>
              </a></li>
            <li id="purchases_add"><a href="<?= site_url('purchases/add'); ?>"><i class="fa fa-circle-o"></i>
                <?= lang('add_purchase'); ?>
                </a></li>
            <li class="divider"></li>         
          </ul>
        </li>

        <li class="treeview mm_collection"> <a href="#"><i class="fa fa-reply" aria-hidden="true"></i><span>
          <?= lang('Collections'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="collection_index"><a href="<?= site_url('collection'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Collections list'); ?>
              </a></li>
            <li id="collection_collectionpayment"><a href="<?= site_url('collection/collectionpayment'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add Collections'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_supplierpayment"> <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>
          <?= lang('Supplier\'s payments'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="supplierpayment_payment"><a href="<?= site_url('supplierpayment/purchase_payment'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add Payments'); ?>
              </a></li>
            <li id="supplierpayment_paymentList"><a href="<?= site_url('supplierpayment/paymentList'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Payments list'); ?>
              </a></li>
            <li class="divider"></li>         
          </ul>
        </li>
        
        <li class="treeview mm_expenses"> <a href="#"><i class="fa fa-delicious" aria-hidden="true"></i><span>
          <?= lang('Expenses'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
          <li id="expenses_add_category"><a href="<?= site_url('expenses/add_category'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Add category'); ?>
              </a></li>
              <li id="expenses_listcategory"><a href="<?= site_url('expenses/listcategory'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Category list'); ?>
              </a></li>
              <li id="expenses_index"><a href="<?= site_url('expenses'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_expenses'); ?>
              </a></li>
            <li id="expenses_add_expense"><a href="<?= site_url('expenses/add_expense'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_expense'); ?>
              </a></li>
          </ul>
        </li>
       
        <li class="treeview mm_customers"> <a href="#"> <i class="fa fa-users"></i> <span>
          <?= lang('customers'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="customers_index"><a href="<?= site_url('customers'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_customers'); ?>
              </a></li>
            <li id="customers_add"><a href="<?= site_url('customers/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_customer'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_suppliers"> <a href="#"> <i class="fa fa-users"></i> <span>
          <?= lang('suppliers'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">
            <li id="suppliers_index"><a href="<?= site_url('suppliers'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('list_suppliers'); ?>
              </a></li>
            <li id="suppliers_add"><a href="<?= site_url('suppliers/add'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('add_supplier'); ?>
              </a></li>
          </ul>
        </li>

        <li class="treeview mm_reports"> <a href="#"> <i class="fa fa-bar-chart-o"></i> <span>
          <?= lang('reports'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu"> 
              </a></li>
              <li id="reports_pettycash"><a href="<?= site_url('reports/pettycash'); ?>"><i class="fa fa-circle-o"></i>
              <?= lang('Petty Cash'); ?> 
            <li id="reports_products_staff"><a href="<?= site_url('reports/products_staff'); ?>"><i class="fa fa-circle-o"> </i>Products list (Staff) </a></li>  
          </ul>
        </li>

        <li class="treeview mm_settings"> <a href="#"> <i class="fa fa-cogs"></i> <span>
          <?= lang('settings'); ?>
          </span> <i class="fa fa-angle-left pull-right"></i> </a>
          <ul class="treeview-menu">          
            
              <li id="settings_backups"><a href="<?= site_url('settings/backups'); ?>"><i class="fa fa-circle-o"></i> <?= lang('backups'); ?></a></li> 
            
          </ul>
        </li>
        <?php 
      } ?>
    </ul>
  </section>
</aside>

<div class="content-wrapper">

<section class="content-header">
  <h1>
    <?= $page_title; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url(); ?>"><i class="fa fa-dashboard"></i>
      <?= lang('home'); ?>
      </a></li>
    <?php
      foreach ($bc as $b) {
          if ($b['link'] === '#') {
              echo '<li class="active">' . $b['page'] . '</li>';
          } else {
              echo '<li><a href="' . $b['link'] . '">' . $b['page'] . '</a></li>';
          }
      }
    ?>
  </ol>
</section>

<div class="col-lg-12 alerts">
  <div id="custom-alerts" style="display:none;">
    <div class="alert alert-dismissable">
      <div class="custom-msg"></div>
    </div>
  </div>
  <?php if($error)  { ?>
  <div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="icon fa fa-ban"></i>
      <?= lang('error'); ?>
    </h4>
    <?= $error; ?>
  </div>
  <?php } if($warning) { ?>
  <div class="alert alert-warning alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="icon fa fa-warning"></i>
      <?= lang('warning'); ?>
    </h4>
    <?= $warning; ?>
  </div>
  <?php } if($message) { ?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4> <i class="icon fa fa-check"></i>
      <?= lang('Success'); ?>
    </h4>
    <?= $message; ?>
  </div>
  <?php } ?>
</div>
