<?php  include 'header.php';?>
<div class="boxContainer marginContainer">
	<span>Product</span><hr/>
		<form  action="?<?php echo $action; ?>" method="post">
			<?php if($action === 'editform') : ?>

				<div>
					<label for="id">ID <input disabled type="text" class="inputContent" name="idField"
					id="id" value="<?php echo $product->id; ?>" />
				</div>

			<?php endif; ?>
			<div>
				<label for="name">Name <input type="text" class="inputContent" name="name"
				id="name" value="<?php echo $product->name; ?>" />
			</div>
			<div>
				<label for="vendor">Vendor <input type="text" class="inputContent" name="vendor"
				id="vendor" value="<?php echo $product->vendor; ?>" />
			</div>
			<div>
				<label for="description">Description <input type="text" class="inputContent" name="description"
				id="description" value="<?php echo $product->description; ?>" />
			</div>
			<div>
				<input type="hidden" name="id" value="<?php echo $product->id; ?>">
				<input type="submit" class="submitButton  rightPosition" value="Confirm">
			</div>
		</form>
	</div>
	</body>
</html>