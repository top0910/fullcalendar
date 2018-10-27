

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <center>
          <?php    
          if((isset($msg))&& (isset($alert_class)))
          {
            echo "<div class=\"alert ". $alert_class ."\">";
            echo $msg;
            echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a>";
            echo "</div>";
          }
          ?> 
        </center>
        <!-- /.box starts -->
        <div class="card">

            <div class="card-body">
              <h4 class="card-title">Building Information</h4>
              <?php echo $building_info['building_info']; ?>
            </div>
          </div>        
      </div>

          </div>
</div>
</div>


