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

// Check if 'nameOfUser' parameter is provided in the URL
if (isset($_GET['nameOfUser'])) {
    $nameOfUser = $_GET['nameOfUser'];

    $query = "SELECT * FROM `user` WHERE name LIKE '%$nameOfUser%'";
    $result = mysqli_query($conn, $query);
    $currentUserId = $_SESSION['user_id'];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['id'];
            $currentUserId = $_SESSION['user_id'];
            if ($userId == $currentUserId) {
                echo "<div class='row' style='height: auto'>";
                echo "<a href='user_profile.php?user_id=$userId' class='col-3 float-start'>";
                echo "<img src='" . $row['img'] . "' alt='image' class='img-circle img-fluid'>";
                echo "</a>";
                echo "<div class='col-7' dir='rtl' style='position: relative'>";
                echo "<a href='user_profile.php?user_id=$userId' class='float-end' style='color: black;'>";
                echo "<p>" . $row['name'] . "</p>";
                echo "</a>";
                echo "<br>";
                echo "<p class='h4'>أنت</p>";
                echo "</div>";
                echo "</div>";
            }
            else {
                $friendshipQuery = "SELECT status, user1_id, user2_id FROM friendships WHERE (user1_id = $currentUserId AND user2_id = $userId) OR (user1_id = $userId AND user2_id = $currentUserId)";
                $friendshipResult = mysqli_query($conn, $friendshipQuery);

                if (mysqli_num_rows($friendshipResult) > 0) {
                    $friendshipRow = mysqli_fetch_assoc($friendshipResult);
                    $friendshipStatus = $friendshipRow['status'];
                    $user1Id = $friendshipRow['user1_id'];
                    $user2Id = $friendshipRow['user2_id'];
                    if ($friendshipStatus == 'accepted') {
                        echo "<div class='row' style='height: auto'>";
                        echo "<a href='user_profile.php?user_id=$userId' class='col-3 float-start'>";
                        echo "<img src='" . $row['img'] . "' alt='image' class='img-circle img-fluid'>";
                        echo "</a>";
                        echo "<div class='col-7' dir='rtl' style='position: relative'>";
                        echo "<a href='user_profile.php?user_id=$userId' class='float-end' style='color: black;'>";
                        echo "<p>" . $row['name'] . "</p>";
                        echo "</a>";
                        echo "<br>";
                        echo "<br>";
                        echo "<button class='btn btn-success ' disabled>اصدقاء</button>";
                        echo "</div>";
                        echo "</div>";
                    } elseif ($friendshipStatus == 'pending' && $currentUserId == $user2Id) {
                        echo "<div class='row' style='height: auto'>";
                        echo "<a href='user_profile.php?user_id=$userId' class='col-3 float-start'>";
                        echo "<img src='" . $row['img'] . "' alt='image' class='img-circle img-fluid'>";
                        echo "</a>";
                        echo "<div class='col-7' dir='rtl' style='position: relative'>";
                        echo "<a href='user_profile.php?user_id=$userId' class='float-end' style='color: black;'>";
                        echo "<p>" . $row['name'] . "</p>";
                        echo "</a>";
                        echo "<br>";
                        echo "<br>";
                        echo "<button class='btn btn-success accept-friend col-5 m-1 accept-btn' data-friend-id='$userId'>قبول</button>";
                        echo "<button class='btn btn-danger decline-friend col-5 m-1 decline-btn' data-friend-id='$userId'>حذف</button>";
                        echo "</div>";
                        echo "</div>";
                    } elseif ($friendshipStatus == 'pending' && $currentUserId == $user1Id) {
                        echo "<div class='row' style='height: auto'>";
                        echo "<a href='user_profile.php?user_id=$userId' class='col-3 float-start'>";
                        echo "<img src='" . $row['img'] . "' alt='image' class='img-circle img-fluid'>";
                        echo "</a>";
                        echo "<div class='col-7' dir='rtl' style='position: relative'>";
                        echo "<a href='user_profile.php?user_id=$userId' class='float-end' style='color: black;'>";
                        echo "<p>" . $row['name'] . "</p>";
                        echo "</a>";
                        echo "<br>";
                        echo "<br>";
                        echo "<button class='btn btn-primary'>تم ارسال طلب صداقة</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='row' style='height: auto'>";
                    echo "<a href='user_profile.php?user_id=$userId' class='col-3 float-start'>";
                    echo "<img src='" . $row['img'] . "' alt='image' class='img-circle img-fluid'>";
                    echo "</a>";
                    echo "<div class='col-7' dir='rtl' style='position: relative'>";
                    echo "<a href='user_profile.php?user_id=$userId' class='float-end' style='color: black;'>";
                    echo "<p>" . $row['name'] . "</p>";
                    echo "</a>";
                    echo "<br>";
                    echo "<br>";
                    echo "<button class='btn btn-primary add-friend' data-user-id='" . $row['id'] . "'>إضافة صديق</button>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }
    }
    else {
        echo "";
    }

}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.add-friend').click(function () {
            let button = $(this);
            let userId = button.data('user-id');

            $.ajax({
                url: 'database/friend_request.php',
                method: 'POST',
                data: {userId: userId},
                success: function (response) {
                    button.text('تم ارسال طلب صداقة')
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.accept-btn').click(function () {
            let button = $(this);
            let userId = button.data('friend-id');

            $.ajax({
                url: 'database/friend_request.php',
                method: 'POST',
                data: {userId: userId, status: 'accepted'},
                success: function (response) {
                    button.text('أصدقاء').prop('disabled', true);
                    button.siblings('.decline-btn').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.decline-btn').click(function () {

            let button = $(this);
            let userId = button.data('friend-id');

            $.ajax({
                url: 'database/friend_request.php',
                method: 'POST',
                data: {userId: userId, status: 'declined'},
                success: function (response) {
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
