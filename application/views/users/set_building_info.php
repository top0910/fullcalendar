  <!-- Content Wrapper. Contains page content -->
  <div class="page-wrapper">

<div class="container-fluid">


<div class="card">
<div class="col-md-12">

  <div class="card-body">
  <h4 class="card-title">Set Building Information</h4>
    <center><?php
        if((isset($msg))&& (isset($alert_class)))
        {
          echo "<div class=\"alert ". $alert_class ."\">";
          echo $msg;
          echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";
        }
        ?> </center>

      <?php echo form_open('user/post_building_info'); ?>
          <textarea class="textarea" id="mymce" class="form-control" name="building_info"  rows="20">
            <?php echo $building_info['building_info'] ?></textarea>
      <?= form_submit(['value'=>'Submit','class'=>'btn btn-info']); ?>
      <?= form_close(); ?>
    </div>
  </div>
</div>
</div>
</div>

</div>

