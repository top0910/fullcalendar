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


  <div class="col-lg-12">
    <div class="card">
      <div class="card-body"> 
        <h4 class="card-title">Survey Details       
        <a href="<?= base_url('user/ask_survey');?>" class="btn btn-info" style=" float: right;"> < Return to survey results</a></h4>   
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
        <div class="table-responsive m-t-40">
          <table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Survey Title</th>
                <th>Vote</th>
                <th>Comment</th>
                <th>Unit No</th>
                <th>Vote Time</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Survey Title</th>
                <th>Vote</th>
                <th>Comment</th>
                <th>Unit No</th>
                <th>Vote Time</th>
              </tr>
            </tfoot>
            <tbody>
              <?php if(isset($get_data)): ?>
                <?php foreach($get_data as $survey_data):?>
                  <tr>
                    <td>
                      <?php  
                      $get_title = $this->global_model->select_single('survey',['id'=>$survey_data['survey_id']]);
                      echo $get_title['survey_subject'];
                      ?>
                    </td>
                    <td><?php if(isset( $survey_data['reply_message']))
                    { if($survey_data['reply_message']=='1'){echo 'Yes';}else{echo "No";} } ?> </td>
                    <td><?php if(isset( $survey_data['comment']))    {echo $survey_data['comment'];} ?>     </td>
                    <td>
                      <?php  
                      $get_unit = $this->global_model->select_single('users',['user_id'=>$survey_data['user_id']]);
                      echo $get_unit['building_unit']." : ";
                      if($get_unit['user_role']==2){echo 'User';}elseif($get_unit['user_role']==3){echo "Tenant";}
                      ?>
                    </td>
                    <td><?php if(isset( $survey_data['created_at']))    {echo $survey_data['created_at'];} ?>     </td>

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