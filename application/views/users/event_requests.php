<div class="page-wrapper">
<div class="container-fluid">


<div class="row">
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

  <div class="col-lg-12">
  <div class="card">
    <div class="card-body">           
      <h4 class="card-title">All Event Requests</h4>
      <div class="table-responsive m-t-40">
        <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                      <th>Unit #</th>
                      <th>Booking Title</th>
                      <th>Description</th>
                      <th>Booking Time</th>
<!--                       <th>End Date</th>
                      <th>Start Time</th>
                      <th>End Time</th> -->
                      <th>User Email</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                      <th>Unit #</th>
                      <th>Booking Title</th>
                      <th>Description</th>
                      <th>Booking Time</th>
<!--                       <th>End Date</th>
                      <th>Start Time</th>
                      <th>End Time</th> -->
                      <th>User Email</th>
                      <th>Created At</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
            </tr>
          </tfoot>
                  <tbody>
      <?php if(isset($event_requests)): ?>
        <?php foreach($event_requests as $value):?>
         <tr>
                <td>
                  <?php  $unit = $this->global_model->select_single('users',['user_id'=>$value['user_id']]); ?>
                  <?php echo $unit['building_unit']; ?>
                </td>
            
                <td><?= $value['title']; ?></td>
                <td><?= $value['description']; ?></td>
                <td><?= $value['start_date']." ".$value['start_time']." - ".$value['end_date']." ".$value['end_time']; ?></td>
                <td>
                  <?php  $unit = $this->global_model->select_single('users',['user_id'=>$value['user_id']]); ?>
                  <?php echo $unit['user_email']; ?>
                </td>
                <td><?= $value['created_at']; ?></td>
                <td>
                  <?php  if($value['status'] == 0){$status = 'Rejected';}elseif($value['status'] == 1){$status = 'Accepted';}elseif($value['status'] == 2){$status = 'Waiting';}   ?>
                  <?php echo $status ; ?>
                </td>
<!-- ****************************************** EDIT starts*************************-->
<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_status<?= $value['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>


  <div id="edit_status<?= $value['id'] ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Update Booking Status</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>              
              
              <div class="modal-body">
                  <?= form_open('user/update_event') ?>
                  <input type="hidden" name="id" value="<?= $value['id'] ?>" />
                  
                  

                <div class="form-group">
                  <label>Change Booking Status</label>
                  <!-- multiple="multiple" -->
                  <select class="form-control select2" name="status" data-placeholder="Update Status"
                          style="width: 100%;">
                     <?php 
                     if($value['status']==2)
                     {
                        echo "<option value =\"2\"selected>Waiting</option>";
                        echo "<option value =\"1\">Accepted</option>";
                        echo "<option value =\"0\">Rejected</option>";
                     } 

                     elseif($value['status']==1)
                     {
                        echo "<option value =\"2\">Waiting</option>";
                        echo "<option value =\"1\"selected>Accepted</option>";
                        echo "<option value =\"0\">Rejected</option>";
                     } 
                     elseif($value['status']==0)
                     {  
                        echo "<option value =\"2\">Waiting</option>";
                        echo "<option value =\"1\">Accepted</option>";
                        echo "<option value =\"0\"selected>Rejected</option>";
                     } 
                                      
                    ?>     
                  </select>
                </div>                

                  <div class="buttons-box clearfix">
                      <button class="btn btn-success" type="submit">Update Status </button>              
                  </div>
                  <?= form_close() ?>
              </div>
          </div>
      </div>
  </div>

<!-- ****************************************** EDIT ENDS *************************-->


                  <td><a class="btn btn-danger btn-sm" href="<?= base_url('user/request_delete?id=' . $value['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>

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

</div>