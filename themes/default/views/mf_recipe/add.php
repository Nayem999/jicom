<?php (defined('BASEPATH')) or exit('No direct script access allowed'); ?>

<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header">

                    <h3 class="box-title"><?= lang('enter_info'); ?></h3>

                </div>

                <div class="box-body">

                    <div class="col-lg-12">

                        <?php echo form_open_multipart("mf_recipe/add"); ?>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang('recipe_code', 'recipe_code'); ?>
                                    <?= form_input('code_name', set_value('code_name', $code_name), 'class="form-control tip" id="code_name"  required="required" readonly'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang('recipe_name', 'recipe_name'); ?>
                                    <?= form_input('recipe_name', set_value('recipe_name'), 'class="form-control tip" id="recipe_name" required="required"'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang('For Product', 'For Product'); ?>
                                    <?php
                                    $pr[''] = lang("Select") . " " . lang("Product");
                                    foreach ($all_product as $all_product_arr) {
                                        $pr[$all_product_arr->id] = $all_product_arr->name;
                                    }
                                    ?>
                                    <?= form_dropdown('product_id', $pr, set_value('product_id'), 'class="form-control select2 tip" required="required" id="product_id" style="width:100%;"'); ?>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= lang('uom', 'uom'); ?>
                                    <?php
                                    $ur[''] = lang("Select") . " " . lang("Unit");
                                    foreach ($all_uom as $all_uom_arr) {
                                        $ur[$all_uom_arr->id] = $all_uom_arr->name;
                                    }
                                    ?>
                                    <?= form_dropdown('uom_id', $ur, set_value('uom_id'), 'class="form-control select2 tip" required="required" id="uom_id" style="width:100%;"'); ?>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <?= lang('description', 'description'); ?>
                                    <?= form_input('description', set_value('description'), 'class="form-control tip" id="description"'); ?>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">

                            <input type="text" placeholder="<?= lang('search_product_by_name_code'); ?>" autocomplete="add_item" id="add_item" class="form-control">

                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="poTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="active">
                                                <th class="col-xs-4"><?= lang('product'); ?></th>
                                                <th class="col-xs-3">Brand</th>
                                                <th class="col-xs-2">UOM</th>
                                                <th class="col-xs-2"><?= lang('quantity'); ?></th>
                                                <th style="width:20px;"><i class="fa fa-trash-o"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="8"><?= lang('add_product_by_searching_above_field'); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <div class="form-group">
                            <?= form_submit('add_recipe', lang('add_recipe'), 'class="btn btn-primary" id="add_recipe"'); ?>
                            <button type="button" id="reset" class="btn btn-danger sqcount"><?= lang('reset'); ?></button>
                        </div>

                        <?php echo form_close(); ?>

                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>

</section>



<script src="<?= $assets ?>dist/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?= $assets ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<style type="text/css">
    .red-btu {
        color: red;
    }
</style>
<script type="text/javascript">
    var recipe_items = {};

    var lang = new Array();
    // console.log(recipe_items);

    lang['code_error'] = '<?= lang('code_error'); ?>';
    lang['r_u_sure'] = '<?= lang('r_u_sure'); ?>';
    lang['no_match_found'] = '<?= lang('no_match_found'); ?>';
</script>

<script>
    $(document).ready(function() {

        var prid = '';
        load_recipe_items(prid);

        $("#add_item").autocomplete({
            source: base_url + 'mf_recipe/suggestions',
            minLength: 1,
            autoFocus: false,
            delay: 200,
            response: function(event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert(lang.no_match_found, function() {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                } else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                } else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert(lang.no_match_found, function() {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
            },
            select: function(event, ui) {
                event.preventDefault();
                if (ui.item.id !== 0) {
                    var row = add_order_item(ui.item);
                    if (row)
                        $(this).val('');
                } else {
                    bootbox.alert(lang.no_match_found);
                }
            }
        });

        $('#add_item').bind('keypress', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                $(this).autocomplete("search");
            }
        });

        $('#add_item').focus();
        $('#reset').click(function(e) {
            bootbox.confirm(lang.r_u_sure, function(result) {
                if (result) {
                    if (get('recipe_items')) {
                        remove('recipe_items');
                    }
                    window.location.reload();
                }
            });
        });

    });

    function load_recipe_items(prid) {

        if (get('recipe_items')) {


            $("#poTable tbody").empty();

            recipe_items = JSON.parse(get('recipe_items'));

            console.log(recipe_items);
            // console.log(all_brand);

            $.each(recipe_items, function() {
                var item = this;

                var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
                recipe_items[item_id] = item;

                var material_id = item.row.material_id,
                    material_stock_id = item.row.material_stock_id,
                    item_qty = item.row.qty,
                    item_name = item.row.name,
                    item_brand = item.row.brand_name,
                    unit_name = item.row.unit_name.replace(/"/g, "&#034;").replace(/'/g, "&#039;");

                var row_no = (new Date).getTime();

                if (prid != '' && prid == item_id)
                    var newTr = $('<tr id="' + row_no + '" class="' + item_id + ' newprrow" data-item-id="' + item_id + '"></tr>');
                else
                    var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');

                tr_html = '<td style="min-width:100px;"><input name="material_id[]" type="hidden" class="rid" value="' + material_id + '"><input name="material_stock_id[]" type="hidden" class="rid" value="' + material_stock_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' </span>';

                if (item_brand != null) {
                    tr_html += '<td style="padding:2px;">' + item_brand + '</td>';
                } else {
                    tr_html += '<td></td>';
                }
                if (unit_name != null) {
                    tr_html += '<td style="padding:2px;">' + unit_name + '</td>';
                } else {
                    tr_html += '<td></td>';
                }

                tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad text-center rquantity" name="quantity[]" type="text" value="' + item_qty + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" ></td>';

                tr_html += '<td class="text-center"><a href="javascript:;" onClick="pRemove(' + parseFloat(row_no) + ',' + material_stock_id + ')" class=""><i class="fa fa-trash-o tip pointer spodel"><i></a></td>';
                newTr.html(tr_html);
                newTr.prependTo("#poTable");

            });

            $('#add_item').focus();

        }
    }

    function add_order_item(item) {
        var item_id = Settings.item_addition == 1 ? item.item_id : item.material_stock_id;

        if (recipe_items[item_id]) {
            recipe_items[item_id].row.qty = parseFloat(recipe_items[item_id].row.qty) + 1;
            //recipe_items[item_id].row.set = 'dd';
        } else {
            recipe_items[item_id] = item;
            recipe_items[item_id].row.qty = 0;
        }

        store('recipe_items', JSON.stringify(recipe_items));
        load_recipe_items(item_id);
        return true;
    }

    function pRemove(id, prd_id) {
        //console.log(recipe_items);
        $("#" + id).remove();

        recipe_items.splice(index, prd_id);
        store('recipe_items', JSON.stringify(recipe_items));
        load_recipe_items(prid);
    }
</script>