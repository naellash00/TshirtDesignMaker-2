<?php
// THE CONNECTION WITH DB
include('conn.php');

if (isset($_POST['submit'])) { // if user click on register submit
    $username = $_POST['username']; // $username php variable will take the 'username' value in html input code
    $email = $_POST['email']; // $email php variable will take the 'email' value in html input code
    $password = $_POST['password']; // $password php variable will take the 'password' value in html input code

    // addded these 'varaible' to escape string to protect the database from sql injection and such 
    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
    $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));


    // condition to not allow the using of the same username
    $check_user = "SELECT * FROM users WHERE username='$username'"; // DB instructions always in "double quotations"
    // check if the usernames exist in DB or not
    $check_result = mysqli_query($conn, $check_user); // what is worng with this line ?????????????????????
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) { //if there is an existing username and someone else wrote it
        // if $num_rows == 0 then the username didnt exist before, else then it already exist
        $username_error = 'this username is already taken <br>';
        $err = 1;
    }


    if (empty($username)) { // print error message if the user didnt enter username
        $username_error = 'please enter a username <br>';
        $err = 1; // adding error variable to check how many errors is there before sendig the data to the databse
    } elseif (strlen($username) < 5) { // chech that the user name isnt too short like 'a' or 'abc'
        $username_error = 'your username is too short, the minimum is 6 letters <br>';
        $err = 1;
    }
    //elseif(!filter_var($username,FILTER_VALIDATE_INT)){ // check that the username is not numbers
    // $username_error = 'please enter a valid username that dosent consist of numbers <br>';
    // $err = 1;
    //}


    if (empty($email)) {
        $email_error = 'please enter an email <br>';
        $err = 1; // adding error variable to check how many errors is there before sendig the data to the databse
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // check that the email is valid
        $email_error = 'please enter a valid email<br>';
        $err = 1;
    }


    if (empty($password)) {  // if user didnt enter a password
        $password_error = 'please enter a password <br>';
        $err = 1; // adding error variable to check how many errors is there before sendig the data to the databse
        include('register.php');
    } elseif (strlen($password) < 5) { // check the password isnt too short
        $password_error = 'please enter a longer password with minumum of 5 letters <br>';
        $err = 1;
        include('register.php'); // ??????????
    } else {
        if (($err == 0) && ($num_rows == 0)) { // if theres no errors, and no repeated username then upload the data to database
            // $sql variable to insert the data to databas
            //users is the name of the table in DB inside it the attributs of the users table
            $sql = "INSERT INTO users(username, email, password) 
             VALUES ('$username', '$email', '$password')";
            // to save the data in DB:
            mysqli_query($conn, $sql);
            // after successfuly uploading the data 
            // this header is to take the user into login page in index.php code
            header('location:index.php');
        } else { // if i didnt happen then let the data in the same page
            include('register.php');
        }
    }
}
