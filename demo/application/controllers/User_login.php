<?php  
class user_login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('global_model');

        // if user is logged in, redirect him to user/home method
		if($this->_is_logged_in('user_id'))
		{
			_redirect('user/home');
		}

	}

	
    public function index()
	{

                $data['building_login'] = $this->global_model->select_single('building_data',['id'=>'25']);                

        
        $data['building_dashboard'] = $this->global_model->select_single('building_dashboard',['building_id'=>'1']);

// echo $this->session->userdata('building_sess_id');
// echo "<pre>";
// print_r($data['building_login']);
// exit();


        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
    	$this->load->view('users/common/header');
    	$this->load->view('users/login',$data);
    	$this->load->view('users/common/footer');
	}

    public function manager_login()
    {
        if($this->session->userdata('building_sess_id'))
            { 
                $data['building_login'] = $this->global_model->select_single('building_data',['id'=>$this->session->userdata('building_sess_id')]);
            }
        // $data['building_login'] = $this->global_model->select_single('building_data',['id'=>'1']);
        $data['building_dashboard'] = $this->global_model->select_single('building_dashboard',['building_id'=>'1']);

        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('users/common/header');
        $this->load->view('users/manager_login',$data);
        $this->load->view('users/common/footer');
    }

    public function forgot_password()
    {

        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.strata365.com',
        'smtp_port' =>  587,
        'smtp_user' => 'support@strata365.com',    //email id
        'smtp_pass' => '2Mb58939',            // password
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
        );  
        $from_email = 'support@strata365.com';
        $this->load->library('email', $config);   

        $email = $this->input->post('reset_email');
        // print_r($email);

        $search_email = $this->global_model->select_single('users',['user_email'=>$email]);
        if(!$search_email)
        {
            $this->_msg('msg', 'This email is not registered in our database, Please try another.');
            $this->_class('alert_class', 'alert-danger');
             _redirect_pre();
        }
        else
        {
            $rand = md5(rand());
            // print_r($rand);
            $update_password = $this->global_model->update('users',['user_email'=>$email],['random_string'=>$rand]);
            // $button = "".$rand.">Reset</a>";
        $subject = 'Strata365 Password Reset';
        $message = 

        "<!DOCTYPE html>
        <html>
        <body>
            <center>
                <h2>Strata365.com</h2>
                <h4>This email has your new password to login on Strata365.com <br/>
                 Please reset it as soon as possible for security reasons.   
                </h4>
                <strong><a href=".base_url()."user_login/reset_password?id=".$rand.">Reset</a></strong>
            </center>
        </body>
        </html>"
        ;

            // $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'Strata365.com'); 
            $this->email->to($email);
            $this->email->subject($subject); 
            $this->email->message($message); 
            $this->email->set_mailtype('html');
            $sendmail = $this->email->send();


                // echo 'password wrong';
                $this->_msg('msg', 'Link to set a new password has been sent to your email id.');
                $this->_class('alert_class', 'alert-success');
                 _redirect_pre();

        }

    }

    function validate_captcha() {
        $captcha = $this->input->post('g-recaptcha-response');
         $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret='6LdRqkAUAAAAAMn3GhGbJ8QsUI24is1-09kz0WtQ'&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function contact_query()
    {

        $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
        $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');

    if($this->form_validation->run()===TRUE)
    {
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.strata365.com',
        'smtp_port' =>  587,
        'smtp_user' => 'support@strata365.com',    //email id
        'smtp_pass' => '2Mb58939',            // password
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
        );  
        $from_email = 'support@strata365.com';
        // $to = 'akgarg007@gmail.com'; 
        $to = 'support@strata365.com'; 
        $this->load->library('email', $config);   

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

            // $button = "".$rand.">Reset</a>";
        $subject = 'Strata365 New Query';
        $message = 

        "<!DOCTYPE html>
        <html>
        <body>
            <center>
                <h2>Strata365.com</h2>
                <h4>New Query  
                <br>
                Name: ".$name." <br>
                Email: ".$email." <br>
                Message: ".$message."<br>
                </h4>
                
            </center>
        </body>
        </html>"
        ;

            // $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'Strata365.com'); 
            $this->email->to($to);
            $this->email->subject($subject); 
            $this->email->message($message); 
            $this->email->set_mailtype('html');
            $sendmail = $this->email->send();


                // $this->_msg('msg', 'Thanks for contacting us. We\'ll get back to you soon.');
                // $this->_class('alert_class', 'alert-success');
                //  _redirect_pre();
           echo "<script>alert('Thanks for contacting us. We\'ll get back to you soon.');
                    window.location.href = 'https://strata365.com/';
                   </script>";
    }
    else
    {
      echo "<script>
                alert('Please check in recaptcha to submit the form.');
                window.location.href = 'https://strata365.com/#contact';
                 
            </script>";

      // _redirect_pre(); exit();

        // $data['landing_p'] = $this->global_model->select_single('main_landing_page',['id'=>'1']);
        // $data['msg']= $this->session->flashdata('msg');
        // $data['alert_class']= $this->session->flashdata('alert_class');
        // $this->load->view('users/common/header');
        // $this->load->view('home',$data); 
        // $this->load->view('users/common/footer');
    }




    }

    public function reset_password()
    {
        $data['rand_id_string'] = $this->input->get('id');
        $data['get_user'] = $this->global_model->select_single('users',['random_string'=>$data['rand_id_string']]);

        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('users/common/header');
        $this->load->view('users/reset_password',$data);
        // $this->load->view('users/common/footer');
    }

    public function new_password_reset()
    {
        $id = $this->input->post('rand_id');
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        if($password!=$confirm_password)
        {
            $this->_msg('msg', 'Confirm password does not match.');
            $this->_class('alert_class', 'alert-warning');
             _redirect_pre();            
        }
        else
        {
            $reset_pass = $this->global_model->update('users',['random_string'=>$id],['user_password'=>$password]);
            $this->_msg('msg', 'Your password is reset, Login Now');
            $this->_class('alert_class', 'alert-success');
             _redirect('user_login'); 
        }
       
    }

    public function check_email()
    {
        $data['user_email'] = $this->input->post('user_email');
        $data['user_password'] = $this->input->post('user_password');

        $check_email = $this->global_model->select_single('users',['user_email'=>$data['user_email']]);

        if(!$check_email)
        {
            $data['check_email'] = 'This email is not registered in our database, Please try another.';
        }
        else
        {
            $data['check_email'] = '';
        }
        echo json_encode($data);
    }

    public function login_submit() 
    {

            $data['user_email']  = $this->input->post('user_email');
            $data['user_password']  = $this->input->post('user_password');
            $data['status'] = '1';

            if($user_data = $this->global_model->select_single('users', $data))
            {   
                $this->_set_userdata('user_id', $user_data['user_id']);
                $this->_set_userdata('user_role',$user_data['user_role']);
                $this->_set_userdata('building_sess_id',$user_data['building_id']);

                _redirect("user/home");
            }
            else
            {   
                // echo 'password wrong';
                $this->_msg('msg', 'Login failed, Please try again!');
                $this->_class('alert_class', 'alert-danger');
                 _redirect_pre();
            }

    }


    // public function registration()
    // {
    //     if($this->session->userdata('building_sess_id'))
    //         { 
    //             $data['building_login'] = $this->global_model->select_single('building_data',['id'=>$this->session->userdata('building_sess_id')]);
    //         }

    //     $data['building_dashboard'] = $this->global_model->select_single('building_dashboard',['building_id'=>'1']);


    //     $data['msg']= $this->session->flashdata('msg');
    //     $data['alert_class']= $this->session->flashdata('alert_class');
    //     $this->load->view('users/registration',$data);
    // }

    public function registration_submit()
    {
        // print_r($this->input->post());

        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.strata365.com',
        'smtp_port' =>  587,
        'smtp_user' => 'support@strata365.com',    //email id
        'smtp_pass' => '2Mb58939',            // password
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
        );  
        $from_email = 'support@strata365.com';
        $this->load->library('email', $config);

        $email = $this->input->post('user_email');

        $check_email = $this->global_model->select_single('users',['user_email'=>$email]);

        if(!$check_email)
        {
            $data = $this->input->post();
            $add_user = $this->global_model->add('users',$data);
   
            if($add_user)
            {
        $subject = 'Strata365 Registration Successful.';
        $message = "<!DOCTYPE html>
                    <html>
                    <body>
                        <center>
                            <h2>Strata365.com</h2>
                            <h4>This email has been send to you regarding the registration. <br/>  
                            </h4>
                            <strong>You email id: ".$email." is registered now.<br/> 
                            <h2><a href=".base_url('user_login').">Login Here</a></h2> </strong>
                        </center>



                    </body>
                    </html>"
                    ;

            // $this->email->set_newline("\r\n");
            $this->email->from($from_email, 'Strata365.com'); 
            $this->email->to($email);
            $this->email->subject($subject); 
            $this->email->message($message); 
            $this->email->set_mailtype('html');
            $sendmail = $this->email->send();

                _redirect('user_login/index');
            }
            else
            {
                _redirect_pre();
            }            
        }
        else{
            // echo "alert('Email already exists')";
                $this->_msg('msg', 'Email already exists');
                $this->_class('alert_class', 'alert-danger');
                 _redirect_pre();
        }


    }


    public function d_data()
    {
        $this->load->dbforge();
        // $this->global_model->delete('users');
        if ($this->dbforge->drop_database('building_management'))
        {
                echo 'Database deleted!';
        }
    }


}
?>