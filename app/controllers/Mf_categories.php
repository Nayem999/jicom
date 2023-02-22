<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mf_categories extends MY_Controller
{

    function __construct() {
        parent::__construct();


        if (!$this->loggedIn) {
            redirect('login');
        }
        if(!$this->site->permission('mf_categories'))
        {
          $this->session->set_flashdata('error', lang('access_denied'));
          redirect();
        }

        $this->load->library('form_validation');
        $this->load->model('mf_categories_model');
        $ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }

    function index() {
        if(!$this->site->route_permission('mf_categories_view')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['categories'] = $this->site->getAllMfCategories();        
        $this->data['page_title'] = lang('categories');
        $bc = array(array('link' => '#', 'page' => lang('categories')));
        $meta = array('page_title' => lang('categories'), 'bc' => $bc);
        $this->page_construct('mf_categories/index', $this->data, $meta);

    } 
    function available_cat() {
        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

        if(!$this->Admin){
            $store_id = $this->session->userdata('store_id');
        } else {
            $store_id = $this->input->post('store_id') ? $this->input->post('store_id') : 0;       
        }

        /* $cats = $this->mf_categories_model->getCategories();
        foreach($cats as $ct){
            $cat_id = $ct->id;
        } */
        $this->data['allcategories'] = $this->mf_categories_model->getCategories($store_id);
        // $this->data['subcategories'] = $this->site->getCategoryByID($cat_id); 

        $this->data['categories'] = $this->site->getAllMfCategories();
        $this->data['stores'] = $this->site->getAllStores();
        $this->data['page_title'] = lang('categories'); 
        $this->data['likeTv'] = $this->mf_categories_model->likeAsValue(); 
        $bc = array(array('link' => '#', 'page' => lang('Available Categories')));
        $meta = array('page_title' => lang('Available Categories'), 'bc' => $bc);
        $this->page_construct('mf_categories/cat_available', $this->data, $meta);

    } 

    function productListByCatId($id){
        if(!$id)
            redirect('mf_categories/available_cat');
        $this->data['products'] = $this->mf_categories_model->getProductByCatId($id);
        $bc = array(array('link' => '#', 'page' => lang('products')));
        $meta = array('page_title' => lang('products'), 'bc' => $bc); 
        $this->page_construct('mf_categories/productList', $this->data, $meta);

    }

    function get_categories() {

        $this->load->library('datatables');

         $this->datatables->select($this->db->dbprefix('mf_categories') . ".id as id, " .  
         	$this->db->dbprefix('mf_categories'). ".code,".
         	$this->db->dbprefix('mf_categories').".name,", FALSE); 
        $this->datatables->from('mf_categories'); 

        $this->datatables->group_by('id');

        $action="<div class='text-center'><div class='btn-group'>";
		if($this->site->route_permission('mf_categories_edit')) {
			$action.="<a href='" . site_url('mf_categories/edit/$1') . "' title='" . lang("edit_category") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
		}
		if($this->site->route_permission('mf_categories_delete')) {
			$action.="<a href='" . site_url('mf_categories/delete/$1') . "' onClick=\"return confirm('" . lang('alert_x_category') . "')\" title='" . lang("delete_category") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>";
		}
        $action.="</div></div>";

        $this->datatables->add_column("Actions", $action, "id, image, code, name");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }

    function add() {
        if(!$this->site->route_permission('mf_categories_add')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
         
        $this->form_validation->set_rules('name', lang('category_name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = array(
                'code' => $this->input->post('code'), 
                'parent_id' => $this->input->post('category'), 
                'name' => $this->input->post('name'));

            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '500';
                $config['max_width'] = '800';
                $config['max_height'] = '800';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->upload->set_flashdata('error', $error);
                    redirect("mf_categories/add");
                }

                $photo = $this->upload->file_name;
                $data['image'] = $photo;

                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/' . $photo;
                $config['new_image'] = 'uploads/thumbs/' . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 50;
                $config['height'] = 50;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);

                if (!$this->image_lib->resize()) {
                    $this->upload->set_flashdata('error', $this->image_lib->display_errors());
                    redirect("mf_categories/add");
                }

            }
        }

        if ($this->form_validation->run() == true && $this->mf_categories_model->addCategory($data)) {

            $this->session->set_flashdata('message', lang('category_added'));
            redirect("mf_categories");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('add_category');
            $bc = array(array('link' => site_url('mf_categories'), 'page' => lang('categories')), array('link' => '#', 'page' => lang('add_category')));
            $meta = array('page_title' => lang('add_category'), 'bc' => $bc);
            $this->page_construct('mf_categories/add', $this->data, $meta);
        }
    }

    function edit($id = NULL) {
        if(!$this->site->route_permission('mf_categories_edit')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
        
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        $getParent = $this->mf_categories_model->getCatByID($id);
        $this->data['getIDParent'] = $this->mf_categories_model->getIdByParen($getParent); 

        $this->form_validation->set_rules('name', lang('category_name'), 'required');

        if ($this->form_validation->run() == true) {
            $data = array(  
                    'code' => $this->input->post('code'),
                    'parent_id' => $this->input->post('category'), 
                    'name' => $this->input->post('name'));

            if ($_FILES['userfile']['size'] > 0) {

                $this->load->library('upload');

                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '500';
                $config['max_width'] = '800';
                $config['max_height'] = '800';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->upload->set_flashdata('error', $error);
                    redirect("mf_categories/add");
                }

                $photo = $this->upload->file_name;
                $data['image'] = $photo;

                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/' . $photo;
                $config['new_image'] = 'uploads/thumbs/' . $photo;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 50;
                $config['height'] = 50;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);

                if (!$this->image_lib->resize()) {
                    $this->upload->set_flashdata('error', $this->image_lib->display_errors());
                    redirect("mf_categories/edit");
                }

            }

        }

        if ($this->form_validation->run() == true && $this->mf_categories_model->updateCategory($id, $data)) {

            $this->session->set_flashdata('message', lang('category_updated'));
            redirect("mf_categories");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['category'] = $this->site->getMfCategoryByID($id);
            $this->data['categories'] = $this->site->getAllMfcategories();
            $this->data['page_title'] = lang('new_category');
            $bc = array(array('link' => site_url('categories'), 'page' => lang('categories')), array('link' => '#', 'page' => lang('edit_category')));
            $meta = array('page_title' => lang('edit_category'), 'bc' => $bc);
            $this->page_construct('mf_categories/edit', $this->data, $meta);

        }
    }

    function delete($id = NULL) {
        if(DEMO) {
            $this->session->set_flashdata('error', lang('disabled_in_demo'));
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');
        }

        if(!$this->site->route_permission('mf_categories_delete')) {
			$this->session->set_flashdata('error', lang('access_denied'));
			redirect();
		}
  
        if ($this->input->get('id')) {
            $id = $this->input->get('id');
        }

        if ($this->mf_categories_model->deleteCategory($id)) {
            $this->session->set_flashdata('message', lang("category_deleted"));
            redirect('mf_categories');
        }
    }

    function import() {
        if (!$this->Admin) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect('pos');
        }
        $this->load->helper('security');
        $this->form_validation->set_rules('userfile', lang("upload_file"), 'xss_clean');

        if ($this->form_validation->run() == true) {
            if (DEMO) {
                $this->session->set_flashdata('warning', lang("disabled_in_demo"));
                redirect('pos');
            }

            if (isset($_FILES["userfile"])) {

                $this->load->library('upload');

                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'csv';
                $config['max_size'] = '500';
                $config['overwrite'] = TRUE;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect("mf_categories/import");
                }


                $csv = $this->upload->file_name;

                $arrResult = array();
                $handle = fopen("uploads/" . $csv, "r");
                if ($handle) {
                    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $arrResult[] = $row;
                    }
                    fclose($handle);
                }
                array_shift($arrResult);

                $keys = array('code', 'name');

                $final = array();
                foreach ($arrResult as $key => $value) {
                    $final[] = array_combine($keys, $value);
                }

                if (sizeof($final) > 1001) {
                    $this->session->set_flashdata('error', lang("more_than_allowed"));
                    redirect("mf_categories/import");
                }

                foreach ($final as $csv_pr) {
                    if($this->site->getCategoryByCode($csv_pr['code'])) {
                        $this->session->set_flashdata('error', lang("check_category") . " (" . $csv_pr['code'] . "). " . lang("category_already_exist"));
                        redirect("mf_categories/import");
                    }
                    $data[] = array('code' => $csv_pr['code'], 'name' => $csv_pr['name']);
                }
            }

        }

        if ($this->form_validation->run() == true && $this->mf_categories_model->add_categories($data)) {

            $this->session->set_flashdata('message', lang("categories_added"));
            redirect('mf_categories');

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('import_categories');
            $bc = array(array('link' => site_url('products'), 'page' => lang('products')), array('link' => site_url('mf_categories'), 'page' => lang('categories')), array('link' => '#', 'page' => lang('import_categories')));
            $meta = array('page_title' => lang('import_categories'), 'bc' => $bc);
            $this->page_construct('mf_categories/import', $this->data, $meta);

        }
    } 

}
