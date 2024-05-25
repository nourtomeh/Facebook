<?php
session_start();
print_r($_SESSION);
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
$groupName = $_POST['group_name'];
$userID = $_SESSION['user_id'];
$groupImg='img/group-default img.jpg';


$query = "INSERT INTO `groups` ( `name`, `img`) VALUES ( '$groupName', '$groupImg')";
$result = mysqli_query($conn,$query);
if ($result) {
    // Retrieve the ID of the newly inserted group
    $groupID = mysqli_insert_id($conn);

    // Insert a record into the user_groups table
    $query2 = "INSERT INTO `user_groups` (`user_id`, `group_id`, `status`) VALUES ('$userID', '$groupID', 'admin')";
    $result2 = mysqli_query($conn, $query2);
    if ($result2) {
        header('Location: ../groups_profile.php?id=' . $groupID);
    } else {
        echo "Failed to insert into user_groups table";
    }
} else {
    echo "Failed to insert into groups table";
}
?>