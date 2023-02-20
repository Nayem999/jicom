<?php (defined('BASEPATH')) or exit('No direct script access allowed'); ?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <title>
    <?= $page_title . ' | ' . $Settings->site_name; ?>
  </title>
  <link rel="shortcut icon" href="<?= $assets ?>img/icon.png" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href="<?= $assets ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= $assets ?>plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="<?= $assets ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
    body {
      background-color: #ecf0f5;
    }

    .table th {
      text-align: center;
    }

    .inv-logo {
      text-align: center;
    }

    .inv-logo img {
      width: 100%;
    }
  </style>
</head>

<body>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- <h1>
            <?= $Settings->site_name == 'SimplePOS' ? 'Simple<b>POS</b>' : '<img src="' . $assets . '/images/icon.png" alt="' . $Settings->site_name . '" />'; ?>
          </h1> -->
        <div class="inv-logo">
          <img src="<?= base_url('themes/default/assets/images/chalan.png') ?>" height="200px;" alt="<?= $Settings->site_name ?>" />
        </div>
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">
              <strong><?= 'Recipe # ' . $recipe_mst->id; ?></strong>
            </h3>
          </div>
          <div class="box-body">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td class="col-xs-2"><strong>Name</strong></td>
                          <td class="col-xs-4"><?= $recipe_mst->recipe_name; ?></td>
                          <td class="col-xs-2"><strong>Code</strong></td>
                          <td class="col-xs-4"><?= $recipe_mst->code; ?></td>
                        </tr>
                        <tr>
                          <td class="col-xs-2"><strong>Product</strong></td>
                          <td class="col-xs-4"><?= $recipe_mst->products_name; ?></td>
                          <td class="col-xs-2"><strong>UOM</strong></td>
                          <td class="col-xs-4"><?= $recipe_mst->uom_name; ?></td>
                        </tr>
                        <tr>
                          <td class="col-xs-2"><strong>Description</strong></td>
                          <td class="col-xs-4"><?= $recipe_mst->description; ?></td>
                          <td class="col-xs-2"><strong><?= lang('date'); ?></strong></td>
                          <td class="col-xs-4"><?= $this->tec->hrld($recipe_mst->created_at); ?></td>
                        </tr>
        
                      </tbody>
                    </table>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="active">
                            <th>Raw Material</th>
                            <th class="col-xs-5">Brand</th>
                            <th class="col-xs-2">Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          if ($recipe_dtls) {

                            foreach ($recipe_dtls as $item) {
                              echo '<tr>';

                              echo '<td class="text-center">' . $item->material_name . '</td>';

                              echo '<td class="text-center">' . $item->brand_name . '</td>';

                              echo '<td class="text-center">' . $item->qty .' '. $item->uom_name . '</td>';

                              echo '</tr>';
                            }
                          }

                          ?>
                        </tbody>

                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>