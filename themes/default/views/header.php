<?php (defined('BASEPATH')) or exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <title>
    <?= $page_title . ' | ' . $Settings->site_name; ?>
  </title>
  <link rel="shortcut icon" href="<?= $assets ?>images/icon.png" />
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
  <link href="<?= $assets ?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $assets ?>dist/css/custom.css" rel="stylesheet" type="text/css" />
  <link href="<?= $assets ?>dist/css/jquery.ultraselect.css" rel="stylesheet" type="text/css" />
  <script src="<?= $assets ?>plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
</head>

<body class="skin-green fixed sidebar-mini">
  <div class="wrapper">
    <header class="main-header"> <a href="<?= site_url(); ?>" class="logo"> <span class="logo-mini">POS</span> <span class="logo-lg">
          <?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="' . $assets . '/images/icon.png" alt="' . $Settings->site_name . '" />'; ?>
        </span> </a>
      <nav class="navbar navbar-static-top" role="navigation"> <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="hidden-xs hidden-sm"><a href="#" class="clock"></a></li>
            <li class="hidden-xs"><a href="<?= site_url(); ?>"><i class="fa fa-dashboard"></i></a></li>
            <?php
            if ($Admin) { ?>
              <li class="hidden-xs"><a href="<?= site_url('settings'); ?>"><i class="fa fa-cogs"></i></a></li>
            <?php
            } ?>

            <li><a href="<?= site_url('pos'); ?>"><i class="fa fa-th"></i></a></li>
            <?php
            if ($Admin && $qty_alert_num) { ?>
              <li> <a href="<?= site_url('reports/alerts'); ?>"> <i class="fa fa-bullhorn"></i> <span class="label label-warning">
                    <?= $qty_alert_num; ?>
                  </span> </a> </li>
            <?php
            }
            ?>
            <li class="dropdown user user-menu" style="padding-right:5px;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('uploads/avatars/thumbs/' . ($this->session->userdata('avatar') ? $this->session->userdata('avatar') : $this->session->userdata('gender') . '.png')) ?>" class="user-image" alt="Avatar" />
                <span class="hidden-xs"> <?= $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></span>
              </a>
              <ul class="dropdown-menu" style="padding-right:3px;">
                <li class="user-header">
                  <img src="<?= base_url('uploads/avatars/' . ($this->session->userdata('avatar') ? $this->session->userdata('avatar') : $this->session->userdata('gender') . '.png')) ?>" class="img-circle" alt="Avatar" />
                  <p>
                    <?= $this->session->userdata('email'); ?>
                    <small>
                      <?= lang('member_since') . ' ' . $this->session->userdata('created_on'); ?>
                    </small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left"> <a href="<?= site_url('users/profile/' . $this->session->userdata('user_id')); ?>" class="btn btn-default btn-flat">Profile</a> </div>
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
          <li class="mm_welcome"><a href="<?= site_url(); ?>"><i class="fa fa-dashboard"></i> <span><?= lang('dashboard'); ?></span></a></li>
          <li class="divider"></li>
          <li style="background: #001B35;"><a href=""><span><b><?= lang('OUTLET'); ?></b></span></a></li>
          <li class="divider"></li>
          <?php

          // POS MODULE
          if ($this->site->permission('pos')) {
          ?>
            <li class="mm_pos"><a href="<?= site_url('pos'); ?>"><i class="fa fa-th"></i> <span><?= lang('pos'); ?></span></a></li>
          <?php
          }

          // PRODUCTS MODULE
          if ($this->site->permission('products')) {
          ?>
            <li class="treeview mm_products"> <a href="#"> <i class="fa fa-barcode"></i> <span>
                  <?= lang('products'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">

                  <?php if ($this->site->route_permission('products_view')) {?>
                    <li id="products_index"><a href="<?= site_url('products'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('list_products'); ?></a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('products_add')) {?>
                      <li id="products_add"><a href="<?= site_url('products/add'); ?>"><i class="fa fa-circle-o"></i>
                          <?= lang('add_product'); ?></a></li>
                      <li id="products_import"><a href="<?= site_url('products/import'); ?>"><i class="fa fa-circle-o"></i>
                          <?= lang('import_products'); ?></a></li>
                  <?php } ?>
                <li id="products_print_barcodes"><a onclick="window.open('<?= site_url('products/print_barcodes'); ?>', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;" href="#"><i class="fa fa-circle-o"></i>
                    <?= lang('print_barcodes'); ?>
                  </a></li>
                <li id="products_print_labels"><a onclick="window.open('<?= site_url('products/print_labels'); ?>', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;" href="#"><i class="fa fa-circle-o"></i>
                    <?= lang('print_labels'); ?>
                  </a></li>
              </ul>
            </li>
          <?php
          }

          // CATEGORY MODULE
          if ($this->site->permission('categories')) {
          ?>
            <li class="treeview mm_categories"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('categories'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                  <?php if ($this->site->route_permission('categories_view')) {?>
                    <li id="categories_index"><a href="<?= site_url('categories'); ?>"><i class="fa fa-circle-o"></i>
                        <?= lang('list_categories'); ?>
                      </a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('categories_add')) {?>
                    <li id="categories_add"><a href="<?= site_url('categories/add'); ?>"><i class="fa fa-circle-o"></i>
                        <?= lang('add_category'); ?></a></li>
                    <li id="categories_import"><a href="<?= site_url('categories/import'); ?>"><i class="fa fa-circle-o"></i>
                        <?= lang('import_categories'); ?></a></li>
                  <?php } ?>
                <li id="categories_index"><a href="<?= site_url('categories/available_cat'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Available Cat Qty'); ?>
                  </a></li>

              </ul>
            </li>
          <?php
          }

          // BRANDS MODULE
          if ($this->site->permission('brands')) {
          ?>
            <li class="treeview mm_brands"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('Brands'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                  <?php if ($this->site->route_permission('brands_view')) {?>
                    <li id="brands_index"><a href="<?= site_url('brands'); ?>"><i class="fa fa-circle-o"></i>
                        <?= lang('List_Brands'); ?>
                      </a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('brands_add')) {?>
                    <li id="brands_add"><a href="<?= site_url('brands/add'); ?>"><i class="fa fa-circle-o"></i>
                        <?= lang('Add_Brands'); ?></a></li>
                  <?php } ?>
              </ul>
            </li>
          <?php
          }

          // SALES MODULE
          if ($this->site->permission('sales') && $this->site->route_permission('sales_view')) {
          ?>
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
          <?php
          }

          // SALERETURN MODULE
          if ($this->site->permission('salereturn')) {
          ?>
            <li class="treeview mm_salereturn"> <a href="#"> <i class="fa fa-shopping-cart"></i> <span>
                  <?= lang('Sales_Return'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                  <?php if ($this->site->route_permission('salereturn_view')) {?>
                    <li id="sales_index"><a href="<?= site_url('salereturn_view'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('list_sales_return'); ?></a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('salereturn_add')) {?>
                    <li id="sales_opened"><a href="javascript:;" onClick="salereturnPage('return')"><i class="fa fa-circle-o"></i> Add sales return</a></li>
                  <?php } ?>
              </ul>
            </li>
          <?php
          }

          // PURCHASES MODULE
          if ($this->site->permission('purchases')) {
          ?>
            <li class="treeview mm_purchases"> <a href="#"> <i class="fa fa-plus"></i> <span>
                  <?= lang('Product purchases'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                  <?php if ($this->site->route_permission('purchases_view')) {?>
                    <li id="purchases_today"><a href="<?= site_url('purchases/today'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Today\'s Purchases'); ?></a></li>
                    <li id="purchases_index"><a href="<?= site_url('purchases'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('list_purchases'); ?></a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('purchases_add')) {?>
                    <li id="purchases_add"><a href="<?= site_url('purchases/add'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('add_purchase'); ?></a></li>
                  <?php } ?>
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // TRANSFERS MODULE
          /* if ($this->site->permission('transfers')) {
          ?>
            <li class="treeview mm_transfers"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('Transfers'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <li id="transfers_index"><a href="<?= site_url('transfers'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Transfers'); ?>
                  </a></li>
                <li id="transfers_add"><a href="javascript:;" onClick="productsTransfer()"><i class="fa fa-circle-o"></i> Add Transfers</a></li>
              </ul>
            </li>
          <?php
          } */

          // SUPPLIERPAYMENT MODULE
          if ($this->site->permission('supplierpayment')) {
          ?>
            <li class="treeview mm_supplierpayment"> <a href="#"><i class="fa fa-user" aria-hidden="true"></i><span>
                  <?= lang('Supplier\'s payments'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('supplierpayment_add')) {?>
                  <li id="supplierpayment_payment"><a href="<?= site_url('supplierpayment/purchase_payment'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Add Payments'); ?></a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('supplierpayment_view')) {?>
                  <li id="supplierpayment_paymentList"><a href="<?= site_url('supplierpayment/paymentList'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Payments list'); ?></a></li>
                <?php } ?>
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // EXPENSES MODULE
          if ($this->site->permission('expenses')) {
          ?>
            <li class="treeview mm_expenses"> <a href="#"><i class="fa fa-delicious" aria-hidden="true"></i><span>
                  <?= lang('Expenses'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('expenses_add')) {?>
                  <li id="expenses_add_category"><a href="<?= site_url('expenses/add_category'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Add category'); ?></a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('expenses_view')) {?>
                  <li id="expenses_listcategory"><a href="<?= site_url('expenses/listcategory'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Category list'); ?></a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('expenses_add')) {?>
                  <li id="expenses_add_expense"><a href="<?= site_url('expenses/add_expense'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('add_expense'); ?>
                  </a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('expenses_view')) {?>
                  <li id="expenses_index"><a href="<?= site_url('expenses'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('list_expenses'); ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php
          }

          // COLLECTION MODULE
          if ($this->site->permission('collection')) {
          ?>

            <li class="treeview mm_collection"> <a href="#"><i class="fa fa-reply" aria-hidden="true"></i> <span>
                  <?= lang('Collections'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('collection_view')) {?>
                  <li id="collection_index"><a href="<?= site_url('collection'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Collections list'); ?>
                  </a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('collection_add')) {?>
                  <li id="collection_collectionpayment"><a href="<?= site_url('collection/collectionpayment'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('Add Collections'); ?></a></li>
                <?php } ?>            
              </ul>
            </li>
          <?php
          }


          // REPORTS MODULE
          if ($this->site->permission('reports')) {
          ?>
            <li class="treeview mm_reports"> <a href="#"> <i class="fa fa-bar-chart-o"></i> <span>
                  <?= lang('reports'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('reports_view')) {?>
                  <li id="reports_daily_statement"><a href="<?= site_url('reports/daily_statement'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('Daily Statement'); ?>
                    </a></li>
                  <li id="reports_todayhighlight"><a href="<?= site_url('reports/todayhighlight'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('Today\'s Highlights'); ?>
                    </a></li>
                  <li id="reports_payablelist"><a href="<?= site_url('reports/payablelist'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('Account Payable'); ?></a></li>
                  <li id="reports_receivablelist"><a href="<?= site_url('reports/receivablelist'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('Acount Receivable'); ?>
                    </a></li>
                  <li id="reports_daily_sales"><a href="<?= site_url('reports/daily_sales'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('daily_sales'); ?>
                    </a></li>
                  <li id="reports_index"><a href="<?= site_url('reports'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('sales_report'); ?>
                    </a></li>
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
                  <li id="reports_productquery"><a href="<?= site_url('reports/productQuery'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('Product Query'); ?>
                    </a></li>
                  <li id="reports_products_staff"><a href="<?= site_url('reports/products_staff'); ?>"><i class="fa fa-circle-o"> </i>Products list (Staff) </a></li>
                  <li id="reports_products_all"><a href="<?= site_url('reports/products_all'); ?>"><i class="fa fa-circle-o"> </i>Products list (All) </a></li>
                  <li id="reports_product_stock"><a href="<?= site_url('reports/product_stock'); ?>"><i class="fa fa-circle-o"> </i>Products Stock </a></li>
                  <li id="reports_store_product_stock"><a href="<?= site_url('reports/store_product_stock'); ?>"><i class="fa fa-circle-o"> </i>Store Stock Product </a></li>
                  <li id="reports_invoiceprofit"><a href="<?= site_url('reports/invoiceProfit'); ?>"><i class="fa fa-circle-o"> </i>Invoice Profit</a></li>
                  <li id="reports_salaryreport"><a href="<?= site_url('reports/salaryReport'); ?>"><i class="fa fa-circle-o"> </i>Salary Report</a></li>
                  <li id="reports_expenses_rpt"><a href="<?= site_url('reports/expenses_rpt'); ?>"><i class="fa fa-circle-o"> </i>Expenses Report</a></li>
                  <li id="reports_credit_collection_rpt"><a href="<?= site_url('reports/credit_collection_rpt'); ?>"><i class="fa fa-circle-o"> </i>Credit Collection</a></li>
                  <li id="reports_aging_rpt"><a href="<?= site_url('reports/aging_rpt'); ?>"><i class="fa fa-circle-o"> </i>Aging Report</a></li>
  
                  <li id="reports_bank_balance"><a href="<?= site_url('reports/bank_balance'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('Bank Balance'); ?>
                    </a></li>
                <?php } ?>
              </ul>
            </li>
          <?php
          }


          // BANK MODULE
          if ($this->site->permission('bank')) {
          ?>
            <li class="treeview mm_bank"> <a href="#"><i class="fa fa-university" aria-hidden="true"></i>
                <span>Bank Account</span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('bank_view')) {?>
                  <li id="bank_index"><a href="<?= site_url('bank'); ?>"><i class="fa fa-circle-o"></i>List Bank Account</a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('bank_add')) {?>
                  <li id="bank_add"><a href="<?= site_url('bank/add'); ?>"><i class="fa fa-circle-o"></i>New Bank Account</a></li>
                <?php } ?>
                <li id="bank_pendingCheque"><a href="<?= site_url('bank/pendingCheque'); ?>"><i class="fa fa-circle-o"></i>Peding Cheque</a></li>
                <li id="bank_approved_cheque"><a href="<?= site_url('bank/approved_cheque'); ?>"><i class="fa fa-circle-o"></i>Approved Cheque</a> </li>
              </ul>
            </li>
          <?php
          }

          // People MODULE
          if ($this->site->permission('user') || $this->site->permission('employee') || $this->site->permission('customers') || $this->site->permission('suppliers')) {
          ?>
            <li class="treeview mm_auth mm_customers mm_suppliers"> <a href="#"> <i class="fa fa-users"></i> <span>
                  <?= lang('people'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php
                if ($this->site->permission('user')) {
                ?>
                  <?php if ($this->site->route_permission('user_view')) {?>
                    <li id="auth_users"><a href="<?= site_url('users'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_users'); ?></a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('user_add')) {?>
                    <li id="auth_add"><a href="<?= site_url('users/add'); ?>"><i class="fa fa-circle-o"></i><?= lang('add_user'); ?></a></li>
                  <?php } ?>
                <?php
                }
                if ($this->site->permission('employee')) {
                ?>
                  <li class="divider"></li>
                  <?php if ($this->site->route_permission('employee_view')) {?>
                    <li id="auth_users"><a href="<?= site_url('employee'); ?>"><i class="fa fa-circle-o"></i> List Employee</a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('employee_add')) {?>
                    <li id="auth_add"><a href="<?= site_url('employee/add'); ?>"><i class="fa fa-circle-o"></i> Add Employee </a></li>
                  <?php } ?>
                <?php
                }
                if ($this->site->permission('customers')) {
                ?>
                  <li class="divider"></li>
                  <?php if ($this->site->route_permission('customers_view')) {?>
                    <li id="customers_index"><a href="<?= site_url('customers'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_customers'); ?></a></li>
                  <?php } ?>
                  <?php if ($this->site->route_permission('customers_add')) {?>
                    <li id="customers_add"><a href="<?= site_url('customers/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_customer'); ?> </a></li>
                  <?php } ?>                  
                <?php
                }
                if ($this->site->permission('suppliers')) {
                ?>
                  <li class="divider"></li>
                  <?php if ($this->site->route_permission('suppliers_view')) {?>
                    <li id="suppliers_index"><a href="<?= site_url('suppliers'); ?>"><i class="fa fa-circle-o"></i> <?= lang('list_suppliers'); ?> </a></li>
                  <?php } ?>   
                  <?php if ($this->site->route_permission('suppliers_add')) {?>
                    <li id="suppliers_add"><a href="<?= site_url('suppliers/add'); ?>"><i class="fa fa-circle-o"></i>
                      <?= lang('add_supplier'); ?> </a></li>
                  <?php } ?>                   
                  
                <?php
                }
                ?>
              </ul>
            </li>
          <?php
          }

          // STORE MODULE
          if ($this->site->permission('store')) {
          ?>
            <li class="treeview mm_store"> <a href="#"> <i class="fa fa-sitemap"></i> <span>
                  <?= lang('Stores'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('store_view')) {?>
                  <li id="store_index"><a href="<?= site_url('store'); ?>"><i class="fa fa-circle-o"></i><?= lang('Stores'); ?> </a></li>
                <?php } ?>  
                <?php if ($this->site->route_permission('store_add')) {?>
                  <li id="store_add"><a href="<?= site_url('store/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('Add Store'); ?></a></li>
                <?php } ?>  
                
              </ul>
            </li>
          <?php
          }
          
          // GROUP MODULE
          if ($this->site->permission('group')) {
          ?>
            <li class="treeview mm_group"> <a href="#"> <i class="fa fa-sitemap"></i> <span>
                  <?= lang('group'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                  <?php if ($this->site->route_permission('group_view')) {?>
                    <li id="group_index"><a href="<?= site_url('group'); ?>"><i class="fa fa-circle-o"></i> <?= lang('group_list'); ?></a></li>
                  <?php } ?> 
                  <?php if ($this->site->route_permission('group_add')) {?>
                    <li id="group_add"><a href="<?= site_url('group/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_group'); ?></a></li>
                  <?php } ?> 
              </ul>
            </li>
          <?php
          }

          // PERMISSION MODULE
          if ($this->site->permission('permission') && $this->site->route_permission('permission_view')) {
          ?>
            <li class="mm_permission"><a href="<?= site_url('permission'); ?>"><i class="fa fa-th"></i> <span><?= lang('permission'); ?></span></a></li>
          <?php
          }

          // SETTINGS MODULE
          if ($this->site->permission('settings') && $this->site->route_permission('settings_view')) {
          ?>
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
          ?>

          <li class="divider2"></li>
          <li style="background:#001B35;"><a href=""><span class="border border-success"><b><?= lang('MANUFACTURE'); ?></b></span></a></li>
          <li class="divider2"></li>

          <?php
          // mf_categories MODULE
          if ($this->site->permission('mf_categories')) {
          ?>
            <li class="treeview mm_mf_categories"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('raw_material_category'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_categories_view')) {?>
                  <li id="mf_categories_index"><a href="<?= site_url('mf_categories'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_categories'); ?></a></li>
                <?php } ?> 
                <?php if ($this->site->route_permission('mf_categories_add')) {?>
                  <li id="mf_categories_add"><a href="<?= site_url('mf_categories/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_category'); ?></a></li>
                  <li id="mf_categories_import"><a href="<?= site_url('mf_categories/import'); ?>"><i class="fa fa-circle-o"></i> <?= lang('import_categories'); ?> </a></li>
                <?php } ?> 
              </ul>
            </li>
          <?php
          }

          // UNIT MODULE
          if ($this->site->permission('mf_unit')) {
          ?>
            <li class="treeview mm_mf_unit"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('uom'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_unit_view')) {?>
                  <li id="mf_unit_index"><a href="<?= site_url('mf_unit'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_uom'); ?></a></li>
                <?php } ?> 
                <?php if ($this->site->route_permission('mf_unit_add')) {?>
                  <li id="mf_unit_add"><a href="<?= site_url('mf_unit/add'); ?>"><i class="fa fa-circle-o"></i><?= lang('add_uom'); ?></a></li>
                <?php } ?>              
              </ul>
            </li>
          <?php
          }

          // mf_material MODULE
          if ($this->site->permission('mf_material')) {
          ?>
            <li class="treeview mm_mf_material"> <a href="#"> <i class="fa fa-barcode"></i> <span>
                  <?= lang('raw_material'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_material_view')) {?>
                  <li id="mf_material_index"><a href="<?= site_url('mf_material'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_material'); ?></a></li>
                <?php } ?> 
                <?php if ($this->site->route_permission('mf_material_add')) {?>
                  <li id="mf_material_add"><a href="<?= site_url('mf_material/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_material'); ?> </a></li>
                <?php } ?>              
              </ul>
            </li>
          <?php
          }

          // mf_brands MODULE
          if ($this->site->permission('mf_brands')) {
          ?>
            <li class="treeview mm_mf_brands"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('Raw Material Brands'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_brands_view')) {?>
                  <li id="mf_brands_index"><a href="<?= site_url('mf_brands'); ?>"><i class="fa fa-circle-o"></i><?= lang('List_Brands'); ?></a></li>
                <?php } ?>   
                <?php if ($this->site->route_permission('mf_brands_add')) {?>
                  <li id="mf_brands_add"><a href="<?= site_url('mf_brands/add'); ?>"><i class="fa fa-circle-o"></i><?= lang('Add_Brands'); ?></a></li>
                <?php } ?>
              </ul>
            </li>
          <?php
          }

          // mf_suppliers MODULE
          if ($this->site->permission('mf_suppliers')) {
          ?>
            <li class="treeview mm_mf_suppliers"> <a href="#"> <i class="fa fa-users"></i> <span>
                  <?= lang('raw_material_supplier'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_suppliers_view')) {?>
                  <li id="mf_suppliers_index"><a href="<?= site_url('mf_suppliers'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_supplier'); ?></a></li>
                <?php } ?>
                <?php if ($this->site->route_permission('mf_suppliers_add')) {?>
                  <li id="mf_suppliers_add"><a href="<?= site_url('mf_suppliers/add'); ?>"><i class="fa fa-circle-o"></i>
                    <?= lang('add_supplier'); ?>
                  </a></li>
                <?php } ?>               
                
              </ul>
            </li>
          <?php
          }

          // mf_purchases MODULE
          if ($this->site->permission('mf_purchases')) {
          ?>
            <li class="treeview mm_mf_purchases"> <a href="#"> <i class="fa fa-plus"></i> <span>
                  <?= lang('Raw Material Purchases'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_purchases_view')) {?>
                  <li id="mf_purchases_index"><a href="<?= site_url('mf_purchases'); ?>"><i class="fa fa-circle-o"></i><?= lang('list_purchases'); ?></a></li>
                <?php } ?>  
                <?php if ($this->site->route_permission('mf_purchases_add')) {?>
                  <li id="mf_purchases_add"><a href="<?= site_url('mf_purchases/add'); ?>"><i class="fa fa-circle-o"></i> <?= lang('add_purchase'); ?></a> </li>
                <?php } ?>  
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // mf_material_stock MODULE
          if ($this->site->permission('mf_material_stock')) {
          ?>
            <li class="treeview mm_mf_material_stock"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('Raw Material Stock'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_material_stock_view')) {?>
                  <li id="mf_material_stock_index"><a href="<?= site_url('mf_material_stock'); ?>"><i class="fa fa-circle-o"></i> <?= lang('stock_list'); ?></a></li>
                <?php } ?>  
                <?php if ($this->site->route_permission('mf_material_stock_add')) {?>
                  <li id="mf_material_stock_stock_adjust"><a href="<?= site_url('mf_material_stock/stock_adjust'); ?>"><i class="fa fa-circle-o"></i><?= lang('stock_adjust'); ?></a></li>
                <?php } ?>  
                <?php if ($this->site->route_permission('mf_material_stock_view')) {?>
                  <li id="mf_material_stock_adjust_log_list"><a href="<?= site_url('mf_material_stock/adjust_log_list'); ?>"><i class="fa fa-circle-o"></i><?= lang('adjust_log'); ?></a></li>
                <?php } ?>  
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // mf_recipe MODULE
          if ($this->site->permission('mf_recipe')) {
          ?>
            <li class="treeview mm_mf_recipe"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('recipe'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_recipe_view')) {?>
                  <li id="mf_recipe_index"><a href="<?= site_url('mf_recipe'); ?>"><i class="fa fa-circle-o"></i><?= lang('recipe_list'); ?></a></li>
                <?php } ?>  
                <?php if ($this->site->route_permission('mf_recipe_add')) {?>
                  <li id="mf_recipe_add"><a href="<?= site_url('mf_recipe/add'); ?>"><i class="fa fa-circle-o"></i><?= lang('add_recipe'); ?></a></li>
                <?php } ?>  
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // Production MODULE
          if ($this->site->permission('mf_production')) {
          ?>
            <li class="treeview mm_mf_production"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('production'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_production_view')) {?>
                  <li id="mf_production_index"><a href="<?= site_url('mf_production'); ?>"><i class="fa fa-circle-o"></i><?= lang('production_list'); ?></a></li>
                <?php } ?>  
                <?php if ($this->site->route_permission('mf_production_add')) {?>
                  <li id="mf_production_add"><a href="<?= site_url('mf_production/add'); ?>"><i class="fa fa-circle-o"></i><?= lang('add_production'); ?></a></li>
                <?php } ?>  
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // Finish Good Stock MODULE
          if ($this->site->permission('mf_finish_good_stock')) {
          ?>
            <li class="treeview mm_mf_finish_good_stock"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('finish_good_stock'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_finish_good_stock_view')) {?>
                  <li id="mf_finish_good_stock_index"><a href="<?= site_url('mf_finish_good_stock'); ?>"><i class="fa fa-circle-o"></i><?= lang('stock_list'); ?></a></li>
                  <!-- <li id="mf_finish_good_stock_stock_adjust"><a href="<?= site_url('mf_finish_good_stock/stock_adjust'); ?>"><i class="fa fa-circle-o"></i><?= lang('stock_adjust'); ?></a></li>
                  <li id="mf_finish_good_stock_adjust_log_list"><a href="<?= site_url('mf_finish_good_stock/adjust_log_list'); ?>"><i class="fa fa-circle-o"></i><?= lang('adjust_log'); ?></a></li> -->
                <?php } ?>   
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          // Manufacture Report MODULE
          if ($this->site->permission('mf_report')) {
          ?>
            <li class="treeview mm_mf_report"> <a href="#"> <i class="fa fa-folder"></i> <span>
                  <?= lang('mf_report'); ?>
                </span> <i class="fa fa-angle-left pull-right"></i> </a>
              <ul class="treeview-menu">
                <?php if ($this->site->route_permission('mf_report_view')) {?>
                  <li id="mf_report_raw_material"><a href="<?= site_url('mf_report/raw_material'); ?>"><i class="fa fa-circle-o"></i>Raw Material Report</a></li>

                  <li id="mf_report_raw_material_purchase"><a href="<?= site_url('mf_report/raw_material_purchase'); ?>"><i class="fa fa-circle-o"></i>Raw Material Purchase Report</a></li>

                  <li id="mf_report_raw_material_stock"><a href="<?= site_url('mf_report/raw_material_stock'); ?>"><i class="fa fa-circle-o"></i>Raw Material Stock Report</a></li>
                <?php } ?>   
                <li class="divider"></li>
              </ul>
            </li>
          <?php
          }

          ?>

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
        <?php if ($error) { ?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-ban"></i>
              <?= lang('error'); ?>
            </h4>
            <?= $error; ?>
          </div>
        <?php }
        if ($warning) { ?>
          <div class="alert alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4><i class="icon fa fa-warning"></i>
              <?= lang('warning'); ?>
            </h4>
            <?= $warning; ?>
          </div>
        <?php }
        if ($message) { ?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4> <i class="icon fa fa-check"></i>
              <?= lang('Success'); ?>
            </h4>
            <?= $message; ?>
          </div>
        <?php } ?>
      </div>