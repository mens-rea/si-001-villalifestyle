<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- insert ponpon about content -->
			

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec log-form">
					<div class="head-contain">
						<h4><i class="fa fa-sign-in"></i>
						VILLALIFESTYLE BOUTIQUE LOGIN</h4>
					</div>

					<div class="modal-body modal-project">
				      	<?php echo form_open('account-login') ?>				      
				        	<input type="field" placeholder="Username" name="user_name" />
				        	<input type="password" placeholder="Password" name="user_password"/>
				        	<div class="error"><?php $this->aauth->print_errors();?></div>
				        	<input type="submit" class="submit-button" value="Submit" />
				      	<?php echo form_close();?>
				    </div>
					

						

						<!-- <div class="table-title table-end table-end-general table-end-income">
								<div class="col-xs-6 col-sm-9 total-label">TOTAL EARNINGS</div>
								<div class="col-xs-3 total-amount"><?php echo $total_earnings; ?></div>
						</div> -->
					</div><!-- MEC end -->

				</div>