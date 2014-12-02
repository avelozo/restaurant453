<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>
<div class="boxContainer marginContainer">
	<span>Role</span><hr/>
	<table class="tableClass">
		<tr class= "tableRowHeader">
			<th>ID</th>
			<th>Name</th>
			<th>Options</th>
		</tr>
		<?php foreach ($roles as $role): ?>
		<tr class="tableRow" valign="top">
			<td><?php echo $role->id; ?></td>
			<td><?php echo $role->name; ?></td>
			<td>
				<form action="?" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $role->id; ?>">
						<input type="submit" name="action" value="iedit">
							<input type="button" onclick="confirmDelete('<?php echo $deleteMsg . $role->name . "?"; ?>', '<?php echo $deleteUrl; ?>', <?php echo $role->id; ?>);" name="delete" value="idelete">
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
<?php  include 'footer.php';?>
