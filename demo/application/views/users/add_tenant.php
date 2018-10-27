<style>
label{
  min-width: 10%;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="page-wrapper">
  <!-- Main content -->
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
        <!-- /.card starts -->
        <div class="card">

          <div class="card-body">
            <h4 class="card-title">Tenant Details - Add Tenant</h4>

            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#building_unit<?= $current_user['building_unit'] ?>"><span class="glyphicon glyphicon-user"> </span> Add Tenant</button>
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_tenant<?= $tenant_data['user_id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit Tenant</button>
            
            <button disabled="true" class="btn btn-danger btn-sm" href="<?= base_url('user/tenant_delete?tenant_id=' . $tenant_data['user_id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</button>


            <div class="col-lg-12">
              <br/>

              <div class="form-group">
                <label for="">Tenant Name: </label>
                <?= $tenant_data['user_name']; ?>
              </div>

              <div class="form-group">
                <label for="">Tenant Email: </label>
                <?= $tenant_data['user_email']; ?>
              </div>

              <div class="form-group">
                <label for="">Tenant Phone: </label>
                <?= $tenant_data['user_phone']; ?>
              </div>

              <div class="form-group">
                <label for="">Unit #: </label>
                <?= $tenant_data['building_unit']; ?>
              </div>

              <div class="form-group">
                <label for="">Created At: </label>
                <?= $tenant_data['created_at']; ?>
              </div>

              <div class="form-group">
                <label for="">Status: </label>
                <?php
                if($tenant_data['status']==1)
                {
                  echo "Active";
                } 
                elseif($tenant_data['status']==0)
                {  
                  echo "Inactive";
                }   
                ?>
              </div>

            </div>


          </div>

        </div>
        <!-- /.card ends -->

      </div>

    </div>

  </div>	
</div>	
</div>	
<!-- ****************************************** EDIT *************************-->
<div id="edit_tenant<?= $tenant_data['user_id'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-body">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <?= form_open('user/update_tenant') ?>
          <input type="hidden" name="user_id" value="<?= $tenant_data['user_id'] ?>" />
          <div class="form-group">
            <label for="">Username</label>
            <?= form_input(['name'=>'user_name','class'=>'form-control','value'=>$tenant_data['user_name']]); ?>
          </div>

          <div class="form-group">
            <label for="">User phone</label>
            <?= form_input(['type'=>'tel','name'=>'user_phone','class'=>'form-control','value'=>$tenant_data['user_phone']]); ?>
          </div>
          <div class="form-group">
            <label>Select User Status</label>
            <!-- multiple="multiple" -->
            <select class="form-control select2" name="status" data-placeholder="Update Status"
            style="width: 100%;">
            <?php 
            if($tenant_data['status']==1)
            {
              echo "<option value =\"1\"selected>Active</option>";
              echo "<option value =\"0\">Inactive</option>";
            } 
            elseif($tenant_data['status']==0)
            {  
              echo "<option value =\"1\">Active</option>";
              echo "<option value =\"0\"selected>Inactive</option>";
            } 

            ?>     


          </select>
        </div> 

        <div class="buttons-card clearfix">
        <?php if ($this->current_user_role == 0) :?>
          <?= form_submit(['class'=>'btn btn-primary','value'=>'Update Tenant']);  ?> 
        <?php else: ?>
           <?= form_submit(['class'=>'btn btn-primary','value'=>'Update Tenant','disabled'=>'TRUE']);  ?> 
        <?php endif; ?> 

        </div>
        <?= form_close() ?>
      </div>              
    </div>
  </div>
</div>
</div>
<!-- **********ADD TENANT MODAL STARTS*********** -->
<div id="building_unit<?= $current_user['building_unit'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tenant Details</h4>
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?= form_open('user/add_tenant',['class'=>'form']) ?>

        <input type="hidden" name="building_unit" value = "<?= $current_user['building_unit'];?>">
        <input type="hidden" name="building_id" value = "<?= $current_user['building_id'];?>">
        <input type="hidden" name="user_role" value = "3">

        <div class="form-group">
          <label for="">Tenant Name</label>
          <?= form_input(['name'=>'user_name','class'=>'form-control','placeholder'=>'Name']); ?>
        </div>

        <div class="form-group">
          <label for="">Tenant email</label>
          <?= form_input(['type'=>'email','name'=>'user_email','class'=>'form-control','placeholder'=>'Tenant Email']); ?>
        </div>

        <div class="form-group">
          <label for="">Tenant password</label>
          <?= form_input(['name'=>'user_password','class'=>'form-control','placeholder'=>'Password']); ?>
        </div>

        <div class="form-group">
          <label for="">Tenant phone</label>
          <?= form_input(['type'=>'tel','name'=>'user_phone','class'=>'form-control','placeholder'=>'Phone']); ?>
        </div>           

        <div class="buttons-card clearfix">
        <?php if ($this->current_user_role == 0) :?>
          <?= form_submit(['class'=>'btn btn-primary','value'=>'Send']);  ?> 
        <?php else: ?>
           <?= form_submit(['class'=>'btn btn-primary','value'=>'Send','disabled'=>'TRUE']);  ?> 
        <?php endif; ?> 

        </div>
        <?= form_close() ?>
      </div> 
    </div>
  </div>
</div>
<!-- **********ADD TENANT ENDS*********** -->


