<div>
	<?php 
	include "../../config.php";
	 include DIR_BASE . 'business/orderBS.php';
	include "orderProducts.php"; 
	

	$order= new OrderBS();
	$order= $order->getOrders(1);
	$productList= new ProductList($order);
?>
	<form  action="?<?php echo $action; ?>" method="post" name="formEmployee" >
	echo $productList->showProducts(); 

	<input type="text" name="quantity" value="<?php $productQuantity ?>"> 
	<input type="submit" class="submitButton" value="Confirm">
	</form>
	?>
</div>