<style>
.image-text1{
    font-size: 30px;
    /*text-shadow: 4px 4px 4px #000000;*/
    line-height: 30px;
    color: black;

}
.logo_image{
    
    max-height: 90px;
    padding-left: 70px;
    padding-top: 10px;

}

#hero-area{
    margin-top: -30px;
}

.image-text-small{
    color: rgba(0, 0, 0, 1);
}
.bottom_text_data{
    margin-top: 18%;
    margin-bottom: 1%;
    padding-top: 1%;
    padding-bottom: 1%;
    border-radius: 5px;
    opacity: 0.8;
    /*background: linear-gradient(to right, #4db6ac , #2196f3);*/
    background-color: white;
}

.banner_image{
    background-image: url('<?php echo $building_dashboard['banner_image'] ?>');
}

</style>


    <body  id="body">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/css/intlTellnput.css">
    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
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

	    <header id="top-bar" class="top-bar">
        <div class="col-md-3 col-xs-6">
        <a href="http://strata365.com/">
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
            <div class="col-md-2 center-text" id="email-div">
                <i class="fa fa-phone icon-size"></i>
                <div class="top-text-center">
                   Phone Number: <br>
                   <?php if(isset($landing_p['landing_phone'])){echo $landing_p['landing_phone'];}else{echo "Phone:"; }?>
                </div>
            </div>
            <div class="col-md-2 center-text" id="phone-div">
                <i class="fa fa-envelope-o icon-size"></i>
                <div class="top-text-center">
                    Email Address: </br>
                    <?php if(isset($landing_p['landing_email'])){echo $landing_p['landing_email'];}else{echo "Email:"; }?>
                </div>
            </div>
 
            <div class="col-md-3 col-xs-6 center-text1" style="text-align: right;">
                 <a  href="<?=base_url()?>user_login" class="login-button">LOGIN</a>
            </div>
        </header>

   <div id="preloader">
      <div class="book">
          <div class="book__page"></div>
          <div class="book__page"></div>
          <div class="book__page"></div>
      </div>
  </div>

  <div class="navbar-default navbar-fixed-top" id="navigation">
   <div class="container" id="container-width">
       <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-target="#navbar" id="top_bar_toggle">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
           </button>
       </div>
       <nav class="collapse navbar-collapse" id="navbar">
           <a  class="navbar-brand" href="#"">Professional online strata management tools</a>
           <ul class="nav navbar-nav navbar-right" id="top-nav">
            <li class="current" id="tag-width"><a href="#body">Home</a></li>
            <li id="tag-width"><a href="#about" >About us</a></li>
            <li id="tag-width"><a href="#Price">Pricing</a></li>
            <li id="tag-width"><a href="#contact">Contact us</a></li>
        </ul>
    </nav>
</div>
</div>
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                    <?php    
                    if((isset($msg))&& (isset($alert_class)))
                    {
                    echo "<div class=\"alert ". $alert_class ."\">";
                    echo $msg;
                    echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
                    echo "</div>";
                    }
                    ?>                         
                    </div>
                    <div class="col-lg-4"></div>
                </div>
<img src="<?php echo $building_dashboard['banner_image'] ?>" alt="" width='100%'>
                
 <section id="" class="banner_image">
    <div class="container" id="container_width">
<!--         <div class="row" style="text-align: center">
            <div class="body-text">
                <h1><b><?php if(isset($landing_p['page_title'])){echo $landing_p['page_title'];}else{echo "Title:"; }?></b></h1>
                <h4><?php if(isset($landing_p['page_text'])){echo $landing_p['page_text'];}else{echo "Home Text:"; }?></h4>   
            </div>
        </div>  -->
