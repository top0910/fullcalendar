<?php 
class Building_data extends MY_Controller{

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

    }

	public function index()
	{	


        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->current_user_id]);

        $data['building_data'] = $this->global_model->select_all('building_data');
		$building_data = $this->global_model->select_all('building_data',['building_admin_id !='=> NULL]);

        foreach ($building_data as $value) {
            $data['admins_list'] = 
            $this->global_model->select_all('users',['user_id != ' => $value['building_admin_id'],'user_role'=>'1','status'=>'1' ]);

        }
        $data['msg']= $this->session->flashdata('msg');  
        $data['alert_class']= $this->session->flashdata('alert_class');
        $this->load->view('users/dashboard/header');
        $this->load->view('users/dashboard/navigation',$data);
        $this->load->view('users/building_management', $data);
        $this->load->view('users/dashboard/footer');

	}

    public function admin_building_data()
    {
        $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->_is_logged_in('user_id')]);

        if($this->current_user_role == '1' OR $this->current_user_role == '0' OR $this->current_user_role == '4')
        {
    
            $data['get_landing_page_data'] = $this->global_model->select_single('building_data',['id'=>$this->current_building_id]);

            // echo "<pre>";
            // print_r($data);
            // exit();

            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/build_login_data', $data);
            $this->load->view('users/dashboard/footer');            
        }
    }

    public function add_new_building()
    {
        $data['building_name']  = $this->input->post('building_name');
        $data['building_email'] = $this->input->post('building_email');
        $data['building_phone'] = $this->input->post('building_phone');
        $data['building_units'] = $this->input->post('building_units');
        $building_admin_id      = $this->input->post('building_admin_id');

        $check_email = $this->global_model->select_single('building_data',['building_email'=>$data['building_email']]);
        if(!$check_email)
        {
            $add_user = $this->global_model->add('building_data',$data);
            if($add_user)
            {
                $building_id = $this->global_model->select_single('building_data',['building_email'=>$data['building_email']]);
                $this->global_model->update('users',['user_id'=>$building_admin_id],['building_id'=>$building_id['id']]);    
    
                $this->_msg('msg', 'New building added successfully.');
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

    public function update_building()
    {

        $building_id = $this->input->post('id');
        $building_name = $this->input->post('building_name');
        $building_email = $this->input->post('building_email');
        $building_phone = $this->input->post('building_phone');
        $building_units = $this->input->post('building_units');
        $building_admin_id = $this->input->post('building_admin_id');
        $status = $this->input->post('status');
        $updated_at = date('Y-m-d H:i:s');

        $check_build_admin_tbl = $this->global_model->select_single('building_admins_tbl',['building_id'=>$building_id]);

        if(!$check_build_admin_tbl)
        {
        $this->global_model->add('building_admins_tbl',['building_id'=>$building_id,'building_admin_id'=>$building_admin_id]);
        }
        else{
        $this->global_model->update('building_admins_tbl',['building_id'=>$building_id],['building_id'=>$building_id,'building_admin_id'=>$building_admin_id]);
        }

        $building_update = $this->global_model->update('building_data', ['id'=>$building_id], 
                        [
                            'building_name'=>$building_name,
                            'building_email'=>$building_email,
                            'building_phone'=>$building_phone,
                            'building_units'=>$building_units,
                            'building_admin_id'=>$building_admin_id,
                            'status'=>$status,
                            'updated_at'=>$updated_at
                        ]);
        if($building_update)
        {   
            $this->_msg('msg', 'Building updation successful!');
            $this->_class('alert_class', 'alert-success');
            _redirect_pre();

        }
        else
        {
            $this->_msg('msg', 'Building updation failed!');
            $this->_class('alert_class', 'alert-warning');
            _redirect_pre();            
        }
    }  

    public function update_faq()
    {

        $building_id = '1';
        $building_faq = $this->input->post('faq');

        $building_update = $this->global_model->update('main_landing_page', ['building_id'=>$building_id],['faq'=> $building_faq]);
        if($building_update)
        {   
            $this->_msg('msg', 'Building updation successful!');
            $this->_class('alert_class', 'alert-success');
            _redirect_pre();

        }
        else
        {
            $this->_msg('msg', 'Building updation failed!');
            $this->_class('alert_class', 'alert-warning');
            _redirect_pre();            
        }
    }  

    public function building_delete() {
        $data['id'] = $this->input->get('id');

        if($this->current_user_role == '0')
        {
            if ($this->global_model->delete('building_data', $data)) 
            {
                // if buuilding is deleted, set all users->building_id = NULL
                $this->global_model->update('users',['building_id'=>$data['id'],'user_role'=>'1'],['building_id'=>NULL]);
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
            $this->_msg('alert', 'You can not delete a building, Contact Strata365 Manager.');
            $this->_class('alert_class', 'alert-danger');
            _redirect_pre();            
        }

    } 

    public function landing_page()
    {
        if($this->current_user_role == '0')
        {
            $data['get_landing_page_data'] = $this->global_model->select_single('main_landing_page',['id'=>1]);

            $data['current_user'] = $this->global_model->select_single('users',['user_id'=>$this->_is_logged_in('user_id')]);

            $data['building_dashboard'] = $this->global_model->select_single('building_dashboard',['building_id'=>'1']);

            // Send flashdata of alert messages and Show the alert message.    
            $data['msg']= $this->session->flashdata('msg');  
            $data['alert_class']= $this->session->flashdata('alert_class');
            $this->load->view('users/dashboard/header');
            $this->load->view('users/dashboard/navigation',$data);
            $this->load->view('users/landing_page', $data);
            $this->load->view('users/dashboard/footer');            
        }
        else
        {
            _redirect('user/home');
        }
    	
    }

    public function upload_logo()
    {
            $config = [
                        'upload_path'   =>      './assets/img/building_banner',
                        'allowed_types' =>      'jpg|gif|png|jpeg',
                        'max_size'      =>      '10512',
                        'overwrite'     =>      false,
                        'max_filename'  =>      '100',
                        'remove_spaces' =>      true,
                        ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('logo_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');


            if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
            {
                $check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
                if(!$check_build_id)
                {
                    $upload_banner = $this->global_model->add('building_dashboard',['logo_image'=>$file_name,'building_id'=>1]);
                    _redirect_pre();
                }
                else
                {
                    $upload_banner = $this->global_model->update('building_dashboard',['building_id'==1],['logo_image'=>$file_name]);
                    _redirect_pre();

                }
    
            }
    }

    public function upload_icon_bar()
    {
            $config = [
                        'upload_path'   =>      './assets/img/building_banner',
                        'allowed_types' =>      'jpg|gif|png|jpeg',
                        'max_size'      =>      '10512',
                        'overwrite'     =>      false,
                        'max_filename'  =>      '100',
                        'remove_spaces' =>      true,
                        ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('icon_bar_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');


            if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
            {
                $check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
                if(!$check_build_id)
                {
                    $upload_banner = $this->global_model->add('building_dashboard',['icon_bar_image'=>$file_name,'building_id'=>1]);
                    _redirect_pre();
                }
                else
                {
                    $upload_banner = $this->global_model->update('building_dashboard',['building_id'==1],['icon_bar_image'=>$file_name]);
                    _redirect_pre();

                }
    
            }
    }

    public function delete_iconbar() {
            $data['icon_bar_image'] = '';       

            if ($this->global_model->update('building_dashboard',['building_id'=> '1'],$data)) 
            {
                $this->_msg('msg', 'Image deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            

    }

    public function upload_demo_graphic()
    {
            $config = [
                        'upload_path'   =>      './assets/img/building_banner',
                        'allowed_types' =>      'jpg|gif|png|jpeg',
                        'max_size'      =>      '10512',
                        'overwrite'     =>      false,
                        'max_filename'  =>      '100',
                        'remove_spaces' =>      true,
                        ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('demo_graphic_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');


            if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
            {
                $check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
                if(!$check_build_id)
                {
                    $upload_banner = $this->global_model->add('building_dashboard',['demo_graphic_image'=>$file_name,'building_id'=>1]);
                    _redirect_pre();
                }
                else
                {
                    $upload_banner = $this->global_model->update('building_dashboard',['building_id'==1],['demo_graphic_image'=>$file_name]);
                    _redirect_pre();

                }
    
            }
    }

    public function delete_demographic() {
            $data['demo_graphic_image'] = '';       
            
            if ($this->global_model->update('building_dashboard',['building_id'=> '1'],$data)) 
            {
                $this->_msg('msg', 'Image deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            

    }

    public function upload_banner()
    {
            $config = [
			            'upload_path'   =>      './assets/img/building_banner',
			            'allowed_types' =>      'jpg|gif|png|jpeg',
			            'max_size'      =>      '10512',
			            'overwrite'     =>      false,
			            'max_filename'  =>		'100',
			            'remove_spaces' =>		true,
			            ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('banner_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');

			if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
			{
				$check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
				if(!$check_build_id)
				{
					$upload_banner = $this->global_model->add('building_dashboard',['banner_image'=>$file_name,'building_id'=>1]);
					_redirect_pre();
				}
				else
				{
					$upload_banner = $this->global_model->update('building_dashboard',['building_id'==1],['banner_image'=>$file_name]);
					_redirect_pre();

				}
    		}
	}

    public function upload_pricing_one()
    {
            $config = [
                        'upload_path'   =>      './assets/img/building_banner',
                        'allowed_types' =>      'jpg|gif|png|jpeg',
                        'max_size'      =>      '10512',
                        'overwrite'     =>      false,
                        'max_filename'  =>      '100',
                        'remove_spaces' =>      true,
                        ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('pricing_one_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');
            
            $pricing_one_image_url = $this->input->post('pricing_one_image_url');

            if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
            {
                $check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
                if(!$check_build_id)
                {
                    $pricing_one_image = $this->global_model->add('building_dashboard',['pricing_one_image'=>$file_name,'building_id'=>1,'pricing_one_image_url'=>$pricing_one_image_url]);
                    _redirect_pre();
                }
                else
                {
                    $pricing_one_image = $this->global_model->update('building_dashboard',['building_id'==1],['pricing_one_image'=>$file_name,'pricing_one_image_url'=>$pricing_one_image_url]);
                    _redirect_pre();

                }
            }
    }

    public function upload_pricing_two()
    {
            $config = [
                        'upload_path'   =>      './assets/img/building_banner',
                        'allowed_types' =>      'jpg|gif|png|jpeg',
                        'max_size'      =>      '10512',
                        'overwrite'     =>      false,
                        'max_filename'  =>      '100',
                        'remove_spaces' =>      true,
                        ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('pricing_two_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');
            $pricing_two_image_url = $this->input->post('pricing_two_image_url');
            if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
            {
                $check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
                if(!$check_build_id)
                {
                    $pricing_two_image = $this->global_model->add('building_dashboard',['pricing_two_image'=>$file_name,'building_id'=>1,'pricing_two_image_url'=>$pricing_two_image_url]);
                    _redirect_pre();
                }
                else
                {
                    $pricing_two_image = $this->global_model->update('building_dashboard',['building_id'==1],['pricing_two_image'=>$file_name,'pricing_two_image_url'=>$pricing_two_image_url]);
                    _redirect_pre();

                }
            }
    }
    
    public function upload_pricing_three()
    {
            $config = [
                        'upload_path'   =>      './assets/img/building_banner',
                        'allowed_types' =>      'jpg|gif|png|jpeg',
                        'max_size'      =>      '10512',
                        'overwrite'     =>      false,
                        'max_filename'  =>      '100',
                        'remove_spaces' =>      true,
                        ];
            $this->load->library('upload', $config);
            $this->upload->do_upload('pricing_three_image');

            $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');
            $pricing_three_image_url = $this->input->post('pricing_three_image_url');
            if($this->current_user_role == 0) // if loggedin user is manager, His building id (for strata.com page) = 1
            {
                $check_build_id = $this->global_model->select_single('building_dashboard',['building_id'==1]);
                if(!$check_build_id)
                {
                    $pricing_three_image = $this->global_model->add('building_dashboard',['pricing_three_image'=>$file_name,'building_id'=>1,'pricing_three_image_url'=>$pricing_three_image_url]);
                    _redirect_pre();
                }
                else
                {
                    $pricing_three_image = $this->global_model->update('building_dashboard',['building_id'==1],['pricing_three_image'=>$file_name,'pricing_three_image_url'=>$pricing_three_image_url]);
                    _redirect_pre();

                }
            }
    }
    

    public function update_landing_page()
    {
        $data = $this->input->post();

        $check_data = $this->global_model->select_single('main_landing_page',['id'=>1]);    
        if(!$check_data)
        {
            $add_data = $this->global_model->add('main_landing_page',$data);
        }
        else{
            $add_data = $this->global_model->update('main_landing_page',['id'=>1],$data);
        }

        if ($add_data) 
            {
                $this->_msg('msg', 'Data updated successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            } 
    }

    public function upload_login_banner()
    {
        $config = [
                    'upload_path'   =>      './assets/img/building_banner',
                    'allowed_types' =>      'jpg|gif|png|jpeg',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '100',
                    'remove_spaces' =>      true,
                    ];
        $this->load->library('upload', $config);
        $this->upload->do_upload('building_image');
        $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');

        $this->global_model->update('building_data',['id'=>$this->session->userdata('building_sess_id')],['building_image'=> $file_name]);
        _redirect_pre();

    }


    public function upload_custom_logo()
    {
        $config = [
                    'upload_path'   =>      './assets/img/building_banner',
                    'allowed_types' =>      'jpg|gif|png|jpeg',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '100',
                    'remove_spaces' =>      true,
                    ];
        $this->load->library('upload', $config);
        $this->upload->do_upload('custom_logo');
        $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');

        $this->global_model->update('building_data',['id'=>$this->session->userdata('building_sess_id')],['custom_logo'=> $file_name]);
        _redirect_pre();

    }

    public function upload_login_banner2()
    {
        $config = [
                    'upload_path'   =>      './assets/img/building_banner',
                    'allowed_types' =>      'jpg|gif|png|jpeg',
                    'max_size'      =>      '10512',
                    'overwrite'     =>      false,
                    'max_filename'  =>      '100',
                    'remove_spaces' =>      true,
                    ];
        $this->load->library('upload', $config);
        $this->upload->do_upload('building_image2');
        $file_name = base_url('assets/img/building_banner/').$this->upload->data('file_name');

        $this->global_model->update('building_data',['id'=>$this->session->userdata('building_sess_id')],['building_image2'=> $file_name]);
        _redirect_pre();

    }

    public function image2_delete() {
            $data['building_image2'] = '';       

            if ($this->global_model->update('building_data',['id'=> '1'],$data)) 
            {
                $this->_msg('msg', 'Image deleted successfully.');
                $this->_class('alert_class', 'alert-success');
                _redirect_pre();

            } else {
                $this->_msg('alert', 'Please try later');
                $this->_class('alert_class', 'alert-danger');
                _redirect_pre();
            }            

    }

    public function update_login_page()
    {
        $this->global_model->update('building_data',['id'=>$this->session->userdata('building_sess_id')],
            ['building_title'=> $this->input->post('building_title'),
             'building_text'=> $this->input->post('building_text')
            ]);
        _redirect_pre();
    }


}
?>