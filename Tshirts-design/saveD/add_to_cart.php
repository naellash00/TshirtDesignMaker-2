<?php
//  database connection established
include '../conn.php';

// Add Design  into the cart table
//POST is used to upload data to services
//isset to check the existence of the variable
if (isset($_POST['did'])) {
    $design_id = $_POST['did'];
    $userid = $_POST['userid'];
    $dprice = $_POST['dprice'];
    $dqty = $_POST['dqty'];

    $total_price = $dprice * $dqty;
    //cart(UserID	qty	total_price	design_id)
    $stmt = $conn->prepare('SELECT design_id FROM cart WHERE design_id=?');
    $stmt->bind_param('i', $design_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['design_id'] ?? '';

    if (!$code) {
        $query = $conn->prepare('INSERT INTO cart (UserID,qty,total_price,design_id) VALUES (?,?,?,?)');
        $query->bind_param('iisi', $userid, $dqty, $total_price, $design_id);
        $query->execute();

        echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
    }
}
// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
    session_start();
    $userid = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM cart where UserID='$userid'");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}
