  <!-- Content Wrapper. Contains page content -->
  <div class="page-wrapper">

<div class="container-fluid">


<div class="card">
<div class="col-md-12">

  <div class="card-body">
  <h4 class="card-title">FAQ</h4>
    <center><?php
        
        if((isset($msg))&& (isset($alert_class)))
        {
       
          echo "<div class=\"alert ". $alert_class ."\">";
          echo $msg;
          echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
          
          echo "</div>";

        }
        ?> </center>



      <label for="imageInputFile">Landing Page FAQ information</label>
      <?php echo form_open('user/post_faq'); ?>


          <textarea class="textarea" id="mymce" placeholder="Message" class="form-control" name="faq"  rows="20"><?php echo $faq['faq'] ?></textarea>
    

      <?= form_submit(['value'=>'Submit','class'=>'btn btn-info']); ?>
      <?= form_close(); ?>
    </div>
  </div>
</div>
</div>
</div>

</div>

