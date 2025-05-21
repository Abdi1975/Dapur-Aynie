<?php  
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Registrasi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<style>
		/* Custom Styles */
		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			background: linear-gradient(135deg,rgb(226, 226, 226) 0%,rgb(226, 226, 226) 100%);
			height: 100vh;
		}
		
		.container-login100 {
			background: none;
		}
		
		.wrap-login100 {
			border-radius: 20px;
			box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
			padding: 55px 55px 37px 55px;
			background: rgba(255, 255, 255, 0.9);
			backdrop-filter: blur(10px);
			border: 1px solid rgba(255, 255, 255, 0.2);
			transition: all 0.3s ease;
		}
		
		.wrap-login100:hover {
			transform: translateY(-5px);
			box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);
		}
		
		.login100-form-title {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			font-weight: 600;
			color: #333;
			text-transform: uppercase;
			letter-spacing: 1px;
		}
		
		.input100 {
			padding: 15px 20px;
			border-radius: 10px;
			border: 1px solid #e6e6e6;
			background-color: #f8f9fa;
			transition: all 0.3s;
		}
		
		.input100:focus {
			background-color: #fff;
			box-shadow: 0 0 10px rgba(37, 117, 252, 0.2);
			border-color: #2575fc;
		}
		
		.wrap-input100 {
			margin-bottom: 25px;
			position: relative;
		}
		
		.focus-input100 {
			color: #6a11cb;
			font-weight: 500;
		}
		
		.btn-show-pass {
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			color: #6a11cb;
			cursor: pointer;
			z-index: 10;
		}
		
		.login100-form-btn {
			border-radius: 30px;
			background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
			font-weight: 600;
			padding: 12px;
			text-transform: uppercase;
			letter-spacing: 1px;
			transition: all 0.3s;
			margin-top: 20px;
			box-shadow: 0 8px 15px rgba(37, 117, 252, 0.3);
		}
		
		.login100-form-btn:hover {
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(37, 117, 252, 0.4);
		}
		
		.txt1 {
			color: #666;
		}
		
		.txt2 {
			color: #6a11cb;
			font-weight: 600;
			transition: all 0.3s;
		}
		
		.txt2:hover {
			color: #2575fc;
			text-decoration: none;
		}
		
		.alert {
			border-radius: 10px;
			font-size: 14px;
			margin-bottom: 25px;
			padding: 12px 15px;
		}
		
		.alert-danger {
			background-color: #ffe4e6;
			border-color: #ffe4e6;
			color: #e91e63;
		}
		
		.alert-success {
			background-color: #e3f8e9;
			border-color: #e3f8e9;
			color: #28a745;
		}
		
		/* Logo animation */
		.logo-container {
			transition: all 0.3s ease;
		}
		
		.logo-container:hover img {
			transform: rotate(360deg);
		}
		
		.logo-container img {
			transition: all 0.8s ease;
			border-radius: 50%;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			padding: 5px;
			background: white;
		}
	</style>
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="proses_registrasi.php" method="post">
                    <span class="login100-form-title p-b-26">
                        Pendaftaran Akun
                    </span>
                    <span class="login100-form-title p-b-48">
                        <img src="../dashboard/assets/image/logo1.png" style="width: 100px;">
                    </span>

                    <?php
                    if(isset($_SESSION['pesan'])) {
                        echo $_SESSION['pesan'];
                        unset($_SESSION['pesan']);
                    }
                    ?>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="nama_user" required>
                        <span class="focus-input100" data-placeholder="Nama Lengkap"></span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="username" required>
                        <span class="focus-input100" data-placeholder="Username"></span>
                    </div>

                    <div class="wrap-input100">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password" required>
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    <div class="text-center p-t-10">
                        <span class="txt1">
                            Sudah punya akun?
                        </span>
                        <a class="txt2" href="index.php">
                            Login
                        </a>
                    </div>
                    <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit" name="register">
                                Daftar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
