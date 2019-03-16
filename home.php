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
    </style>
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

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
    </div>


    <!-- Page Container -->

    <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">


        <!-- The Grid -->
        <div class="w3-row">
            <!-- Left Column -->
            <div class="w3-col m3 pull-right">
                <!-- Profile -->
                <div class="w3-card w3-round w3-white">

                    <div class="w3-container">
                        <h4 class="w3-center"><?php echo getdata("name") ?></h4>

                        <p class="w3-center"><img src="<?php echo getdata("img") ?>" class="w3-circle"
                                                  style="height:106px;width:106px" alt="Avatar"></p>
                        <hr>
                        <p dir="rtl"><i
                                    class="fa fa-institution fa-fw w3-margin-right w3-text-theme"></i><?php echo getdata("university") ?>
                        </p>
                        <p dir="rtl"><i
                                    class="fa fa-graduation-cap fa-fw w3-margin-right w3-text-theme"></i><?php echo getdata("major") ?>
                        </p>
                        <p dir="rtl"><i
                                    class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo getdata("age") ?>
                        </p>
                    </div>
                </div>
                <br>


                <!-- End Left Column -->
            </div>

            <!-- Middle Column -->
            <div class="w3-col m7 pull-right">

                <form name="postForm" action="database/addpost.php" method="post" accept-charset="utf-8">
                    <div class="w3-row-padding">
                        <div class="w3-col m12">
                            <div class="w3-card w3-round w3-white">
                                <div class="w3-container w3-padding">
                                    <h6 class="w3-opacity" style="text-align: right">
                                        اعلان جديد ...
                                    </h6>
                                    <textarea contenteditable="true" class="form-control w3-border w3-padding" rows="5"
                                              style="text-align: right" id="post_txt" name="post_txt"
                                              required></textarea><br>
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
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title pull-right">ارسال رسالة </h4>
                            </div>
                            <div class="modal-body">
                                <textarea id="txtMSG" name="txtMSG" class="form-control text-right" style="width: 100%"
                                          rows="5"></textarea>
                            </div>
                            <div class="modal-footer text-left">
                                <p class="text-right" id="successMSG" style="color: green;font-size: 20px;"></p>
                                <button type="button" class="btn btn-danger pull-left" id="closeModal"
                                        data-dismiss="modal">الغاء
                                </button>
                                <button type="button" class="btn btn-primary pull-left" id="sendMSG">ارسال</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Start Model -->

                <div id="myModal_coment" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-right"></h4>
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

                <!-- End Model -->
                <?php
                $post = getposts();
                foreach ($post as $item) {
                    echo '<div class="w3-container w3-card w3-white w3-round w3-margin" data-post="' . $item["post_id"] . '"><br>';
                    echo ' <img src="' . $item["img"] . '" alt="Avatar" class="w3-right w3-circle w3-margin-right" style="width:50px">';
                    echo '<span class="glyphicon glyphicon-remove delete-post pull-left" data-id="'. $item['post_id'] .'">&nbsp;</span>';
                    echo '<span class="w3-left w3-opacity">' . $item["created_at"] . '</span>';
                    echo '<h4 class="w3-right">' . $item["name"] . '</h4><br><br>';
                    echo '<hr class="w3-clear">';
                    echo '<p dir="rtl">' . $item["txt"] . '</p>';

                    echo '<button type="button" class="w3-button w3-theme-d2 w3-margin-bottom msg" data-toggle="modal" data-target="#myModal" data-ownerId="' . $item["user_id"] . '" ><i class="fa fa-envelope"></i>  ارسال رسالة للناشر</button>';
                    echo '<div class="w3-row-padding">';
                    echo '<div class="w3-col m10 pull-right">';
                    echo '<div class="w3-card w3-round w3-white">';
                    echo '<div class="w3-container w3-padding">';
                    echo ' <textarea placeholder="أكتب تعليقاً..." contenteditable="true" class="form-control w3-border w3-padding comment-text" rows="1" style="text-align: right" name="comment_text" required></textarea>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="w3-col m2 pull-right">';
                    echo '<button style="margin-top: 7px;" type="button" class="w3-button w3-theme-d2 w3-margin-bottom comment" ><i class="fa fa-comment"></i>  نعليق</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '<hr>';
                    $comment = getComments ();
                    foreach ($comment as $item2) {
                        if($item2["post_id"] == $item["post_id"]){
                            echo '<div class="col-sm-12 cmnt">';
                            echo '<div class="panel panel-default">';
                            echo '<div class="panel-heading text-right">';
                            echo '<span class="glyphicon glyphicon-remove delete-comment pull-left" data-id="'. $item2['comment_id'] .'">&nbsp;</span>';
                            echo '<span class="glyphicon glyphicon-edit edit-comment pull-left" data-id="'. $item2['comment_id'] .'" data-content="'. $item2['txt'] .'"> &nbsp;</span>';
                            echo '<span class="text-muted pull-left">15/3/2019</span>';
                            echo '<strong>'. $item2['name'] .' </strong>';
                            echo '<img src="'. $item2['img'] .'" width="25" height="25" style="border-radius: 50%;">';
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


            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>
    <br>

    <!-- Footer -->
    <footer class="w3-container w3-theme-d3 w3-padding-16">
        <h5 style="text-align: center">Footer</h5>
    </footer>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script>
        var to_msg = "";

        // Accordion
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-theme-d1";
            } else {
                x.className = x.className.replace("w3-show", "");
                x.previousElementSibling.className =
                    x.previousElementSibling.className.replace(" w3-theme-d1", "");
            }
        }

        // Used to toggle the menu on smaller screens when clicking on the menu button
        function openNav() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        $('.msg').on("click", function () {
            to_msg = $(this).attr('data-ownerId');
            //alert(to_msg)
        });

        $('.comment').on("click", function (event) {
            var btn = event.target;
            var ele = btn.closest(".w3-container.w3-card.w3-white.w3-round.w3-margin");
            var text_content = ele.getElementsByClassName('comment-text')[0];
            var post_id = ele.getAttribute("data-post");



            if(text_content.value == ""){
              alert("يجب إدخال نص للتعليق!");
              return false;
            }else{
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
                                '                            <span class="glyphicon glyphicon-remove delete-comment pull-left" data-id="">&nbsp;</span>\n' +
                                '                            <span class="glyphicon glyphicon-edit edit-comment pull-left" data-id="" data-content=""> &nbsp;</span>\n' +
                                '                            <span class="text-muted pull-left">Now</span>\n' +
                                '\n' +
                                '                            <strong>'+ data.user_name +' </strong>\n' +
                                '                            <img src="'+ data.user_img +'" width="25" height="25" style="border-radius: 50%;">\n' +
                                '\n' +
                                '                        </div>\n' +
                                '                        <div class="panel-body text-right">\n' +
                                '                            '+ text_content.value +'\n' +
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

        $('.delete-comment').on("click",function (event) {
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

        var id_newcomment;
        var ele_comment;
        $(document).on('click', '.edit-comment', function (event) {
            ele_comment = event.target
            id_newcomment = $(this).data('id');
            $('#footer_action_button').text("تعديل");
           //  $('#footer_action_button').addClass('glyphicon-check');
           // $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('تعديل');

            $('.EditContent').show();
            $('#insName').val($(this).data('content'));

            $('#myModal_coment').modal('show');
        });

        $('.modal-footer').on('click', '.edit', function () {

            newcomment = $('#insName').val();
            $.ajax({
                url: "database/editComment.php",
                type: "get",
                data: {"newcomment": newcomment,"id_newcomment":id_newcomment},
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

        $('.delete-post').on("click",function (event) {
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
                    }, 2000);


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }


            });
        })
    </script>

    <?php getposts() ?>
    </body>
    </html>

<?php
function getdata($input)
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
    $query = "select * from  `user` where email = '" . $_SESSION['user_email'] . "'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        $user_img = $row["img"];
        $user_age = $row["age"];
        $user_name = $row["name"];
        $major = $row["major"];
        $university = $row["university"];
        if ($input == "age")
            return $user_age;
        if ($input == "img")
            return $user_img;
        if ($input == "name")
            return $user_name;
        if ($input == "id")
            return $user_id;
        if ($input == "major")
            return $major;
        if ($input == "university")
            return $university;
    } else {
        header('Location: ../sign_in.php');
    }
    return "";
}

function getposts()
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
    $query = "SELECT post.id as post_id, post.txt,post.created_at,user.id as user_id, user.name,user.img FROM `post`  inner join user  ON post.user_id = user.id ORDER by post.id desc ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $post = [];
        while ($row = $result->fetch_assoc()) {
            array_push($post, ["post_id" => $row["post_id"], "txt" => $row["txt"], "created_at" => $row["created_at"], "user_id" => $row["user_id"], "name" => $row["name"], "img" => $row["img"],]);
        }
        return $post;
    } else {
        header('Location: ../sign_in.php');
    }
}


function getComments (){
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
    $query = "SELECT comments.id as comment_id, user.id as user_id , comments.* , user.* FROM `comments` left join user on comments.user_id = user.id;";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $comment = [];
        while ($row = $result->fetch_assoc()) {
            array_push($comment, ["comment_id" => $row["comment_id"], "user_id" => $row["user_id"], "created_at" => $row["created_at"], "post_id" => $row["post_id"], "name" => $row["name"], "img" => $row["img"],"txt" => $row["txt"]]);
        }
        return $comment;
    } else {
        return [];
        header('Location: ../sign_in.php');
    }
}


?>