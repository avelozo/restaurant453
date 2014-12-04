<div>
	<label for="tableNumber">
			<input type="text" class="inputContent tableNumber" name="tableNumber" placeholder="Table Number" id="tableNumber" value="">
	</label>
</div>
<input type="button" name="add" class="rightPosition submitButton" value="Add" onclick="addTable(<?php echo $employeeId; ?>)">

<div class="tableList">
</div>