<?php
class Sendmailbackup extends MY_Controller {

 public function index(){
    print_r($_SERVER) ;
    echo extension_dir;
 }
 public function send_email($to, $subject, $message, $from = NULL, $from_name = NULL, $attachment = NULL, $cc = NULL, $bcc = NULL) {
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
        $this->email->message($message);
        if ($attachment) {
            if(is_array($attachment)) {
                $this->email->attach($attachment['file'], '', $attachment['name'], $attachment['mine']);
            } else {
                $this->email->attach($attachment);
            }
        }

        if ($this->email->send()) { 
            return TRUE;
        } else { 
            return FALSE;
        }
    }

    function backup_database() {
        $this->load->dbutil();
        $prefs = array(
            'format' => 'txt',
            'filename' => 'spos_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup = & $back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $db_name_sql = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.sql';
        $save = './files/backups/' . $db_name;
        $save_sql = './files/backups/' . $db_name_sql;
        $this->load->helper('file');
        write_file($save, $backup);
        write_file($save_sql, $backup);
        $this->session->set_flashdata('messgae', lang('db_saved'));
        /// Send mail 
        $to = 'mdhasan9955@gmail.com';
        $subject = 'Backup database';
        $message = 'Massage tex';
        $from = 'wedothewebs@gmail.com';
        $from_name = 'POS System automatic file backup';
        $cc = 'sayem@wedothewebs.com';
        $realpath = realpath(dirname(__DIR__));
        $realpath = str_ireplace('/app','',$realpath);
        $attachment = $realpath.'/files/backups/'.$db_name; 
        $this->send_email($to, $subject, $message, $from,$from_name,$attachment,$cc); 
    }
}