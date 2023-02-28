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


}
