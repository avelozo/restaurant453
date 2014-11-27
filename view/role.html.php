<?php  include 'header.php';?>

<div class="boxContainer marginContainer">
		<span>Role</span><hr/>
		<table class="tableClass">
			<tr class= "tableRowHeader">
				<th>Id</th>
				<th>Name</th>
				<th>Options</th>
			</tr>

			<?php foreach ($roles as $role): ?>
			<tr class="tableRow" valign="top">
				<td class=""><?php echo $role->id; ?></td>
				<td><?php echo $role->name; ?></td>
				<td>
					<form action="role.form.php" method="post">
						<div>
							<input type="submit" name="action" value="iedit">
							<input type="submit" name="action" value="idelete">
						</div>
					</form>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	</body>
</html>
