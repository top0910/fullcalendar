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
<a href="<?= base_url('user/home'); ?>" class="btn btn-info">Home</a>
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
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">User Details:</h4>
					<div class="box-body">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td>User Name:</td>
						<td><?php print_r($current_user['user_name']); ?></td>
					</tr>
					<tr>
						<td>User Email:</td>
						<td><?php print_r($current_user['user_email']); ?></td>
					</tr>
					<tr>
						<td>User Phone:</td>
						<td><?php print_r($current_user['user_phone']); ?></td>
					</tr>
					<tr>
						<td>Unit Number:</td>
						<td><?php print_r($current_user['building_unit']); ?></td>
					</tr>
					<tr>
						<td>User Notes:</td>
						<td>
							<form method="post" action="<?= base_url('user/user_notes')?>">
                            <div class="form-group">
                                <textarea class="form-control" name="user_notes" maxlength="100" rows="3" placeholder="<?php print_r($current_user['user_notes']); ?>"></textarea>
                            </div>
                            <?php if ($this->current_user_id == 64 || $this->current_user_id == 67): ?>
                            	<button type="submit" disabled="true" class="btn btn-info">Submit</button>
                            	<?php else: ?>
                            		<button type="submit" class="btn btn-info">Submit</button>
                            <?php endif ?>
							</form>							
						</td>
					</tr>
					<tr>
						<td>Admin Notes:</td>
						<td>
							<form method="post" action="<?= base_url('user/admin_notes')?>">
                            <div class="form-group">
                                <textarea class="form-control" name="admin_notes" maxlength="100" rows="3" placeholder="<?php print_r($user_building_info['admin_notes']); ?>"></textarea>
                            </div>
                            <?php if ($this->current_user_id == 64 || $this->current_user_id == 67): ?>
                            	<button type="submit" disabled="true" class="btn btn-info">Submit</button>
                            	<?php else: ?>
                            		<button type="submit" class="btn btn-info">Submit</button>
                            <?php endif ?>
							</form>							
						</td>
					</tr>


				</tbody>
			</table>

					</div>
				</div>
			</div>
		</div>


	<div class="col-lg-6">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Building Details:</h4>	
					<div class="box-body">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<td>Building Name:</td>
						<td><?php print_r($user_building_info['building_name']); ?></td>
					</tr>
					<tr>
						<td>Building Email:</td>
						<td><?php print_r($user_building_info['building_email']); ?></td>
					</tr>
					<tr>
						<td>Building Phone:</td>
						<td><?php print_r($user_building_info['building_phone']); ?></td>
					</tr>
					<tr>
						<td>Building Title:</td>
						<td><?php print_r($user_building_info['building_title']); ?></td>
					</tr>


				</tbody>
			</table>

					</div>
				</div>
			</div>
		</div>

	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Reset Password:</h4>	
					<div class="box-body">
		<form role="form" method="post" action="<?= base_url()?>user/update_profile">
			<div class="box-body">
			<div class="col-md-8">	
				<div class="form-group">
					<label for="exampleInputPassword1">* Old Password</label>
					<input type="text" class="form-control" name="admin_old_password" required/>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">* New Password</label>
					<input type="text" class="form-control" name="admin_new_password" required/>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">* Confirm New Password</label>
					<input type="text" class="form-control" name="admin_confirm_password" data-validation="confirmation" required/>
				</div> 
			</div> 
			<div class="col-md-4">
				<br/>
				<button type="submit" class="btn btn-primary">Change Password</button>
			</div>

			</div>
			</div>
		</form>	

					</div>
				</div>
			</div>
		</div>

</div>
</div>


</div>

</div>