<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
	function printPage(){
		window.print();
	}
</script>

<a id="showLeftPush" class="action-buttons action-button-2 delivery-action" href="report-delivery">PENDING DELIVERY</a>

<a id="showLeftPush" class="action-buttons action-button-3 delivery-action" href="report-approved-delivery">APPROVED DELIVERY</a>

<a id="showLeftPush" class="action-buttons action-button-4 delivery-action" href="report-rejected-delivery">REJECTED DELIVERY</a>

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">

						<div class="table-bank-row">
							<div class="col-xs-6">
								<p style="text-align: left;">These are all your delivery records. Today is: <?php echo $today = date('F j, Y');?></p>
								<div id="print" onClick="printPage();" class="call-links">PRINT DELIVERY RECORDS</div>
							</div>

							<div class="col-xs-6 table-filter">
								<?php echo form_open(); ?>
								<label>Filter Delivery Transaction:</label>
								<input id="delivery-filter-box" type="text" class="datepicker" placeholder="Enter item here.." name="filter_start_date">
								<?php
									echo form_close();
								?>
							</div>
						</div>

						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>
							PENDING DELIVERY REQUEST</h4>
						</div>

						<div class="col-xs-12" id="ajax-content-container">
							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-2 alter-xs-2">Delivery Code</div>
								<div class="col-xs-1 alter-xs-1">Brand Code</div>
								<div class="col-xs-3">Supplier Name</div>
								<div class="col-xs-1">Total Quantity</div>
								<div class="col-xs-2">Date Requested</div>								
								<div class="col-xs-2">Delivery Action</div>	
							</div>
							<?php
								foreach($delivery_transaction->result_array() as $row){ 
								$dt_code = $row['dt_id'];
								$dt_supplier = $row['name'];
								$dt_quantity = $row['dt_total_quantity'];
								$dt_date = $row['dt_date'];
								$dt_status = $row['dt_status'];
								$letter_code = $row['letter_code'];


								if($dt_status == 0 ){
							?>
								
								<div class="row table-entries table-entries-income">
									<a class="delivery-links" href="<?php echo base_url() ?>cashier/view_dt_details/<?php echo $dt_code ?>">
										<div class="col-xs-2 alter-xs-2"><?php echo $dt_code;?></div>
										<div class="col-xs-1 alter-xs-1"><?php echo $letter_code;?></div>
										<div class="col-xs-3"><?php echo $dt_supplier;?></div>
										<div class="col-xs-1"><?php echo $dt_quantity;?></div>
										<div class="col-xs-2"><?php echo date("M j, Y", strtotime($dt_date)); ?></div>
										<div class="col-xs-2">
											<a href='<?php echo base_url() ?>cashier/approved_delivery/<?php echo $dt_code ?>'><i class="fa fa-check-square" aria-hidden="true"></i> Approve</a>
											<a href='<?php echo base_url() ?>cashier/reject_delivery/<?php echo $dt_code ?>' class="btn-reject"><i class="fa fa-minus-square" aria-hidden="true"></i> Reject</a>
										</div>
									</a>
								</div>

							<?php 
								}
							} 
							?>
						</div>
					</div><!-- MEC end -->


					

				</div>

	<script type="text/javascript">
	$(document).ready(function () {
		ajax_suggest();
		ajax_suggest_code();
	});

	function ajax_suggest(){
		$('#delivery-filter-box').on('input', function() {
			var username = $('#delivery-filter-box').val();
			$.ajax({
				url: "filter-pending-delivery-transaction",
				async: false,
				type: "POST",
				data: "type="+username,
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').html(data);
				}
			})
		});
	}  
	</script>