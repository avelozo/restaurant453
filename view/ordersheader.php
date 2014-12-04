  <head>
    <meta charset="utf-8">
    <link href="<?php echo ROOT; ?>/css/normalize.css" rel="stylesheet">
    <link href="<?php echo ROOT; ?>/css/main.css" rel="stylesheet">
    <link  href="<?php echo ROOT; ?>/css/login_page.css"  rel="stylesheet"/>
    <script src="<?php echo ROOT; ?>/scripts/jquery-2.1.1.min.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/product.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/util.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/validate.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/orders.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/product.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/validate.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/orderStats.js"></script>
    <script src="<?php echo ROOT; ?>/scripts/orders.js"></script>
    <title>Rousseff Restaurant</title>
  </head>
  <body>
    
    <div class="previewHeader">
      <img id="logoHeader" src="<?php echo ROOT; ?>/img/logoRousseff120.png" >
      <ul class="navHeader">
       <li class="liClass">Welcome</li>
       <li class="liClass">
        <form action="?" method="post">
          <input type="hidden" name="action" value="logout">
          <input type="image" src="<?php echo ROOT; ?>/img/logout.png" alt="Logout" style="margin-top: -47px; margin-right: 20px;">
        </form>
       </li>
      </ul>
    </div>

     <?php include DIR_BASE . '/view/login.php'; ?>
 