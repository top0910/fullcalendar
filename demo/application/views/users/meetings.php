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
			<h4 class="card-title">Meeting Minutes</h4>
			<div class="table-responsive m-t-40">
				<table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th>Meeting Name</th>
								<th>Meeting Purpose</th>
				                <th>Date</th>
				                <th>Leader</th>
				                <th>Created At</th>
				                <th>Agenda</th>
                        <th>View</th>
				                <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
  				                
  				                <th>Edit</th>
  				                <th>Delete</th>
        								<?php endif; ?>
						</tr>
					</thead>
					<tfoot>
						<tr>
								<th>Meeting Name</th>
								<th>Meeting Purpose</th>
				                <th>Date</th>
				                <th>Leader</th>
				                <th>Created At</th>
				                <th>Agenda</th>
                        <th>View</th>
				                <?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
  				                
  				                <th>Edit</th>
  				                <th>Delete</th>
        								<?php endif; ?>
						</tr>
					</tfoot>
<tbody>
	<?php if(isset($meeting_data)): ?>
		<?php foreach($meeting_data as $meeting_data):?>
			<tr>

				<td><?php if(isset( $meeting_data['meeting_name'])){echo $meeting_data['meeting_name'];} ?></td>
				<td><?php if(isset( $meeting_data['meeting_purpose'])){echo $meeting_data['meeting_purpose'];} ?></td>
				<td><?php if(isset( $meeting_data['meeting_date'])){echo $meeting_data['meeting_date'];} ?></td>
				<td><?php if(isset( $meeting_data['meeting_leader'])){echo $meeting_data['meeting_leader'];} ?></td>
				<!-- <td><?php if(isset( $meeting_data['start_time'])){echo $meeting_data['start_time'];} ?></td> -->
				<!-- <td><?php if(isset( $meeting_data['end_time'])){echo $meeting_data['end_time'];} ?></td> -->
				<!-- <td><?php if(isset( $meeting_data['meeting_notes'])){echo $meeting_data['meeting_notes'];} ?></td> -->
				<!-- <td><?php if(isset( $meeting_data['meeting_issue'])){echo $meeting_data['meeting_issue'];} ?></td> -->
				<td><?php if(isset( $meeting_data['created_at'])){echo $meeting_data['created_at'];} ?></td>
				
				<td>
					<?php 
					      if(!empty( $meeting_data['file_name'])){ ?> 
					      <a href="<?= $meeting_data['file_name']?>" class="btn btn-success btn-sm"><i class="mdi  mdi-arrow-down-bold-circle"></i> Download</a> 
					      <?php }?>
				</td>

                        <td>
                            <button type="button" class="btn btn-inverse btn-sm" data-toggle="modal" data-target="#view_user<?= $meeting_data['user_id'] ?>"><i class="mdi mdi-view-list"></i> View</button>
                        </td>
