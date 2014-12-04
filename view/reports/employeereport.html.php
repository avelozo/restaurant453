<?php  include '../header.php';?>
<?php if(isset($error) && $error != ''){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div class="boxContainer marginContainer">
	<span>Employee Report</span><hr/>

	<label for="employeeStartDate">Start Date:
		<input type="text" name="employeeStartDate" id="employeeStartDate" />
	</label>

	<label for="employeeEndDate">End Date:
		<input type="text" name="employeeEndDate" id="employeeEndDate" />
	</label>

	<table class="tableClass">
		<thead>
			<tr class= "tableRowHeader">
				<th>Id</th>
				<th>SSN</th>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Email</th>
				<th>Job Title</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<?php  include '../footer.php';?>