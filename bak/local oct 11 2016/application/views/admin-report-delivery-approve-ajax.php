<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

	<div class="row table-title table-title-general table-title-income">
		<div class="col-xs-2 alter-xs-2">Delivery Code</div>
		<div class="col-xs-1 alter-xs-1">Brand Code</div>
		<div class="col-xs-2">Supplier Name</div>
		<div class="col-xs-1">Total Quantity</div>
		<div class="col-xs-2">Date Requested</div>
		<div class="col-xs-2">Date Approved</div>
		<div class="col-xs-3">Remarks</div>	
	</div>
	<?php
		foreach($delivery_transaction->result_array() as $row){ 
		$dt_code = $row['dt_id'];
		$dt_supplier = $row['name'];
		$dt_quantity = $row['dt_total_quantity'];
		$dt_date = $row['dt_date'];
		$dt_status = $row['dt_status'];
		$dt_date_approved = $row['dt_approve_date'];
		$letter_code = $row['letter_code'];

		if($dt_status == 1){
	?>
		
		<div class="row table-entries table-entries-income">
			<a class="delivery-links" href="<?php echo base_url() ?>admin/view_dt_details/<?php echo $dt_code ?>">
				<div class="col-xs-2 alter-xs-2"><?php echo $dt_code;?></div>
				<div class="col-xs-1 alter-xs-1"><?php echo $letter_code;?></div>
				<div class="col-xs-2"><?php echo $dt_supplier;?></div>
				<div class="col-xs-1"><?php echo $dt_quantity;?></div>
				<div class="col-xs-2"><?php echo date("M j, Y g:i A", strtotime($dt_date)); ?></div>
				<div class="col-xs-2"><?php echo date("M j, Y g:i A", strtotime($dt_date_approved)); ?></div>				
				<div class="col-xs-3 alter-xs-3 tright">
					<a href='<?php echo base_url() ?>admin/archive_delivery/<?php echo $dt_code; ?>'><i class="fa fa-archive" alt="archive" aria-hidden="true"></i></a>
				</div> 
			</a>
		</div>

	<?php 
		}
	} 
	?>