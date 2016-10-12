<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!-- insert ponpon about content -->
			

				<div class="container">

					<!--The overwatch Main element Container or MEC-->
					<div class="overwatch-mec mec-income">
						<div class="head-contain">
							<h4><i class="fa fa-sticky-note-o" aria-hidden="true"></i>
							LIST OF ITEM CATEGORY</h4>
						</div>
						<div class="col-xs-12">						

							<div class="row table-title table-title-general table-title-income">
								<div class="col-xs-1"></div>
								<div class="col-xs-2">Category Name</div>
								<div class="col-xs-1">Status</div>
								<div class="col-xs-1"></div>
								<div class="col-xs-1"></div>
							</div>
							<?php
								$ctr = 0;
								foreach($category_list->result_array() as $row){ 
									$category_id=$row['category_id'];
									$category_name = $row['category_name'];
									$category_status = $row['category_status'];
									$ctr++;
							?>
								
								<div class="row table-entries table-entries-income">
									<div class="col-xs-1"><?php echo $ctr;?></div>
									<div class="col-xs-2"><?php echo $category_name;?></div>
									<div class="col-xs-1"><?php echo $category_status;?></div>
									<div class="col-xs-1">
										<a class="btn"
											<?php
												if($category_status==1) {
													echo "href='".base_url()."/admin/deactivate_category/$category_id'>Deactivate";
												} else {
													echo "<a href='".base_url()."/admin/activate_category/$category_id'>Activate";
												}
											?>
										</a>
									</div>
									<div class="col-xs-1">
										<a href="<?php echo base_url() ?>admin/delete_category/<?php echo $category_id?>" class="btn-red"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
									</div>
									
									
								</div>								

							<?php } ?>
							
						</div>

						<div class="table-title table-end table-end-general table-end-income">
						<?php echo form_open('admin/add-category');?>
	                        	<input type="field" placeholder="Add New Item Category" name="item_category" id="item_category" />
	                        	<input type="submit" class="submit-button call-links" value="Submit" />
	                        	
	                    <?php echo form_close();?>
						<div class="error"><?php echo validation_errors(); ?></div>
						</div>
					</div><!-- MEC end -->

				</div>
