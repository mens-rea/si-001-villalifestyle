<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- insert ponpon about content -->
			

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec">
						<div class="head-contain">
							<h4><i class="fa fa-user"></i>EDIT USER ACCOUNT</h4>
						</div>
						<?php 
							$user_id = $users->id;									
							$user_name = $users->name;
							$user_password = $users->pass;
							$user_email = $users->email;									
						?>
					
						<div class="modal-body modal-project">
					      <?php echo form_open('tenant/user-update') ?>				      	
						      	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
	                   	  		<label>User Name: </label>
	                        	<input type="field" name="user_name" value="<?php echo $user_name; ?>">
	                        	<label>User Email: </label>
	                        	<input type="field" name="user_email" value="<?php echo $user_email; ?>">
	                        	<label>User Password: </label>
	                        	<input type="password" name="user_password" placeholder="Change password">

	                        	<input type="submit" class="btn submit-button" value="Submit" />
					      <?php echo form_close();?>
					      <div class="errors"><?php $this->aauth->print_errors();?></div>
					    </div>
					</div><!-- MEC end -->

				</div>