<!--         <div class="row bottom_text_data">
            <div class="body-first-text">
                <div class="col-md-4">
                    <h3 class="image-text1"><b><?php if(isset($landing_p['sub_title1'])){echo $landing_p['sub_title1'];}else{echo "sub1_title:"; }?></b></h3><br>
                    <h4 class="image-text-small"><?php if(isset($landing_p['sub_text1'])){echo $landing_p['sub_text1'];}else{echo "sub1_text:"; }?></h4>
                </div>
                <div class="col-md-4">
                    <h3 class="image-text1">
                            <b><?php if(isset($landing_p['sub_title2'])){echo $landing_p['sub_title2'];}else{echo "sub2_title:"; }?></b>
                            </h3><br>
                        <h4 class="image-text-small"><?php if(isset($landing_p['sub_text2'])){echo $landing_p['sub_text2'];}else{echo "sub2_text:"; }?></h4>
                </div>
                <div class="col-md-4">
                        <h3 class="image-text1"><b>
                            <?php if(isset($landing_p['sub_title3'])){echo $landing_p['sub_title3'];}else{echo "sub3_title:"; }?></b></h3><br>
                            <h4 class="image-text-small"><?php if(isset($landing_p['sub_text3'])){echo $landing_p['sub_text3'];}else{echo "sub3_text:"; }?></h4>
                </div>
                    </div>

                </div> -->
            </div>
        </section> 

<section id="server-content" class="section">
<div class="container" id="mid-container-width">
    <div class="row">
        <div class="col-md-12 col-sm-12 wow fadeInLeft">
            <br><br>
            <div style="text-align: center">
            <h1 style="color: black">
                <b>
                    <?php if(isset($landing_p['provide_title'])){echo $landing_p['provide_title'];}else{echo "provide_title:"; }?>
                <b>
                </h1>
            </div>
            <div class="server-text">
                <p>
                    <?php if(isset($landing_p['provide_content'])){echo $landing_p['provide_content'];}else{echo "provide_content:"; }?>
                </p>
            </div>
        </div>
    </div>

    <?php if ($building_dashboard['demo_graphic_image']) :?>
        <br><br><br>
        <div class="row">
            <div class="col-md-12">
                <a href="https://strata365.com/demo/"><img src="<?= $building_dashboard['demo_graphic_image'] ?>" alt="icons"  style="width:100%;  max-height: 200px; margin-bottom: 0px;"></a>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($building_dashboard['icon_bar_image']): ?>
        <div class="row">
            <div class="col-md-12">
                <img src="<?= $building_dashboard['icon_bar_image'] ?>" alt="icons"  style="width:100%;  max-height: 200px; margin-bottom: -200px;">
            </div>
        </div>
        <br><br><br>
        <br><br><br>
        <br><br><br>
    <?php endif; ?>

    </div>
</section>


<section id="price" class="section">

     <div class="price-bar"> Pricing</div>

<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-4">
<!--             <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="text-center">Monthly </h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong>$36.50 / Monthly</strong>
                    </p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">
                        $249 One Time Setup
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        Technical Support
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                </ul>
                <div class="panel-footer">
                    <a href="https://squareup.com/store/strata365" class="btn btn-lg btn-block btn-success">SignUp</a>
                </div>
            </div> -->
        <?php if ($building_dashboard['pricing_one_image']): ?>
          <a href="<?= $building_dashboard['pricing_one_image_url']?>"><img src="<?= $building_dashboard['pricing_one_image']?>" alt="logo" style="width:280px; height: 280px;"></a>
         <?php else: ?>
          <a href="<?= $building_dashboard['pricing_one_image_url']?>"><img src="<?=base_url()?>assets/images/square_image.jpg" alt="logo" style="width:280px; height: 280px;"></a>
        <?php endif ?>

        </div>
        <div class="col-md-4">