<!-- +++++++++++++++++++. VIEW USER  MODAL STARTS ********************* -->
                        <div id="view_user<?= $meeting_data['user_id'] ?>"  class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg"  id="content">
                           
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Meeting details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="">Created On: &nbsp; </label><div class="label label-info"><?= $meeting_data['created_at'];?></div>
                                  </div>
                                </div>

                                <div class="row"> 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Meeting Name</label>
                                      <?= form_input(['class'=>'form-control','value'=>$meeting_data['meeting_name'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>

                                   <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Meeting Agenda</label>

                                      <?php if(!empty($meeting_data['file_name']))
                                      {$class = ' btn-success';$file = $meeting_data['file_name'];}
                                      else{$class = ' btn-danger';$file='#';}?>
                                      <a href="<?= $file; ?>" class="btn <?= $class; ?>">Download</a>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Meeting Minutes</label>
                                      <?php if(!empty($meeting_data['file_name2']))
                                      {$class = ' btn-success';$file = $meeting_data['file_name2'];}
                                      else{$class = ' btn-danger';$file='#';}?>
                                      <a href="<?= $file; ?>" class="btn <?= $class; ?>">Download</a>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Meeting Purpose</label>
                                      <?= form_input(['disabled'=>'TRUE','class'=>'form-control','value'=>$meeting_data['meeting_purpose']]); ?>
                                    </div>                                  
                                  </div>
                                </div>      


                                <div class="row"> 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Meeting Date</label>
                                      <?= form_input(['class'=>'form-control','value'=>$meeting_data['meeting_date'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Meeting Leader</label>
                                      <?= form_input(['class'=>'form-control','value'=>$meeting_data['meeting_leader'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>
                                </div>       


                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Start Time</label>
                                      <?= form_input(['class'=>'form-control','value'=>$meeting_data['start_time'],'disabled'=>'TRUE']); ?>
                                    </div>          
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="">End Time</label>
                                      <?= form_input(['class'=>'form-control','value'=>$meeting_data['end_time'],'disabled'=>'TRUE']); ?>
                                    </div>                                   
                                </div>
                              </div>
       

                                <div class="row"> 
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Meeting Urgency</label>
                                      <?= form_input(['class'=>'form-control','value'=>$meeting_data['meeting_issue'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Meeting Notes</label>
                                      <?= form_textarea(['class'=>'form-control','value'=>$meeting_data['meeting_notes'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>
                                </div>  



                              </div>
                              </div>
                            </div>
                          </div>
                          
                        </div>
<!-- ********************************** VIEW USER MODAL ENDS ************************************ -->
<?php if($this->session->userdata('user_role') == '0' OR $this->session->userdata('user_role') == '1'): ?>
<!-- ****************************************** EDIT starts*************************-->
<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_meeting<?= $meeting_data['id'] ?>"><i class="mdi mdi-pencil-box"></i> Edit</button></td>
  <div id="edit_meeting<?= $meeting_data['id'] ?>" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
              	<h4 class="modal-title">Update Meeting</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  
              </div>
              
              
              <div class="modal-body">
                <?= form_open_multipart('user/update_meeting') ?>
                <input type="hidden" name="id" value="<?= $meeting_data['id'] ?>" />
                  
				<label for="">Meeting Name</label>
				<input type="text" name="meeting_name" class="form-control" value="<?= $meeting_data['meeting_name'];?>">
				<label for="">Meeting Purpose</label>
				<input type="text" name="meeting_purpose" class="form-control" value="<?= $meeting_data['meeting_purpose'];?>">
				<label for="">Meeting Date</label>
				<input type="date" name="meeting_date" class="form-control" value="<?= $meeting_data['meeting_date'];?>">
				<label for="">Meeting Leader</label>
				<input type="text" name="meeting_leader" class="form-control" value="<?= $meeting_data['meeting_leader'];?>">

				<div class="row">
					<div class="col-md-6">
						<label for="">Meeting Start Time</label>
						<input type="time" name="start_time" class="form-control" value="<?= $meeting_data['start_time'];?>">
					</div>
					<div class="col-md-6">
						<label for="">Meeting End TIme</label>
						<input type="time" name="end_time" class="form-control" value="<?= $meeting_data['end_time'];?>">

					</div>
					
				</div> 

				
				<div class="row">
				<div class="col-md-6">
					<label for="">Agenda</label>
					<input type="file" name="file_name" class="form-control">
				</div>				
				<div class="col-md-6">
					<label for="">Meeting Minutes (Notes)</label>
					<input type="file" name="file_name2" class="form-control">
				</div>						
				</div>

                  <div class="buttons-box clearfix">
						<?php if ($this->current_user_id == 67): ?>
						    <button disabled="true"  class="btn btn-success" type="submit">Update Meeting </button>
						<?php else: ?>
							<button class="btn btn-success" type="submit">Update Meeting </button>
						<?php endif; ?>
                  </div>
                  <?= form_close() ?>
              </div>
          </div>
      </div>
  </div>
  <!-- ****************************************** EDIT ends******************************************* -->
 


	<?php if ($this->current_user_id == 67): ?>
  <td><button disabled="true" class="btn btn-danger btn-sm" href="<?= base_url('user/meeting_delete?id=' . $meeting_data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><i class="mdi mdi-delete"></i> Delete</button></td>
	<?php else: ?>
  <td><a class="btn btn-danger btn-sm" href="<?= base_url('user/meeting_delete?id=' . $meeting_data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><i class="mdi mdi-delete"></i> Delete</a></td>
	<?php endif; ?>

<?php endif; ?>

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