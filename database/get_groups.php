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

$query = "SELECT * FROM `groups` 
          INNER JOIN user_groups ON groups.id = user_groups.group_id 
          WHERE user_groups.user_id = '" . $_SESSION['user_id'] . "' 
          AND (status = 'admin' OR status = 'member')";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $groups = [];
    while ($row = $result->fetch_assoc()) {
        echo '<div class="group row align-items-center mt-4 mx-3">';
        echo '<div class="col-3">';
        echo '<a href="groups_profile.php?id=' . $row["id"] . '" >';
        echo '<img class="rounded-circle" src="' . $row["img"] . '" alt="' . $row["name"] . '" style="width: 100% ; ">';
        echo '</a>';
        echo '</div>';
        echo '<div class="col-6">';
        echo '<a href="groups_profile.php?id=' . $row["id"] . '" style="color: black !important;">';
        echo '<p>' . $row["name"] . '</p>';
        echo '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    return [];

}

?>