<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>
<div class="boxContainer largeContainer">
	<span>Employees</span><hr/>
	<table class="tableClass">
		<tr class= "tableRowHeader">
			<th>SSN</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Restaurant</th>
			<th>Job Title</th>
			<th>Role</th>
			<th>Manager</th>
			<th>Options</th>

		</tr>
		<?php foreach ($employees as $employee): ?>
		<tr class="tableRow" valign="top">
			<td><?php echo $employee->ssn; ?></td>
			<td><?php echo $employee->firstName; ?></td>
			<td><?php echo $employee->lastName; ?></td>
			<td><?php echo $employee->email; ?></td>
			<td><?php echo $employee->restaurant->name; ?></td>
			<td><?php echo $employee->jobTitle; ?></td>
			<td><?php echo $employee->role->name; ?></td>
			<td><?php echo $employee->reportsTo->firstName; ?></td>
			<td>
				<form action="?" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $employee->id; ?>">
						<input type="submit" name="action" value="iedit">
						<input type="submit" name="action" value="idelete">
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
</body>
</html>
