<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function _ip() {
        return $this->input->ip_address();
    }

    public function _post($param = false) {
        return $this->input->post($param);
    }

    public function _is_logged_in($userdata) {
        if ($data = $this->session->userdata($userdata)) {
            return $data ? $data : false;
        }
    }

    public function _set_userdata($data_name, $data) {
        return $this->session->set_userdata($data_name, $data);
    }

    public function _unset_userdata($data_name) {
        return $this->session->unset_userdata($data_name);
    }

    public function _msg($msg_name, $msg) {
        return $this->session->set_flashdata($msg_name, $msg);
    }

    public function _class($class_name, $class) {
        return $this->session->set_flashdata($class_name,$class);
    }

    /* Cookies Functions Starts */
    public function _set_cookie($cookie_name,$cookie_value,$cookie_expire){
        return $this->input->set_cookie($cookie_name,$cookie_value,$cookie_expire);
    }

    public function _read_cookie($cookie_name){
        return $this->input->cookie($cookie_name);
    } 

    public function _unset_cookie($cookie_name){
        if($cookie_name){
            return delete_cookie($cookie_name);
        }
    }

    /* Cookies Functions Ends */

    public function _send_email($from, $name, $to, $subject, $page,$page_data) {
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

$this->email->initialize($config);
        $this->email
                ->from($from, $name)
                ->to($to)
                ->subject($subject)
                ->message($this->load->view($page,$page_data,TRUE));
       if ($this->email->send()) {
            return true;
        } else {
            return FALSE;
        }
    }

    public function _pagination($url, $per_page, $total_rows, $url_seg) {
        $this->load->library('pagination');
        $config = [
            'base_url' => base_url($url),
            'per_page' => $per_page,
            'total_rows' => $total_rows,
            'full_tag_open' => "<ul class='pagination'>",
            'full_tag_close' => '</ul>',
            'next_link' => 'Next ',
            'prev_link' => 'Previous',
            'uri_segment' => $url_seg,
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => "<li class='active'><a>",
            'cur_tag_close' => '</a></li>',
            'display_pages' => TRUE,
        ];
        return $config;
    }

}
