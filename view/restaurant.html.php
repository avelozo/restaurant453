<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>
<div class="boxContainer marginContainer">
	<span>Restaurant</span><hr/>
	<table class="tableClass">
		<tr class= "tableRowHeader">
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
		<tr class="tableRow" valign="top">
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
						<input type="hidden" name="id" value="<?php echo $restaurant->id; ?>">
						<input type="submit" name="action" value="iedit">
						<input type="button" onclick="confirmDelete('<?php echo $deleteMsg . $restaurant->name . "?"; ?>', '<?php echo $deleteUrl; ?>', <?php echo $restaurant->id; ?>);" name="delete" value="idelete">
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
<?php  include 'footer.php';?>
