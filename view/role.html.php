<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Roles - Rousseff Restaurant</title>
  </head>
  <body>
    <h1>Roles - Rousseff Restaurant</h1>
    <p><a href="?add">Add new role</a></p>
    <ul>
      <?php foreach ($roles as $role): ?>
        <li>
          <form action="" method="post">
            <div>
              <?php echo($role->name); ?>
              <input type="hidden" name="id" value="<?php
                  echo $role->id; ?>">
              <input type="submit" name="action" value="Edit">
              <input type="submit" name="action" value="Delete">
            </div>
          </form>
        </li>
      <?php endforeach; ?>
    </ul>
    <p><a href="..">Return to Rousseff Restaurant home</a></p>
  </body>
</html>
