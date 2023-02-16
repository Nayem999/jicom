    
	$(document).ready(function() {
        
		var prid = '';
        loadItems(prid);
        $("#date").inputmask("yyyy-mm-dd hh:mm", {"placeholder": "yyyy-mm-dd hh:mm"});
        $("#add_item").autocomplete({
            source: base_url+'mf_purchases/suggestions',
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
            if (e.keyCode == 13) {
                e.preventDefault();
                $(this).autocomplete("search");
            }
        });

        $('#add_item').focus();
        $('#reset').click(function (e) {
            bootbox.confirm(lang.r_u_sure, function (result) {
                if (result) {
                    if (get('mf_items')) {
                        remove('mf_items');
                    }
                    window.location.reload();
                }
            });
        });

        $(document).on("change", '.rquantity', function () {
            var row = $(this).closest('tr');
            var new_qty = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
            mf_items[item_id].row.qty = new_qty;
            store('mf_items', JSON.stringify(mf_items));
			prid = '';
            loadItems(prid);
        });

        //expiry_year
        $(document).on("change", '.rcost', function () {
            var row = $(this).closest('tr');
            var new_cost = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
            mf_items[item_id].row.cost = new_cost;
            store('mf_items', JSON.stringify(mf_items));
            prid = '';
            loadItems(prid);
        }); 
        //change_brand
        $(document).on("change", '.rbrand', function () {
            var row = $(this).closest('tr');
            var new_brand = parseFloat($(this).val()),
            item_id = row.attr('data-item-id');
            mf_items[item_id].row.brand = new_brand;
            store('mf_items', JSON.stringify(mf_items));
            prid = '';
            loadItems(prid);
        }); 

        //change_transport_cost
        $(document).on("keyup", '#transport_cost', function () {
            var transport_cost=parseFloat($("#gtotal").val())+parseFloat($(this).val());
            $("#grand_total").val(transport_cost);
        }); 

    });

var allBrand = JSON.parse(allBrand);

var brand_select='';
function loadItems(prid) {

    if (get('mf_items')) {
        total = 0;
		tqty = 0;
        console.log(allBrand)
        $("#poTable tbody").empty();

        mf_items = JSON.parse(get('mf_items'));
		
		console.log(mf_items);
	    // console.log(all_brand);

        $.each(mf_items, function () {
            var item = this;
			
            var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
            mf_items[item_id] = item;

            var product_id = item.row.id, item_cost = item.row.cost,  item_qty = item.row.qty, item_brand = item.row.brand, 
            item_name = item.row.name.replace(/"/g, "&#034;").replace(/'/g, "&#039;");

            var row_no = (new Date).getTime();

			if(prid!='' && prid==item_id)
			var newTr = $('<tr id="' + row_no + '" class="' + item_id + ' newprrow" data-item-id="' + item_id + '"></tr>');
			else
            var newTr = $('<tr id="' + row_no + '" class="' + item_id + '" data-item-id="' + item_id + '"></tr>');
            tr_html = '<td style="min-width:100px;"><input name="product_id[]" type="hidden" class="rid" value="' + product_id + '"><span class="sname" id="name_' + row_no + '">' + item_name + ' </span>';

            tr_html += '<td class="text-center"><select name="brand_id[]" id="brand_id_' + row_no + '" class="form-control rbrand" >   <option value="'+item_brand+'">Select</option>  '; 
            allBrand.map((item)=>{
                if(item_brand==item.id){ brand_select='selected' }else{ brand_select='';}
                tr_html  +='  <option value="'+item.id+'" '+brand_select+' >'+item.name+'</option> ';
            });
            tr_html  +='  </select></td>';

            tr_html += '<td style="padding:2px;"><input class="form-control input-sm kb-pad text-center rquantity" name="quantity[]" type="text" value="' + item_qty + '" data-id="' + row_no + '" data-item="' + item_id + '" id="quantity_' + row_no + '" onClick="this.select();"></td>';
        
            tr_html += '<td style="padding:2px; min-width:80px;"><input class="form-control input-sm kb-pad text-center rcost" name="cost[]" type="text" value="' + item_cost + '" data-id="' + row_no + '" data-item="' + item_id + '" id="cost_' + row_no + '" onClick="this.select();"></td>';
            tr_html += '<td class="text-right"><span class="text-right ssubtotal" id="subtotal_' + row_no + '">' + formatMoney(parseFloat(item_cost) * parseFloat(item_qty)) + '</span></td>';

            tr_html += '<td class="text-center"><a href="javascript:;" onClick="pRemove(' + parseFloat(row_no) + ',' + item_id + ',' + item_qty +',' + product_id +')" class=""><i class="fa fa-trash-o tip pointer spodel"><i></a></td>';
            newTr.html(tr_html);
            newTr.prependTo("#poTable");
            total += (parseFloat(item_cost) * parseFloat(item_qty));
			tqty += parseFloat(item_qty);
            $( '#' + row_no ).removeClass( "sequence-match" );  
            $('#add_purchase').removeAttr('disabled', true );
            $('#edit_purchase').removeAttr('disabled', true );
            
        });
 
     

        grand_total = formatMoney(total);       
        $("#gtotal").val(grand_total);
        var transport_cost=parseFloat($("#transport_cost").val())+total;
        $("#grand_total").val(transport_cost);
		$("#prqty").text(tqty);
        $('#add_item').focus();
       
    }
}

function add_order_item(item) { 
    var item_id = Settings.item_addition == 1 ? item.item_id : item.id;
	
    if (mf_items[item_id]) {
        mf_items[item_id].row.qty = parseFloat(mf_items[item_id].row.qty) + 1;
        //mf_items[item_id].row.set = 'dd';
    } else {
        mf_items[item_id] = item;
        mf_items[item_id].row.cost = 1;
        mf_items[item_id].row.qty = 1;
        mf_items[item_id].row.brand = 0;
    }

    store('mf_items', JSON.stringify(mf_items));
    loadItems(item_id);
    return true;
}

function pRemove(id,arindexid, pqtyval, prd_id) {
	//console.log(mf_items);
	
	//alert(pqtyval);
	
	var curqty = $("#prqty").text();
	curqty = curqty - pqtyval;
	
	$("#prqty").text(curqty);
	
	$.removeElementFromCollection(mf_items, arindexid);
	var subtotal = $('#subtotal_'+id).text();
	subtotal = subtotal.split(',').join('');

	var gtotal = $('#gtotal').text();
	gtotal = gtotal.split(',').join('');
	
	var total = formatMoney((parseFloat(gtotal) - parseFloat(subtotal))) ;
	//alert(total);
	$("#"+id).remove();
	$('#gtotal').html(total); 

    mf_items.splice(index, prd_id);
    store('mf_items', JSON.stringify(mf_items));
    loadItems(prid);
	
	// console.log(mf_items);
	
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