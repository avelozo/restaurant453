<?php  include 'header.php';?>
<?php if($error!=""){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>



<div class="container z-depth-3">
	<h4 class="center-align ">Stock</h4>
	   <div class="input-field col s6">
      	
  		<select id="restaurants" name="restaurant"  onchange="filterRestaurant(this, 'stock.php', fillTableAndHead)">
    		<option <?php echo !isset($restaurantId) ? 'selected' : '' ?> value="-1">All restaurants</option>
				<?php foreach ($restaurants as $restaurant): ?>
					<option <?php echo isset($restaurantId) && $restaurantId == $restaurant->id ? 'selected' : '' ?> value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
				<?php endforeach; ?>
  		</select>
      </div>
	<table class="bordered hoverable responsive-table tableClass">
        <thead>

          <tr>
			<th data-field="id" class="center-align">Product</th>
			<?php if($restaurantId != null && $restaurantId > 0) : ?>
				<th data-field="id" class="center-align">Buy Price</th>
				<th data-field="id" class="center-align">Price</th>
				<th data-field="id" class="center-align">Quantity</th>
				<th data-field="id" class="center-align">Sale Tax Rate</th>
			<?php endif; ?>
			<th data-field="id" class="center-align">Options</th>
          </tr>
        </thead>
		<tbody>
			<?php echo $tableBody; ?>
		</tbody>
      </table>



</div>




<script>

 $(document).ready(function() {
    $('select').material_select();
  });
 errorVisibility();
</script>
<?php  include 'footer.php';?>