<!--             <div class="panel panel-info">
                <div class="panel-heading ">
                    <h4 class="text-center">Annual</h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong> $365 Annually </strong>
                    </p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">
                        $249 One Time Setup
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        Technical Support
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                </ul>
                <div class="panel-footer">
                    <a href="https://squareup.com/store/strata365" class="btn btn-lg btn-block btn-info">SignUp</a>
                </div>
            </div> -->
        <?php if ($building_dashboard['pricing_one_image']): ?>
          <a href="<?= $building_dashboard['pricing_two_image_url']?>"><img src="<?= $building_dashboard['pricing_two_image']?>" alt="logo" style="width:280px; height: 280px;"></a>
         <?php else: ?>
          <a href="<?= $building_dashboard['pricing_two_image_url']?>"><img src="<?=base_url()?>assets/images/square_image.jpg" alt="logo" style="width:280px; height: 280px;"></a>
        <?php endif ?>

        </div>
        <div class="col-md-4">
<!--             <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="text-center">Multiple Properties </h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong>Email us for bulk pricing</strong>
                    </p>
                </div>
                <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item">
                        Special Rates
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>
                    <li class="list-group-item">
                        Technical Support
                        <span class="glyphicon glyphicon-ok pull-right"></span>
                    </li>

                </ul>
                <div class="panel-footer">
                    <a href="https://squareup.com/store/strata365" class="btn btn-lg btn-block btn-primary">SignUp</a>
                </div>
            </div> -->
        <?php if ($building_dashboard['pricing_one_image']): ?>
          <a href="<?= $building_dashboard['pricing_three_image_url']?>"><img src="<?= $building_dashboard['pricing_three_image']?>" alt="logo" style="width:280px; height: 280px;"></a>
         <?php else: ?>
          <a href="<?= $building_dashboard['pricing_three_image_url']?>"><img src="<?=base_url()?>assets/images/square_image.jpg" alt="logo" style="width:280px; height: 280px;"></a>
        <?php endif ?>

        </div>
    </div>
    <br><br>
</div>
</div>
</section>

<section id="contact" class="section">
    <div class="price-bar"> Contact Us</div>
    <div class="container" >
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 wow fadeInUp">
              <div class="block text-left"><br>
                 <div class="sub-heading">
                    <h4>Contact Address</h4>
                </div>
                <address class="address">
                    <p><strong>E:</strong>&nbsp;<?php if(isset($landing_p['landing_email'])){echo $landing_p['landing_email'];}else{echo "email:"; }?><br>
                        <strong>P:</strong>&nbsp;<?php if(isset($landing_p['landing_phone'])){echo $landing_p['landing_phone'];}else{echo "phone_number:"; }?></p>
                    </address>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-1 wow fadeInUp" >
               <div class="form-group">
                   <form  name="contactForm" method="post" action="<?= base_url('user_login/contact_query')?>"> 
                        <div class="form-group">
                       <div class="input-field">
                           <input type="text" class="form-control" placeholder="Your Name" name="name" required/>
                       </div>                            
                        </div>
                        <div class="form-group">
                       <div class="input-field">
                           <input type="email" class="form-control" placeholder="Email Address" name="email" required/>
                       </div>
                       </div>
                       <div class="form-group">
                       <div class="input-field">
                           <textarea class="form-control" rows="3" name="message" placeholder="Your Message" required/></textarea>
                       </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LdRqkAUAAAAAL8fP6aSM1wv6WcX6GXECr74socP" data-theme="light" ></div>
                        </div>
                       </div>
                        <button class="btn btn-send" type="submit" >Send Message</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</section>



<section id="about" class="section">
  <div class="price-bar"></div> 
