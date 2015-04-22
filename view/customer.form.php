<?php  include 'header.php';?>
<div id="alertWarning" class="alertWarning"></div>

<div class="container z-depth-3">
<div class="row">
  <h4 class="center-align">Customer</h4>
  <form class="col s12" action="?<?php echo $action; ?>" method="post" >
    <div class="row">
      <div class="input-field col s12">
        <input id="name" type="text" class="validate" name="name" value="<?php echo $customer->name; ?>">
        <label for="name">Name</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s6">
        <input id="id" type="text" class="validate" name="id" value="<?php echo $customer->id; ?>">
        <label for="id" >ID</label>
      </div>
      <div class="input-field col s6">
        <input id="phone" type="text" class="validate" name="phone" value="<?php echo $customer->phone; ?>">
        <label for="phone" >Phone</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s6">
        <input id="addressLine1" type="text" class="validate" name="addressLine1" value="<?php echo $customer->addressLine1; ?>">
        <label for="addressLine1" >Address Line 1</label>
      </div>
      <div class="input-field col s6">
        <input id="addressLine2" type="text" class="validate" name="addressLine2" value="<?php echo $customer->addressLine2; ?>">
        <label for="addressLine2" >Address Line 2</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s6">
        <input id="city" type="text" class="validate" name="city" value="<?php echo $customer->city; ?>">
        <label for="city" >City</label>
      </div>
      <div class="input-field col s6">
        <input id="state" type="text" class="validate" name="state" value="<?php echo $customer->state; ?>">
        <label for="state" >State</label>
      </div>
    </div>


    <div class="row">
      <div class="input-field col s6">
        <input id="country" type="text" class="validate" name="country" value="<?php echo $customer->country; ?>">
        <label for="country" >Country</label>
      </div>
      <div class="input-field col s6">
        <input id="postalCode" type="text" class="validate" name="postalCode" value="<?php echo $customer->postalCode; ?>">
        <label for="postalCode" >Postal Code</label>
      </div>
    </div>





    <div class="row">
      <div class="input-field col s12">
        <input type="hidden" name="id" value="<?php echo $customer->id; ?>">
        <button class="waves-effect waves-light btn green" type="submit" value="Confirm">Confirm
          <i class="mdi-action-assignment right"></i>
        </button>
      </div>
    </div>

  </form>
</div>

</div>


<script>
errorVisibility();
</script>
<?php  include 'footer.php';?>