<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>
<div class="container">
	<h5 class="center-align">Employees</h5>
	<table class="bordered hoverable">
        <thead>
          <tr>
			<th data-field="id" class="center-align">First Name</th>
			<th data-field="id" class="center-align">Last Name</th>
			<th data-field="id" class="center-align">Email</th>
			<th data-field="id" class="center-align">Restaurant</th>
			<th data-field="id" class="center-align">Job Title</th>
			<th data-field="id" class="center-align">Role</th>
			<th data-field="id" class="center-align">Manager</th>
			<th data-field="id" class="center-align">Options</th>
          </tr>
        </thead>

        <tbody>
        	<?php foreach ($employees as $employee): ?>
          <tr>
			<td class="center-align"><?php echo $employee->firstName; ?></td>
			<td class="center-align"><?php echo $employee->lastName; ?></td>
			<td class="center-align"><?php echo $employee->email; ?></td>
			<td class="center-align"><?php echo $employee->restaurant->name; ?></td>
			<td class="center-align"><?php echo $employee->jobTitle; ?></td>
			<td class="center-align"><?php echo $employee->role->name; ?></td>
			<td class="center-align"><?php echo $employee->reportsTo->firstName; ?></td>
            <td class="center-align">
				<form action="?" method="post">
					<div>
						<a class="btn-floating btn-flat waves-effect waves-light green"><i class="mdi-editor-mode-edit"></i><input type="submit" name="action" value= "iedit"></a>
						<input type="hidden" name="id" value="<?php echo $employee->id; ?>">
						
						<input type="button" onclick="callDeleteRoutine('<?php echo $deleteUrl; ?>', <?php echo $employee->id; ?>);" name="delete" value="idelete">
					</div>
				</form>
			</td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
	<form action="?" method="post">
		<input type="submit" name="add" class="submitButton  rightPosition" value="Add">
	</form>
</div>
<?php  include 'footer.php';?>