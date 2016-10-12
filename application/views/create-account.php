<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- insert ponpon about content -->
			

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec">
						<div class="head-contain">
							<h4><i class="fa fa-user"></i>CREATE USER ACCOUNT</h4>
						</div>
					
						<div class="modal-body modal-project">
					      <?php echo form_open('admin/create-user') ?>				      	
					      	<label>User Type</label>
					      	<select name="new_account_type">
								<option value="2">Tenant</option>
								<option value="3">Cashier</option>								
							</select>

				        	<input type="field" placeholder="Enter Username" name="new_user" />
				        	<input type="field" placeholder="Enter Password" name="new_password"/>
				        	<input type="email" placeholder="Enter Email" name="new_email"/>
				        	<input type="field" placeholder="3 LETTER CODE" name="letter_code"/>
				        	
				        	<input type="submit" class="btn submit-button" value="Submit" />
					      <?php echo form_close();?>
					      <div class="errors"><?php $this->aauth->print_errors();?></div>
					    </div>
					</div><!-- MEC end -->

				</div>