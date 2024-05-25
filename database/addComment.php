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
$user_email = $_SESSION['user_email'];


$query = "select * from  `user` where email = '".$user_email."'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["id"];
    $user_name = $row["name"];
    $user_img = $row["img"];
}
else {
    echo "no user";
    header('Location: ../sign_in.php');
}


$date = date('Y-m-d H:i:s');
$txt = $_REQUEST['txt'];
$post_id = $_REQUEST['post_id'];

$query2 = "INSERT INTO comments(`created_at`, `post_id`, `txt`, `user_id`) VALUES('$date', '$post_id', '$txt', '$user_id')";

$result2 = mysqli_query($conn,$query2);

if($result2) {
    $info = ["user_name"=>$user_name,"user_img"=>$user_img];
    $info = json_decode(json_encode($info), true);
    echo json_encode($info);
}
else {
    echo "Failed to register";
}