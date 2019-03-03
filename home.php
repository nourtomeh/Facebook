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
        <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="News"><i class="fa fa-globe"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
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
                    <h4 class="w3-center">My Profile</h4>

                    <p class="w3-center"><img src="assets/uploaded/pesonal_profile.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                    <hr>
                    <p dir="rtl"><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> هندسة حاسوب</p>
                    <p dir="rtl"><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> الرياض</p>
                    <p dir="rtl"><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> 28-5-1998</p>
                </div>
            </div>
            <br>


            <!-- End Left Column -->
        </div>

        <!-- Middle Column -->
        <div class="w3-col m7 pull-right">

            <div class="w3-row-padding">
                <div class="w3-col m12">
                    <div class="w3-card w3-round w3-white">
                        <div class="w3-container w3-padding">
                            <h6 dir="rtl" class="w3-opacity">انشر اعلان جديد ....</h6>
                            <p dir="rtl" contenteditable="false" class="w3-border w3-padding">يوجد لدي ...</p>
                            <button type="button" class="w3-button w3-theme"><i class="fa fa-pencil"></i>  Post</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <img src="assets/uploaded/pesonal_profile.png" alt="Avatar" class="w3-right w3-circle w3-margin-right" style="width:50px">
                <span class="w3-left w3-opacity">16 min</span>
                <h4 class="w3-right">محمد الشيخ</h4><br><br>
                <hr class="w3-clear">
                <p dir="rtl"> انا طالب من جامعة سطام فرع الرياض , أود أن أعرض كتاب جافا للبيع بقيمة 1000 ريال, المعني التواصل معي عن طريق التعليقات او ارسال رسالة على الخاص . مع الشكر والاحترام</p>
                <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  نعليق</button>
                <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-envelope"></i>  ارسال رسالة للناشر</button>
            </div>

            <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <img src="assets/uploaded/pesonal_profile.png" alt="Avatar" class="w3-right w3-circle w3-margin-right" style="width:50px">
                <span class="w3-left w3-opacity">28 min</span>
                <h4 class="w3-right">لين علي</h4><br><br>
                <hr class="w3-clear">
                <p dir="rtl"> انا طالبة من جامعة سطام فرع جدة , أود أن أقدم كورس في مادة الخوارزميات في كل يوم سبت , المعني التواصل معي عن طريق التعليقات او ارسال رسالة على الخاص . مع الشكر والاحترام</p>
                <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  نعليق</button>
                <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-envelope"></i>  ارسال رسالة للناشر</button>
            </div>

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

</body>
</html>
