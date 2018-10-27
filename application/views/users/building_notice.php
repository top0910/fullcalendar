<div class="page-wrapper">

  <div class="container-fluid">
<!--     <div class="row page-titles">
<div class="col-md-5 col-8 align-self-center">
<h3 class="text-themecolor m-b-0 m-t-0">Forms</h3>
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
<li class="breadcrumb-item active">Form</li>
</ol>
</div>
</div> -->

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
        <h4 class="card-title">Add Building Notice</h4>
        <div class="box-body">
          <?=form_open_multipart('user/insert_notice'); ?>
          <div class="form-group">
            <label for="">Create a notice, attach a pdf file with more information if needed.</label>
            <textarea name="notice" class="form-control" id="" cols="30" rows="5">Create a short building notice - Or use this as subject and attach a pdf file with more information.</textarea>
          </div>


          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">File Name</label>
                <?php echo form_input(['name'=>'new_file_name','placeholder'=>'Enter file name','class'=>'form-control']); ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="">Browse File [Allowed Formats: pdf | Max Allowed Size: 10MB ]</label>
                <?php echo form_input(['type'=>'file','name'=>' doc_file','class'=>'form-control']); ?>
              </div>                  
            </div>
          </div>

          <?= form_submit(['value'=>'Submit','class'=>'btn btn-primary']); ?>
          <?= form_close(); ?>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">           

        <div class="table-responsive m-t-40">
          <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="50%">Notice</th>
                <th>Created Date</th>
                <th>Download File</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th width="50%">Notice</th>
                <th>Created Date</th>
                <th>Download File</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </tfoot>
            <tbody>
              <?php if(isset($building_notices)): ?>
                <?php foreach($building_notices as $building_notice):?>
                  <tr>
                    <td><?php if(isset( $building_notice['notice'])){echo $building_notice['notice'];} ?></td>
                    <td><?php if(isset( $building_notice['created_at'])){echo $building_notice['created_at'];} ?></td>
                    <td>
                      <?php if(!empty( $building_notice['file_name']))
                      {?>
                        <a href="<?php echo $building_notice['file_name']; ?>" class="btn btn-primary btn-sm" >Download File</a>
                        <?php }?>
                      </td>
                      <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_notice<?= $building_notice['id'];?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>

                      <div id="edit_notice<?= $building_notice['id'] ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Notice</h4>
                            </div>
                            <div class="modal-body">
                              <?= form_open_multipart('user/update_notice') ?>
                              <input type="hidden" name="id" value="<?= $building_notice['id'] ?>" />
                              <div class="form-group">
                                <label for="">Building Notice</label>
                                <textarea name="notice" class="form-control" id="" cols="30" rows="5"><?php echo $building_notice['notice']; ?></textarea>
                              </div>

                              <div class="form-group">
                                <label for="">File Name</label>
                                <?php echo form_input(['name'=>'new_file_name','placeholder'=>'Enter file name','class'=>'form-control']); ?>
                              </div>

                              <div class="form-group">
                                <label for="">Select New File [Note: Old file will be replaced with new one.]</label>
                                <input type="file" name="doc_file" class="form-control">
                              </div>                  

                              <div class="buttons-box clearfix">
                                <button class="btn btn-success" type="submit">Update Notice </button>              
                              </div>
                              <?= form_close() ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <td><a class="btn btn-danger btn-sm" href="<?= base_url('user/notice_delete?id=' . $building_notice['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>

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