<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_brands extends MY_Controller
{

    function __construct() {
        parent::__construct();


        if (!$this->loggedIn) {
            redirect('login');
        }
        if(!$this->site->permission('mf_brands'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }

        $this->load->library('form_validation'); 
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {
        if(!$this->site->route_permission('mf_brands_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));       
        $this->data['page_title'] = lang('Brands');
        $bc = array(array('link' => '#', 'page' => lang('Brands')));
        $meta = array('page_title' => lang('Brands'), 'bc' => $bc);
        $this->page_construct('mf_brands/index', $this->data, $meta);

    }  
    function get_brands() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('mf_brands') . ".id as id, " .  
         	$this->db->dbprefix('mf_brands'). ".code,".
         	$this->db->dbprefix('mf_brands').".name, ", FALSE);         
        $this->datatables->from('mf_brands'); 

        $this->datatables->group_by('id');

        $action="<div class='text-center'><div class='btn-group'>";

		if($this->site->route_permission('mf_brands_edit')) {
			$action.="<a href='" . site_url('mf_brands/edit/$1') . "' title='" . lang("edit_category") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
		}
		if($this->site->route_permission('mf_brands_delete')) {
			$action.="<a href='" . site_url('mf_brands/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_category') . "')\" title='" . lang("delete_category") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

        $this->datatables->add_column("Actions", $action, "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
        if(!$this->site->route_permission('mf_brands_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
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

                    redirect("mf_brands/add", 'refresh');

                }

                $photo = $this->upload->file_name;

                $data['image'] = $photo;

                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';

                $config['source_image'] = 'uploads/mf_brands/' . $photo;

                $config['new_image'] = 'uploads/thumbs/' . $photo;

                $config['maintain_ratio'] = TRUE;

                $config['width'] = 110;

                $config['height'] = 110;

                $this->image_lib->clear();

                $this->image_lib->initialize($config); 

                if (!$this->image_lib->resize()) {

                    $this->session->set_flashdata('error', $this->image_lib->display_errors());

                    redirect("mf_brands/add");

                }

            }
        }

        if ($this->form_validation->run() == true && $this->site->insertQuery('mf_brands',$data)) {

            $this->session->set_flashdata('message', lang('Brands successfully added '));
            redirect("mf_brands");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('Add Brand');
            $bc = array(array('link' => site_url('brands'), 'page' => lang('brands')), array('link' => '#', 'page' => lang('Add Brands')));
            $meta = array('page_title' => lang('Add Brand'), 'bc' => $bc);
            $this->page_construct('mf_brands/add', $this->data, $meta);
        }
    }

    function edit($id = NULL) {
        if(!$this->site->route_permission('mf_brands_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
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
                    redirect("mf_brands/edit/{$id}"); 

                }

                $photo = $this->upload->file_name;

                $data['image'] = $photo;

                $this->load->library('image_lib');

                $config['image_library'] = 'gd2';

                $config['source_image'] = 'uploads/mf_brands/' . $photo;

                $config['new_image'] = 'uploads/thumbs/' . $photo;

                $config['maintain_ratio'] = TRUE;

                $config['width'] = 110;

                $config['height'] = 110;

                $this->image_lib->clear();

                $this->image_lib->initialize($config); 

                if (!$this->image_lib->resize()) {

                    $this->session->set_flashdata('error', $this->image_lib->display_errors());

                    redirect("mf_brands/edit/{$id}");

                }

            }

        }

        if ($this->form_validation->run() == true && $this->site->updateQuery('mf_brands',$data,$arra = array('id'=>$id))) {

            $this->session->set_flashdata('message', lang('brands_updated'));
            redirect("mf_brands");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['brands'] = $this->site->findeNameByID('mf_brands','id',$id); 
            $this->data['page_title'] = lang('Edit_Brands');
            $bc = array(array('link' => site_url('brands'), 'page' => lang('brands')), array('link' => '#', 'page' => lang('Edit_Brands')));
            $meta = array('page_title' => lang('Edit_Brands'), 'bc' => $bc);
            $this->page_construct('mf_brands/edit', $this->data, $meta);

        }
    }

    function delete($id = NULL) {
        if(DEMO) {
            $this->session->set_flashdata('error', lang('disabled_in_demo'));
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');
        }

        if(!$this->site->route_permission('mf_brands_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->site->deleteQuery('mf_brands',$arr=array('id' => $id))) {
            $this->session->set_flashdata('message', lang("category_deleted"));
            redirect('brands');
        }
    } 

}
