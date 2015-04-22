<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning"><?php echo $error ?></div>
<?php }?>

<div class="container z-depth-3">
	<h4 class="center-align ">Restaurant</h4>
	<table class="bordered hoverable responsive-table">
        <thead>
          <tr>
			<th data-field="id" class="center-align">Name</th>
			<th data-field="id" class="center-align">Phone</th>
			<th data-field="id" class="center-align">Address Line 1</th>
			<th data-field="id" class="center-align">Address Line 2</th>
			<th data-field="id" class="center-align">City</th>
			<th data-field="id" class="center-align">State</th>
			<th data-field="id" class="center-align">Country</th>
			<th data-field="id" class="center-align">Postal Code</th>
			<th data-field="id" class="center-align">Options</th>
          </tr>
        </thead>

        <tbody>
        	<?php foreach ($restaurants as $restaurant): ?>
          <tr>
			<td class="center-align"><?php echo $restaurant->name; ?></td>
			<td class="center-align"><?php echo $restaurant->phone; ?></td>
			<td class="center-align"><?php echo $restaurant->addressLine1; ?></td>
			<td class="center-align"><?php echo $restaurant->addressLine2; ?></td>
			<td class="center-align"><?php echo $restaurant->city; ?></td>
			<td class="center-align"><?php echo $restaurant->state; ?></td>
			<td class="center-align"><?php echo $restaurant->country; ?></td>
			<td class="center-align"><?php echo $restaurant->postalCode; ?></td>
            <td class="center-align">
				<form action="?" method="post">
					<div>
						<input type="hidden" name="id" value="<?php echo $restaurant->id; ?>">
						<button class="btn-floating btn-flat waves-effect waves-light green" type="submit" name="action" value="iedit">
    						<i class="mdi-editor-mode-edit"></i>
  						</button>

  						<button class="btn-floating btn-flat waves-effect waves-light red lighten-3" type="button" onclick="callDeleteRoutine('<?php echo $deleteUrl; ?>', <?php echo $restaurant->id; ?>);" name="delete" value="idelete">
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
