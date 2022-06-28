<?php
session_start();
include_once '../Controller/userController.php';
if(!$_SESSION["login"] or !isset($_SESSION["login"]))
    header("location: login.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Moje Konto</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-title">
						Moje Konto
					</span>

                    <label for="userName">userName</label><br>
                    <div class="wrap-input100 validate-input" data-validate = "Nazwa użytkownika jest obowiązkowa">

                        <input class="input100" type="text" name="userName" placeholder="Nazwa użytkownika" value="<?php echo  $_SESSION['userName']?>" disabled>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-child" aria-hidden="true"></i>
						</span>
                    </div>

                    <label for="userName">fullName</label><br>
                    <div class="wrap-input100 validate-input" data-validate = "Pole imię i nazwisko jest obowiązkowe">

                        <input class="input100" type="text" name="fullName" placeholder="Imię i nazwisko" value="<?php echo $_SESSION['fullName']?>" disabled>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-commenting" aria-hidden="true"></i>
						</span>
                    </div>
                    <label for="email">Email</label><br>
					<div class="wrap-input100 validate-input" data-validate = "Email jest obowiązkowy: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email " value="<?php echo $_SESSION['email']?>" disabled>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="deleteAccount" style="background-color: red">
                            USUŃ KONTO
                        </button>
                    </div>
					<div class="text-center p-t-136">
						<a class="txt2" type="submit"  href="login.php <?php  $_SESSION["login"]=false; ?>">
							Wyloguj się
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	
<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>