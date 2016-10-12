<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
	function printPage(){
		window.print();
	}
</script>

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">

						<div class="table-bank-row">
							<div class="col-xs-6">
								<p style="text-align: left;">These are all your delivery history. Today is: <?php echo $today = date('F j, Y');?></p>
								<div id="print" onClick="printPage();" class="call-links">PRINT DELIVERY RECORDS</div>
							</div>
						</div>

						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>DELIVERY REPORT</h4>
						</div>

						<div class="col-xs-12">
								<div class="row table-title table-title-general table-title-income">
									<div class="col-xs-2">Delivery Code</div>
									<div class="col-xs-3">Supplier Name</div>
									<div class="col-xs-1">Qty</div>
									<div class="col-xs-2">Date Requested</div>
									<div class="col-xs-2">Status</div>
									<div class="col-xs-2">Date Approved</div>		
								</div>

								<?php
									foreach($delivery_transaction->result_array() as $row){ 
									$dt_code = $row['dt_id'];
									$dt_supplier = $row['dt_supplier'];
									$dt_quantity = $row['dt_total_quantity'];
									$dt_date = $row['dt_date'];
									$dt_status = $row['dt_status'];
									$dt_date_approved = $row['dt_approve_date'];

									$dt_status_word = '';
									if($dt_status == 1){$dt_status_word = 'APPROVED';} else if($dt_status == 2){$dt_status_word = 'REJECTED';} else if($dt_status == 0){$dt_status_word = 'PENDING';}
								?>
								<div class="row table-entries table-entries-income">
									<a class="delivery-links" href='<?php echo base_url() ?>tenant/view_dt_details/<?php echo $dt_code ?>'>	
										<div class="col-xs-2"><?php echo $dt_code;?></div>
										<div class="col-xs-3"><?php echo $dt_supplier;?></div>
										<div class="col-xs-1"><?php echo $dt_quantity;?></div>
										<div class="col-xs-2"><?php echo date("M j, Y", strtotime($dt_date)); ?></div>
										<div class="col-xs-2"><?php echo $dt_status_word; ?></div>
										<div class="col-xs-2">
											<?php if($dt_date_approved!='0000-00-00'){echo date("M j, Y", strtotime($dt_date_approved));}else{echo '--';} ?>
										</div>
									</a>
								</div>
								<?php } ?>
						</div>

					</div>
				</div>