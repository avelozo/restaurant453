<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <link href="<?php echo ROOT; ?>/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/css/normalize.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/css/main.css" rel="stylesheet">
    <link  href="<?php echo ROOT; ?>/css/login_page.css"  rel="stylesheet"/>
    <script src="<?php echo ROOT; ?>/scripts/jquery-2.1.1.min.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/jquery-ui.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/util.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/product.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/validate.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/orderStats.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/orders.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/customerStats.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/employeeStats.js"></script>

    <title>Rousseff Restaurant</title>
  </head>
  <body>
    
    <div class="previewHeader">
    	<img id="logoHeader" src="<?php echo ROOT; ?>/img/logoRousseff120.png" alt="Logout">
    	<ul class="navHeader">
    	 <li class="liClass">Welcome</li>
    	 <li class="liClass">
        <form action="?" method="post">
          <input type="hidden" name="action" value="logout">
          <input type="image" src="<?php echo ROOT; ?>/img/logout.png" alt="Logout">
        </form>
       </li>
      </ul>
    </div>

    <?php include DIR_BASE . '/view/login.php'; ?>
  
    <div class="leftPanel">
      <div class="leftMenu">
        <ul>
          <li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/orders/"><img src="<?php echo ROOT; ?>/img/iorder.png" class="leftPIcon"></i> <span>Order</span></a></li>
        	<li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/employee.php"><img src="<?php echo ROOT; ?>/img/iemployee.png" class="leftPIcon"></i> <span>Employee</span></a></li>
        	<li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/restaurant.php"><img src="<?php echo ROOT; ?>/img/irestaurant.png" class="leftPIcon"></i> <span>Restaurant</span></a></li>
        	<li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/role.php"><img src="<?php echo ROOT; ?>/img/irole.png" class="leftPIcon"></i> <span>Role</span></a></li>

          <li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/product.php"><img src="<?php echo ROOT; ?>/img/iproduct.png" class="leftPIcon"></i> <span>Product</span></a></li>
          <li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/customer.php"><img src="<?php echo ROOT; ?>/img/icustomer.png" class="leftPIcon"></i> <span>Customer</span></a></li>
          <li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/stock.php"><img src="<?php echo ROOT; ?>/img/istock.png" class="leftPIcon"></i> <span>Stock</span></a></li>
        	<li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/reports/orderreport.php"><img src="<?php echo ROOT; ?>/img/ichart.png" class="leftPIcon"></i> <span>Order Report</span></a></li>
        	<li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/reports/employeereport.php"><img src="<?php echo ROOT; ?>/img/ichart.png" class="leftPIcon"></i> <span>Employee Report</span></a></li>
        	<li class="leftPanelLi"><a href="<?php echo ROOT; ?>/view/reports/customerreport.php"><img src="<?php echo ROOT; ?>/img/ichart.png" class="leftPIcon"></i> <span>Customer Report</span></a></li>
        </ul>
      </div>
    </div>  
    <div class="menuExpandCollapse">
      -
    </div>
    <div class="main content">
 