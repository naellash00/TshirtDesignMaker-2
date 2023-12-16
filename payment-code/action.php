<?php
session_start(); //Creates the function new session or fills the current session based on the visual identifier passed by GET and POST requests
require 'config.php';
$user_id = 0;
//get user_id that login from session
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
}
// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {

	$stmt = $conn->prepare("SELECT * FROM cart where UserID='$user_id'");
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];

	$stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Item removed from the cart!';
	header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
	$stmt = $conn->prepare('DELETE FROM cart');
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'All Item removed from the cart!';
	header('location:cart.php');
}

// Set total price of the product in the cart table when update qty
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$did = $_POST['did'];
	$pprice = $_POST['pprice'];

	$tprice = $qty * $pprice;

	$stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	$stmt->bind_param('isi', $qty, $tprice, $did);
	$stmt->execute();
}

// Checkout and save customer info in the orders table
if (isset($_POST['action']) && isset($_POST['action']) == 'order') {

	//orders(UserID,name,email,phone,address,pmode,designs,amount_paid)
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$designs = $_POST['designs'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];
	$pmode = $_POST['pmode'];


	$data = '';
	//Order completion data
	$stmt = $conn->prepare('INSERT INTO orders (UserID,name,email,phone,address,pmode,designs,amount_paid)VALUES(?,?,?,?,?,?,?,?)');
	$stmt->bind_param('isssssss', $user_id, $name, $email, $phone, $address, $pmode, $designs, $grand_total);
	$stmt->execute();
	// Get the Order inserted ID
	$order_id = $conn->insert_id;
	//delete all cart items by user_id
	$stmt2 = $conn->prepare("DELETE FROM cart where UserID='$user_id' ");
	$stmt2->execute();
	$data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $designs . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Your E-mail : ' . $email . '</h4>
								<h4>Your Phone : ' . $phone . '</h4>
								<h4>Total Amount Paid : ' . number_format($grand_total, 2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
								<h4>Order Number : ' . $order_id . '</h4>
						  </div>';
	echo $data;
}
