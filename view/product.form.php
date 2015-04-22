<?php  include 'header.php';?>



<div class="container z-depth-3">


<div class="row">
  <h4 class="center-align">Product</h4>
  <form class="col s12" action="?<?php echo $action; ?>" method="post">



	<?php if($action === 'editform') : ?>
	<div class="row">
      <div class="input-field col s12">
        <input id="id" type="text" class="inputContent" name="idField" value="<?php echo $product->id; ?>">
        <label for="id">ID</label>
      </div>
    </div>
    <?php endif; ?>

    <div class="row">
      <div class="input-field col s12">
        <input id="name" type="text" class="inputContent" name="name" value="<?php echo $product->name; ?>">
        <label for="name">Name</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="vendor" type="text" class="inputContent" name="vendor" value="<?php echo $product->vendor; ?>">
        <label for="vendor">Vendor</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input id="description" type="text" class="inputContent" name="description" value="<?php echo $product->description; ?>">
        <label for="description">Description</label>
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