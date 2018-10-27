

<div class="page-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
          <center>
            <?php    
            if((isset($msg))&& (isset($alert_class)))
            { echo "<div class=\"alert ". $alert_class ."\">";
              echo $msg;
              echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";}
            ?></center>

        <div class="card">
          <div class="card-body">
            
              <?php if($this->current_user_role == 0 OR $this->current_user_role == 1 OR $this->current_user_role == 4): ?>
                <button class="btn btn-info" data-toggle="modal" data-target="#add_user">
                  <i class="mdi mdi-account-box"></i> Add User</button>
                <?php endif; ?>              
            <br><br>
          <h4 class="card-title">All Users list</h4>
          <h6 class="card-subtitle">Note: You can not delete any admin. First change their role to user, Then delete the user.</h6>
          <div class="table-responsive m-t-40">
            <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <!-- <th>User password</th> -->
                  <th>Phone</th>
                  <th>Building</th>
                  <th>Unit #</th>
                  <!-- <th>Created Date</th> -->
                  <!-- <th>Modified Date</th> -->
                  <th>Status</th>
                  <th>Role</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <!-- <th>User password</th> -->
                  <th>Phone</th>
                  <th>Building</th>
                  <th>Unit #</th>
                  <!-- <th>Created Date</th> -->
                  <!-- <th>Modified Date</th> -->
                  <th>Status</th>
                  <th>Role</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if(isset($users_list)): ?>
                  <?php foreach($users_list as $user_data):?>
                    <tr>
                      <td><?php if(isset( $user_data['user_name']))     {echo $user_data['user_name'];} ?>      </td>
                      <td><?php if(isset( $user_data['user_email']))    {echo $user_data['user_email'];} ?>     </td>

                      <td><?php if(isset( $user_data['user_phone']))    {echo $user_data['user_phone'];} ?>     </td>
                      <?php  

                      $building = $this->global_model->select_single('building_data',['id'=>$user_data['building_id']]);
                      echo "<td>";
                      echo $building['building_name'];
                      echo "</td>";
                      ?>


                      <td><?php if(isset( $user_data['building_unit'])){echo $user_data['building_unit'];} ?> </td>
                      <?php if(isset( $user_data['status'])){ ?>
                      <td> 
                        <?php 
                        if($user_data['status'] == '1')
                        { 
                          $status = '<span class="label label-success">Active</span>';
                        }
                        else
                        {
                          $status = '<span class="label label-inverse">Inactive</span>';
                        } 
                        echo $status; ?>      
                      </td>
                      <?php }?>

                      <td>
                        <?php  
                        if(isset( $user_data['user_role']))
                        {
                          $user_role = $user_data['user_role'];

                          if($user_role == 0){$role = 'Support Manager';}
                          elseif($user_role == 1){$role = '<span class="label label-info">Admin</span>';}
                          elseif($user_role == 4){$role = '<span class="label label-inverse">PM</span>';}
                          elseif($user_role == 2){$role = '<span class="label label-warning">User</span>';}
                          elseif($user_role == 3){$role = '<span class="label label-danger">Tenant</span>';}    
                          echo $role;       
                        }

                        ?>                  
                      </td> 

                      <td> <!--Hide propery manager edit button from admin users-->


                        <?php if ($this->current_user_role != 0 && $user_role == 4) :?>
                        <?php else: ?>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_user<?= $user_data['user_id'] ?>"><i class="mdi mdi-pencil-box-outline"></i> Edit</button>
                        <?php endif; ?>
                      </td>



                      <div id="edit_user<?= $user_data['user_id'] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myLargeModalLabel">Edit User</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>

                            <div class="modal-body">
                              <?= form_open('user/update_user') ?>
                              <input type="hidden" name="user_id" value="<?= $user_data['user_id'] ?>" />
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">Username</label>
                                    <?= form_input(['name'=>'user_name','class'=>'form-control','value'=>$user_data['user_name']]); ?>
                                  </div>                                  
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">User email</label>
                                    <?= form_input(['type'=>'email','name'=>'user_email','class'=>'form-control','value'=>$user_data['user_email']]); ?>
                                  </div>                                  
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">User phone</label>
                                    <?= form_input(['type'=>'tel','name'=>'user_phone','class'=>'form-control','value'=>$user_data['user_phone']]); ?>
                                  </div>                                  
                                </div>
                                <div class="col-md-6">
                                  <!--  if loggedin user is manager, show list of all building  -->
                                  <?php if($this->session->userdata('user_role')=='0'): ?> 
                                    <div class="form-group">
                                      <label>Select Building</label>
                                      <!-- multiple="multiple" -->
                                      <select class="form-control select2" name="building_id" data-placeholder="Select User's Building"
                                      style="width: 100%;">


                                      <?php foreach($buildings_list as $building): ?> 
                                        <option  value = <?php echo $building['id'] ?> ><?php echo $building['building_name'] ?></option>
                                      <?php endforeach; ?>   
                                    </select>
                                  </div>  
                                <?php endif; ?>                                  
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Unit Number</label>
                                  <?= form_input(['type'=>'number','name'=>'building_unit','class'=>'form-control','value'=>$user_data['building_unit']]); ?>
                                </div>                                  
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Select User Status</label>
                                  <!-- multiple="multiple" -->
                                  <select class="form-control select2" name="status" data-placeholder="Update Status"
                                  style="width: 100%;">
                                  <?php 
                                  if($user_data['status']==1)
                                  {
                                    echo "<option value =\"1\"selected>Active</option>";
                                    echo "<option value =\"0\">Inactive</option>";
                                  } 
                                  elseif($user_data['status']==0)
                                  {  
                                    echo "<option value =\"1\">Active</option>";
                                    echo "<option value =\"0\"selected>Inactive</option>";
                                  } 

                                  ?>     


                                </select>
                              </div>                                   
                            </div>
                          </div>







                          <div class="form-group">
                            <label>Select User Role</label>
                            <!-- multiple="multiple" -->
                            <select class="form-control select2" name="user_role" data-placeholder="Select a Role"
                            style="width: 100%;">
                            <?php 

                            if($this->current_user_role == 0)
                            {
                              if($user_data['user_role']==1)
                              {
                                echo "<option value =\"1\"selected>Admin</option>";
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\">Tenant</option>";
                                echo "<option value =\"4\">Property Manager</option>";
                              } 
                              elseif($user_data['user_role']==2)
                              {  
                                echo "<option value =\"1\">Admin</option>";
                                echo "<option value =\"2\"selected>User</option>";
                                echo "<option value =\"3\">Tenant</option>"; 
                                echo "<option value =\"4\">Property Manager</option>";

                              } 
                              elseif($user_data['user_role']==3)
                              {
                                echo "<option value =\"1\">Admin</option>";
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\"selected>Tenant</option>";
                                echo "<option value =\"4\">Property Manager</option>";

                              } 
                              elseif($user_data['user_role']==4)
                              {
                                echo "<option value =\"1\">Admin</option>";
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\">Tenant</option>"; 
                                echo "<option value =\"4\" selected>Property Manager</option>";
                              }  
                              else
                              {
                                echo "<option value =\"1\">Admin</option>";
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\">Tenant</option>"; 
                                echo "<option value =\"4\">Property Manager</option>";
                              } 


                            }
                            elseif($this->current_user_role == 1)
                            {
                              if($user_data['user_role']==1)
                              {
                                echo "<option value =\"1\"selected>Admin</option>";
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\">Tenant</option>";
                              } 
                              elseif($user_data['user_role']==2)
                              {  
                                echo "<option value =\"2\"selected>User</option>";
                                echo "<option value =\"3\">Tenant</option>";                      
                              } 
                              elseif($user_data['user_role']==3)
                              {
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\"selected>Tenant</option>";
                              } 
                              else
                              {
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\">Tenant</option>";                    
                              }                     
                            }
                            elseif($this->current_user_role == 2)
                            {
                              if($user_data['user_role']==2)
                              {  
                                echo "<option value =\"2\"selected>User</option>";
                                echo "<option value =\"3\">Tenant</option>";                      
                              } 
                              elseif($user_data['user_role']==3)
                              {
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\"selected>Tenant</option>";
                              } 
                              else
                              {
                                echo "<option value =\"2\">User</option>";
                                echo "<option value =\"3\">Tenant</option>";                    
                              }                    
                            }

                            ?>     


                          </select>
                        </div>                


                        <div class="modal-footer">
                          <div class="buttons-box clearfix">
                            <button class="btn btn-success" type="submit">Update User</button>              
                          </div>
                          <?= form_close() ?>

                          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <td> <!--Hide propery manager edit button from admin users-->
                  <?php if ($this->current_user_role != 0 && $user_role == 4) :?>
                  <?php else: ?>
                    <a class="btn btn-danger btn-sm" href="<?= base_url('user/user_delete?user_id=' . $user_data['user_id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><i class="mdi mdi-close-box"></i> Delete</a>
                  <?php endif; ?>
                </td>


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



<!-- +++++++++++++++++++. ADD USER  MODAL ********************* -->
<div id="add_user" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Add New User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <?= form_open('user/add_new_user') ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Username</label>
                  <?= form_input(['name'=>'user_name','class'=>'form-control','placeholder'=>'Name']); ?>
                </div>                                                    
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">User email</label>
                  <?= form_input(['type'=>'email','name'=>'user_email','class'=>'form-control','placeholder'=>'User Email']); ?>
                </div>                                                    
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">User password</label>
                  <?= form_input(['name'=>'user_password','class'=>'form-control','placeholder'=>'Password']); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">User phone</label>
                  <?= form_input(['type'=>'tel','name'=>'user_phone','class'=>'form-control','placeholder'=>'Phone']); ?>
                </div>
              </div>
            </div>    

            <!--  if loggedin user is manager, show list of all building  -->
            <?php if($this->session->userdata('user_role')=='0'): ?> 
              <div class="form-group">
                <label>Select Building</label>
                <!-- multiple="multiple" -->
                <select class="form-control select2" name="building_id" data-placeholder="Select User's Building"
                style="width: 100%;">


                <?php foreach($buildings_list as $building): ?> 
                  <option  value = <?php echo $building['id'] ?> ><?php echo $building['building_name'] ?></option>
                <?php endforeach; ?>   
              </select>
            </div>  
          <?php endif; ?>

          <div class="form-group">
            <label for="">Building Unit [Format: Only Digits]</label>
            <?= form_input(['type'=>'number','name'=>'building_unit','class'=>'form-control','placeholder'=>'Building Unit']); ?>
          </div>

          <!--  if loggedin user is admin, get the building id from the building session -->
          <?php  if($this->session->userdata('user_role')=='1'): ?>
            <input type="hidden" name="building_id" value="<?= $this->current_building_id ?>">
          <?php endif; ?>

          <div class="form-group">
            <label>Select User Role</label>
            <!-- multiple="multiple" -->
            <select class="form-control select2" name="user_role" data-placeholder="Select a Role"
            style="width: 100%;">
            <?php  if($this->session->userdata('user_role')=='0'): ?>
              <option  value="4">Property Manager</option>
              <option  value="1">Admin</option>
            <?php endif; ?>         
            <option  value="2">User</option>
            <option  value="3">Tenant</option>
          </select>
        </div>                


      </div>
      <div class="modal-footer">
        <div class="buttons-box clearfix">
          <button class="btn btn-success" type="submit">Submit</button>              
        </div>
        <?= form_close() ?>

        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!--  -->