<div class="container">
      <!--  row starts-->
    <div class="row">
      <div class="col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0.3s" >
        <div class="row">
            <div class="service-under-line"></div>
            <div class="service-title">SERVICES</div><br><br>
        </div>


        <div class="row">
            <div class="col-md-2"><div class="online-home"><i class="fa fa-users"></i></div></div>                        
            <div class="col-md-10 manage-text">
                    <?php if(!empty($landing_p['service_title_1'])){echo $landing_p['service_title_1'];}else{echo "Online Platform"; }?>
                <br><br>
                <div class="manage-content">
                    <p>
                    <?php if(!empty($landing_p['service_text_1'])){echo $landing_p['service_text_1'];}
                    else
                        {
                            echo "Cut down on paper and email cultter! We provide <br>
                                    a system that archives the support tickets,<br>
                                    email and more!"; 
                        }
                    ?>
                    </p>
                </div>
            </div>                        
        </div>
        <br><br>
        <div class="row">
                    <div class="col-md-2"><div class="online-home"><i class="fa fa-home"></i></div></div>
                    <div class="col-md-10 manage-text">
                        <?php if(!empty($landing_p['service_title_2'])){echo $landing_p['service_title_2'];}else{echo "Custom Solutions"; }?>
                        <br><br>
                        <div class="manage-content">
                            <p><?php if(!empty($landing_p['service_text_2'])){echo $landing_p['service_text_2'];}
                                else
                                {
                                    echo "Manage our property with an easy to use system <br>that is built with council, property<br>manager and owners in mind!"; 
                                }
                            ?></p>
                        </div>
                    </div>            
        </div>

        <br><br>
        <div class="row">
                    <div class="col-md-2"><div class="online-home"><i class="fa fa-address-card"></i></div></div>
                    <div class="col-md-10 manage-text">
                        <?php if(!empty($landing_p['service_title_6'])){echo $landing_p['service_title_6'];}else{echo "Address"; }?>
                        <br><br>
                        <div class="manage-content">
                            <p><?php if(!empty($landing_p['service_text_6'])){echo $landing_p['service_text_6'];}
                                else
                                {
                                    echo "Address Information"; 
                                }
                            ?></p>
                        </div>
                    </div>            
        </div>


    </div>
    <div class="col-md-6 col-sm-12 wow fadeInLeft" data-wow-delay="0.3s" >
        <div class="row">
            <div class="service-under-line"></div>
            <div class="service-title">UNIQUE FEATURES</div><br><br>
        </div>


        <div class="row">
            <div class="col-md-2"><div class="online-home"><i class="fa fa-calendar-check-o"></i></div></div>                        
            <div class="col-md-10 manage-text">
                <?php if(!empty($landing_p['service_title_3'])){echo $landing_p['service_title_3'];}else{echo "Online Platform"; }?>
               <br><br>
                <div class="manage-content">
                    <p>
                    <?php if(!empty($landing_p['service_text_3'])){echo $landing_p['service_text_3'];}
                    else
                        {
                            echo "Stay connected with the latest updates in your building."; 
                        }
                    ?>
                    </p>
                </div>
            </div>                        
        </div>
        <br><br>
        <div class="row">
                    <div class="col-md-2"><div class="online-home"><i class="fa fa-bullhorn"  aria-hidden="true"></i></div></div>
                    <div class="col-md-10 manage-text">
                     <?php if(!empty($landing_p['service_title_4'])){echo $landing_p['service_title_4'];}else{echo "Custom Solutions"; }?>
                        <br><br>
                        <div class="manage-content">
                            <p><?php if(!empty($landing_p['service_text_4'])){echo $landing_p['service_text_4'];}
                                else
                                {
                                    echo "Connect with owners more often with our integrated building survey"; 
                                }
                            ?></p>
                        </div>
                    </div>            
        </div>

        <br><br>
        <div class="row">
                    <div class="col-md-2"><div class="online-home"><i class="fa fa-share-square-o" aria-hidden="true"></i></div></div>
                    <div class="col-md-10 manage-text">
                        <?php if(!empty($landing_p['service_title_5'])){echo $landing_p['service_title_5'];}else{echo "Custom Solutions"; }?>
                        <br><br>
                        <div class="manage-content">
                            <p><?php if(!empty($landing_p['service_text_5'])){echo $landing_p['service_text_5'];}
                                else
                                {
                                    echo "Integrated building page and Email address <br>
                                            Strata365.com/YourBuilding <br>
                                            YourBuilding@strata365.com"; 
                                }
                            ?></p>
                        </div>
                    </div>            
        </div>


    </div>
 

    </div>
<br><br>
    </div>

