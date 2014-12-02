<?php  include 'header.php';?>
<div class="boxContainer marginContainer">
	<span>Restaurant</span><hr/>
	<form action="?<?php echo $action; ?>" method="post">
		<div><label for="name">Name: <input type="text" class="inputContent" name="name" id="name"
			value="<?php echo $restaurant->name; ?>"></label></div>
		<div><label for="phone">Phone: <input type="text" class="inputContent" name="phone" id="phone"
			value="<?php echo $restaurant->phone; ?>"></label></div>
		<div><label for="addressLine1">Address Line 1: <input type="text" class="inputContent" name="addressLine1" id="addressLine1"
			value="<?php echo $restaurant->addressLine1; ?>"></label></div>
		<div><label for="addressLine2">Address Line 2: <input type="text" class="inputContent" name="addressLine2" id="addressLine2"
			value="<?php echo $restaurant->addressLine2; ?>"></label></div>
		<div><label for="city">City: <input type="text" class="inputContent" name="city" id="city"
			value="<?php echo $restaurant->city; ?>"></label></div>
		<div><label for="state">State: <input type="text" class="inputContent" name="state" id="state"
			value="<?php echo $restaurant->state; ?>"></label></div>
		<div><label for="country">Country: <input type="text" class="inputContent" name="country" id="country"
			value="<?php echo $restaurant->country; ?>"></label></div>
		<div><label for="postalCode">Postal Code: <input type="text" class="inputContent" name="postalCode" id="postalCode"
			value="<?php echo $restaurant->postalCode; ?>"></label></div>
		<div>
			<input type="hidden" name="id" value="<?php echo $restaurant->id; ?>">
			<input type="submit" class="submitButton  rightPosition" value="Confirm">
		</div>
	</form>
</div>
<?php  include 'footer.php';?>
