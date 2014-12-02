<?php  include 'header.php';?>

<?php if($error!=""){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div class="boxContainer marginContainer">
		<span>Stock</span><hr/>
		<select id="restaurants" name="restaurant" onchange="filterRestaurant(this, 'stock.php', fillTableAndHead)">
			 <option selected value="-1">All restaurants</option>
			<?php foreach ($restaurants as $restaurant) : ?> 
	          <option value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
	        <?php endforeach;?>
    	</select>
		<table class="tableClass">
			<thead>
				<tr class= "tableRowHeader">
					<th>Restaurant</th>
					<th>Product</th>
					<?php if($restaurantId != null && $restaurantId > 0) : ?>
						<th>Buy Price</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Sale Tax Rate</th>
					<?php endif; ?>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
				<?php echo $tableBody; ?>
			</tbody>
		</table>

<?php  include 'footer.php';?>
