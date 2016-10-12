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

function printPage(){
	window.print();
}
</script>

	<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">

						<div class="table-bank-row">
							<div class="col-xs-6">
								<p style="text-align: left;">These are all your inventory. Today is: <?php echo $today = date('F j, Y');?></p>
								<div id="print" onClick="printPage();" class="call-links">PRINT INVENTORY RECORDS</div>
							</div>
						</div>
					
						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>
							ITEM LIST</h4>
						</div>
						<div class="col-xs-12">

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-2">Item Code</div>
								<div class="col-xs-2">Category</div>
								<div class="col-xs-4">Item Name</div>
								<div class="col-xs-4">Price</div>
							</div>
							<?php
								foreach($item->result_array() as $row){ 
									$item_code = $row['item_id'];
									$item_supplier = $row['item_supplier'];
									$item_name = $row['item_name'];
									$item_price = number_format($row['item_price'],2,'.',',');
									$item_stock = $row['item_stock'];
									$item_category = $row['item_category'];
							?>
								<div class="row table-entries table-entries-income table-entries-income-int" onClick="itemBarcode('<?php echo $item_code; ?>','<?php echo $item_price; ?>','<?php echo $supp; ?>');" data-toggle="modal" <?php echo "data-target=#Item".$item_code; ?>>
									<div class="col-xs-2"><?php echo $item_code;?></div>
									<div class="col-xs-2"><?php echo $item_category;?></div>
									<div class="col-xs-4"><?php echo $item_name;?></div>
									<div class="col-xs-4"><?php echo $item_price;?></div>
								</div>
	
							<?php } ?>
						</div>

						<?php
							foreach($item->result_array() as $row){ 
							$item_code = $row['item_id'];
							$item_supplier = $row['item_supplier'];
							$item_name = $row['item_name'];
							$item_price = number_format($row['item_price'],2,'.',',');
							$item_stock = $row['item_stock'];
							$item_category = $row['item_category'];
						?>
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
						                          <p><span>Price:</span> P<?php echo $item_price;?></p>

						                          <div class="row barcode-row" style="margin-top: 30px;">
						                          	<div class="col-xs-6"><canvas id="canvas<?php echo $item_code; ?>"></canvas></div>
						                          	<div class="col-xs-6">
						                          		<a href="print-barcode/<?php echo $item_code; ?>">PRINT BARCODE</a>
						                          	</div>
						                          </div>

						                          <div id="bcTarget<?php echo $item_code; ?>"></div>

						                          <!--<div class="btn btn-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Item</div>-->
						                        </div>
						                    </div>

						                    <div class="edit-item" style="display: none;">
						                    	<div class="head-contain">
													<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Item</h4>
												</div>
						                    	<div class="modal-body modal-project">
						                        	
						                       	  <?php echo form_open('tenant/edit-item') ?>
						                       	  		<input type="hidden" name="item_code" value="<?php echo $item_code?>">
						                       	  		<label>Item Name: </label>
							                        	<input type="field" name="item_name" value="<?php echo $item_name?>">
							                        	<label>Item Price: </label>
							                        	<input type="field" name="item_price" value="<?php echo $item_price?>">
							                        	<div class="row" style="margin-bottom: 15px;">
								                        	<div class="col-xs-12"
									                        	<label>Item Category: </label>
									                        	<select name="item_category">
										                        	<?php
											                        	foreach ($category_list ->result_array() as $row) {
																            $category_id = $row['category_id'];
																            $category_name = $row['category_name'];
																            $category_status = $row['category_status'];

																        if($category_status != 0){
																        	echo "<option value='".$category_name."'>".$category_name."</option>";	
																        }
																    ?>
																    <?php
																        }
										                        	?>
										                        </select>
									                        </div>
								                        </div>

							                        	<a class="btn btn-back">Back</a>
							                        	<input type="submit" class="btn submit-button" value="Submit" />

							                      <?php echo form_close();?>
						                        </div>
					                        </div>
					                    </div>
					                    
					                </div>
					        </div>
						<?php } ?>

					</div>
	</div>