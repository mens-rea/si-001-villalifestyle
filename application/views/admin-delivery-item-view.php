<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
	function printPage(){
		window.print();
	}

	function removeItem(item,delivery,qty,dt,dtotal){
		$('#delrow'+delivery).remove();

		var total = 0;
		$(".del-rows").each(function() {
			total += parseFloat($(this).find(".del-qty").text());
		});
		$('.del-total').html("<span id='realtotal'>"+total+"</span>"+" total items to be delivered");

		var delTotal = 0;
		delTotal = $('#realtotal').html();

		$.ajax({
			url: '<?php echo base_url(); ?>remove-delivery-item',
				type: "POST",
				data: {item: item, del: delivery, qty: qty, transaction: dt, total: delTotal},
				dataType: "html",
				success: function( data ) {
					alert("Item successfully deleted!");			
				},
				error: function(xhr, status, error) {
					alert(error);
				}
		});
									      	
		return false;
	}	

	function confirmQty(dt_id){
		$('#myModal').modal("hide");
		var delid = $('#item-check').text();
		var qty = parseInt($('#qty').val());

		$('#quant'+delid).text(qty);

		var total = 0;
		$(".del-rows").each(function() {
			total += parseFloat($(this).find(".del-qty").text());
		});
		$('.del-total').html("<span id='realtotal'>"+total+"</span>"+" total items to be delivered");

		var delTotal = 0;
		delTotal = $('#realtotal').html();
		
		$.ajax({
			url: '<?php echo base_url(); ?>edit-delivery-item',
				type: "POST",
				data: {del: delid, qty: qty, transaction: dt_id, total: delTotal},
				dataType: "html",
				success: function( data ) {
					alert("Item successfully updated!");			
				},
				error: function(xhr, status, error) {
					alert(error);
				}
		});					      	
		return false;
	}

	function editItem(delivery,qty){
		$('#myModal').modal("show");
		$('#item-check').text(delivery);
		/*$.ajax({
			url: '<?php echo base_url(); ?>edit-delivery-item',
				type: "POST",
				data: {item: item, del: delivery, qty: qty, transaction: dt, total: dtotal},
				dataType: "html",
				success: function( data ) {
					
				},
				error: function(xhr, status, error) {
					alert(error);
				}
		});
									      	
		return false;*/
	}	
</script>
<a id="showLeftPush" class="action-buttons action-button-1 delivery-action" href="<?php echo base_url() ?>admin/report-delivery">PENDING DELIVERY</a>

<a id="showLeftPush" class="action-buttons action-button-2 delivery-action" href="<?php echo base_url() ?>admin/report-approved-delivery">APPROVED DELIVERY</a>

