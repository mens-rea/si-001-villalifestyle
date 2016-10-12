<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
	<!--The overwatch Main element Container or MEC-->
	<div class="head-contain">
			<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i>ADD ITEMS (SCAN BARCODE NOW)</h4>
	</div>
	
	<div class="overwatch-mec mec-income">

		<div class="col-xs-12 table-end-general table-bank">
			<div class="col-xs-12">
				<input type="text" name="name" id="code" placeholder="Enter Barcodes Manually" />
				<input type="submit" id="add-item" value="ADD" class="call-links"></input>
			</div>
			<div class="col-xs-12 total-label total-label-bank">TOTAL -- Php <span class="total-amount"></span></div>
		</div>

		<div class="col-xs-12">
			<div class="row table-title table-title-general">
				<div class="col-xs-1"></div>
				<div class="col-xs-1">Brand Code</div>
				<div class="col-xs-2">Item code</div>
				<div class="col-xs-2">Supplier</div>
				<div class="col-xs-2">Discount</div>
				<div class="col-xs-2">Item</div>
				<div class="col-xs-2 price-field">Price</div>
			</div>

			<div id="ajax-content-container"></div>

		</div>

		<script type="text/javascript">
			var ItemArray = [];

			//removal of item from queue
			function removeItem($id) {
				$('#'+$id).remove();
				for (var i = 0; i < ItemArray.length; i++){
				    if(ItemArray[i].ItemName == $id) 
				    { 
				        ItemArray.splice(i, 1);
				        break;
				    }
				}
			    var total = 0;
				$(".table-entries").each(function() {
					total += parseFloat($(this).find(".price-field").text());
				});
				$('.total-amount').html(total);
			}

			function confirmDiscount(){
				$('#myModal').modal("hide");
				var $id = $('#item-check').text();
				for (var i = 0; i < ItemArray.length; i++){
				    if(ItemArray[i].ItemName == $id) 
				    { 
				    	if(ItemArray[i].ItemAct == '99999999999999'){
				    		ItemArray[i].ItemAct = parseFloat($('#'+$id).find(".price-field").text());
				    	}

				    	var discass = $('#discount').val();
				    	ItemArray[i].ItemDiscount = discass;

				    	var disc = ItemArray[i].ItemDiscount;
				    	var actdisc = disc;
				    	/*alert(actdisc);*/

				    	var price = ItemArray[i].ItemAct;
				    	var total = price - actdisc;
				        /*alert($id+"discount"+ItemArray[i].ItemDiscount);*/
				        $('#'+$id).find(".discount").text(ItemArray[i].ItemDiscount+"Php");
				        $('#'+$id).find(".price-field").text(total);
        				break; //Stop this loop, we found it!
				    }
				}

			    var total = 0;
				$(".table-entries").each(function() {
					total += parseFloat($(this).find(".price-field").text());
				});
				$('.total-amount').html(total);
			}

			function addDiscount($id) {

				$('#myModal').modal("show");

				$('#item-check').text($id);
			}

			$(document).ready(function() {

					var totalQuantity = 0;

					var barcode="";
				    $(document).keydown(function(e) {
				        var code = (e.keyCode ? e.keyCode : e.which);
				        if(code==13)// Enter key hit
				        {
							var eachctr = 0;
							totalQuantity = 0;

							if(barcode==""||barcode==null){
								barcode = $('#code').val();
							}

							$.ajax({
							   	url: 'sales-more-data',
							   	type: "POST",
								data: {type: barcode},
								dataType: "html",
							   	success: function( data ) {
									if(data==null||data==''||data=='\n'){
										alert("Item does not exist.");

										barcode="";
										$('#code').val('');
									}
									else{
										$('#ajax-content-container').prepend(data);

										//pre-processing input from item code
										var newcode = document.getElementById("lettercode").innerHTML;
										alert(newcode);
										var subcode = barcode.substr(3,code.length);

										var total = 0;
										ItemArray.push({
											ItemCode : '201602000000001',
											ItemName : newcode,
											ItemQuantity : '1',/*$('.add-delivery-form #qty').val()*/
											ItemDiscount : '0',
											ItemAct : '99999999999999'
										});

										$('#code').val('');
										barcode='';

									   	$.each(ItemArray, function(key, value) { 
											totalQuantity = parseInt(ItemArray[key].ItemQuantity) + totalQuantity;
										});										
									}
									$(".table-entries").each(function() {
									  	total += parseFloat($(this).find(".price-field").text());
									});
									$('.total-amount').html(total);
							   	},
							   	error: function(xhr, status, error) {
							      // check status && error
							      alert(error);
							   	}
							});
							      	
							return false;			        
						}
				        else if(code==9)// Tab key hit
				        {
				        }
				        else
				        {
				            barcode=barcode+String.fromCharCode(code);
				        }
				    });

				    $("#add-item").click(function (){
				    		var code = $('#code').val();
				    		var eachctr = 0;
							totalQuantity = 0;

							$.ajax({
							   	url: 'sales-more-data',
							   	type: "POST",
								data: {type: code},
								dataType: "html",
							   	success: function( data ) {

									if(data==null||data==''||data=='\n'){
										alert("Item does not exist.");

										barcode='';
										$('#code').val('');
									}
									else{
										$('#ajax-content-container').prepend(data);

										//pre-processing input from item code
										var newcode = document.getElementById("lettercode").innerHTML;
										alert(newcode);
										var subcode = code.substr(3,code.length);

										var total = 0;
										ItemArray.push({
											ItemCode : '201602000000001',
											ItemName : newcode,
											ItemQuantity : '1',/*$('.add-delivery-form #qty').val()*/
											ItemDiscount : '0',
											ItemAct : '99999999999999'
										});

										$('#code').val('');
										barcode='';

									   	$.each(ItemArray, function(key, value) { 
											totalQuantity = parseInt(ItemArray[key].ItemQuantity) + totalQuantity;
										});
									}

									$(".table-entries").each(function() {
									  	total += parseFloat($(this).find(".price-field").text());
									});
									$('.total-amount').html(total);
							   	},
							   	error: function(xhr, status, error) {
							      // check status && error
							      alert(error);
							   	}
							});
							      	
							return false;
					});

					$("#submit").click(function (){
						$.post('add-sales-transaction',{data:ItemArray,qty:totalQuantity},function(html){
							alert('Sales Transaction Recorded!');
							window.location.href = "<?php echo site_url('cashier'); ?>";
						});
						
						return false;
					});

			});

		</script>


			

							<div class="modal fade" id="myModal" role="dialog">
					                <div class="modal-dialog">
					                    <!-- Modal content-->
					                    <div class="modal-content item-modal">					                    
					                    	<div class="edit-item">
												<div class="head-contain">
													<h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Item</h4>
												</div>
												<div class="modal-body modal-project">
												ADD DISCOUNT FOR ITEM: <span id="item-check"></span>
															                    
													<!-- <input type="hidden" name="item_code" value="<?php echo $item_code?>">
													<label>Item Name: </label>
													<input type="field" name="item_name" value="<?php echo $item_name?>">
													<label>Item Price: </label>
													<input type="field" name="item_price" value="<?php echo $item_price?>">
													<label>Item Category: </label>
													<input type="field" name="item_category" value="<?php echo $item_category?>"> -->
													<input type="number" name="name" id="discount" placeholder="Enter Discount" />

													<input type="submit" class="btn submit-button" onClick="confirmDiscount();" value="Confirm" />
												</div>
											</div>
						                </div>
					                </div>
					        </div>

		<a id="submit" href="#" class="call-links">COMPLETE SALE</a>
	</div>

</div>