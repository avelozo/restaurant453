<?php  include 'header.php';?>

<div class="alertWarning"><?php echo $error ?></div>
<div class="boxContainer marginContainer">
	<span>Role</span><hr/>
	<table class="tableClass">
		<tr class= "tableRowHeader">
			<th>ID</th>
			<th>Name</th>
			<th>Options</th>
		</tr>
		<?php foreach ($roles as $role): ?>
		<tr class="tableRow" valign="top">
			<td><?php echo $role->id; ?></td>
			<td><?php echo $role->name; ?></td>
			<td>
				<form action="?" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $role->id; ?>">
						<input type="submit" name="action" value="iedit">
						<input type="submit" name="action" value="idelete">
					</div>
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	<form action="?" method="post">
		<input type="submit" name="add" class="submitButton  rightPosition" value="Add">
	</form>
</div>
</body>
</html>
