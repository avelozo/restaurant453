<?php  include 'header.php';?>

<div class="boxContainer marginContainer">
		<span>Role</span><hr/>
		<form action="?" method="post">
		<table class="tableClass">
			<tr class= "tableRowHeader">
				<th>ID</th>
				<th>Name</th>
				<th>Options</th>
			</tr>

			<?php foreach ($roles as $role): ?>
			<tr class="tableRow" valign="top">
				<td class=""><?php echo $role->id; ?></td>
				<td><?php echo $role->name; ?></td>
				<td>
					
						<div>
							<input type="hidden" name="id" value="<?php echo $role->id; ?>">
							<input type="submit" name="action" value="iedit">
							<input type="submit" name="action" value="idelete">
						</div>

					
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<input type="submit" name="add" class="submitButton  rightPosition" value="Add">
		</form>
	</div>
	</body>
</html>
