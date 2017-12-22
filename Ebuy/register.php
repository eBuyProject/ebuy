<?php
	session_start();

	//Database connection
	
	require_once('php/mysql_db_connect.php');
	
	//Includes
	
	require_once('php/crypt.php');
	require_once('php/register.php');
	
	//Global Variables
	
	$salutation = '';
	$first_name = '';
	$last_name = '';
	$username = '';
	$password = '';
	$password2 = '';
	$email = '';
	$phone = 0;
	$street = '';
	$postcode = 0;
	$place = '';
	$birthday = '';
	$salt = 'bQ423hbHM8Sbdb9pjquUQU1IWxcxnybBSjqnyBJ23HjqnI3WbkxUQsxnPw813jkq';
	
	//Regisrter form
	
	if (isset($_POST['register'])){
		
		$_SESSION['form_register_error'] = '';
		
		$salutation = trim(htmlentities($_POST['ddsalutation']));
		$first_name = trim(htmlentities($_POST['first_name']));
		$last_name = trim(htmlentities($_POST['last_name']));
		$username = trim(htmlentities($_POST['username']));
		$password = trim(htmlentities($_POST['password']));
		$password2 = trim(htmlentities($_POST['password2']));
		$email = trim(htmlentities($_POST['email']));
		$phone = trim(htmlentities($_POST['phone']));
		$street = trim(htmlentities($_POST['street']));
		$postcode = trim(htmlentities($_POST['postcode']));
		$place = trim(htmlentities($_POST['place']));
		$birthday = trim(htmlentities($_POST['birthday']));	
		
		//Error on empty fields
		if (strlen($salutation) == 0 or strlen($first_name) == 0 or strlen($last_name) == 0 or strlen($username) == 0 or strlen($password) == 0 or strlen($password2) == 0 or strlen($email) == 0 or strlen($phone) == 0 or strlen($street) == 0 or strlen($postcode) == 0 or strlen($place) == 0 or strlen($birthday) == 0){
			$_SESSION['form_register_error'] = 'Bitte füllen Sie alle Felder aus';
		}
		//Error on exceed of max fields length
		elseif (strlen($salutation) > 4 or strlen($first_name) > 45 or strlen($last_name) > 45 or strlen($username) > 100 or strlen($password) > 32 or strlen($password2) > 32 or strlen($email) > 100 or strlen($phone) > 10 or strlen($street) > 100 or strlen($postcode) > 4 or strlen($place) > 100 or strlen($birthday) > 10){
			$_SESSION['form_register_error'] = 'Bitte überschreiten Sie nicht die maximale Feldereingabelänge';
		}
		//Error on wrong salutation
		elseif ($salutation != 'Herr' and $salutation != 'Frau'){
			$_SESSION['form_register_error'] = 'Bitte geben Sie eine gültige Anrede an';
		}
		//Error on unidentical passwords
		elseif ($password != $password2){
			$_SESSION['form_register_error'] = 'Die Passwörter sind nicht identisch';
		}
		//Error on wrong phone number format
		elseif (strlen($phone) < 10 or strlen($phone) > 10){
			$_SESSION['form_register_error'] = 'Telefonnummer stimmt nicht mit dem angegebenen format überein';
		}
		//Error on non numerical phone number
		elseif (!is_numeric($phone)){
			$_SESSION['form_register_error'] = 'Bitte geben sie eine gültige Telefonummer ein';
		}
		//Error on non existing postcode
		elseif (strlen($postcode) < 4 or strlen($postcode) > 4 or $postcode < 1000 or !is_numeric($postcode)){
			$_SESSION['form_register_error'] = 'Bitte geben Sie eine gültige Postleitzahl ein';
		}
		else{
			$password = mySha512($password, $salt, 10000);
			register($salutation, $first_name, $last_name, $username, $password, $email, $phone, $street, $postcode, $place, $birthday);
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
	
			<!--Begin of navigation-->
			<nav id="home_navigation">
				<div class="nav-wrapper grey lighten-5">
					<!-- Logo image-->
					<a href="index.php" class="brand-logo left"><img src="img/logo.png"/></a>	
				</div>
			</nav>
			<!-- End of navigation-->
			
			<!-- Begin of register row-->
			<div class="row">	
				<div class="col s6 offset-s3">
						<!-- from div-->
						<div id="form_register_login">
							
							<!-- linebreakes -->
							<br />
							<br />
							
							<!-- text and link to login page -->
							<div class="center"><p>Schon registriert?&nbsp;&nbsp;&nbsp;<a class="btn waves-effect waves-light" href="login.php">Anmelden</a></p></div>
							
							<!-- linebreake -->
							<br />
							
							<!-- Begin of form-->
							<form action="register.php" method="POST" class="col s12 grey lighten-5">
							
								<!-- Errors row -->
								<div class="row">
									<div class="input-field col s12">
										<div class="form_register_error"><?php echo $_SESSION['form_register_error']; ?></div>
									</div>
								</div>
								
								<!-- Dropdown gender-->
								<div class="row">
									<div class="input-field col s6">
										<select name="ddsalutation" id="ddsalutation">
											<option value="" disabled selected>Anrede</option>
											<option value="Herr">Herr</option>
											<option value="Frau">Frau</option>
										</select>
										<label>Anrede:</label>
									</div>
								</div>
								
								<!-- Name and surname field-->
								<div class="row">
									<div class="input-field col s6">
										<input placeholder="Vorname" name="first_name" id="first_name" type="text" class="validate" maxlength="45" />
										<label for="first_name">Vorname:</label>
									</div>
									<div class="input-field col s6">
										<input placeholder="Nachname" name="last_name" id="last_name" type="text" class="validate" maxlength="45" />
										<label for="last_name">Nachname:</label>
									</div>
								</div>
								
								<!-- Username field-->
								<div class="row">
									<div class="input-field col s12">
										<input placeholder="Username" name="username" id="username" type="text" class="validate" maxlength="100" />
										<label for="username">Username:</label>
									</div>
								</div>
								
								<!-- 2 times password filed-->
								<div class="row">
									<div class="input-field col s6">
										<input placeholder="Passwort" name="password" id="password" type="password" class="validate" maxlength="32" />
										<label for="password">Passwort:</label>
									</div>
									<div class="input-field col s6">
										<input placeholder="Passwort wiederholden" name="password2" id="password2" type="password" class="validate" maxlength="32" />
										<label for="password2">Passwort wiederholden:</label>
									</div>
								</div>
								
								<!-- Email adress field-->
								<div class="row">
									<div class="input-field col s12">
										<input placeholder="E-Mail" name="email" id="email" type="email" class="validate" maxlength="100" />
										<label for="email">E-Mail Adresse:</label>
									</div>
								</div>
								
								<!-- Telefon number field-->
								<div class="row">
									<div class="input-field col s12">
										<input placeholder="Telefon" name="phone" id="phone" type="text" class="validate" maxlength="10" />
										<label for="phone">Telefon (z.B. 0799442209):</label>
									</div>
								</div>
								
								<!-- Street field-->
								<div class="row">
									<div class="input-field col s12">
										<input placeholder="Strasse" name="street" id="street" type="text" class="validate" maxlength="100" />
										<label for="phone">Strasse:</label>
									</div>
								</div>
								
								<!-- Post code and place filed-->
								<div class="row">
									<div class="input-field col s6">
										<input placeholder="PLZ" name="postcode" id="postcode" type="text" class="validate" maxlength="4" />
										<label for="postcode">PLZ:</label>
									</div>
									<div class="input-field col s6">
										<input placeholder="Ort" name="place" id="place" type="text" class="validate" maxlength="100" />
										<label for="place">Ort:</label>
									</div>
								</div>
								
								<!-- Birthdate field-->
								<div class="row">
									<div class="input-field col s12">
										  <input placeholder="Geburtstag Datum" type="text" name="birthday" class="datepicker" id="birthday" maxlength="10" />
										<label for="birthday">Geburtstag</label>
									</div>
								</div>
								
								<!-- Register button-->
								<div class="center col s12">
									<button class="center btn waves-effect waves-light" type="submit" name="register">Jetzt registrieren</button>
								
								<!-- linebreakes -->								
								<br />
								<br />
								
								</div>
							</form>
							<!-- End of form-->
						</div>
						<!-- End of form div-->
				</div>
			</div>
			<!-- End of register row-->


			<!-- jQuery link-->
			<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
			<!-- Materialize JavaScript Link-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
			<!-- My custom JS-->
			<script type="text/javascript" src="js/main.js"></script>
			
			<!-- Begin of script-->
			<script>
			<!-- Date picker initialization-->
				$('.datepicker').pickadate({
					format: 'dd.mm.yyyy',
					formatSubmit: 'dd.mm.yyyy',
					selectMonths: true, // Creates a dropdown to control month
					selectYears: 100, // Creates a dropdown of 15 years to control year,
					monthsFull: ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'],
					weekdaysShort: ['Son', 'Mon', 'Die', 'Mit', 'Don', 'Fre', 'Sam'],
					max: new Date(),
					today: 'Heute',
					clear: 'Abbrechen',
					close: 'Ok',
					closeOnSelect: false // Close upon selecting a date,
				});
			</script>
			<!-- End of script-->

		</body>
		<!-- End of body-->

	</html>
	<!-- End of HTML-->

