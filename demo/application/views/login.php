    <link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/intlTellnput.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
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
                <img class="LOG" src ="<?=base_url()?>assets/backend/img/header/sub-logo.png" alt="main-log" style="height: inherit;">
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
                <h2><b>
 
                <?php if(isset($building_login['building_title'])){echo $building_login['building_title'];}else{echo "Strata Managment made easy to use and to follow"; } ?>
                </b></h2><br>
                <h4>
                <?php if(isset($building_login['building_text'])){echo $building_login['building_text'];}
                    else{echo "We provide you the tools to manage any size with ease of use at a great price"; }?>    
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
			<?php    
			      if((isset($msg))&& (isset($alert_class)))
			        {
			          echo "<div class=\"alert ". $alert_class ."\">";
			          echo $msg;
			          echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
			          echo "</div>";
			        }
			?> 
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
			
			</div>
		</div>
	</div>
    <form id="lost_form" style="display: none;">
        <div class="row" id="log-title"><br><br>
            <h2><b>Forgot Password</b></h2>
        </div>
        <div id="login-page-text">
             <div class="form-group"><br>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required="" data-missing-message="Please enter your email address" data-invalidmessage="Make sure your email address is valid">
                <div class="input_error"></div>
            </div>
            <div class="form-group">
                 <!-- <button type="submit" id="bt-color"> Submit</button> -->
                 <input type="submit" name="forget_pass" id="bt_color" class="btn btn-success" value="Submit"/>
            </div>
            <div class="forgot_note">Note: This form lets you reset a forgotten password for an account on this community website. 
            <a href="<?=base_url()?>Welcome">from the main website</a>.
        </div> 
        </div>
     </form>
    </div>
</section><!-- header close -->

<!-- <footer id="footer-height">
    <div class="block" >
        <p>Copyright &copy; STRATA365.com</a>| All right reserved.</p>
    </div>
</footer> -->

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
