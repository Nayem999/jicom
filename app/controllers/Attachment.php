<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Attachment extends MY_Controller
{
	
	function __construct(){
		parent::__construct();
        if (! $this->loggedIn) {
            redirect('login');
        } 
        $this->load->library('form_validation');
	}

	public function index() {  
        $this->data['page_title'] = lang('List Name');
        $bc = array(array('link' => '#', 'page' => lang('List Name')));
        $meta = array('page_title' => lang('List Name'), 'bc' => $bc);
        $this->page_construct('attachment/index', $this->data, $meta);
    }
    public function get_persons() {
        $this->load->library('datatables');
        $this->datatables->select(
            $this->db->dbprefix('persons').".id as aid,".
            $this->db->dbprefix('persons').".name,".
            $this->db->dbprefix('persons').".phone,".
            $this->db->dbprefix('persons').".email,".
            $this->db->dbprefix('persons').".cf1,". 
            $this->db->dbprefix('persons').".cf2,", FALSE);     
        $this->datatables->from('persons'); 
 
        $actions = "<a href='" . site_url('attachment/edit_person/$1') . "' title='" . lang("Edit") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>
            <a href='" . site_url('attachment/delete/$1') . "' onClick=\"return confirm('" . lang('You are going to delete this, please click ok to delete') . "')\" title='" . lang("Delete") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>"; 

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'> $actions          
            </div></div>", "aid"); 
        $this->datatables->unset_column('aid');
        echo $this->datatables->generate();  
    }
    public function add_person(){   
        $this->form_validation->set_rules('name', 'name', 'required'); 
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'cf1' => $this->input->post('cf1'),
            'cf2' => $this->input->post('cf2'), 
        );  
        if(($this->form_validation->run() == true) &&($this->site->insertQuery('persons',$data))){
            $this->session->set_flashdata('message', 'Persons Added Successfully');
            redirect('attachment');
        }  
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Add Name';
        $bc = array(array('link' => site_url('attachment'), 'page' => 'List Name'), array('link' => '#', 'page' => 'New Name'));
        $meta = array('page_title' => 'Add Name', 'bc' => $bc); 
        $this->page_construct('attachment/add_person', $this->data, $meta); 
    }
    public function edit_person($id){   
        $this->form_validation->set_rules('name', 'name', 'required'); 
        $this->data['person'] = $this->site->whereRow('persons', 'id', $id); 
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'cf1' => $this->input->post('cf1'),
            'cf2' => $this->input->post('cf2'), 
        );  
        if(($this->form_validation->run() == true) &&($this->site->updateQuery('persons',$data,array('id'=>$id)))){
            $this->session->set_flashdata('message', 'Name updated successfully');
            redirect('attachment');
        }  
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Edit Persons';
        $bc = array(array('link' => site_url('attachment'), 'page' => 'Persons List'), array('link' => '#', 'page' => 'Edit Persons'));
        $meta = array('page_title' => 'Edit Persons', 'bc' => $bc); 
        $this->page_construct('attachment/edit_person', $this->data, $meta); 
    } 
    public function delete($id){ 
        if($this->site->deleteQuery('persons',array('id' => $id))){            
           $this->session->set_flashdata('message','Name Delete Successfully');
        }else{
           $this->session->set_flashdata('error','Name Not Delete');
        }
        redirect("attachment");    
    }
    public function category(){
        $this->data['page_title'] = lang('List Category');
        $bc = array(array('link' => '#', 'page' => lang('List Category')));
        $meta = array('page_title' => lang('List Category'), 'bc' => $bc);
        $this->page_construct('attachment/category', $this->data, $meta);
    }
    public function get_category(){
        $this->load->library('datatables');
        $this->datatables->select(
            $this->db->dbprefix('note_category').".id as aid,".
            $this->db->dbprefix('note_category').".title,".
            $this->db->dbprefix('note_category').".created_at, CONCAT(".
            $this->db->dbprefix('users').".first_name, ' ',".
            $this->db->dbprefix('users').".last_name) as name,",FALSE);     
        $this->datatables->from('note_category'); 
        $this->datatables->join('users','users.id=note_category.created_by','left'); 
        $actions = "<a href='" . site_url('attachment/edit_category/$1') . "' title='" . lang("Edit") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>
            <a href='" . site_url('attachment/delete_category/$1') . "' onClick=\"return confirm('" . lang('You are going to delete this, please click ok to delete') . "')\" title='" . lang("Delete") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>"; 

        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'> $actions          
            </div></div>", "aid"); 
        $this->datatables->unset_column('aid');
        echo $this->datatables->generate();  
    }
    public function add_category(){   
        $this->form_validation->set_rules('title', 'title', 'required'); 
        $data = array(
            'title' => $this->input->post('title'),
            'created_at' => date('Y-m-d H:s:i'),
            'created_by' => $this->session->userdata('user_id'), 
        );  
        if(($this->form_validation->run() == true) &&($this->site->insertQuery('note_category',$data))){
            $this->session->set_flashdata('message', 'Note Category Added Successfully');
            redirect('attachment/category');
        }  
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Add Note Category';
        $bc = array(array('link' => site_url('attachment'), 'page' => 'List Note Category'), array('link' => '#', 'page' => 'New Note Category'));
        $meta = array('page_title' => 'Add Note Category', 'bc' => $bc); 
        $this->page_construct('attachment/add_category', $this->data, $meta); 
    }
    public function edit_category($id){   
        $this->form_validation->set_rules('title', 'title', 'required'); 
        $this->data['info'] = $this->site->whereRow('note_category', 'id', $id); 
        $data = array(
            'title' => $this->input->post('title'),
            'updated_at' => date('Y-m-d H:s:i'),
            'updated_by' => $this->session->userdata('user_id'), 
        );  
        if(($this->form_validation->run() == true) &&($this->site->updateQuery('note_category',$data,array('id'=>$id)))){
            $this->session->set_flashdata('message', 'Note Category updated successfully');
            redirect('attachment/category');
        }  
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Edit Note Category';
        $bc = array(array('link' => site_url('attachment/category'), 'page' => 'Note Category List'), array('link' => '#', 'page' => 'Edit Note Category'));
        $meta = array('page_title' => 'Edit Note Category', 'bc' => $bc); 
        $this->page_construct('attachment/edit_category', $this->data, $meta); 
    } 
    public function delete_category($id){ 
        if($this->site->deleteQuery('note_category',array('id' => $id))){            
           $this->session->set_flashdata('message','Note Category Delete Successfully');
        }else{
           $this->session->set_flashdata('error','Note Category Not Delete');
        }
        redirect("attachment/category");    
    }
    public function docs($id=NULL){   
        $this->form_validation->set_rules('note_category_id', 'Note Category', 'required');  
        $data = array( 
            'persons_id' => $this->input->post('persons_id'),
            'note_category_id' => $this->input->post('note_category_id'),
            'type' => $this->input->post('type'),
            'note' => $this->input->post('note'),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('user_id'), 
        ); 
        if($this->form_validation->run() == true){
            if(!empty($_FILES['userfile']['name'])){ 
                $this->load->library('upload'); 
                $config['upload_path'] = 'uploads/attachment';
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
                    redirect('attachment/docs');                    
                }
                $photo = $this->upload->file_name;
                $data['attachment'] = $photo;
            }  
            if($id){
                $this->site->updateQuery('attachment',$data, array('id'=>$id));
            }else{
                $attachment_id = $this->site->insertQuery('attachment',$data); 
                $note_category = $this->site->whereRow('note_category','id',$data['note_category_id']);
                $persons = $this->site->whereRow('persons','id',$data['persons_id']);
                $data['attachment_id'] = $attachment_id;
                $data['note_category'] = $note_category->title;
                $data['persons'] = $persons->name;
                $this->site->insertQuery('attachment_log',$data); 
            }
            
            $this->session->set_flashdata('message', 'Attachment Added Successfully');
            redirect('attachment/docs_list');
        }  
        $this->data['persons'] = $this->site->seleteQuery('persons'); 
        $this->data['note_category'] = $this->site->seleteQuery('note_category'); 
        if($id){
            $this->data['info'] = $this->site->findeNameByID('attachment','id',$id);  
        }else{
            $this->data['info'] = array(); 
        }
        
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error'); 
        $this->data['page_title'] = 'Add attachment';
        $bc = array(array('link' => site_url('attachment'), 'page' => 'List attachment'), array('link' => '#', 'page' => 'New attachment'));
        $meta = array('page_title' => 'Add attachment', 'bc' => $bc); 
        $this->page_construct('attachment/docs', $this->data, $meta); 
    }
    public function docs_list(){
        $this->data['page_title'] = lang('Attachment List');
        $bc = array(array('link' => '#', 'page' => lang('Attachment List')));
        $meta = array('page_title' => lang('Attachment List'), 'bc' => $bc);
        $this->page_construct('attachment/docs_list', $this->data, $meta);
    }
    public function get_docs_list() {
        $this->load->library('datatables');
        $this->datatables->select(
            $this->db->dbprefix('attachment').".id as aid,".
            $this->db->dbprefix('note_category').".title,".
            $this->db->dbprefix('attachment').".created_at,".
            $this->db->dbprefix('users').".username,".
            $this->db->dbprefix('persons').".name,".
            $this->db->dbprefix('attachment').".attachment,". 
            $this->db->dbprefix('attachment').".type,". 
            $this->db->dbprefix('attachment').".note,", FALSE);     
        $this->datatables->from('attachment'); 
        $this->datatables->join('users', 'users.id=attachment.created_by');
        $this->datatables->join('persons', 'persons.id=attachment.persons_id','left'); 
        $this->datatables->join('note_category', 'note_category.id=attachment.note_category_id','left');   
        $actions = "<a href='" . site_url('attachment/docs/$1') . "'  title='" . lang("Edit") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>";
        $actions .= "<a href='" . site_url('attachment/docs_delete/$1') . "' onClick=\"return confirm('" . lang('You are going to delete this, please click ok to delete') . "')\" title='" . lang("Delete_Attachment") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a>"; 
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'> $actions          
            </div></div>", "aid");
        
        
        $this->datatables->unset_column('aid');
        echo $this->datatables->generate();  
    }
    public function docs_log_list(){
        $this->data['page_title'] = lang('Attachment log List');
        $bc = array(array('link' => '#', 'page' => lang('Attachment log List')));
        $meta = array('page_title' => lang('Attachment log List'), 'bc' => $bc);
        $this->page_construct('attachment/docs_log_list', $this->data, $meta);
    }
    public function get_docs_log_list() {
        $this->load->library('datatables');
        $this->datatables->select( 
            $this->db->dbprefix('attachment_log').".note_category,".
            $this->db->dbprefix('attachment_log').".created_at,".
            $this->db->dbprefix('users').".username,".
            $this->db->dbprefix('attachment_log').".persons,".
            $this->db->dbprefix('attachment_log').".attachment,". 
            $this->db->dbprefix('attachment_log').".type,". 
            $this->db->dbprefix('attachment_log').".note,", FALSE);     
        $this->datatables->from('attachment_log'); 
        $this->datatables->join('users', 'users.id=attachment_log.created_by');       
        
        $this->datatables->unset_column('aid');
        echo $this->datatables->generate();  
    } 
    public function docs_delete($id){  
        $attac = $this->site->findeNameByID('attachment','id',$id);  
        if($this->site->deleteQuery('attachment',array('id' => $id))){
            /*if($attac->attachment !=''){  
                if(file_exists(FCPATH."uploads/attachment/".$attac->attachment)){
                   unlink(FCPATH."uploads/attachment/".$attac->attachment); 
                } 
            }*/
           $this->session->set_flashdata('message','Duty Docs File Delete Successfully');
        }else{
           $this->session->set_flashdata('error','Duty Docs File Not Delete');
        }
        redirect("attachment");
    }
}
