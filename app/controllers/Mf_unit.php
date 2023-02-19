<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_unit extends MY_Controller
{

    function __construct() {
        parent::__construct();


        if (!$this->loggedIn) {
            redirect('login');
        }

        $this->load->library('form_validation');
        $this->load->model('mf_unit_model');
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('unit');
        $bc = array(array('link' => '#', 'page' => lang('unit')));
        $meta = array('page_title' => lang('unit'), 'bc' => $bc);
        $this->page_construct('mf_unit/index', $this->data, $meta);

    } 

    function get_unit() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('mf_unit') . ".id as id, " .  
         	$this->db->dbprefix('mf_unit'). ".name,".
         	$this->db->dbprefix('mf_unit').".description,", FALSE); 
        $this->datatables->from('mf_unit'); 

        $this->datatables->group_by('id');

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
        <a href='" . site_url('mf_unit/edit/$1') . "' title='" . lang("edit_uom") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a> 
        <a href='" . site_url('mf_unit/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_unit') . "')\" title='" . lang("delete_unit") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
         
        $this->form_validation->set_rules('name', lang('uom_name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'created_by' =>  $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            );
        }

        if ($this->form_validation->run() == true && $this->mf_unit_model->addUnit($data)) {

            $this->session->set_flashdata('message', lang('category_added'));
            redirect("mf_unit");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('add_uom');
            $bc = array(array('link' => site_url('mf_unit'), 'page' => lang('unit')), array('link' => '#', 'page' => lang('add_uom')));
            $meta = array('page_title' => lang('add_uom'), 'bc' => $bc);
            $this->page_construct('mf_unit/add', $this->data, $meta);
        }
    }

    function edit($id = NULL) {
        if (!$this->Admin) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect('pos');
        }
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $this->form_validation->set_rules('name', lang('uom_name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = array(  
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at' => date('Y-m-d H:i:s')
            );
        }

        if ($this->form_validation->run() == true && $this->mf_unit_model->updateUnit($id, $data)) {

            $this->session->set_flashdata('message', lang('category_updated'));
            redirect("mf_unit");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['unit_info'] = $this->mf_unit_model->getUnitByID($id);
 
            $this->data['page_title'] = lang('new_category');
            $bc = array(array('link' => site_url('unit'), 'page' => lang('unit')), array('link' => '#', 'page' => lang('edit_uom')));
            $meta = array('page_title' => lang('edit_uom'), 'bc' => $bc);
            $this->page_construct('mf_unit/edit', $this->data, $meta);

        }
    }

    function delete($id = NULL) {
        if(DEMO) {
            $this->session->set_flashdata('error', lang('disabled_in_demo'));
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');
        }
        if (!$this->Admin) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect('pos');
        }
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->mf_unit_model->deleteUnit($id)) {
            $this->session->set_flashdata('message', lang("Unit Deleted"));
            redirect('mf_unit');
        }
    }

}
