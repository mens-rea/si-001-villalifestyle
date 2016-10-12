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
					<div class="col-xs-12 col-md-8 table-filter">
						<?php echo form_open('admin/filter-sales-month'); ?>
						<label>Filter By Date: </label>
						<input type="text" id="datepickerstart" class="datepicker" placeholder="From" name="filter_start_date">
						<input type="text" id="datepickerend" class="datepicker" placeholder="To" name="filter_end_date">
						<?php
							echo form_submit(array('name'=>'submit','value'=>'FILTER','class'=>'call-links'));
							echo form_close();
						?>
					</div>
					<div class="col-xs-12 col-md-4 table-filter">
						<?php echo form_open(); ?>
						<label>Filter By Tenant:</label>
						<input id="tenant-name" type="text" class="datepicker" placeholder="Tenant" name="filter_start_date">
						<?php
							echo form_close();
						?>
					</div>
				</div>

			<div id="ajax-content-container">
				<?php 
					$total = 0;

					foreach($sales->result_array() as $row){ 

						$sales_status = $row['sales_status'];

						if($sales_status == 0) { 
							$amt = $row['sales_total'];
							$ddct = $amt*0.03;
							$net = $amt-$ddct;
							$total = $total + $net;
						}
						
					} 
				?>
				<div class="table-bank-row">
					<div class="col-xs-7 table-end-general table-bank">
							<div class="col-md-12 total-label total-label-bank">TOTAL SALES -- <span id="total-amount" class="total-amount"><?php echo number_format($total, 2, '.',','); ?></span>
							</div>
							<div class="col-md-12 total-label total-label-bank">TOTAL QUANTITY SOLD -- <span id="total-amount" class="total-amount"><?php echo $qty_sold;?></span>
							</div>
					</div>
					<div class="col-xs-5">
						<p style="text-align: left;">These are all of the sales report. Today is: <?php echo $today = date('F j, Y  h:i:s');?></p>
						<div id="print" onClick="printPage();" class="call-links">PRINT SALES RECORDS</div>
					</div>
				</div>

				<div class="row table-title table-title-general table-title-income padding-alter row-alter">
					<div class="col-xs-2">Item Code</div>					
					<div class="col-xs-2">Item Name</div>
					<div class="col-xs-1">Date</div>
					<div class="col-xs-1">Type</div>
					<div class="col-xs-2 alter-xs-2">Supplier</div>
					<div class="col-xs-1 alter-xs-1">Amount</div>
					<div class="col-xs-1">Discount</div>					
					<div class="col-xs-1">Deduction</div>
					<div class="col-xs-1 net-col alter-xs-1">Net</div>	
					<div class="col-xs-1 alter-xs-1"></div>	
				</div>

				<?php	
					$total_discount = 0;
					$total_earnings = 0;
					$total_deduction = 0;
					$total_price = 0;
					foreach($sales->result_array() as $row){ 
						$sales_id = $row['sales_id'];
						$letter_code = $row['letter_code'];
						$item_code = $row['item_id'];
						$sales_quantity = $row['sales_quantity'];
						$sales_item_name = $row['item_name'];
						$sales_amount = $row['sales_total'];
						$sales_category = $row['item_category'];
						$sales_supplier = $row['item_supplier'];
						$sales_date = $row['sales_date'];
						$sales_discount = $row['sales_discount'];
						$sales_status = $row['sales_status'];
						$sales_deduction = $sales_amount*0.03;
						$sales_net = $sales_amount-$sales_deduction;

						if($sales_status == 0) {
						$total_discount = $total_discount + $sales_discount;
						$total_earnings = $total_earnings + $sales_net;
						$total_deduction = $total_deduction + $sales_deduction;
						$total_price = $total_price + $sales_amount;
				?>
					<div class="row table-entries table-entries-income padding-alter row-alter">
						<div class="col-xs-2"><?php echo $letter_code."-".$item_code;?></div>
						<div class="col-xs-2"><?php echo $sales_item_name;?></div>
						<div class="col-xs-1"><?php echo date("M j, Y g:i A", strtotime($sales_date)); ?></div>
						<div class="col-xs-1"><?php echo $sales_category; ?></div>
						<div class="col-xs-2 wrap-word alter-xs-2"><?php echo $sales_supplier; ?></div>
						<div class="col-xs-1 alter-xs-1"><?php echo number_format($sales_amount,2,'.',','); ?></div>
						<div class="col-xs-1"><?php echo number_format($sales_discount,2,'.',','); ?></div>
						<div class="col-xs-1"><?php echo "- ". number_format($sales_deduction,2,'.',',');?></div>
						<div class="col-xs-1 net-col alter-xs-1"><?php echo number_format($sales_net, 2, '.',','); ?></div>	
						<div class="col-xs-1 alter-xs-1 tright">
							<a href='<?php echo base_url() ?>admin/void_sales/<?php echo $sales_id; ?>'><i class="fa fa-archive" alt="archive" aria-hidden="true"></i></a>
						</div> 
					</div>
				<?php 
					}
				} 
				?>

				<div class="table-title table-end table-end-general table-end-income">
						<div class="col-xs-7 total-label">TOTAL 					</div>
						<div class="col-xs-1 total-label"><?php echo number_format($total_price, 2, '.',','); ?></div>
						<div class="col-xs-1 total-label"><?php echo number_format($total_discount, 2, '.',','); ?></div>
						<div class="col-xs-1 total-label"><?php echo number_format($total_deduction, 2, '.',','); ?></div>
						<div class="col-xs-1 total-label"><span class="total-amount"><?php echo number_format($total_earnings, 2, '.',','); ?></span></div>
						<div class="col-xs-1 total-label"></div>
				</div>

			</div> <!-- #ajax-content-container end -->

		</div><!-- MEC end -->

	</div>

	<script type="text/javascript">
			$(document).ready(function () {
				ajax_suggest();
				ajax_suggest_code();
			});

			function ajax_suggest(){
				$('#tenant-name').on('input', function() {
					var username = $('#tenant-name').val();
					$.ajax({
						url: "suggest-more-admin-all-sales-data",
						async: false,
						type: "POST",
						data: "type="+username,
						dataType: "html",
						success: function(data) {
							$('#ajax-content-container').html(data);
						}
					})
				});
			}  
	</script>