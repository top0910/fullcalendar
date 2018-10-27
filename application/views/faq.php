<style>
.image-text1{
  
    font-size: 30px;
    color: white;
    text-shadow: 4px 4px 4px #000000;
    line-height: 30px;
}

.logo_image{
    max-height: 90px;
    padding-left: 70px;
}

.bar1{
    margin-left: : 200px;
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
           <a  class="navbar-brand" href="#"">Professional online strata managment tools</a>
           <ul class="nav navbar-nav navbar-right" id="top-nav">
            <li ><a href="<?= base_url();?>">Home</a></li>
<!--             <li id="tag-width"><a href="#about" >About us</a></li>
            <li id="tag-width"><a href="#Price">Pricing</a></li>
            <li id="tag-width"><a href="#contact">Contact us</a></li> -->
        </ul>
    </nav>
</div>
</div>



<section id="contact" class="section">
    <div class="price-bar bar1" style="float: left;"> FAQ</div>
    <a href="<?= base_url();?>" class="btn btn-info" style="margin-left:5%; margin-top:2%;"> &nbsp;Home Page</a>
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
                <?php if(isset($landing_p['faq'])){echo $landing_p['faq'];}else{echo "FAQs Coming Soong"; }?>
            </div>
        </div>    

   </div>
</section>



<section id="about" class="section">

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

    $("#send_btn").click(function(){

        var retVal = checkInput();
        if(!retVal) return false;
        var name =$('#user').val();
        var email =$('#email').val();
        var message = $('#message_content').val();
        $.ajax({
            url: "<?=base_url()?>welcome/save_content",
            type: "POST",
            data: {
                user_name: name,
                user_email: email,
                message_content: message
            },
            dataType: "HTML",
            success : function(res){
                alert("sucess save!");
                $('#user').val();
                $('#email').val();
                $('#message_content').val();
            },
            error: function(res){
                alert("Inavalid!");
            }
        });
    });
});

</script>
      
    </body>
</html>
