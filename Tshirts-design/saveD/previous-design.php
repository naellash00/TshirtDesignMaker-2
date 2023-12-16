<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  include '../conn.php';
  // استعلام SQL لاسترجاع البيانات من قاعدة البيانات
  $sql = "SELECT * FROM prevdesigns where user_id='$user_id'";
  $result = $conn->query($sql);
} else {
  //show alert and go to login page 
  echo "<script>alert('Please Login First');window.location.href = '../../signup_and_login/index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>T-shirt Design Maker</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .button-design {
      width: 177px;
      margin: 10px 3px;
      background-color: #bd2130;
      border: none;
      padding: 11px 34px;
      font-size: 12px;
      font-weight: bold;
      color: white;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
  </style>

</head>

<body>
  <!-- Navbar start -->
  <!-- first tag to Navbar -->
  <!--navbar-expand makes you responsive -->
  <nav class="navbar navbar-expand-md navbar-light" style="background-color: #fde3e9;">
    <!-- Brand -->
    <a class="navbar-brand" href="../../payment-code/index.php"><i class=""></i>&nbsp;&nbsp; T-shirt Design Maker </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../../shippmentTrack/index.php"><i class="bi bi-truck"></i> Tracking</a><!-- for track page -->
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../../signup_and_login/index.php"><i class="bi bi-person-fill"></i> Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../payment-code/cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a><!-- for cart page -->
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->
  <div class="container mt-5">
    <div id="message"></div>
    <?php
    // عرض البيانات في تصميم Bootstrap
    if ($result->num_rows > 0) {
      echo '<div class="row  card-group">'; // Start the card-group

      while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-3">
        <div class="card text-center">
            <div class="position-relative" style="overflow: hidden; height: 400px;">
                <img src="../Tshirts-images/' . $row["tscolor_url"] . '" class="card-img-top" alt="T-shirt" style="z-index: 1; width: 100%; height: 100%;">
                <img src="../upload_logo/' . $row["logo_url"] . '" class="img-fluid logo-overlay" alt="Logo" style="position: absolute; top: 35%; left: 50%; transform: translate(-50%, -50%); z-index: 2; width: 80px; height: auto;">
                <p class="card-text" style="position: absolute; top: 48%; left: 50%; transform: translate(-50%, -50%); z-index: 2; font-size: 17px; font-weight: bold; max-width: 121px; text-align: center; color:' . $row["words_color"] . '">' . $row["words"] . '</p>
            </div> 

                 
                  <div class="card-footer">

                   <form action="" class="form-submit">
                  <div class="row p-2">
                    <div class="col-md-6 py-1 pl-4">
                      <b>Quantity : </b>
                    </div>
                    <div class="col-md-6">
                      <input type="number" class="form-control dqty" value="' . $row['quantity'] . '">
                    </div>
                  </div>
                  <input type="hidden" class="design_id" value="' . $row['design_id'] . '">
                  <input type="hidden" class="dprice" value="' . $row['priproduct'] . '">
                  <input type="hidden" class="user_id" value="' . $user_id . '">
                   
                  
                  <button class="btn btn-primary button-design addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                    cart</button>
                </form>
                     
                  </div>
              </div>
              </div>';
      }

      echo '</div>'; // End the card-group
    } else {
      echo "0 results";
    }

    // إغلاق الاتصال بقاعدة البيانات
    $conn->close();


    ?>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script type="text/javascript">
    $(document).ready(function() {
      // Send product details in the server
      $(".addItemBtn").click(function(e) {
        e.preventDefault();
        var $form = $(this).closest(".form-submit");
        var design_id = $form.find(".design_id").val();
        var user_id = $form.find(".user_id").val();
        var d_price = $form.find(".dprice").val();
        var d_qty = $form.find(".dqty").val();

        $.ajax({
          //ajax It makes web applications more responsive to user interaction
          url: 'add_to_cart.php', //The address of the web page where the user clicked on a link that takes them to your page
          method: 'post', //To publish data
          data: {
            did: design_id,
            userid: user_id,
            dprice: d_price,
            dqty: d_qty
          },
          success: function(response) {
            $("#message").html(response);
            window.scrollTo(0, 0);
            load_cart_item_number();
          }
        });
      });
      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        //ajax It makes web applications more responsive to user interaction
        $.ajax({
          url: 'add_to_cart.php', //The address of the web page where the user clicked on a link that takes them to your page
          method: 'get', //The GET method passes the request data in the URL
          data: {
            cartItem: "cart_item"
          },
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>