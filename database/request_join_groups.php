<?php
session_start();
$servername = "localhost";
$username = "university_service";
$password = "";

// Create connection
//$conn = mysqli_connect($servername, $username, $password);
$conn = mysqli_connect($servername, "root", $password, $username, "3306");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

$groupID = $_POST["groupID"];
$userID = $_SESSION["user_id"];
$userID_fromRequest = $_POST["userID"];
$btn = $_POST["btn"];
if($btn == "join") {
    $query = "INSERT INTO user_groups (user_id, group_id , status) VALUES ($userID, $groupID, 'pending')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
}
if ($btn == "reject") {
    $query = "DELETE FROM user_groups WHERE user_id = $userID AND group_id = $groupID";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
}
if ($btn == "accept") {
    $query = "UPDATE user_groups SET status = 'member' WHERE user_id = $userID_fromRequest AND group_id = $groupID";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
}
if ($btn == "remove") {
    $query = "DELETE FROM user_groups WHERE user_id = $userID_fromRequest AND group_id = $groupID";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "success";
    } else {
        echo "failed";
    }
}

?>