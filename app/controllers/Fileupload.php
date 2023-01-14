<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Fileupload extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (!$this->loggedIn) {
            redirect('admin/login');
        }     

        $this->load->library('form_validation'); 
    }
    function index() {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('File Uploader list');
        $this->data['data'] = $this->site->selectQuery('fileupload');
        $bc = array(array('link' => '#', 'page' => lang('page')));
        $meta = array('page_title' => lang('File Uploader list'), 'bc' => $bc);
        $this->page_construct('fileupload/index', $this->data, $meta);
    }
    function get_gallery(){ 
        $this->load->library('datatables');
        $this->datatables->select(
            $this->db->dbprefix('fileupload') . ".id as id,". 
            $this->db->dbprefix('fileupload') . ".file_name,".
            $this->db->dbprefix('fileupload') . ".url,status,",false);
        $this->datatables->from('fileupload');   
        $this->fild = ''; 
        $this->fild .=  "    
        <a href='" . site_url('admin/fileupload/delete/$1') . "' onClick=\"return confirm('Are you sure to delete?')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("Delete")."'><i class='fas fa-trash'></i></a>";  
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>        
        ".$this->fild."</div></div>", "id");
        $this->datatables->unset_column('id');
        $data = $this->db->get(); 
        $this->datatables->generate();
    }
 
    function add(){  
        $dataArraay = array();
        $this->form_validation->set_rules('status', 'status', 'required');   
        if ($this->form_validation->run() == true) {   
            /*if(!empty($_FILES['userfile']['name'])){
                $filesCount = count($_FILES['userfile']['name']); 
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['productImage']['name'] = $_FILES['userfile']['name'][$i];
                    $_FILES['productImage']['type'] = $_FILES['userfile']['type'][$i];
                    $_FILES['productImage']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
                    $_FILES['productImage']['error'] = $_FILES['userfile']['error'][$i];
                    $_FILES['productImage']['size'] = $_FILES['userfile']['size'][$i];

                    $uploadPath = 'uploads/fileupload/';
                    $config['max_size'] = '65536';
                    $config['max_width'] = '854';
                    $config['max_height'] = '484';
                    $config['upload_path'] = $uploadPath;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['overwrite'] = FALSE;
                    $config['encrypt_name'] = TRUE; 
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config); 
                    if($this->upload->do_upload('productImage')){
                        $fileData = $this->upload->data();
                        $uploadData[$i]['file_name'] = $fileData['file_name'];
                        $dataArraay[] = array(                           
                            'file_name' => $uploadData[$i]['file_name'],
                            'status'  => $this->input->post('status'),
                            'url' => base_url('uploads/fileupload/').$uploadData[$i]['file_name'] 
                        );  
                    } 
                }  
            } */
            if(!empty($_FILES['userfile']['name'])){ 
                $this->load->library('upload'); 
                $config['upload_path'] = 'uploads/fileupload';
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xls|zip';
                $config['max_size'] = '5120';
                $config['max_width'] = '85400';
                $config['max_height'] = '48400';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);              
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error); 
                    redirect('admin/fileupload');                    
                }
                $photo = $this->upload->file_name;
                $data = array(                           
                    'file_name' => $photo,
                    'status'  => $this->input->post('status'),
                    'url' => 'uploads/fileupload/'.$photo 
                ); 
                if($this->site->insertQuery('fileupload',$data)){
                    $this->session->set_flashdata('message', 'Successfully added ');
                    redirect('admin/fileupload/');
                }else{
                    $this->session->set_flashdata('error', 'Please check your data!');
                redirect('admin/fileupload/');
                }
            }   
             
        }

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Add File Uploader'); 
        $bc = array(array('link' => '#', 'page' => lang('content')));
        $meta = array('page_title' => lang('Add File Uploader'), 'bc' => $bc);
        $this->page_construct('fileupload/add', $this->data, $meta);
    } 
    function delete($id){ 
        $attac =  $this->site->whereRow('fileupload','id',$id);   
        if($this->site->deleteQuery('fileupload',array('id' => $id))){
            if($attac->file_name !=''){  
                if(file_exists(FCPATH."uploads/fileupload/".$attac->file_name)){
                   unlink(FCPATH."uploads/fileupload/".$attac->file_name); 
                } 
            }
            $this->session->set_flashdata('message','Delete Successfully'); 
        }else{
            $this->session->set_flashdata('error','Not deleted');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    } 
}