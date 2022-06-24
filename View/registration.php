<?php
include_once '../Model/userModel.php';
include_once '../Controller/userController.php';
if(isset($_POST['registraion']))
    {
        $userName=$_POST['userName'];
        $fullName=$_POST['fullName'];
        $email=$_POST['email'];
        $password=$_POST['pass'];
        $confirmPassword=$_POST['confirmPass'];
        $user=new UserController();
        $user->addUser($userName,$fullName,$email,$password,$confirmPassword);
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Rejestracja</title>
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
						REJESTRACJA
					</span>

                    <div class="wrap-input100 validate-input" data-validate = "Nazwa użytkownika jest obowiązkowa">
                        <input class="input100" type="text" name="userName" placeholder="Nazwa użytkownika">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-child" aria-hidden="true"></i>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Pole imię i nazwisko jest obowiązkowe">
                        <input class="input100" type="text" name="fullName" placeholder="Imię i nazwisko">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-commenting" aria-hidden="true"></i>
						</span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate = "Email jest obowiązkowy: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email ">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Hasło jest obowiązkowe">
						<input class="input100" type="password" name="pass" placeholder="Hasło">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Hasło jest obowiązkowe">
                        <input class="input100" type="password" name="confirmPass" placeholder="Powtórz hasło">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>
					<div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" name="registraion">
							ZAREJESTRUJ
						</button>
					</div>
					<div class="text-center p-t-136">
						<a class="txt2" href="login.php">
							Zaloguj się
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