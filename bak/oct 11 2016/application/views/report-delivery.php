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
								<div class="col-xs-2">Delivery Code</div>
								<div class="col-xs-3">Supplier Name</div>
								<div class="col-xs-1">Quantity</div>
								<div class="col-xs-2">Date Requested</div>
								<div class="col-xs-2">Status</div>
								<div class="col-xs-2">Delivery Action</div>	
							</div>
							<?php
								/*$total_earnings = 0;
								foreach($income->result_array() as $row){ 
								$income_name = $row['income_name'];
								$income_amount = $row['income_amount'];
								$income_date_acquired = $row['income_date_acquired'];
								$total_earnings = $total_earnings + $income_amount;*/

								foreach($delivery_transaction->result_array() as $row){ 
									$dt_code = $row['dt_id'];
									$dt_supplier = $row['supplier_name'];
									$dt_quantity = $row['dt_total_quantity'];
									$dt_date = $row['dt_date'];
									$dt_status = $row['dt_status'];
									$dt_date_approved = $row['dt_approve_date'];
								?>
								
								<div class="row table-entries table-entries-income">
									<a class="delivery-links" href="<?php echo base_url() ?>Delivery/view_dt_details/<?php echo $dt_code ?>">
										<div class="col-xs-2"><?php echo $dt_code;?></div>
										<div class="col-xs-3"><?php echo $dt_supplier;?></div>
										<div class="col-xs-1"><?php echo 'x'.$dt_quantity;?></div>
										<div class="col-xs-2"><?php echo date("M j, Y", strtotime($dt_date)); ?></div>
										
										<?php 
											if($dt_status==1){ 
												echo "<div class='col-xs-2'>APPROVED</div>
														<div class='col-xs-2'></div>"; }
											else{ 
												echo "<div class='col-xs-2'>PENDING</div>
												<div class='col-xs-2'>
													<a href=".base_url()."Admin/approved_delivery/".$dt_code.">
													<i class='fa fa-check-square' aria-hidden='true'></i> Approve
													</a>
												</div>"; 
											} 
										?>
									</a>
								</div>

							<?php } ?>
							
						</div>

						<!-- <div class="table-title table-end table-end-general table-end-income">
								<div class="col-xs-6 col-sm-9 total-label">TOTAL EARNINGS</div>
								<div class="col-xs-3 total-amount"><?php echo $total_earnings; ?></div>
						</div> -->
					</div><!-- MEC end -->

				</div>