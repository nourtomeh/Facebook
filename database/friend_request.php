<?php

session_start();
$servername = "localhost";
$username = "university_service";
$password = "";

// Create connection
$conn = mysqli_connect($servername, "root", $password, $username, "3306");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

if(isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $currentUserId = $_SESSION['user_id'];
    $status = $_POST['status'];

    if ($status == 'accepted') {
        $updateQuery = "UPDATE friendships SET status = 'accepted' WHERE user1_id = '$userId' AND user2_id = '$currentUserId'";
        if (mysqli_query($conn, $updateQuery)) {
            echo "Friend request accepted successfully!";
        } else {
            echo "Error accepting friend request: " . mysqli_error($conn);
        }
    }
    else if ($status =='declined'){
        $deleteQuery = "DELETE from friendships where user1_id = '$userId' AND  user2_id = '$currentUserId'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Friend request declined successfully!";
        } else {
            echo "Error declining friend request: " . mysqli_error($conn);
        }
    }
    else if($status =='remove')
    {
        $deleteQuery = "DELETE from friendships where (user1_id = '$userId' AND  user2_id = '$currentUserId') OR (user1_id = '$currentUserId' AND  user2_id = '$userId')";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "Friend removed successfully!";
        } else {
            echo "Error removing friend: " . mysqli_error($conn);
        }
    }
    else {
        $insertQuery = "INSERT INTO friendships (user1_id, user2_id, status) VALUES ('$currentUserId', '$userId', 'pending')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Friend request sent successfully!";
        } else {
            echo "Error sending friend request: " . mysqli_error($conn);
        }
    }
}else {
    echo "Error: userId is not set in the POST array.";
}

?>
