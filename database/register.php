<?php
session_start();
$servername = "localhost";
$username = "university_service";
$password = "root";

// Create connection
//$conn = mysqli_connect($servername, $username, $password);
$conn = mysqli_connect($servername, "root",$password, $username,"3306");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn,"utf8");

$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];



$query = "INSERT INTO user(`name`, `email`, `password`, `age`) VALUES('$name', '$email', '$pwd', '$age')";
$result = mysqli_query($conn,$query);
if($result) {
    session_start();
    $_SESSION['user_email'] = $email;
    echo "Succesfully registered";
    header('Location: ../home.php');
}
else {
    $_SESSION['Error'] = "حدث خطأ في تسجيل الحساب , يرجى التأكد من أن الايميل ليس مسجل مسبقا";
    header('Location: ../sign_up.php');
}

?>