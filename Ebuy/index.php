<?php
	session_start();
	
	$_SESSION['form_search_error'] = '';
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

			<!-- .ico image-->
			<link rel="icon" href="favicon.ico">

			<!-- Font Awesome for Icons -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			
			<!-- Materialize CSS -->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
			
			<!-- Materialize icons -->
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			
			<!-- Custom CSS style -->
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
				<?php
					if (!isset($_SESSION['username'])){
						echo '
							<ul id="nav-mobile" class="right">
								<li><a class="waves-effect waves-light waves-light red btn" href="login.php">Anmelden <i class="material-icons right">account_circle</i></a></li>
							</ul>
						';
					}
					if (isset($_SESSION['username'])){
						echo '
							<!-- Dropdown Button nur when angemeldet -->
							<ul id="nav-mobile" class="right">
								<li><a class="btn-min-width waves-effect waves-light dropdown-button btn" data-activates="dropdownAccount">' . $_SESSION['username'] . '<i class="material-icons right">account_circle</i></a></li>
							</ul>
						';
					}
				?>
			</div>
		</nav>
		<!-- End of navigation-->
		
		<!-- Content of dropdown Button in header-->
		<ul id='dropdownAccount' class='dropdown-content'>
			<li><a href="myebuy.php"><i class="material-icons">account_circle</i>My eBuy</a></li>
			<li><a href="sell.php"><i class="material-icons">store</i>Jetzt Verkaufen</a></li>
			<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>
			<li class="divider"></li>
			<li><a href="logout.php"><i class="material-icons">view_module</i>Abmelden</a></li>
		</ul>
		
		<!-- Spacer element to create space-->
		<div class="spacer"></div>
		
		<!--Left categories bar-->
		<div class="row">

			<!-- List of categories on left of page-->
			<div class="col s3 m3 l3 offset-m1 offset-l1" id="categories">	
				<ul class="collapsible" data-collapsible="accordion">
					<li>
					<!-- Category Title-->
					<div class="collapsible-header waves-effect"><i class="material-icons">audiotrack</i>Audio, TV & Video</div>
					<div class="collapsible-body">
						<ul class="collection">
							<!-- Category content (subcategories)-->
							<li class="collection-item"><a href="filter.php?subcategory=Audio">Audio</a></li>
							<li class="collection-item"><a href="filter.php?subcategory=TV">TV</a></li>
							<li class="collection-item"><a href="filter.php?subcategory=Video">Video</a></li>
						</ul>
					</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">book</i>Büchern & Comics</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=Comics">Comics</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Buecher">Büchern</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">computer</i>Computer & Netzwerk</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=PCs">PCs</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Apple">Apple</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=NotebooksZubehoer">Notebooks & Zubehör</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">directions_car</i>Fahrzeuge</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=Autos">Autos</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Motorraeder">Motorräder</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">album</i>Film & DVD</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=BlueRay">Blue-Ray</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=DVDs">DVDs</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">photo_camera</i>Foto & Optik</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=ActionCam">Action Cam</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Digitalcamera">Digitalcamera</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Optik">Optik</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">videogame_asset</i>Games & Spielkonsolen</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=PCSpiele">PC Spiele</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=PlayStationSpiele">PlayStation Spiele</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Spielkonsolen">Spielkonsolen</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">phone_android</i>Handy & Festnetz</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=HandysSmartphones">Handys / Smartphones</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=PrePaidKarten">PrePaid Karten</a></li>
							</ul>
						</div>  
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">rowing</i>Sport</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=Fussball">Fussball</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Skisport">Skisport</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">mic</i>Musik & Musikinstrumente</div>
						<div class="collapsible-body">
								<ul class="collection">
									<li class="collection-item"><a href="filter.php?subcategory=Instrumente">Instrumente</a></li>
									<li class="collection-item"><a href="filter.php?subcategory=Blasinstrumente">Blasinstrumente</a></li>
								</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">watch</i>Uhren & Schmuk</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="filter.php?subcategory=Goldschmuck">Goldschmuck</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Uhren">Uhren</a></li>
								<li class="collection-item"><a href="filter.php?subcategory=Edelsteine">Edelsteine</a></li>
							</ul>
						</div>
					</li>
				 </ul>
			</div>
				<!-- End of category element-->
				
				<form action="filter.php" method="GET">
				<!--Categories filter-->
				<div class="col m3 offset-m1 grey lighten-5">
					<div class="input-field col s12">
						<select name="category">
							<option value="All" selected>Alle</option>
							<option value="AudioTVVideo">Audio, TV & Video</option>
							<option value="BuecherComics">Büchern & Comics</option>
							<option value="ComputerNetzwerk">Computer & Netzwerk</option>
							<option value="Fahrzeuge">Fahrzeuge</option>
							<option value="FilmDVD">Filme & DVD</option>
							<option value="FotoOptik">Foto & Optik</option>
							<option value="GamesSpielkonsolen">Games & Spielkonsolen</option>
							<option value="HandyFestnetz">Handy & Festnetz</option>
							<option value="Sport">Sport</option>
							<option value="MusikMusikinstrumente">Musik & Musikinstrumente</option>
							<option value="UhrenSchmuk">Uhren & Schmuk</option>
						</select>
						<label>In Kategorie</label>
					</div>
				</div>
				<!-- End of categories filter-->
				
				<!-- Begin of sorting options-->
				<div class="col m3 grey lighten-5">
					<div class="input-field col s12">
						<select name="sort">
							<option value="1">Neu angestellt</option>
							<option value="2">Preis aufsteigend</option>
							<option value="3">Preis absteigend</option>
						</select>
						<label>Sortieren</label>
					</div>
				</div>
				<!-- End of sorting options -->
				
				<!--Search box-->
				<div class="col m6 offset-m1 grey lighten-5">
					 <div class="row">
						<div class="input-field col s12">
							<i class="material-icons prefix">search</i>
							<input type="text" name="search" id="autocomplete-input" class="autocomplete" required="required">
							<label for="autocomplete-input">Search</label>
						</div>
					  </div>
				</div>
				<!-- End of search box -->
				
				<input type="submit" name="start_search" value="Suchen" style="display:none;"/>
			</form>
			
		<!-- Begin of product listing -->
		<div class="row col m6 offset-m1">
			<!--Group of product cards-->
			<div id="prodcard">
				<?php include('php/all_products.php'); all_products(); ?>
			</div>
			<!-- End of product card group-->
		</div>
		<!-- End of product listing -->

		<?php include('php/all_modal_products.php'); all_modal_products(); ?>

		<!--Navigation Bottom-->
		<!--<div class=" center row col m6 offset-m5">
			<ul class="pagination" id="bottomnavigation">
				<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				<li class="active"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div>-->
		<!-- End of navigation element -->

		<!-- jQuery link-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Materialize JavaScript Link-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		<!-- My custom JS-->
		<script type="text/javascript" src="js/main.js"></script>
		
		<!-- Begin of script-->
		<script type="text/javascript">
			<!-- Initialization of modal element -->
			$(document).ready(function(){
				$(".modal").modal();
			});
		</script>
		<!-- End of script-->

	</body>
	<!-- End of body-->

</html>
<!-- End of HTML-->
