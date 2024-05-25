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

$query = "select id from  `user` where email = '".$user_email."'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["id"];
}
else {
    echo "no user";
    header('Location: ../sign_in.php');
}


$to = $_REQUEST['to_id'];

$query2 = "SELECT * 
FROM (
    SELECT * 
    FROM `messages` 
    WHERE (from_id = '$user_id' AND to_id = '$to') 
       OR (from_id = '$to' AND to_id = '$user_id') 
    ORDER BY id ASC
) tmp 
INNER JOIN user 
    ON tmp.from_id = user.id
";

$result2 = mysqli_query($conn,$query2);

if($result2->num_rows > 0) {

    $msgs = [];
    while ($row = $result2->fetch_assoc()) {
        array_push($msgs, ["from_id" => $row["from_id"],"to_id" => $row["to_id"], "txt" => $row["txt"], "created_at" => $row["created_at"], "img" => $row["img"]]);
    }
    $msgs = json_decode(json_encode($msgs), true);
    echo json_encode($msgs);
}
else {
    return [];

    echo "Failed to register";
}