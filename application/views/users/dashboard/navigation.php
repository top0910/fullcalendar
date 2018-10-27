<style>
  .sidebar-footer a{
    font-size: 15px;
  }  
</style>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?= base_url('user/home')?>">
                            <b>
                                <?php if ($this->session->userdata['custom_logo']): ?>
                                        <img src="<?= $this->session->userdata['custom_logo']; ?>" alt="homepage" class="light-logo" height='60' width = '200' />
                                    <?php else: ?>
                                        <img src="<?= base_url()?>assets/images/sub-logo.jpg" alt="homepage" class="light-logo" />
                                <?php endif ?>
                                
                            </b>
                        </a>
                            </div>
                            <!-- assets/images/sub-logo.jpg -->
                            <div class="navbar-collapse">
                                <ul class="navbar-nav mr-auto mt-md-0">

                 <!--                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                                    <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li> -->

                                </ul>
                                <ul class="navbar-nav my-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account Manager</a>
                                        <div class="dropdown-menu dropdown-menu-right scale-up">
                                            <ul class="dropdown-user">
                                                <li><a href="<?= base_url('user/profile')?>"><i class="ti-user"></i> My Profile</a></li>

                                                <li role="separator" class="divider"></li>
                                                <li><a href="<?= base_url()?>user/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </header>


                    <aside class="left-sidebar">
                        <!-- Sidebar scroll-->
                        <div class="scroll-sidebar">
                            <!-- Sidebar navigation-->
                            <nav class="sidebar-nav">
                                <ul id="sidebarnav">
                                    <li class="nav-small-cap">Navigation <i style="float: right;" class="mdi mdi-arrow-down-bold"></i></li>

                                    <?php if($this->session->userdata('user_role') == '0' 
                                        OR $this->session->userdata('user_role') == '1'
                                        OR $this->session->userdata('user_role') == '4'): ?>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/calendar" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                                        </li>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/home" aria-expanded="false" ><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> User Management </span></a>
                                        </li>                        
                                    <?php endif; ?>
                                    <?php if($this->session->userdata('user_role') == '0' 
                                        OR $this->session->userdata('user_role') == '1' ): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/email_mgmt" aria-expanded="false" ><i class="mdi mdi-email"></i><span class="hide-menu"> Email Management </span></a>

                                        </li>    
                                     <?php endif; ?>
                                    <?php if($this->session->userdata('user_role') == '2' OR $this->session->userdata('user_role') == '3'): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/home" aria-expanded="false" ><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> Home </span></a>

                                        </li>                        
                                    <?php endif; ?>


                                    <?php if($this->session->userdata('user_role') == '0'): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url('user/manage_emails')?>" aria-expanded="false" ><i class="fa fa-building-o"></i><span class="hide-menu"> Manage Archive Emails </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>building_data" aria-expanded="false" ><i class="fa fa-building-o"></i><span class="hide-menu"> Manage Buildings </span></a>
                                        </li>


                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>building_data/landing_page" aria-expanded="false" ><i class="fa fa-files-o"></i><span class="hide-menu"> Landing Page </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/admin_docs" aria-expanded="false" ><i class="fa fa-book"></i><span class="hide-menu"> Building Admin Docs </span></a>
                                        </li>

                                    <?php endif; ?>

                                    <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>building_data/admin_building_data" aria-expanded="false" ><i class="mdi mdi-login"></i><span class="hide-menu"> Login Page </span></a>
                                        </li>
                                    <?php endif; ?>


                                    <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>



                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/building_docs" aria-expanded="false" ><i class="fa fa-book"></i><span class="hide-menu"> Bylaws/Forms </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/agm" aria-expanded="false" ><i class="fa fa-book"></i><span class="hide-menu"> AGM Documents </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/meeting" aria-expanded="false" ><i class="fa fa-calendar-check-o"></i><span class="hide-menu"> Set Meeting </span></a>
                                        </li>
                                    <?php endif; ?>

                                    <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '4'): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/pm_docs" aria-expanded="false" ><i class="fa fa-book"></i><span class="hide-menu">Property Manager </span></a>
                                        </li>
                                    <?php endif; ?>


                                    <li>
                                        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/meetings" aria-expanded="false" ><i class="fa fa-calendar-check-o"></i><span class="hide-menu"> Meeting Minutes </span></a>
                                    </li>

                                    <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/tickets" aria-expanded="false" ><i class="fa fa-folder-open-o"></i> <span class="hide-menu">Support Ticket </span></a>
                                        </li>
                                    <?php endif; ?>


                                    <?php if($this->session->userdata('user_role') == '2' OR $this->session->userdata('user_role') == '3'): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/support_ticket" aria-expanded="false" ><i class="fa fa-folder-open-o"></i> <span class="hide-menu">Support Ticket </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/legal_docs" aria-expanded="false" ><i class="fa fa-file-text"></i> <span class="hide-menu">Bylaws/Forms </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/view_notice" aria-expanded="false" ><i class="fa fa-file-text"></i> <span class="hide-menu">Building Notice </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url('user/view_agm')?>" aria-expanded="false" ><i class="fa fa-file-text"></i> <span class="hide-menu">AGM Documents </span></a>
                                        </li>

                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/show_survey" aria-expanded="false" ><i class="fa fa-pie-chart"></i><span class="hide-menu">Survey </span></a>
                                        </li>

                                    <?php endif; ?>
                                    <li>
                                        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/calendar" aria-expanded="false" ><i class="fa fa-calendar"></i><span class="hide-menu">Calendar </span></a>
                                    </li>
                                    <?php if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>
                                        <li>
                                            <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/event_requests" aria-expanded="false" ><i class="fa fa-edit"></i><span class="hide-menu">Booking Requests </span></a>
                                        </li>
                                    <?php endif; ?>
