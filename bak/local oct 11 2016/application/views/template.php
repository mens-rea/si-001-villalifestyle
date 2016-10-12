<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
	
<div class="container">

	<!--The overwatch Main element Container or MEC-->
	<div class="overwatch-mec mec-income">

		<?php if (!isset($ajax_req)): ?>

			<div class="col-xs-2"><input type="text" name="name" id="name" placeholder="Search Name" /></div>
			<div class="col-xs-2"><input type="text" name="name" id="code" placeholder="Search Code" /></div>
 
			<!-- <div class="show-gallery">
				View only Gallery
			</div>		 
			<div class="show-images"> 
				View only Images
			</div>
			<div class="show-articles">	 
				View only Articles
			</div> -->

			<div id="ajax-content-container">
						 
				<table class="table table-bordered table-condensed table-striped">	 
					<tr>
						<th>Title</th>
						<th>Type</th>
						<th>Price</th>
					</tr>
					<?php foreach ($node_list as $key=>$value): ?>
					<tr>
						<td><?php print $value->item_id; ?></td>
						<td width="40%"><?php print ucfirst($value->item_name); ?></td>
						<td width="40%"><?php print ucfirst($value->item_price); ?></td>
					</tr>
					<?php endforeach; ?>
				</table>
						 
			</div>
						 
		<?php endif; ?>

		<script type="text/javascript">
			$(document).ready(function () {
				/*ajax_articles();
				ajax_images();
				ajax_gallery();*/
				ajax_suggest();
				ajax_suggest_code();

				var barcode="";
			    $(document).keydown(function(e) {

			        var code = (e.keyCode ? e.keyCode : e.which);
			        if(code==13)// Enter key hit
			        {
			            alert(barcode);
			            var username = $('#name').val();
						$('#code').val(''); //for singular search functions
						$.ajax({
							url: "suggest-more-data-code",
							async: false,
							type: "POST",
							data: "type="+barcode,
							dataType: "html",
							success: function(data) {
								$('#ajax-content-container').html(data);
								barcode="";
							}
						})     	
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
			});

			function ajax_suggest(){
				$('#name').on('input', function() {
					var username = $('#name').val();
					$('#code').val(''); //for singular search functions
					$.ajax({
						url: "suggest-more-data",
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

			function ajax_suggest_code(){
				$('#code').on('input', function() {
					var code = $('#code').val();
					$('#name').val(''); //for singular search functions
					$.ajax({
						url: "suggest-more-data-code",
						async: false,
						type: "POST",
						data: "type="+code,
						dataType: "html",
						success: function(data) {
							$('#ajax-content-container').html(data);
						}
					})
				});
			}
								  
			/*function ajax_articles() {
				$('.show-articles').click(function () {
					$.ajax({
						url: "give-more-data",
						async: false,
						type: "POST",
						data: "type=1",
						dataType: "html",
						success: function(data) {
							$('#ajax-content-container').html(data);
						}
					})
				});    
			}				  
			function ajax_images() {
				$('.show-images').click(function () {
					$.ajax({
						url: "give-more-data",
						async: false,
						type: "POST",
						data: "type=2",
						dataType: "html",
						success: function(data) {
							$('#ajax-content-container').fadeIn().html(data);
						}
					})
				});
			}		  
			function ajax_gallery() {
				$('.show-gallery').click(function () {
					$.ajax({
						url: "give-more-data",
						async: false,
						type: "POST",
						data: "type=3",
						dataType: "html",
						success: function(data) {
							$('#ajax-content-container').html(data);
						}
					})
				});
			}*/	
		</script>
						  
	</div><!-- MEC end -->

</div>