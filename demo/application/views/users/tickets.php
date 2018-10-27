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
      <h4 class="card-title">Support Tickets</h4>

<h6 class="card-subtitle">Issues to address</h6>
<div class="row m-t-40">
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-inverse card-info">
                                            <div class="box bg-info text-center">
                                                <h1 class="font-light text-white"><?= $total_tickets; ?></h1>
                                                <h6 class="text-white">Total Tickets</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-info card-inverse">
                                            <div class="box text-center">
                                                <h1 class="font-light text-white"><?= $total_responded; ?></h1>
                                                <h6 class="text-white">Responded</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card" style="background-color: #27AE60">
                                            <div class="box text-center">
                                                <h1 class="font-light text-white"><?= $total_inactive; ?></h1>
                                                <h6 class="text-white">Resolved</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card  card-warning">
                                            <div class="box text-center">
                                                <h1 class="font-light text-white"><?= $total_active; ?></h1>
                                                <h6 class="text-white">Pending</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                </div>
      
      <div class="table-responsive m-t-40">
        <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
                      <th width="7%">User</th>
                      <th width="7%">Type</th>
                      <th width="20%">Subject</th>
                      <th width="50%">Ticket</th>
                      <th width="10%">Status</th>
                      <th width="4%">Edit</th>
                      <th width="4%">REPLY</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
                      <th width="7%">User</th>
                      <th width="7%">Type</th>
                      <th width="20%">Subject</th>
                      <th width="50%">Ticket</th>
                      <th width="10%">Status</th>
                      <th width="4%">Edit</th>
                      <th width="4%">REPLY</th>
            </tr>
          </tfoot>
                    <tbody>
                      <?php foreach ($active_user_tickets as $value) :?>
                       <tr>
              <?php $ticket_user = $this->global_model->select_single('users',['user_id'=>$value['user_id']]); ?>
              <td><?= $ticket_user['user_email']; ?></td>
                        <td><?php if($value['type']== 1){echo "Sales";}elseif($value['type']==2){echo "Technical";}elseif($value['type']==3){echo "Other";} ?></td>
                        <td><?= $value['subject']; ?></td>
                        <td><?= $value['ticket']; ?></td>
                        <td><?php if($value['status']==1){echo "Active";}else{echo "Inactive";} ?></td>

<!-- ****************************************** EDIT *************************-->

<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_ticket<?= $value['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>

  <div id="edit_ticket<?= $value['id'] ?>" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Edit Ticket</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>             

              
              <div class="modal-body">
                  <?= form_open('user/update_ticket') ?>
                  <input type="hidden" name="id" value="<?= $value['id'] ?>" />
                  
                  

                <div class="form-group">
                  <label>Select User Status</label>
                  <!-- multiple="multiple" -->
                  <select class="form-control select2" name="status" data-placeholder="Update Status"
                          style="width: 100%;">
                     <?php 
                     if($value['status']==1)
                     {
                        echo "<option value =\"1\"selected>Active</option>";
                        echo "<option value =\"0\">Inactive</option>";
                     } 
                     elseif($value['status']==0)
                     {  
                        echo "<option value =\"1\">Active</option>";
                        echo "<option value =\"0\"selected>Inactive</option>";
                     } 
                                      
                    ?>     
                  </select>
                </div>                

                  <div class="buttons-box clearfix">
                      <button class="btn btn-success" type="submit">Update User </button>              
                  </div>
                  <?= form_close() ?>
              </div>
          </div>
      </div>
  </div>
  <!-- ****************************************** EDIT ******************************************* -->
  <!-- ****************************************** REPLY ******************************************* -->
<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#reply<?= $value['id'] ?>"><span class="glyphicon glyphicon-envelope"> </span> VIEW REPLY</button></td>

<div id="reply<?= $value['id'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Reply Ticket</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>

      <div class="modal-body">
        <?= form_open('user/reply_ticket') ?>
        <input type="hidden" name="ticket_id" value="<?= $value['id'] ?>" />

        <div class="form-group">
          <strong><?= $value['subject']; ?></strong><br/>
          <?= $value['ticket']; ?>
        </div>

        <div class="form-group">
          <label for="">Reply Message</label>
          <?= form_input(['name'=>'reply_message','class'=>'form-control','required'=>'TRUE']); ?>
        </div>

        <?php $data = $this->global_model->select_all('ticket_replies',['ticket_id'=>$value['id']],'id','desc') ;
        foreach ($data as $value1) :?>

        <?php if($value1['user_role']=='0' OR $value1['user_role']=='1' OR $value1['user_role']=='4'){
          $float = 'Admin/PM Reply: ';
        }
        elseif ($value1['user_role']=='2' OR $value1['user_role']=='3') {
          $float = 'User Reply: ';
        } ?>
        <div style="min-width: 50px; font-weight: bold; display: inline;"><?php echo $float; ?></div> 
        <div style="display:inline;"><?=  $value1['reply_message']."<br/>" ; ?></div>


      <?php endforeach; ?>

      <div class="buttons-box clearfix">
        <button class="btn btn-success" type="submit">Send </button>              
      </div>
      <?= form_close() ?>
    </div> 
  </div>
</div>
</div>
</div>

  <!-- ****************************************** REPLY ******************************************* -->
                       </tr>
                      <?php endforeach; ?>
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