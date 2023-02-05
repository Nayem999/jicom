<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends MY_Controller
{
    
    function __construct() {
        
        parent::__construct();
        
        if (!$this->loggedIn) {
            
            redirect('login');
            
        }
        
        $this->load->library('form_validation');
        
        $this->load->model('purchases_model');

        $this->load->model('categories_model'); 

        $this->load->model('employee_model');
        
        $this->allowed_types = 'gif|jpg|png|pdf|doc|docx|xls|xlsx|zip';
        
    }

    function index($id = NULL) {
    	$start_date = $this->input->post('start_date') ? $this->input->post('start_date')." 00:00:00" : NULL;
        $end_date = $this->input->post('end_date') ? $this->input->post('end_date')." 23:59:59" : NULL;
        $category = $this->input->post('category') ? $this->input->post('category') : NULL;
        $this->data['expenbyfilter'] = $this->purchases_model->getEexpenByFilter($start_date,$end_date,$category);
        $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');
        $this->data['page_title'] = lang('expenses');        
        $bc = array( array('link' => site_url('purchases'),'page' => lang('purchases')),
            array('link' => '#','page' => lang('expenses'))
        );        
        $meta = array('page_title' => lang('expenses'),'bc' => $bc); 
        $this->data['categories'] = $this->employee_model->getAllCategories();
        $this->page_construct('expenses/expenses', $this->data, $meta);                
    }
          
    function get_expenses($user_id = NULL) {
    	$category = $this->input->get('category') ? $this->input->get('category') : NULL;
    	$start_date = $this->input->get('start_date') ? $this->input->get('start_date')." 00:00:00" : NULL;
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date')." 23:59:59" : NULL;        
        $detail_link = anchor('expenses/expense_note/$1', '<i class="fa fa-file-text-o"></i> ' . lang('expense_note'), 'data-toggle="modal" data-target="#myModal2"');        
        $edit_link = anchor('expenses/edit_expense/$1', '<i class="fa fa-edit"></i> ' . lang('edit_expense'), 'data-toggle="modal" data-target="#myModal"');        
        $delete_link = "<a href='#' class='po' title='<b>" . $this->lang->line("delete_expense") . "</b>' data-content=\"<p>" . lang('r_u_sure') . "</p><a class='btn btn-danger po-delete' href='" . site_url('expenses/delete_expense/$1') . "'>" . lang('i_m_sure') . "</a> <button class='btn po-close'>" . lang('no') . "</button>\"  rel='popover'><i class=\"fa fa-trash-o\"></i> " . lang('delete_expense') . "</a>";        
        $action = '<div class="text-center"><div class="btn-group text-left">' . '<button type="button" class="btn btn-default btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">' . lang('actions') . ' <span class="caret"></span></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>' . $detail_link . '</li>
            <li>' . $edit_link . '</li>
            <li>' . $delete_link . '</li>
        </ul></div></div>';        
        $this->load->library('datatables');        
        $this->datatables->select(
        $this->db->dbprefix('expenses') . ".id as id, date, reference, amount,".
        $this->db->dbprefix('expens_category') . ".name as category, note,".
        $this->db->dbprefix('expenses') . ".paid_by, CONCAT(" . 
        $this->db->dbprefix('users') . ".first_name, ' ', " . 
        $this->db->dbprefix('users') . ".last_name) as user, attachment,", FALSE);
        $this->datatables->from('expenses');
        $this->datatables->join('users', 'users.id=expenses.created_by', 'left');
        $this->datatables->join('expens_category', 'expens_category.cat_id=expenses.c_id', 'left'); 
        $this->datatables->group_by('expenses.id');
        if($category) { $this->datatables->where('c_id', $category); }
        if($start_date) { $this->datatables->where('date >=', $start_date); }
        if($end_date) { $this->datatables->where('date <=', $end_date); } 
        if($this->session->userdata('store_id') !=0){
            $this->datatables->where('expenses.store_id', $this->session->userdata('store_id'));
        } 
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
        	<a onclick=\"window.open('" . site_url('expenses/expense_note/$1') . "', 'pos_popup', 'width=900,height=600,menubar=yes,scrollbars=yes,status=no,resizable=yes,screenx=0,screeny=0'); return false;\" href='#' title='" . lang('expense_note') . "' class='tip btn btn-primary btn-xs'><i class='fa fa-file-text-o'></i></a> 
        	<a href='" . site_url('expenses/edit_expense/$1') . "' title='" . lang("edit_expense") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a> 
        	<a href='" . site_url('expenses/delete_expense/$1') . "' onClick=\"return confirm('" . lang('alert_x_expense') . "')\" title='" . lang("delete_expense") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id");
        
        $this->datatables->unset_column('id');
        
        echo $this->datatables->generate();
        
    }
    
    function expense_note($id = NULL) {
        
        if (!$this->Admin) {
            
            if ($expense->created_by != $this->session->userdata('user_id')) {
                
                $this->session->set_flashdata('error', lang('access_denied'));
                
                redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'pos');
                
            }
            
        }
        
        $expense = $this->purchases_model->getExpenseByID($id);
        
        $this->data['user'] = $this->site->getUser($expense->created_by);
        
        $this->data['expense'] = $expense;
        
        $this->data['page_title'] = $this->lang->line("expense_note");
        
        $this->load->view($this->theme . 'expenses/expense_note', $this->data);
        
    }     
    
    function add_expense() { 
        $this->load->helper('security');        
        $this->form_validation->set_rules('amount', lang("amount"), 'required');
        $this->form_validation->set_rules('employee_id', lang("employee_id"), 'required');
        $this->form_validation->set_rules('reference', lang("reference"), 'required');
        $this->form_validation->set_rules('category', lang("category"), 'required');        
        $this->form_validation->set_rules('userfile', lang("attachment"), 'xss_clean');        
        if ($this->form_validation->run() == true) {     
            $payment_type = $this->input->post('type');       
            if ($this->Admin) {                
                $date = trim($this->input->post('date'));                
            } else {                
                $date = date('Y-m-d H:i:s');                
            }            
            $data = array(                
                'date' => $date,   
                'paid_by' => $this->input->post('type'),             
                'reference' => $this->input->post('reference'),                
                'amount' => $this->input->post('amount'),                
                'created_by' => $this->session->userdata('user_id'),
                'c_id'  => $this->input->post('category'),                
                'note' => $this->input->post('note', TRUE),
                'employee_id'   => $this->input->post('employee_id')                 
            );
            $store = $store_id = $this->input->post('warehouse');
            if($store==''){
                $data['store_id'] = $this->session->userdata('store_id');
                $store_id =  $this->session->userdata('store_id');
            }else{
                $data['store_id'] =$this->input->post('warehouse');
            }  
            if ($_FILES['userfile']['size'] > 0) {                
                $this->load->library('upload');                
                $config['upload_path'] = 'uploads/';                
                $config['allowed_types'] = $this->allowed_types;                
                $config['max_size'] = '2000';                
                $config['overwrite'] = FALSE;                
                $config['encrypt_name'] = TRUE;                
                $this->upload->initialize($config);                
                if (!$this->upload->do_upload()) {
                    $error = $this->upload->display_errors();                    
                    $this->session->set_flashdata('error', $error);                    
                    redirect($_SERVER["HTTP_REFERER"]);                    
                }                
                $photo = $this->upload->file_name;                
                $data['attachment'] = $photo;                
            }            
        } elseif ($this->input->post('add_expense')) {            
            $this->session->set_flashdata('error', validation_errors());            
            redirect($_SERVER["HTTP_REFERER"]);            
        }
        if ($this->form_validation->run() == true) { 
            $expenses_id = $this->site->insertQuery('expenses',$data);
            if(($payment_type == 'cheque') || ($payment_type == 'card')){
                $bankPendingExpenses = array(
                    'expenses_id' => $expenses_id,
                    'expens_category_id'  => $this->input->post('category'),
                    'bank_id'      => $this->input->post('bank'),
                    'payment_type' => $this->input->post('type'),
                    'type'         => 'pay', 
                    'bank_status'  => 'Pending',
                    'cheque_or_card_no' => $this->input->post('cheque_no'),
                    'amount'       => $this->input->post('amount'),
                    'created_by'   => $this->session->userdata('user_id') 
                );                
                $this->site->insertQuery('bank_pending_expenses', $bankPendingExpenses); 

                $bankPending = array(
                    'amount'       => $this->input->post('amount'),
                    'bank_id'      => $this->input->post('bank'),
                    'insert_date'  => date('Y-m-d H:i:s'),
                    'type'         => 'pending',
                    'cheque_no'    => $this->input->post('cheque_no'),
                    'store_id'     => $store_id,
                    'payment_type' =>  4,
                );

                $this->site->insertQuery('bank_pending',$bankPending);
                
            }
            $this->session->set_flashdata('message', lang("expense_added"));
            redirect('expenses');
        } else {  
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['page_title'] = lang('add_expense');
            $bc = array(
                array( 'link' => site_url('expenses'), 'page' => lang('expenses') ),
                array( 'link' => site_url('expenses'), 'page' => lang('expenses') ),
                array( 'link' => '#', 'page' => lang('add_expense') )
            );
            
            $meta = array( 'page_title' => lang('add_expense'), 'bc' => $bc );
            $this->data['categories'] = $this->categories_model->getAllCategories();
            $this->data['warehouses'] = $this->site->getAllStores();             
            $this->data['employee'] = $this->employee_model->getAllEmployee();             
            $this->page_construct('expenses/add_expense', $this->data, $meta);            
        }        
    }
    
    function edit_expense($id = NULL) { 
    	$getEmpPayId = $this->purchases_model->getExpenseByID($id);    	 
    	if(($getEmpPayId->emp_pay_id !='') || ($getEmpPayId->partner_id !='')) {
    		$this->session->set_flashdata('error', lang('Can\'t Edit this section If you edit/change goto salary setion'));            
            redirect('expenses'); 
    	} 
        /*if(($getEmpPayId->paid_by =='cheque') || ($getEmpPayId->partner_id =='card')) {
            $this->session->set_flashdata('error', lang('Can\'t Edit this section If you edit/change please delete this than again entry'));            
            redirect('expenses'); 
        }*/  
        $this->load->helper('security');        
        if ($this->input->get('id')) {            
            $id = $this->input->get('id');            
        } 
        $this->form_validation->set_rules('reference', lang("reference"), 'required');        
        $this->form_validation->set_rules('amount', lang("amount"), 'required');        
        $this->form_validation->set_rules('userfile', lang("attachment"), 'xss_clean');        
        if ($this->form_validation->run() == true) { 
            $payment_type = $this->input->post('type');
            if ($this->Admin) {                
                $date = trim($this->input->post('date'));                
            } else {                
                $date = date('Y-m-d H:i:s');                
            }            
            $data = array( 
                'date' => $date,   
                'paid_by' => $this->input->post('type'),             
                'reference' => $this->input->post('reference'),                
                'amount' => $this->input->post('amount'),
                'c_id'  => $this->input->post('category'),                
                'note' => $this->input->post('note', TRUE)                
            );
            $store = $store_id = $this->input->post('warehouse');
            if($store==''){
                 $data['store_id'] = $this->session->userdata('store_id');
                 $store_id= $this->session->userdata('store_id');
            }else{
                 $data['store_id'] =$this->input->post('warehouse');
            }            
            if ($_FILES['userfile']['size'] > 0) {                
                $this->load->library('upload');                
                $config['upload_path'] = 'uploads/';                
                $config['allowed_types'] = $this->allowed_types;                
                $config['max_size'] = '2000';                
                $config['overwrite'] = FALSE;                
                $config['encrypt_name'] = TRUE;                
                $this->upload->initialize($config);                
                if (!$this->upload->do_upload()) {                    
                    $error = $this->upload->display_errors();                    
                    $this->session->set_flashdata('error', $error);                    
                    redirect($_SERVER["HTTP_REFERER"]);                    
                }                
                $photo = $this->upload->file_name;                
                $data['attachment'] = $photo;                
            }             
        } elseif ($this->input->post('edit_expense')) {            
            $this->session->set_flashdata('error', validation_errors());            
            redirect($_SERVER["HTTP_REFERER"]);            
        }  
        $pending = $this->site->whereRow('bank_pending_expenses', 'expenses_id', $id);        
        if ($this->form_validation->run() == true && $this->purchases_model->updateExpense($id, $data)) {
            if(($payment_type == 'cheque') || ($payment_type == 'card')){                  
                if($pending){                 
                    if($pending->bank_status =='Approved'){
                        $transactions = $this->site->whereRow('tranjiction','tranjiction_id',$pending->transactions_id);  
                        $bank = $this->site->whereRow('bank_account', 'bank_account_id',$transactions->bank_account_id);  
                        $bkbalance = array('current_amount' => ($bank->current_amount + $transactions->tran_amount)); 
                        $this->site->updateQuery('bank_account',$bkbalance,array('bank_account_id'=>$bank->bank_account_id));
                        $this->site->deleteQuery('tranjiction',array('id' => $pending->transactions_id)); 
                    }
                    $this->site->deleteQuery('bank_pending_expenses',array('expenses_id' => $id)); 
                    $this->site->deleteQuery('bank_pending',array('cheque_no' =>$pending->cheque_no)); 
                    $this->session->set_flashdata('message','Salary amount delete successfully'); 
                } 

                $bankPendingExpenses = array(
                    'expenses_id' => $id,
                    'expens_category_id'=> $this->input->post('category'),
                    'bank_id'      => $this->input->post('bank'),
                    'payment_type' => $this->input->post('type'),
                    'type'         => 'pay', 
                    'bank_status'  => 'Pending',
                    'cheque_or_card_no' => $this->input->post('cheque_no'),
                    'amount'       => $this->input->post('amount'),
                    'created_by'   => $this->session->userdata('user_id') 
                );
                $this->site->insertQuery('bank_pending_expenses', $bankPendingExpenses); 

                $bankPending = array(
                    'amount'       => $this->input->post('amount'),
                    'bank_id'      => $this->input->post('bank'),
                    'insert_date'  => date('Y-m-d H:i:s'),
                    'type'         => 'pending',
                    'cheque_no'    => $this->input->post('cheque_no'),
                    'store_id'     => $store_id,
                    'payment_type' =>  4,
                );

                $this->site->insertQuery('bank_pending',$bankPending);
            }
            $this->session->set_flashdata('message', lang("expense_updated"));            
            redirect("expenses/");
        } else { 
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));            
            $this->data['expense'] = $this->purchases_model->getExpenseByID($id);     
            $this->data['warehouses'] = $this->site->getAllStores();         
            $this->data['pending'] = $pending; 
            $this->data['page_title'] = lang('edit_expense');            
            $bc = array(
                array( 'link' => site_url('expenses'), 'page' => lang('expenses') ),
                array( 'link' => site_url('expenses'), 'page' => lang('expenses') ),
                array( 'link' => '#', 'page' => lang('edit_expense') )
            );            
            $meta = array( 'page_title' => lang('edit_expense'), 'bc' => $bc );
            $this->data['categories'] = $this->categories_model->getAllCategories();              
            $this->page_construct('expenses/edit_expense', $this->data, $meta);             
        }        
    } 
    function add_category() { 
        $this->form_validation->set_rules('name', lang('category_name'), 'required|is_unique[expens_category.name]');
        $this->form_validation->set_rules('code', lang('category code'), 'required|is_unique[expens_category.code]');

        if ($this->form_validation->run() == true) {
            $data = array('code' => $this->input->post('code'), 'name' => $this->input->post('name'));

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
                    redirect("expenses/add_category");
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
                    redirect("expenses/add_category");
                }

            }
        }

        if ($this->form_validation->run() == true && $this->categories_model->addExpCategory($data)) {

            $this->session->set_flashdata('message', lang('category_added'));
            redirect("expenses/listcategory");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            
            $this->data['page_title'] = lang('add_category');
            $bc = array(array('link' => site_url('expenses'), 'page' => lang('categories')), array('link' => '#', 'page' => lang('add_category')));
            $meta = array('page_title' => lang('add_category'), 'bc' => $bc);
            $this->page_construct('expenses/add', $this->data, $meta);
        }
    }

    function listcategory() {

        $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
        $this->data['categories'] = $this->categories_model->getAllCategories();
        $this->data['page_title'] = lang('categories');
        $bc = array(array('link' => '#', 'page' => lang('categories')));
        $meta = array('page_title' => lang('categories'), 'bc' => $bc);
        $this->page_construct('expenses/cat_list', $this->data, $meta);

    }
    function get_categories() {
        $this->load->library('datatables');
        $this->datatables->select("cat_id as id, image , code, name", FALSE);
        $this->datatables->from('expens_category'); 
        $this->datatables->group_by('cat_id');
        $this->db->where('name !=', 'Salary');
        $this->db->where('name !=', 'Partner');
        $this->datatables->add_column("Actions", "<div class='text-center'><div class='btn-group'>
        	<a class='tip image btn btn-primary btn-xs' id='$4 ($3)' href='" . base_url('uploads/$2') . "' title='" . lang("view_image") . "'><i class='fa fa-picture-o'></i></a> 
        	<a href='" . site_url('expenses/edit_category/$1') . "' title='" . lang("edit_category") . "' class='tip btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>
        	<a href='" . site_url('expenses/delete_category/$1') . "' onClick=\"return confirm('" . lang('alert_x_category') . "')\" title='" . lang("delete_category") . "' class='tip btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></a></div></div>", "id");
        $this->datatables->unset_column('id');
        echo $this->datatables->generate();
    }
    function edit_category($id = NULL) {
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
                    redirect("expenses/add_category");
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
                    redirect("expenses/edit_category");
                }
            }
        }
        if ($this->form_validation->run() == true && $this->categories_model->updateExpCategory($id, $data)) {
            $this->session->set_flashdata('message', lang('category_updated'));
            redirect("expenses/listcategory");
        } else {
            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));
            $this->data['category'] = $this->categories_model->getCategoryByID($id);
            $this->data['page_title'] = lang('new_category');
            $bc = array(array('link' => site_url('categories'), 'page' => lang('categories')), array('link' => '#', 'page' => lang('edit_category')));
            $meta = array('page_title' => lang('edit_category'), 'bc' => $bc);
            $this->page_construct('expenses/edit_category', $this->data, $meta);
        }
    }

    function delete_category($id = NULL) {
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

        if ($this->categories_model->deleteExpCategory($id)) {
            $this->session->set_flashdata('message', lang("category_deleted"));
            redirect('expenses/listcategory');
        }
    }  
        
    function delete_expense($id = NULL) {        
        if (DEMO) {            
            $this->session->set_flashdata('error', lang('disabled_in_demo'));            
            redirect(isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : 'welcome');            
        }        
        if(!$this->Admin){            
            $this->session->set_flashdata('error', lang('access_denied'));            
            redirect('pos');            
        }        
        if ($this->input->get('id')) {            
            $id = $this->input->get('id');            
        }        
        $getEmpPayId = $this->purchases_model->getExpenseByID($id);          
        if(($getEmpPayId->emp_pay_id !='') || ($getEmpPayId->partner_id !='')) {
            $this->session->set_flashdata('error', lang('Can\'t Delete this section If you edit/change goto this setion'));            
            redirect('expenses'); 
        }         
        $expense = $this->purchases_model->getExpenseByID($id);        
        if ($expense->emp_pay_id != NULL) {
            $this->load->model('employee_model');            
            $this->employee_model->paySalarydelete($expense->emp_pay_id);
        }        
        if ($this->purchases_model->deleteExpense($id)) {            
            if ($expense->attachment) {                
                unlink($this->upload_path . $expense->attachment);                
            } 
            $pending = $this->site->whereRow('bank_pending_expenses', 'expenses_id', $id);   
            if($pending){                 
                if($pending->bank_status =='Approved'){
                    $transactions = $this->site->whereRow('tranjiction','tranjiction_id',$pending->transactions_id);  
                    $bank = $this->site->whereRow('bank_account', 'bank_account_id',$transactions->bank_account_id);  
                    $bkbalance = array('current_amount' => ($bank->current_amount + $transactions->tran_amount)); 
                    $this->site->updateQuery('bank_account',$bkbalance,array('bank_account_id'=>$bank->bank_account_id));
                    $this->site->deleteQuery('tranjiction',array('tranjiction_id' => $pending->transactions_id)); 
                }
                $this->site->deleteQuery('bank_pending_expenses',array('expenses_id' => $id)); 
                $this->session->set_flashdata('message','Salary amount delete successfully'); 
            }           
            $this->session->set_flashdata('message', lang("expense_deleted"));            
            redirect('expenses');            
        }        
    }  

    function excel_expenses($data) {
        $data_arr=explode("_",$data);
    	$category = $data_arr[0] ? $data_arr[0] : NULL;
    	$start_date = $data_arr[1] ? $data_arr[1]." 00:00:00" : NULL;
        $end_date = $data_arr[2] ? $data_arr[2]." 23:59:59" : NULL;        

        $this->db->select(
        $this->db->dbprefix('expenses') . ".id as id, date, reference, amount,".
        $this->db->dbprefix('expens_category') . ".name as category, note,".
        $this->db->dbprefix('expenses') . ".paid_by, CONCAT(" . 
        $this->db->dbprefix('users') . ".first_name, ' ', " . 
        $this->db->dbprefix('users') . ".last_name) as user,");
        $this->db->from('expenses');
        $this->db->join('users', 'users.id=expenses.created_by', 'left');
        $this->db->join('expens_category', 'expens_category.cat_id=expenses.c_id', 'left'); 
        $this->db->group_by('expenses.id');
        if($category) { $this->db->where('c_id', $category); }
        if($start_date) { $this->db->where('date >=', $start_date); }
        if($end_date) { $this->db->where('date <=', $end_date); } 
        if($this->session->userdata('store_id') !=0){
            $this->db->where('expenses.store_id', $this->session->userdata('store_id'));
        } 
        
        $query = $this->db->get()->result();
        // Excel file name for download 
        $fileName = "expense_data_" . date('Y-m-d_h_i_s') . ".xls"; 
        
        // Column names 
        $fields = array('DATE', 'REFERENCE', 'AMOUNT', 'CATEGORY', 'NOTE', 'PAID BY', 'CREATED BY');
        // Display column names as first row 
        $excelData = implode("\t", array_values($fields)) . "\n"; 
        
        if(count($query) > 0){ 
            // Output each row of the data 
            foreach($query as $row){ 
                $lineData = array($row->date, $row->reference, $row->amount, $row->category, $row->note, $row->paid_by, $row->user); 
                $excelData .= implode("\t", array_values($lineData)) . "\n"; 
            } 
        }else{ 
            $excelData .= 'No records found...'. "\n"; 
        } 
         
        // Headers for download 
        header("Content-Type: application/vnd.ms-excel"); 
        header("Content-Disposition: attachment; filename=\"$fileName\""); 
         
        // Render excel data 
        echo $excelData;        
    }
}