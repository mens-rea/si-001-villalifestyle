<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- insert ponpon about content -->
			

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">
						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>
							DELIVERY REPORT</h4>
						</div>
						<div class="col-xs-12">
							<!-- FILTER FUNCTION

							<div class="row">
								<?php
									//echo form_open('filter-income');							
								?>
								<input type="text" id="datepickerstart" class="datepicker" placeholder="Start Date" name="filter_start_date">
								<input type="text" id="datepickerend" class="datepicker" placeholder="End Date" name="filter_end_date">
								<?php
									//echo form_submit(array('name'=>'submit','value'=>'FILTER','class'=>'call-links'));
									//echo form_close();
								?>
							</div> -->

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-2">Pullout Code</div>
								<div class="col-xs-3">Item Name</div>
								<div class="col-xs-3">Supplier Name</div>
								<div class="col-xs-1">Quantity</div>
								<div class="col-xs-1">Status</div>
								<div class="col-xs-2">Date Approved</div>	
							</div>
							<?php
								/*$total_earnings = 0;
								foreach($income->result_array() as $row){ 
								$income_name = $row['income_name'];
								$income_amount = $row['income_amount'];
								$income_date_acquired = $row['income_date_acquired'];
								$total_earnings = $total_earnings + $income_amount;*/

								foreach($pullout->result_array() as $row){ 
									$pullout_code = $row['pullout_id'];
									$pullout_item = $row['item_name'];
									$pullout_supplier = $row['supplier_name'];
									$pullout_quantity = $row['pullout_quantity'];
									$pullout_status = $row['pullout_status'];
									$pullout_date_approved = $row['pullout_date'];
							?>
								
								<div class="row table-entries table-entries-income">
									<!-- <div class="col-xs-3"><?php $new_income_date_acquired //= //date("M j, Y", strtotime($income_date_acquired));  echo $new_income_date_acquired; ?></div>
									<div class="col-xs-5 col-sm-6"><?php //echo $income_name; ?></div>
									<div class="col-xs-3"><?php //echo $income_amount; ?></div> -->

									<div class="col-xs-2"><?php echo $pullout_code;?></div>
									<div class="col-xs-3"><?php echo $pullout_item;?></div>
									<div class="col-xs-3"><?php echo $pullout_supplier;?></div>
									<div class="col-xs-1"><?php echo $pullout_quantity;?></div>
									<div class="col-xs-1"><?php if($pullout_status==1){ echo "APPROVED"; }else{ echo "PENDING"; } ?></div>
									<div class="col-xs-2"><?php echo $pullout_date_approved;?></div>	
								</div>

							<?php } ?>
							
						</div>

						
					</div><!-- MEC end -->

				</div>