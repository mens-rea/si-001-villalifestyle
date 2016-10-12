<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>

$(document).ready(function(){	

	for (i = 0; i < 24; i++) { 
	    $("#bcTarget"+i).barcode('<?php echo $item; ?>', "code39");
	    $("#bcTarget"+i).append('<span style="margin-left: 15px;"><?php echo $supp; ?></span>');
	    $("#bcTarget"+i).append('<span style="float:right;margin-right:15px;">Php <?php echo $price; ?></span>');
	}

    window.print();

    window.location.href = "<?php echo site_url('tenant/report-inventory'); ?>";
    
});
</script>
	<div class="container" style="text-align: center;">
		<a href="report-inventory" class="print-back">BACK TO ITEMS</a>
	</div>

	<div class="print-barcode">
		<?php for($x = 0; $x <= 24; $x++){ ?>
			<div class="col-md-4 barcodes" id="bcTarget<?php echo $x; ?>"></div>
		<?php } ?>
	</div>