<hr>
    <div class="container">
        <div class="row"  style="float: left; padding-bottom: 2%;">
            <div class="col-md-2">
                <div class="online-home"><i class="fa fa-question-circle" aria-hidden="true"></i></div> 
            </div>      
            <div class="col-lg-3 manage-text">About Us</div>                  
            <div class="col-md-7 " style="float: left;">
               	<?php if(isset($landing_p['about_text'])){echo $landing_p['about_text'];}else{echo "About Us"; }?>
            </div>                        
        </div>
    </div>

<hr>
    <!-- <div class="container">
        <div class="row"  style="float: left; padding-left: 27%;">
            <div class="col-md-2">
                <div class="online-home">
                    <a href="mailto:Support@strata365.com">
                        <i class="fa fa-envelope-o"></i>
                        
                    </a>
                </div>
            </div>                        
         <div class="col-md-10 manage-text" style="float: left;">Contact Us Today
                <p>
                    
                    <?php if(isset($landing_p['contactus'])){echo $landing_p['contactus'];}else{echo "Email any question, And We will happy to help!"; }?></p>
            </div>                        
        </div>
    </div>
    <br/> -->
<!--  row ends-->

</section><!-- #about close -->

        <footer>
            <div class="container">
                <div class="row footer-div">
                    <div class="col-md-12">
                        <div class="block">
                            <br>
                            <p>Copyright &copy; <a href="#">STRATA365.com</a>| All right reserved.</p>
                        </div>
                    </div>
                </div>
                <div class="row"><br>
                    <div class="col-md-4"></div>
                    <div class="col-md-1">
                        <div class="footer-home-button">
                            <a href="<?=base_url()?>welcome">
                                <i class="fa fa-home " id="footer-button"></i>
                            </a>
                        </div>
                        <div class="foot-home">Home</div>
                    </div>
               
                    <div class="col-md-1">
                        <div class="footer-home-button">
                            <a href="<?=base_url()?>welcome/view_faq">
                                <i class="fa fa-question-circle" id="footer-button"></i>
                            </a>
                        </div>
                        <div class="foot-home">FAQ</div>
                    </div>
                    
                    <div class="col-md-1">
                        <div class="row" id="social-bt">
                            Social Media<br>
                            <i class="fa fa-long-arrow-down" id="footer-button"></i>
                        </div>
                        <div class="row">
                            <a target="_blank" href="https://www.facebook.com/Strata365">
                                <i class="fa fa-facebook" id="social-button"></i>
                            </a>
                            <a target="_blank" href="https://www.instagram.com/strata365/">
                                <i class="fa fa-instagram" id="social-button"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div><br>
        </footer>


</body>

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
    $("#top_bar_toggle").click(function(){
        $("#navbar").toggleClass("in");
        
    })
    $(document).ready(function(){
     $("#aboutus").height($("#about").height());
     <?php 
     if(isset($error_msg)){
        echo "alert('{$error_msg}')";
    }
    ?>

    function checkInput(){
        var inputValues = $("#contact-form").serializeArray();
        for(var i=0; i< inputValues.length; i++){
            if(inputValues[i].value === ""){
                alert(inputValues[i].name+ "value is Empty. Please fill all the input box.");
                return false;    
            }

        }
        return true;
    }

    // $("#send_btn").click(function(){

    //     var retVal = checkInput();
    //     if(!retVal) return false;
    //     var name =$('#user').val();
    //     var email =$('#email').val();
    //     var message = $('#message_content').val();
    //     $.ajax({
    //         url: "<?=base_url()?>welcome/save_content",
    //         type: "POST",
    //         data: {
    //             user_name: name,
    //             user_email: email,
    //             message_content: message
    //         },
    //         dataType: "HTML",
    //         success : function(res){
    //             alert("sucess save!");
    //             $('#user').val();
    //             $('#email').val();
    //             $('#message_content').val();
    //         },
    //         error: function(res){
    //             alert("Inavalid!");
    //         }
    //     });
    // });
});

</script>
      
    </body>
</html>
