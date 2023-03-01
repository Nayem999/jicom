<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_production extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (!$this->loggedIn) {
            redirect('login');
        }
        if(!$this->site->permission('mf_production'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }

        $this->load->library('form_validation');
        // $this->load->model('products_model');
        $this->load->model('mf_recipe_model');
        $this->load->model('mf_production_model');
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {
        if(!$this->site->route_permission('mf_production_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('production');
        $bc = array(array('link' => '#', 'page' => lang('production')));
        $meta = array('page_title' => lang('production'), 'bc' => $bc);
        $this->page_construct('mf_production/index', $this->data, $meta);

    } 

    function get_production() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('mf_production_mst') . ".id as id, " .  
         	$this->db->dbprefix('mf_production_mst'). ".batch_no,".
         	$this->db->dbprefix('mf_recipe_mst'). ".name,".
         	$this->db->dbprefix('products'). ".name as product_name,".
         	$this->db->dbprefix('mf_production_mst').".status,", FALSE); 
        $this->datatables->from('mf_production_mst'); 
        $this->datatables->join('products','mf_production_mst.product_id=products.id'); 
        $this->datatables->join('mf_recipe_mst','mf_production_mst.recipe_id=mf_recipe_mst.id'); 
        $this->datatables->where('mf_production_mst.active_status',1); 

        $action="<div class='text-center'><div class='btn-group'>";
		if($this->site->route_permission('mf_production_view')) {
			$action.="<a href='javascript:;' onClick='approve_production($1)' title='Status Change' class='tip btn btn-primary btn-xs'><i class='fa fa-university'></i></a>    <a onclick=\"window.open('" . site_url('mf_production/view/$1') . "', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='Print Recipe' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> ";
		}
		if($this->site->route_permission('mf_production_edit')) {
			$action.="<a href='" . site_url('mf_production/edit/$1') . "' title='Edit Recipe' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
		}
		if($this->site->route_permission('mf_production_delete')) {
			$action.=" <a href='" . site_url('mf_production/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_production') . "')\" title='" . lang("delete_unit") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

        $this->datatables->add_column("Actions", $action, "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
        if(!$this->site->route_permission('mf_production_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $max_id = $this->mf_production_model->get_max_id();
        //  echo $this->input->post('uom_id')."__";die;
        $this->form_validation->set_rules('date', lang('date'), 'required');
        $this->form_validation->set_rules('batch_no', lang('batch_no'), 'required');
        $this->form_validation->set_rules('recipe_id', lang('recipe'), 'required');
        $this->form_validation->set_rules('target_qty', lang('Target Quantity'), 'required');
        $this->form_validation->set_rules('uom_id', lang('uom'), 'required');
        
        if ($this->form_validation->run() == true) {
            
            $i = isset($_POST['material_stock_id']) ? sizeof($_POST['material_stock_id']) : 0;            
            $total_cost=0;
            for ($r = 0; $r < $i; $r++) {  

                $material_stock_id = $_POST['material_stock_id'][$r];
                $material_id = $_POST['material_id'][$r];              
                $recipe_dtls_id = $_POST['recipe_dtls_id'][$r];              
                $item_qty = $_POST['qty'][$r]; 
                $item_cost = $_POST['cost'][$r]; 

                if ($material_stock_id && $item_qty ) { 

                    $production[] = array(                              
                        'recipe_id' => $this->input->post('recipe_id'),                    
                        'recipe_dtls_id' => $recipe_dtls_id,                    
                        'material_id' => $material_id,                    
                        'material_stock_id' => $material_stock_id,                    
                        'quantity' => $item_qty,    
                        'cost' => $item_cost,    
                        'created_by' => $this->session->userdata('user_id'),               
                        'created_at' =>  date('Y-m-d H:i:s'),                                      
                    ); 
                    $total_cost+=$item_cost;
                   
                }                
            }        

            if($max_id>8){ $batch_no = date('Ymd').$max_id+1; }else{ $batch_no = date('Ymd').'0'.$max_id+1; }
            $data = array(                
                'date' => $this->input->post('date'),
                'batch_no' => $batch_no,                                             
                'store_id' => $this->input->post('store_id'),          
                'product_id' => $this->input->post('product_id'),
                'recipe_id' => $this->input->post('recipe_id'),
                'target_qty' => $this->input->post('target_qty'),          
                'uom_id' => $this->input->post('uom_id'),          
                'actual_output' => $this->input->post('actual_output'),          
                'wasted' => $this->input->post('wasted'),          
                'notes' => $this->input->post('notes'),          
                'total_cost' => $total_cost,          
                'created_by' => $this->session->userdata('user_id'),               
                'created_at' =>  date('Y-m-d H:i:s'),               
            );

        }
        // print_r($data);die;
        
        if ($this->form_validation->run() == true && $this->mf_production_model->add_production($data, $production)) {
                      
            $this->session->set_flashdata('message', lang('production_added'));
            
            $this->index();

        } else {
            $this->load->model('mf_unit_model');

            if($max_id>8){ $batch_no = date('Ymd').$max_id+1; }else{ $batch_no = date('Ymd').'0'.$max_id+1; }

            $this->data['all_recipe']  = $this->mf_recipe_model->get_all_recipe();
            $this->data['all_uom']  = $this->mf_unit_model->getAllUnit();
            $this->data['batch_no']  = $batch_no;

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('add_production');
            $bc = array(array('link' => site_url('mf_production'), 'page' => lang('add_production')), array('link' => '#', 'page' => lang('add_production')));
            $meta = array('page_title' => lang('add_production'), 'bc' => $bc);
            $this->page_construct('mf_production/add', $this->data, $meta);
        }
    }

    function edit($id = NULL) {
        if(!$this->site->route_permission('mf_production_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $this->form_validation->set_rules('batch_no', lang('batch_no'), 'required');
        $this->form_validation->set_rules('recipe_name', lang('recipe_name'), 'required');

        if ($this->form_validation->run() == true) {

            $i = isset($_POST['material_stock_id']) ? sizeof($_POST['material_stock_id']) : 0;            
            $total_cost=0;
            for ($r = 0; $r < $i; $r++) {  

                $recipe_id = $_POST['recipe_id'][$r];
                $material_stock_id = $_POST['material_stock_id'][$r];
                $material_id = $_POST['material_id'][$r];              
                $recipe_dtls_id = $_POST['recipe_dtls_id'][$r];              
                $item_qty = $_POST['qty'][$r]; 
                $item_cost = $_POST['cost'][$r]; 

                if ($material_stock_id && $item_qty ) { 

                    $production[] = array(                              
                        'recipe_id' => $recipe_id,                    
                        'recipe_dtls_id' => $recipe_dtls_id,                    
                        'material_id' => $material_id,                    
                        'material_stock_id' => $material_stock_id,                    
                        'quantity' => $item_qty,    
                        'cost' => $item_cost,    
                        'created_by' => $this->session->userdata('user_id'),               
                        'created_at' =>  date('Y-m-d H:i:s'),                                      
                    ); 
                    $total_cost+=$item_cost;
                   
                }                
            }                        

            $data = array(                                                          
                'target_qty' => $this->input->post('target_qty'),                   
                'actual_output' => $this->input->post('actual_output'),          
                'wasted' => $this->input->post('wasted'),          
                'notes' => $this->input->post('notes'),          
                'total_cost' => $total_cost,          
                'updated_by' => $this->session->userdata('user_id'),               
                'updated_at' =>  date('Y-m-d H:i:s'),               
            );
        }

        if ($this->form_validation->run() == true && $this->mf_production_model->updateProduction($id, $data, $production)) {

            $this->session->set_flashdata('message', lang('production_updated'));
            $this->index();

        } else {

            $this->load->model('mf_unit_model');

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $this->data['all_uom']  = $this->mf_unit_model->getAllUnit();
            $this->data['production_mst'] = $this->mf_production_model->getProductionByID($id);
            $this->data['production_dtls'] = $this->mf_production_model->getProductionDtlsByID($id);

            $this->data['page_title'] = lang('edit_production');
            $bc = array(array('link' => site_url('unit'), 'page' => lang('unit')), array('link' => '#', 'page' => lang('edit_uom')));
            $meta = array('page_title' => lang('edit_uom'), 'bc' => $bc);
            $this->page_construct('mf_production/edit', $this->data, $meta);

        }
    }

    function delete($id = NULL) {
        if(DEMO) {
            $this->session->set_flashdata('error', lang('disabled_in_demo'));
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');
        }
        if(!$this->site->route_permission('mf_production_delete')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $data=array(
            'updated_by' => $this->session->userdata('user_id'),               
            'updated_at' =>  date('Y-m-d H:i:s'), 
            'active_status' =>  0, 
        );
        $data2['active_status']=0;
        if ($this->mf_production_model->deleteProduction($id,$data,$data2)) {
            $this->session->set_flashdata('message', lang("Production successfully deleted"));
            $this->index();
        }
    }

    function load_recipe() {
        
        $recipe_id = $this->input->get('recipe_id', TRUE);
        $recipe_dtls = $this->mf_recipe_model->get_Recipe_for_production($recipe_id);
        
        echo json_encode($recipe_dtls);
        
    }

    function view($id = NULL) { 

        $this->data['production_mst'] = $this->mf_production_model->getProductionByID($id);
        $this->data['production_dtls'] = $this->mf_production_model->getProductionDtlsByID($id);
               
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));        
        $this->data['page_title'] = lang('View Production');
        
        $this->load->view($this->theme . 'mf_production/view', $this->data);
        
    }

    public function approve_production($id){
        $this->data['info'] = $this->mf_production_model->getProductionByID($id);
        $this->data['title'] = 'Approve Production';
        $this->data['id'] = $id;
        $this->load->view($this->theme.'mf_production/approve', $this->data,$id);	
    }

    public function approve($id){
        $info = $this->mf_production_model->getProductionByID($id);
        $dataAppr = array( 'status' => $this->input->post('status') );  
        $data=array(
            'production_id' =>  $id, 
            'store_id' =>  $info->store_id, 
            'product_id' =>  $info->product_id, 
            'quantity' =>  $info->target_qty, 
            'status' => $this->input->post('status'),  
            'type' =>  1,  
            'created_by' => $this->session->userdata('user_id'),               
            'created_at' =>  date('Y-m-d H:i:s'), 
        );
 
        if($info->status==$this->input->post('status'))
        {
            $this->session->set_flashdata('error', lang('Status can not same'));
            $this->index();
        }
        else
        {
            $this->mf_production_model->updateStatusApprove($id,$dataAppr,$data,$info,$this->input->post('status'));	
            $this->session->set_flashdata('message', lang('Updated successfully'));        
            $this->index(); 
        }
    
    }

}
