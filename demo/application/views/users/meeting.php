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
				<h4 class="card-title">Set Meeting 
					<small> - Attach pdf of meeting agenda</small></h4>
						<div class="box-body">

							<?php if(isset($error))echo $error;?>	
							<?= form_open_multipart('user/meeting_minutes');?>
							<label for="">Meeting Name</label>
							<?= form_input(['name'=>'meeting_name','placeholder'=>'Enter Meeting Name','required'=>'TRUE','class'=>'form-control']); ?>

							<label for="">Meeting Purpose</label>
							<?= form_input(['name'=>'meeting_purpose','placeholder'=>'Enter Meeting Purpose','required'=>'TRUE','class'=>'form-control']); ?>

							<div class="row">
							<div class="col-lg-6">
							<label for="">Meeting Date</label>
							<?= form_input(['type'=>'date','name'=>'meeting_date','placeholder'=>'Enter Meeting Date','required'=>'TRUE','class'=>'form-control']); ?>									
							</div>
								<div class="col-lg-6">
							<label for="">Meeting Leader</label>
							<?= form_input(['name'=>'meeting_leader','placeholder'=>'Enter Meeting Leader','required'=>'TRUE','class'=>'form-control']); ?>									
								</div>
							</div>


							<div class="row">
							<div class="col-lg-6">
							<label for="">Start Time</label>
							<?= form_input(['type'=>'time','name'=>'start_time','placeholder'=>'Enter Start Time','required'=>'TRUE','class'=>'form-control']); ?>									
							</div>
								<div class="col-lg-6">
							<label for="">End Time</label>
							<?= form_input(['type'=>'time','name'=>'end_time','placeholder'=>'Enter End Time','required'=>'TRUE','class'=>'form-control']); ?>									
								</div>
							</div>							
														
							<label for="">Meeting Notes</label>
							<?= form_input(['name'=>'meeting_notes','placeholder'=>'Enter Notes','class'=>'form-control']); ?>

							<label for="">Meeting Urgency</label>
							<?= form_input(['name'=>'meeting_issue','placeholder'=>'Enter Meeting Urgency - Example: General Meeting(Council), Annual General Meeting, Special Meeting, Emergency Meeting, Other','class'=>'form-control']); ?>

								
							<label for="imageInputFile">Browse</label>
							<p>Note: Select document file [Allowed Formats: pdf | Max Allowed Size: 10MB ]</p>
							<?php echo form_input(['type'=>'file','name'=>' doc_file','class'=>'form-control']); ?>
							<br /><br />
							<div class="upload_button">
								
							<?php if ($this->current_user_role == 0) :?>
								<button class='btn btn-success btn-md'>Upload</button>
							<?php elseif ($this->current_user_id == 67): ?>
								<input type='' disabled="TRUE" value='Upload' class='btn btn-success btn-md'>

							<?php else: ?>
								<button class='btn btn-success btn-md'>Upload</button>
							<?php endif; ?>

							</div>
							<?php echo form_close(); ?>


						</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">           

			<div class="table-responsive m-t-40">
				<table id="table_id" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
								<th width="20%">Meeting Name</th>
								<th>Meeting Date</th>
								<th>Leader</th>
								<th>Created On</th>
				                <th>Agenda</th>
				                <th>View</th>
								<th>Delete</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
								<th>Meeting Name</th>
								<th>Meeting Date</th>
								<th>Leader</th>
								<th>Created On</th>
				                <th>Agenda</th>
				                <th>View</th>
								<th>Delete</th>
						</tr>
					</tfoot>
						<tbody>
							<?php if(isset($meeting_data)): ?>
								<?php foreach($meeting_data as $file_data):?>
									<tr>
										<td><?php if(isset( $file_data['meeting_name'])){echo $file_data['meeting_name'];} ?></td>
										<td><?php if(isset( $file_data['meeting_date'])){echo $file_data['meeting_date'];} ?></td>
										<td><?php if(isset( $file_data['meeting_leader'])){echo $file_data['meeting_leader'];} ?></td>
										<td><?php if(isset( $file_data['created_at'])){echo $file_data['created_at'];} ?></td>
                    <td><?php if(isset( $file_data['file_name']))
                                {
                                  echo "<strong><a  class=\"btn btn-info btn-sm\" href=\"";
                                  echo $file_data['file_name'];
                                  echo "\"><i class=\"mdi mdi-download\"></i> Download</a></strong>";  
                                } ?></td>

                        <td>
                            <button type="button" class="btn btn-inverse btn-sm" data-toggle="modal" data-target="#view_user<?= $file_data['user_id'] ?>"><i class="mdi mdi-pencil-box"></i> View</button>
                        </td>
