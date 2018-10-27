<div class="page-wrapper">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
          <center>
            <br/>
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
                <button class="btn btn-outline-success" data-toggle="modal" data-target="#add_user">
                <i class="glyphicon glyphicon-plus"></i> Add Building</button>
              
              <div id="add_user" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Add New Building</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
            <div class="modal-body">
                <?= form_open('building_data/add_new_building') ?>
               
               <label for="">Building Name</label>
                <div class="form-group">
                  <?= form_input(['name'=>'building_name','class'=>'form-control','placeholder'=>'Building Name']); ?>
                </div>
               <label for="">Building Email</label>
                <div class="form-group">
                  <?= form_input(['type'=>'email','name'=>'building_email','class'=>'form-control','placeholder'=>'Building Email']); ?>
                </div>
               <label for="">Building Phone</label>
                <div class="form-group">
                  <?= form_input(['name'=>'building_phone','class'=>'form-control','placeholder'=>'Building Phone']); ?>
                </div>
                <label for="">Total no of units in the building</label>
                <div class="form-group">
                  <?= form_input(['name'=>'building_units','class'=>'form-control','placeholder'=>'Units']); ?>
                </div>
                <div class="form-group">
                  <label>Select Admin</label>
                  <!-- multiple="multiple" -->
                  <select class="form-control select2" name="building_admin_id" data-placeholder="Select an Admin"
                          style="width: 100%;">
                    <?php foreach($admins_list as $admin): ?> 
                    <option  value = <?php echo $admin['user_id'] ?> ><?php echo $admin['user_name'] ?></option>
                    <?php endforeach; ?>       
                  </select>
                </div>                                

            </div>
                <div class="modal-footer">
                  <div class="buttons-box clearfix">
                    <button class="btn btn-success" type="submit">Add Building</button>              
                  </div>
                  <?= form_close() ?>

                  <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


          <!-- <h4 class="card-title">Building Management</h4> -->
          <div class="table-responsive m-t-40">
            <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                      <th>Building name</th>
                      <th>Building email</th>
                      <th>Building Phone</th>
                      <th>Building Units</th>
                      <th>Building Admin</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                      <th>Building name</th>
                      <th>Building email</th>
                      <th>Building Phone</th>
                      <th>Building Units</th>
                      <th>Building Admin</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                </tr>
              </tfoot>
                  <tbody>
      <?php if(isset($building_data)): ?>
        <?php foreach($building_data as $building_data):?>
         <tr>
            <td><?php if(isset( $building_data['building_name']))     {echo $building_data['building_name'];} ?>      </td>
            <td><?php if(isset( $building_data['building_email']))    {echo $building_data['building_email'];} ?>     </td>
            <td><?php if(isset( $building_data['building_phone'])) {echo $building_data['building_phone'];} ?>  </td>
            <td><?php if(isset( $building_data['building_units']))    {echo $building_data['building_units'];} ?>     </td>
            <td><?php if(isset( $building_data['building_admin_id'])) {
              
              $get_admin_name = $this->global_model->select_single('users',['user_id'=>$building_data['building_admin_id']]);

              echo $get_admin_name['user_name'];} 
              ?></td>
            <td><?php if(isset( $building_data['created_at']))    {echo $building_data['created_at'];} ?>     </td>
            <td><?php if(isset( $building_data['updated_at']))    {echo $building_data['updated_at'];} ?>     </td>
            <?php if(isset( $building_data['status'])){ ?>
            <td> 
            <?php 
              if($building_data['status'] == '1')
                { 
                  $status = 'Active';
                }
              else
                {
                  $status = 'Inactive';
                } 
              echo $status; ?>      
            </td>
            <?php }?>
            
            
            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_building<?= $building_data['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>

<div id="edit_building<?= $building_data['id'] ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myLargeModalLabel">Edit Building</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>              
            
            <div class="modal-body">
                <?= form_open('building_data/update_building') ?>
                <input type="hidden" name="id" value="<?= $building_data['id'] ?>" />
                <div class="form-group">
                  <?= form_input(['name'=>'building_name','class'=>'form-control','value'=>$building_data['building_name']]); ?>
                </div>
                
                <div class="form-group">
                  <?= form_input(['type'=>'email','name'=>'building_email','class'=>'form-control','value'=>$building_data['building_email']]); ?>
                </div>
                
                
                <div class="form-group">
                  <?= form_input(['type'=>'tel','name'=>'building_phone','class'=>'form-control','value'=>$building_data['building_phone']]); ?>
                </div>



                <div class="form-group">
                  <?= form_input(['type'=>'number','name'=>'building_units','class'=>'form-control','value'=>$building_data['building_units']]); ?>
                </div>

                <div class="form-group">
                  <label>Select Admin</label>
                  <!-- multiple="multiple" -->
                  <select class="form-control select2" name="building_admin_id" data-placeholder="Select an Admin"
                          style="width: 100%;">

                    <?php foreach($admins_list as $admin): ?> 
                    <option  value = <?php echo $admin['user_id'] ?> ><?php echo $admin['user_name'] ?></option>
                    <?php endforeach; ?>   
                  </select>
                </div>  
                

              <div class="form-group">
                <label>Select Building Status</label>
                <!-- multiple="multiple" -->
                <select class="form-control select2" name="status" data-placeholder="Update Status"
                        style="width: 100%;">
                   <?php 
                   if($building_data['status']==1)
                   {
                      echo "<option value =\"1\"selected>Active</option>";
                      echo "<option value =\"0\">Inactive</option>";
                   } 
                   elseif($building_data['status']==0)
                   {  
                      echo "<option value =\"1\">Active</option>";
                      echo "<option value =\"0\"selected>Inactive</option>";
                   } 
                                    
                  ?>     
                 

                </select>
              </div> 
               

                <div class="buttons-box clearfix">

                    <button class="btn btn-success" type="submit">Update Building </button>              
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
                
                  <td><a class="btn btn-danger btn-sm" href="<?= base_url('building_data/building_delete?id=' . $building_data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>

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

