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

// Retrieve current user ID from session
$currentUserId = $_SESSION['user_id'];

// Query to fetch pending friend requests for the current user
$friendRequestsQuery = "SELECT friendships.*, user.name, user.img FROM friendships JOIN user ON friendships.user1_id = user.id WHERE user2_id = '$currentUserId' AND status = 'pending'";
$friendRequestsResult = mysqli_query($conn, $friendRequestsQuery);

if (mysqli_num_rows($friendRequestsResult) > 0) {
    while ($row = mysqli_fetch_assoc($friendRequestsResult)) {
        echo "<div class='row' style='height: auto'>";
        echo "<a href='user_profile.php?user_id=" . $row['user1_id'] . "' class='col-3 float-start'>";
        echo "<img src='" . $row['img'] . "' alt='image' class='img-circle img-fluid'>";
        echo "</a>";
        echo "<div class='col-7' dir='rtl' style='position: relative'>";
        echo "<a href='user_profile.php?user_id=" . $row['user1_id'] . "' class='float-end'>";
        echo "<p style='color: black'>" . $row['name'] . "</p>";
        echo "</a>";
        echo "<br>";
        echo "<br>";
        echo "<button class='btn btn-success accept-friend col-5 m-1 accept-btn' data-friend-id='" . $row['user1_id'] . "'>قبول</button>";
        echo "<button class='btn btn-danger decline-friend col-5 m-1 decline-btn' data-friend-id='" . $row['user1_id'] . "'>حذف</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "";
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){


        $('.accept-btn').click(function () {
            let button = $(this);
            let userId = button.data('friend-id');

            $.ajax({
                url: 'database/friend_request.php',
                method: 'POST',
                data: { userId: userId, status: 'accepted' },
                success:function (response) {
                    button.text('أصدقاء').prop('disabled', true);
                    button.siblings('.decline-btn').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.decline-btn').click(function (){

            let button = $(this);
            let userId = button.data('friend-id');

            $.ajax({
                url:'database/friend_request.php',
                method:'POST',
                data:{userId:userId , status: 'declined'},
                success:function (response) {
                    button.after('<p>تم رفض الطلب</p>')
                    button.closest('.row').find('.decline-btn, .accept-btn').remove();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            })

        })


    });
</script>