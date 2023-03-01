<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Mf_report extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if ( ! $this->loggedIn) {
            redirect('login');
        }
        if(!$this->site->permission('mf_report'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }
        $this->load->model('Mf_report_model');
        $this->load->library('form_validation');
 
        
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }
    
    function index() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : date('Y-m-d');  
        $end_date = $this->input->post('end_date') ? $this->input->post('end_date') : date('Y-m-d');  

        $this->data['start_date'] = $start_date;
        $this->data['end_date'] = $end_date;
        $results = array(); 
        $this->data['results'] = $results; 
        $this->data['page_title'] = $this->lang->line("daily_sales");
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('daily_sales')));
        $meta = array('page_title' => lang('Master Sales Report'), 'bc' => $bc);
       
        $this->page_construct('reports/sales', $this->data, $meta);
    }


    public function raw_material()
    {
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('raw_material_report')));
        $meta = array('page_title' => lang('Raw material Report'), 'bc' => $bc);

        $this->data['end_date'] = $start_date = $this->input->post('start_date') ? $this->input->post('start_date') : date('Y-m-d');  
        $this->data['start_date'] =  $end_date = $this->input->post('end_date') ? $this->input->post('end_date') : date('Y-m-d');

        // all branch name query here
        $this->data["brands"] = $this->db->select("id,name")->from('mf_brands')->get()->result();

        $brandId = '';
        if($this->input->server('REQUEST_METHOD') === "POST"){
            $brandId = $this->input->post('brand_id');
        }

        $mfReportModal = new Mf_report_model();

        $this->data["materials"] = $brandId?$mfReportModal::getMaterialData($brandId): $mfReportModal::getMaterialData();

        $this->page_construct('mf_report/raw_material',$this->data, $meta);
    }


    public function exp_material_report($brandId=null)  {

        $fields = array('SL', 'NAME', 'BRAND','STORE','QTY');

        $fileName = "raw_material_report_" . date('Y-m-d_h_i_s') . ".xls"; 

        $excelData = implode("\t", array_values($fields)) . "\n"; 

        $mfReportModal = new Mf_report_model();

        $items = $brandId?$mfReportModal::getMaterialData($brandId): $mfReportModal::getMaterialData();

        if($brandId){
            if(isset($_GET['brand_name'])):
            $excelData .= implode("\t", array_values([$_GET['brand_name']])) . "\n"; 
            endif;
        }

        if(count($items) > 0 ):
            $i = 0;
            foreach ($items as $key => $item):

                $lineData = 
                [
                    ++$i,
                    $item->name,
                    $item->brand_name,
                    $item->store_name,
                    $item->qty . ' ' . @$item->unit,
                ];

                $excelData .= implode("\t", array_values($lineData)) . "\n"; 

            endforeach;

        endif;

        header("Content-Type: application/vnd.ms-excel"); 

        header("Content-Disposition: attachment; filename=\"$fileName\""); 

        echo $excelData;

    }

    public function raw_material_purchase()
    {
        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('raw_material_purchase_report')));
        $meta = array('page_title' => lang('Raw material Purchase Report'), 'bc' => $bc);

        $this->data['end_date'] =  $this->input->post('start_date') ? $this->input->post('start_date') : date('Y-m-d');  

        $this->data['start_date'] =  $this->input->post('end_date') ? $this->input->post('end_date') : date('Y-m-d');

        $mfPurchaseReportModal = new Mf_report_model();

        $this->data["materials"] = $mfPurchaseReportModal::getPurchaseData($this->data['start_date'],$this->data['end_date']);



        $this->page_construct('mf_report/raw_material_purchase',$this->data, $meta);

    }

    public function exp_material_purchase_report($stDate=null, $endDate=null)  {

        $fields = array('SL', 'SUPPLIER Name ', 'STORE NAME','TOTAL','PAID AMOUNT','DUE AMOUNT');

        $start_date = $stDate ? $stDate : date('Y-m-d');  

        $end_date = $endDate ? $endDate : date('Y-m-d');

        $fileName = "raw_material_purchase_report_" . date('Y-m-d_h_i_s') . ".xls"; 

        $excelData = implode("\t", array_values($fields)) . "\n"; 

        $mfPurchaseReportModal = new Mf_report_model();

        $items = $mfPurchaseReportModal::getPurchaseData($start_date, $end_date);

        if(count($items) > 0 ):
            $i = 0;
            foreach ($items as $key => $item):

                $lineData = 
                [
                    ++$i,
                    $item->supplier_name,
                    $item->store_name,
                    $item->total,
                    $item->paid,
                    $item->deu,
                ];

                $excelData .= implode("\t", array_values($lineData)) . "\n"; 

            endforeach;

        endif;

        header("Content-Type: application/vnd.ms-excel"); 

        header("Content-Disposition: attachment; filename=\"$fileName\""); 

        echo $excelData;

    }

    public function raw_material_stock()
    {
        $this->load->model('Mf_material_stock_model');

        $bc = array(array('link' => '#', 'page' => lang('reports')), array('link' => '#', 'page' => lang('raw_material_stock_report')));

        $meta = array('page_title' => lang('Raw material Stock Report'), 'bc' => $bc);

        $brandId = '';
        if($this->input->server('REQUEST_METHOD') === "POST"){
            $brandId = $this->input->post('brand_id');
        }

        $stockModel = new Mf_material_stock_model();

        $this->data['matarial_items'] = $stockModel->getStockList($brandId); 

        $this->data["brands"] = $this->db->select("id,name")->from('mf_brands')->get()->result();

        $this->page_construct('mf_report/raw_material_stock',$this->data, $meta);
    }


}
