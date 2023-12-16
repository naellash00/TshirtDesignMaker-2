<?php

include('form.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tracking</title>
  <link rel='stylesheet' href='style.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
  <!--navbar-expand makes you responsive -->
  <nav class="navbar navbar-expand-md navbar-light" style="background-color: #fde3e9;">
    <!-- Brand -->
    <a class="navbar-brand" href="../payment-code/index.php"><i class=""></i>&nbsp;&nbsp; T-shirt Design Maker</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="bi bi-truck"></i> Tracking</a><!-- for track page -->
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../signup_and_login/index.php"><i class="bi bi-person-fill"></i> Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../payment-code/cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Take the order number from the user and check -->
  <div class="main">
    <h1>Shipment Tracking </h1><br>
    <i>Please enter your order number</i> <br> <br>
    <form action="index.php" method="POST">
      <input type="text" name="orderNumber" id="orderNumber" placeholder="Order Number"><br>
      <br>
      <input type="submit" name="submit" id="submit" value="Track"><br>
      <?php
      if (isset($error)) {
        echo $error;
      }
      ?>
      <!-- if there is no errors show the bar -->
      <?php
      if (isset(($_POST['submit']))) {
        if (!isset($error)) {
          include('orderStatus.php');
        }
      }
      ?>

    </form>
  </div>
  </div>
</body>

</html>