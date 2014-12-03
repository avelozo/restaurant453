<?php  include DIR_BASE . 'view/ordersheader.php';?>
<?php if(isset($error) && $error != ""){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div class="marginContainer">
	
	<div class="verticalLine ordersTables">
		<?php  include 'tables.html.php';?>
	</div>

	<div class="verticalLine ordersDetails">
		<?php  include 'details.html.php';?>
	</div>

	<div class="ordersProducts">
		<?php  include 'products.html.php';?>
	</div>

</div>
<?php  include '../footer.php';?>