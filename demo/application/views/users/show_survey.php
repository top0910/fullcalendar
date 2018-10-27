<div class="page-wrapper">

  <div class="container-fluid">


    <div class="row">
    
      
          <div class="col-lg-12">
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
              <h4 class="card-title">Survey</h4>
              <div class="table-responsive m-t-40">
                <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                <th width="20%">Survey Subject</th>
                <th width="50%">Survey Question</th>
                <th width="6%">Status</th>
                <th width="10%">Created</th>
                <th width="12%">View Chart</th>
                <th width="5%">Vote</th>
                
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                <th width="20%">Survey Subject</th>
                <th width="50%">Survey Question</th>
                <th width="6%">Status</th>
                <th width="10%">Created</th>
                <th width="12%">View Chart</th>
                <th width="5%">Vote</th>
                    </tr>
                  </tfoot>
              <tbody>
                <?php foreach ($survey_data as $value) :?>
                  <tr>
                    <td><?= $value['survey_subject'];  ?></td>
                    <td><?= $value['survey_content'];  ?></td>
                    <td><?php if($value['status']==1){echo "Active";}else{echo "Inactive";} ?></td>
                    <td><?= $value['created_at'];  ?></td>



<td><a href="<?= base_url('user/view_chart?id=').$value['id'] ?>" class="btn btn-info btn-sm" "><span class="glyphicon glyphicon-envelope"> </span>  View chart</a></td>
                    
                  <?php if($this->global_model->count_rows('survey_replies', ['survey_id'=>$value['id'],'user_id'=>$this->current_user_id],[])<1) :?>
                    <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#answer<?= $value['id'] ?>"><span class="glyphicon glyphicon-edit"></span> Vote</button></td>

                    <!-- ****************************************** EDIT starts*************************-->

                    <div id="answer<?= $value['id'] ?>" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Vote</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                          </div>


                          <div class="modal-body">
                            <h4>Survey Question</h4>
                            <p><?= $value['survey_content'];  ?></p>

                            <?= form_open('user/submit_vote') ?>
                            <input type="hidden" name="survey_id" value="<?= $value['id'] ?>" />

                            <div class="form-group">
                              <label>Select Yes/No</label>
                              <!-- multiple="multiple" -->
                              <select class="form-control select2" name="reply_message" data-placeholder="Answer"
                              style="width: 100%;">
                              <?php 
                              if($value['status']==1)
                              {
                                echo "<option value =\"1\"selected>Yes</option>";
                                echo "<option value =\"0\">No</option>";
                              } 
                              elseif($value['status']==0)
                              {  
                                echo "<option value =\"1\">Yes</option>";
                                echo "<option value =\"0\"selected>No</option>";
                              } 

                              ?>     
                            </select>
                          </div>                

                            <div class="form-group">
                              <label>Comment</label>
                              <?php echo form_input(['name'=>'comment','class'=>'form-control']); ?>
                          </div> 

                          <div class="buttons-box clearfix">
                            <?php if ($this->current_user_id == 67): ?>
                              <button class="btn btn-success" disabled="true" type="submit">Submit</button>
                              <?php else: ?>
                                <button class="btn btn-success" type="submit">Submit</button>
                            <?php endif ?>
                                          
                          </div>
                          <?= form_close() ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- ****************************************** EDIT ends******************************************* -->
                <?php endif;?>        

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