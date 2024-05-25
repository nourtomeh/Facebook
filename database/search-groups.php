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
if (isset($_GET['nameOfGroup'])) {
    $nameOfGroup = $_GET['nameOfGroup'];
    $query = "SELECT groups.*, user_groups.status AS user_status FROM `groups` LEFT JOIN user_groups ON groups.id = user_groups.group_id AND user_groups.user_id = '" . $_SESSION['user_id'] . "' WHERE groups.name LIKE '%" . $nameOfGroup . "%'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="group row align-items-center mt-4 mx-3">';
            echo '<div class="col-3">';
            echo '<a href="groups_profile.php?id=' . $row["id"] . '">';
            echo '<img class="rounded-circle" src="' . $row["img"] . '" alt="' . $row["name"] . '" style="width: 100% ;">';
            echo '</a>';
            echo '</div>';
            echo '<div class="col-6">';
            echo '<a href="groups_profile.php?id=' . $row["id"] . '">';
            echo '<p>' . $row["name"] . '</p>';
            echo '</a>';
            echo '</div>';
            echo '<div class="col-2">';
            if (!$row['user_status'] == 'admin' && !$row['user_status'] == 'member') {
                echo '<button class="btn btn-primary btn-join" data-group-id="' . $row["id"] . '">طلب الانضمام</button>';
            }
            else if($row['user_status'] == 'pending'){
                echo '<button class="btn btn-secondary btn-reject" data-group-id="' . $row["id"] . '">الغاء الطلب</button>';

            }
            echo '</div>';
            echo '</div>';

        }
    } else {
        return [];
    }

}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on("click", ".btn-join", function () {
            let groupID = $(this).data("group-id");
            $.ajax({
                url: "database/request_join_groups.php",
                method: "POST",
                data: {groupID: groupID , btn : 'join'},
                success: function (data) {
                    $(this).text("تم ارسال الطلب");
                    $(this).attr("disabled", true);
                }.bind(this),
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $(document).on("click", ".btn-reject", function () {
            let groupID = $(this).data("group-id");
            $.ajax({
                url: "database/request_join_groups.php",
                method: "POST",
                data: {groupID: groupID , btn : 'reject'},
                success: function (data) {
                    $(this).text("تم الغاء الطلب");
                    $(this).attr("disabled", true);
                }.bind(this),
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });

</script>
