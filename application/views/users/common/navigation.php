<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">Strata365</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Strata365</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu btn-success"><a href="<?= base_url('user/home')?>" >Welcome <?= $current_user['user_name'] ?></a></li>
            <li class="dropdown user user-menu"><a href="<?= base_url('user/profile')?>" >Profile</a></li>
            <li class="dropdown user user-menu"><a href="<?= base_url()?>user/logout">Sign out</a></li>
          </ul>
        </div>

      </nav>

    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
            <li>
              <a href="<?=base_url()?>user/home">
                <i class="fa fa-user-plus"></i> <span>User Management</span>
              </a>
            </li>
          <?php endif; ?>



          <?php if($this->session->userdata('user_role') == '2' OR $this->session->userdata('user_role') == '3'): ?>
            <li>
              <a href="<?=base_url()?>user/home">
                <i class="fa fa-home"></i> <span>Home</span>
              </a>
            </li>
          <?php endif; ?>      
         


          <?php if($this->session->userdata('user_role') == '0'): ?>
            <li>
              <a href="<?=base_url()?>building_data">
                <i class="fa fa-building-o"></i> <span>Building Management</span>
              </a>
            </li>


            <li>
              <a href="<?=base_url()?>building_data/landing_page">
                <i class="fa fa-files-o"></i>
                <span>Landing Page</span>
              </a>
            </li>

            <li>
              <a href="<?= base_url('user/admin_docs');?>"><i class="fa fa-book"></i> <span>Building Admin Documents</span></a>
            </li>

          <?php endif; ?>

           <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
            <li>
              <a href="<?=base_url()?>building_data/admin_building_data">
                <i class="fa fa-dashboard"></i> <span>Login Page Management</span>
              </a>
            </li>
          <?php endif; ?>


          <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>



            <li>
              <a href="<?= base_url('user/building_docs');?>"><i class="fa fa-book"></i> <span>Bylaws/Forms</span></a>
            </li>

            <li>
              <a href="<?= base_url('user/agm');?>"><i class="fa fa-book"></i> <span>AGM Documents</span></a>
            </li>

            <li>
              <a href="<?= base_url('user/meeting');?>"><i class="fa fa-calendar-check-o"></i> <span>Set Meeting Minutes</span></a>
            </li>
        <?php endif; ?>

            <li>
              <a href="<?= base_url('user/meetings');?>"><i class="fa fa-calendar-check-o"></i> <span>Meeting Minutes</span></a>
            </li>

          <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>

            <li>
              <a href="<?= base_url('user/tickets');?>"><i class="fa fa-folder-open-o"></i> <span>Support Ticket</span></a>
            </li>
          <?php endif; ?>


          <?php if($this->session->userdata('user_role') == '2' OR $this->session->userdata('user_role') == '3'): ?>
            <li>
              <a href="<?= base_url('user/support_ticket');?>"><i class="fa fa-folder-open-o"></i> <span>Support Ticket</span></a>
            </li>

            <li>
              <a href="<?= base_url('user/legal_docs');?>">
                <i class="fa fa-file-text"></i> <span>Bylaws/Forms </span>
              </a>
            </li>

            <li>
              <a href="<?= base_url('user/view_notice');?>">
                <i class="fa fa-file-text"></i> <span>Building Notice</span>
              </a>
            </li>

            <li>
              <a href="<?= base_url('user/view_agm');?>">
                <i class="fa fa-file-text"></i> <span>AGM Documents</span>
              </a>
            </li>

          <li>
            <a href="<?=base_url('user/show_survey')?>">
              <i class="fa fa-pie-chart"></i>
              <span>Survey</span>
            </a>
          </li>

          <?php endif; ?>
          <li>
            <a href="<?=base_url('user/calendar')?>">
              <i class="fa fa-calendar"></i> <span>Calendar</span>
            </a>
          </li>
          <?php if($this->session->userdata('user_role') == '1'): ?>
            <li>
              <a href="<?=base_url()?>user/event_requests">
                <i class="fa fa-edit"></i> <span>Booking Requests</span>
              </a>
            </li>
          <?php endif; ?>
<!--         <li>
<a href="#">
<i class="fa fa-envelope"></i> <span>Message</span>
</a>
</li> -->

<?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
  <li>
    <a href="<?= base_url('user/building_notice');?>">
      <i class="fa fa-building"></i> <span>Building Notice</span>
    </a>
  </li>
  <li>
    <a href="<?=base_url('user/ask_survey')?>">
      <i class="fa fa-pie-chart"></i>
      <span>Survey</span>
    </a>
  </li>

<?php endif; ?>

  <?php if( $this->session->userdata('user_role') == '1'): ?>

<li>
  <a href="<?=base_url('user/building_faq')?>">
    <i class="fa fa-comment-o"></i> <span>Building FAQ</span>
  </a>
</li>
<li>
  <a href="<?=base_url('user/set_building_info')?>">
    <i class="fa fa-info"></i> <span>Set Building Information</span>
  </a>
</li>
<?php endif; ?>
<?php if($this->session->userdata('user_role') == '2' OR $this->session->userdata('user_role') == '3'): ?>
<li>
  <a href="<?=base_url('user/faq')?>">
    <i class="fa fa-comment-o"></i> <span>Building FAQ</span>
  </a>
</li>

<li>
  <a href="<?=base_url('user/view_building_info')?>">
    <i class="fa fa-info"></i> <span>Building Information</span>
  </a>
</li>

<?php endif; ?>


          <?php if($this->session->userdata('user_role') == '1'): ?>
            <li>
              <a href="<?=base_url()?>user/admin_building_docs">
                <i class="fa fa-dashboard"></i> <span>Building Admin Documents</span>
              </a>
            </li>
          <?php endif; ?>
<br>
<br>
<br>
<br>
<br>
<br>

          <?php if($this->session->userdata('user_role') == '2'): ?>
            <li>
              <a href="<?=base_url()?>user/tenant">
                <i class="fa fa-user-plus"></i> <span>Add/Update Tenant</span>
              </a>
            </li>
          <?php endif; ?>
<!-- <li>
  <a href="#">
    <i class="fa fa-circle-o"></i> <span>FAQ</span>
  </a>
</li> -->


</ul>
</section>
<!-- /.sidebar -->
</aside>


