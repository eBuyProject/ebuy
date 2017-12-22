<?php
	session_start();

	//Database connection
	
	require_once('php/mysql_r_db_connect.php');
	
	//Inludes
	
	require_once('php/update.php');
	require_once('php/crypt.php');
	
	//Global Variables
	
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
	$user_id = $_SESSION['id'];
	
	//Fill Fields with known data-activates
	
	$sql = "SELECT fldUsername, fldEmail, fldBirthday, fldFirstname, fldLastname, fldPhone, fldStreet, fldPostcode, fldPlace FROM tblUsers WHERE fldIdUSer LIKE '$user_id' LIMIT 1";
	$stmt = $handle->query($sql);
	$row = $stmt->fetchObject();
	
	//Update Form
	
	if (isset($_POST['update'])){
		
		$_SESSION['form_settings_error'] = '';
		
		$first_name = trim(htmlentities($_POST['first_name']));
		$last_name = trim(htmlentities($_POST['last_name']));
		$username = trim(htmlentities($_POST['username']));
		$current_password = trim(htmlentities($_POST['current_password']));
		$password = trim(htmlentities($_POST['password']));
		$password2 = trim(htmlentities($_POST['password2']));
		$email = trim(htmlentities($_POST['email']));
		$phone = trim(htmlentities($_POST['phone']));
		$street = trim(htmlentities($_POST['street']));
		$postcode = trim(htmlentities($_POST['postcode']));
		$place = trim(htmlentities($_POST['place']));
		$birthday = trim(htmlentities($_POST['birthday']));		
		
		//Error on empty fields
		if (strlen($first_name) == 0 or strlen($last_name) == 0 or strlen($username) == 0 or strlen($current_password) == 0 or strlen($password) == 0 or strlen($password2) == 0 or strlen($email) == 0 or strlen($phone) == 0 or strlen($street) == 0 or strlen($postcode) == 0 or strlen($place) == 0 or strlen($birthday) == 0){
			$_SESSION['form_settings_error'] = 'Bitte füllen Sie alle Felder aus';
		}
		//Error on exceed of max fields length
		elseif (strlen($first_name) > 45 or strlen($last_name) > 45 or strlen($username) > 100 or strlen($current_password) > 32 or strlen($password) > 32 or strlen($password2) > 32 or strlen($email) > 100 or strlen($phone) > 10 or strlen($street) > 100 or strlen($postcode) > 4 or strlen($place) > 100 or strlen($birthday) > 10){
			$_SESSION['form_settings_error'] = 'Bitte überschreiten Sie nicht die maximale Feldereingabelänge';
		}
		//Error on unidentical passwords
		elseif ($password != $password2){
			$_SESSION['form_settings_error'] = 'Die Passwörter sind nicht identisch';
		}
		//Error on wrong phone number format
		elseif (strlen($phone) < 10 or strlen($phone) > 10){
			$_SESSION['form_settings_error'] = 'Telefonnummer stimmt nicht mit dem angegebenen format überein';
		}
		//Error on non numerical phone number
		elseif (!is_numeric($phone)){
			$_SESSION['form_settings_error'] = 'Bitte geben sie eine gültige Telefonummer ein';
		}
		//Error on non existing postcode
		elseif (strlen($postcode) < 4 or strlen($postcode) > 4 or $postcode < 1000 or !is_numeric($postcode)){
			$_SESSION['form_settings_error'] = 'Bitte geben Sie eine gültige Postleitzahl ein';
		}
		else{
			$current_password = mySha512($current_password, $salt, 10000);
			$password = mySha512($password, $salt, 10000);
			update($first_name, $last_name, $username, $current_password, $password, $email, $phone, $street, $postcode, $place, $birthday);
		}
	}
