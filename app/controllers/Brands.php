<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends MY_Controller
{

    function __construct() {
        parent::__construct();


        if (!$this->loggedIn) {
            redirect('login');
        }

        $this->load->library('form_validation'); 
    }

    function index() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('Brands');
        $bc = array(array('link' => '#', 'page' => lang('Brands')));
        $meta = array('page_title' => lang('Brands'), 'bc' => $bc);
        $this->page_construct('brands/index', $this->data, $meta);

    }  
    function get_brands() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('brands') . ".id as id, " .  
         	$this->db->dbprefix('brands'). ".code,".
         	$this->db->dbprefix('brands').".name, ", FALSE);         
        $this->datatables->from('brands'); 

        $this->datatables->group_by('id');

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
             
            <a href='" . site_url('brands/edit/$1') . "' title='" . lang("edit_category") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a> 
            <a href='" . site_url('brands/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_category') . "')\" title='" . lang("delete_category") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
         
        $this->form_validation->set_rules('name', lang('Brands Name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'code' => $this->input->post('code'),  
                'name' => $this->input->post('name')
            );

            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'uploads/brands';

                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $config['max_size'] = '500';

                $config['max_width'] = '800';

                $config['max_height'] = '800';

                $config['overwrite'] = FALSE;

                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('error', $error);

                    redirect("brands/add", 'refresh');

                }

                $photo = $this->upload->file_name;

                $data['image'] = $photo;

                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';

                $config['source_image'] = 'uploads/brands/' . $photo;

                $config['new_image'] = 'uploads/thumbs/' . $photo;

                $config['maintain_ratio'] = TRUE;

                $config['width'] = 110;

                $config['height'] = 110;

                $this->image_lib->clear();

                $this->image_lib->initialize($config); 

                if (!$this->image_lib->resize()) {

                    $this->session->set_flashdata('error', $this->image_lib->display_errors());

                    redirect("brands/add");

                }

            }
        }

        if ($this->form_validation->run() == true && $this->site->insertQuery('brands',$data)) {

            $this->session->set_flashdata('message', lang('Brands successfully added '));
            redirect("brands");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('Add Brand');
            $bc = array(array('link' => site_url('brands'), 'page' => lang('brands')), array('link' => '#', 'page' => lang('Add Brands')));
            $meta = array('page_title' => lang('Add Brand'), 'bc' => $bc);
            $this->page_construct('brands/add', $this->data, $meta);
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
                    'code' => $this->input->post('code'), 
                    'name' => $this->input->post('name')
                );

            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'uploads/brands';

                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $config['max_size'] = '500';

                $config['max_width'] = '800';

                $config['max_height'] = '800';

                $config['overwrite'] = FALSE;

                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {

                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('error', $error);
                    redirect("brands/edit/{$id}"); 

                }

                $photo = $this->upload->file_name;

                $data['image'] = $photo;

                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';

                $config['source_image'] = 'uploads/brands/' . $photo;

                $config['new_image'] = 'uploads/thumbs/' . $photo;

                $config['maintain_ratio'] = TRUE;

                $config['width'] = 110;

                $config['height'] = 110;

                $this->image_lib->clear();

                $this->image_lib->initialize($config); 

                if (!$this->image_lib->resize()) {

                    $this->session->set_flashdata('error', $this->image_lib->display_errors());

                    redirect("brands/edit/{$id}");

                }

            }

        }

        if ($this->form_validation->run() == true && $this->site->updateQuery('brands',$data,$arra = array('id'=>$id))) {

            $this->session->set_flashdata('message', lang('brands_updated'));
            redirect("brands");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['brands'] = $this->site->findeNameByID('brands','id',$id); 
            $this->data['page_title'] = lang('Edit_Brands');
            $bc = array(array('link' => site_url('brands'), 'page' => lang('brands')), array('link' => '#', 'page' => lang('Edit_Brands')));
            $meta = array('page_title' => lang('Edit_Brands'), 'bc' => $bc);
            $this->page_construct('brands/edit', $this->data, $meta);

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

        if ($this->site->deleteQuery('brands',$arr=array('id' => $id))) {
            $this->session->set_flashdata('message', lang("category_deleted"));
            redirect('brands');
        }
    } 

}
