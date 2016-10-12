<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<script type="text/javascript">
$(document).ready(function(){	
    $('.btn-edit').click(function(){
        $('.edit-item').show();
        $('.item-details').hide();		        
    });

    $('.btn-back').click(function(){
        $('.edit-item').hide();
        $('.item-details').show();
    });

});

function downloadBarcode(id) {
	var c=document.getElementById('canvas'+id);
	c.setAttribute('crossOrigin', 'anonymous');
	var image = new Image();
	image.crossOrigin='anonymous';
	image.src = c.toDataURL("image/png");
	window.open(image.toDataURL());
}

function itemBarcode(id,price,supp){
	$("#bcTarget"+id).barcode(id, "code39");
	$("#bcTarget"+id).append('<span style="float: left; margin-left: 15px; font-size: 15px">'+supp+'</span>');
	$("#bcTarget"+id).append('<span style="float:right;margin-right:15px; font-size: 15px;">Php '+price+'</span>');

	var mycanvas = document.getElementById('bcTarget'+id).innerHTML;
 	var canvas = document.getElementById('canvas'+id);
	var ctx    = canvas.getContext('2d');

	var data   = '<svg xmlns="http://www.w3.org/2000/svg" width="250" height="350">' +
	               '<foreignObject width="100%" height="100%">' +
	                 '<div xmlns="http://www.w3.org/1999/xhtml" style="font-size:40px">' +
	                   '<div id="controlDiv">'+mycanvas+'</div>' +
	                 '</div>' +
	               '</foreignObject>' +
	             '</svg>';

	var DOMURL = window.URL || window.webkitURL || window;

	var img = new Image();
	var svg = new Blob([data], {type: 'image/svg+xml;charset=utf-8'});
	var url = DOMURL.createObjectURL(svg);

	img.onload = function () {
	  ctx.drawImage(img, 0, 0);
	  DOMURL.revokeObjectURL(url);
	}

	img.src = url;
	document.getElementById('bcTarget'+id).innerHTML = "";
}


</script>


	
	<?php
		
		for($x=0 ; $x < sizeof($item) ; $x++) {
			$supplier_code = $item[$x]['letter_code'];
			$item_code = $item[$x]['item_id'];
			$item_supplier = $item[$x]['item_supplier'];
			$item_name = $item[$x]['item_name'];									
			$item_price = number_format($item[$x]['item_price'],2,'.',',');
			$item_stock = $item[$x]['item_stock'];
			$item_category = $item[$x]['item_category'];

			$pullout_count = $item[$x]['pullout_count'];
			$delivery_count = $item[$x]['delivery_count'];
			$sales_count = $item[$x]['sales_count'];
			
	?>
		<div class="row table-entries table-entries-income table-entries-income-int padding-alter" onClick="itemBarcode('<?php echo $item_code; ?>','<?php echo $item_price; ?>','<?php echo $supplier_code; ?>');" data-toggle="modal" <?php echo "data-target=#Item".$item_code?> >
			
			<div class="col-xs-2"><?php echo $supplier_code."-".$item_code;?></div>
			<div class="col-xs-3 alter-xs-3"><?php echo $item_name?></div>
			<div class="col-xs-1">P<?php echo $item_price?></div>									
			<div class="col-xs-2 wrap-word"><?php echo $item_supplier;?></div>

			<div class="col-xs-1 tright"><?php echo $delivery_count." ";?></div>
			<div class="col-xs-1 tright"><?php echo $pullout_count." ";?></div>
			<div class="col-xs-1 tright alter-xs-1"><?php echo $sales_count." ";?></div>
			<div class="col-xs-1 tright"><?php echo $item_stock." ";?></div>
			<div class="col-xs-1 alter-xs-1 tright"><a href="<?php echo base_url(); ?>admin/remove-item/<?php echo $item_code; ?>" class="btn-red"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
			 
			
			
		</div>

		<div class="modal fade" <?php echo "id='Item".$item_code."'"?> role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content item-modal">					                    
                  	<div class="item-details">
                  		<div class="head-contain">
							<h4><i class="fa fa-shopping-cart" aria-hidden="true"></i>Item Details</h4>
						</div>
                  		<div class="modal-body modal-project">
                          <p><span>Item Name:</span><?php echo $item_name;?></p>
                          <p><span>Item Code:</span><?php echo $item_code;?></p>
                          <p><span>Category:</span> <?php echo $item_category;?></p>
                          <p><span>Supplier:</span> <?php echo $item_supplier;?></p>
                          <p><span>Price:</span> P<?php echo $item_price;?></p>
                          <p><span>Stocks available:</span> <?php echo $item_stock;?></p>

                          <div class="row barcode-row" style="margin-top: 30px;">
                          	<!--<div class="col-xs-6" id="bcTarget<?php// echo $item_code; ?>"><!--</div>
                          	<div class="col-xs-6"><a href="print-barcode/<?php// echo $item_code; ?>"><!--PRINT BARCODE</a></div>-->

                          	<div class="col-xs-6"><canvas id="canvas<?php echo $item_code; ?>"></canvas></div>
                          	<div class="col-xs-6">
                          		<a href="print-barcode/<?php echo $item_code; ?>">PRINT BARCODE</a>
                          	</div>
                          </div>

                          <div id="bcTarget<?php echo $item_code; ?>"></div>

                          <div class="btn btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Item</div>
                        </div>
                    </div>

                    <div class="edit-item" style="display: none;">
                    	<div class="head-contain">
							<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Item</h4>
						</div>
                    	<div class="modal-body modal-project">
                        	
                       	  <?php echo form_open('admin/edit-item') ?>
                       	  		<input type="hidden" name="item_code" value="<?php echo $item_code?>">
                       	  		<label>Item Name: </label>
	                        	<input type="field" name="item_name" value="<?php echo $item_name?>">
	                        	<label>Item Price: </label>
	                        	<input type="field" name="item_price" value="<?php echo $item_price?>">
	                        	<label>Item Category: </label>

	                        	<select name="item_category">
	                        	<?php
		                        	foreach ($category_list ->result_array() as $row) {
							            $category_id = $row['category_id'];
							            $category_name = $row['category_name'];
							            $category_status = $row['category_status'];

							        if($category_status != 0){
							        	if($item_category == $category_name ){
							        		echo "<option value='".$category_name."' selected>".$category_name."</option>";	
							        	} else {
							        		echo "<option value='".$category_name."'>".$category_name."</option>";	
							        	}

							        }
							    ?>
							    <?php
							        }
	                        	?>
	                        	</select>

	                        	<div class="col-xs-12" style="padding: 20px 0 10px;">
		                        	<a class="btn btn-back">Back</a>
		                        	<input type="submit" class="btn submit-button" value="Submit" />
	                        	</div>

	                      <?php echo form_close();?>
                        </div>
                    </div>
                </div>
                
            </div>
    </div>

	<?php } ?>

