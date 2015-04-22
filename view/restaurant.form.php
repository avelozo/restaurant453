<?php  include 'header.php';?>
<div id="alertWarning" class="alertWarning"></div>













<div class="container z-depth-3">


<div class="row">
  <h4 class="center-align">Restaurant</h4>
  <form class="col s12" action="?<?php echo $action; ?>" method="post" name="formRestaurant" onsubmit="return validateForm()">
    <div class="row">
      <div class="input-field col s6">
        <input id="firstName" type="text" class="validate" name="name" value="<?php echo $restaurant->name; ?>">
        <label for="name" >Name</label>
      </div>
      <div class="input-field col s6">
        <input id="phone" type="text" class="validate" name="phone" value="<?php echo $restaurant->phone; ?>">
        <label for="phone" >Phone</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s6">
        <input id="addressLine1" type="text" class="validate" name="addressLine1" value="<?php echo $restaurant->addressLine1; ?>">
        <label for="addressLine1" >Address Line 1</label>
      </div>
      <div class="input-field col s6">
        <input id="addressLine2" type="text" class="validate" name="addressLine2" value="<?php echo $restaurant->addressLine2; ?>">
        <label for="addressLine2" >Address Line 2</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s6">
        <input id="city" type="text" class="validate" name="city" value="<?php echo $restaurant->city; ?>">
        <label for="city" >City</label>
      </div>
      <div class="input-field col s6">
        <input id="state" type="text" class="validate" name="state" value="<?php echo $restaurant->state; ?>">
        <label for="state" >State</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s6">
        <input id="country" type="text" class="validate" name="country" value="<?php echo $restaurant->country; ?>">
        <label for="country" >Country</label>
      </div>
      <div class="input-field col s6">
        <input id="postalCode" type="text" class="validate" name="postalCode" value="<?php echo $restaurant->postalCode; ?>">
        <label for="postalCode" >Postal Code</label>
      </div>
    </div>



     <div class="row">
      <div class="input-field col s12">
        <input type="hidden" name="id" value="<?php echo $restaurant->id; ?>">
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
