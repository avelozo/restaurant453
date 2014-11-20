<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Restaurants - Rousseff Restaurant</title>
	</head>
	<body>
		<h1>Restaurants - Rousseff Restaurant</h1>
		<form action="?<?php echo $action; ?>" method="post">
			<div><label for="name">Name: <input type="text" name="name" id="name"
				value="<?php echo $restaurant->name; ?>"></label></div>
			<div><label for="phone">Name: <input type="text" name="phone" id="phone"
				value="<?php echo $restaurant->phone; ?>"></label></div>
			<div><label for="addressLine1">Name: <input type="text" name="addressLine1" id="addressLine1"
				value="<?php echo $restaurant->addressLine1; ?>"></label></div>
			<div><label for="addressLine2">Name: <input type="text" name="addressLine2" id="addressLine2"
				value="<?php echo $restaurant->addressLine2; ?>"></label></div>
			<div><label for="city">Name: <input type="text" name="city" id="city"
				value="<?php echo $restaurant->city; ?>"></label></div>
			<div><label for="state">Name: <input type="text" name="state" id="state"
				value="<?php echo $restaurant->state; ?>"></label></div>
			<div><label for="country">Name: <input type="text" name="country" id="country"
				value="<?php echo $restaurant->country; ?>"></label></div>
			<div><label for="postalCode">Name: <input type="text" name="postalCode" id="postalCode"
				value="<?php echo $restaurant->postalCode; ?>"></label></div>
			<div>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="submit" value="<?php echo $button; ?>">
			</div>
		</form>
	</body>
</html>
