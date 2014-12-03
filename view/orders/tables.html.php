<?php
	$orders = $orderBS->getOrders(null, null, $_GET['employeeId']);
?>

<div>
	<form action="?" method="post">
		<div><label for="tableNumber">New<input type="text" class="inputContent" name="tableNumber"
			id="tableNumber" value=""></label></div>
		<input type="submit" name="add" class="submitButton  rightPosition" value="Add">
	</form>
	<?php foreach ($orders as $order): ?>
		<input type="button" onclick="showDetails(<?php echo $order->id; ?>);" name="table" value=<?php echo $order->tableNumber; ?>><br>
	<?php endforeach; ?>
</div>