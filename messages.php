<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location:sign_in.php');
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
          rel="stylesheet">
    <link href="assets/stylesheets/messages.css" type="text/css" rel="stylesheet">

</head>
<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Open Sans", sans-serif !important
    }

    .fa-times {
        position: fixed;
    }

    @media only screen and (max-width: 1000px) {
        .image {
            max-width: 130%;
            border-radius: 50%
        }
    }
    @media only screen and (max-width: 768px) {
        .image {
            max-width: 100%;
            border-radius: 50%
        }
    }
    @media only screen and (max-width: 768px) {
        .msgimg {
            max-width: 130%;
            border-radius: 50%
        }
    }
</style>
<body class="w3-theme-l5">

<?php include 'navbar.php' ?>

<br>
<br>
<br>
<br>
<div class="container-fluid">

    <div class="messaging">
        <div class="inbox_msg">

            <div class="mesgs">
                <div class="msg_history">

                </div>
                <div class="type_msg w3-hide">
                    <div class="input_msg_write" dir="rtl">
                        <button id="AddNewMsg" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                                                                     aria-hidden="true"></i></button>
                        <input type="text" id="msgtxt" class="write_msg text-right" placeholder="اكتب الرسالة هنا"/>
                    </div>
                </div>
            </div>
            <div class="inbox_people float-end ">
                <div class="headind_srch">
                    <div>
                        <h4 class="text-right pull-right">اخر الرسائل</h4>
                    </div>
                </div>

                <div class="inbox_chat" style="cursor: pointer">
                    <?php
                    $friends = getListMSG();

                    foreach ($friends as $item) {

                        echo '<div class="chat_list active_chat col-12 " data-toid="' . $item['user_id'] . '">';
                        echo '<div class="chat_people ">';
                        echo '<div class="chat_ib text-right col-md-6 col-12 d-md-block d-none mt-2 ">';
                        echo '<h5>' . $item["name"] . '</h5>';
                        echo '</div>';
                        echo '<div class="chat_img col-md-5 col-12  "><img class="image" src="' . $item["img"] . '" alt="sunil"></div>';
                        echo ' </div>';
                        echo ' </div>';
                    }

                    ?>
                </div>

            </div>
        </div>


    </div>
</div>
</body>
</html>

<script>
    $(document).ready(function () {

        function scrollToBottom() {
            $(".msg_history").animate({scrollTop: $(".msg_history")[0].scrollHeight}, "100");
        }

        $(document).on("click", ".fa-times", function () {
            $(".msg_history").empty();
            $(".type_msg").addClass("w3-hide");


        });

        var to_id = 0;
        $(".chat_list.active_chat").on("click", function () {
            to_id = $(this).attr('data-toid');
            $(".msg_history").empty();
            $(".type_msg").removeClass("w3-hide");
            $(".msg_history").append(' <span class="fa fa-times "></span>')

            $.ajax({
                url: "database/getMSGS.php",
                type: "get",
                data: {"to_id": to_id},
                success: function (data) {
                    data = JSON.parse(data)
                    console.log(data)

                    $(".msg_history").append(' <span class="fa fa-times "></span>')
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].to_id === to_id) {

                            $(".msg_history").append('<h1><div class="outgoing_msg ">\n' +
                                '                        <div class="sent_msg">\n' +
                                '                            <p class="text-right">' + data[i].txt + '</p>\n' +
                                '                            <span class="time_date">' + data[i].created_at + '</span></div>\n' +
                                '                    </div></h1>')

                        } else {
                            $(".msg_history").append('    <div class="incoming_msg" style="margin: 20px">\n' +
                                '                        <div class="incoming_msg_img"><img class="image msgimg" src="' + data[i].img + '"\n' +
                                '                                                           alt="sunil"></div>\n' +
                                '                        <div class="received_msg">\n' +
                                '                            <div class="received_withd_msg">\n' +
                                '                                <p class="text-right">' + data[i].txt + '</p>\n' +
                                '                                <span class="time_date">' + data[i].created_at + '</span></div>\n' +
                                '                        </div>\n' +
                                '                    </div>')
                        }

                    }
                    scrollToBottom();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        })


        $("#AddNewMsg").on("click", function () {
            var txt = $("#msgtxt").val();
            if (txt) {
                $.ajax({
                    url: "database/AddNewMsg.php",
                    type: "get",
                    data: {"to_id": to_id, "txt": txt},
                    success: function (data) {
                        $(".msg_history").append('<h1><div class="outgoing_msg">\n' +
                            '                        <div class="sent_msg">\n' +
                            '                            <p class="text-right">' + txt + '</p>\n' +
                            '                            <span class="time_date"> now </span></div>\n' +
                            '                    </div></h1>')
                        $("#msgtxt").val("")
                        scrollToBottom();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }


                });
            }
        })
    })
</script>

<?php
function getListMSG()
{
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
    $queryid = "select * from  `user` where email = '" . $_SESSION['user_email'] . "'";
    $resultid = $conn->query($queryid);
    $user_id = "";
    if ($resultid->num_rows > 0) {
        $row = $resultid->fetch_assoc();
        $user_id = $row["id"];
    } else {
        header('Location: ../sign_in.php');
    }


//        $query = "select messages.id as msg_id,messages.created_at,messages.txt,user.* from messages inner join user on messages.to_id = user.id  where messages.from_id = " . $user_id . "  GROUP by messages.to_id ORDER BY messages.created_at DESC";
    $query = "SELECT user.id, user.name, user.email, user.img, MAX(messages.created_at) AS latest_message_time
FROM user
INNER JOIN friendships ON ((friendships.user1_id = user.id AND friendships.user2_id = $user_id) OR (friendships.user2_id = user.id AND friendships.user1_id = $user_id))
LEFT JOIN messages ON ((messages.to_id = user.id AND messages.from_id = $user_id) OR (messages.from_id = user.id AND messages.to_id = $user_id))
WHERE friendships.status = 'accepted'
GROUP BY user.id, user.name, user.email, user.img
ORDER BY latest_message_time DESC";


    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $friends = [];
        while ($row = $result->fetch_assoc()) {
            array_push($friends, ["user_id" => $row["id"], "name" => $row["name"], "img" => $row["img"]]);
        }
        return $friends;
    } else {
        return [];
        header('Location: ../sign_in.php');
    }
}

?>

