<?php  include 'header.php';?>
<?php if($error!=""){?>
<div class="alertWarning">

</div>
<?php }?>



<div class="container z-depth-3">
	<h4 class="center-align ">Role</h4>
	<table class="bordered hoverable responsive-table">
        <thead>
          <tr>
			<th data-field="id" class="center-align">ID</th>
			<th data-field="id" class="center-align">Name</th>
			<th data-field="id" class="center-align">Options</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach ($roles as $role): ?>
          <tr>
			<td class="center-align"><?php echo $role->id; ?></td>
			<td class="center-align"><?php echo $role->name; ?></td>
            <td class="center-align">
				<form action="?" method="post">





					<div>
						<input type="hidden" name="id" value="<?php echo $role>id; ?>">
						<button class="btn-floating btn-flat waves-effect waves-light tooltipped green" data-position="top" data-delay="15" data-tooltip="Edit Role"  type="submit" name="action" value="iedit">
    						<i class="mdi-editor-mode-edit"></i>
  						</button>

  						<button class="btn-floating btn-flat waves-effect waves-light red tooltipped red lighten-3" data-position="top" data-delay="15" data-tooltip="Delete Role" type="button" onclick="callDeleteRoutine('<?php echo $deleteUrl; ?>', <?php echo $role->id; ?>);" name="delete" value="idelete">
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
