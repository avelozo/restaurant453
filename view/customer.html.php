<?php  include 'header.php';?>

<div class="boxContainer largeContainer marginContainer">
		<span>Costumer</span><hr/>
		<table class="tableClass">
			<tr class= "tableRowHeader">
				<th>ID</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Address</th>
				<th>Address2</th>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
				<th>PostalCode</th>
				<th>Options</th>
			</tr>

			<?php foreach ($customers as $costumer): ?>
			<tr class="tableRow" valign="top">
				<td class=""><?php echo $costumer->id; ?></td>
				<td><?php echo $costumer->name; ?></td>
				<td><?php echo $costumer->phone; ?></td>
				<td><?php echo $costumer->addressLine1; ?></td>
				<td><?php echo $costumer->addressLine2; ?></td>
				<td><?php echo $costumer->city; ?></td>
				<td><?php echo $costumer->state; ?></td>
				<td><?php echo $costumer->country; ?></td>
				<td><?php echo $costumer->postalCode; ?></td>
				<td>
					<form action="?" method="post">
						<div>
							<input type="hidden" name="id" value="<?php echo $costumer->id; ?>">
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
