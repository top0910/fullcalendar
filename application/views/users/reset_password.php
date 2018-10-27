<link rel="stylesheet" href="<?=base_url()?>assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
<link rel="stylesheet" href="<?=base_url()?>assets/css/intlTellnput.css">
<!-- Responsive Stylesheet -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
<style>
    .footer{
        background-color: white;
        padding-right: 20px;s
    }
</style>


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
                    <?php    
                    if((isset($msg))&& (isset($alert_class)))
                    {
                        echo "<div class=\"alert ". $alert_class ."\">";
                        echo $msg;
                        echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
                        echo "</div>";
                    }
                    ?>
                
                <h4>Reset Your Password</h4>
            </div>
        </div><br><br>
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="well">
                    <h2>Reset Your Password</h2>
                    <?php echo form_open('user_login/new_password_reset'); ?>

                                <input type="hidden" name="rand_id" value="<?php echo $rand_id_string; ?>">
                                <div class="form-group">
                                    <?php echo form_password(['name'=>'user_password','class'=>'form-control','placeholder'=>'New Password']); ?>
                                </div><br><br>
                                <div class="form-group">
                                    <?php echo form_password(['name'=>'user_password','class'=>'form-control','placeholder'=>'Confirm Password']); ?>
                                </div>    
                                <br><br>
                                    <?php echo form_submit(['value'=>'Reset','class'=>'submit form-control btn btn-info','placeholder'=>'Enter New Password Carefully.']); ?>
                                    <?php echo form_close(); ?>	
                                    <br>			
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <hr>
<!-- /.content-wrapper -->

  <footer class="footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018-2020 <a href="https://www.strata365.com">Strata365.com</a> </strong> All rights
    reserved.
  </footer>

</div>



<!-- jQuery 3 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Select2 -->

<!-- Footer Starts -->
<script>
    // Message alert box 
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
</script>
<style> 
/* for alert popup cross button floating */
  .alink{
          float: right;
         }
</style>

<script>
    // Form validation script for http://www.formvalidator.net/
  $.validate({
    lang: 'es'
  });
</script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

</body>
</html>

