<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>sign up</title>
  <link rel='stylesheet' href='style.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
  <!-- Navbar start -->
  <!-- first tag to Navbar -->
  <!--navbar-expand makes you responsive -->
  <nav class="navbar navbar-expand-md navbar-light" style="background-color: #fde3e9;">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class=""></i>&nbsp;&nbsp; T-shirt Design Maker </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../payment-code/cart.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a><!-- for Checkout page -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../shippmentTrack/index.php"><i class="bi bi-truck"></i> Tracking</a><!-- for track page -->
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../signup_and_login/index.php"><i class="bi bi-person-fill"></i> Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../payment-code/cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a><!-- for cart page -->
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  <div class="main">

    <h2> Sign up </h2>

    <!--link this form tag with the register_post page-->
    <form action="register_post.php" method="POST">
      <!--when user click on the register button the action will take them to sign up / register_post.php code-->

      <?php if (isset($username_error)) {
        // to print username error messages in register_post page
        echo $username_error;
      } ?>
      <input type="text" name="username" id="username" placeholder="username"><br>


      <?php if (isset($email_error)) {
        // to print email error messages in register_post page
        echo $email_error;
      } ?>
      <input type="email" name="email" id="email" placeholder="email"><br>



      <?php if (isset($password_error)) {
        // to print password error messages in register_post page
        echo $password_error;
      } ?>
      <input type="password" name="password" id="password" placeholder="password"><br>


      <input type="submit" name="submit" id="submit" value="Register"><br>

    </form>

    <h5><i> already have an account? </i></h5> <br>
    <a id="login" href="index.php"> Log in </a>

  </div>

</body>

</html>