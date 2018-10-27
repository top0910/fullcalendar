<?php  
$config = array(
        'admin_login' => array(
                array(
                        'field' => 'admin_email',
                        'label' => 'Admin Email',
                        'rules' => 'required|is_unique[admin_user.admin_email]'
                ),
                array(
                        'field' => 'admin_password',
                        'label' => 'Admin Password',
                        'rules' => 'required'
                ),

        ),

        'user_login' => array(
                array(
                        'field' => 'user_email',
                        'label' => 'User Email',
                        'rules' => 'required'
                ),
                array(
                        'field' => 'user_password',
                        'label' => 'User Password',
                        'rules' => 'required'
                ),

        )        
);
?>