<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        define("DEMO", 0);
        $this->Settings = $this->site->getSettings();
        $this->lang->load('app', $this->Settings->language);
        $this->Settings->pin_code = $this->Settings->pin_code ? md5($this->Settings->pin_code) : NULL;
        $this->theme = $this->Settings->theme.'/views/';
        $this->data['assets'] = base_url() . 'themes/default/assets/';
        $this->data['Settings'] = $this->Settings;
        $this->loggedIn = $this->tec->logged_in();
        $this->data['loggedIn'] = $this->loggedIn;
        $this->data['categories'] = $this->site->getAllCategories();
        $this->data['mf_categories'] = $this->site->getAllMfCategories();
        $this->Admin = $this->tec->in_group('admin') ? TRUE : NULL;
        $this->data['Admin'] = $this->Admin;
        $this->Manager = $this->tec->in_group('manager') ? TRUE : NULL;
        $this->data['Manager'] = $this->Manager;
        $this->m = strtolower($this->router->fetch_class());
        $this->v = strtolower($this->router->fetch_method());
        $this->data['m']= $this->m;
        $this->data['v'] = $this->v;

    }

    function page_construct($page, $data = array(), $meta = array()) {
        if(empty($meta)) { $meta['page_title'] = $data['page_title']; }
        $meta['message'] = isset($data['message']) ? $data['message'] : $this->session->flashdata('message');
        $meta['error'] = isset($data['error']) ? $data['error'] : $this->session->flashdata('error');
        $meta['warning'] = isset($data['warning']) ? $data['warning'] : $this->session->flashdata('warning');
        $meta['ip_address'] = $this->input->ip_address();
        $meta['Admin'] = $data['Admin'];
        $meta['Manager'] = $data['Manager']; 
        $meta['loggedIn'] = $data['loggedIn'];
        $meta['Settings'] = $data['Settings'];
        $meta['assets'] = $data['assets'];
        $meta['suspended_sales'] = $this->site->getUserSuspenedSales();
        $meta['qty_alert_num'] = $this->site->getQtyAlerts();
        $this->load->view($this->theme . 'header', $meta);
        $this->load->view($this->theme . $page, $data);
        $this->load->view($this->theme . 'footer');
    }
    
    function send_sms($mobile_no,$sms) {
        $url = "http://bangladeshsms.com/smsapi";
        $data = [
          "api_key" => $this->Settings->api_key,
          "type" => "text",
          "contacts" => $mobile_no,
          "senderid" => SENDER_ID,
          "msg" => $sms,
        ];
        // print_r($data);
        // exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
      }

}
