<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_finish_good_stock extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {            
            redirect('login');            
        }
        if(!$this->site->permission('mf_finish_good_stock'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }
        
        $this->load->library('form_validation');        
        $this->load->model('mf_finish_good_stock_model');        

        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message','warning'=>'warning');
		$this->session->unset_userdata($ses_unset);
    }
  
    
    public function index()  {
        if(!$this->site->route_permission('mf_finish_good_stock_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        $this->data['finish_good_list'] = $this->mf_finish_good_stock_model->getFinishStockList();   

        $this->data['page_title'] = $this->lang->line("stock_list");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('stock_list')));
        $meta = array('page_title' => lang('stock_list'), 'bc' => $bc);
        $this->page_construct('mf_finish_good_stock/stock_list', $this->data, $meta);

    }


    function excel_stock_list()  {

        $matarial_list = $this->mf_finish_good_stock_model->getStockList();  

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
        if(!$this->site->route_permission('mf_finish_good_stock_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}

        $this->data['finish_good_list'] = $this->mf_finish_good_stock_model->getFinishStockList();   
        $this->data['page_title'] = $this->lang->line("stock_list");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('stock_list')));
        $meta = array('page_title' => lang('stock_list'), 'bc' => $bc);
        $this->page_construct('mf_finish_good_stock/stock_adjust', $this->data, $meta);

    }

    public function adjustStock($id)  {

        $this->data['finish_good_info'] = $this->mf_finish_good_stock_model->getStockStoreById($id);   
        $this->data['title'] = 'Adjust Stock';
		$this->data['id'] = $id;
        $this->load->view($this->theme.'mf_finish_good_stock/adjust_stock', $this->data,$id);

    }

    public function adjust_stock($id){

		$finish_good_id = $this->input->post('finish_good_id'); 
		$adjust_type = $this->input->post('adjust_type'); 
		$adjust_qty = $this->input->post('adjust_qty'); 
        $finish_good_store_info = $this->mf_finish_good_stock_model->getStockStoreById($id);  
        $new_store_qty=0;
        if($adjust_type==1 && $adjust_qty>0)
        {
            $new_store_qty=$finish_good_store_info->quantity + $adjust_qty;
        }
        else if($adjust_type==2 && $adjust_qty>0)
        {
            $new_store_qty=$finish_good_store_info->quantity - $adjust_qty;
        }

        if($new_store_qty>=0 &&  $adjust_qty>0){

            $data = array(
                'quantity'   => $new_store_qty		
            );

            $data2 = array(	
                'product_id'   => $finish_good_store_info->product_id,		
                'store_id'   => $finish_good_store_info->store_id,		
                'adjust_type'   => $adjust_type,		
                'quantity'   => $adjust_qty,		
                'type'   => 2,		
                'note'   => $this->input->post('adjust_reason'),		
                'created_by'   => $this->session->userdata('user_id'),		
                'created_at'   => date('Y-m-d H:i:s'),		
            );

            if($this->mf_finish_good_stock_model->adjustStoreStock($id,$data) && $this->mf_finish_good_stock_model->adjustStockLog($data2))
            {
                $this->session->set_flashdata('message', lang('Adjust successfully')); 
            }
            else
            {
                $this->session->set_flashdata('error', lang('Adjust not successfully'));
            }
        } 
        else{
            $this->session->set_flashdata('error', lang('Adjust not successfully'));
        }
			 
		$this->stock_adjust(); 
	
	}

    public function adjust_log_list()  {
        $this->data['finish_goods_stock_adjust_list'] = $this->mf_finish_good_stock_model->getStockLogList();   

        $this->data['page_title'] = $this->lang->line("adjust_log");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('adjust_log')));
        $meta = array('page_title' => lang('adjust_log'), 'bc' => $bc);
        $this->page_construct('mf_finish_good_stock/stock_log_list', $this->data, $meta);

    }
  
}