<?php  include 'header.php';?>
<?php if($error!=""){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div class="boxContainer marginContainer">
	<span>Products</span><hr/>
	<select id="restaurants" name="restaurant"  onchange="filterRestaurant(this, 'product.php')">
		 <option selected value="-1">All restaurants</option>
		<?php foreach ($restaurants as $restaurant) : ?> 
			<option value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
		<?php endforeach;?>
    </select>
	<table class="tableClass">
		<thead>
			<tr class= "tableRowHeader">
				<th>ID</th>
				<th>Name</th>
				<th>Vendor</th>
				<th>Description</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tableBody; ?>
		</tbody>
	</table>
	<form action="?" method="post">
		<input type="submit" name="add" class="submitButton  rightPosition" value="Add">
	</form>
</div>
<?php  include 'footer.php';?>