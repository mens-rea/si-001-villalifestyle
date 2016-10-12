<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
	function printPage(){
		window.print();
	}
</script>

	<div class="container">

		<!--The overwatch Main element Container or MEC-->
		<div class="overwatch-mec mec-income">
		
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
					<div class="col-xs-6 table-end-general table-bank">
							<div class="col-md-12 total-label total-label-bank">TOTAL SALES -- <span class="total-amount"><?php echo number_format($total, 2, '.',','); ?></span>
							</div>
							<div class="col-md-12 total-label total-label-bank">TOTAL QUANTITY SOLD -- <span id="total-amount" class="total-amount"><?php echo $qty_sold;?></span>
							</div>
					</div>
					<div class="col-xs-6"><p style="text-align: left;">This report is from <?php echo date("M j, Y", strtotime($fro)); ?> to <?php echo date("M j, Y", strtotime($to)); ?>. Today is <?php echo $today = date('F j, Y');?></p>
						<div id="print" onClick="printPage();" class="call-links">PRINT SALES RECORDS</div>
					</div>
				</div>
				<div class="row">
					<!-- FILTER FUNCTION -->
					<div class="col-xs-12 table-filter">
					<?php echo form_open('tenant/filter-sales-month'); ?>
						<label>Filter By Date: </label>
						<input type="text" id="datepickerstart" class="datepicker" placeholder="From" name="filter_start_date">
						<input type="text" id="datepickerend" class="datepicker" placeholder="To" name="filter_end_date">
					<?php
						echo form_submit(array('name'=>'submit','value'=>'FILTER','class'=>'call-links'));
						echo form_close();
					?>
					</div>
				</div>
				<div class="row table-title table-title-general table-title-income">
					<div class="col-xs-2">Item Code</div>
					<div class="col-xs-3">Item Name</div>
					<div class="col-xs-2">Date</div>
					<div class="col-xs-1">Type</div>
					<div class="col-xs-1">Amount</div>
					<div class="col-xs-1">Discount</div>
					<div class="col-xs-1">Deduction</div>
					<div class="col-xs-1 net-col">Net</div>	
				</div>
				<?php	
					$total_earnings = 0;
					$total_discount = 0;
					$total_earnings = 0;
					$total_deduction = 0;
					$total_price = 0;
					foreach($sales->result_array() as $row){ 
						$sales_quantity = $row['sales_quantity'];
						$item_code = $row['item_id'];
						$sales_item_name = $row['item_name'];
						$sales_amount = $row['sales_total'];
						$sales_category = $row['item_category'];
						$sales_supplier = $row['item_supplier'];
						$sales_date = $row['sales_date'];
						$sales_discount = $row['sales_discount'];
						$sales_status = $row['sales_status'];
						$sales_deduction = $sales_amount*0.03;
						$sales_net = $sales_amount-$sales_deduction;

						///if($sales_status == 0) {

					if($sales_status == 0){
					$total_discount = $total_discount + $sales_discount;
					$total_earnings = $total_earnings + $sales_net;
					$total_deduction = $total_deduction + $sales_deduction;
					$total_price = $total_price + $sales_amount;
				?>
					
					<div class="row table-entries table-entries-income">
						<div class="col-xs-2"><?php echo $item_code;?></div>
						<div class="col-xs-3"><?php echo $sales_item_name;?></div>
						<div class="col-xs-2"><?php echo date("M j, Y", strtotime($sales_date)); ?></div>
						<div class="col-xs-1"><?php echo $sales_category; ?></div>
						<div class="col-xs-1"><?php echo number_format($sales_amount,2,'.',','); ?></div>
						<div class="col-xs-1"><?php echo number_format($sales_discount,2,'.',','); ?></div>
						<div class="col-xs-1"><?php echo "- ". number_format($sales_deduction,2,'.',',');?></div>
						<div class="col-xs-1 net-col"><?php echo number_format($sales_net, 2, '.',','); ?></div>	
					</div>

				<?php } 
				} ?>

			<div class="table-title table-end table-end-general table-end-income">
					<div class="col-xs-8 total-label">TOTAL 					</div>
					<div class="col-xs-1 total-label"><?php echo number_format($total_price, 2, '.',','); ?></div>
					<div class="col-xs-1 total-label"><?php echo number_format($total_discount, 2, '.',','); ?></div>
					<div class="col-xs-1 total-label"><?php echo number_format($total_deduction, 2, '.',','); ?></div>
					<div class="col-xs-1 total-label"><span class="total-amount"><?php echo number_format($total_earnings, 2, '.',','); ?></span></div>
			</div>

		</div><!-- MEC end -->

	</div>