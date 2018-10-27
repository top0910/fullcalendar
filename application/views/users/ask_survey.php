<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
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

            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#make_survey">Start New Survey</button><br><br>

            <!-- **********ADD TENANT MODAL STARTS*********** -->
            <div id="make_survey" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Survey Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>  

                  <div class="modal-body">
                    <?= form_open('user/new_survey',['class'=>'form']) ?>

                    <div class="form-group">
                      <label for="">Survey Subject</label>
                      <?= form_input(['name'=>'survey_subject','class'=>'form-control','placeholder'=>'Enter survey subject']); ?>
                    </div>

                    <div class="form-group">
                      <label for="">Survey Question</label>
                      <?= form_input(['name'=>'survey_content','class'=>'form-control','placeholder'=>'Survey Question']); ?>
                    </div>


                    <div class="buttons-box clearfix">
                      <button class="btn btn-success" type="submit">Start </button>              
                    </div>
                    <?= form_close() ?>
                  </div> 
                </div>
              </div>
            </div>
            <!-- **********ADD TENANT ENDS*********** -->


            <table id="table_id" class="table table-responsive">
              <thead>
                <th width="20%">Survey Subject</th>
                <th width="50%">Surevey Question</th>
                <th width="6%">Status</th>
                <th width="10%">Created</th>
                <th>Yes</th>
                <th>No</th>
                <th width="4%">Edit</th>
                <th width="6%">Results</th>
                <th width="6%">Graph</th>
                <th width="4%">Delete</th>
              </thead>
              <tfoot>
                <th>Survey Name</th>
                <th>Surevey Question</th>
                <th>Status</th>
                <th>Created</th>
                <th>Yes</th>
                <th>No</th>
                <th>Edit</th>
                <th>Results</th>
                <th>Graph</th>
                <th>Delete</th>
              </tfoot>
              <tbody>
                <?php foreach ($survey_data as $value) :?>
                  <tr>
                    <td><?= $value['survey_subject'];  ?></td>
                    <td><?= $value['survey_content'];  ?></td>
                    <td><?php if($value['status']==1){echo "Active";}else{echo "Inactive";} ?></td>
                    <td><?= $value['created_at'];  ?></td>

                    <?php  
                    $count_total = $this->global_model->count_rows('survey_replies',['survey_id'=>$value['id']]);
                    $count_yes = $this->global_model->count_rows('survey_replies',['survey_id'=>$value['id'],'reply_message'=>'1']);

                    if($count_total != 0)
                    {
                      $data['yes_perc'] = round(($count_yes*100)/$count_total);
                      $data['no_perc'] = (100-$data['yes_perc']);                  
                    }
                    else
                    {
                      $data['yes_perc'] = 'No Results';
                      $data['no_perc'] = 'No Results';
                    }
                    ?>
                    <td><?php echo $data['yes_perc']." %"; ?></td>
                    <td><?php echo $data['no_perc']." %"; ?></td>
                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_survey<?= $value['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Edit</button></td>
                    <td><a class="btn btn-info btn-sm" href = '<?= base_url('user/show_result?survey_id=').$value['id'] ?>'><span class="glyphicon glyphicon-search"></span> Result</a></td>
                    <!-- ****************************************** EDIT starts*************************-->

                    <div id="edit_survey<?= $value['id'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                          <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Edit Ticket</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          </div>  

                          <div class="modal-body">
                            <?= form_open('user/update_survey') ?>
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
                            <button class="btn btn-success" type="submit">Update Status </button>              
                          </div>
                          <?= form_close() ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ****************************************** EDIT ends******************************************* -->
                  
                  <td><a class="btn btn-info btn-sm" href = '<?= base_url('user/view_chart?id=').$value['id'] ?>'><i class="mdi mdi-chart-bar"></i> View chart</a></td>
                  
                  <td><a class="btn btn-danger btn-sm" href="<?= base_url('user/survey_delete?id=' . $value['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>
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

