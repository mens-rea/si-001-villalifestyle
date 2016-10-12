<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>

$(document).ready(function(){	
    $('.btn-edit').click(function(){
    	$('.user-details').hide();
        /*$('.edit-user').show();
        $('.user-details').hide();*/
    });

});

</script>

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">
						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>
							ACTIVE USER ACCOUNTS</h4>
						</div>
						<div class="col-xs-12">						

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-1"></div>
								<div class="col-xs-2">User ID</div>
								<div class="col-xs-3">Name</div>
								<div class="col-xs-3">Email</div>									
								<div class="col-xs-2"></div>	
							</div>
							<?php								
								$ctr=0;
								foreach($users as $row){ 
									$user_id = $row->id;									
									$user_name = $row->name;
									$user_password = $row->pass;
									$user_email = $row->email;									
									$is_banned = $row->banned;			
									$user_last_login = $row->last_login;
									$user_last_activity = $row->last_activity;
									$user_last_login_attempt = $row->last_login_attempt;
									

									if($is_banned == 0){
										$ctr++;
							?>
								
								<div class="row table-entries table-entries-income" data-toggle="modal" <?php echo "data-target=#User".$user_id?>>
									<div class="col-xs-1"><?php echo $ctr;?></div>
									<div class="col-xs-2"><?php echo $user_id;?></div>
									<div class="col-xs-3"><?php echo $user_name;?></div>
									<div class="col-xs-3"><?php echo $user_email;?></div>
									<div class="col-xs-2">

										<a href="#" class="btn btn-edit" data-toggle="modal" <?php echo "data-target=#Edit".$user_id?>>Edit</a>
										<a href="<?php echo base_url(); ?>authenticate/ban_user/<?php echo $user_id?>" class="btn-red"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
										
									</div>


									<div class="modal fade" <?php echo "id='Edit".$user_id."'"?> role="dialog" class="edit-user">
					                <div class="modal-dialog">
					                    <!-- Modal content-->
					                    <div class="modal-content item-modal">					                    
						                    <div class="edit-user">
						                    	<div class="head-contain">
													<h4><i class="fa fa-exclamation-circle" aria-hidden="true"></i>User Information	</h4>
												</div>
						                    	<div class="modal-body modal-project">
						                    	  <p><span>User ID:</span><?php echo $user_id;?></p>
						                          <p><span>Name:</span><?php echo $user_name;?></p>
						                          <p><span>Email:</span><?php echo $user_email;?></p>
						                          <p><span>Last Login:</span><?php echo date("M j, Y g:i a", strtotime($user_last_login)); ?></p>
						                          <p><span>Last Activity:</span><?php echo date("M j, Y g:i a", strtotime($user_last_activity)); ?></p>
						                          <p><span>Last Login Attempt:</span><?php echo date("M j, Y g:i a", strtotime($user_last_login_attempt)); ?></p>
						                        </div>
						                        <div class="head-contain">
													<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit User Details</h4>
												</div>
						                        <div class="modal-body modal-project">
						                        	<?php echo form_open('admin/user-update'); ?>
						                       	  		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
						                       	  		<label>User Name: </label>
							                        	<input type="field" name="user_name" value="<?php echo $user_name; ?>">
							                        	<label>User Email: </label>
							                        	<input type="field" name="user_email" value="<?php echo $user_email; ?>">
							                        	<label>User Password: </label>
							                        	<input type="password" name="user_password" placeholder="Change password">

							                        	<input type="submit" class="btn submit-button" value="Submit" />

							                      <?php echo form_close();?>
						                       	  
						                        </div>
					                        </div>
					                    </div>
					                    
					                </div>
					       		</div>
									
								</div>

								<!--edit-->
								


							<?php 
								}
							} 
							?>
							
						</div>

						
					</div><!-- MEC end -->



					<div class="overwatch-mec mec-income">
						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>
							DEACTIVATED USER ACCOUNTS</h4>
						</div>
						<div class="col-xs-12">						

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-1"></div>
								<div class="col-xs-2">User ID</div>
								<div class="col-xs-2">Name</div>
								<div class="col-xs-3">Email</div>
								<div class="col-xs-2">Last Login</div>
								<div class="col-xs-1"></div>	
							</div>
							<?php
								$ctr=0;

								foreach($users as $row){ 
									$user_id = $row->id;									
									$user_name = $row->name;
									$user_password = $row->pass;
									$user_email = $row->email;									
									$is_banned = $row->banned;			
									$user_last_login = $row->last_login;
									

									if($is_banned == 1){
										$ctr++;

							?>
								
								<div class="row table-entries table-entries-income">
									<div class="col-xs-1"><?php echo $ctr;?></div>
									<div class="col-xs-2"><?php echo $user_id;?></div>
									<div class="col-xs-2"><?php echo $user_name;?></div>
									<div class="col-xs-3"><?php echo $user_email;?></div>
									<div class="col-xs-2"><?php echo date("M j, Y g:i a", strtotime($user_last_login)); ?></div>
									<div class="col-xs-1">
										<a href="<?php echo base_url(); ?>authenticate/unban_user/<?php echo $user_id?>" class="btn btn-green">Activate</a>
										
									</div>
									
								</div>

							<?php 
								}
							} 
							?>
							
						</div>

						
					</div><!-- MEC end -->

				</div>