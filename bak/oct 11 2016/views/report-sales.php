<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
			
	<div class="container">

		<!--The overwatch Main element Container or MEC-->

		<?php
			$total = 0;

			foreach($sales->result_array() as $row){ 
				$amt = $row['sales_total'];
				$ddct = $amt*0.12;
				$net = $amt-$ddct;
				$total = $total + $net;
			}
		?>


		<div class="overwatch-mec mec-income">
		admin
			
			<div class="table-bank-row">
						<div class="col-xs-9 table-end-general table-end table-bank">
								<div class="col-md-3 total-label total-label-bank">TOTAL SALES --</div><div class="col-md-3 total-amount"> <?php echo number_format($total, 2, '.',','); ?></div>
						</div>
						<div class="col-xs-4"></div>
			</div>
			
			<div class="row">
				<!-- FILTER FUNCTION -->
				<div class="col-xs-12 table-filter">
				<?php echo form_open('cashier/filter-month'); ?>
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
				<div class="col-xs-5">Item Name</div>
				<div class="col-xs-2">Amount</div>
				<div class="col-xs-2">Deduction</div>
				<div class="col-xs-3">Net Sales</div>	
			</div>
			
			<?php
				$total_earnings=0;
				
				foreach($sales->result_array() as $row){ 
					$sales_quantity = $row['sales_quantity'];
					$sales_item_name = $row['item_name'];
					$sales_amount = $row['sales_total'];
					$sales_deduction = $sales_amount*0.12;
					$sales_net = $sales_amount-$sales_deduction;
					$total_earnings = $total_earnings + $sales_net;
			?>
								
				<div class="row table-entries table-entries-income">
					<div class="col-xs-5"><?php echo $sales_item_name;?></div>
					<div class="col-xs-2"><?php echo number_format($sales_amount,2,'.',','); ?></div>
					<div class="col-xs-2"><?php echo "- ". number_format($sales_deduction,2,'.',',');?></div>
					<div class="col-xs-3"><?php echo number_format($sales_net, 2, '.',','); ?></div>	
				</div>
			<?php } ?>

			<div class="table-title table-end table-end-general table-end-income">
			<div class="col-xs-6 col-sm-9 total-label">TOTAL EARNINGS</div>
			<div class="col-xs-3 total-amount"><?php echo number_format($total_earnings, 2, '.',','); ?></div>
		</div>
							
		</div>

		
	
	</div><!-- MEC end -->

</div>