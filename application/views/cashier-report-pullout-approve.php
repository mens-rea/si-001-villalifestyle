<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
	function printPage(){
		window.print();
	}
</script>

<a id="showLeftPush" class="action-buttons action-button-2 delivery-action" href="report-pullout">PENDING PULLOUT</a>

<a id="showLeftPush" class="action-buttons action-button-3 delivery-action" href="report-approved-pullout">APPROVED PULLOUT</a>

<a id="showLeftPush" class="action-buttons action-button-4 delivery-action" href="report-rejected-pullout">REJECTED PULLOUT</a>

				<div class="container">
				<!--The overwatch Main element Container or MEC-->					
					
					<div class="overwatch-mec mec-income">

						<div class="table-bank-row">
							<div class="col-xs-5">
								<p style="text-align: left;">These are all your pullout history. Today is: <?php echo $today = date('F j, Y');?></p>
								<div id="print" onClick="printPage();" class="call-links">PRINT PULLOUT RECORDS</div>
							</div>

							<div class="col-xs-7 table-filter">
								<div class="col-xs-12">
									<label>Filter By Date: </label>
									<input type="text" id="datepickerstart" class="datetimepicker" placeholder="From" name="filter_start_date">
									<input type="text" id="datepickerend" class="datetimepicker" placeholder="To" name="filter_end_date">
									<input type="submit" name="date-filter" value="FILTER" class="call-links" id="date-filter">
								</div>
								<div class="col-xs-12">
									<label>Filter Pullout Transaction:</label>
									<input id="pullout-filter-box" type="text" class="datepicker" placeholder="Enter item here.." name="filter_start_date">
								</div>
							</div>
						</div>

						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i></i>APPROVED PULLOUT REQUEST</h4>
						</div>
						<div class="col-xs-12" id="ajax-content-container">							
							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-2 alter-xs-2">Pullout Code</div>
								<div class="col-xs-2 alter-xs-2">Supplier</div>
								<div class="col-xs-1 alter-xs-1">Qty</div>								
								<div class="col-xs-4 alter-xs-4">Item Name</div>
								<div class="col-xs-2 alter-xs-2">Request Pullout Date</div>
								<div class="col-xs-2 alter-xs-2">Approved Pullout Date</div>
								<div class="col-xs-1">Remarks</div>
							</div>
							<?php

								foreach($pullout->result_array() as $row){ 
									$pullout_code = $row['pullout_id'];
									$item_code = $row['item_id'];
									$pullout_item = $row['item_name'];
									$pullout_supplier = $row['name'];
									$pullout_quantity = $row['pullout_quantity'];
									$pullout_status = $row['pullout_status'];
									$pullout_date = $row['pullout_date'];
									$pullout_approved_date = $row['pullout_approved_date'];
									$letter_code = $row['letter_code'];

									if($pullout_status == 1 ){
							?>
							
							
								
								<div class="row table-entries table-entries-income">
									<div class="col-xs-2 alter-xs-2"><?php echo $pullout_code;?></div>									
									<div class="col-xs-2 wrap-word alter-xs-2"><?php echo $pullout_supplier;?></div>
									<div class="col-xs-1 alter-xs-1"><?php echo $pullout_quantity;?></div>
									<div class="col-xs-4 alter-xs-4"><?php echo $letter_code."-".$item_code." "; echo $pullout_item;?></div>
									<div class="col-xs-2 alter-xs-2"><?php echo date("M j, Y <\b\\r> g:i A", strtotime($pullout_date)); ?></div>
									<div class="col-xs-2 alter-xs-2"><?php echo date("M j, Y <\b\\r> g:i A", strtotime($pullout_approved_date)); ?></div>	
									<div class="col-xs-1"><input class="col-xs-12 remarks" id="" value="" /></div>	
									
								</div>

								<?php
									} 
								} 
							?> 
						</div>
					</div>
					

						<!-- pending view end -->

						
					

				</div>

<script type="text/javascript">
	$(document).ready(function () {
		ajax_suggest();
		ajax_suggest_code();
	});

	/*function ajax_suggest(){
		$('#pullout-filter-box').on('input', function() {
			var username = $('#pullout-filter-box').val();
			$.ajax({
				url: "filter-approved-pullout-transaction",
				async: false,
				type: "POST",
				data: "type="+username,
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').html(data);
				}
			})
		});
	}  */

	function ajax_suggest(){
		$('#date-filter').click(function() {
			var start_date = $('#datepickerstart').val();
			var end_date = $('#datepickerend').val();	
			
			$.ajax({
				url: "filter-approved-pullout-transaction",
				async: false,
				type: "POST",
				//data: "type="+username,
				data: {type:null,sdate:start_date,edate:end_date},
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').html(data);
				}
			})

		});

		$('#pullout-filter-box').on('input', function() {
			var username = $('#pullout-filter-box').val();

			var start_date = $('#datepickerstart').val();
			var end_date = $('#datepickerend').val();

			

			$.ajax({
				url: "filter-approved-pullout-transaction",
				async: false,
				type: "POST",
				data: {type:username,sdate:start_date,edate:end_date},
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').html(data);
				}
			})
		});
	}  
	</script>