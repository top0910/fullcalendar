<div class="page-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
          <center>
            <?php    
            if((isset($msg))&& (isset($alert_class)))
            {
              echo "<div class=\"alert ". $alert_class ."\">";
              echo $msg;
              echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";
            }
            ?>                                    
          </center>

        <div class="card">
          <div class="card-body">

          <h4 class="card-title">Manage Email Accounts</h4>
          <div class="table-responsive m-t-40">
            <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Building Name</th>
                  <th>Building Email</th>
                  <th>Inbox Emails</th>
                  <th>Inbox Archive</th>
                  <th>Inbox Arc. Clear</th>
                  <th>Sent Emails</th>
                  <th>Sent Archive</th>
                  <th>Sent Arc. Clear</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Building Name</th>
                  <th>Building Email</th>
                  <th>Inbox Emails</th>
                  <th>Inbox Archive</th>
                  <th>Inbox Arc. Clear</th>
                  <th>Sent Emails</th>
                  <th>Sent Archive</th>
                  <th>Sent Arc. Clear</th>
                </tr>
              </tfoot>
          <tbody>
            <?php if(isset($buildings)): ?>
              <?php foreach($buildings as $build):?>
                <tr>
                  <td><?php if(isset($build['building_name'])){echo $build['building_name'];} ?></td>
                  <td><?php if(isset($build['building_email'])){echo $build['building_email'];} ?></td>
                  <td><?php echo $this->global_model->count_rows('emails',['building_id'=>$build['id'],'archive'=>'0'],[]); ?></td>
                  <td><?php echo $this->global_model->count_rows('emails',['building_id'=>$build['id'],'archive'=>'1'],[]); ?></td> 
                  <td><a href="<?= base_url('user/clear_arc')?>?type=0&id=<?= $build['id']?>" class="btn btn-danger">Clear</a></td>
                  <td><?php echo $this->global_model->count_rows('email_sent',['building_id'=>$build['id'],'archive'=>'0'],[]); ?></td>
                  <td><?php echo $this->global_model->count_rows('email_sent',['building_id'=>$build['id'],'archive'=>'1'],[]); ?></td> 
                  <td><a href="<?= base_url('user/clear_arc')?>?type=1&id=<?= $build['id']?>" class="btn btn-danger">Clear</a></td>                    
 

              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>

</div>
</div>


