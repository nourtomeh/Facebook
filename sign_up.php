<?php
session_start();
?>
<!doctype html>
<html class="fixed">
	<head>
		<title>انشاء حساب جديد</title>
		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
		<meta charset="UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">





		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"> انشاء حساب جديد&nbsp;&nbsp;<i class="fa fa-user mr-xs"></i></h2>
					</div>
					<div class="panel-body">
						<form name="loginForm" action="database/register.php" method="post" accept-charset="utf-8" onsubmit="return validateForm()">
							<div class="form-group mb-lg">
								<label class="pull-right">الاسم</label>
								<input  name="name" type="text" class="form-control input-lg text-right" placeholder="ادخل الاسم" required/>
							</div>

							<div class="form-group mb-lg">
								<label class="pull-right">العمر</label>
								<input  name="age" type="text" class="form-control input-lg text-right" placeholder="ادخل العمر" required/>
							</div>

							<div class="form-group mb-lg">
								<label class="pull-right">عنوان البريد الالكتروني</label>
								<input name="email" type="email" class="form-control input-lg" placeholder="example@company.com" required/>
							</div>

							<div class="form-group mb-none">
								<div class="row">
									<div class="col-sm-6 mb-lg">
										<label class="pull-right">اعادة الرقم السري</label>
										<input name="pwd" type="password" class="form-control input-lg" required/>
									</div>
									<div class="col-sm-6 mb-lg">
										<label class="pull-right">الرقم السري</label>
										<input name="pwd_confirm" type="password" class="form-control input-lg" required />
									</div>
								</div>
							</div>
                            <p class="text-right" style="color: red">
                                <?php
                                if( isset($_SESSION['Error']) )
                                {
                                    echo $_SESSION['Error'];

                                    unset($_SESSION['Error']);

                                }
                                ?>
                            </p>
							<div class="row">

								<div class="col-sm-4 text-left">
									<button type="submit" class="btn btn-primary hidden-xs">تسجيل الحساب</button>
								</div>
							</div>



							<p class="text-center">لديك حساب ؟ <a href="sign_in.php">تسجيل الدخول</a>

						</form>
					</div>
				</div>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>
<script>
    function validateForm() {
        var pass = document.forms["loginForm"]["pwd"].value;
        var pass_confirm = document.forms["loginForm"]["pwd_confirm"].value;
        if (pass != pass_confirm) {
            alert("الرقم السري غير متطابق, الرجاء إعادة التطابق");
            return false;
        }
    }

</script>