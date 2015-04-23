<?php  include 'header.php';?>




<div class="container z-depth-3">



<div class="row">
  <h4 class="center-align">Stock Entry</h4>
  <form class="col s12" action="?<?php echo $action; ?>" method="post">



	<?php if($action === 'editform') : ?>
	<div class="row">
      <div class="input-field col s12">
        <input id="id" type="text" class="inputContent disabled"  value="<?php echo $product->id; ?>">
        <label for="vendor">Product Id:</label>
      </div>
    </div>
    <?php endif; ?>

    <div class="row">
      <div class="input-field disabled col s12">
        <input id="name" type="text" class="inputContent" value="<?php echo $product->name; ?>">
        <label for="name">Product Name:</label>
      </div>
    </div>




	<div class="input-field col s12">
      	
  		<select class="left-align" name="restaurants" onchange="filterRestaurant(this)">
    		<option disabled <?php $restaurantId == -1 ? "selected" : "" ?> value="-1">All restaurants</option>
				<?php foreach ($restaurants as $restaurant) : ?> 
					<option <?php $restaurant->id == $restaurantId ? "selected" : "" ?> value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
				<?php endforeach;?>
		</select>
    <label>Restaurant</label>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="buyPrice" type="text" class="inputContent" name="buyPrice" value="<?php echo $product->buyPrice; ?>">
        <label for="buyPrice">Buy Price</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="price" type="text" class="inputContent" name="price" value="<?php echo $product->price; ?>">
        <label for="price">Price</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="quantity" type="text" class="inputContent" name="quantity" value="<?php echo $product->quantityInStock; ?>">
        <label for="quantity">Quantity</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s12">
        <input id="saleTaxRate" type="text" class="inputContent" name="saleTaxRate" value="<?php echo $product->saleTaxRate;  ?>">
        <label for="saleTaxRate">Sale Tax Rate</label>
      </div>
    </div>



     <div class="row">
      <div class="input-field col s12">
        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
        <button class="waves-effect waves-light btn green" type="submit" value="Confirm">Confirm
          <i class="mdi-action-assignment right"></i>
        </button>
      </div>
    </div>

  </form>
</div>



</div>



<script>

 $(document).ready(function() {
    $('select').material_select();
  });

errorVisibility();
</script>
<?php  include 'footer.php';?>
