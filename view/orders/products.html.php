<div>
	<?php 
	include DIR_BASE . 'business/productBS.php';
	include "orderProducts.php"; 
	$product= new ProductBS();

	$order = $orderBS->getOrders(1);
	$productList= new ProductList($order[0],$product );
?>
	<form  action="?<?php echo $action; ?>" method="post" name="formEmployee" >
	<?php echo $productList->showProducts(); ?>

	<input type="text" name="productQuantity" value="<?php $productQuantity ?>"> 
	<input type="submit" class="submitButton" value="Confirm">
	</form>
	
</div>