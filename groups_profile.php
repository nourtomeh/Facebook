<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location:sign_in.php');
}
?>

    <!DOCTYPE html>
    <html>
<title>الصفحة الرئيسية</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Open Sans", sans-serif
    }

    body {
        overflow-x: hidden;
        overflow-y: auto;
    }

</style>
<body class="w3-theme-l5">

<?php include 'navbar.php' ?>

<div class="w3-container w3-content">
    <div class="group-image-container">
        <img src="<?php echo getData("img"); ?>" style="height: 60vh" width="100%" alt="Group Image"
             class="group-image ">
    </div>

    <div class="group-info-container w3-container row mt-2" dir="rtl">
        <div class=" col-md-6 text-right">
            <h2 class="group-name ">
                <?php echo getData("name"); ?>
            </h2>
        </div>
        <div class="col-md-6 text-left mt-4">
            <?php
            if (status() == 'pending') {
                echo '<button class="btn btn-secondary reject-btn" data-group-id="' . $_GET['id'] . '" data-user-id="' . $_SESSION['user_id'] . '">إالغاء الطلب </button>';
            }
            elseif (!status())
            {
                echo '<button class="btn btn-primary join-btn" data-group-id="' . $_GET['id'] . '" data-user-id="' . $_SESSION['user_id'] . '">طلب الانضمام</button>';
            }
            ?>

        </div>

    </div>
    <hr style="opacity: 1 ; border-color: #6c757d;">

    <?php if (status() =='admin' || status() == 'member') : ?>


        <div class="w3-col m12 pull-right mt-4">
            <div class="row" dir="rtl">
                <div class="col-md-8 col-12 mt-2 order-2">
                    <form name="postForm" action="database/groups_addPost.php" method="post" accept-charset="utf-8">
                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding">
                                        <h6 class="w3-opacity" style="text-align: right">
                                            اعلان جديد ...
                                        </h6>
                                        <textarea contenteditable="true" class="form-control w3-border w3-padding"
                                                  rows="5"
                                                  style="text-align: right" id="post_txt" name="post_txt"
                                                  required></textarea><br>
                                        <input type="hidden" name="group_id" value="<?php echo $_GET['id']; ?>">
                                        <p class="text-right pull-right" style="color: green;font-size: 20px;">
                                            <?php
                                            if (isset($_SESSION['post_added'])) {
                                                echo $_SESSION['post_added'];

                                                unset($_SESSION['post_added']);

                                            }
                                            ?>
                                        </p>
                                        <button type="submit" id="btn" class="w3-button w3-theme"><i
                                                    class="fa fa-pencil"></i>
                                             نشر
                                        </button>
                                        <div id="temp"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                if (status() =='admin') {
                    echo '<div class="col-md-4 col-12 mt-2 order-1 order-md-2 ">
                <div class="card">
                    <div class="card-header text-right">
                        طلبات الانضمام
                    </div>
                    <div class="card-body" style="height: 190px; overflow-y: auto">';
                    getRequests();
                    echo '</div>
                </div>
            </div>';
                }
                ?>

            </div>

            <!--        modal for comments-->
            <div id="myModal_comment" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <form class="form-horizontal" role="form">
                                <div class="EditContent">

                                    <div class="form-group" dir="rtl">
                                        <label class="control-label col-sm-2 pull-right">التعليق:</label>
                                        <div class="col-sm-10 pull-right">
                                            <textarea class="form-control" rows="4" id="insName"></textarea>
                                        </div>
                                    </div>


                                </div>
                            </form>

                            <div class="modal-footer">
                                <button type="button" class="btn actionBtn " data-dismiss="modal">
                                    <span id="footer_action_button"> </span>
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span></span> اغلاق
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--         End Model-->

            <?php
            $post = getposts();
            foreach ($post as $item) {
                echo '<div class="w3-container w3-card w3-white w3-round w3-margin" data-post="' . $item["post_id"] . '"><br>';
                echo '<a href="user_profile.php?user_id=' . $item["user_id"] . '">';
                echo '<img src="' . $item["img"] . '" alt="Avatar" class="w3-right w3-circle w3-margin-right" style="width:50px">';
                echo '<h4 style="color: black" class="w3-right mx-3">' . $item["name"] . '</h4>';
                echo '</a>';
                if ($item["user_id"] == $_SESSION['user_id']) {
                    echo '<span class="glyphicon glyphicon-remove delete-post pull-left" data-id="' . $item['post_id'] . '">&nbsp;</span>';
                }
                echo '<span class="w3-left w3-opacity">' . $item["created_at"] . '</span>';
                echo '<br> <br> <br>';
                echo '<p  dir="rtl">' . $item["txt"] . '</p>';


                echo '<div class="w3-row-padding">';
                echo '<div class="col-12 col-md-9 pull-right">';
                echo '<div class="w3-card w3-round w3-white">';
                echo '<div class="w3-container w3-padding">';
                echo ' <textarea placeholder="أكتب تعليقاً..." contenteditable="true" class="form-control w3-border w3-padding comment-text" rows="1" style="text-align: right" name="comment_text" required></textarea>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="col-12 col-md-3 pull-right">';
                echo '<button style="margin-top: 7px;" type="button" class="w3-button w3-theme-d2 w3-margin-bottom comment" ><i class="fa fa-comment"></i>  تعليق</button>';
                echo '</div>';
                echo '</div>';
                echo '<hr>';
                $comment = getComments();
                foreach ($comment as $item2) {
                    if ($item2["post_id"] == $item["post_id"]) {
                        echo '<div class="col-sm-12 cmnt">';
                        echo '<div class="panel panel-default">';
                        echo '<div class="panel-heading text-right">';
                        if ($item2["user_id"] == $_SESSION['user_id']) {
                            echo '<span class="glyphicon glyphicon-remove delete-comment pull-left" data-id="' . $item2['comment_id'] . '">&nbsp;</span>';
                            echo '<span class="glyphicon glyphicon-edit edit-comment pull-left" data-id="' . $item2['comment_id'] . '" data-content="' . $item2['txt'] . '" data-toggle="modal" data-target="#myModal_comment"> &nbsp;</span>';
                        }
                        echo '<span class="text-muted pull-left"> ' . $item2["created_at"] . '  </span>';
                        echo '<a href="user_profile.php?user_id=' . $item2["user_id"] . '"><strong>' . $item2['name'] . ' </strong>';
                        echo '<img src="' . $item2['img'] . '" width="25" height="25" style="border-radius: 50%;"></a>';
                        echo '</div>';
                        echo '<div class="panel-body text-right">';
                        echo $item2['txt'];
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }

                echo '</div>';
            }


            ?>


            <!-- End Middle Column -->
        </div>
    <?php endif; ?>

</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {

        $(document).on("click", ".join-btn", function () {
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

        $(document).on("click", ".reject-btn", function () {
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




        $('.accept-btn').on('click', function () {
            let Btn = $(this);
            let userID = Btn.data("user-id");
            $.ajax({
                url: "database/request_join_groups.php",
                type: "post",
                data: {userID: userID, btn: "accept", groupID: <?php echo $_GET['id'] ?>},
                success: function (data) {
                    console.log(data);
                    Btn.text('تم القبول');
                    Btn.attr('disabled', true);
                    Btn.siblings('.reject-btn').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.reject-btn').on('click', function () {
            let Btn = $(this);
            let userID = Btn.data("user-id");
            $.ajax({
                url: "database/request_join_groups.php",
                type: "post",
                data: {userID: userID, btn: "remove", groupID: <?php echo $_GET['id'] ?>},
                success: function (data) {
                    console.log(data);
                    Btn.text('تم الرفض');
                    Btn.attr('disabled', true);
                    Btn.siblings('.accept-btn').hide();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        })


        $('.comment').on("click", function (event) {
            var btn = event.target;
            var ele = btn.closest(".w3-container.w3-card.w3-white.w3-round.w3-margin");
            var text_content = ele.getElementsByClassName('comment-text')[0];
            var post_id = ele.getAttribute("data-post");


            if (text_content.value == "") {
                alert("يجب إدخال نص للتعليق!");
                return false;
            } else {
                console.log(text_content.value)
                console.log(post_id)
                $.ajax({
                    url: "database/addComment.php",
                    type: "get",
                    data: {"txt": text_content.value, "post_id": post_id},
                    success: function (data) {
                        data = JSON.parse(data)
                        console.log(data)
                        $(btn).closest('.w3-container.w3-card.w3-white.w3-round.w3-margin')
                            .append('<hr>\n' +
                                '                <div class="col-sm-12">\n' +
                                '                    <div class="panel panel-default">\n' +
                                '                        <div class="panel-heading text-right">\n' +
                                '                            <span class="glyphicon glyphicon-remove delete-comment pull-left" data-id="' + data.comment_id + '">&nbsp;</span>\n' +
                                '                            <span class="glyphicon glyphicon-edit edit-comment pull-left" data-id="' + data.comment_id + '" data-content="' + text_content.value + '" data-toggle="modal" data-target="#myModal_comment"> &nbsp;</span>\n' +
                                '                            <span class="text-muted pull-left">Now</span>\n' +
                                '                            <a href="user_profile.php?user_id=' + data.user_id + '"><strong>' + data.user_name + ' </strong>' +
                                '                            <img src="' + data.user_img + '" width="25" height="25" style="border-radius: 50%;"></a>\n' +
                                '                        </div>\n' +
                                '                        <div class="panel-body text-right">\n' +
                                '                            ' + text_content.value + '\n' +
                                '                        </div><!-- /panel-body -->\n' +
                                '                    </div><!-- /panel panel-default -->\n' +
                                '                </div><!-- /col-sm-5 -->');


                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }


                });

            }

        });

        $('.delete-comment').on("click", function (event) {
            var ele = event.target;
            var id = $(this).attr('data-id');
            $.ajax({
                url: "database/deleteComment.php",
                type: "get",
                data: {"id": id},
                success: function (data) {
                    alert(data)
                    console.log(ele)
                    ele.closest('.cmnt').remove()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        });

        var ele_comment;
        var id_newcomment;
        $('.edit-comment').click(function (event) {

            ele_comment = event.target
            id_newcomment = $(this).data('id');

            $('#footer_action_button').text("تعديل");
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.EditContent').show();
            $('#insName').val($(this).data('content'));


        });

        $('.modal-footer').on('click', '.edit', function () {

            newcomment = $('#insName').val();
            $.ajax({
                url: "database/editComment.php",
                type: "get",
                data: {"newcomment": newcomment, "id_newcomment": id_newcomment},
                success: function (data) {
                    alert(data)
                    var parent = ele_comment.closest('.cmnt');
                    var cmt = parent.querySelector('.panel-body.text-right')
                    cmt.innerHTML = newcomment;

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });

        });

        $('.delete-post').on("click", function (event) {
            var ele = event.target;
            var id = $(this).attr('data-id');

            $.ajax({
                url: "database/deletepost.php",
                type: "get",
                data: {"id": id},
                success: function (data) {
                    alert(data)
                    ele.closest('.w3-container.w3-card.w3-white.w3-round.w3-margin').remove()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        })

        $('#sendMSG').on("click", function () {
            var txtMSG = $("#txtMSG").val();
            // alert(to_msg)
            // alert(txtMSG)

            $.ajax({
                url: "database/sendMSG.php",
                type: "post",
                data: {"txt": txtMSG, "to": to_msg},
                success: function (response) {
                    $("#successMSG").text("تم ارسال الرسالة بنجاح")
                    setTimeout(function () {
                        $("#successMSG").text("")
                        $("#txtMSG").val("")
                        $("#closeModal").click();
                    }, 1000);


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        })
    })
    ;
</script>

<?php getposts() ?>

</body>
<?php

function status()
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

    $query = "select `status` from `user_groups` where `user_id` = '" . $_SESSION['user_id'] . "' and `group_id` = '" . $_GET['id'] . "' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['status'];
    } else {
        return false;
    }
}

function isMember()
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

    $query = "select * from `user_groups` where `user_id` = '" . $_SESSION['user_id'] . "' and `group_id` = '" . $_GET['id'] . "' and `status` = 'member'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function getRequests()
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
    $query = "select `user`.* from `user` inner join `user_groups` on `user`.`id` = `user_groups`.`user_id` where `user_groups`.`group_id` = '" . $_GET['id'] . "'" . " and `user_groups`.`status` = 'pending'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="group row align-items-center mt-4 mx-3" dir="rtl">';
            echo '<div class="col-3">';
            echo '<a href="user_profile.php?user_id=' . $row["id"] . '">';
            echo '<img class="rounded-circle" src="' . $row["img"] . '" alt="' . $row["name"] . '" style="width: 100% ;">';
            echo '</a>';
            echo '</div>';
            echo '<div class="col-3">';
            echo '<a href="user_profile.php?user_id=' . $row["id"] . '">';
            echo '<p>' . $row["name"] . '</p>';
            echo '</a>';
            echo '</div>';
            echo '<div class="col-3 d-flex justify-content-around">';
            echo '<button class="btn btn-success mx-2 accept-btn " data-user-id="' . $row["id"] . '">قبول</button>';
            echo '<button class="btn btn-danger reject-btn " data-user-id="' . $row["id"] . '">رفض</button>';
            echo '</div>';
            echo '</div>';

        }

    }
}

function getData($input)
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

    $query = "select * from `groups` where id = '" . $_GET['id'] . "'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $group_name = $row["name"];
        $group_img = $row["img"];
        if ($input == "name")
            return $group_name;
        if ($input == "img")
            return $group_img;
    }

}

function getposts()
{
    $servername = "localhost";
    $username = "university_service";
    $password = "";

    $conn = mysqli_connect($servername, "root", $password, $username, "3306");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8");

    $group_id = $_GET['id'];
    $query = "SELECT post.id as post_id, post.txt, post.created_at, user.id as user_id, user.name, user.img 
              FROM post 
              INNER JOIN user ON post.user_id = user.id 
              WHERE post.group_id = $group_id
              ORDER BY post.id DESC";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            array_push($posts, [
                "post_id" => $row["post_id"],
                "txt" => $row["txt"],
                "created_at" => $row["created_at"],
                "user_id" => $row["user_id"],
                "name" => $row["name"],
                "img" => $row["img"]
            ]);
        }
        return $posts;
    } else {
        return [];
    }
}


function getComments()
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
    $query = "SELECT comments.id as comment_id, user.id as user_id , comments.* , user.* FROM `comments` left join user on comments.user_id = user.id;";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $comment = [];
        while ($row = $result->fetch_assoc()) {
            array_push($comment, ["comment_id" => $row["comment_id"], "user_id" => $row["user_id"], "created_at" => $row["created_at"], "post_id" => $row["post_id"], "name" => $row["name"], "img" => $row["img"], "txt" => $row["txt"]]);
        }
        return $comment;
    } else {
        return [];
        header('Location: ../sign_in.php');
    }
}

?>