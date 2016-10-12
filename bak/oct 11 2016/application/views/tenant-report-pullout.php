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
								<p style="text-align: left;">These are all your pullout records. Today is: <?php echo $today = date('F j, Y');?></p>
								<div id="print" onClick="printPage();" class="call-links">PRINT PULLOUT RECORDS</div>
							</div>
						</div>

						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>PULLOUT REPORT</h4>
						</div>
						<div class="col-xs-12">

							<div class="row table-title table-title-general table-title-income">
								<!-- <div class="col-xs-2">Pullout Code</div>
								<div class="col-xs-4">Item Name</div>
								<div class="col-xs-2">Date Requested</div>
								<div class="col-xs-1">Qty</div>
								<div class="col-xs-1">Status</div>
								<div class="col-xs-2">Date Approved</div> -->	
								<div class="col-xs-2">Pullout Code</div>
								<div class="col-xs-4">Item Name</div>
								<div class="col-xs-1">Qty</div>
								<div class="col-xs-2">Request Date</div>
								<div class="col-xs-2">Date Approved</div>
								<div class="col-xs-1">Status</div>
								
							</div>
							<?php
								foreach($pullout->result_array() as $row){ 
									$pullout_code = $row['pullout_id'];
									$item_code = $row['item_id'];
									$pullout_item = $row['item_name'];
									$pullout_supplier = $row['pullout_supplier'];
									$pullout_date = $row['pullout_date'];
									$pullout_quantity = $row['pullout_quantity'];
									$pullout_status = $row['pullout_status'];
									$pullout_date_approved = $row['pullout_approved_date'];

									$dt_status_word = '';
									if($pullout_status == 1 || $pullout_status == 3){$pullout_status_word = 'APPROVED';} else if($pullout_status == 2 || $pullout_status == 4){$pullout_status_word = 'REJECTED';} else if($pullout_status == 0){$pullout_status_word = 'PENDING';}
							?>
								
								<div class="row table-entries table-entries-income">
									


									<div class="col-xs-2"><?php echo $pullout_code;?></div>
									<div class="col-xs-4"><?php echo $item_code."-"; echo $pullout_item;?></div>
									<div class="col-xs-1"><?php echo $pullout_quantity;?></div>
									<div class="col-xs-2"><?php echo date("M j, Y g:i A", strtotime($pullout_date)); ?></div>	
									<div class="col-xs-2">
										<?php if($pullout_date_approved!='0000-00-00 00:00:00'){echo date("M j, Y g:i A", strtotime($pullout_date_approved));}else{echo '--';} ?>
									</div>
									<div class="col-xs-1
									<?php
										if ($pullout_status_word == 'APPROVED'){
											echo "btn-approve";
										} else if ($pullout_status_word == 'REJECTED'){
											echo "btn-reject";
										}
									?>
									"><?php echo $pullout_status_word ?></div>
									
											
									
								</div>

							<?php } ?>
							
						</div>
						
					</div><!-- MEC end -->

				</div>