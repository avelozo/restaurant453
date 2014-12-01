<?php  include 'header.php';?>
<div class="boxContainer marginContainer">
	<span>Customer</span><hr/>
		<form  action="?<?php echo $action; ?>" method="post">
			<div><label for="id">ID <input type="text" class="inputContent" name="id"
				id="id" value="<?php echo $customer->id; ?>"></label></div>
			<div><label for="name">Name <input type="text" class="inputContent" name="name"
				id="name" value="<?php echo $customer->name; ?>"></label></div>
			<div><label for="phone">Phone <input type="text" class="inputContent" name="phone"
				id="phone" value="<?php echo $customer->phone; ?>"></label></div>


<div><label for="addressLine1">Address Line 1 <input type="text" class="inputContent" name="addressLine1"
				id="addressLine1" value="<?php echo $customer->addressLine1; ?>"></label></div>
			<div>

<div><label for="addressLine2">Address Line 2 <input type="text" class="inputContent" name="addressLine2"
				id="addressLine2" value="<?php echo $customer->addressLine2; ?>"></label></div>
			<div>
<div><label for="city">City <input type="text" class="inputContent" name="city"
				id="city" value="<?php echo $customer->city; ?>"></label></div>
			<div>
<div><label for="state">State <input type="text" class="inputContent" name="state"
				id="state" value="<?php echo $customer->state; ?>"></label></div>
			<div>
<div><label for="country">Country<input type="text" class="inputContent" name="country"
				id="country" value="<?php echo $customer->country; ?>"></label></div>
			<div>
				<div><label for="postalCode">Postal Code<input type="text" class="inputContent" name="postalCode"
				id="postalCode" value="<?php echo $customer->postalCode; ?>"></label></div>
			<div>

				<input type="hidden" name="id" value="<?php echo $customer->id; ?>">
				<input type="submit" class="submitButton  rightPosition" value="Confirm">
			</div>
		</form>
	</div>
	</body>
</html>