?>
<!DOCTYPE html>

	<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>eBuy.ch</title>
		<meta name="description" content="Kleinanzeige Projekt, Modul 133 - GBC Chur" />
		<meta name="author" content="Oscar Cortesi" />
		<meta name="author" content="Sandro Zimmermann" />

		<!-- .ico image -->
		<link rel="icon" href="favicon.ico">

		<!-- Font Awesome for Icons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- Materialize CSS-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

		<!-- Materialize icons -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/fontawesome-stars.css">

		<!-- CSS Style -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	
	<body>
	
		<!--Top navigation-->
		<nav id="home_navigation">
			<div class="nav-wrapper grey lighten-5">
				<a href="index.php" class="brand-logo left"><img src="img/logo.png"/></a>
				<!--<ul id="nav-mobile" class="right">
					<li><a class="waves-effect waves-light waves-light red btn" href="login.php">Anmelden <i class="material-icons right">account_circle</i></a></li>
				</ul> -->
				
				<!-- Dropdown Button nur when angemeldet -->
				<ul id="nav-mobile" class="right">
					<li><a class="btn-min-width waves-effect waves-light dropdown-button btn" data-activates='dropdownAccount'><?php echo $_SESSION['username']; ?> <i class="material-icons right">account_circle</i></a></li>
				</ul>
				
			</div>
		</nav>
		
		
		<!-- Username Dropdown Button -->
		<ul id='dropdownAccount' class='dropdown-content'>
			<li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
			<li><a href="myebuy.php"><i class="material-icons">account_circle</i>My eBuy</a></li>
			<li><a href="sell.php"><i class="material-icons">store</i>Jetzt Verkaufen</a></li>
			<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>
			<!--<li><a href="mykaufen.php"><i class="material-icons">shopping_cart</i>Mein Kaufen</a></li>
			<li><a href="mysell.php"><i class="material-icons">exit_to_app</i>Mein Verkaufen</a></li>-->
			<li class="divider"></li>
			<li><a href="logout.php"><i class="material-icons">view_module</i>Abmelden</a></li>
		</ul>
		
		<br />
		<br />
		
		<div class="row">	
			<div class="col s8 offset-s2">
				<nav>
					<div class="nav-wrapper teal lighten-2">
						<div class="col s12">
							<a href="index.php" class="breadcrumb">Home</a>
							<a href="settings.php" class="breadcrumb">Einstellungen</a>
							<a href="myebuy.php" class="breadcrumb"><?php echo $_SESSION['username']; ?></a>
						</div>
					</div>
				</nav>
			</div>	
		</div>	
		
		<br />
		<br />
		
		<div class="row">	
			<div class="col s10 offset-s2 waves-light">
				<!-- Username and Rating-->
				<div class="row">
					<div class="input-field col s10 offset-s1">
						<blockquote><h4><?php echo $_SESSION['username']; ?>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star-half-o icon-star" aria-hidden="true"></i>
							</h4>
						</blockquote>
					</div>
				</div>
			</div>	
		</div>	
					
		<div class="row">	
			<div class="col s6 offset-s3">
			
					<div id="form_settings_login">
						<br />
						<form action="settings.php" method="POST" onSubmit="logoutMessage()" class="col s12 grey lighten-5">
							<div class="row">
								<div class="input-field col s12">
									<div class="form_register_error"><?php echo $_SESSION['form_settings_error']; ?></div>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input placeholder="Vorname" value="<?php echo $row->fldFirstname; ?>" name="first_name" id="first_name" type="text" class="validate" maxlength="45" />
									<label for="first_name">Vorname:</label>
								</div>
								<div class="input-field col s6">
									<input placeholder="Nachname" value="<?php echo $row->fldLastname; ?>" name="last_name" id="last_name" type="text" class="validate" maxlength="45" />
									<label for="last_name">Nachname:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Username" value="<?php echo $row->fldUsername; ?>" name="username" id="username" type="text" class="validate" maxlength="100" />
									<label for="username">Username:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Momentanes Passwort" name="current_password" id="current_password" type="password" class="validate" maxlength="32" />
									<label for="current_password">Momentanes Passwort:</label>
								</div>
							</div>
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
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="E-Mail" value="<?php echo $row->fldEmail; ?>" name="email" id="email" type="email" class="validate" maxlength="100" />
									<label for="email">E-Mail Adresse:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Telefon" value="<?php echo $row->fldPhone; ?>" name="phone" id="phone" type="text" class="validate" maxlength="10" />
									<label for="phone">Telefon (z.B. 0799442209):</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Strasse" value="<?php echo $row->fldStreet; ?>" name="street" id="street" type="text" class="validate" maxlength="100" />
									<label for="phone">Strasse:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input placeholder="PLZ" value="<?php echo $row->fldPostcode; ?>" name="postcode" id="postcode" type="text" class="validate" maxlength="4" />
									<label for="postcode">PLZ:</label>
								</div>
								<div class="input-field col s6">
									<input placeholder="Ort" value="<?php echo $row->fldPlace; ?>" name="place" id="place" type="text" class="validate" maxlength="100" />
									<label for="place">Ort:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									  <input placeholder="Geburtstag Datum" value="<?php echo $row->fldBirthday; ?>" type="text" name="birthday" class="datepicker" id="birthday" maxlength="10" />
									<label for="birthday">Geburtstag</label>
								</div>
							</div>
							<div class="center col s12">
								<button class="center btn waves-effect waves-light" type="submit" name="update">Einstellungen speichern</button>
							<br />
							<br />
							</div>
						</form>
					</div>
			</div>
		</div>
				
					

			


		<!-- jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		
		<!-- Star bar rating -->
		<script src="js/jquery.barrating.min.js"></script>
		
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
			
		//Form Message on submit
		
		function logoutMessage(){
			alert('Sollten alle Eingaben erfolgreich geperichert werden können. Werden Sie automatisch abgemeldet!');
		}
		</script>

	</body>
</html>

