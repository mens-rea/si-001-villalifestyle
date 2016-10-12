<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row table-title table-title-general table-title-income">
	<div class="col-xs-2 alter-xs-2">Pullout Code</div>
	<div class="col-xs-2">Supplier</div>
	<div class="col-xs-1 alter-xs-1">Qty</div>								
	<div class="col-xs-4 alter-xs-4">Item Name</div>
	<div class="col-xs-2">Request Pullout Date</div>
	<div class="col-xs-2 alter-xs-2">Pullout Action</div>
</div>
<?php

	foreach($pullout->result_array() as $row){ 
		$pullout_code = $row['pullout_id'];
		$pullout_item = $row['item_name'];
		$item_code = $row['item_id'];
		$pullout_supplier = $row['name'];
		$pullout_quantity = $row['pullout_quantity'];
		$pullout_status = $row['pullout_status'];
		$pullout_date = $row['pullout_date'];
		$letter_code = $row['letter_code'];

		if($pullout_status == 0 ){
?>


	
	<div class="row table-entries table-entries-income">
		<div class="col-xs-2 alter-xs-2"><?php echo $pullout_code;?></div>
		<div class="col-xs-2 wrap-word"><?php echo $pullout_supplier;?></div>
		<div class="col-xs-1 alter-xs-1"><?php echo $pullout_quantity;?></div>									
		<div class="col-xs-4 alter-xs-4"><?php echo $letter_code."-".$item_code." "; echo $pullout_item;?></div>
		<div class="col-xs-2"><?php echo date("M j, Y g:i A", strtotime($pullout_date)); ?></div>										
		<div class="col-xs-2 alter-xs-2">
			<a href='<?php echo base_url() ?>admin/approved_pullout/<?php echo $pullout_code ?>'><i class="fa fa-check-square" aria-hidden="true"></i> Approve</a>
			<a href='<?php echo base_url() ?>admin/reject_pullout/<?php echo $pullout_code ?>' class="btn-reject"><i class="fa fa-minus-square" aria-hidden="true"></i> Reject</a>
		</div>
	</div>

	<?php
		} 
	} 
?> 
	