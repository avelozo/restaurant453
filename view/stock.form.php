<?php  include 'header.php';?>
<div class="boxContainer marginContainer">
	<span>Stock Entry</span><hr/>
		<form  action="?" method="post">
			<?php if($action === 'editform') : ?>

				<div>
					<label>Product Id: <?php echo $product->id; ?></label>
				</div>
			<?php endif; ?>

			<div>
				<label>Product Name: <?php echo $product->name; ?></label>
			</div>
			<div>
				<label for="restaurants">Restaurant <br />
				<select id="restaurants" name="restaurants"  onchange="filterRestaurant(this)">
					 <option disabled <?php $restaurantId == -1 ? "selected" : "" ?> value="-1">All restaurants</option>
					<?php foreach ($restaurants as $restaurant) : ?> 
			          <option <?php $restaurant->id == $restaurantId ? "selected" : "" ?> value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
			        <?php endforeach;?>
		    	</select>
			</div>
			<div>
				<label for="buyPrice">Buy Price <input type="text" class="inputContent" name="buyPrice"
				id="buyPrice" value="<?php echo $product->buyPrice; ?>" />
			</div>
			<div>
				<label for="price">Price <input type="text" class="inputContent" name="price"
				id="price" value="<?php echo $product->price; ?>" />
			</div>
			<div>
				<label for="quantity">Quantity <input type="text" class="inputContent" name="quantity"
				id="quantity" value="<?php echo $product->quantityInStock; ?>" />
			</div>
			<div>
				<label for="saleTaxRate">Sale Tax Rate <input type="text" class="inputContent" name="saleTaxRate"
				id="saleTaxRate" value="<?php echo $product->saleTaxRate; ?>" />
			</div>
			<div>
				<form action="?" method="post">
					<input type="hidden" name="id" value="<?php echo $product->id; ?>">
					<input type="submit" class="submitButton  rightPosition" name="action" value="<?php echo $action; ?>">
				</form>
			</div>
		</form>

<?php  include 'footer.php';?>