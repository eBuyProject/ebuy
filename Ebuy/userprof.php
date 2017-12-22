<?php
	//Redirect to myebuy.php with your ID
	/*$url = $uri = $_SERVER['REQUEST_URI'];
		echo parse_url($url, PHP_URL_QUERY);
		die();
	
	if (isset($_SESSION['id'])){
		
	}*/
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
					<li><a style="min-width:180px;" class="waves-effect waves-light dropdown-button btn" data-activates='dropdownAccount'>Yourusername <i class="material-icons right">account_circle</i></a></li>
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
							<a href="myebuy.php" class="breadcrumb">My eBuy</a>
							<a class="breadcrumb">Otherusername</a>
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
					<div class="input-field col s10">
						<blockquote class="blocknear"><h4>Otherusername 
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star-half-o icon-star" aria-hidden="true"></i>
							<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
							<i class="fa fa-star-o icon-star" aria-hidden="true"></i></h4>
						</blockquote>
					</div>
					
				<div class="col s8">
					<table id="userinformations" class="grey lighten-5">
						<tr>
							<td><b>Email Adresse:</b></td>
							<td><a>hisherusername@pollos.com</a></td>
						</tr>						
						<tr>
							<td><b>Telefonnummer:</b></td>
							<td><a>081 456 21 85</a></td>
						</tr>
						<tr>
							<td><b>Adresse</b></td>
							<td><a>Randomstrasse 22</a></td>
						</tr>						
						<tr>
							<td><b>Stadt</b></td>
							<td><a>7061, Randomstadt</a></td>
						</tr>
						<tr>
							<td><b>Total verkaufte Produkte</b></td>
							<td><a>11</a></td>
						</tr>						
						<tr>
							<td><b>Gekaufte Produkte</b></td>
							<td><a>3</a></td>
						</tr>
					</table>
				</div>
					
				</div>
			</div>
			
		</div>
			


		<!-- jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		
		<!-- Star bar rating -->
		<script src="js/jquery.barrating.min.js"></script>

	</body>
</html>

