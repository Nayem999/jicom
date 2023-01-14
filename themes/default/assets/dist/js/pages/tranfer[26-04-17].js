    
    $(document).ready(function() {
        
        var trnsid = '';
        loadItems(trnsid);
        $("#date").inputmask("yyyy-mm-dd hh:mm", {"placeholder": "yyyy-mm-dd hh:mm"});
        $("#add_item").autocomplete({
            source: base_url+'transfers/suggestions',
            minLength: 1,
            autoFocus: false,
            delay: 200,
            response: function (event, ui) {
                if ($(this).val().length >= 16 && ui.content[0].id == 0) {
                    bootbox.alert(lang.no_match_found, function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
                else if (ui.content.length == 1 && ui.content[0].id != 0) {
                    ui.item = ui.content[0];
                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                }
                else if (ui.content.length == 1 && ui.content[0].id == 0) {
                    bootbox.alert(lang.no_match_found, function () {
                        $('#add_item').focus();
                    });
                    $(this).val('');
                }
            },
            select: function (event, ui) {
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

        $('#add_item').bind('keypress', function (e) {
            if( $('#to-warehouse').val()==''){
                alert('to warehouse not select');
                e.preventDefault();
            }
            if (e.keyCode == 13) {
                e.preventDefault();
                $(this).autocomplete("search");
            }
        });

        $('#add_item').focus();
        $('#reset').click(function (e) {
            bootbox.confirm(lang.r_u_sure, function (result) {
                if (result) {
                    if (get('tspoitems')) {
                        remove('tspoitems');
                    }

                    window.location.reload();
                }
            });
        });

        $(document).on("change", '.rquantity', function () {
            var row = $(this).closest('tr');
            var new_qty = parseFloat($(this).val()); 
            item_id = row.attr('data-item-id');
            tspoitems[item_id].row.qty = new_qty;
            store('tspoitems', JSON.stringify(tspoitems));
            trnsid = '';
            loadItems(trnsid);
        }); 

        $(document).on("change", '.rcost', function () {
            var row = $(this).closest('tr');
            var new_cost = parseFloat($(this).val()),

            item_id = row.attr('data-item-id');
            tspoitems[item_id].row.cost = new_cost;
            store('tspoitems', JSON.stringify(tspoitems));
            trnsid = '';
            loadItems(trnsid);
        });

    });

function loadItems(trnsid) {
 
    if (get('tspoitems')) {
        total = 0;
        tqty = 0;

        $("#transferTable tbody").empty();

        tspoitems = JSON.parse(get('tspoitems'));
        
        //console.log(spoitems);
        
        $.each(tspoitems, function () {

            var item = this;
            
            //alert(item);
            var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
            tspoitems[item_id] = item;

            var product_id = item.row.id, sqtrans = item.row.sqtrans, item_cost = item.row.cost, item_qty = item.row.qty, sqtrans = item.row.sqtrans, item_code = item.row.code,
            item_name = item.row.name.replace(/"/g, "&#034;").replace(/'/g, "&#039;");

            var row_no = (new Date).getTime();
            //var sequence = $('#sequence').val();

            var sqetitle = 'PR'; 
            if(trnsid!='' && trnsid==item_id)
            var newTr = $('<tr id="' + row_no + '" class="' + item_id + ' newprrow" data-item-id="' + item_id + '"></tr>');
            else
            var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
            tr_html = '<td style="min-width:100px;"><input name="product_id[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' (' + item_code + ')</span>';
            tr_html += '<input name="getsequence[]" type="hidden" class="rid" value="'+sqtrans+'" id="getsequence-'+row_no+'"></td>';
            tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad text-center rquantity" name="quantity[]" type="text" value="' + item_qty + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
            tr_html += '<td style="padding:2px; min-width:80px;"><input class="form-control input-sm kb-pad text-center rcost" name="cost[]" type="text" value="' + item_cost + '" data-id="' + row_no + '" data-item="' + item_id + '" id="cost_' + row_no + '" onClick="this.select();" readonly></td>';
            tr_html += '<td class="text-right"><input type="hidden" name="sqtrans[]" id="proSqOut'+row_no+'" value="'+sqtrans+'" class="form-control input-sm kb-pad text-center psquence"><a href="javascript:;"><span id="sqout-'+row_no+'"></span><span onClick="sqTransfer(' + parseFloat(row_no) + ',' + item_id + ',' + item_qty +')" ><i class="fa fa-2x fa-plus-circle" id="addIcon"></i></span></a></td>';
            tr_html += '<td class="text-right"><span class="text-right ssubtotal" id="subtotal_' + row_no + '">' + formatMoney(parseFloat(item_cost) * parseFloat(item_qty)) + '</span></td>';
            tr_html += '<td class="text-center"><a href="javascript:;" onClick="pRemove(' + parseFloat(row_no) + ',' + item_id + ',' + item_qty +')" class=""><i class="fa fa-trash-o tip pointer spodel"><i></a></td>';
            newTr.html(tr_html);
            newTr.prependTo("#transferTable");
            total += (parseFloat(item_cost) * parseFloat(item_qty));
            tqty += parseFloat(item_qty);
            
        });

        grand_total = formatMoney(total);       
        $("#gtotal").text(grand_total);
        $("#prqty").text(tqty);
        $('#add_item').focus();
    }
}

function add_order_item(item) { 
    var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
    
    if (tspoitems[item_id]) {
        tspoitems[item_id].row.qty = parseFloat(tspoitems[item_id].row.qty) + 1;
    } else {
        tspoitems[item_id] = item;
         tspoitems[item_id].row.sqtrans ='';
    }

    store('tspoitems', JSON.stringify(tspoitems));

    loadItems(item_id);
    return true;
}
function pRemove(id,arindexid, pqtyval) {
    //console.log(spoitems);
    
    //alert(pqtyval);
    
    var curqty = $("#prqty").text();
    curqty = curqty - pqtyval;
    
    $("#prqty").text(curqty);
    //alert($('#subtotal_'+id).text());
    //alert($('#gtotal').text());
    //spoitems.splice(2,1);
    $.removeElementFromCollection(tspoitems, arindexid);
    var subtotal = $('#subtotal_'+id).text();
    subtotal = subtotal.split(',').join('');
    //
    //$('#subtotal_'+id).text().replace(",", "");
    var gtotal = $('#gtotal').text();
    gtotal = gtotal.split(',').join('');
    
    //alert(parseFloat(gtotal));
    //alert(parseFloat(subtotal));
    
    var total = formatMoney((parseFloat(gtotal) - parseFloat(subtotal))) ;
    //alert(total);
    $("#"+id).remove();
    $('#gtotal').html(total); 
    
    //console.log(spoitems);
    
    // prid = '';
//   loadItems(prid);
}

(function($, global, undefined) {
    $.removeElementFromCollection = function(collection,key) {
        // if the collections is an array
        if(collection instanceof Array) {
            // use jquery's `inArray` method because ie8 
            // doesn't support the `indexOf` method
            if($.inArray(key, collection) != -1) {
                collection.splice($.inArray(key, collection), 1);
            }
        }
        // it's an object
        else if(collection.hasOwnProperty(key)) {
            delete collection[key];
        }

        return collection;
    };
})(jQuery, window); 