<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
	function printPage(){
		window.print();
	}
</script>
	
	<div class="container">

		<!--The overwatch Main element Container or MEC-->
		<div class="overwatch-mec mec-income">
				
				<div class="row">
					<!-- FILTER FUNCTION -->
					
					<div class="col-xs-7 table-filter">
						
						<div class="col-xs-12">
							<label>Filter By Date: </label>
							<input type="text" id="datepickerstart" class="datetimepicker" placeholder="From" name="filter_start_date">
							<input type="text" id="datepickerend" class="datetimepicker" placeholder="To" name="filter_end_date">
							<input type="submit" name="date-filter" value="FILTER" class="call-links" id="date-filter">
						</div>
						<div class="col-xs-12">
							<label>Filter Sales Transaction:</label>
							<input id="tenant-name" type="text" class="datepicker" placeholder="" name="filter_start_date">
							<input type="submit" name="input-filter" value="SUBMIT" class="call-links" id="input-filter">
						</div>
					</div>
				</div>

			<div id="ajax-content-container">
				<h6><i>Use the filter to view data</i></h6>
			</div> <!-- #ajax-content-container end -->

		</div><!-- MEC end -->

	</div>

	<script type="text/javascript">
	$(document).ready(function () {
		ajax_suggest();
		ajax_suggest_code();
	});

	function ajax_suggest(){
		$('#date-filter').click(function() {
			var start_date = $('#datepickerstart').val();
			var end_date = $('#datepickerend').val();	
			
			$.ajax({
				url: "suggest-more-admin-all-sales-data",
				async: false,
				type: "POST",				
				data: {type:null,sdate:start_date,edate:end_date},
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').html(data);
				}
			})
		});

		$('#tenant-name').keydown(function(e) {
	        var code = (e.keyCode ? e.keyCode : e.which);
	        var username = $('#tenant-name').val();
			var start_date = $('#datepickerstart').val();
			var end_date = $('#datepickerend').val();
			

			if(code==13) {// Enter key hit

			$.ajax({
				url: "suggest-more-admin-all-sales-data",
				async: false,
				type: "POST",				
				data: {type:username,sdate:start_date,edate:end_date},
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').empty();
					$('#ajax-content-container').prepend(data);
				}

			})
			
			return false;	
	        }
		});

		$('#input-filter').click(function() {
			var username = $('#tenant-name').val();
			var start_date = $('#datepickerstart').val();
			var end_date = $('#datepickerend').val();
			
			$.ajax({
				url: "suggest-more-admin-all-sales-data",
				async: false,
				type: "POST",				
				data: {type:username,sdate:start_date,edate:end_date},
				dataType: "html",
				success: function(data) {
					$('#ajax-content-container').empty();
					$('#ajax-content-container').prepend(data);
				}
			})
		});
	} 
	</script>