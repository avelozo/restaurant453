<?php  include 'header.php';?>
<?php if($error!=""){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>

<div class="container z-depth-3">
	<h4 class="center-align ">Products</h4>
	   <div class="input-field col s6">
      	
  		<select id="restaurants" name="restaurant"  onchange="filterRestaurant(this, 'product.php', fillTable)">
    		<option selected value="-1">All restaurants</option>
				<?php foreach ($restaurants as $restaurant): ?>
					<option value="<?php echo $restaurant->id; ?>"><?php echo $restaurant->name; ?></option>
				<?php endforeach; ?>
  		</select>
  		<label>Filter by</label>
      </div>



	<table class="bordered hoverable responsive-table tableClass">
        <thead>
          <tr>
			<th data-field="id" class="center-align">ID</th>
			<th data-field="id" class="center-align">Name</th>
			<th data-field="id" class="center-align">Vendor</th>
			<th data-field="id" class="center-align">Description</th>
			<th data-field="id" class="center-align">Options</th>
          </tr>
        </thead>
		<tbody>
			<?php echo $tableBody; ?>
		</tbody>
      </table>

      <form action="?" method="post">
       <br>
		<button class="waves-effect waves-light btn green" type="submit" name="add" value="Add">Add
    		<i class="mdi-content-add left"></i>
  		</button>
	</form>

</div>

<script>

 $(document).ready(function() {
    $('select').material_select();
  });
 
</script>

<?php  include 'footer.php';?>




