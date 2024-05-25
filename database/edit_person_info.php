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

$user_email = $_SESSION['user_email'];
$age = $_POST['age'];
$major = $_POST['major'];
$university = $_POST['university'];
$name = $_POST['name'];
$img = getImage();
if ($img == "img/")
    $query = "UPDATE `user` SET `age`='" . $age . "',`major`='" . $major . "',`university`='" . $university . "',`name`='" . $name . "' WHERE email = '" . $user_email . "'";

else
    $query = "UPDATE `user` SET `age`='" . $age . "',`img`='" . $img . "',`major`='" . $major . "',`university`='" . $university . "',`name`='" . $name . "' WHERE email = '" . $user_email . "'";

$result = $conn->query($query);
$_SESSION['success'] = "تم تعديل المعلومات الشخصية بنجاح";

header('Location: ../personalinfo.php');


function getImage()
{
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    return "img/" . basename($_FILES["fileToUpload"]["name"]);
}