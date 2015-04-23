<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT; ?>/css/materialize.min.css"  media="screen,projection"/>
     <link type="text/css" rel="stylesheet" href="<?php echo ROOT; ?>/css/style.css"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Rousseff Restaurant</title>
    <script type="text/javascript"  src="<?php echo ROOT; ?>/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript"  src="<?php echo ROOT; ?>/js/util.js"></script>
    <script type="text/javascript"  src="<?php echo ROOT; ?>/js/product.js"></script>
    <script type="text/javascript"  src="<?php echo ROOT; ?>/js/orders.js"></script>
    <script type="text/javascript"  src="<?php echo ROOT; ?>/js/product.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/js/orderStats.js"></script>
    <script type="text/javascript"  src="<?php echo ROOT; ?>/js/orders.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/js/materialize.min.js"></script>
    <title>Rousseff Restaurant</title>
  </head>
    
 <body hola-ext-player="1">
    <div class="hiddendiv common"></div>
    <header class="header green darken-3 z-depth-1">
        <?php if(isset($_SESSION['UserId'])) { ?>
        <ul class="navHeader" style="
    margin-top: 0px;
    margin-bottom: 0px;
    margin-left:95%;
">
           <li class="liClass">
          <form action="?" method="post">
            <input type="hidden" name="action" value="logout">
            <input type="image" src="<?php echo ROOT; ?>/img/logout.png" alt="Logout"> 
          </form>
         </li>
        </ul>
        <?php } ?>
    </header>
<nav class="green">
</nav>

    
