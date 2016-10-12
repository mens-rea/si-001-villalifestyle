<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>

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

function itemBarcode(id){
	$("#bcTarget"+id).barcode(id, "code39");
}
</script>

	<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">
					
						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>
							INVENTORY REPORT</h4>
						</div>
						<div class="col-xs-12">

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-2">Item Code</div>								
								<div class="col-xs-1">Qty</div>								
								<div class="col-xs-3">Item Name</div>
								<div class="col-xs-2">Price</div>	
								<div class="col-xs-2">Item Supplier</div>
								<div class="col-xs-2">Remarks</div>
							</div>
							<?php
								foreach($item->result_array() as $row){ 
									$item_code = $row['item_id'];
									$item_supplier = $row['supplier_name'];
									$item_name = $row['item_name'];
									$item_price = number_format($row['item_price'],2,'.',',');
									$item_stock = $row['item_stock'];
									$item_category = $row['item_category'];
							?>
								<div class="row table-entries table-entries-income table-entries-income-int" onClick="itemBarcode('<?php echo $item_code; ?>');" data-toggle="modal" <?php echo "data-target=#Item".$item_code?>>
									<div class="col-xs-2"><?php echo $item_code;?></div>
									<div class="col-xs-1"><?php echo $item_stock;?></div>									
									<div class="col-xs-3"><?php echo $item_name;?></div>
									<div class="col-xs-2"><?php echo $item_price;?></div>									
									<div class="col-xs-2"><?php echo $item_supplier;?></div>
									<div class="col-xs-2"></div>
								</div>
	
							<?php } ?>
						</div>

						<?php
							foreach($item->result_array() as $row){ 
							$item_code = $row['item_id'];
							$item_supplier = $row['supplier_name'];
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
						                          <p><span>Supplier:</span> <?php echo $item_supplier;?></p>
						                          <p><span>Price:</span> P<?php echo $item_price;?></p>
						                          <p><span>Stocks available:</span> <?php echo $item_stock;?></p>

						                          <div class="row barcode-row" style="margin-top: 30px;">
						                          	<div class="col-xs-6" id="bcTarget<?php echo $item_code; ?>"></div>
						                          	<div class="col-xs-6"><a href="print-barcode/<?php echo $item_code; ?>">PRINT BARCODE</a></div>
						                          </div>

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
							                        	<input type="field" name="item_category" value="<?php echo $item_category?>">

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