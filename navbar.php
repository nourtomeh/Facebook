
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    a{
        text-decoration: none !important;
    }
    .dd{
        display: none;
    }
    #friends-list {
        position: fixed;
        top: 0;
        left: 0;
        width: 319px;
        height: 100%;
        background-color: #f1f1f1;
        overflow-y: auto;
        z-index: 999;
        margin-top: 50px;
    }
     .search-btn{
         border: 0;
         padding: 0;
         margin-left: -30px;
         background: none;
     }
    .w3-top .w3-bar-item {
       height: 50px !important;
    }
    html, body, h1, h2, h3, h4, h5 {
        font-family: "Open Sans", sans-serif
    }
</style>


<!--Navbar-->

<div class="w3-top" >
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large" >
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
           href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
        <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4" ><i
                class="fa fa-home w3-margin-right"></i>الصفحة الرئيسية</a>

        <div id="friends" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
              ><i class="fa fa-user"></i></div>

        <a href="personalinfo.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
           title="Account Settings"><i class="fa fa-gear"></i></a>

        <a href="messages.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
           title="Messages"><i class="fa fa-envelope"></i>
        </a>


        <a onclick="document.location.href = 'helper/kill_session.php';"
           class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white " title="My Account" >
            تسجيل خروج <img src="assets/uploaded/pesonal_profile.png" class="w3-circle" style="height:23px;width:23px"
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


<!--friends modal -->
<div id="friends-list" class="dd">

    <div class="search-bar">
        <div class="search-form d-flex align-items-center p-4">
            <input type="text" class="form-control" id="search-input">
            <button class="search-btn"><label for="search-input" class="fa fa-search"></label></button>
        </div>
    </div>
    <ul id="search-results">

    </ul>
</div>

<script>
$(document).ready(function(){
    $("#friends").click(function(){
        $("#friends-list").toggleClass('dd')
        if (!$('#friends-list').hasClass('dd') ) {
            loadPendingRequests();
        }
    });
    function loadPendingRequests() {
        $.ajax({
            url: "database/pending-friend-requests.php",
            type: 'GET',
            success: function (response) {
                $('#search-results').empty();
                $("#search-results").append(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    $("#search-input").on('input', function(){
        let nameOfUser = $(this).val();
       if(nameOfUser !=='') {
           $.ajax({
               url: "database/search-friends.php",
               type: 'GET',
               data: {nameOfUser: nameOfUser},
               success: function (response) {
                   $("#search-results").empty();
                   $("ul").append(response)
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   console.log(textStatus, errorThrown);
               }
           });
       }
       else
       {
loadPendingRequests()
       }

    })


});
</script>


