<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT; ?>/css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>Rousseff Restaurant</title>
  </head>
  <body hola-ext-player="1">
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/js/materialize.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT; ?>/js/util.js"></script>
    <div class="hiddendiv common"></div>
    <header class="header grey darken-3 z-depth-1">
        <img src="<?php echo ROOT; ?>/img/logoRousseff120.png" alt="Logout" class="center-align">
        <?php if(isset($_SESSION['UserId'])) { ?>

        <ul class="navHeader">
         <li class="liClass">Welcome</li>
         <li class="liClass">
         
          <form action="?" method="post">
            <input type="hidden" name="action" value="logout">
            <input type="image" src="<?php echo ROOT; ?>/img/logout.png" alt="Logout" style="margin-top: -47px; margin-right: 20px;">
          </form>
        
         </li>
        </ul>


        <!--Colocar algo de logout aqui no futuro-->



        <?php } ?>


    </header>



    <?php include DIR_BASE . '/view/login.php'; ?>



        <!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="<?php echo ROOT; ?>/view/reports/orderreport.php">Order</a></li>
  <li class="divider"></li>
  <li><a href="<?php echo ROOT; ?>/view/reports/employeereport.php">Employee</a></li>
  <li><a href="<?php echo ROOT; ?>/view/reports/customerreport.php">Customer</a></li>
</ul>
<nav class="green">
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo">Rouseff</a>
    <ul class="right hide-on-med-and-down">
      <li><a href="<?php echo ROOT; ?>/view/orders/"><i class="mdi-action-dashboard left"></i>Order</a></li>

      <li><a href="<?php echo ROOT; ?>/view/employee.php"><i class="mdi-social-person left"></i>Employee</a></li>
      <li><a href="<?php echo ROOT; ?>/view/restaurant.php"><i class="mdi-maps-local-restaurant left"></i>Restaurant</a></li>
      <li><a href="<?php echo ROOT; ?>/view/role.php"><i class="mdi-action-dashboard left"></i>Role</a></li>

      <li><a href="<?php echo ROOT; ?>/view/product.php"><i class="mdi-maps-local-drink left"></i>Product</a></li>
      <li><a href="<?php echo ROOT; ?>/view/customer.php"><i class="mdi-social-person-outline left"></i>Customer</a></li>
      <li><a href="<?php echo ROOT; ?>/view/stock.php"><i class="mdi-action-store left"></i>Stock</a></li>
      



      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#" data-activates="dropdown1">Reports<i class="mdi-navigation-arrow-drop-down right"></i></a></li>
    </ul>
  </div>
</nav>
    
<script type="text/javascript" >
    $( document ).ready(function(){
        $(".dropdown-button").dropdown();
 
 
    });
 
</script>

    <div class="main content">
