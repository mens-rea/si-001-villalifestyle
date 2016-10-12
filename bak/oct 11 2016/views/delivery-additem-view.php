<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">

	<!--The overwatch Main element Container or MEC-->
	
	<div class="overwatch-mec mec-income">
		
		<div class="col-xs-12 table-end-general table-end table-bank">
			<div class="col-xs-12">
				<input type="text" name="name" id="code" placeholder="Enter Barcodes Manually" />
				<input type="submit" id="add-item" value="ADD" class="call-links"></input>
			</div>
			<!-- <div class="col-md-4 total-label total-label-bank">TOTAL -- Php <span class="total-amount"></span></div> -->
		</div>

		<div class="col-xs-12">
			<div class="row table-title table-title-general">
				<div class="col-xs-1"></div>
				<div class="col-xs-1">Qty</div>
				<div class="col-xs-2">item code</div>
				<div class="col-xs-2">category</div>
				<div class="col-xs-3">item</div>
				<div class="col-xs-2 price-field">price</div>
			</div>
							
			<script type="text/javascript">
				//initialization of jquery array
				var ItemArray = [];
			</script>

			<div id="ajax-content-container">
						 
			</div>
		</div>

		<script type="text/javascript">

			var totalQuantity = 0;

			function removeItem($id) {
				$('#'+$id).remove();

				for (var i = 0; i < ItemArray.length; i++){
				    if(ItemArray[i].ItemName == $id) 
				    { 
				    	var temp = ItemArray[i].ItemQuantity;

				    	totalQuantity = totalQuantity - temp;
				        ItemArray.splice(i, 1);
				        break;
				    }
				}

			    /*var total = 0;
				$(".table-entries").each(function() {
					total += parseFloat($(this).find(".price-field").text());
				});
				$('.total-amount').html(total);*/

				alert($id+" successfully removed!")
			}

			function confirmQty(){
				$('#myModal').modal("hide");
				var $id = $('#item-check').text();
				for (var i = 0; i < ItemArray.length; i++){
				    if(ItemArray[i].ItemName == $id) 
				    { 
				    	var qty = parseInt($('#qty').val());

				    	var temp = ItemArray[i].ItemQuantity;

				    	totalQuantity = totalQuantity - temp;

				    	ItemArray[i].ItemQuantity = qty;

				    	$('#'+$id).find(".qtyarea").text(qty+" (edit)");

				    	totalQuantity = totalQuantity + qty;
				    }
				}
			}

			function editQty($id) {
				$('#myModal').modal("show");
				$('#item-check').text($id);
			}

			$(document).ready(function() {
				var barcode="";
			    $(document).keydown(function(e) {
			        var code = (e.keyCode ? e.keyCode : e.which);
				        if(code==13)// Enter key hit
				        {
							var eachctr = 0;
							totalQuantity = 0;

							$.ajax({
							   	url: 'deliver-more-data',
							   	type: "POST",
								data: {type: barcode},
								dataType: "html",
							   	success: function( data ) {
									if(data==null||data==''||data=='\n'){
										alert("Item does not exist.");

										barcode="";
									}
									else{
										var total = 0;
										ItemArray.push({
											ItemCode : '201602000000001', 
											ItemName : barcode,
											ItemQuantity : '1'/*$('.add-delivery-form #qty').val()*/
										});

										$('#ajax-content-container').prepend(data);

										barcode=""; 

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
							   	url: 'deliver-more-data',
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
										var total = 0;
										ItemArray.push({
											ItemCode : '201602000000001', 
											ItemName : code,
											ItemQuantity : '1'/*$('.add-delivery-form #qty').val()*/
										});

										$('#ajax-content-container').prepend(data);

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
					$.post('add-delivery-transaction',{data:ItemArray,qty:totalQuantity},function(html){
						alert('requested delivery successful!');

					});

					window.location.href = "<?php echo site_url('tenant/report-delivery'); ?>";
					return false;
				});
			});
		</script>
		<a id="submit" href="#" class="call-links">COMPLETE DELIVERY REQUEST</a>
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

							<input type="submit" class="btn submit-button" onClick="confirmQty();" value="Confirm" />
						</div>
					</div>
                </div>
            </div>
    </div>


</div>