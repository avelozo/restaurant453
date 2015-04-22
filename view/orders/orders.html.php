<?php  include DIR_BASE . 'view/ordersheader.php';?>
<?php if(isset($error) && $error != ""){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div id="orderContainer">
	
   <?php  include 'tables.html.php';?>
	

	<div class="verticalLine ordersDetails">
		<?php  include 'details.html.php';?>
	</div>

	<div class="ordersProducts">
		<?php  include 'products.html.php';?>
	</div>

<script type="text/javascript">showTables();</script>
</div>
<?php  include DIR_BASE . 'view/footer.php';?>