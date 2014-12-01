<?php  include 'header.php';?>

<div class="alertWarning"><?php echo $error ?></div>
<div class="boxContainer marginContainer">
		<span>Products</span><hr/>
		<table class="tableClass">
			<tr class= "tableRowHeader">
				<th>ID</th>
				<th>Name</th>
				<th>Vendor</th>
				<th>Description</th>
				<th>Options</th>
			</tr>
			<?php foreach ($products as $product): ?>
				<tr class="tableRow" valign="top">
					<td><?php echo $product->id; ?></td>
					<td><?php echo $product->name; ?></td>
					<td><?php echo $product->vendor; ?></td>
					<td><?php echo $product->description; ?></td>
					<td>
						<form action="?" method="post">
							<div>
								<input type="hidden" name="id" value="<?php echo $product->id; ?>">
								<input type="submit" name="action" value="iedit">
								<input type="button" onclick="confirmDelete('<?php echo $deleteMsg . $product->name . "?"; ?>', '<?php echo $deleteUrl; ?>', <?php echo $product->id; ?>);" name="delete" value="idelete">
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