<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_Controller
{

    function __construct() {
        parent::__construct();

        if (!$this->loggedIn) {
            redirect('admin/login');
        }     

        $this->load->library('form_validation'); 
        
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);
    }
    function index() {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Gallery list');
        $bc = array(array('link' => '#', 'page' => lang('page')));
        $meta = array('page_title' => lang('Gallery list'), 'bc' => $bc);
        $this->page_construct('gallery/index', $this->data, $meta);
    }
    function get_gallery(){ 
        $this->load->library('datatables');
        $this->datatables->select(
            $this->db->dbprefix('gallery') . ".id as id ,".  
            $this->db->dbprefix('gallery') . ".file_name,".
            $this->db->dbprefix('gallery_album') . ".title as gatitle,".
            $this->db->dbprefix('gallery') . ".title as gtitle,".
            $this->db->dbprefix('gallery') . ".order_by as ord,". 
            $this->db->dbprefix('gallery') . ".created_at,". 
            $this->db->dbprefix('gallery') . ".status,",false);
        $this->datatables->from('gallery');   
        $this->datatables->join('gallery_album','gallery_album.id=gallery.album_id','left');
        $this->fild = ''; 
        $this->fild .=  "  
        <a href='" . site_url('admin/gallery/edit/$1/') . "' class='tip btn btn-warning btn-xs' title='".$this->lang->line("Edit")."'><i class='fa fa-edit'></i></a>   
        <a href='" . site_url('admin/gallery/delete/$1') . "' onClick=\"return confirm('You are going to delete page, please click ok to delete')\" class='tip btn btn-danger btn-xs' title='".$this->lang->line("Delete")."'><i class='fa fa-trash-o'></i></a>";  
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>        
        ".$this->fild."</div></div>", "id");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();

    }
 
    function add(){  
        $this->form_validation->set_rules('status', 'status', 'required');   
        if ($this->form_validation->run() == true) {   
            if(!empty($_FILES['userfile']['name'])){
                $filesCount = count($_FILES['userfile']['name']); 
                for($i = 0; $i < $filesCount; $i++){
                    $_FILES['productImage']['name'] = $_FILES['userfile']['name'][$i];
                    $_FILES['productImage']['type'] = $_FILES['userfile']['type'][$i];
                    $_FILES['productImage']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
                    $_FILES['productImage']['error'] = $_FILES['userfile']['error'][$i];
                    $_FILES['productImage']['size'] = $_FILES['userfile']['size'][$i];

                    $uploadPath = 'uploads/gallery/';
                    $config['max_size'] = '500000';
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
                            'title' => $this->input->post('title'), 
                            'album_id' => $this->input->post('album_id'), 
                            'order_by' => $this->input->post('order_by'),                         
                            'file_name' => $uploadData[$i]['file_name'],
                            'status' => $this->input->post('status'),
                            'created_by' => $this->session->userdata('user_id'),
                            'created_at' => date('Y-m-d H:i:s')  
                        );  
                    } 
                }  
            }   
            if($this->site->insertBatch('gallery',$dataArraay)){
                $this->session->set_flashdata('message', 'Successfully added ');
                redirect('admin/gallery/');
            }
            $this->session->set_flashdata('error', 'Please check your data!');
                redirect('admin/gallery/'); 
        }

        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Add gallery'); 
        $bc = array(array('link' => '#', 'page' => lang('content')));
        $meta = array('page_title' => lang('Add gallery'), 'bc' => $bc);
        $this->page_construct('gallery/add', $this->data, $meta);
    }

    function edit($id){    
        $this->form_validation->set_rules('status', 'status', 'required');  
        $this->data['data'] = $this->site->whereRow('gallery','id',$id);
        if ($this->form_validation->run() == true) {
            if($_FILES['userfile']['size'] > 0) {
              $this->load->library('upload');
              $config['upload_path'] = 'uploads/gallery';
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
              $config['max_size'] = '6000';
              $config['max_width'] = '854';
              $config['max_height'] = '484';
              $config['overwrite'] = FALSE;
              $config['encrypt_name'] = TRUE;
              $this->upload->initialize($config);              
              if (!$this->upload->do_upload()) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error); 
                redirect('admin/gallery');                    
                }
             $photo = $this->upload->file_name ;
            }else{$photo='';}

            $data = array(   
                'title' => $this->input->post('title'),
                'album_id' => $this->input->post('album_id'),
                'order_by' => $this->input->post('order_by'),
                'status' => $this->input->post('status')
            );
            if($photo){
                $data['file_name'] = $photo ;
            } 

            if($this->site->updateQuery('gallery',$data, array('id'=>$id))){
                $this->session->set_flashdata('message', 'Successfully updated ');
                redirect('admin/gallery/');
            }
        
            $this->session->set_flashdata('error', 'Please check your data!');
            redirect('admin/gallery/'); 
        }
        $this->data['id'] = $id;
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Edit gallery'); 
        $bc = array(array('link' => '#', 'page' => lang('content')));
        $meta = array('page_title' => lang('Edit gallery'), 'bc' => $bc);        
        $this->page_construct('gallery/edit', $this->data, $meta);
    }
    function album(){    
        $this->form_validation->set_rules('title', 'Album', 'required');   
        $this->data['albums'] = $this->site->selectQuery('gallery_album');
        $this->data['album'] = array();
        if ($this->form_validation->run() == true) {
            if($_FILES['userfile']['size'] > 0) {
              $this->load->library('upload');
              $config['upload_path'] = 'uploads/gallery';
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
              $config['max_size'] = '6000';
              $config['max_width'] = '300';
              $config['max_height'] = '320';
              $config['overwrite'] = FALSE;
              $config['encrypt_name'] = TRUE;
              $this->upload->initialize($config);              
              if (!$this->upload->do_upload()) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error); 
                redirect('admin/gallery/album');                    
                }
             $photo = $this->upload->file_name ;
            } 

            $data = array(   
                'title' => $this->input->post('title'),  
                'created_at' => date('Y-m-d H:i:s') 
            );
            if($photo){
                $data['thumb_image'] = $photo;
            } 

            if($this->site->insertQuery('gallery_album',$data)){
                $this->session->set_flashdata('message', 'Successfully Album Created');
                redirect('admin/gallery/album');
            }
        
            $this->session->set_flashdata('error', 'Please check your data!');
            redirect('admin/gallery/album'); 
        } 
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Album'); 
        $bc = array(array('link' => '#', 'page' => lang('content')));
        $meta = array('page_title' => lang('Album'), 'bc' => $bc);        
        $this->page_construct('gallery/album', $this->data, $meta);
    }
    function album_edit($id){    
        $this->form_validation->set_rules('title', 'Album', 'required');   
        $this->data['albums'] = $this->site->selectQuery('gallery_album');
        $this->data['album'] = $this->site->whereRow('gallery_album','id',$id);
        if ($this->form_validation->run() == true) {
            if($_FILES['userfile']['size'] > 0) {
                $this->load->library('upload');
                $config['upload_path'] = 'uploads/gallery';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '6000';
                $config['max_width'] = '300';
                $config['max_height'] = '320';
                $config['overwrite'] = FALSE;
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);              
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error); 
                    redirect('admin/gallery/album');                    
                }
                $photo = $this->upload->file_name;
            } 

            $data = array(   
                'title' => $this->input->post('title'),  
                'created_at' => date('Y-m-d H:i:s') 
            );
            if($photo){
                $data['thumb_image'] = $photo;
            } 

            if($this->site->updateQuery('gallery_album',$data,array('id'=>$id))){
                $this->session->set_flashdata('message', 'Successfully Album Update');
                redirect('admin/gallery/album');
            }
        
            $this->session->set_flashdata('error', 'Please check your data!');
            redirect('admin/gallery/album'); 
        } 
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Album'); 
        $bc = array(array('link' => '#', 'page' => lang('content')));
        $meta = array('page_title' => lang('Album'), 'bc' => $bc);        
        $this->page_construct('gallery/album', $this->data, $meta);
    }
    function gallery() {
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('Gallery list');
        $bc = array(array('link' => '#', 'page' => lang('page')));
        $meta = array('page_title' => lang('Gallery list'), 'bc' => $bc);
        $this->page_construct('gallery/index', $this->data, $meta);
    }  

    function album_delete($id){ 
        $attac =  $this->site->whereRow('gallery_album','id',$id);   
        if($this->site->deleteQuery('gallery_album',array('id' => $id))){
            if($attac->thumb_image !=''){  
                if(file_exists(FCPATH."uploads/gallery/".$attac->thumb_image)){
                   unlink(FCPATH."uploads/gallery/".$attac->thumb_image); 
                } 
            }
            $this->session->set_flashdata('message','Delete Successfully'); 
        }else{
            $this->session->set_flashdata('error','Not deleted');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    }
    function delete($id){ 
        $attac =  $this->site->whereRow('gallery','id',$id);   
        if($this->site->deleteQuery('gallery',array('id' => $id))){
            if($attac->file_name !=''){  
                if(file_exists(FCPATH."uploads/gallery/".$attac->file_name)){
                   unlink(FCPATH."uploads/gallery/".$attac->file_name); 
                } 
            }
            $this->session->set_flashdata('message','Delete Successfully'); 
        }else{
            $this->session->set_flashdata('error','Not deleted');
        }
        redirect($_SERVER["HTTP_REFERER"]);
    } 
}