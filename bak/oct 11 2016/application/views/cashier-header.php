<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>

	<head>
		<title>Villalifestyle Boutique</title>

		<!-- FOR ACCORDION CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/accordion.css">

		<!-- FOR DROPZONE CSS -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>dropzone-master/dist/min/dropzone.min.css"  />

		<!-- FOR SLIDER -->
		<link rel="stylesheet" href="<?php echo base_url();?>components/jquery.bxslider/jquery.bxslider.css">
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/default.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/slider-component.css" />

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style.css">
	</head>

	<body class="cbp-spmenu-push">
		<div id="wrapper">
			<div id="content">

				<!-- button activator -->
				<div class="header">
				    <div class="navicon"><a id="showLeftPush" class="showLeftPush" href="#"><i class="fa fa-bars"></i></a></div>
				</div>

				<!-- menu list --> 
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
				    <ul>
				    	<li><a href="<?php echo base_url(); ?>cashier" class="menu-title"><i class="fa fa-crosshairs"></i>Hi, <?php echo $sessions;?></a></li>				        
				        <!---POS-->						
						<li><a href="<?php echo base_url() ?>cashier/report-sales">SALES REPORT</a></li>
						<li><a href="<?php echo base_url() ?>cashier/report-delivery">DELIVERY REPORT</a></li>
						<li><a href="<?php echo base_url() ?>cashier/report-pullout">PULLOUT REPORT</a></li>	
				    </ul>
				    <a href="<?php echo base_url(); ?>cashier/edit-user-info">EDIT ACCOUNT <i class="fa fa-user"></i></a>
				   <a href="<?php echo base_url() ?>logout" class="logout">LOGOUT <i class="fa fa-sign-out"></i></a>
				</nav>

				<!-- POS PARTS -->
				<a id="showLeftPush" class="action-buttons action-button-1" href="add-sales">+ SALES</a>			

				<!-- <div class="modal fade" id="InputSaleTransact" role="dialog">
	                <div class="modal-dialog">
	                    <div class="modal-content">

	                      <div class="col-md-12">

	                        <div class="modal-body modal-project">
	                          <i class="fa fa-coffee"></i>INPUT SALES ITEM
	                          <?php echo form_open('add-sales') ?>
		                        	<input type="field" placeholder="Item Code" name="item_code" />
		                        	<input type="field" placeholder="Item Quantity" name="item_quantity"/>                      	
		                        	<input type="submit" class="submit-button" value="Submit" />
		                      <?php echo form_close();?>
	                        </div>

	                      </div>

	                    </div>
	                </div>
	            </div> -->