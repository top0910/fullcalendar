<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(FCPATH.('vendor/autoload.php'));

class User extends MY_Controller {

var $current_user;   
var $current_user_id;
var $current_building_id;
var $current_user_role;

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model'); 
        $this->load->model('calendar_model'); 

        // If user is not logged in -> redirect to user_login controller 
        if(!$this->_is_logged_in('user_id')) 
        {
            _redirect('user_login');
        }  

        $this->current_user = $this->global_model->select_single('users',['user_id'=>$this->_is_logged_in('user_id')]);
        $this->current_user_id = $this->current_user['user_id'];
        $this->current_building_id = $this->current_user['building_id'];
        $this->current_user_role = $this->current_user['user_role'];

        $user_building_info = 
        $this->global_model->select_single('building_data',['id'=>$this->session->userdata('building_sess_id')]);
        
        $custom_logo = $user_building_info['custom_logo'];
        
        $this->session->set_userdata('custom_logo',$custom_logo);

        // print_r($custom_logo);
        // echo $this->session->userdata('custom_logo');
        // exit();
    }

    public function profile()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->_is_logged_in('user_id')]);

        $data['user_building_info'] = $this->global_model->select_single('building_data',['id'=>$this->session->userdata('building_sess_id')]);
        
        // print_r($data['current_user']['user_notes']);
        
        // exit();
        
        // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/profile', $data);
        $this->load->view('users/dashboard/footer');        
    }



    public function update_profile()
    {   
            // To change password, all three fields are required
            if($this->input->post('admin_old_password')&&
                $this->input->post('admin_new_password')&&
                $this->input->post('admin_confirm_password'))
            {
               if(($this->input->post('admin_new_password') != $this->input->post('admin_confirm_password')))
               {
                $this->_msg('msg', 'New Password does not match with Confirm password.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }
            elseif(!$this->global_model
                ->select_single('users', 
                    ['user_id'=>$this->current_user_id,'user_password'=>$this->input->post('admin_old_password')]))
            {
                $this->_msg('msg', 'You entered wrong old password.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();            
            }
            else
            {
                if($this->global_model->update('users', ['user_id'=>$this->current_user_id], ['user_password'=>$this->input->post('admin_new_password')]))
                {
                $this->_msg('msg', 'Password updated successfully');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();                  
                }
            }
        }
        else
        {
                $this->_msg('msg', 'All three fields are required to change the password.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();            
        }
    }

    public function user_notes() {
       $user_notes = $this->input->post('user_notes');
       // print_r($data['user_notes']);
       // exit();
        $this->global_model->update('users', ['user_id'=>$this->current_user_id], ['user_notes'=>$user_notes]);
        $this->_msg('msg', 'User Note updated successfully!');
        $this->_class('alert_class', 'alert-success');
        _redirect_pre(); 
    }

    public function admin_notes() {
       $admin_notes = $this->input->post('admin_notes');
       // print_r($data['admin_notes']);
       // exit();
        $this->global_model->update('building_data', ['id'=>$this->current_building_id], ['admin_notes'=>$admin_notes]);
        $this->_msg('msg', 'Admin note updated successfully!');
        $this->_class('alert_class', 'alert-success');
        _redirect_pre(); 
    }


    public function home() {

        // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $current_user = $this->global_model->select_single('users',['user_id'=>$this->current_user_id ]);
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);


        $data['user_building_info'] = 
        $this->global_model->select_single('building_data',['id'=>$this->session->userdata('building_sess_id')]);
 
        // echo "<pre>";
        // print_r($data);
        // exit();


        if($this->current_user_role == '0')
        {
            $data['buildings_list'] = $this->global_model->select_all('building_data');
            $data['users_list'] = $this->global_model->select_all('users',['user_role !='=>'0']);


        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/home', $data);
        $this->load->view('users/dashboard/footer');

        }
        elseif($this->current_user_role == '1')
        {
            $data['users_list'] = $this->global_model->select_all('users'
                                ,['building_id'=>$this->current_building_id,'user_role !='=>'0']);


            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/home', $data);
            $this->load->view('users/dashboard/footer');

        }

        elseif($this->current_user_role == '4')
        {

        $data['users_list'] = $this->global_model->select_all('users',['building_id'=>$this->current_building_id,'user_role !='=>'0']);
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/home', $data);
        $this->load->view('users/dashboard/footer');

        }

        elseif($current_user['user_role'] == '2')
        {

        $building_users = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);    

        $data['users_list'] = $this->global_model->select_all('users',['building_unit'=>$building_users['building_unit'],'user_role !='=>'0']);
        $building_sess_id = $this->session->userdata('building_sess_id');
        
        $data['building_notices'] = $this->global_model->select_all('building_notice',['building_id'=>$building_sess_id],'id','desc');
            
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/user_home', $data);
        $this->load->view('users/dashboard/footer');

        }
        elseif($current_user['user_role'] == '3')
        {
        $building_users = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);    
        $building_sess_id = $this->session->userdata('building_sess_id');
        
        $data['building_notices'] = $this->global_model->select_all('building_notice',['building_id'=>$building_sess_id],'id','desc');
            
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/tenant_home', $data);
        $this->load->view('users/dashboard/footer');
        }
    }

    public function manage_emails()
    {
        if($this->current_user_role == '0')
        {
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');

            $data['buildings'] = $this->global_model->select_all('building_data');
    
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/manage_emails', $data);
            $this->load->view('users/dashboard/footer');
        }              
    }

    public function clear_arc()
    {
        if($this->current_user_role == '0')
        {
            $id = $this->input->get('id');
            $type = $this->input->get('type');

            if($type = '0')
            {
                $delete = $this->global_model->delete('emails',['building_id'=>$id,'archive'=>'1']);
                $this->_msg('msg', 'Archive emails clear.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();
            }
            if($type = '1')
            {
                $delete = $this->global_model->delete('email_sent',['building_id'=>$id,'archive'=>'1']);
                $this->_msg('msg', 'Archive emails clear.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();
            }
        }
        else{
            $this->_msg('msg', 'Ooops...You are not an admin.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();            
        }  
    }

    public function email_mgmt($offset = 0)
    {
        $user_building_info = 
                $this->global_model->select_single('building_data',['id'=>$this->current_building_id]);
        // echo "<pre>";
        // print_r($user_building_info);
        // exit();        
        $path = realpath('').'/assets/email_files/';

        $username = $user_building_info['building_email'];
        // $username = $user_building_info['building_name'].'@strata365.com';
        $password = 'MrBryan@strata/365';
        $mbox = imap_open ("{sub4.mail.dreamhost.com:993/imap/ssl}INBOX",$username,$password );

        $mailbox = new PhpImap\Mailbox('{sub4.mail.dreamhost.com:993/imap/ssl}INBOX',$username,$password,$path);
    // Read all messaged into an array:
        $mailsIds = $mailbox->searchMailbox('ALL');
        if(!$mailsIds) {
            echo "Mailbox is empty";
        }

    // check emails in the selected mail box.
        $MC = imap_check($mbox);
        $unseens   = imap_search($mbox, 'UNSEEN', SE_UID);

        if (!empty($unseens)) {
            foreach ($unseens as $unseen) {
                $se_uid = $unseen;

                $emails = imap_fetch_overview($mbox,$se_uid,FT_UID);
                foreach ($emails as $email) {

                    if($email->seen == '0')
                    {

    // Get the first message and save its attachment(s) to disk:
                        $mail = $mailbox->getMail($se_uid);
                        $get_last_row_id = $this->global_model->add_id('emails',[
                            'email_uid'=>$email->uid,
                            'email_subject'=>$email->subject,
                            'email_from'=>$email->from,
                            'email_date'=>$email->udate,
                            'email_content'=>$mail->textHtml,
                            'building_id'=>$this->current_building_id,
                        ]);

                        $attachments = $mail->getAttachments();
                        foreach ($attachments as $attachment) {

                            $add_files = $this->global_model->add('email_files',[
                                'email_file_name'=>$attachment->filePath,
                                'email_uid'=>$email->uid,
                                'building_id'=>$this->current_building_id,
                                'email_id'=>$get_last_row_id,
                            ]);
                        }
                    }
                }
            }

            if($get_last_row_id)
            {
                $data['msg']= $this->session->flashdata('msg');  
                $data['alert_class']= $this->session->flashdata('alert_class');
                 $data['active_inbox'] = 'active';
                $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
                $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);
                $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);  
                $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);


                $data['emails'] = 
                $this->global_model->select_all('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],'id','desc');


                $this->load->view('users/dashboard/header');
                $this->load->view('users/dashboard/navigation',$data);
                $this->load->view('users/email_navigation', $data);
                $this->load->view('users/email_mgmt', $data);
                $this->load->view('users/dashboard/footer');

            }    


        }
        else{
                $data['msg']= $this->session->flashdata('msg');  
                $data['alert_class']= $this->session->flashdata('alert_class');
                 $data['active_inbox'] = 'active';
                $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
                $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
                $data['emails'] = 
                $this->global_model->select_all('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],'id','desc');

        $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);  

                $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);
                $this->load->view('users/dashboard/header');
                $this->load->view('users/dashboard/navigation',$data);
                $this->load->view('users/email_navigation', $data);
                $this->load->view('users/email_mgmt', $data);
                $this->load->view('users/dashboard/footer');

        }
    }

    public function get_email()
    {
        $email_id = $this->input->get('id');
         $data['active_inbox'] = 'active';
        $data['email_data'] = $this->global_model->select_single('emails',['id'=>$email_id]);
        $data['email_files'] = $this->global_model->select_all('email_files',['email_id'=>$email_id]);
        
        $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
        
        $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);
        $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);    
        $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);  

        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/email_navigation', $data);
        $this->load->view('users/get_email', $data);
        $this->load->view('users/dashboard/footer');        

    }

    public function send_emails()
    {
         $data['active_sent'] = 'active';
        $data['sent_emails'] = $this->global_model->select_all('email_sent',['building_id'=>$this->current_building_id,'archive'=>'0']);

        $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
        
        $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);

        $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);

        $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);        
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/email_navigation', $data);
        $this->load->view('users/send_emails', $data);
        $this->load->view('users/dashboard/footer');        
    }

    public function set_archive()
    {
        $id = $this->input->get('id');
        // print_r($id);
        // exit();
        if($this->input->get('sent')==1)
        {

            $email_archived = $this->global_model->update('email_sent',['id'=>$id,'building_id'=>$this->current_building_id],['archive'=>'1']);
        }
        else
        {
            $email_archived = $this->global_model->update('emails',['id'=>$id,'building_id'=>$this->current_building_id],['archive'=>'1']);            
        }

        $this->_msg('msg', 'Email archived.');
        $this->_class('alert_class', 'alert-success');
        _redirect_pre();        

    }

    public function delete_sent_email()
    {
        $id = $this->input->get('id');

        $this->global_model->delete('email_sent',['id'=>$id,'building_id'=>$this->current_building_id]);

        $this->_msg('msg', 'Email deleted successfully.');
        $this->_class('alert_class', 'alert-success');
        _redirect_pre();         
    }

    public function view_archive()
    {
        $email_id = $this->input->get('id');
        $data['active_arc'] = 'active';
        $data['email_data'] = $this->global_model->select_single('emails',['id'=>$email_id]);
        $data['email_files'] = $this->global_model->select_all('email_files',['email_id'=>$email_id]);
        $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
        $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id],[]);
        $data['emails'] = 
                $this->global_model->select_all('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],'id','desc');

        $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);

        $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);

        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/email_navigation', $data);
        $this->load->view('users/view_archive', $data);
        $this->load->view('users/dashboard/footer');          
    }


    public function view_sent_archive()
    {
        $email_id = $this->input->get('id');
        $data['active_sent_arc'] = 'active';
        $data['email_data'] = $this->global_model->select_single('emails',['id'=>$email_id]);
        $data['email_files'] = $this->global_model->select_all('email_files',['email_id'=>$email_id]);
        $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
        $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);
        $data['emails'] = 
                $this->global_model->select_all('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],'id','desc');

        $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);
        $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);


        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/email_navigation', $data);
        $this->load->view('users/view_sent_archive', $data);
        $this->load->view('users/dashboard/footer');          
    }

    public function revert_archive()
    {
        $id = $this->input->get('id');

        $email_archived = $this->global_model->update('emails',['id'=>$id,'building_id'=>$this->current_building_id],['archive'=>'0']);

        $this->_msg('msg', 'Email moved back to Inbox.');
        $this->_class('alert_class', 'alert-success');
        _redirect_pre();   
    }

    public function sent_revert_archive()
    {
        $id = $this->input->get('id');

        $email_archived = $this->global_model->update('email_sent',['id'=>$id,'building_id'=>$this->current_building_id],['archive'=>'0']);

        $this->_msg('msg', 'Email moved back to Sent Box.');
        $this->_class('alert_class', 'alert-success');
        _redirect_pre();   
    }

    public function compose_email()
    {
        $email_id = $this->input->get('id');

        $data['all_users'] = $this->global_model->select_all('users',['building_id'=>$this->current_building_id]);

        $data['email_data'] = $this->global_model->select_single('emails',['id'=>$email_id]);

        $data['email_files'] = $this->global_model->select_all('email_files',['email_id'=>$email_id]);

        $data['inbox_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'0'],[]);

        $data['sent_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id],[]);

        $data['emails'] = 
                $this->global_model->select_all('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],'id','desc');

        $data['archive_count']= $this->global_model->count_rows('emails',['building_id'=>$this->current_building_id,'archive'=>'1'],[]);

        $data['sent_archive_count']= $this->global_model->count_rows('email_sent',['building_id'=>$this->current_building_id,'archive'=>'1'],[]); 

        $data['msg']= $this->session->flashdata('msg');  

        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/email_navigation', $data);
        $this->load->view('users/compose_email', $data);
        $this->load->view('users/dashboard/footer');         
    }

    public function quickemail()
    {
        $to =[];

        if ($this->input->post('emailto')) {
            $emailto = $this->input->post('emailto');
            array_push($to, $emailto);
        }

        if ($this->input->post('to_users')) {
            $to_users = $this->input->post('to_users');
            foreach ($to_users as $value) {
            array_push($to, $value);
            }
        }


        $email_list = $this->input->post('email_list');

        // echo "<pre>";
        // print_r($email_list);
        // echo "<br/>";
        // print_r($to);
        // exit();
        if($to == '' && $email_list == '')
        {
            $this->_msg('msg', 'You have not entered any receiver of this email.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();             
        }    

        if($email_list == '1234')
        {
            $email_list =  $this->global_model->select_all('users',['building_id'=>$this->current_building_id]);         
        }
        elseif ($email_list == '1') {
            $email_list = $this->global_model->select_all('users',['building_id'=>$this->current_building_id,'user_role'=>'1']);
        }

        elseif ($email_list == '2') {
            $email_list = $this->global_model->select_all('users',['building_id'=>$this->current_building_id,'user_role'=>'2']);
        }
        elseif ($email_list == '3') {
            $email_list = $this->global_model->select_all('users',['building_id'=>$this->current_building_id,'user_role'=>'3']);
        }
        elseif ($email_list == '4') {
            $email_list = $this->global_model->select_all('users',['building_id'=>$this->current_building_id,'user_role'=>'4']);
        }

        if ($email_list != NULL) {
            foreach ($email_list as $email) {
                array_push($to, $email['user_email']);
            }

            
        }


        $first = array_shift($to);
        $bcc = implode(',', $to);


        // echo "<pre>";
        // print_r($first);
        // echo "<br/>";
        // print_r($bcc);
        // exit();

        $data['email_to'] = $first;
        $subject = $this->input->post('subject');
        
        $data['email_subject'] = $this->input->post('subject');
        
        $message = $this->input->post('message');
        $data['email_content'] = $this->input->post('message');


        $user_building_info = 
                $this->global_model->select_single('building_data',['id'=>$this->current_building_id]);
        $data['email_from'] = $user_building_info['building_email'];


        $username = $user_building_info['building_email'];
        

        $password = 'MrBryan@strata/365';
        $smtp = 'mail.strata365.com';
        $port = 587;

        $data['user_id'] = $this->current_user_id;
        $data['building_id'] = $this->current_building_id;

        $config = [
            'upload_path'   =>      './assets/sent_email_documents',
            'allowed_types' =>      'jpg|gif|png|jpeg|doc|docx|pdf|xls|xlsx|ppt|pptx|txt',
            'max_size'      =>      '10512',
            'overwrite'     =>      false,
            'max_filename'  =>      '5120',
        ];

        $this->load->library('upload', $config);   
        // $this->upload->do_upload('doc_file'); 

        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => $smtp,
        'smtp_port' => $port,
        'smtp_user' => $username,    //email id
        'smtp_pass' => $password,            // password
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
        );  
        
        $this->load->library('email', $config); 


        if($this->upload->do_upload('doc_file'))
        {
            // if email contains file

            $data['file_name'] = $this->upload->data('file_name');
            // print_r($data['file_name']);
            // print_r($data);
            // exit();
                $upload_data = $this->global_model->add('email_sent',$data);
                if($upload_data) 
                {
                    $from_email = $username;
                    $this->email->set_newline("\r\n");
                    $this->email->from($from_email, 'Strata365'); 

                    $this->email->to($first);
                    // $this->email->cc('another@another-example.com'); 
                    $this->email->bcc($bcc); 


                    $this->email->subject($subject); 
                    $this->email->message($message); 
                    $this->email->set_mailtype('html');
                    $this->email->attach(FCPATH."assets/sent_email_documents/".$data['file_name']);
                    $sendmail = $this->email->send();
                    
                    if($sendmail) 
                    {
                        $this->_msg('msg', 'Email with File sent successfully.');
                        $this->_class('alert_class', 'alert-success');
                        _redirect_pre();               
                    } 
                    else 
                    {
                        $this->_msg('msg', 'Email with File sent Unsuccessfull,Please try again');
                        $this->_class('alert_class', 'alert-danger');
                        _redirect_pre();                   
                    }  

                }
         
        }            
        else {

            // if email is sent without file attachment

            $upload_data = $this->global_model->add('email_sent',$data);
            $from_email = $username;
            $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'Strata365'); 

            $this->email->to($first);
            // $this->email->cc('another@another-example.com'); 
            $this->email->bcc($bcc); 
            
            $this->email->subject($subject); 
            $this->email->message($message); 
            $this->email->set_mailtype('html');
            
            $sendmail = $this->email->send();
            
            if($sendmail) 
            {
                $this->_msg('msg', 'Email sent successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();               
            } 
            else 
            {
                $this->_msg('msg', 'Email sent Unsuccessfull,Please try again');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();                   
            } 
        } 


    
    }

    public function ask_survey()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

        $data['survey_data'] = $this->global_model->select_all('survey',['user_id'=>$this->current_user_id]);

        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/ask_survey',$data);
        $this->load->view('users/dashboard/footer');        
    }

    public function show_result()
    {
        // Show survey result with unit details
        $survey_id = $this->input->get('survey_id');

        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
        $data['get_data'] = $this->global_model->select_all('survey_replies',['survey_id'=>$survey_id]);

        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/view_survey_result',$data);
        $this->load->view('users/dashboard/footer');  

    }

    public function view_chart()
    {
        $survey_id = $this->input->get('id');

        $this->session->set_userdata('get_survey_id',$survey_id);
        // echo $survey_id;
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

        $count_yes = $this->global_model->count_rows('survey_replies',['survey_id'=>$survey_id,'reply_message'=>'1']);
        $count_total = $this->global_model->count_rows('survey_replies',['survey_id'=>$survey_id]);

        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/view_chart',$data);
        $this->load->view('users/dashboard/footer');        
    }

    public function get_chart_data(){
        $survey_id = $this->session->userdata('get_survey_id');

        $count_yes = $this->global_model->count_rows('survey_replies',['survey_id'=>$survey_id,'reply_message'=>'1']);
        $count_no = $this->global_model->count_rows('survey_replies',['survey_id'=>$survey_id,'reply_message'=>'0']);
        $data = [$count_yes,$count_no];
        echo json_encode($data);

    }

    public function new_survey()
    {
        $data = $this->input->post();
        $data['user_id'] = $this->current_user_id;
        $data['user_role'] = $this->current_user_role;
        $data['building_id'] = $this->current_building_id;

        if($this->current_user_role == '1' OR $this->current_user_role == '0')
        {
            if ($this->global_model->add('survey', $data)) 
            {
                $this->_msg('msg', 'Survey started successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
        }
        else
        {
            _redirect('user/home');            
        }

    }

    public function update_survey()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        $update = $this->global_model->update('survey',['id'=>$id],['status'=>$status]);

            if ( $update) 
            {
                $this->_msg('msg', 'Survey updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 

    }

    public function survey_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('survey', $data)) 
            {   $this->global_model->delete('survey_replies',['survey_id'=> $data['id']]);
                $this->_msg('msg', 'Survey deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            

    }

    public function show_survey()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

        $data['survey_data'] = $this->global_model->select_all('survey',
                                        ['building_id'=>$this->current_building_id,
                                        'status'=>'1']);


        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/show_survey',$data);
        $this->load->view('users/dashboard/footer');         
    }

    public function submit_vote()
    {
        $data['survey_id'] = $this->input->post('survey_id'); // survey id
        $data['reply_message'] = $this->input->post('reply_message'); // survey id
        $data['comment'] = $this->input->post('comment'); // survey id
        $data['user_id'] =$this->current_user_id;
        $data['user_role'] = $this->current_user_role;

        $add_vote = $this->global_model->add('survey_replies',$data);

            if ($add_vote) 
            {   
                $this->_msg('msg', 'Vote submitted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }

    }


    public function tenant()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

        $data['tenant_data'] = $this->global_model->select_single('users',['building_id'=>$this->current_building_id,'building_unit'=>$data['current_user']['building_unit'],'user_id !=' => $data['current_user']['user_id']]);

        // // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/add_tenant',$data);
        $this->load->view('users/dashboard/footer');         
    }

    public function add_tenant()
    {
      $data = $this->input->post();
        $data['user_name'] = $this->input->post('user_name');
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = $this->input->post('user_password');
        $data['user_phone'] = $this->input->post('user_phone');
        $data['user_role'] = $this->input->post('user_role');
        $data['building_id'] = $this->input->post('building_id');
        $data['building_unit'] = $this->input->post('building_unit');
        
        $check_tenant = $this->global_model->count_rows('users', ['building_id'=>$data['building_id'],'building_unit'=>$data['building_unit']],[]);
        if($check_tenant>1)
        {
            $this->_msg('msg', 'Maximum one tenant allowed, And you already have one.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre(); 
        }
        else
        {
            $check_email = $this->global_model->select_single('users',['user_email'=>$this->input->post('user_email')]);
            if(!$check_email)
            {
                $add_user = $this->global_model->add('users',$data);
                
                if($add_user)
                {
                    $this->_msg('msg', 'Tenant added successfully.');
                    $this->_class('alert_class', 'alert-success');
                    _redirect_pre();
                }
                else{
                    $this->_msg('msg', 'Error, PLease try again.');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();                
                }

            }
            else
            {
                $this->_msg('msg', 'This email is already occupied, Please use another email.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
        }
    }

    public function update_tenant()
    {
        $user_id = $this->input->post('user_id');
        $user_name = $this->input->post('user_name');
        $user_phone = $this->input->post('user_phone');
        $status = $this->input->post('status');
        $updated_at = date('Y-m-d H:i:s');


        $user_update = $this->global_model->update('users', ['user_id'=>$user_id], 
                        [
                            'user_name'=>$user_name,
                            'user_phone'=>$user_phone,
                            'status'=>$status,
                            'updated_at'=>$updated_at
                        ]);
        if($user_update)
        {   
            $this->_msg('msg', 'Tenant updation successful!');
            $this->_class('alert_class', 'alert-success');
            _redirect_pre();

        }
        else
        {
            $this->_msg('msg', 'Tenant updation failed, Contact Admin.');
            $this->_class('alert_class', 'alert-warning');
             _redirect_pre();           
        }
    }  

    public function tenant_delete() {
        $data['user_id'] = $this->input->get('tenant_id');

        $user_role = $this->global_model->select_single('users',['user_id'=>$data['user_id'],'user_role'=>'3']);

            if ($this->global_model->delete('users', $data)) 
            {
                $this->_msg('msg', 'Tenant deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            

    }

    public function calendar()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
        $data['event_requests'] = $this->global_model->select_all('event_requests',['building_id'=>$this->current_building_id]);
        
        //current user event requests
        $data['current_user_e_req'] = $this->global_model->select_all('event_requests',['building_id'=>$this->current_building_id,'user_id'=>$this->current_user_id]);

        // // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/calendar');
            $this->load->view('users/dashboard/footer'); 
        }

        elseif($this->current_user_role == '2' OR $this->current_user_role == '3')
        {
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/user_calendar');
            $this->load->view('users/dashboard/footer'); 
        }
    }

    public function event_requests()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
        $data['event_requests'] = $this->global_model->select_all('event_requests',['building_id'=>$this->current_building_id]);

        // // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/event_requests');
        $this->load->view('users/dashboard/footer');         
    }

    public function add_new_user()
    {

        $data['user_name'] = $this->input->post('user_name');
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = $this->input->post('user_password');
        $data['user_phone'] = $this->input->post('user_phone');
        $data['user_role'] = $this->input->post('user_role');
        $data['building_id'] = $this->current_building_id;
        $data['building_unit'] = $this->input->post('building_unit');
        


        $check_email = $this->global_model->select_single('users',['user_email'=>$this->input->post('user_email')]);

        if(!$check_email)
        {
            $add_user = $this->global_model->add('users',$data);
            
            if($add_user)
            {
                if($data['user_role']=='1')
                {      
                     // if user role is "User", get the last created user's data 
                    $get_last_row = $this->global_model->select_single('users',['user_email'=>$data['user_email']]);

                    // update buildings data admin id with the new admin
                    $this->global_model->update('building_data'
                                                ,['id'=>$this->current_building_id]
                                                ,['building_admin_id'=>$get_last_row['user_id']]
                                            );
                }

                $this->_msg('msg', 'New user added successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();
            }
            else{
                $this->_msg('msg', 'Error, PLease try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();                
            }

        }
        else
        {
            $this->_msg('msg', 'This email is already occupied, Please use another email.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        }
    }

    public function update_user()
    {

        $user_name = $this->input->post('user_name');
        $user_email = $this->input->post('user_email');
        // $user_password = $this->input->post('user_password');
        $user_phone = $this->input->post('user_phone');

        // this is to change the building of the admin, so don't make it current building
        $building_id = $this->input->post('building_id');
        $building_unit = $this->input->post('building_unit');
        $user_role = $this->input->post('user_role');
        $status = $this->input->post('status');
        $updated_at = date('Y-m-d H:i:s');

        $user_id = $this->input->post('user_id');

        $user_update = $this->global_model->update('users', ['user_id'=>$user_id], 
                        [
                            'user_name'=>$user_name,
                            'user_email'=>$user_email,
                            // 'user_password'=>$user_password,
                            'user_phone'=>$user_phone,
                            'building_unit'=>$building_unit,
                            'building_id'=>$building_id,
                            'user_role'=>$user_role,
                            'status'=>$status,
                            'updated_at'=>$updated_at
                        ]);
        if($user_update)
        {   
            $this->_msg('msg', 'User updation successful!');
            $this->_class('alert_class', 'alert-success');
            _redirect('user/home');

        }
        else
        {
            $this->_msg('msg', 'User updation failed!');
            $this->_class('alert_class', 'alert-warning');
            _redirect('user/home');            
        }
    }  

    public function user_delete() {
        $data['user_id'] = $this->input->get('user_id');

        $user_role = $this->global_model->select_single('users',['user_id'=>$data['user_id']]);

        // print_r($user_role['user_role']);

        if($user_role['user_role'] != '1' && $user_role['user_role'] != '0'  && $user_role['user_role'] != '4')
        {
            if ($this->global_model->delete('users', $data)) 
            {
                $this->_msg('msg', 'User deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
        }
        else
        {
            $this->_msg('alert', 'You can not delete an admin.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();            
        }

    } 

    public function building_notice()
    {   
        $building_sess_id = $this->session->userdata('building_sess_id');

        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->_is_logged_in('user_id')]);

        $data['building_notices'] = $this->global_model->select_all('building_notice',['building_id'=>$building_sess_id]);
        // Send flashdata of alert messages and Show the alert message.    
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');  

        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/building_notice', $data);
        $this->load->view('users/dashboard/footer');  
    }

    public function insert_notice()
    {
        $data = $this->input->post();
        $config = [
                    'upload_path'   =>      './assets/building_docs',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];

        $this->load->library('upload', $config);   
  
        if($this->upload->do_upload('doc_file'))
        {
            $data['file_name'] = base_url('assets/building_docs/').$this->upload->data('file_name');
        } 

        $data['building_id'] = $this->session->userdata('building_sess_id');
        
        $insert_notice = $this->global_model->add('building_notice',$data);

            if ($insert_notice) 
            {
                $this->_msg('msg', 'Notice added successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }        
    }



    public function notice_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('building_notice', $data)) 
            {
                $this->_msg('msg', 'Notice deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            


    } 

    public function building_docs(){

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('building_docs',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/building_docs', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }        
    }

    public function admin_docs(){

        if($this->current_user_role == '0')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('admin_docs',[],'id','desc');

            $data['all_buildings'] = $this->global_model->select_all('building_data',['id != '=>'1']);


            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/admin_docs', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }        
    }

    public function agm(){

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('agm',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/agm', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }        
    }

    public function pm_docs(){

        if($this->current_user_role == '0' OR $this->current_user_role == '4')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('pm_docs',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/pm_docs', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }        
    }

    public function upload_pm_docs()
    {
        $config = [
            'upload_path'   =>      './assets/agm',
            'allowed_types' =>      'doc|xls|pdf|docx',
            'max_size'      =>      '10512',
            'overwrite'     =>      false,
            'max_filename'  =>      '200',
        ];

        $this->load->library('upload', $config);            
        if($this->upload->do_upload('doc_file'))
        {

            $data['file_name'] = base_url('assets/agm/').$this->upload->data('file_name');

            $data['building_id'] = $this->session->userdata('building_sess_id');

            $data['admin_id'] = $this->session->userdata('user_id');

            $data['new_file_name'] = $this->input->post('new_file_name');

            if($this->current_user_role == '0' OR $this->current_user_role == '4') 
            {
                $upload_file = $this->global_model->add('pm_docs',$data);
                if($upload_file) 
                {
                    $this->_msg('msg', 'File uploaded successfully.');
                    $this->_class('alert_class', 'alert-success');
                    _redirect_pre();

                } else {
                    $this->_msg('alert', 'Please try later');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();
                } 

            }           
        }            
        else {
            $this->_msg('alert', 'Please try again with allowed types.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        } 

    }

    public function meeting(){

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['meeting_data'] = $this->global_model->select_all('meeting_minutes',['building_id'=>$building_sess_id],'id','desc');

            // echo "<pre>";
            // print_r($data['meeting_data']);
            // exit();

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/meeting', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }        
    }

    public function meeting_minutes()
    {
        $data = $this->input->post();
        // echo "<pre>";
        // print_r($data);
        $config = [
                    'upload_path'   =>      './assets/building_docs',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];

        $this->load->library('upload', $config);   
 
        if($this->upload->do_upload('doc_file'))
        {
             
            $data['file_name'] = base_url('assets/building_docs/').$this->upload->data('file_name');
        }    
            $data['building_id'] = $this->current_building_id;

            $data['user_id'] = $this->current_user_id;

            if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
            {
                $upload_file = $this->global_model->add('meeting_minutes',$data);
                if($upload_file) 
                {
                    $this->_msg('msg', 'Meeting uploaded successfully.');
                    $this->_class('alert_class', 'alert-success');
                    _redirect_pre();

                } else {
                    $this->_msg('alert', 'Please try later');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();
                } 

            }           

    }

    public function meetings()
    {
            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['meeting_data'] = $this->global_model->select_all('meeting_minutes',['building_id'=>$this->current_building_id],'id','desc');

            // echo "<pre>";
            // print_r($data['meeting_data']);
            // exit();

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/meetings', $data);
            $this->load->view('users/dashboard/footer');         
    }

    public function update_meeting()
    {
        $id = $this->input->post('id');
        $data = $this->input->post();

        $config = [
                    'upload_path'   =>      './assets/building_docs',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];

        $this->load->library('upload', $config);   

        if($this->upload->do_upload('file_name'))
        {
            $data['file_name'] = base_url('assets/building_docs/').$this->upload->data('file_name');
        }  

        if($this->upload->do_upload('file_name2'))
        {
            $data['file_name2'] = base_url('assets/building_docs/').$this->upload->data('file_name');
        }  

        $data['building_id'] = $this->current_building_id;
        $data['user_id'] = $this->current_user_id;

        // echo "<pre>";
        // print_r($this->upload->data());
        // print_r($data);
        // exit();

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
        {
            $upload_file = $this->global_model->update('meeting_minutes',['id'=> $id ],$data);
            if($upload_file) 
            {
                $this->_msg('msg', 'Meeting updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
        }   
    }

    public function update_notice()
    {
        $id = $this->input->post('id');
        $notice = $this->input->post('notice');
        $new_file_name = $this->input->post('new_file_name');

        $data = $this->input->post();

        $config = [
                    'upload_path'   =>      './assets/building_notices',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];
        $this->load->library('upload', $config);   


        if($this->upload->do_upload('doc_file'))
        {
            $data['file_name'] = base_url('assets/building_notices/').$this->upload->data('file_name');
        }    

        $data['building_id'] = $this->current_building_id;

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
        {
            $upload_file = $this->global_model->update('building_notice',['id'=> $id ],$data);
            if($upload_file) 
            {
                $this->_msg('msg', 'Notice updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
        }        
    }

    public function update_event()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        
        $update = $this->global_model->update('event_requests',['id'=>$id],['status'=>$status]);

            if ( $update) 
            {
                $this->_msg('msg', 'Event status updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 

    }

    public function meeting_delete() {
        $data['id'] = $this->input->get('id');

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
            if ($this->global_model->delete('meeting_minutes', $data)) 
            {
                $this->_msg('msg', 'Meeting deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
        }
        else
        {
            $this->_msg('alert', 'You can not delete any meeting.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();            
        }

    }

    public function legal_docs()
    {
        if($this->current_user_role == '2' OR $this->current_user_role == '3')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('building_docs',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/legal_docs', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }         
    }

    public function admin_building_docs()
    {
        if($this->current_user_role == '1' OR $this->current_user_role == '4')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('admin_docs',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/admin_building_docs', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }         
    }




    public function view_notice()
    {
        if($this->current_user_role == '2' OR $this->current_user_role == '3')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            // $data['files_data'] = $this->global_model->select_all('building_docs',['building_id'=>$building_sess_id],'id','desc');

            $data['building_notices'] = $this->global_model->select_all('building_notice',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/view_notice', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }         
    }

    public function view_agm()
    {
        if($this->current_user_role == '2' OR $this->current_user_role == '3')
        {
            $building_sess_id = $this->session->userdata('building_sess_id');    

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

            $data['files_data'] = $this->global_model->select_all('agm',['building_id'=>$building_sess_id],'id','desc');

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/view_agm', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }         
    }

    public function upload_building_docs()
    {
        $config = [
                    'upload_path'   =>      './assets/building_docs',
                    'allowed_types' =>      'doc|xls|pdf|docx',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];

        $this->load->library('upload', $config);

        if($this->upload->do_upload('doc_file'))
        {
             
            $data['file_name'] = base_url('assets/building_docs/').$this->upload->data('file_name');

            $data['building_id'] = $this->session->userdata('building_sess_id');

            $data['admin_id'] = $this->session->userdata('user_id');

            $data['new_file_name'] = $this->input->post('new_file_name');

            if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
            {
                $upload_file = $this->global_model->add('building_docs',$data);
                if($upload_file) 
                {
                    $this->_msg('msg', 'File uploaded successfully.');
                    $this->_class('alert_class', 'alert-success');
                    _redirect_pre();

                } else {
                    $this->_msg('alert', 'Please try later');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();
                } 

            }           
        }            
        else {
                    $this->_msg('alert', 'Please try again with allowed types.');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();
                } 

    }


    public function update_building_docs()
    {
        $id = $this->input->post('id');
        $data = $this->input->post();

        $config = [
                    'upload_path'   =>      './assets/building_notices',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];
        $this->load->library('upload', $config);   
        if($this->upload->do_upload('doc_file'))
        {
            $data['file_name'] = base_url('assets/building_notices/').$this->upload->data('file_name');
        }    

            $data['building_id'] = $this->current_building_id;

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
        {
            $upload_file = $this->global_model->update('building_docs',['id'=> $id ],$data);
            if($upload_file) 
            {
                $this->_msg('msg', 'Notice updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
        }  
    }

    public function upload_admin_docs()
    {
        $config = [
                    'upload_path'   =>      './assets/building_docs',
                    'allowed_types' =>      'doc|xls|pdf|docx',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];

        $this->load->library('upload', $config);            
        if($this->upload->do_upload('doc_file'))
        {

            $data['file_name'] = base_url('assets/building_docs/').$this->upload->data('file_name');

            $data['building_id'] = $this->current_building_id;

            $data['admin_id'] = $this->session->userdata('user_id');

            $data['new_file_name'] = $this->input->post('new_file_name');

            if($this->current_user_role == '0' || $this->current_user_role == '1' || $this->current_user_role == '4') 
            {
                $upload_file = $this->global_model->add('admin_docs',$data);
                if($upload_file) 
                {
                    $this->_msg('msg', 'File uploaded successfully.');
                    $this->_class('alert_class', 'alert-success');
                    _redirect_pre();

                } else {
                    $this->_msg('alert', 'Please try later');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();
                } 

            }           
        }            
        else {
            $this->_msg('alert', 'Please try again with allowed types.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        } 

    }

    public function update_admin_building_docs()
    {
        $id = $this->input->post('id');

        $data = $this->input->post();

        $config = [
                    'upload_path'   =>      './assets/building_notices',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];
        $this->load->library('upload', $config);   

        if($this->upload->do_upload('doc_file'))
        {
            $data['file_name'] = base_url('assets/building_notices/').$this->upload->data('file_name');
        }    

        $data['building_id'] = $this->current_building_id;

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
        {
            $upload_file = $this->global_model->update('admin_docs',['id'=> $id ],$data);
            if($upload_file) 
            {
                $this->_msg('msg', 'Notice updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
        }        
    }

    public function upload_agm()
    {
        $config = [
            'upload_path'   =>      './assets/agm',
            'allowed_types' =>      'doc|xls|pdf|docx',
            'max_size'      =>      '10512',
            'overwrite'     =>      false,
            'max_filename'  =>      '200',
        ];

        $this->load->library('upload', $config);            
        if($this->upload->do_upload('doc_file'))
        {
            $data['file_name'] = base_url('assets/agm/').$this->upload->data('file_name');

            $data['building_id'] = $this->session->userdata('building_sess_id');

            $data['admin_id'] = $this->session->userdata('user_id');

            $data['new_file_name'] = $this->input->post('new_file_name');

            if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
            {
                $upload_file = $this->global_model->add('agm',$data);
                if($upload_file) 
                {
                    $this->_msg('msg', 'File uploaded successfully.');
                    $this->_class('alert_class', 'alert-success');
                    _redirect_pre();

                } else {
                    $this->_msg('alert', 'Please try later');
                    $this->_class('alert_class', 'alert-danger');
                    _redirect_pre();
                } 

            }           
        }            
        else {
            $this->_msg('alert', 'Please try again with allowed types.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        } 
    }


    public function update_agm()
    {
        $id = $this->input->post('id');
        $data = $this->input->post();

        $config = [
                    'upload_path'   =>      './assets/agm',
                    'allowed_types' =>      'pdf',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '200',
                    ];
        $this->load->library('upload', $config);   
        if($this->upload->do_upload('doc_file'))
        {
            $data['file_name'] = base_url('assets/agm/').$this->upload->data('file_name');
        }    

            $data['building_id'] = $this->current_building_id;

        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4') 
        {
            $upload_file = $this->global_model->update('agm',['id'=> $id ],$data);
            if($upload_file) 
            {
                $this->_msg('msg', 'Document updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
        }  
    }

    public function file_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('building_docs', $data)) 
            {
                $this->_msg('msg', 'File deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            


    } 

    public function admin_file_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('admin_docs', $data)) 
            {
                $this->_msg('msg', 'File deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            


    } 

    public function agm_file_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('agm', $data)) 
            {
                $this->_msg('msg', 'File deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
    } 

    public function pm_docs_file_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('pm_docs', $data)) 
            {
                $this->_msg('msg', 'File deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
    } 

    public function support_ticket(){

        // if($this->current_user_role == '2' OR $this->current_user_role == '3')
        // {   

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
            $data['user_tickets'] =$this->global_model->select_all('support_ticket',['user_id'=>$this->current_user_id]);

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/support_ticket', $data);
            $this->load->view('users/dashboard/footer');            
        // }
        // else
        // {
        //     _redirect('user/home');
        // }        
    }

    public function submit_ticket()
    {
        $data = $this->input->post();

        $data['user_id'] = $this->current_user_id;
        $data['user_role'] = $this->current_user_role;
        $data['building_id'] = $this->current_building_id;

        // echo "<pre>";
        // print_r($data);
        // exit();

        $insert_ticket = $this->global_model->add('support_ticket',$data);

        if ($insert_ticket) 
        {
            $this->_msg('msg', 'Your ticket submitted successfully.');
            $this->_class('alert_class', 'alert-success');
            _redirect_pre();

        } else {
            $this->_msg('alert', 'Please try again.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();
        } 
    }

    public function update_ticket()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['building_id'] = $this->current_building_id;
        $update = $this->global_model->update('support_ticket',['id'=>$id],['status'=>$status]);

            if ( $update) 
            {
                $this->_msg('msg', 'Ticket updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
    }

    public function tickets(){
        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);


            $data['active_user_tickets'] = $this->global_model->select_all('support_ticket',['building_id'=>$this->current_building_id],'id','desc');

            $data['total_tickets'] = $this->global_model->count_rows('support_ticket',['building_id'=>$this->current_building_id]);

            $data['total_active'] = $this->global_model->count_rows('support_ticket',['building_id'=>$this->current_building_id,'status'=>'1']);
            $data['total_inactive'] = $this->global_model->count_rows('support_ticket',['building_id'=>$this->current_building_id,'status'=>'0']);
            $data['total_responded'] = $this->global_model->count_rows('support_ticket',['building_id'=>$this->current_building_id,'responded'=>'1']);

            $data['user_tickets'] =$this->global_model->select_all('support_ticket',['user_id'=>$this->current_user_id]);

            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/tickets', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }        
    }

    public function reply_ticket()
    {
        $data['ticket_id'] = $this->input->post('ticket_id');
        $data['reply_message'] = $this->input->post('reply_message');

        $data['user_role'] = $this->current_user_role;   

        $this->global_model->update('support_ticket',['id'=>$data['ticket_id']],['responded'=>'1']);
        
        $reply = $this->global_model->add('ticket_replies',$data);

            if ( $reply) 
            {
                $this->_msg('msg', 'Ticket replied successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
    }

    public function request_booking()
    {
        // $data = $this->input->post();
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');

        $data['user_id'] = $this->current_user_id;
        $data['user_role'] = $this->current_user_role;
        $data['building_id'] = $this->current_building_id;


        if ($this->input->post('sameday') == '1') {
            $data['start_date'] = date("d/m/Y");
            $data['end_date'] = date("d/m/Y");
            $data['start_time'] = $this->input->post('start_time');
            $data['end_time'] = $this->input->post('end_time');
        }elseif($this->input->post('sameday') == '0')
        {
            $data['start_date'] = $this->input->post('start_date');
        }

        // echo "<pre>";
        // print_r($data);
        // exit();

        $event_requests = $this->global_model->add('event_requests',$data);
            if ( $event_requests) 
            {
                $this->_msg('msg', 'Booking requested successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
    }

    public function admin_request_booking()
    {

        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['start'] = $this->input->post('startdate');
        $data['end'] = $this->input->post('startdate');
        $data['color'] = $this->input->post('color');

        $data['building_id'] = $this->current_building_id;


        $event_requests_data['title'] = $this->input->post('title');
        $event_requests_data['description'] = $this->input->post('description');
        $event_requests_data['start_date'] = $this->input->post('startdate');
        $event_requests_data['end_date'] = $this->input->post('startdate');
        $event_requests_data['color'] = $this->input->post('color');

        $event_requests_data['building_id'] = $this->current_building_id;
        $event_requests_data['user_id'] = $this->current_user_id;
        $event_requests_data['user_role'] = $this->current_user_role;
        // echo "<pre>";
        // print_r($data);
        // exit();

        $event_requests = $this->global_model->add('events',$data);

        $event_requests = $this->global_model->add('event_requests',$event_requests_data);

            if ( $event_requests) 
            {
                $this->_msg('msg', 'Booking requested successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
    }    

    public function request_delete() {
        $data['id'] = $this->input->get('id');

            if ($this->global_model->delete('event_requests', $data)) 
            {
                $this->_msg('msg', 'Request deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            


    } 

    public function building_faq()
    {
        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
            $data['faq'] = $this->global_model->select_single('faq',['building_id'=>$this->current_building_id]);

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/building_faq', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }     
    }

    public function set_building_info()
    {
        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
            $data['building_info'] = $this->global_model->select_single('building_information',['building_id'=>$this->current_building_id]);

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/set_building_info', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }         
    }

    public function faq()
    {
            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
            $data['faq'] = $this->global_model->select_single('faq',['building_id'=>$this->current_building_id]);

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/faq', $data);
            $this->load->view('users/dashboard/footer');         
    }

    public function view_building_info()
    {
            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);
            $data['building_info'] = $this->global_model->select_single('building_information',['building_id'=>$this->current_building_id]);

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/view_building_info', $data);
            $this->load->view('users/dashboard/footer');          
    }

    public function post_faq()
    {
        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
        $data['faq'] = $this->input->post('faq');

        $data['user_id'] = $this->current_user_id;
        $data['building_id'] = $this->current_building_id;
           
        // echo "<pre>";
        // print_r($data);
        $check_faq = $this->global_model->select_single('faq',['building_id'=>$this->current_building_id]);
           if($check_faq) 
           {
                $event_requests = $this->global_model->update('faq',['building_id'=>$this->current_building_id],$data);
                // $event_requests = $this->global_model->add('faq',$data);
           }

           else
           {
                $event_requests = $this->global_model->add('faq',$data);
           }

        
            if ($event_requests) 
            {
                $this->_msg('msg', 'FAQ updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
        }
        else
        {
            _redirect('user/home');
        }          
    }

    public function post_building_info()
    {
        if($this->current_user_role == '0' OR $this->current_user_role == '1'  OR $this->current_user_role == '4')
        {
        $data['building_info'] = $this->input->post('building_info');

        $data['user_id'] = $this->current_user_id;
        $data['building_id'] = $this->current_building_id;
        $check_build_info = $this->global_model->select_single('building_information',['building_id '=> $this->current_building_id]);
           if($check_build_info) 
           {
                $event_requests = $this->global_model->update('building_information',['building_id'=>$this->current_building_id],$data);
           }

           else
           {
               $event_requests = $this->global_model->add('building_information',$data);
           }

        
            if ($event_requests) 
            {
                $this->_msg('msg', 'Building information updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try again.');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            
        }
        else
        {
            _redirect('user/home');
        }         
    }

    public function logout() {
        $this->_unset_userdata('user_id');
        $this->_unset_cookie('user_email');
        $this->_unset_cookie('user_password');

        _redirect('user_login');
    }


}
