<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location:sign_in.php');
}

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


$user_email = $_SESSION['user_email'];
$query = "select id from  `user` where email = '".$user_email."'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["id"];
}
else {
    header('Location: ../sign_in.php');
}

$txt = $_POST['post_txt'];
$date = date('Y-m-d H:i:s');

$query2 = "INSERT INTO post(`txt`, `created_at`, `user_id`) VALUES('$txt', '$date', '$user_id')";
$result2 = mysqli_query($conn,$query2);
if($result) {
    $_SESSION['post_added'] = "تم اضافة البوست بنجاح";

    header('Location: ../home.php');
}
else {
    echo "Failed to register";
}
