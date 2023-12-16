<?php
include('conn.php'); //connect this page with the dataBase connection page

//Handling the errors after the user click Track
if (isset($_POST['submit'])) {
    $orderNumber = $_POST['orderNumber'];

    //check if the order number is in the DB
    $check_orderNumber = "SELECT * FROM orders WHERE id = $orderNumber";
    $result = mysqli_query($conn, $check_orderNumber);
    $num_rows = mysqli_num_rows($result);

    //check if there is an order number mach this or NOT
    if ($num_rows == 0) {
        $error = "There is No order in this number! ";
    }

    //empty number error
    if (empty($_POST['orderNumber'])) {

        $error = 'Sorry!: Enter your order number';
    }
}
