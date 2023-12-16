<?php
// to open new session
session_start();
// connect this page with the DB
include('conn.php');
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $username = filter_input(INPUT_POST, 'username');

    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        session_start();
        $_SESSION["user_id"] = $row['id'];
        header("Location:../payment-code/index.php");
    } else {
        echo '<script>alert("Username or Password is incorrect!");</script>';
        $error_login = 'Username or Password is incorrect!';
    }
}

//
if (empty($username)) { // print error message if the user didnt enter username
    $username_error = 'please enter a username <br>';
    $err = 1; // adding error variable to check how many errors is there before sendig the data to the databse
}

if (empty($password)) {  // if user didnt enter a password
    $password_error = 'please enter a password <br>';
    $err = 1; // adding error variable to check how many errors is there before sendig the data to the databse
    include('index.php'); // ?????????????????? after entering username and password go to index page
    // but this will take the user to index.php even if the username is empty (because the include is added with password condition)

} else {
    include('index.php'); // how to fix the above error 
}
