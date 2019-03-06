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
    html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">
<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
        <a href="personalinfo.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>

        <a  onclick="document.location.href = 'helper/kill_session.php';" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
            Logout  <img src="assets/uploaded/pesonal_profile.png" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
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

                    <p class="w3-center"><img src="<?php echo getdata("img") ?>" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                    <hr>
                    <p dir="rtl"><i class="fa fa-institution fa-fw w3-margin-right w3-text-theme"></i><?php echo getdata("university") ?></p>
                    <p dir="rtl"><i class="fa fa-graduation-cap fa-fw w3-margin-right w3-text-theme"></i><?php echo getdata("major") ?></p>
                    <p dir="rtl"><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> <?php echo getdata("age") ?></p>
                </div>
            </div>
            <br>


            <!-- End Left Column -->
        </div>

        <!-- Middle Column -->
        <div class="w3-col m7 pull-right">

            <form name="postForm" action="database/addpost.php" method="post" accept-charset="utf-8" >
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
                                if( isset($_SESSION['post_added']) )
                                {
                                    echo $_SESSION['post_added'];

                                    unset($_SESSION['post_added']);

                                }
                                ?>
                            </p>
                            <button type="submit" id="btn" class="w3-button w3-theme"><i class="fa fa-pencil"></i>
                                 نشر
                            </button>
                            <div id="temp"></div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <?php
            $post = getposts();
            foreach ($post as $item){
                echo '<div class="w3-container w3-card w3-white w3-round w3-margin"><br>';
                echo ' <img src="'. $item["img"] .'" alt="Avatar" class="w3-right w3-circle w3-margin-right" style="width:50px">';
                echo '<span class="w3-left w3-opacity">'. $item["created_at"] .'</span>';
                echo '<h4 class="w3-right">'. $item["name"] .'</h4><br><br>';
                echo '<hr class="w3-clear">';
                echo '<p dir="rtl">'. $item["txt"] .'</p>';
                echo '<button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  نعليق</button>';
                echo '<button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-envelope"></i>  ارسال رسالة للناشر</button>';
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
<footer class="w3-container w3-theme-d3 w3-padding-16" >
    <h5 style="text-align: center">Footer</h5>
</footer>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script>
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
</script>

<?php getposts() ?>
</body>
</html>

<?php
function getdata($input){
    $servername = "localhost";
    $username = "university_service";
    $password = "root";

// Create connection
//$conn = mysqli_connect($servername, $username, $password);
    $conn = mysqli_connect($servername, "root",$password, $username,"3306");
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn,"utf8");
    $query = "select * from  `user` where email = '".$_SESSION['user_email']."'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        $user_img = $row["img"];
        $user_age = $row["age"];
        $user_name = $row["name"];
        $major = $row["major"];
        $university = $row["university"];
        if($input == "age")
            return $user_age;
        if($input == "img")
            return $user_img;
        if($input == "name")
            return $user_name;
        if($input == "id")
            return $user_id;
        if($input == "major")
            return $major;
        if($input == "university")
            return $university;
    }
    else {
        header('Location: ../sign_in.php');
    }
    return "";
}

function getposts(){
    $servername = "localhost";
    $username = "university_service";
    $password = "root";

// Create connection
//$conn = mysqli_connect($servername, $username, $password);
    $conn = mysqli_connect($servername, "root",$password, $username,"3306");
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn,"utf8");
    $query = "SELECT post.id as post_id, post.txt,post.created_at,user.id as user_id, user.name,user.img FROM `post`  inner join user  ON post.user_id = user.id ORDER by post.id desc ";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $post=[];
        while($row = $result->fetch_assoc()) {
            array_push($post, ["post_id"=>$row["post_id"],"txt"=>$row["txt"],"created_at"=>$row["created_at"],"user_id"=>$row["user_id"],"name"=>$row["name"],"img"=>$row["img"],]);
        }
        return $post;
    }
    else {
        header('Location: ../sign_in.php');
    }
}

?>