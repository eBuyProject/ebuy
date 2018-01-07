<?php
	session_start();
	error_reporting(0);

	//Page only accessible when logged in
	
	if (!isset($_SESSION['username'])){
		header ('Location: index.php');
	}
	
	//Inludes
	
	require_once('php/get_rating.php');
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
				
				<!-- Dropdown Button nur when angemeldet -->
				<ul id="nav-mobile" class="right">
					<li><a class="btn-min-width waves-effect waves-light dropdown-button btn" data-activates="dropdownAccount"><?php echo $_SESSION['username'] ?><i class="material-icons right">account_circle</i></a></li>
				</ul>
			</div>
		</nav>
		<!-- Username Dropdown Button -->

		<ul id="dropdownAccount" class="dropdown-content">
			<li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
			<li><a href="myebuy.php"><i class="material-icons">account_circle</i>My eBuy</a></li>
			<li><a href="sell.php"><i class="material-icons">store</i>Jetzt Verkaufen</a></li>
			<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>
			<!--<li><a href="mykaufen.php"><i class="material-icons">shopping_cart</i>Mein Kaufen</a></li>
			<li><a href="mysell.php"><i class="material-icons">exit_to_app</i>Mein Verkaufen</a></li>-->
			<li class="divider"></li>
			<li><a href="php/logout.php"><i class="material-icons">view_module</i>Abmelden</a></li>
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
							<a class="breadcrumb"><?php echo $_SESSION['username']; ?></a>
						</div>
					</div>
				</nav>
			</div>	
		</div>
		
		<br />
		<br />
		
		
		<div class="row">	
		
			<div class="col s10 offset-s1 waves-light">
				<!-- Username and Rating-->
				<div class="row">
					<div class="input-field col s10">
						<blockquote>
							<h4>My eBuy: <?php echo $_SESSION['username']; getRating($_SESSION['id']);?></h4>
						</blockquote>
					</div>
				</div>

				<br />
				<br />
				
				<!-- MEIN VERKAUFEN und MEIN KAUFEN swipe buttons-->
				<ul id="tabs-swipe-profile" class="tabs waves-light">
					<li class="tab col s3"><a class="active" href="#profile-swipe-1">Meine Verkäufe</a></li>
					<li class="tab col s3"><a href="#profile-swipe-2">Meine Käufe</a></li>
				</ul>
				
				<!-- Table "MEIN VERKAUFEN"-->
				<div id="profile-swipe-1" class="col s12">
					<table>
						<thead>
							<tr>
								<th>Datum</th>
								<th>Käufer</th>
								<th>Produkt</th>
								<th>Preis</th>
								<th>Status</th>
								<th>Käufer Bewertung</th>
								<th>Kommentar</th>
							</tr>
						</thead>

						<tbody>
							
							<?php include('php/my_sell.php'); my_sell(); ?>
				
				<!-- Table "MEIN KAUFEN"-->
				<div id="profile-swipe-2" class="col s12">
					
					<table>
						<thead>
							<tr>
								<th>Datum</th>
								<th>Verkäufer</th>
								<th>Produkt</th>
								<th>Preis</th>
								<th>Status</th>
								<th>Verkäufer Bewertung</th>
								<th>Kommentar</th>
							</tr>
						</thead>

						<tbody>
								<?php include('php/my_buy.php'); my_buy(); ?>
							

		<!-- jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		
		<!-- Star bar rating -->
		<script src="js/jquery.barrating.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".modal").modal();
			});
		
		   $(function() {
			  $('.starsverkaufen').barrating({
				theme: 'fontawesome-stars'
			  });
			  $('.starskaufen').barrating({
				theme: 'fontawesome-stars'
			  });
		   });
		</script>


	</body>
</html>

