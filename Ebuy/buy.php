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
							<a href="kaufen.php" class="breadcrumb">Kaufen</a>
							<a class="breadcrumb">Produktname</a>
						</div>
					</div>
				</nav>
			</div>	
		</div>
		
		<br />
		<br />
		
		
		<div class="row">	
		
			<div class="col s6 offset-s3">
				<div class="card">
					<div class="card-image waves-effect waves-block waves-light">
						<img class="activator" src="img/products/nikon.jpg">
					</div>
					<div class="card-content">
						<span class="card-title activator grey-text text-darken-4">Nikon D300S<i class="material-icons right">more_vert</i></span>
						<p class="DescVerkaufer">Verkaufer: <a href="userprof.php">Jellybean61</a></p>
					</div>
					<div class="card-reveal">
						<span class="card-title grey-text text-darken-4"><b>Beschreibung:</b><i class="material-icons right">close</i></span>
						<p>
						Nikon D 300S mit Zubehör zu verkaufen.<br />
						Ich trenne mich nur ungerne von der Kamera die mich nie im Stich gelassen hat. Einziger Grund dafür ist das sie mir einfach etwas zu schwer wurde und ich mich für eine Spiegellose entschieden habe.<br /><br /> 
						MIt Verkauft wird:<br />
						Sigma 18-270  F/3.5-6.3<br />
						Nikon Speedlight SB-9oo<br />
						Nikon Quickcharger MH-18a<br />
						3 Stück Akku Nikon EN-EL 3e<br />
						Flimschacht von Perfect<br />
						Blitz Diffusor <br />
						Profibuch Nikon D300s<br /><br />
						Bei Sofort Kauf gebe ich die Crumpler Tasche mit dazu.
						</p>
					</div>
				</div>
			</div>
			
			<div class="col center s10 offset-s1">
			<br />
			<br />
				<a href="myebuy.php#profile-swipe-2" class="waves-effect waves-light btn"><i class="material-icons right">chevron_right</i>Kauf Bestätigen</a>
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

