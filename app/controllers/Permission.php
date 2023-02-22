<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (!$this->loggedIn) {
            redirect('login');
        }
        if(!$this->site->permission('permission'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }

        $this->load->library('form_validation'); 
        $this->load->library('ion_auth');
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {
        if(!$this->site->route_permission('permission_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->data['groups'] = $this->ion_auth->groups()->result_array();
        $this->data['group_id'] = 0;
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('Permission');
        $bc = array(array('link' => '#', 'page' => lang('Permission')));
        $meta = array('page_title' => lang('Permission'), 'bc' => $bc);
        $this->page_construct('permission/index', $this->data, $meta);

    } 

    function view() {
        if(!$this->site->route_permission('permission_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->form_validation->set_rules('groups_id', lang('Group'), 'required'); 

        $group_id=$this->input->post('groups_id');
        // echo $group_id.'__';die;
        $this->data['group_id'] = $group_id;
        if ($this->form_validation->run() == true) {

            $this->data['groups'] = $this->ion_auth->groups()->result_array();
            $this->data['permissiion_module'] = $this->site->whereRow('permissions','group_id',$group_id);
            $this->data['permission_route'] = $this->site->whereRow('module_routes','group_id',$group_id);

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
            $this->data['page_title'] = lang('Permission');
            $bc = array(array('link' => '#', 'page' => lang('Permission')));
            $meta = array('page_title' => lang('Permission'), 'bc' => $bc);
            $this->page_construct('permission/index', $this->data, $meta);

        } else {
            $this->session->set_flashdata('message', lang('There are some problem'));
            $this->index();
        }

    } 

    function edit() {
        if(!$this->site->route_permission('permission_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->form_validation->set_rules('group_id', lang('Group'), 'required'); 

        $group_id=$this->input->post('group_id');

        $this->data['group_id'] = $group_id;
        if ($this->form_validation->run() == true) {


            $this->data['groups'] = $this->ion_auth->groups()->result_array();
            $permissiion_module = $this->site->whereRow('permissions','group_id',$group_id);
            $permission_route = $this->site->whereRow('module_routes','group_id',$group_id);


            $data = array(
                'group_id' => $this->input->post('group_id'),
                'pos' => $this->input->post('pos'),
                'products' => $this->input->post('products'),
                'categories' => $this->input->post('categories'),
                'brands' => $this->input->post('brands'),
                'sales' => $this->input->post('sales'),
                'salereturn' => $this->input->post('salereturn'),
                'purchases' => $this->input->post('purchases'),
                'supplierpayment' => $this->input->post('supplierpayment'),
                'expenses' => $this->input->post('expenses'),
                'collection' => $this->input->post('collection'),
                'bank' => $this->input->post('bank'),
                'user' => $this->input->post('user'),
                'employee' => $this->input->post('employee'),
                'customers' => $this->input->post('customers'),
                'suppliers' => $this->input->post('suppliers'),
                'store' => $this->input->post('store'),
                'group' => $this->input->post('group'),
                'permission' => $this->input->post('permission'),
                'settings' => $this->input->post('settings'),
                'reports' => $this->input->post('reports'),
                'mf_categories' => $this->input->post('mf_categories'),
                'mf_unit' => $this->input->post('mf_unit'),
                'mf_material' => $this->input->post('mf_material'),
                'mf_brands' => $this->input->post('mf_brands'),
                'mf_suppliers' => $this->input->post('mf_suppliers'),
                'mf_purchases' => $this->input->post('mf_purchases'),
                'mf_material_stock' => $this->input->post('mf_material_stock'),
                'mf_recipe' => $this->input->post('mf_recipe'),
            );

            $data2 = array(
                'group_id' => $this->input->post('group_id'),
                'pos_view' => $this->input->post('pos_view'),
                'pos_add' => $this->input->post('pos_add'),
                'pos_edit' => $this->input->post('pos_edit'),
                'pos_delete' => $this->input->post('pos_delete'),
                'products_view' => $this->input->post('products_view'),
                'products_add' => $this->input->post('products_add'),
                'products_edit' => $this->input->post('products_edit'),
                'products_delete' => $this->input->post('products_delete'),
                'categories_view' => $this->input->post('categories_view'),
                'categories_add' => $this->input->post('categories_add'),
                'categories_edit' => $this->input->post('categories_edit'),
                'categories_delete' => $this->input->post('categories_delete'),
                'brands_view' => $this->input->post('brands_view'),
                'brands_add' => $this->input->post('brands_add'),
                'brands_edit' => $this->input->post('brands_edit'),
                'brands_delete' => $this->input->post('brands_delete'),
                'sales_view' => $this->input->post('sales_view'),
                'salereturn_view' => $this->input->post('salereturn_view'),
                'salereturn_add' => $this->input->post('salereturn_add'),
                'salereturn_delete' => $this->input->post('salereturn_delete'),
                'purchases_view' => $this->input->post('purchases_view'),
                'purchases_add' => $this->input->post('purchases_add'),
                'purchases_edit' => $this->input->post('purchases_edit'),
                'purchases_delete' => $this->input->post('purchases_delete'),
                'supplierpayment_view' => $this->input->post('supplierpayment_view'),
                'supplierpayment_add' => $this->input->post('supplierpayment_add'),
                'supplierpayment_edit' => $this->input->post('supplierpayment_edit'),
                'supplierpayment_delete' => $this->input->post('supplierpayment_delete'),
                'expenses_view' => $this->input->post('expenses_view'),
                'expenses_add' => $this->input->post('expenses_add'),
                'expenses_edit' => $this->input->post('expenses_edit'),
                'expenses_delete' => $this->input->post('expenses_delete'),
                'collection_view' => $this->input->post('collection_view'),
                'collection_add' => $this->input->post('collection_add'),
                'collection_edit' => $this->input->post('collection_edit'),
                'collection_delete' => $this->input->post('collection_delete'),
                'bank_view' => $this->input->post('bank_view'),
                'bank_add' => $this->input->post('bank_add'),
                'bank_edit' => $this->input->post('bank_edit'),
                'bank_delete' => $this->input->post('bank_delete'),
                'user_view' => $this->input->post('user_view'),
                'user_add' => $this->input->post('user_add'),
                'user_edit' => $this->input->post('user_edit'),
                'user_delete' => $this->input->post('user_delete'),
                'employee_view' => $this->input->post('employee_view'),
                'employee_add' => $this->input->post('employee_add'),
                'employee_edit' => $this->input->post('employee_edit'),
                'employee_delete' => $this->input->post('employee_delete'),
                'customers_view' => $this->input->post('customers_view'),
                'customers_add' => $this->input->post('customers_add'),
                'customers_edit' => $this->input->post('customers_edit'),
                'customers_delete' => $this->input->post('customers_delete'),
                'suppliers_view' => $this->input->post('suppliers_view'),
                'suppliers_add' => $this->input->post('suppliers_add'),
                'suppliers_edit' => $this->input->post('suppliers_edit'),
                'suppliers_delete' => $this->input->post('suppliers_delete'),
                'store_view' => $this->input->post('store_view'),
                'store_add' => $this->input->post('store_add'),
                'store_edit' => $this->input->post('store_edit'),
                'store_delete' => $this->input->post('store_delete'),
                'group_view' => $this->input->post('group_view'),
                'group_add' => $this->input->post('group_add'),
                'group_edit' => $this->input->post('group_edit'),
                'group_delete' => $this->input->post('group_delete'),
                'permission_view' => $this->input->post('permission_view'),
                'permission_edit' => $this->input->post('permission_edit'),
                'settings_view' => $this->input->post('settings_view'),
                'settings_edit' => $this->input->post('settings_edit'),
                'reports_view' => $this->input->post('reports_view'),
                'mf_categories_view' => $this->input->post('mf_categories_view'),
                'mf_categories_add' => $this->input->post('mf_categories_add'),
                'mf_categories_edit' => $this->input->post('mf_categories_edit'),
                'mf_categories_delete' => $this->input->post('mf_categories_delete'),
                'mf_unit_view' => $this->input->post('mf_unit_view'),
                'mf_unit_add' => $this->input->post('mf_unit_add'),
                'mf_unit_edit' => $this->input->post('mf_unit_edit'),
                'mf_unit_delete' => $this->input->post('mf_unit_delete'),
                'mf_material_view' => $this->input->post('mf_material_view'),
                'mf_material_add' => $this->input->post('mf_material_add'),
                'mf_material_edit' => $this->input->post('mf_material_edit'),
                'mf_material_delete' => $this->input->post('mf_material_delete'),
                'mf_brands_view' => $this->input->post('mf_brands_view'),
                'mf_brands_add' => $this->input->post('mf_brands_add'),
                'mf_brands_edit' => $this->input->post('mf_brands_edit'),
                'mf_brands_delete' => $this->input->post('mf_brands_delete'),
                'mf_suppliers_view' => $this->input->post('mf_suppliers_view'),
                'mf_suppliers_add' => $this->input->post('mf_suppliers_add'),
                'mf_suppliers_edit' => $this->input->post('mf_suppliers_edit'),
                'mf_suppliers_delete' => $this->input->post('mf_suppliers_delete'),
                'mf_purchases_view' => $this->input->post('mf_purchases_view'),
                'mf_purchases_add' => $this->input->post('mf_purchases_add'),
                'mf_purchases_edit' => $this->input->post('mf_purchases_edit'),
                'mf_purchases_delete' => $this->input->post('mf_purchases_delete'),
                'mf_material_stock_view' => $this->input->post('mf_material_stock_view'),
                'mf_material_stock_add' => $this->input->post('mf_material_stock_add'),
                'mf_recipe_view' => $this->input->post('mf_recipe_view'),
                'mf_recipe_add' => $this->input->post('mf_recipe_add'),
                'mf_recipe_edit' => $this->input->post('mf_recipe_edit'),
                'mf_recipe_delete' => $this->input->post('mf_recipe_delete'),
            );
            // print_r($data);
            // print_r($data2);die;

            if(is_object($permissiion_module))
            {
                $where_data=array('permissions_id'=>$permissiion_module->permissions_id);
                $this->site->updateQuery('permissions',$data,$where_data);
                $this->session->set_flashdata('message', lang('Role Permission successfully updated'));
            }
            else
            {
                $this->site->insertQuery('permissions',$data);
                $this->session->set_flashdata('message', lang('Role Permission successfully added'));
            }

            if(is_object($permission_route))
            {
                $where_data=array('module_routes_id'=>$permission_route->module_routes_id);
                $this->site->updateQuery('module_routes',$data2,$where_data);
                $this->session->set_flashdata('message', lang('Role Permission successfully updated'));
            }
            else
            {
                $this->site->insertQuery('module_routes',$data2);
                $this->session->set_flashdata('message', lang('Role Permission successfully added'));
            }

            $this->data['permissiion_module'] =$this->site->whereRow('permissions','group_id',$group_id);
            $this->data['permission_route'] = $this->site->whereRow('module_routes','group_id',$group_id);
            $this->data['page_title'] = lang('Permission');
            $bc = array(array('link' => '#', 'page' => lang('Permission')));
            $meta = array('page_title' => lang('Permission'), 'bc' => $bc);
            $this->page_construct('permission/index', $this->data, $meta);

        } else {

            $this->data['groups'] = $this->ion_auth->groups()->result_array();
            $this->data['permissiion_module'] = $this->site->whereRow('permissions','group_id',$group_id);
            $this->data['permission_route'] = $this->site->whereRow('module_routes','group_id',$group_id);

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
            $this->data['page_title'] = lang('Permission');
            $bc = array(array('link' => '#', 'page' => lang('Permission')));
            $meta = array('page_title' => lang('Permission'), 'bc' => $bc);
            $this->page_construct('permission/index', $this->data, $meta);
        }
    } 

}
