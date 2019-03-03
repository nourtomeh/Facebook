<?php
session_start();
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

$username = $_POST['username'];
$pwd = $_POST['pwd'];



$query = "select * from  `user` where email = '".$username."' and password='".$pwd."'";


$result = $conn->query($query);

if ($result->num_rows > 0) {

    $_SESSION['user_email'] = $username;
    header('Location: ../home.php');
}
 else {
     $_SESSION['Error'] = "لا يوجد تطابق, الرجاء التأكد من صحة الايميل أو الباسوورد";

     header('Location: ../sign_in.php');
}
?>