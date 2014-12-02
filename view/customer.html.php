<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>
<div class="boxContainer largeContainer marginContainer">
	<span>Customer</span><hr/>
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
		<?php foreach ($customers as $customer): ?>
		<tr class="tableRow" valign="top">
			<td><?php echo $customer->id; ?></td>
			<td><?php echo $customer->name; ?></td>
			<td><?php echo $customer->phone; ?></td>
			<td><?php echo $customer->addressLine1; ?></td>
			<td><?php echo $customer->addressLine2; ?></td>
			<td><?php echo $customer->city; ?></td>
			<td><?php echo $customer->state; ?></td>
			<td><?php echo $customer->country; ?></td>
			<td><?php echo $customer->postalCode; ?></td>
			<td>
				<form action="?" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $customer->id; ?>">
						<input type="submit" name="action" value="iedit">
						<input type="button" onclick="confirmDelete('<?php echo $deleteMsg . $customer->name . "?"; ?>', '<?php echo $deleteUrl; ?>', <?php echo $customer->id; ?>);" name="delete" value="idelete">
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
