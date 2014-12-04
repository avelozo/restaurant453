<?php  include '../header.php';?>
<?php if(isset($error) && $error != ''){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div class="boxContainer marginContainer">
	<span>Customer Report</span><hr/>

	<label for="customerStartDate">Start Date:
		<input type="text" name="customerStartDate" id="customerStartDate" />
	</label>

	<label for="customerEndDate">End Date:
		<input type="text" name="customerEndDate" id="customerEndDate" />
	</label>

	<label for="customerMinValue">Min Value:
		<input type="text" name="customerMinValue" id="customerMinValue" value="100"/>
	</label>

	<table class="tableClass">
		<thead>
			<tr class= "tableRowHeader">
				<th>Id</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Address Line 1</th>
				<th>Address Line 2</th>
				<th>City</th>
				<th>State</th>
				<th>Country</th>
				<th>Postal Code</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<?php  include '../footer.php';?>