<a id="showLeftPush" class="action-buttons action-button-3 delivery-action" href="<?php echo base_url() ?>admin/report-rejected-delivery">REJECTED DELIVERY</a>

				<?php 
					$ctr = 1;
					foreach($delivery_transaction_indiv->result_array() as $row){ 
						$dt_date = $row['dt_date'];
						$dt_supplier = $row['dt_supplier'];
						$dt_approved = $row['dt_approve_date'];
						$dt_total = $row['dt_total_quantity'];
						$dt_status = $row['dt_status'];
					$ctr++;
				} ?>
			
				<div class="container">
					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income" style="min-height: 400px;">
					<div class="col-xs-12 total-label total-label-bank">Delivery Transaction ID: -- <?php echo $dt_id; ?></div>
					<div class="col-xs-7 total-label total-label-bank">Date Requested: <?php echo date("M j, Y g:i A", strtotime($dt_date)); ?> </div>
					<div class="col-xs-5 total-label total-label-bank">Brand Name: <?php echo $dt_supplier; ?></div>
					<div class="col-xs-7 total-label total-label-bank">
						<?php if($dt_status==1){ echo "Date Approved:"; } elseif($dt_status==2) { echo "Date Rejected:";} ?>
						<?php if($dt_approved=='0000-00-00 00:00:00'){echo "not yet approved";}else{echo date("M j, Y g:i A", strtotime($dt_approved));} ?> 
					</div>
					<div class="col-xs-5 total-label total-label-bank"><div id="print" onClick="printPage();" class="call-links">PRINT DELIVERY RECORDS</div></div>

						<div class="col-xs-12">
							<!-- <div class="row">
								<?php
									echo form_open('add-delivery-items');							
								?>
								<input type="field" placeholder="Item Code" name="item_code"/>
								<input type="field" placeholder="Item Quantity" name="item_quantity"/>
	                        	<input type="submit" class="submit-button" value="Add Item" />
								<?php									
									echo form_close();
								?>
							</div> -->

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-1 alter-xs-1"></div>
								<div class="col-xs-1 alter-xs-1">Qty</div>
								<div class="col-xs-2 alter-xs-2">Item Code</div>
								<div class="col-xs-3">Item Name</div>
								<div class="col-xs-1">Price</div>
								<div class="col-xs-5">Remarks</div>
							</div>
							
							<?php 
								$ctr = 1;
								$delivery_total = 0;
								foreach($delivery_transaction->result_array() as $row){ 
									$delivery_id = $row['delivery_id'];
									$item_code = $row['item_id'];
									$item_name = $row['item_name'];
									$item_price = $row['item_price'];
									$delivery_quantity = $row['delivery_quantity'];
									$delivery_dt = $row['delivery_dt'];

									$delivery_total = $delivery_total + $delivery_quantity;
							?>

								<div id="delrow<?php echo $delivery_id; ?>" class="row del-rows table-entries table-entries-income">
									<div class="col-xs-1 alter-xs-1"><a onClick="removeItem(<?php echo $item_code; ?>,<?php echo $delivery_id; ?>,<?php echo $delivery_quantity; ?>,<?php echo $dt_id; ?>,<?php echo $dt_total; ?>);" class="btn-red"><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>
									<div class="col-xs-1 alter-xs-1 del-qty" id="quant<?php echo $delivery_id; ?>" onClick="editItem(<?php echo $delivery_id; ?>,<?php echo $delivery_quantity; ?>);"><?php echo $delivery_quantity; ?></div>
									<div class="col-xs-2 alter-xs-2 item-code"><?php echo $item_code; ?></div>
									<div class="col-xs-3"><?php echo $item_name; ?></div>
									<div class="col-xs-1"><?php echo $item_price; ?></div>
									<div class="col-xs-5"><input class="col-xs-12 remarks" id="" value="" /></div>
								</div>

							<?php
								$ctr++;
							} ?>

							<div class="row table-entries table-entries-income">
									<div class="col-xs-6 del-total"><span id="realtotal"><?php echo $delivery_total; ?></span> total items to be delivered</div>
							</div>
						</div>

						<div class="table-title table-end table-end-general table-end-income">
								<div class="col-xs-12 total-label"><span style="float: left; padding-bottom: 50px; border-bottom: 1px solid black;">Delivered by:</span>
								<span style="float:right; margin-right: 300px; padding-bottom: 50px; border-bottom: 1px solid black;">Recieved by:</span></div>
						</div>

						<!-- <div class="table-title table-end table-end-general table-end-income">
								<div class="col-xs-6 col-sm-9 total-label">TOTAL EARNINGS</div>
								<div class="col-xs-3 total-amount"><?php echo $total_earnings; ?></div>
						</div> -->
					</div><!-- MEC end -->
				</div>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content item-modal">					                    
					        <div class="edit-item">
								<div class="head-contain">
									<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Item</h4>
								</div>
								<div class="modal-body modal-project">
									EDIT QTY FOR ITEM: <span id="item-check"></span>
									<input type="text" name="name" id="qty" placeholder="Enter Qty" />
									<input type="submit" class="btn submit-button" onClick="confirmQty(<?php echo $dt_id; ?>);" value="Confirm" />
								</div>
							</div>
						</div>
					</div>
				</div>