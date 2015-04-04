<?php  include 'header.php';?>
<div id="alertWarning" class="alertWarning"></div>
<div class="container z-depth-3">
<div class="row">
  <h5 class="center-align">Employees</h5>
  <form class="col s12" action="?<?php echo $action; ?>" method="post" name="formEmployee" onsubmit="return validateForm()">
    <div class="row">
      <div class="input-field col s6">
        <input id="firstName" type="text" class="validate" name="firstName" value="<?php echo $employee->firstName; ?>">
        <label for="firstname" >First Name</label>
      </div>
      <div class="input-field col s6">
        <input id="lastName" type="text" class="validate" name="lastName" value="<?php echo $employee->lastName; ?>">
        <label for="lastname" >Last Name</label>
      </div>
    </div>



    <div class="row">
      <div class="input-field col s12">
        <input id="ssn" type="text" class="validate" name="ssn" value="<?php echo $employee->ssn; ?>">
        <label for="ssn">Social Security Number</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s12">
        <input id="username" type="text" class="validate" name="userName" value="<?php echo $employee->userName; ?>">
        <label for="username">Username</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s12">
        <input id="password" type="password" class="validate" name="password">
        <label for="password">Password</label>
      </div>
    </div>

    
    <div class="row">
      <div class="input-field col s12">
        <input id="email" type="email" class="validate" name="email" value="<?php echo $employee->email; ?>">
        <label for="email">Email</label>
      </div>
    </div>





    <div class="row">
      <div class="input-field col s6">
      	<label>Restaurant</label>
  		<select  id="restaurant" name="restaurant">
    		<option value="" disabled selected>Choose your option</option>
			<?php foreach ($restaurants as $restaurant): ?>
				<option <?php echo isset($employee->restaurant) && $employee->restaurant->id == $restaurant->id ? 'selected' : ''?> value="<?php echo $restaurant->id; ?>">
					<?php echo $restaurant->name; ?>
				</option>
			<?php endforeach; ?>
  		</select>
      </div>
      <div class="input-field col s6">
      	<label>Manager</label>
  		<select name="manager">
    		<option value="" disabled selected>Choose your option</option>
				<?php foreach ($employees as $manager): ?>
					<option <?php echo isset($employee->reportsTo) && $employee->reportsTo->id == $manager->id ? 'selected' : ''?> value="<?php echo $manager->id; ?>">
						<?php echo $manager->firstName; ?>
					</option>
				<?php endforeach; ?>
  		</select>
      </div>
    </div>


      
      <div class="input-field col s12">
        <input id="jobTitle" type="text" class="validate" name="jobTitle" value="<?php echo $employee->jobTitle; ?>">
        <label for="jobTitle" >Job Title</label>
      </div>
      
      <div class="input-field col s12">
      	<label>Role</label>
  		<select name="role">
    		<option value="" disabled selected>Choose your option</option>
				<?php foreach ($roles as $role): ?>
					<option <?php echo isset($employee->role) && $employee->role->id == $role->id ? 'selected' : ''?> value="<?php echo $role->id; ?>">
						<?php echo $role->name; ?>
					</option>
				<?php endforeach; ?>
  		</select>
      </div>

    </div>

        <div class="row">
      <div class="input-field col s12">
        <input type="hidden" name="id" value="<?php echo $employee->id; ?>">
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