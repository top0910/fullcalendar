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
<h4 class="card-title">Building AGM Documents</h4>
<div class="box-body">

<label for="imageInputFile">Annual General Meeting Documents - Package, Minutes, Budget</label>

<?php if(isset($error))echo $error;?>
<?php echo form_open_multipart('user/upload_agm');?>
	<div class="form-group">
		<?php echo form_input(['name'=>'new_file_name','placeholder'=>'Enter file name','required'=>'TRUE','class'=>'form-control']); ?>
	</div>
	<div class="form-group">
		<?php echo form_input(['type'=>'file','name'=>' doc_file','class'=>'form-control']); ?>
	</div>
	<div class="form-group">
		<div class="form-group text-left">
		<?php if ($this->current_user_id == 67): ?>
			<button type="submit" disabled='true' class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
			<button type="reset" disabled='true' class="btn btn-inverse waves-effect waves-light">Reset</button>
		<?php else: ?>
				<button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
				<button type="reset" class="btn btn-inverse waves-effect waves-light">Reset</button>
		<?php endif; ?>
		</div>	
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
			<th>Edit</th>	
			<th>Delete</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th width="50%">File name</th>
			<th>Created Date</th>
			<th>Download Links</th>
			<th>Edit</th>
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

					<td>
						<button type="button" class="btn btn-info btn-sm" 
						data-toggle="modal" 
						data-target="#edit_agm<?= $file_data['id'] ?>">
						<i class="mdi mdi-pencil-box-outline"></i> Edit
					</button>    		
				</td>

				<div id="edit_agm<?= $file_data['id'] ?>" class="modal fade" role="dialog">
					<div class="modal-dialog modal-lg">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myLargeModalLabel">Edit AGM Document</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>

							<div class="modal-body">
								<?= form_open_multipart('user/update_agm') ?>
								<input type="hidden" name="id" value="<?= $file_data['id'] ?>" />

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="">File Name</label>
											<?= form_input(['name'=>'new_file_name','class'=>'form-control','value'=>$file_data['new_file_name']]); ?>
										</div>                                  
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="">Over write new file</label>
											<?php echo form_input(['type'=>'file','name'=>' doc_file','class'=>'form-control']); ?>                                		
										</div>
									</div>
								</div>

								<div class="modal-footer">
									<div class="buttons-box clearfix pull-left">
										<?php if ($this->current_user_id == 67) :?>
										<button class="btn btn-success" disabled="true" type="submit">Update User</button>   
										<?php else: ?>
										<button class="btn btn-success" type="submit">Update User</button> 
										<?php endif; ?>    
									</div>
									<?= form_close() ?>

									<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
								</div>

							</div>
						</div>
					</div>
				</div>


				<?php if ($this->current_user_role == 0) :?>
					<td><a class="btn btn-danger btn-sm" href="<?= base_url('user/agm_file_delete?id='.$file_data['id'])?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>


					<?php elseif ($this->current_user_id == 67): ?>
						<td><button disabled="true" class="btn btn-danger btn-sm" href="<?= base_url('user/agm_file_delete?id='.$file_data['id'])?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>

						<?php else: ?>
							<td><a class="btn btn-danger btn-sm" href="<?= base_url('user/agm_file_delete?id='.$file_data['id'])?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>

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