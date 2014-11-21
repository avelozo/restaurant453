<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Roles - Rousseff Restaurant</title>
	</head>
	<body>
		<h1>Roles - Rousseff Restaurant</h1>
		<form action="?<?php echo $action; ?>" method="post">
			<div><label for="id">Id: <input type="text" name="id"
				id="id" value="<?php echo $role->id; ?>"></label></div>
			<div><label for="name">Name: <input type="text" name="name"
				id="name" value="<?php echo $role->name; ?>"></label></div>
			<div>
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="submit" value="<?php echo $button; ?>">
			</div>
		</form>
	</body>
</html>
