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
<body class="w3-theme-l5">
<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
           href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i
                    class="fa fa-home w3-margin-right"></i>Logo</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i
                    class="fa fa-globe"></i></a>
        <a href="personalinfo.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
           title="Account Settings"><i class="fa fa-user"></i></a>
        <a href="messages.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
           title="Messages"><i class="fa fa-envelope"></i>
            <sub style="color: red">5</sub>
        </a>


        <a onclick="document.location.href = 'helper/kill_session.php';"
           class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            Logout <img src="assets/uploaded/pesonal_profile.png" class="w3-circle" style="height:23px;width:23px"
                        alt="Avatar">
        </a>
    </div>
</div>
<br>
<br>
<br>
<br>
<div class="container pull-right">

    <div class="messaging">
        <div class="inbox_msg">

            <div class="mesgs">
                <div class="msg_history">

                </div>
                <div class="type_msg">
                    <div class="input_msg_write" dir="rtl">
                        <button id="AddNewMsg" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                                                      aria-hidden="true"></i></button>
                        <input type="text" id="msgtxt" class="write_msg text-right" placeholder="اكتب الرسالة هنا"/>
                    </div>
                </div>
            </div>
            <div class="inbox_people">
                <div class="headind_srch">
                    <div >
                        <h4 class="text-right pull-right">اخر الرسائل</h4>
                    </div>
                </div>

                <div class="inbox_chat">
                <?php
                $msgs  = getListMSG();

                foreach ($msgs as $item) {

                    echo '<div class="chat_list active_chat" data-msgid = "'. $item['msg_id'] .'" data-toid="'. $item['user_id'] .'"><i></i>';
                    echo '<div class="chat_people">';
                    echo '<div class="chat_ib text-right">';
                    echo '<span class="chat_date pull-left">'. $item["created_at"] .'</span>';
                    echo '<h5>'. $item["name"] .'</h5>';
                    echo '<p>'. $item["txt"] .'</p>';
                    echo '</div>';
                    echo '<div class="chat_img"><img src="'. $item["img"] .'" alt="sunil"></div>';
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
        var to_id = 0 ;
        $(".chat_list.active_chat").on("click",function () {
             to_id = $(this).attr('data-toid');

            $.ajax({
                url: "database/getMSGS.php",
                type: "get",
                data: {"to_id":to_id} ,
                success: function (data) {
                    data = JSON.parse(data)
                    console.log(data)

                    $(".msg_history").empty();

                    for(var i=0;i<data.length;i++){
                        if(data[i].to_id === to_id){

                            $(".msg_history").append('<h1><div class="outgoing_msg">\n' +
                                '                        <div class="sent_msg">\n' +
                                '                            <p class="text-right">'+ data[i].txt +'</p>\n' +
                                '                            <span class="time_date">'+ data[i].created_at +'</span></div>\n' +
                                '                    </div></h1>')

                        }else{
                            $(".msg_history").append('    <div class="incoming_msg">\n' +
                                '                        <div class="incoming_msg_img"><img src="'+ data[i].img +'"\n' +
                                '                                                           alt="sunil"></div>\n' +
                                '                        <div class="received_msg">\n' +
                                '                            <div class="received_withd_msg">\n' +
                                '                                <p class="text-right">'+ data[i].txt +'</p>\n' +
                                '                                <span class="time_date">'+ data[i].created_at +'</span></div>\n' +
                                '                        </div>\n' +
                                '                    </div>')
                        }

                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        })

        $("#AddNewMsg").on("click",function () {
            var txt = $("#msgtxt").val();
            if(txt){
                $.ajax({
                    url: "database/AddNewMsg.php",
                    type: "get",
                    data: {"to_id":to_id,"txt":txt} ,
                    success: function (data) {
                        $(".msg_history").append('<h1><div class="outgoing_msg">\n' +
                            '                        <div class="sent_msg">\n' +
                            '                            <p class="text-right">'+ txt +'</p>\n' +
                            '                            <span class="time_date"> now </span></div>\n' +
                            '                    </div></h1>')
                        $("#msgtxt").val("")
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
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
        $password = "root";

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


        $query = "select messages.id as msg_id,messages.created_at,messages.txt,user.* from messages inner join user on messages.to_id = user.id where messages.from_id = " . $user_id . " GROUP by messages.to_id ORDER BY created_at desc";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $msgs = [];
            while ($row = $result->fetch_assoc()) {
                array_push($msgs, ["msg_id" => $row["msg_id"], "txt" => $row["txt"], "created_at" => $row["created_at"], "user_id" => $row["id"], "name" => $row["name"], "img" => $row["img"]]);
            }
            return $msgs;
        } else {
            return [];
            header('Location: ../sign_in.php');
        }
    }

?>

