<?php  include 'header.php';?>
<div class="boxContainer marginContainer">
	<span>Employee</span><hr/>

	<form  action="?<?php echo $action; ?>" method="post">
		
		
		<div><label for="ssn">SSN<input type="text" class="inputContent" name="ssn"
			id="ssn" value="<?php echo $employee->ssn; ?>"></label></div>
		

		<div><label for="firstName">First Name<input type="text" class="inputContent" name="firstName"
			id="firstName" value="<?php echo $employee->firstName; ?>"></label></div>
	

		<div><label for="lastName">Last Name <input type="text" class="inputContent" name="lastName"
			id="lastName" value="<?php echo $employee->lastName; ?>"></label></div>
		

		<div><label for="email"> E-mail <input type="text" class="inputContent" name="email"
			id="email" value="<?php echo $employee->email; ?>"></label></div>
		
			<div><label for="userName"> Username <input type="text" class="inputContent" name="userName"
			id="userName" value="<?php echo $employee->userName; ?>"></label></div>
		

		<div><label for="password"> Password <input type="password" class="inputContent" name="password"
			id="password" value="<?php echo $employee->password; ?>"></label></div>
		
		<div><span class="labelContent">Restaurant</span> </label> 
		<select class="selectContent" id="restaurant" name="restaurant"> 
			<?php foreach ($restaurants as $restaurant): ?>
				<option value="<?php echo $restaurant->id; ?>">
					<?php echo $restaurant->name; ?></option>
 	     <?php endforeach; ?>
		</select></div>

		<div><span class="labelContent">Manager</span></label>
		<select class="selectContent" name="reportsTo"> <?php foreach ($employees as $manager): ?>
				<option value="<?php echo $manager->id; ?>">
					<?php echo $manager->firstName; ?></option>
 	<?php endforeach; ?>
	</select> </div>

			 
		

			<div><label for="jobTitle">Job Title </label> <input type="text" class="inputContent" name="jobTitle"
			id="jobTitle" value="<?php echo $employee->jobTitle; ?>"></label></div>
	

			<div><span class="labelContent">Role</span><select class="selectContent" name="role"> <?php foreach ($roles as $role): ?>
				<option value="<?php echo $role->id; ?>">
					<?php echo $role->name; ?></option>
 		<?php endforeach; ?>
	</select></div>
		
		<div>
     		<input type="hidden" name="id" value="<?php echo $employee->id; ?>">
			<input type="submit" class="submitButton  rightPosition" value="Confirm">
		</div>
	</form>
</div>
</body>
</html>
