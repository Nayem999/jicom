<?php (defined('BASEPATH')) or exit('No direct script access allowed');?>
<section class="content">

    <div class="row">

        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?= lang('list_results'); ?></h3>
                </div>

                <div class="panel-body">
                <?= form_open("permission/view"); ?>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= lang('group', 'group'); ?>
                                <?php
                                foreach ($groups as $group) {
                                    $gp[$group['id']] = $group['name'];
                                }
                                ?>
                                <?= form_dropdown('groups_id', $gp, set_value('groups_id',$group_id), 'class="form-control" id="groups_id" required="required" style="width:100%;"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                            </div>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div>

                <div class="panel-body" style="<?=$group_id>0? 'display:block':'display:none';?>">

                    <?= form_open("permission/edit"); ?>
                    <input type="hidden" name="group_id" id="group_id" value="<?=$group_id?>">

                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Module</strong> 
                        </div>
                        <div class="col-sm-2">
                            <strong>View</strong> 
                        </div>
                        <div class="col-sm-2">
                            <strong>Add</strong> 
                        </div>
                        <div class="col-sm-2">
                            <strong>Edit</strong> 
                        </div>
                        <div class="col-sm-2">
                            <strong>Delete</strong> 
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4" >
                            <input type="checkbox" name="pos" id="pos" value="<?=isset($permissiion_module->pos)?$permissiion_module->pos:0;?>" <?=(isset($permissiion_module->pos) && $permissiion_module->pos==1)?'checked':'';?> onclick="fn_change_val('pos')" > Pos

                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox"name="pos_view" id="pos_view"  value="<?=isset($permission_route->pos_view)?$permission_route->pos_view:0;?>" <?=(isset($permission_route->pos_view) && $permission_route->pos_view==1)?'checked':'';?> onclick="fn_change_val('pos_view')" >
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="pos_add" id="pos_add"  value="<?=isset($permission_route->pos_add)?$permission_route->pos_add:0;?>" <?=(isset($permission_route->pos_add) && $permission_route->pos_add==1)?'checked':'';?>  onclick="fn_change_val('pos_add')" >   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="pos_edit" id="pos_edit"  value="<?=isset($permission_route->pos_edit)?$permission_route->pos_edit:0;?>" <?=(isset($permission_route->pos_edit) && $permission_route->pos_edit==1)?'checked':'';?>  onclick="fn_change_val('pos_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="pos_delete" id="pos_delete"  value="<?=isset($permission_route->pos_delete)?$permission_route->pos_delete:0;?>" <?=(isset($permission_route->pos_delete) && $permission_route->pos_delete==1)?'checked':'';?>  onclick="fn_change_val('pos_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="products" id="products" value="<?=isset($permissiion_module->products)?$permissiion_module->products:0;?>" <?=(isset($permissiion_module->products) && $permissiion_module->products==1)?'checked':'';?> onclick="fn_change_val('products')"> Products
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="products_view" id="products_view" value="<?=isset($permission_route->products_view)?$permission_route->products_view:0;?>" <?=(isset($permission_route->products_view) && $permission_route->products_view==1)?'checked':'';?> onclick="fn_change_val('products_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="products_add" id="products_add_v" value="<?=isset($permission_route->products_add)?$permission_route->products_add:0;?>" <?=(isset($permission_route->products_add) && $permission_route->products_add==1)?'checked':'';?>  onclick="fn_change_val('products_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="products_edit" id="products_edit"  value="<?=isset($permission_route->products_edit)?$permission_route->products_edit:0;?>" <?=(isset($permission_route->products_edit) && $permission_route->products_edit==1)?'checked':'';?>  onclick="fn_change_val('products_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="products_delete" id="products_delete"  value="<?=isset($permission_route->products_delete)?$permission_route->products_delete:0;?>" <?=(isset($permission_route->products_delete) && $permission_route->products_delete==1)?'checked':'';?>  onclick="fn_change_val('products_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="categories" id="categories" value="<?=isset($permissiion_module->categories)?$permissiion_module->categories:0;?>" <?=(isset($permissiion_module->categories) && $permissiion_module->categories==1)?'checked':'';?> onclick="fn_change_val('categories')" > Categories
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="categories_view" id="categories_view"  value="<?=isset($permission_route->categories_view)?$permission_route->categories_view:0;?>" <?=(isset($permission_route->categories_view) && $permission_route->categories_view==1)?'checked':'';?> onclick="fn_change_val('categories_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="categories_add" id="categories_add_v"  value="<?=isset($permission_route->categories_add)?$permission_route->categories_add:0;?>" <?=(isset($permission_route->categories_add) && $permission_route->categories_add==1)?'checked':'';?>  onclick="fn_change_val('categories_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="categories_edit" id="categories_edit"  value="<?=isset($permission_route->categories_edit)?$permission_route->categories_edit:0;?>" <?=(isset($permission_route->categories_edit) && $permission_route->categories_edit==1)?'checked':'';?>  onclick="fn_change_val('categories_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="categories_delete" id="categories_delete"  value="<?=isset($permission_route->categories_delete)?$permission_route->categories_delete:0;?>" <?=(isset($permission_route->categories_delete) && $permission_route->categories_delete==1)?'checked':'';?>  onclick="fn_change_val('categories_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="brands" id="brands" value="<?=isset($permissiion_module->brands)?$permissiion_module->brands:0;?>" <?=(isset($permissiion_module->brands) && $permissiion_module->brands==1)?'checked':'';?> onclick="fn_change_val('brands')" > Brands
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="brands_view" id="brands_view"  value="<?=isset($permission_route->brands_view)?$permission_route->brands_view:0;?>" <?=(isset($permission_route->brands_view) && $permission_route->brands_view==1)?'checked':'';?> onclick="fn_change_val('brands_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="brands_add" id="brands_add_v"  value="<?=isset($permission_route->brands_add)?$permission_route->brands_add:0;?>" <?=(isset($permission_route->brands_add) && $permission_route->brands_add==1)?'checked':'';?>  onclick="fn_change_val('brands_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="brands_edit" id="brands_edit"  value="<?=isset($permission_route->brands_edit)?$permission_route->brands_edit:0;?>" <?=(isset($permission_route->brands_edit) && $permission_route->brands_edit==1)?'checked':'';?>  onclick="fn_change_val('brands_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="brands_delete" id="brands_delete"  value="<?=isset($permission_route->brands_delete)?$permission_route->brands_delete:0;?>" <?=(isset($permission_route->brands_delete) && $permission_route->brands_delete==1)?'checked':'';?>  onclick="fn_change_val('brands_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="sales" id="sales" value="<?=isset($permissiion_module->sales)?$permissiion_module->sales:0;?>" <?=(isset($permissiion_module->sales) && $permissiion_module->sales==1)?'checked':'';?> onclick="fn_change_val('sales')" > Sales
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="sales_view" id="sales_view"  value="<?=isset($permission_route->sales_view)?$permission_route->sales_view:0;?>" <?=(isset($permission_route->sales_view) && $permission_route->sales_view==1)?'checked':'';?> onclick="fn_change_val('sales_view')">
                        </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="salereturn" id="salereturn" value="<?=isset($permissiion_module->salereturn)?$permissiion_module->salereturn:0;?>" <?=(isset($permissiion_module->salereturn) && $permissiion_module->salereturn==1)?'checked':'';?> onclick="fn_change_val('salereturn')" > Sales Return
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="salereturn_view" id="salereturn_view"  value="<?=isset($permission_route->salereturn_view)?$permission_route->salereturn_view:0;?>" <?=(isset($permission_route->salereturn_view) && $permission_route->salereturn_view==1)?'checked':'';?> onclick="fn_change_val('salereturn_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="salereturn_add" id="salereturn_add"  value="<?=isset($permission_route->salereturn_add)?$permission_route->salereturn_add:0;?>" <?=(isset($permission_route->salereturn_add) && $permission_route->salereturn_add==1)?'checked':'';?>  onclick="fn_change_val('salereturn_add')">   
                        </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="salereturn_delete" id="salereturn_delete"  value="<?=isset($permission_route->salereturn_delete)?$permission_route->salereturn_delete:0;?>" <?=(isset($permission_route->salereturn_delete) && $permission_route->salereturn_delete==1)?'checked':'';?>  onclick="fn_change_val('salereturn_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="purchases" id="purchases" value="<?=isset($permissiion_module->purchases)?$permissiion_module->purchases:0;?>" <?=(isset($permissiion_module->purchases) && $permissiion_module->purchases==1)?'checked':'';?> onclick="fn_change_val('purchases')" > Purchases
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="purchases_view" id="purchases_view"  value="<?=isset($permission_route->purchases_view)?$permission_route->purchases_view:0;?>" <?=(isset($permission_route->purchases_view) && $permission_route->purchases_view==1)?'checked':'';?> onclick="fn_change_val('purchases_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="purchases_add" id="purchases_add_v"  value="<?=isset($permission_route->purchases_add)?$permission_route->purchases_add:0;?>" <?=(isset($permission_route->purchases_add) && $permission_route->purchases_add==1)?'checked':'';?>  onclick="fn_change_val('purchases_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="purchases_edit" id="purchases_edit"  value="<?=isset($permission_route->purchases_edit)?$permission_route->purchases_edit:0;?>" <?=(isset($permission_route->purchases_edit) && $permission_route->purchases_edit==1)?'checked':'';?>  onclick="fn_change_val('purchases_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="purchases_delete" id="purchases_delete"  value="<?=isset($permission_route->purchases_delete)?$permission_route->purchases_delete:0;?>" <?=(isset($permission_route->purchases_delete) && $permission_route->purchases_delete==1)?'checked':'';?>  onclick="fn_change_val('purchases_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="supplierpayment" id="supplierpayment" value="<?=isset($permissiion_module->supplierpayment)?$permissiion_module->supplierpayment:0;?>" <?=(isset($permissiion_module->supplierpayment) && $permissiion_module->supplierpayment==1)?'checked':'';?> onclick="fn_change_val('supplierpayment')" > Supplier Payment
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="supplierpayment_view" id="supplierpayment_view"  value="<?=isset($permission_route->supplierpayment_view)?$permission_route->supplierpayment_view:0;?>" <?=(isset($permission_route->supplierpayment_view) && $permission_route->supplierpayment_view==1)?'checked':'';?> onclick="fn_change_val('supplierpayment_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="supplierpayment_add" id="supplierpayment_add"  value="<?=isset($permission_route->supplierpayment_add)?$permission_route->supplierpayment_add:0;?>" <?=(isset($permission_route->supplierpayment_add) && $permission_route->supplierpayment_add==1)?'checked':'';?>  onclick="fn_change_val('supplierpayment_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="supplierpayment_edit" id="supplierpayment_edit"  value="<?=isset($permission_route->supplierpayment_edit)?$permission_route->supplierpayment_edit:0;?>" <?=(isset($permission_route->supplierpayment_edit) && $permission_route->supplierpayment_edit==1)?'checked':'';?>  onclick="fn_change_val('supplierpayment_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="supplierpayment_delete" id="supplierpayment_delete"  value="<?=isset($permission_route->supplierpayment_delete)?$permission_route->supplierpayment_delete:0;?>" <?=(isset($permission_route->supplierpayment_delete) && $permission_route->supplierpayment_delete==1)?'checked':'';?>  onclick="fn_change_val('supplierpayment_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="expenses" id="expenses" id="collection" value="<?=isset($permissiion_module->expenses)?$permissiion_module->expenses:0;?>" <?=(isset($permissiion_module->expenses) && $permissiion_module->expenses==1)?'checked':'';?> onclick="fn_change_val('expenses')" > Expenses
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="expenses_view" id="expenses_view"  value="<?=isset($permission_route->expenses_view)?$permission_route->expenses_view:0;?>" <?=(isset($permission_route->expenses_view) && $permission_route->expenses_view==1)?'checked':'';?> onclick="fn_change_val('expenses_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="expenses_add" id="expenses_add"  value="<?=isset($permission_route->expenses_add)?$permission_route->expenses_add:0;?>" <?=(isset($permission_route->expenses_add) && $permission_route->expenses_add==1)?'checked':'';?>  onclick="fn_change_val('expenses_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="expenses_edit" id="expenses_edit"  value="<?=isset($permission_route->expenses_edit)?$permission_route->expenses_edit:0;?>" <?=(isset($permission_route->expenses_edit) && $permission_route->expenses_edit==1)?'checked':'';?>  onclick="fn_change_val('expenses_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="expenses_delete" id="expenses_delete"  value="<?=isset($permission_route->expenses_delete)?$permission_route->expenses_delete:0;?>" <?=(isset($permission_route->expenses_delete) && $permission_route->expenses_delete==1)?'checked':'';?>  onclick="fn_change_val('expenses_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="collection" id="collection" value="<?=isset($permissiion_module->collection)?$permissiion_module->collection:0;?>" <?=(isset($permissiion_module->collection) && $permissiion_module->collection==1)?'checked':'';?> onclick="fn_change_val('collection')" > Collection
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="collection_view" id="collection_view"  value="<?=isset($permission_route->collection_view)?$permission_route->collection_view:0;?>" <?=(isset($permission_route->collection_view) && $permission_route->collection_view==1)?'checked':'';?> onclick="fn_change_val('collection_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="collection_add" id="collection_add"  value="<?=isset($permission_route->collection_add)?$permission_route->collection_add:0;?>" <?=(isset($permission_route->collection_add) && $permission_route->collection_add==1)?'checked':'';?>  onclick="fn_change_val('collection_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="collection_edit" id="collection_edit"  value="<?=isset($permission_route->collection_edit)?$permission_route->collection_edit:0;?>" <?=(isset($permission_route->collection_edit) && $permission_route->collection_edit==1)?'checked':'';?>  onclick="fn_change_val('collection_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="collection_delete" id="collection_delete"  value="<?=isset($permission_route->collection_delete)?$permission_route->collection_delete:0;?>" <?=(isset($permission_route->collection_delete) && $permission_route->collection_delete==1)?'checked':'';?>  onclick="fn_change_val('collection_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="bank" id="bank" value="<?=isset($permissiion_module->bank)?$permissiion_module->bank:0;?>" <?=(isset($permissiion_module->bank) && $permissiion_module->bank==1)?'checked':'';?> onclick="fn_change_val('bank')" > Bank
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="bank_view" id="bank_view"  value="<?=isset($permission_route->bank_view)?$permission_route->bank_view:0;?>" <?=(isset($permission_route->bank_view) && $permission_route->bank_view==1)?'checked':'';?> onclick="fn_change_val('bank_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="bank_add" id="bank_add_v"  value="<?=isset($permission_route->bank_add)?$permission_route->bank_add:0;?>" <?=(isset($permission_route->bank_add) && $permission_route->bank_add==1)?'checked':'';?>  onclick="fn_change_val('bank_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="bank_edit" id="bank_edit"  value="<?=isset($permission_route->bank_edit)?$permission_route->bank_edit:0;?>" <?=(isset($permission_route->bank_edit) && $permission_route->bank_edit==1)?'checked':'';?>  onclick="fn_change_val('bank_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="bank_delete" id="bank_delete"  value="<?=isset($permission_route->bank_delete)?$permission_route->bank_delete:0;?>" <?=(isset($permission_route->bank_delete) && $permission_route->bank_delete==1)?'checked':'';?>  onclick="fn_change_val('bank_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="user" id="user" value="<?=isset($permissiion_module->user)?$permissiion_module->user:0;?>" <?=(isset($permissiion_module->user) && $permissiion_module->user==1)?'checked':'';?> onclick="fn_change_val('user')" > User
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="user_view" id="user_view"  value="<?=isset($permission_route->user_view)?$permission_route->user_view:0;?>" <?=(isset($permission_route->user_view) && $permission_route->user_view==1)?'checked':'';?> onclick="fn_change_val('user_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="user_add" id="user_add"  value="<?=isset($permission_route->user_add)?$permission_route->user_add:0;?>" <?=(isset($permission_route->user_add) && $permission_route->user_add==1)?'checked':'';?>  onclick="fn_change_val('user_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="user_edit" id="user_edit"  value="<?=isset($permission_route->user_edit)?$permission_route->user_edit:0;?>" <?=(isset($permission_route->user_edit) && $permission_route->user_edit==1)?'checked':'';?>  onclick="fn_change_val('user_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="user_delete" id="user_delete"  value="<?=isset($permission_route->user_delete)?$permission_route->user_delete:0;?>" <?=(isset($permission_route->user_delete) && $permission_route->user_delete==1)?'checked':'';?>  onclick="fn_change_val('user_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="employee" id="employee" value="<?=isset($permissiion_module->employee)?$permissiion_module->employee:0;?>" <?=(isset($permissiion_module->employee) && $permissiion_module->employee==1)?'checked':'';?> onclick="fn_change_val('employee')" > Employee
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="employee_view" id="employee_view"  value="<?=isset($permission_route->employee_view)?$permission_route->employee_view:0;?>" <?=(isset($permission_route->employee_view) && $permission_route->employee_view==1)?'checked':'';?> onclick="fn_change_val('employee_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="employee_add" id="employee_add"  value="<?=isset($permission_route->employee_add)?$permission_route->employee_add:0;?>" <?=(isset($permission_route->employee_add) && $permission_route->employee_add==1)?'checked':'';?>  onclick="fn_change_val('employee_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="employee_edit" id="employee_edit"  value="<?=isset($permission_route->employee_edit)?$permission_route->employee_edit:0;?>" <?=(isset($permission_route->employee_edit) && $permission_route->employee_edit==1)?'checked':'';?>  onclick="fn_change_val('employee_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="employee_delete" id="employee_delete"  value="<?=isset($permission_route->employee_delete)?$permission_route->employee_delete:0;?>" <?=(isset($permission_route->employee_delete) && $permission_route->employee_delete==1)?'checked':'';?>  onclick="fn_change_val('employee_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="customers" id="customers" value="<?=isset($permissiion_module->customers)?$permissiion_module->customers:0;?>" <?=(isset($permissiion_module->customers) && $permissiion_module->customers==1)?'checked':'';?> onclick="fn_change_val('customers')" > Customers
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="customers_view" id="customers_view"  value="<?=isset($permission_route->customers_view)?$permission_route->customers_view:0;?>" <?=(isset($permission_route->customers_view) && $permission_route->customers_view==1)?'checked':'';?> onclick="fn_change_val('customers_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="customers_add" id="customers_add_v"  value="<?=isset($permission_route->customers_add)?$permission_route->customers_add:0;?>" <?=(isset($permission_route->customers_add) && $permission_route->customers_add==1)?'checked':'';?>  onclick="fn_change_val('customers_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="customers_edit" id="customers_edit"  value="<?=isset($permission_route->customers_edit)?$permission_route->customers_edit:0;?>" <?=(isset($permission_route->customers_edit) && $permission_route->customers_edit==1)?'checked':'';?>  onclick="fn_change_val('customers_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="customers_delete" id="customers_delete"  value="<?=isset($permission_route->customers_delete)?$permission_route->customers_delete:0;?>" <?=(isset($permission_route->customers_delete) && $permission_route->customers_delete==1)?'checked':'';?>  onclick="fn_change_val('customers_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="suppliers" id="suppliers" value="<?=isset($permissiion_module->suppliers)?$permissiion_module->suppliers:0;?>" <?=(isset($permissiion_module->suppliers) && $permissiion_module->suppliers==1)?'checked':'';?> onclick="fn_change_val('suppliers')" > Suppliers
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="suppliers_view" id="suppliers_view"  value="<?=isset($permission_route->suppliers_view)?$permission_route->suppliers_view:0;?>" <?=(isset($permission_route->suppliers_view) && $permission_route->suppliers_view==1)?'checked':'';?> onclick="fn_change_val('suppliers_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="suppliers_add" id="suppliers_add_v"  value="<?=isset($permission_route->suppliers_add)?$permission_route->suppliers_add:0;?>" <?=(isset($permission_route->suppliers_add) && $permission_route->suppliers_add==1)?'checked':'';?>  onclick="fn_change_val('suppliers_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="suppliers_edit" id="suppliers_edit"  value="<?=isset($permission_route->suppliers_edit)?$permission_route->suppliers_edit:0;?>" <?=(isset($permission_route->suppliers_edit) && $permission_route->suppliers_edit==1)?'checked':'';?>  onclick="fn_change_val('suppliers_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="suppliers_delete" id="suppliers_delete"  value="<?=isset($permission_route->suppliers_delete)?$permission_route->suppliers_delete:0;?>" <?=(isset($permission_route->suppliers_delete) && $permission_route->suppliers_delete==1)?'checked':'';?>  onclick="fn_change_val('suppliers_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="store" id="store" value="<?=isset($permissiion_module->store)?$permissiion_module->store:0;?>" <?=(isset($permissiion_module->store) && $permissiion_module->store==1)?'checked':'';?> onclick="fn_change_val('store')" > Store
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="store_view" id="store_view"  value="<?=isset($permission_route->store_view)?$permission_route->store_view:0;?>" <?=(isset($permission_route->store_view) && $permission_route->store_view==1)?'checked':'';?> onclick="fn_change_val('store_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="store_add" id="store_add_v"  value="<?=isset($permission_route->store_add)?$permission_route->store_add:0;?>" <?=(isset($permission_route->store_add) && $permission_route->store_add==1)?'checked':'';?>  onclick="fn_change_val('store_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="store_edit" id="store_edit"  value="<?=isset($permission_route->store_edit)?$permission_route->store_edit:0;?>" <?=(isset($permission_route->store_edit) && $permission_route->store_edit==1)?'checked':'';?>  onclick="fn_change_val('store_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="store_delete" id="store_delete"  value="<?=isset($permission_route->store_delete)?$permission_route->store_delete:0;?>" <?=(isset($permission_route->store_delete) && $permission_route->store_delete==1)?'checked':'';?>  onclick="fn_change_val('store_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="group" id="group" value="<?=isset($permissiion_module->group)?$permissiion_module->group:0;?>" <?=(isset($permissiion_module->group) && $permissiion_module->group==1)?'checked':'';?> onclick="fn_change_val('group')" > Group
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="group_view" id="group_view"  value="<?=isset($permission_route->group_view)?$permission_route->group_view:0;?>" <?=(isset($permission_route->group_view) && $permission_route->group_view==1)?'checked':'';?> onclick="fn_change_val('group_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="group_add" id="group_add_v"  value="<?=isset($permission_route->group_add)?$permission_route->group_add:0;?>" <?=(isset($permission_route->group_add) && $permission_route->group_add==1)?'checked':'';?>  onclick="fn_change_val('group_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="group_edit" id="group_edit"  value="<?=isset($permission_route->group_edit)?$permission_route->group_edit:0;?>" <?=(isset($permission_route->group_edit) && $permission_route->group_edit==1)?'checked':'';?>  onclick="fn_change_val('group_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="group_delete" id="group_delete"  value="<?=isset($permission_route->group_delete)?$permission_route->group_delete:0;?>" <?=(isset($permission_route->group_delete) && $permission_route->group_delete==1)?'checked':'';?>  onclick="fn_change_val('group_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="permission" id="permission" value="<?=isset($permissiion_module->permission)?$permissiion_module->permission:0;?>" <?=(isset($permissiion_module->permission) && $permissiion_module->permission==1)?'checked':'';?> onclick="fn_change_val('permission')" > Permission
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="permission_view" id="permission_view"  value="<?=isset($permission_route->permission_view)?$permission_route->permission_view:0;?>" <?=(isset($permission_route->permission_view) && $permission_route->permission_view==1)?'checked':'';?> onclick="fn_change_val('permission_view')">
                        </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="settings" id="settings" value="<?=isset($permissiion_module->settings)?$permissiion_module->settings:0;?>" <?=(isset($permissiion_module->settings) && $permissiion_module->settings==1)?'checked':'';?> onclick="fn_change_val('settings')" > Settings
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="settings_view" id="settings_view"  value="<?=isset($permission_route->settings_view)?$permission_route->settings_view:0;?>" <?=(isset($permission_route->settings_view) && $permission_route->settings_view==1)?'checked':'';?> onclick="fn_change_val('settings_view')">
                        </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="settings_edit" id="settings_edit"  value="<?=isset($permission_route->settings_edit)?$permission_route->settings_edit:0;?>" <?=(isset($permission_route->settings_edit) && $permission_route->settings_edit==1)?'checked':'';?>  onclick="fn_change_val('settings_edit')">  
                        </div>
                        <div class="col-sm-2"> </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="reports" id="reports" value="<?=isset($permissiion_module->reports)?$permissiion_module->reports:0;?>" <?=(isset($permissiion_module->reports) && $permissiion_module->reports==1)?'checked':'';?> onclick="fn_change_val('reports')" > Reports
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="reports_view" id="reports_view"  value="<?=isset($permission_route->reports_view)?$permission_route->reports_view:0;?>" <?=(isset($permission_route->reports_view) && $permission_route->reports_view==1)?'checked':'';?> onclick="fn_change_val('reports_view')">
                        </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_categories" id="mf_categories" value="<?=isset($permissiion_module->mf_categories)?$permissiion_module->mf_categories:0;?>" <?=(isset($permissiion_module->mf_categories) && $permissiion_module->mf_categories==1)?'checked':'';?> onclick="fn_change_val('mf_categories')" > Raw Material Category
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_categories_view" id="mf_categories_view"  value="<?=isset($permission_route->mf_categories_view)?$permission_route->mf_categories_view:0;?>" <?=(isset($permission_route->mf_categories_view) && $permission_route->mf_categories_view==1)?'checked':'';?> onclick="fn_change_val('mf_categories_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_categories_add" id="mf_categories_add_v"  value="<?=isset($permission_route->mf_categories_add)?$permission_route->mf_categories_add:0;?>" <?=(isset($permission_route->mf_categories_add) && $permission_route->mf_categories_add==1)?'checked':'';?>  onclick="fn_change_val('mf_categories_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_categories_edit" id="mf_categories_edit"  value="<?=isset($permission_route->mf_categories_edit)?$permission_route->mf_categories_edit:0;?>" <?=(isset($permission_route->mf_categories_edit) && $permission_route->mf_categories_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_categories_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_categories_delete" id="mf_categories_delete"  value="<?=isset($permission_route->mf_categories_delete)?$permission_route->mf_categories_delete:0;?>" <?=(isset($permission_route->mf_categories_delete) && $permission_route->mf_categories_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_categories_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_unit" id="mf_unit" value="<?=isset($permissiion_module->mf_unit)?$permissiion_module->mf_unit:0;?>" <?=(isset($permissiion_module->mf_unit) && $permissiion_module->mf_unit==1)?'checked':'';?> onclick="fn_change_val('mf_unit')" > <?= lang('uom'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_unit_view" id="mf_unit_view"  value="<?=isset($permission_route->mf_unit_view)?$permission_route->mf_unit_view:0;?>" <?=(isset($permission_route->mf_unit_view) && $permission_route->mf_unit_view==1)?'checked':'';?> onclick="fn_change_val('mf_unit_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_unit_add" id="mf_unit_add_v"  value="<?=isset($permission_route->mf_unit_add)?$permission_route->mf_unit_add:0;?>" <?=(isset($permission_route->mf_unit_add) && $permission_route->mf_unit_add==1)?'checked':'';?>  onclick="fn_change_val('mf_unit_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_unit_edit" id="mf_unit_edit"  value="<?=isset($permission_route->mf_unit_edit)?$permission_route->mf_unit_edit:0;?>" <?=(isset($permission_route->mf_unit_edit) && $permission_route->mf_unit_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_unit_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_unit_delete" id="mf_unit_delete"  value="<?=isset($permission_route->mf_unit_delete)?$permission_route->mf_unit_delete:0;?>" <?=(isset($permission_route->mf_unit_delete) && $permission_route->mf_unit_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_unit_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_material" id="mf_material" value="<?=isset($permissiion_module->mf_material)?$permissiion_module->mf_material:0;?>" <?=(isset($permissiion_module->mf_material) && $permissiion_module->mf_material==1)?'checked':'';?> onclick="fn_change_val('mf_material')" > <?= lang('raw_material'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_material_view" id="mf_material_view"  value="<?=isset($permissiion_module->pos)?$permissiion_module->pos:0;?>" <?=(isset($permissiion_module->pos) && $permissiion_module->pos==1)?'checked':'';?> onclick="fn_change_val('mf_material_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_material_add" id="mf_material_add"  value="<?=isset($permission_route->mf_material_add)?$permission_route->mf_material_add:0;?>" <?=(isset($permission_route->mf_material_add) && $permission_route->mf_material_add==1)?'checked':'';?>  onclick="fn_change_val('mf_material_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_material_edit" id="mf_material_edit"  value="<?=isset($permission_route->mf_material_edit)?$permission_route->mf_material_edit:0;?>" <?=(isset($permission_route->mf_material_edit) && $permission_route->mf_material_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_material_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_material_delete" id="mf_material_delete"  value="<?=isset($permission_route->mf_material_delete)?$permission_route->mf_material_delete:0;?>" <?=(isset($permission_route->mf_material_delete) && $permission_route->mf_material_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_material_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_brands" id="mf_brands" value="<?=isset($permissiion_module->mf_brands)?$permissiion_module->mf_brands:0;?>" <?=(isset($permissiion_module->mf_brands) && $permissiion_module->mf_brands==1)?'checked':'';?> onclick="fn_change_val('mf_brands')" > Raw Material Brands
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_brands_view" id="mf_brands_view"  value="<?=isset($permission_route->mf_brands_view)?$permission_route->mf_brands_view:0;?>" <?=(isset($permission_route->mf_brands_view) && $permission_route->mf_brands_view==1)?'checked':'';?> onclick="fn_change_val('mf_brands_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_brands_add" id="mf_brands_add"  value="<?=isset($permission_route->mf_brands_add)?$permission_route->mf_brands_add:0;?>" <?=(isset($permission_route->mf_brands_add) && $permission_route->mf_brands_add==1)?'checked':'';?>  onclick="fn_change_val('mf_brands_add')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_brands_edit" id="mf_brands_edit"  value="<?=isset($permission_route->mf_brands_edit)?$permission_route->mf_brands_edit:0;?>" <?=(isset($permission_route->mf_brands_edit) && $permission_route->mf_brands_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_brands_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_brands_delete" id="mf_brands_delete"  value="<?=isset($permission_route->mf_brands_delete)?$permission_route->mf_brands_delete:0;?>" <?=(isset($permission_route->mf_brands_delete) && $permission_route->mf_brands_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_brands_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_suppliers" id="mf_suppliers" value="<?=isset($permissiion_module->mf_suppliers)?$permissiion_module->mf_suppliers:0;?>" <?=(isset($permissiion_module->mf_suppliers) && $permissiion_module->mf_suppliers==1)?'checked':'';?> onclick="fn_change_val('mf_suppliers')" > <?= lang('raw_material_supplier'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_suppliers_view" id="mf_suppliers_view"  value="<?=isset($permission_route->mf_suppliers_view)?$permission_route->mf_suppliers_view:0;?>" <?=(isset($permission_route->mf_suppliers_view) && $permission_route->mf_suppliers_view==1)?'checked':'';?> onclick="fn_change_val('mf_suppliers_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_suppliers_add" id="mf_suppliers_add_v"  value="<?=isset($permission_route->mf_suppliers_add)?$permission_route->mf_suppliers_add:0;?>" <?=(isset($permission_route->mf_suppliers_add) && $permission_route->mf_suppliers_add==1)?'checked':'';?>  onclick="fn_change_val('mf_suppliers_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_suppliers_edit" id="mf_suppliers_edit"  value="<?=isset($permission_route->mf_suppliers_edit)?$permission_route->mf_suppliers_edit:0;?>" <?=(isset($permission_route->mf_suppliers_edit) && $permission_route->mf_suppliers_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_suppliers_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_suppliers_delete" id="mf_suppliers_delete"  value="<?=isset($permission_route->mf_suppliers_delete)?$permission_route->mf_suppliers_delete:0;?>" <?=(isset($permission_route->mf_suppliers_delete) && $permission_route->mf_suppliers_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_suppliers_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_purchases" id="mf_purchases"  value="<?=isset($permissiion_module->mf_purchases)?$permissiion_module->mf_purchases:0;?>" <?=(isset($permissiion_module->mf_purchases) && $permissiion_module->mf_purchases==1)?'checked':'';?> onclick="fn_change_val('mf_purchases')" > Raw Material Purchases
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_purchases_view" id="mf_purchases_view"  value="<?=isset($permission_route->mf_purchases_view)?$permission_route->mf_purchases_view:0;?>" <?=(isset($permission_route->mf_purchases_view) && $permission_route->mf_purchases_view==1)?'checked':'';?> onclick="fn_change_val('mf_purchases_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_purchases_add" id="mf_purchases_add_v"  value="<?=isset($permission_route->mf_purchases_add)?$permission_route->mf_purchases_add:0;?>" <?=(isset($permission_route->mf_purchases_add) && $permission_route->mf_purchases_add==1)?'checked':'';?>  onclick="fn_change_val('mf_purchases_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_purchases_edit" id="mf_purchases_edit"  value="<?=isset($permission_route->mf_purchases_edit)?$permission_route->mf_purchases_edit:0;?>" <?=(isset($permission_route->mf_purchases_edit) && $permission_route->mf_purchases_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_purchases_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_purchases_delete" id="mf_purchases_delete"  value="<?=isset($permission_route->mf_purchases_delete)?$permission_route->mf_purchases_delete:0;?>" <?=(isset($permission_route->mf_purchases_delete) && $permission_route->mf_purchases_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_purchases_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_material_stock" id="mf_material_stock" value="<?=isset($permissiion_module->mf_material_stock)?$permissiion_module->mf_material_stock:0;?>" <?=(isset($permissiion_module->mf_material_stock) && $permissiion_module->mf_material_stock==1)?'checked':'';?> onclick="fn_change_val('mf_material_stock')"> Raw Material Stock
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_material_stock_view" id="mf_material_stock_view"  value="<?=isset($permission_route->mf_material_stock_view)?$permission_route->mf_material_stock_view:0;?>" <?=(isset($permission_route->mf_material_stock_view) && $permission_route->mf_material_stock_view==1)?'checked':'';?> onclick="fn_change_val('mf_material_stock_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_material_stock_add" id="mf_material_stock_add"  value="<?=isset($permission_route->mf_material_stock_add)?$permission_route->mf_material_stock_add:0;?>" <?=(isset($permission_route->mf_material_stock_add) && $permission_route->mf_material_stock_add==1)?'checked':'';?>  onclick="fn_change_val('mf_material_stock_add')">   
                        </div>
                        <div class="col-sm-2"> </div>
                        <div class="col-sm-2"> </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class="col-sm-4">
                            <input type="checkbox" name="mf_recipe" id="mf_recipe" value="<?=isset($permissiion_module->mf_recipe)?$permissiion_module->mf_recipe:0;?>" <?=(isset($permissiion_module->mf_recipe) && $permissiion_module->mf_recipe==1)?'checked':'';?> onclick="fn_change_val('mf_recipe')" > <?= lang('recipe'); ?>
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_recipe_view" id="mf_recipe_view"  value="<?=isset($permission_route->mf_recipe_view)?$permission_route->mf_recipe_view:0;?>" <?=(isset($permission_route->mf_recipe_view) && $permission_route->mf_recipe_view==1)?'checked':'';?> onclick="fn_change_val('mf_recipe_view')">
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_recipe_add" id="mf_recipe_add_v"  value="<?=isset($permission_route->mf_recipe_add)?$permission_route->mf_recipe_add:0;?>" <?=(isset($permission_route->mf_recipe_add) && $permission_route->mf_recipe_add==1)?'checked':'';?>  onclick="fn_change_val('mf_recipe_add_v')">   
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_recipe_edit" id="mf_recipe_edit"  value="<?=isset($permission_route->mf_recipe_edit)?$permission_route->mf_recipe_edit:0;?>" <?=(isset($permission_route->mf_recipe_edit) && $permission_route->mf_recipe_edit==1)?'checked':'';?>  onclick="fn_change_val('mf_recipe_edit')">  
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" name="mf_recipe_delete" id="mf_recipe_delete"  value="<?=isset($permission_route->mf_recipe_delete)?$permission_route->mf_recipe_delete:0;?>" <?=(isset($permission_route->mf_recipe_delete) && $permission_route->mf_recipe_delete==1)?'checked':'';?>  onclick="fn_change_val('mf_recipe_delete')">   
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary"><?= lang("submit"); ?></button>
                        </div>
                    </div>

                    <?= form_close(); ?>

                </div>
            </div>

        </div>

    </div>

</section>

<script >

    function fn_change_val(type){
        var data = $("#"+type).val();
        if(data==1){ $("#"+type).val(0); }else{ $("#"+type).val(1); }
    }

</script>
