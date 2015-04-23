<div class="container z-depth-1">

	 <div class="row">
      <div class="input-field col s12">
        <input id="tableNumber" type="text" class="inputContent tableNumber" placeholder="Table Number" name="tableNumber" value="">
        <label for="tableNumber">Insert new table</label>
      </div>
    </div>

<button  class="waves-effect waves-light btn green" value="Add" onclick="addTable(<?php echo $employeeId; ?>)">
<i class="mdi-content-add left"></i>
</button>
</div>
 <div class="tableList"></div>



