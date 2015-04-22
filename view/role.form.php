<?php  include 'header.php';?>
<div id="alertWarning" class="alertWarning"></div>


<div class="container z-depth-3">
<div class="row">
  <h4 class="center-align">Role</h4>
  <form class="col s12" action="?<?php echo $action; ?>" method="post" name="formRole" onsubmit="return validateForm()">
    <div class="row">
      <div class="input-field col s6">
        <input id="id" type="text" class="validate" name="id" value="<?php echo $role->id; ?>">
        <label for="id" >ID</label>
      </div>
      <div class="input-field col s6">
        <input id="name" type="text" class="validate" name="name" value="<?php echo $role->name; ?>">
        <label for="name" >Name</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <input type="hidden" name="id" value="<?php echo $role->id; ?>">
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
