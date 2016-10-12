<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- <?php if (!isset($ajax_req)): ?>
	<div class="show-gallery">
		View only Gallery
	</div>
	<div class="show-images">
		View only Images
	</div>
	<div class="show-articles">
		View only Articles
	</div>
<?php endif; ?> -->
 
    	<?php
    	 	foreach ($node_list as $key=>$value): 
    	?>
			<div class="row table-entries table-entries-income" id="<?php echo $value->item_id; ?>">
				<div class="col-xs-2" onclick="removeItem(<?php echo $value->item_id; ?>);">REMOVE</div>
				<div class="col-xs-2 code"><?php print $value->item_id; ?></div>
				<div class="col-xs-2">SAMPLE</div>
				<div class="col-xs-4"><?php print ucfirst($value->item_name); ?></div>
				<div class="col-xs-2 price-field"><?php print ucfirst($value->item_price); ?></div>
			</div>
    	<?php endforeach; ?>