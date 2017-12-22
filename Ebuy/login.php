<?php
	session_start();
	
	//Database connection
	
	require_once('php/mysql_r_db_connect.php');
	
	//Inludes
	
	require_once('php/crypt.php');
	require_once('php/login.php');
	
	//Global Variables
	
	$username = '';
	$password = '';
	$salt = 'bQ423hbHM8Sbdb9pjquUQU1IWxcxnybBSjqnyBJ23HjqnI3WbkxUQsxnPw813jkq';
	
	if (isset($_POST['login'])){
		
		$_SESSION['form_login_error'] = '';
		
		$username = trim(htmlentities($_POST['username']));
		$password = trim(htmlentities($_POST['password']));
		
		//Error on empty fields
		if (strlen($username) == 0 or strlen($password) == 0){
			$_SESSION['form_login_error'] = 'Bitte alle Felder füllen';
		}
		//Error on exceed of max fields length
		elseif (strlen($username) > 100 or strlen($password) > 32){
			$_SESSION['form_login_error'] = 'Bitte überschreiten Sie nicht die maximale Feldereingabelänge';
		}
		else{
			$password = mySha512($password, $salt, 10000);
			login($username, $password);
		}
	}

?>
<!DOCTYPE html>
	<!-- Begin of HTML-->
	<html lang="de">
	
		<!-- Begin of head-->
		<head>
			<!-- specifies the character encoding of the HTML file-->
			<meta charset="utf-8">
			
			<!-- Page title-->
			<title>eBuy.ch</title>
			
			<!-- Meta tags-->
			<meta name="description" content="Kleinanzeige Projekt, Modul 133 - GBC Chur" />
			<meta name="author" content="Oscar Cortesi" />
			<meta name="author" content="Sandro Zimmermann" />

			<!-- .ico image -->
			<link rel="icon" href="favicon.ico">

			<!-- Font Awesome for Icons -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			
			<!-- Materialize CSS -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

			<!-- Materialize icons -->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			
			<!-- Custom CSS Style -->
			<link rel="stylesheet" href="css/style.css">
		</head>
		<!-- End of head-->
	
	<!-- Begin of body-->
	<body>
		
		<!--Begin of  navigation-->
		<nav id="home_navigation">
			<div class="nav-wrapper grey lighten-5">
				<a href="index.php" class="brand-logo left"><img src="img/logo.png"/></a>	
			</div>
		</nav>
		<!-- End of navigation-->
		
		<!-- Begin of login row-->
		<div class="row">	
			<div class="col s6 offset-s3 ">
				<!-- Begin of login form div-->
				<div id="form_register_login">
				
					<!-- Linenbreaks-->
					<br />
					<br />
					
					<!-- text and link to register page -->
					<div class="center"><p>Noch nicht registriert?&nbsp;&nbsp;&nbsp;<a class="btn waves-effect waves-light" href="register.php">Registrieren</a></p></div>
					<!-- Linenbreak -->
					<br />
					
					<!-- Begin of login FORM-->
					<form action="login.php" method="POST" class="col s12 grey lighten-5">
						<!-- Errors row -->
						<div class="row">
							<div class="input-field col s12">
								<div class="form_login_error"><?php echo $_SESSION['form_login_error']; ?></div>
							</div>
						</div>
						
						<!-- Username field -->
						<div class="row">
							<div class="input-field col s12">
								<input placeholder="Username" name="username" id="username" type="text" class="validate">
								<label for="username">Username</label>
							</div>
						</div>
						
						<!-- Password field -->
						<div class="row">
							<div class="input-field col s12">
								<input placeholder="Passwort" name="password" id="password" type="password" class="validate">
								<label for="password">Passwort</label>
							</div>
						</div>
						
						<!-- Login button-->
						<div class="center col s12">
							<button class="btn waves-effect waves-light" type="submit" name="login">Jetzt anmelden</button>
							<br />
							<br />
						</div>
						
					</form>
					<!-- End of login FORM-->
				</div>
				<!-- End of login form div-->
			</div>
		</div>
			<!-- End of login row-->
			
		

		

		<!-- jQuery link-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Materialize JavaScript Link-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		<!-- My custom JS-->
		<script type="text/javascript" src="js/main.js"></script>

	</body>
	<!-- End of body-->

</html>
<!-- End of HTML-->