<!-- +++++++++++++++++++. VIEW USER  MODAL STARTS ********************* -->
                        <div id="view_user<?= $file_data['user_id'] ?>"  class="modal fade" role="dialog">
                          <div class="modal-dialog modal-lg"  id="content">
                           
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Meeting details</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              </div>

                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-4">
                                    <label for="">Created On: &nbsp; </label><div class="label label-info"><?= $file_data['created_at'];?></div>
                                  </div>
                                </div>

                                <div class="row"> 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Meeting Name</label>
                                      <?= form_input(['class'=>'form-control','value'=>$file_data['meeting_name'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>

                                   <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Meeting Agenda</label>

                                      <?php if(!empty($file_data['file_name']))
                                      {$class = ' btn-success';$file = $file_data['file_name'];}
                                      else{$class = ' btn-danger';$file='#';}?>
                                      <a href="<?= $file; ?>" class="btn <?= $class; ?>">Download</a>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="">Meeting Minutes</label>
                                      <?php if(!empty($file_data['file_name2']))
                                      {$class = ' btn-success';$file = $file_data['file_name2'];}
                                      else{$class = ' btn-danger';$file='#';}?>
                                      <a href="<?= $file; ?>" class="btn <?= $class; ?>">Download</a>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Meeting Purpose</label>
                                      <?= form_input(['disabled'=>'TRUE','class'=>'form-control','value'=>$file_data['meeting_purpose']]); ?>
                                    </div>                                  
                                  </div>
                                </div>      


                                <div class="row"> 
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Meeting Date</label>
                                      <?= form_input(['class'=>'form-control','value'=>$file_data['meeting_date'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Meeting Leader</label>
                                      <?= form_input(['class'=>'form-control','value'=>$file_data['meeting_leader'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>
                                </div>       


                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="">Start Time</label>
                                      <?= form_input(['class'=>'form-control','value'=>$file_data['start_time'],'disabled'=>'TRUE']); ?>
                                    </div>          
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="">End Time</label>
                                      <?= form_input(['class'=>'form-control','value'=>$file_data['end_time'],'disabled'=>'TRUE']); ?>
                                    </div>                                   
                                </div>
                              </div>
       

                                <div class="row"> 
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Meeting Urgency</label>
                                      <?= form_input(['class'=>'form-control','value'=>$file_data['meeting_issue'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>

                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="">Meeting Notes</label>
                                      <?= form_textarea(['class'=>'form-control','value'=>$file_data['meeting_notes'],'disabled'=>'TRUE']); ?>
                                    </div>                                  
                                  </div>
                                </div>  



                              </div>
                              </div>
                            </div>
                          </div>
                          <div id="editor"></div>
                        </div>
<!-- ********************************** VIEW USER MODAL ENDS ************************************ -->
	<?php if ($this->current_user_role == 0) :?>
			<td><a class="btn btn-danger btn-sm" href="<?= base_url('user/meeting_delete?id=' . $file_data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><i class="mdi mdi-delete"></i> Delete</a></td>
	<?php elseif ($this->current_user_id == 67): ?>
			<td><button disabled ='true' class="btn btn-danger btn-sm" href="#" ><i class="mdi mdi-delete"></i> Delete</button></td>
	<?php else: ?>
			<td><a class="btn btn-danger btn-sm" href="<?= base_url('user/meeting_delete?id=' . $file_data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><i class="mdi mdi-delete"></i> Delete</a></td>
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