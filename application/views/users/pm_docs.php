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
						<h4 class="card-title">Building Property Manager Documents</h4>
						<div class="box-body">

							<label for="imageInputFile">These files are only visible to the Property Managers(s)</label>

							<?php if(isset($error))echo $error;?>
							<?php echo form_open_multipart('user/upload_pm_docs');?>

							<?php echo form_input(['name'=>'new_file_name','placeholder'=>'Enter file name','required'=>'TRUE','class'=>'form-control']); ?>
							<?php echo form_input(['type'=>'file','name'=>' doc_file','class'=>'form-control']); ?>
							<br /><br />
							<div class="upload_button">
								<?php echo "<input type='submit' name='submit' value='Upload' class='btn btn-success btn-md'/>";?>
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
										<th width="50%">File name</th>
										<th>Created Date</th>
										<th>Download Links</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th width="50%">File name</th>
										<th>Created Date</th>
										<th>Download Links</th>
										<th>Delete</th>
									</tr>
								</tfoot>
								<tbody>
									<?php if(isset($files_data)): ?>
										<?php foreach($files_data as $file_data):?>
											<tr>

												<td><?php if(isset( $file_data['new_file_name'])){echo $file_data['new_file_name'];} ?></td>
												<td><?php if(isset( $file_data['created_at'])){echo $file_data['created_at'];} ?></td>

												<td><?php if(isset( $file_data['file_name']))
												{
													echo "<strong><a  class=\"btn btn-primary btn-sm\" href=\"";
													echo $file_data['file_name'];
													echo "\">Download File</a></strong>";  
												} ?></td>

												<td><a class="btn btn-danger btn-sm" href="<?= base_url('user/pm_docs_file_delete?id=' . $file_data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>

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