<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>


<div class="container z-depth-3">
	<h4 class="center-align ">Customer</h4>
	<table class="bordered hoverable responsive-table">
        <thead>
          <tr>
			<th data-field="id" class="center-align">ID</th>
			<th data-field="id" class="center-align">Name</th>
			<th data-field="id" class="center-align">Phone</th>
			<th data-field="id" class="center-align">Address</th>
			<th data-field="id" class="center-align">Address2</th>
			<th data-field="id" class="center-align">City</th>
			<th data-field="id" class="center-align">State</th>
			<th data-field="id" class="center-align">Country</th>
			<th data-field="id" class="center-align">PostalCode</th>
			<th data-field="id" class="center-align">Options</th>
          </tr>
        </thead>




        <tbody>
        	<?php foreach ($customers as $customer): ?>
          <tr>
			<td class="center-align"><?php echo $customer->id; ?></td>
			<td class="center-align"><?php echo $customer->name; ?></td>
			<td class="center-align"><?php echo $customer->phone; ?></td>
			<td class="center-align"><?php echo $customer->addressLine1; ?></td>
			<td class="center-align"><?php echo $customer->addressLine2; ?></td>
			<td class="center-align"><?php echo $customer->city; ?></td>
			<td class="center-align"><?php echo $customer->state; ?></td>
			<td class="center-align"><?php echo $customer->country; ?></td>
			<td class="center-align"><?php echo $customer->postalCode; ?></td>
            <td class="center-align">
				<form action="?" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $customer->id; ?>">
						<button class="btn-floating btn-flat waves-effect waves-light green tooltipped" data-position="top" data-delay="15" data-tooltip="Edit Costumer"  type="submit" name="action" value="iedit">
    						<i class="mdi-editor-mode-edit"></i>
  						</button>

  						<button class="btn-floating btn-flat waves-effect waves-light red lighten-3 tooltipped" data-position="top" data-delay="15" data-tooltip="Delete Costumer"  type="button" onclick="callDeleteRoutine('<?php echo $deleteUrl; ?>', <?php echo $customer->id; ?>);" name="delete" value="idelete">
    						<i class="mdi-action-delete"></i>
  						</button>
					</div>
				</form>
			</td>
          </tr>
          <?php endforeach; ?>


        </tbody>
      </table>

      <form action="?" method="post">
       <br>
		<button class="waves-effect waves-light btn green" type="submit" name="add" value="Add">Add
    		<i class="mdi-content-add left"></i>
  		</button>
	</form>

</div>


<?php  include 'footer.php';?>