<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller
{

    function __construct() {
        parent::__construct();


        if (!$this->loggedIn) {
            redirect('login');
        }

        $this->load->library('form_validation'); 
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('Group');
        $bc = array(array('link' => '#', 'page' => lang('Group')));
        $meta = array('page_title' => lang('Group'), 'bc' => $bc);
        $this->page_construct('group/index', $this->data, $meta);

    } 
     
    function get_groups() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('groups') . ".id as id, " .  
         	$this->db->dbprefix('groups'). ".name,".
         	$this->db->dbprefix('groups').".description , ", FALSE);         
        $this->datatables->from('groups'); 

        $this->datatables->group_by('id');

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
             
            <a href='" . site_url('group/edit/$1') . "' title='" . lang("edit_category") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a> 
            <a href='" . site_url('group/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_category') . "')\" title='" . lang("delete_category") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
         
        $this->form_validation->set_rules('name', lang('Group Name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')  
            );
        }

        if ($this->form_validation->run() == true && $this->site->insertQuery('groups',$data)) {

            $this->session->set_flashdata('message', lang('group_added'));
            $this->index();

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('add_group');
            $bc = array(array('link' => site_url('group'), 'page' => lang('group')), array('link' => '#', 'page' => lang('add_group')));
            $meta = array('page_title' => lang('add_group'), 'bc' => $bc);
            $this->page_construct('group/add', $this->data, $meta);
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

        $this->form_validation->set_rules('name', lang('category_name'), 'required'); 

        if ($this->form_validation->run() == true) {
            $data = array(  
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'), 
                );
        }

        if ($this->form_validation->run() == true && $this->site->updateQuery('groups',$data,$arra = array('id'=>$id))) {

            $this->session->set_flashdata('message', lang('group_updated'));
            $this->index();

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['groups'] = $this->site->findeNameByID('groups','id',$id); 
            $this->data['page_title'] = lang('edit_group');
            $bc = array(array('link' => site_url('edit_group'), 'page' => lang('edit_group')), array('link' => '#', 'page' => lang('edit_group')));
            $meta = array('page_title' => lang('edit_group'), 'bc' => $bc);
            $this->page_construct('group/edit', $this->data, $meta);

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

        if ($this->site->deleteQuery('groups',$arr=array('id' => $id))) {
            $this->session->set_flashdata('message', lang("category_deleted"));
            $this->index();
        }
    } 

}
