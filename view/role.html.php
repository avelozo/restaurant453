<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Roles - Rousseff Restaurant</title>
	</head>
	<body>
		<h1>Roles - Rousseff Restaurant</h1>
		<p><a href="?add">Add new role</a></p>
		<table>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Options</th>
			</tr>
			<?php foreach ($roles as $role): ?>
			<tr valign="top">
				<td><?php echo $role->id; ?></td>
				<td><?php echo $role->name; ?></td>
				<td>
					<form action="?" method="post">
						<div>
							<input type="hidden" name="id" value="<?php
								echo $role->id; ?>">
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
