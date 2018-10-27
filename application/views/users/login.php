<link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/intlTellnput.css">
<!-- Responsive Stylesheet -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">

<style>

.logo_image{
    /*margin-top: -15px;*/
    max-height: 80px;
    padding-left: 70px;
}

.navbar-default .navbar-collapse, .navbar-default .navbar-form{
        padding-bottom: 21px;
}


.LOG1{
    max-width: 1150px;
    max-height: 460px;
    padding-left: 10px;

}
</style>
<body>

<!--
Header start
==================== -->
<div class="navbar-default navbar-fixed-top" id="navigation">
    <div class="container" id="container-width">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=base_url()?>" id="logo-img">
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
                <li><a href="<?=base_url()?>user_login/registration" id="register_form">Register</a></li>
            </ul>
        </nav><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</div>

<section id="hero-area1">
    <div class="container">
        <div class="row" style="text-align: center">
            <div class="body-text" style="color: #545050;">
                    <?php    
                    if((isset($msg))&& (isset($alert_class)))
                    {
                        echo "<div class=\"alert ". $alert_class ."\">";
                        echo $msg;
                        echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
                        echo "</div>";
                    }
                    ?>
                
                <h2><b>

                    <?php if(isset($building_login['building_title'])){echo $building_login['building_title'];}else{echo "Strata Management made easy to use and to manage"; } ?>
                </b></h2><br>
                <h4>
                    <?php if(isset($building_login['building_text'])){echo $building_login['building_text'];}
                    else{echo "We provide you the tools to manage any size strata with ease of use at a great price"; }?>    
                </h4>
            </div>
        </div><br><br>
        <div class="photo-cont">
            <?php if(isset($building_login['building_title']) AND $building_login['building_image'] != NULL)
            {   
                echo "<img class=\"LOG1\" src=\"";
                print_r($building_login['building_image']);
                echo "\" >";
            }
            else
            {
                echo "<img class=\"LOG1\" src=\"";
                echo base_url('assets/backend/img/mainbody.jpg');
                echo "\">";                
            }?> 

        </div>

        <div class="row">

            <div class="col-lg-3"></div>

            <div class="col-lg-6">
                <div class="well">
                    <h2>User Login</h2>


                    <?php echo form_open('user_login/login_submit'); ?>
                    <p><label for="email">Email</label>
                        <?php echo form_input(['type'=>'email','class'=>'form-control','name'=>'user_email', 'id'=>'user_email',
                            'data-validation'=>'email required',
                            'data-validation-error-msg'=>'Please enter a proper email format'
                            ]); ?></p>
                            <div id="check_email"></div>

                            <p><label for="password">Password</label>
                                <?php echo form_password(['name'=>'user_password','class'=>'form-control','id'=>'user_password',
                                    'data-validation'=>'length alphanumeric required',
                                    'data-validation-length'=>'min3',
                                    'data-validation-error-msg'=>'Password has to be an alphanumeric value (Min 3 characters)'
                                    ]); ?>
                                    <br/></p>

                                    <?php echo form_submit(['value'=>'Login','id'=>'submit','class'=>'submit form-control btn btn-info']); ?>
                                    <?php echo form_close(); ?>	
                                    <br>			
                            Forgot Password ? 
<button type="button" class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#reset"><span class="glyphicon glyphicon-edit"></span> Reset Password</button>
  <div id="reset" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Reset Password</h4>
              </div>
              
              
              <div class="modal-body">
                  <?= form_open('user_login/forgot_password') ?>
                  <div class="form-group">
                      <input type="email" name="reset_email" class="form-control" placeholder="Enter Your Email">
                  </div>
                  
                  <div class="buttons-box clearfix">
                      <button class="btn btn-success" type="submit">Reset Password</button>              
                  </div>
                  <?= form_close() ?>
              </div>
          </div>
      </div>
  </div>

<!-- ****************************************** EDIT ENDS *************************-->



                                </div>
                            </div>
                        </div>

        <div class="photo-cont">
            <?php if(!empty($building_login['building_image2']))
            {   
                echo "<img class=\"LOG1\" src=\"";
                print_r($building_login['building_image2']);
                echo "\" >";
            }
            else
            {
                // echo "<img class=\"LOG1\" src=\"";
                // echo base_url('assets/backend/img/mainbody.jpg');
                // echo "\">";                
            }?> 

        </div>

                    </div>
                </section>



<script>
    $("#lost_pwd").bind("click", function() {
        $("#login-form").css("display", "none");
        $("#lost_form").css("display", "block");
    });

    $("#login_form").bind("click", function(){
        $("#login-form").css("display", "block");
        $("#lost_form").css("display", "none");
        $("#register").css("display", "none");
    });

    $("#lost_form").submit(function(event) {
        var form = $(this);

        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "<?=base_url()?>users/forgot_pwd",
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.no_email == 1) {
                    alert("Your email is invalid! Please try again.");
                } else {
                    alert("Your password is reseted, Your Password 123! ");
                    location.href = "<?=base_url()?>users/login";
                }
// alert(response.no_email);
}
});

    });

</script>


<script>
    $(document).ready(function(){
        check_email();
    });

    function check_email()
    {
        $('#user_email').focusout(function(){
            var user_email = $('#user_email').val();

            $.ajax({

                type:'POST',
                url:'<?php echo base_url()?>user_login/check_email',
                dataType:'json',
                data:{user_email:user_email},
                success:function(result){
                    $("div#check_email").html(result.check_email);
                    $('#submit').disable(true);
                }

            });
        });

    }
</script>
