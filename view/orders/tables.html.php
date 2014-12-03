<?php
	$orders = $orderBS->getOrders();
?>

<div>
	<?php foreach ($orders as $order): ?>
		<input type="button" onclick="showDetails(<?php echo $order->id; ?>);" name="table" value=<?php echo $order->tableNumber; ?>><br>
	<?php endforeach; ?>
</div>