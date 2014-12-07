<?php  include '../header.php';?>
<?php if(isset($error) && $error != ''){?>
	<div class="alertWarning"><?php echo $error ?></div>
<?php } ?>
<div class="boxContainer marginContainer">
	<span>Order Report</span><hr/>

	<label for="startDate">Start Date:
	<input type="text" name="startDate" id="startDate" />
	</label>

	<label for="endDate">End Date:
		<input type="text" name="endDate" id="endDate" />
	</label>

	<table class="tableClass">
		<thead>
			<tr class= "tableRowHeader">
				<th>Date</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Ticket</th>
				<th>Avg Total</th>
				<th>Avg Ticket</th>
				<th>Total Above Avg?</th>
				<th>Ticket Above Avg?</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<?php  include '../footer.php';?>