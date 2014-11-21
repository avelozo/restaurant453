<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Restaurants - Rousseff Restaurant</title>
	</head>
	<body>
		<h1>Restaurants - Rousseff Restaurant</h1>
		<p><a href="?add">Add new restaurant</a></p>
		<table>
			<tr>
				<th>Name</th>
				<th>Phone</th>
				<th>Address Line 1</th>
				<th>Address Line 2</th>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
				<th>Postal Code</th>
				<th>Options</th>
			</tr>
			<?php foreach ($restaurants as $restaurant): ?>
			<tr valign="top">
				<td><?php echo $restaurant->name; ?></td>
				<td><?php echo $restaurant->phone; ?></td>
				<td><?php echo $restaurant->addressLine1; ?></td>
				<td><?php echo $restaurant->addressLine2; ?></td>
				<td><?php echo $restaurant->city; ?></td>
				<td><?php echo $restaurant->state; ?></td>
				<td><?php echo $restaurant->country; ?></td>
				<td><?php echo $restaurant->postalCode; ?></td>
				<td>
					<form action="?" method="post">
						<div>
							<input type="hidden" name="id" value="<?php
								echo $restaurant->id; ?>">
							<input type="submit" name="action" value="Edit">
							<input type="submit" name="action" value="Delete">
						</div>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	<p><a href="..">Return to Rousseff Restaurant home</a></p>
	</body>
</html>
