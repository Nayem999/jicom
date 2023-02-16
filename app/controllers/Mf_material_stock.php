<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_material_stock extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {            
            redirect('login');            
        }
        
        $this->load->library('form_validation');
        
        $this->load->model('mf_material_stock_model');
        
        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';

        $incSequence = null;
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }
  
    
    function index() { 
        
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['stores'] = $this->site->getAllStores();
        $this->data['page_title'] = lang('purchases');
        
        $bc = array(
            array(
                'link' => '#',
                'page' => lang('purchases')
            )
        );
        
        $meta = array(
            'page_title' => lang('purchases'),
            'bc' => $bc
        );
        
        $this->page_construct('mf_purchases/index', $this->data, $meta);
        
    }
    
    public function stock_list()  {
        $this->data['matarial_list'] = $this->mf_material_stock_model->getStockList();   

        $this->data['page_title'] = $this->lang->line("stock_list");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('stock_list')));
        $meta = array('page_title' => lang('stock_list'), 'bc' => $bc);
        $this->page_construct('mf_material_stock/stock_list', $this->data, $meta);

    }


    function excel_stock_list()  {

        $matarial_list = $this->mf_material_stock_model->getStockList();  

        $fileName = "raw_material_stock_list_" . date('Y-m-d_h_i_s') . ".xlsx"; 

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
  
}