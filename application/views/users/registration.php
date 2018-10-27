<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Strata365 | User Registration </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/intlTellnput.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">

        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<style>

.logo_image{
    /*margin-top: -15px;*/
    /*margin-bottom: 15px;*/
    max-height: 80px;
    padding-left: 70px;
}

.navbar-default .navbar-collapse, .navbar-default .navbar-form{
        padding-bottom: 21px;
}
</style>
<body id="body">

<!--
Header start
==================== -->
    <div class="navbar-default navbar-fixed-top" id="navigation">
        <div class="container" id="container-width">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://strata365.com/" id="logo-img">
        <?php 
        if (empty($building_dashboard['logo_image'])) { ?>
            <img src="<?=base_url()?>assets/backend/img/header/sub-logo.png" alt="logo" class='logo_image'>
        <?php }
        else
        { ?>
            <img src="<?= $building_dashboard['logo_image'] ?>" alt="logo"  class='logo_image'>
        <? } ?>
                </a>
            </div>
            <nav class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right" id="top-nav">
                     <li><a href="<?=base_url()?>user_login/index" id="login_form">Login</a></li>
                </ul>
            </nav><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
    <section id="hero-area1">
        <div class="container">
            <div class="row" style="text-align: center">
                <div class="body-text" style="color: #545050;">
                    <h2><b><?php if(isset($building_login['building_title'])){echo $building_login['building_title'];}else{echo "Strata Managment made easy to use and to follow"; } ?></b></h2><br>
                    <h4><?php if(isset($building_login['building_text'])){echo $building_login['building_text'];}
                    else{echo "We provide you the tools to manage any size with ease of use at a great price"; }?></h4><br>
                </div>
            </div>
            <div class="photo-cont">
                <img class="LOG1" src="<?=base_url()?>assets/backend/img/mainbody.jpg" alt="main-log">
            </div>
                <div class="row" id="log-title"><br><br>
                    <h2><b>Sign up</b></h2>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Information</h3>
                    </div>
<?php    
if((isset($msg))&& (isset($alert_class)))
{
  echo "<div class=\"alert ". $alert_class ."\">";
  echo $msg;
  echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";
}
?> 
                <div class="panel">
                    <div class="panel-body">
                    <?php echo form_open('user_login/registration_submit',['class'=>'']); ?>
                    <div class="form-group">
                    <label for="name">Name</label>
                    <?= form_input(['name'=>'user_name','placeholder'=>'Full Name','class'=>'form-control','required'=>'TRUE']); ?>
                    </div>
                    <div class="form-group">
                    <label for="name">Email</label>
                    <?= form_input(['type'=>'email','name'=>'user_email','placeholder'=>'Email Address','class'=>'form-control','required'=>'TRUE']); ?>
                    </div>
                    <div class="form-group">
                    <label for="name">Phone</label>
                    <?= form_input(['name'=>'user_phone','placeholder'=>'Phone','class'=>'form-control','required'=>'TRUE']); ?>
                    </div>
                    <div class="form-group">
                    <label for="name">Building Unit [Format: Only Digits]</label>
                    <?= form_input(['type'=>'number','name'=>'building_unit','placeholder'=>'Your Building Unit Number','class'=>'form-control','required'=>'TRUE']); ?>
                    </div>
                    <div class="form-group">
                    <label for="name">Password</label>
                    <?= form_password(['name'=>'user_password','placeholder'=>'Please remember your password','class'=>'form-control','required'=>'TRUE']); ?>
                    </div>

                    <div class="col-lg-3">
                    <?= form_submit(['value'=>'Register','class'=>'btn btn-info','required'=>'TRUE']); ?>
                    </div>
                <?php echo form_close(); ?>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </section><!-- header close -->

    <footer id="footer-height">
        <div class="block" >
            <p>Copyright &copy; STRATA365.com</a>| All right reserved.</p>
        </div>
    </footer>


<!-- Js -->
    <script src="<?=base_url()?>assets/js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendor/jquery-1.10.2.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.lwtCountdown-1.0.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.validate.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.form.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.nav.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.sticky.js"></script>
    <script src="<?=base_url()?>assets/js/plugins.js"></script>
    <script src="<?=base_url()?>assets/js/wow.min.js"></script>
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script type="text/javascript">
 
    </script>
</body>
</html>

<!-- ***********FOR ALERT MESSAGE FADEOUT STARTS********** -->
<!-- Footer Starts -->
<script>
  // Message alert box 
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
</script>
<style> 
/* for alert popup cross button floating */
  .alink{
          float: right;
         }
</style>
<!-- ***********FOR ALERT MESSAGE FADEOUT ENDS********** -->