<!--         <li>
<a href="#">
<i class="fa fa-envelope"></i> <span>Message</span>
</a>
</li> -->

<?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>
    <li>
        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/building_notice" aria-expanded="false" ><i class="fa fa-building"></i><span class="hide-menu">Building Notice </span></a>
    </li>
    <li>

        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/ask_survey" aria-expanded="false" ><i class="fa fa-pie-chart"></i><span class="hide-menu">Survey </span></a>
    </li>

<?php endif; ?>

<?php if( $this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>

    <li>

        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/building_faq" aria-expanded="false" ><i class="fa fa-comment-o"></i><span class="hide-menu">Building FAQ </span></a>
    </li>
    <li>

        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/set_building_info" aria-expanded="false" ><i class="fa fa-info"></i><span class="hide-menu">Building Information </span></a>

    </li>
<?php endif; ?>
<?php if($this->session->userdata('user_role') == '2' OR $this->session->userdata('user_role') == '3'): ?>
    <li>
        <a class="waves-effect waves-dark collapse" href="<?=base_url('user/faq')?>" aria-expanded="false" >
            <i class="fa fa-comment-o"></i> <span class="hide-menu">Building FAQ</span>
        </a>
    </li>

    <li>
        <a class="waves-effect waves-dark collapse" href="<?=base_url('user/view_building_info')?>" aria-expanded="false" >
            <i class="fa fa-info"></i> <span class="hide-menu">Building Information</span>
        </a>
    </li>

<?php endif; ?>


<?php if($this->session->userdata('user_role') == '1' OR $this->session->userdata('user_role') == '4'): ?>
    <li>
        <a class="waves-effect waves-dark collapse" href="<?=base_url()?>user/admin_building_docs" aria-expanded="false" >
            <i class="fa fa-dashboard"></i> <span class="hide-menu">Admin Documents</span>
        </a>
    </li>
<?php endif; ?>


<?php if($this->session->userdata('user_role') == '2'): ?>
    <li>
        <a class="waves-effect waves-dark collapse"  href="<?=base_url()?>user/tenant" aria-expanded="false" >
            <i class="fa fa-user-plus"></i> <span class="hide-menu">Add/Update Tenant</span>
        </a>
    </li>
<?php endif; ?>


</ul>
</nav>
<!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
<!-- Bottom points-->
<div class="sidebar-footer">
    <!-- item-->
    <a href="<?= base_url('user/profile')?>" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i><br/>Account</a>
    <!-- item-->
    <?php if($this->session->userdata('user_role') == '0' 
                                        OR $this->session->userdata('user_role') == '1' ): ?>
    <a href="<?= base_url('user/email_mgmt')?>" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i>Email</a>
                                        
    <?php endif; ?>  
    <!-- item-->
    <a href="<?= base_url()?>user/logout" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i>Logout</a>
</div>
<!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->