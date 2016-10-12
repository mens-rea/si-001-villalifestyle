<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- insert ponpon about content -->
			

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">
						<div class="col-xs-12">

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-3">Date</div>
								<div class="col-xs-5 col-sm-6">Name</div>
								<div class="col-xs-3">Amount</div>
							</div>
							<?php
								$total_earnings = 0;
								foreach($income->result_array() as $row){ 
								$income_name = $row['income_name'];
								$income_amount = $row['income_amount'];
								$income_date_acquired = $row['income_date_acquired'];
								$total_earnings = $total_earnings + $income_amount;
							?>
								
								<div class="row table-entries table-entries-income">
									<div class="col-xs-3"><?php $new_income_date_acquired = date("M j, Y", strtotime($income_date_acquired));  echo $new_income_date_acquired; ?></div>
									<div class="col-xs-5 col-sm-6"><?php echo $income_name; ?></div>
									<div class="col-xs-3"><?php echo $income_amount; ?></div>
								</div>

							<?php } ?>
							
						</div>

						<div class="table-title table-end table-end-general table-end-income">
								<div class="col-xs-6 col-sm-9 total-label">TOTAL EARNINGS</div>
								<div class="col-xs-3 total-amount"><?php echo $total_earnings; ?></div>
						</div>
					</div><!-- MEC end -->

				</div>