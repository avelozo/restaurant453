<?php  include 'header.php';?>
<div class="boxContainer marginContainer">
	<span>Role</span><hr/>
		<form  action="?<?php echo $action; ?>" method="post">
			<div><label for="id">ID <input type="text" class="inputContent" name="id"
				id="id" value="<?php if (!isset($_POST['add'])){echo $role->id;}?>"></label></div>
			<div><label for="name">Name <input type="text" class="inputContent" name="name"
				id="name" value="<?php if (!isset($_POST['add'])){echo $role->name;} ?>"></label></div>
			<div>
				<input type="hidden" name="id" value="<?php echo $role->id; ?>">
				<input type="submit" class="submitButton  rightPosition" value="Confirm">
			</div>
		</form>
	</div>
	</body>
</html>
