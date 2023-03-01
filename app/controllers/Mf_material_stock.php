<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_material_stock extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {            
            redirect('login');            
        }
        if(!$this->site->permission('mf_material_stock'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }
        
        $this->load->library('form_validation');        
        $this->load->model('mf_material_stock_model');        
        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';

        $incSequence = null;
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }
  
    
    public function index()  {
        if(!$this->site->route_permission('mf_material_stock_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->data['matarial_list'] = $this->mf_material_stock_model->getStockList();   

        $this->data['page_title'] = $this->lang->line("stock_list");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('stock_list')));
        $meta = array('page_title' => lang('stock_list'), 'bc' => $bc);
        $this->page_construct('mf_material_stock/stock_list', $this->data, $meta);

    }


    function excel_stock_list($brand = null)  {

        $matarial_list = $this->mf_material_stock_model->getStockList($brand);  

        $fileName = "raw_material_stock_list_" . date('Y-m-d_h_i_s') . ".xls"; 

        $fields = array('Name','Brand','Store','Quantity');
        $excelData = implode("\t", array_values($fields)) . "\n"; 

        if(count($matarial_list) > 0){ 
            foreach($matarial_list as $result){ 
                $lineData=array($result->material_name,$result->brand_name,$result->store_name,$result->quantity);
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            }            
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
            
        // Headers for download 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
            
        // Render excel data 
        echo $excelData; 

    }

    public function stock_adjust()  {
        if(!$this->site->route_permission('mf_material_stock_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}

        $this->data['matarial_list'] = $this->mf_material_stock_model->getStockList();   
        $this->data['page_title'] = $this->lang->line("stock_list");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('stock_list')));
        $meta = array('page_title' => lang('stock_list'), 'bc' => $bc);
        $this->page_construct('mf_material_stock/stock_adjust', $this->data, $meta);

    }

    public function adjustStock($id)  {

        $this->data['matarial_info'] = $this->mf_material_stock_model->getStockStoreById($id);   
        $this->data['title'] = 'Adjust Stock';
		$this->data['id'] = $id;
        $this->load->view($this->theme.'mf_material_stock/adjust_stock', $this->data,$id);

    }

    public function adjust_stock($id){

		$material_id = $this->input->post('material_id'); 
		$adjust_type = $this->input->post('adjust_type'); 
		$adjust_qty = $this->input->post('adjust_qty'); 
        $matarial_store_info = $this->mf_material_stock_model->getStockStoreById($id);  
        $matarial_info = $this->mf_material_stock_model->getStockById($material_id);  
        $new_store_qty=0;
        if($adjust_type==1 && $adjust_qty>0)
        {
            $new_store_qty=$matarial_store_info->quantity + $adjust_qty;
            $new_qty=$matarial_info->quantity + $adjust_qty;
        }
        else if($adjust_type==2 && $adjust_qty>0)
        {
            $new_store_qty=$matarial_store_info->quantity - $adjust_qty;
            $new_qty=$matarial_info->quantity - $adjust_qty;
        }

        if($new_store_qty>=0 &&  $adjust_qty>0){

            $data = array(
                'quantity'   => $new_store_qty		
            );
            $data2 = array(
                'quantity'   => $new_qty		
            );
        
            $this->mf_material_stock_model->adjustStoreStock($id,$data) ;	
            $this->mf_material_stock_model->adjustStock($material_id,$data2) ;	

            $data3 = array(
                'material_id'   => $material_id,		
                'material_stock_id'   => $id,		
                'adjust_type'   => $adjust_type,		
                'adjust_qty'   => $adjust_qty,		
                'from_qty'   => $matarial_store_info->quantity,		
                'new_qty'   => $new_store_qty,		
                'adjust_reason'   => $this->input->post('adjust_reason'),		
                'created_by'   => $this->session->userdata('user_id'),		
                'created_at'   => date('Y-m-d H:i:s'),		
            );

            if($this->mf_material_stock_model->adjustStockLog($data3))
            {
                $this->session->set_flashdata('message', lang('Collection delete successfully')); 
            }
            else
            {
                $this->session->set_flashdata('error', lang('Adjust not successfully'));
            }
              
        } 
			 
		redirect('mf_material_stock/stock_adjust'); 
	
	}

    public function adjust_log_list()  {
        $this->data['matarial_list'] = $this->mf_material_stock_model->getStockLogList();   

        $this->data['page_title'] = $this->lang->line("adjust_log");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('adjust_log')));
        $meta = array('page_title' => lang('adjust_log'), 'bc' => $bc);
        $this->page_construct('mf_material_stock/stock_log_list', $this->data, $meta);

    }
  
}