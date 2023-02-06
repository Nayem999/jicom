<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quotation extends MY_Controller {

	function __construct(){

		parent::__construct();

		if (!$this->loggedIn) {

			redirect('login');

		}

		$this->load->library('form_validation');

		$this->load->model('quotation_model');

		$this->digital_file_types = 'zip|pdf|doc|docx|xls|xlsx|jpg|png|gif';
        
		$ses_unset=array('error'=>'error','success'=>'success','message'=>'message');
		$this->session->unset_userdata($ses_unset);

	}

	function index(){         

		$this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

		$this->data['page_title'] = lang('quotation');

		$bc = array(array('link' => '#', 'page' => lang('quotation')));

		$meta = array('page_title' => lang('Quotation'), 'bc' => $bc);

		$this->page_construct('quotation/index', $this->data, $meta);

	}

    public function get_quotation(){
        $this->load->library('datatables'); 
        $this->datatables->select($this->db->dbprefix('quotation') . ".quotation_id as quotation_id,".
            $this->db->dbprefix('quotation') . ".quotation_date, ".           
            $this->db->dbprefix('quotation') . ".quotation_title,quotation_mail,", FALSE); 
        $this->datatables->from("quotation");
    
        $this->datatables->add_column("Actions", "
            <div class='text-center'><div class='btn-group'>  
            <a href='#' onClick=\"MyWindow=window.open('" . site_url('quotation/view/$1/1') . "', 'MyWindow','toolbar=no,location=no,directories=no,status=no,menubar=yes,scrollbars=yes,resizable=yes,width=350,height=600'); return false;\" title='".lang("Print quotation")."' class='tip btn btn-primary btn-xs'><i class='fa fa-list'></i></a>          
            <a href='" . site_url('quotation/edit/$1') . "' class='tip btn btn-primary btn-xs' title='Edit quotation'>
                  <i class='fa fa-edit'></i>
              </a>             
            <a href='javascript:;' onClick='quotation($1)'  class='tip btn btn-warning btn-xs'  title='quotation view'>
                  <i class='fa fa-list'></i>
            <a href='javascript:;' onClick='sentMail($1)'  class='tip btn btn-warning btn-xs'  title='Sent Mail'>
                  <i class='fa fa-envelope'></i>
              </a> 
            <a href='" . site_url('quotation/delete/$1') . "' onClick=\"return confirm('". $this->lang->line('alert_x_customer') ."')\" class='tip btn btn-danger btn-xs' title='Delete quotation'>
                <i class='fa fa-trash-o'></i>
              </a>              
              </div></div>", "quotation_id"); 
        $this->datatables->unset_column('quotation_id'); 

        echo $this->datatables->generate();
    }

    public function addQuotation(){
        $this->load->helper('html');
        $this->form_validation->set_rules('name', lang("product_name"), 'required');
        $this->form_validation->set_rules('details', lang("details"), 'required'); 

        if ($this->form_validation->run() == true) {

            $data = array( 

                'quotation_title' => $this->input->post('name'), 

                'quotation_details' => $this->input->post('details'),

                'quotation_date' => date('Y-m-d H:i:s')

                );  

        }

        if ($this->form_validation->run() == true && $this->quotation_model->addQuotation($data)) {

            $this->session->set_flashdata('message', lang("Quotation_Added"));

            redirect('quotation');

        } else {

            $this->data['error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('error');

            $this->data['page_title'] = 'Add Quotation ';

            $bc = array(array('link' => '#', 'page' => 'Add Quotation '));

            $meta = array('page_title' => 'Add Quotation ', 'bc' => $bc);

            $this->page_construct('quotation/addQuotation', $this->data, $meta);
        }

    } 

    public function view($id){
        $this->data['quotation'] = $this->quotation_model->getQuotation($id);
        $this->data['page_title'] = lang("quotation");
        $this->load->view($this->theme.'quotation/view', $this->data);
    }

    public function edit($id = NULL) {

        if ($this->input->get('id')) {

            $id = $this->input->get('id');

        }  

        $this->form_validation->set_rules('name', lang("product_name"), 'required');
        $this->form_validation->set_rules('details', lang("details"), 'required'); 

        if ($this->form_validation->run() == true) {

            $data = array( 

                'quotation_title' => $this->input->post('name'), 

                'quotation_details' => $this->input->post('details'),

                'quotation_date' => date('Y-m-d H:i:s')

                );  

        } 

        if ($this->form_validation->run() == true && $this->quotation_model->updateQuotation($id, $data)) { 

            $this->session->set_flashdata('message', lang("product_quotation"));

            redirect("quotation");

        } else {

            $this->data['error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('error'));

            $quotation = $this->quotation_model->getQuotationByID($id); 

            $this->data['quotation'] = $quotation; 

            $this->data['page_title'] = 'Edit Quotation';

            $bc = array(array('link' => site_url('products'), 'page' => 'Edit Quotation'), array('link' => '#', 'page' => 'Edit Quotation'));

            $meta = array('page_title' => 'Edit Quotation', 'bc' => $bc);

            $this->page_construct('quotation/edit', $this->data, $meta);

        }

    } 
    public function quotation($id) { 
           
        $this->data['quotation'] = $this->quotation_model->getQuotation($id);
        $this->load->view($this->theme . 'quotation/quotation',$this->data); 
    }

    public function send_email($to, $subject, $message, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL,$reply_to=NULL, $bcc = NULL) {
        $this->load->library('email');
        $config['protocol'] = $this->Settings->protocol;
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        if ($this->Settings->protocol == 'smtp') {
            $config['smtp_host'] = $this->Settings->smtp_host;
            $config['smtp_user'] = $this->Settings->smtp_user;
            $config['smtp_pass'] = $this->encrypt->decode($this->Settings->smtp_pass);
            $config['smtp_port'] = $this->Settings->smtp_port;
        } elseif ($this->Settings->protocol == 'sendmail') {
            $config['mailpath'] = $this->Settings->mailpath;
        }
        $this->email->initialize($config);

        if ($from && $from_name) {
            $this->email->from($from, $from_name);
        } elseif($from) {
            $this->email->from($from, $this->Settings->site_name);
        }else {
            $this->email->from($this->Settings->default_email, $this->Settings->site_name);
        }

        $this->email->to($to);
        if ($cc) {
            $this->email->cc($cc);
        }
        if ($bcc) {
            $this->email->bcc($bcc);
        }
        $this->email->subject($subject);
        $this->email->reply_to($reply_to, $from_name);
        $this->email->message($message);
        if ($attachment) {
            if(is_array($attachment)) {
                $this->email->attach($attachment['file'], '', $attachment['name'], $attachment['mine']);
            } else {
                $this->email->attach($attachment);
            }
        }

        if ($this->email->send()) {
            //echo $this->email->print_debugger(); die();
            return TRUE;
        } else {
            //echo $this->email->print_debugger(); die();
            return FALSE;
        }
    }

    public function sentMail($id){ 
        $this->data['id'] = $id;
        $this->load->library('email');
        $subject = $this->input->post('subject');
        $to = $this->input->post('to');
        $cc = $this->input->post('cc'); 
        $details = $this->input->post('details');       
        $quotation = $this->quotation_model->getQuotationByID($id); 
        $this->data['quotation'] = $quotation;
        if($to !=''){
            $rtrimdata = trim($to,','); 
            $filterEmail = explode(',',$rtrimdata); 
            /*foreach ($filterEmail as $key => $email) {

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {                 
                        $this->session->set_flashdata('error', lang("Invalid email format"));
                         redirect('quotation');  
                    }   

                } */
            $quotation_id = $this->input->post('quotation_id'); 
            $details = $this->quotation_model->getQuotationByID($quotation_id); 
            if($details->quotation_mail !=''){
                    $separeted = $details->quotation_mail.',';
                }else{
                    $separeted ='';
                }
                $dataVal = array( 
                    'quotation_mail' => $details->quotation_mail.' ,'.$to
                ); 
                
                  
                $this->quotation_model->updateQuotation($quotation_id,$dataVal); 
                               
                $to = $rtrimdata;
                $reply_to = 'computer_tdy@yahoo.com';
                $subject = $subject;
                $message = $details->quotation_details;
                $from = 'contact@tct.com.bd';
                $from_name = 'Quotation'; 
                $this->send_email($to, $subject, $message, $from,$from_name,NULL,$cc,$reply_to); 
          $this->session->set_flashdata('message', lang("Successfully sent mail"));
          redirect('quotation');
         
        }

        $this->load->view($this->theme . 'quotation/sentMail',$this->data);


        /*if($mail !=''){
            $makeValideEmail = str_replace("___","@",trim($mail)); 

        if (!filter_var($makeValideEmail, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format ";
            } else { 
                $quotation = $this->quotation_model->getQuotationByID($id);
                $data = array( 
                    'quotation_mail' => $quotation->quotation_mail.', '.$makeValideEmail,
                );
                $this->quotation_model->updateQuotation($id,$data);                
                $to = $makeValideEmail;
                $subject = 'Simple Quotation';
                $message = $quotation->quotation_details;
                $from = 'contact@tct.com.bd';
                $from_name = 'Simple Quotation'; 
                $this->send_email($to, $subject, $message, $from,$from_name);    
                echo 'Successfully sent mail';
            }

        }*/

    }

    public function delete($id){
        if(!$this->Admin){
           redirect('quotation');
        }
       if($this->quotation_model->deleteQuotation($id)){
            redirect('quotation');
        };
    }
  

}

