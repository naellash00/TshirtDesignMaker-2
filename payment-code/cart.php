<?php
session_start();
$user_id = 0;
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light" style="background-color: #fde3e9;">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php"><i class=""></i>&nbsp;&nbsp; T-shirt Design Maker </a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="../shippmentTrack/index.php"><i class="bi bi-truck"></i> Tracking</a><!-- for track page -->
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../signup_and_login/index.php"><i class="bi bi-person-fill"></i> Login </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                              echo $_SESSION['showAlert'];
                            } else {
                              echo 'none';
                            }
                            unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">//
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                  }
                  unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="10">

                  <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                <th>ID</th>
                <th>Logo</th>
                <th>Color</th>
                <th>Size</th>
                <th>Text</th>
                <th>Text Color</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>
                  <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              require 'config.php';
              $cart_select = "SELECT c.id,p.logo_url,p.tscolor_url,p.ts_size,p.words ,p.words_color,p.priproduct,c.qty,c.total_price FROM `prevdesigns` p JOIN cart c ON c.design_id=p.design_id WHERE c.UserID='$user_id'";
              $stmt = $conn->prepare($cart_select);
              //id,logo_url,tscolor_url,ts_size,words,words_color,priproduct,qty,total_price
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;
              while ($row = $result->fetch_assoc()) :
              ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <input type="hidden" class="did" value="<?= $row['id'] ?>">
                  <td><img src="../Tshirts-design/upload_logo/<?= $row['logo_url'] ?>" width="50"></td>
                  <td><img src="../Tshirts-design/Tshirts-images/<?= $row['tscolor_url'] ?>" width="50"></td>
                  <td><?= $row['ts_size'] ?></td>
                  <td><?= $row['words'] ?></td>
                  <td><?= $row['words_color'] ?></td>
                  <td>
                    <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['priproduct'], 2); ?>
                  </td>
                  <input type="hidden" class="pprice" value="<?= $row['priproduct'] ?>">
                  <td>
                    <input type="number" min="1" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                  </td>
                  <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'], 2); ?></td>
                  <td>
                    <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                  </td>
                </tr>
                <?php $grand_total += $row['total_price']; ?>
              <?php endwhile; ?>
              <tr>
                <td colspan="6">
                  <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                    Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b>&nbsp;&nbsp;<?= number_format($grand_total, 2); ?></b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

      // Change the item quantity
      $(".itemQty").on('change', function() {
        var $el = $(this).closest('tr');

        var did = $el.find(".did").val();
        var pprice = $el.find(".pprice").val();
        var qty = $el.find(".itemQty").val();
        location.reload(true);
        //ajax It makes web applications more responsive to user interaction
        $.ajax({
          url: 'action.php',
          method: 'post',
          cache: false,
          data: {
            qty: qty,
            did: did,
            pprice: pprice
          },
          success: function(response) {
            console.log(response);
          }
        });
      });

      // Load total no.of items added in the cart and display in the navbar
      load_cart_item_number();

      function load_cart_item_number() {
        //ajax It makes web applications more responsive to user interaction
        $.ajax({
          url: 'action.php', //The address of the web page where the user clicked on a link that takes them to your page
          method: 'get', //The GET method passes the request data in the URL 
          data: {
            cartItem: "cart_item"
          },
          //
          success: function(response) {
            $("#cart-item").html(response);
          }
        });
      }
    });
  </script>
</body>

</html>