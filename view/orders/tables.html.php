<<<<<<< HEAD
<div class="container z-depth-1">
	<label for="tableNumber">
			<input type="text" class="inputContent tableNumber" name="tableNumber" placeholder="Table Number" id="tableNumber" value="">
	</label>
<button  class="waves-effect waves-light btn green" value="Add" onclick="addTable(<?php echo $employeeId; ?>)">
=======
<div class="container z-depth-3">


    <div class="row">
      <div class="input-field col s12">
        <input id="tableNumber" type="text" class="inputContent tableNumber" name="tableNumber" value="">
        <label for="tableNumber">Table Number</label>
      </div>
    </div>

<button  class="waves-effect waves-light btn green" value="Add" onclick="addTable(<?php echo $employeeId; ?>)">Add
>>>>>>> f58c06ef72ad377cfa99aaec85c4284793525d6d
<i class="mdi-content-add left"></i>
</button>
</div>
 <div class="tableList"></div>
 