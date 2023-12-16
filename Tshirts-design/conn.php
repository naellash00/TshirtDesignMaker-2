<?php
// اتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tshirtdesignmaker";

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'tshirtdesignmaker');

// فحص الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
