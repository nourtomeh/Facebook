<?php

session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location:sign_in.php');
}

$servername = "localhost";
$username = "university_service";
$password = "";

// Create connection
//$conn = mysqli_connect($servername, $username, $password);
$conn = mysqli_connect($servername, "root",$password, $username,"3306");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn,"utf8");

$query = "DELETE FROM `comments` WHERE id = '".$_REQUEST['id']."'";
$result = $conn->query($query);

if ($result) {
   echo "تم حذف التعليق بنجاح";
}
else {
    echo "no user";
    header('Location: ../sign_in.php');
}

