<?php
	//Database connection
	
	
	//Inludes
	
	//Global Variables
	
	$form_error = '';
	
	if (isset($_POST['register'])){
		$sex = trim(htmlentities($_POST['ddsex']));
		$first_name = trim(htmlentities($_POST['first_name']));
		$last_name = trim(htmlentities($_POST['last_name']));
		$username = trim(htmlentities($_POST['username']));
		$email = trim(htmlentities($_POST['email']));
		$password = trim(htmlentities($_POST['password']));
		$password2 = trim(htmlentities($_POST['password2']));
		$birthday = trim(htmlentities($_POST['birthday']));	
		
		//Error on empty fields
		if (strlen($sex) == 0 or strlen($first_name) == 0 or strlen($last_name) == 0 or strlen($username) == 0 or strlen($email) == 0 or strlen($password) == 0 or strlen($password2) == 0 or strlen($birthday) == 0){
			$form_error = 'Bitte alle Felder füllen';
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
				<ul id="nav-mobile" class="right">
					<li><a style="min-width:180px;" class="waves-effect waves-light dropdown-button btn" data-activates='dropdownAccount'>Yourusername <i class="material-icons right">account_circle</i></a></li>
				</ul>
			</div>
		</nav>
		<!-- End of navigation-->
		
		
		<!-- Content of dropdown button in header-->
		<ul id='dropdownAccount' class='dropdown-content'>
			<li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
			<li><a href="myebuy.php"><i class="material-icons">account_circle</i>My eBuy</a></li>
			<li><a href="sell.php"><i class="material-icons">store</i>Jetzt Verkaufen</a></li>
			<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>
			<li class="divider"></li>
			<li><a href="logout.php"><i class="material-icons">view_module</i>Abmelden</a></li>
		</ul>
		
		<!--Linebreaks-->
		<br />
		<br />
		
		<!-- Materialize CSS breakcrumb -->
		<div class="row">	
			<div class="col s8 offset-s2">
				<nav>
					<div class="nav-wrapper teal lighten-2">
						<div class="col s12">
							<a href="index.php" class="breadcrumb">Home</a>
							<a href="settings.php" class="breadcrumb">Einstellungen</a>
							<a href="myebuy.php" class="breadcrumb">Myusername</a>
						</div>
					</div>
				</nav>
			</div>	
		</div>
		<!-- End of breadcrumb-->
		
		<!--Linebreaks-->
		<br />
		<br />
		
		<div class="row">	
			<div class="col s10 offset-s2 waves-light">
				<!-- Username and Rating-->
				<div class="row">
					<div class="input-field col s10 offset-s1">
						<blockquote><h4>Myusername
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
			
					<div id="form_register_login">
						<br />
						<form action="register.php" method="POST" class="col s12 grey lighten-5">
							<div class="row">
								<div class="input-field col s12">
									<div class="form_error"><?php echo $_SESSION['form_error']; ?></div>
								</div>
							</div>

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
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Username" name="username" id="username" type="text" class="validate" maxlength="100" />
									<label for="username">Username:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="E-Mail" name="email" id="email" type="email" class="validate" maxlength="100" />
									<label for="email">E-Mail Adresse:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input placeholder="Passwort" name="password" id="password" type="password" class="validate" maxlength="100" />
									<label for="password">Passwort:</label>
								</div>
								<div class="input-field col s6">
									<input placeholder="Passwort wiederholden" name="password2" id="password2" type="password" class="validate" maxlength="100" />
									<label for="password2">Passwort wiederholden:</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									  <input placeholder="Geburtstag Datum" type="text" name="birthday" class="datepicker" id="birthday" maxlength="10" />
									<!--<label for="birthday">Geburtstag</label>-->
								</div>
							</div>
							<div class="center col s12">
								<button class="center btn waves-effect waves-light" type="submit" name="register">Profil Speichern</button>
							<br />
							<br />
							</div>
						</form>
					</div>
			</div>
		</div>
				
					

			


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
				selectMonths: true, // Creates a dropdown to control month
				selectYears: 100, // Creates a dropdown of 15 years to control year,
				monthsFull: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
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
</html>

