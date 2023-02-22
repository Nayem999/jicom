<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_recipe extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (!$this->loggedIn) {
            redirect('login');
        }
        if(!$this->site->permission('mf_recipe'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }

        $this->load->library('form_validation');
        $this->load->model('products_model');
        $this->load->model('mf_recipe_model');
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {
        if(!$this->site->route_permission('mf_recipe_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('unit');
        $bc = array(array('link' => '#', 'page' => lang('unit')));
        $meta = array('page_title' => lang('unit'), 'bc' => $bc);
        $this->page_construct('mf_recipe/index', $this->data, $meta);

    } 

    function get_recipe() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('mf_recipe_mst') . ".id as id, " .  
         	$this->db->dbprefix('mf_recipe_mst'). ".code,".
         	$this->db->dbprefix('mf_recipe_mst'). ".name,".
         	$this->db->dbprefix('products'). ".name as product_name,".
         	$this->db->dbprefix('mf_recipe_mst').".description,", FALSE); 
        $this->datatables->from('mf_recipe_mst'); 
        $this->datatables->join('products','mf_recipe_mst.product_id=products.id'); 
        $this->datatables->where('mf_recipe_mst.active_status',1); 

        $action="<div class='text-center'><div class='btn-group'>";
		if($this->site->route_permission('mf_recipe_view')) {
			$action.="<a onclick=\"window.open('" . site_url('mf_recipe/view/$1') . "', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print Recipe' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> ";
		}
		if($this->site->route_permission('mf_recipe_edit')) {
			$action.="<a href='" . site_url('mf_recipe/edit/$1') . "' title='Edit Recipe' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
		}
		if($this->site->route_permission('mf_recipe_delete')) {
			$action.=" <a href='" . site_url('mf_recipe/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_recipe') . "')\" title='" . lang("delete_unit") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

        $this->datatables->add_column("Actions", $action, "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
        if(!$this->site->route_permission('mf_recipe_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $max_id = $this->mf_recipe_model->get_max_id();
         
        $this->form_validation->set_rules('recipe_name', lang('recipe_name'), 'required');
        $this->form_validation->set_rules('product_id', lang('product'), 'required');
        $this->form_validation->set_rules('uom_id', lang('uom'), 'required');
        
        if ($this->form_validation->run() == true) {
            
            $i = isset($_POST['material_stock_id']) ? sizeof($_POST['material_stock_id']) : 0;            
            
            for ($r = 0; $r < $i; $r++) {  

                $material_stock_id = $_POST['material_stock_id'][$r];
                $material_id = $_POST['material_id'][$r];              
                $item_qty = $_POST['quantity'][$r]; 
                
                if ($material_stock_id && $item_qty ) { 

                    $products[] = array(           
                        'material_id' => $material_id,                    
                        'material_stock_id' => $material_stock_id,                    
                        'quantity' => $item_qty,    
                        'created_by' => $this->session->userdata('user_id'),               
                        'created_at' =>  date('Y-m-d H:i:s'),                                      
                    ); 
                   
                }                
            }                        
            
            if (!isset($products) || empty($products)) {                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');
                $this->form_validation->set_rules('mf_supplier_id', lang("order_items"), 'required');
                
            } else {                
                krsort($products);                
            }      

            if($max_id>8){ $code_name = $max_id+1; }else{ $code_name = '0'.$max_id+1; }
            $data = array(                
                'code' => $code_name,                                             
                'name' => $this->input->post('recipe_name'),
                'product_id' => $this->input->post('product_id'),          
                'uom_id' => $this->input->post('uom_id'),          
                'description' => $this->input->post('description'),          
                'created_by' => $this->session->userdata('user_id'),               
                'created_at' =>  date('Y-m-d H:i:s'),               
            );

        }
        // print_r($data);die;
        
        if ($this->form_validation->run() == true && $this->mf_recipe_model->add_recipe($data, $products)) {
                      
            $this->session->set_flashdata('message', lang('recipe_added'));
            
            $this->index();

        } else {
            $this->load->model('mf_unit_model');

            if($max_id>8){ $this->data['code_name'] = $max_id+1; }else{ $this->data['code_name'] = '0'.$max_id+1; }
            $this->data['all_product']  = $this->products_model->getAllProducts();
            $this->data['all_uom']  = $this->mf_unit_model->getAllUnit();

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('add_recipe');
            $bc = array(array('link' => site_url('mf_recipe'), 'page' => lang('add_recipe')), array('link' => '#', 'page' => lang('add_recipe')));
            $meta = array('page_title' => lang('add_recipe'), 'bc' => $bc);
            $this->page_construct('mf_recipe/add', $this->data, $meta);
        }
    }

    function edit($id = NULL) {
        if(!$this->site->route_permission('mf_recipe_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $this->form_validation->set_rules('recipe_name', lang('recipe_name'), 'required');
        $this->form_validation->set_rules('product_id', lang('product'), 'required');
        $this->form_validation->set_rules('uom_id', lang('uom'), 'required');

        if ($this->form_validation->run() == true) {

            $i = isset($_POST['material_stock_id']) ? sizeof($_POST['material_stock_id']) : 0;            
            
            for ($r = 0; $r < $i; $r++) {  

                $material_stock_id = $_POST['material_stock_id'][$r];
                $material_id = $_POST['material_id'][$r];              
                $item_qty = $_POST['quantity'][$r]; 
                
                if ($material_stock_id && $item_qty ) { 

                    $products[] = array(           
                        'material_id' => $material_id,                    
                        'material_stock_id' => $material_stock_id,                    
                        'quantity' => $item_qty,    
                        'created_by' => $this->session->userdata('user_id'),               
                        'created_at' =>  date('Y-m-d H:i:s'),                                      
                    ); 
                   
                }                
            }                        
            
            if (!isset($products) || empty($products)) {                
                $this->form_validation->set_rules('product', lang("order_items"), 'required');
                $this->form_validation->set_rules('mf_supplier_id', lang("order_items"), 'required');
                
            } else {                
                krsort($products);                
            }

            $data = array(                                                          
                'name' => $this->input->post('recipe_name'),
                'product_id' => $this->input->post('product_id'),          
                'uom_id' => $this->input->post('uom_id'),          
                'description' => $this->input->post('description'),          
                'updated_by' => $this->session->userdata('user_id'),               
                'updated_at' =>  date('Y-m-d H:i:s'),               
            );
        }

        if ($this->form_validation->run() == true && $this->mf_recipe_model->updateRecipe($id, $data, $products)) {

            $this->session->set_flashdata('message', lang('category_updated'));
            $this->index();

        } else {

            $this->load->model('mf_unit_model');

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $this->data['all_product']  = $this->products_model->getAllProducts();
            $this->data['all_uom']  = $this->mf_unit_model->getAllUnit();
            $this->data['recipe_mst'] = $this->mf_recipe_model->getRecipeByID($id);
            $recipe_dtls = $this->mf_recipe_model->getRecipeDtlsByID($id);

            $c = rand(100000, 9999999);

            foreach ($recipe_dtls as $row) {

                $ri = $this->Settings->item_addition ? $row->material_stock_id : $c;
                
                $pr[$ri] = array(
                    'id' => $ri,
                    'item_id' => $row->material_stock_id,
                    'label' => $row->name . " (" . $row->brand_name . ")",
                    'row' => $row
                );
                
                $c++;
            }  
            $this->data['recipe_dtls'] = json_encode($pr);  
 
            $this->data['page_title'] = lang('new_category');
            $bc = array(array('link' => site_url('unit'), 'page' => lang('unit')), array('link' => '#', 'page' => lang('edit_uom')));
            $meta = array('page_title' => lang('edit_uom'), 'bc' => $bc);
            $this->page_construct('mf_recipe/edit', $this->data, $meta);

        }
    }

    function delete($id = NULL) {
        if(DEMO) {
            $this->session->set_flashdata('error', lang('disabled_in_demo'));
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');
        }
        if(!$this->site->route_permission('mf_recipe_delete')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $data['active_status']=0;
        if ($this->mf_recipe_model->deleteRecipe($id,$data)) {
            $this->session->set_flashdata('message', lang("Recipe successfully deleted"));
            $this->index();
        }
    }

    function suggestions($id = NULL) {
        
        if ($id) {
            
            $row = $this->site->getProductByID($id);
            
            $row->qty = 1;
            
            $pr = array(
                'id' => str_replace(".", "", microtime(true)),
                'item_id' => $row->material_stock_id,
                'label' => $row->name . " (" . $row->brand_name . ")",
                'row' => $row
            );
            
            echo json_encode($pr);
            
            die();
            
        }
        
        $term = $this->input->get('term', TRUE);
        
        $rows = $this->mf_recipe_model->get_raw_material_info($term);
        
        if ($rows) {

            // print_r($rows);die;
            
            foreach ($rows as $row) {
                
                $row->qty = 1;
                
                $pr[] = array(
                    'id' => str_replace(".", "", microtime(true)),
                    'item_id' => $row->material_stock_id,
                    'label' => $row->name . " (" . $row->brand_name . ")",
                    'row' => $row
                );
                
            }
            
            echo json_encode($pr);
            
        } else {
            
            echo json_encode(array(
                array(
                    'id' => 0,
                    'label' => lang('no_match_found'),
                    'value' => $term
                )
            ));
            
        }
        
    }

    function view($id = NULL) { 

        $this->data['recipe_mst'] = $this->mf_recipe_model->getRecipeByID($id);
        $this->data['recipe_dtls'] = $this->mf_recipe_model->getRecipeDtlsByID($id);
               
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));        
        $this->data['page_title'] = lang('View Recipe');
        
        $this->load->view($this->theme . 'mf_recipe/view', $this->data);
        
    }

}
