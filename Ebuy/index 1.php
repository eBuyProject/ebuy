<?php
	session_start();
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
							<li class="collection-item"><a href="#">Audio</a></li>
							<li class="collection-item"><a href="#">TV</a></li>
							<li class="collection-item"><a href="#">Video</a></li>
						</ul>
					</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">book</i>Büchern & Comics</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Comics</a></li>
								<li class="collection-item"><a href="#">Büchern</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">computer</i>Computer & Netzwerk</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">PCs</a></li>
								<li class="collection-item"><a href="#">Apple</a></li>
								<li class="collection-item"><a href="#">Notebooks & Zubehör</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">directions_car</i>Fahrzeuge</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Autos</a></li>
								<li class="collection-item"><a href="#">Motorräder</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">album</i>Film & DVD</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Blue-Ray</a></li>
								<li class="collection-item"><a href="#">DVDs</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">photo_camera</i>Foto & Optik</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Action Cam</a></li>
								<li class="collection-item"><a href="#">Digitalcamera</a></li>
								<li class="collection-item"><a href="#">Optik</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">videogame_asset</i>Games & Spielkonsolen</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">PC Spiele</a></li>
								<li class="collection-item"><a href="#">PlayStation Spiele</a></li>
								<li class="collection-item"><a href="#">Spielkonsolen</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">phone_android</i>Handy & Festnetz</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Handys / Smartphones</a></li>
								<li class="collection-item"><a href="#">PrePaid Karten</a></li>
							</ul>
						</div>  
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">rowing</i>Sport</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Fussball</a></li>
								<li class="collection-item"><a href="#">Skisport</a></li>
							</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">mic</i>Musik & Musikinstrumente</div>
						<div class="collapsible-body">
								<ul class="collection">
									<li class="collection-item"><a href="#">Instrumente</a></li>
									<li class="collection-item"><a href="#">Blasinstrumente</a></li>
								</ul>
						</div>
					</li>
					<li>
						<div class="collapsible-header waves-effect"><i class="material-icons">watch</i>Uhren & Schmuk</div>
						<div class="collapsible-body">
							<ul class="collection">
								<li class="collection-item"><a href="#">Goldschmuck</a></li>
								<li class="collection-item"><a href="#">Uhren</a></li>
								<li class="collection-item"><a href="#">Edelsteine</a></li>
							</ul>
						</div>
					</li>
				 </ul>
			</div>
			<!-- End of category element-->
			
			<!--Search box-->
			<div class="col m6 offset-m1 grey lighten-5">			  
				 <div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix">search</i>
						<input type="text" id="autocomplete-input" class="autocomplete">
						<label for="autocomplete-input">Search</label>
					</div>
				  </div>
			</div>
			<!-- End of search box -->
		
			<!--Categories filter-->
			<div class="col m3 offset-m1 grey lighten-5">
				<div class="input-field col s12">
					<select>
						<option value="" disabled selected>Alle</option>
						<option value="1">Audio, TV & Video</option>
						<option value="2">Büchern & Comics</option>
						<option value="3">Computer & Netzwerk</option>
						<option value="4">Fahrzeuge</option>
						<option value="5">Filme & DVD</option>
						<option value="6">Foto & Optik</option>
						<option value="7">Games & Spielkonsolen</option>
						<option value="8">Handy & Festnetz</option>
						<option value="9">Sport</option>
						<option value="10">Musik & Musikinstrumente</option>
						<option value="11">Uhren & Schmuk</option>
					</select>
					<label>In Kategorie</label>
				</div>
			</div>
			<!-- End of categories filter-->
			
			<!-- Begin of sorting options-->
			<div class="col m3 grey lighten-5">
				<div class="input-field col s12">
					<select>
						<option value="1" selected>Neu angestellt</option>
						<option value="2">Preis aufsteigend</option>
						<option value="3">Preis absteigend</option>
						<option value="4">Bald endet</option>
					</select>
					<label>Preis sortieren</label>
				</div>
			</div>
			<!-- End of sorting options -->
			
		<!-- Begin of product listing -->
		<div class="row col m6 offset-m1">
			<!--Group of product cards-->
			<div id="prodcard">
				<!-- Begin of product content-->
				<div class="col m6">
					<!-- Beginn of product-->
					<div class="card">
						<div class="card-image">
							<img src="img/products/panasonic.jpg">
							<!--<span class="card-title">Panasonic LCD Full HD Fernseher</span>-->
							<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modalProduct"><i class="material-icons">add</i></a>
						</div>
						<div class="card-content center">
							<p>Panasonic LCD TV</p>
							<h4>200 CHF</h4>
							<br/>
							<div class="chip">TV</div>
							<div class="chip">LCD</div>
							<div class="chip">Panasonic</div>
						</div>
					</div>
					<!-- End of product-->
				</div>
				<!-- End of product content-->
				
				<div class="col m6">
					<div class="card">
						<!-- Product image container-->
						<div class="card-image">
							<img src="img/products/hppc.jpg">
							<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modalProduct"><i class="material-icons">add</i></a>
						</div>
						<!-- End of image container-->
						
						<!-- Product details-->
						<div class="card-content center" >
							<p>HP DC7900 Small Factor</p>
							<h4>60 CHF</h4>
							<br/>
							<div class="chip">PC</div>
							<div class="chip">HP</div>
							<div class="chip">Intel Core2 Duo</div>
						</div>
						<!-- End of product details-->
						
					</div>
				</div>
				
				<!-- Begin of product content-->
				<div class="col m6">
					<!-- begin of product-->
					<div class="card">
						<!-- Product image container-->
						<div class="card-image">
							<img src="img/products/luckyluke.jpg">
							<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modalProduct"><i class="material-icons">add</i></a>
						</div>
						<!-- End of image container-->
						
						<!-- Product details-->
						<div class="card-content center" >
							<p>Lucky Luke Collection</p>
							<h4>500 CHF</h4>
							<br/>
							<div class="chip">BD</div>
							<div class="chip">Lucky Luke</div>
							<div class="chip">Comics</div>
						</div>
						<!-- End of product details-->
					
					<!-- End of product-->					
					</div>
				</div>
				<!-- End of product content-->
				
				<div class="col m6">
					<div class="card">
						<div class="card-image">
							<img src="img/products/citroen.jpg">
							<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modalProduct"><i class="material-icons">add</i></a>
						</div>
						<div class="card-content center" >
							<p>Citroen C3 1.2i</p>
							<h4>22'650 CHF</h4>
							<br/>
							<div class="chip">Citroen</div>
							<div class="chip">100PS</div>
							<div class="chip">PureTech Shine</div>
						</div>
					</div>
				</div>
				
				<div class="col m6">
					<div class="card">
						<div class="card-image">
							<img src="img/products/nikon.jpg">
							<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modalProduct"><i class="material-icons">add</i></a>
						</div>
						<div class="card-content center" >
							<p>Nikon D300S</p>
							<h4>580 CHF</h4>
							<br/>
							<div class="chip">Nikon</div>
							<div class="chip">Camera</div>
							<div class="chip">D300S</div>
						</div>
					</div>
				</div>
				
				<div class="col m6">
					<div class="card">
						<div class="card-image">
							<img src="img/products/eguitar.jpg">
							<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#modalProduct"><i class="material-icons">add</i></a>
						</div>
						<div class="card-content center" >
							<p>E-Gitarre Stratocaster</p>
							<h4>140 CHF</h4>
							<br/>
							<div class="chip">Gitarre</div>
							<div class="chip">Pro Session</div>
							<div class="chip">Stratocaster</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- End of product card group-->
		</div>
		<!-- End of product listing -->

		<!-- Begin of product modal -->
		<div id="modalProduct" class="modal">
			<div class="modal-content">
				<h4>Panasonic LCD TV</h4>
				<div class="clearfix float-my-children">
					<img src="img/products/panasonic.jpg" class="imagepadding">
					<!-- Modal details container-->
					<div>
						<p class="DescTitle">Produkt Beschreibung:</p>
						<p class="Description">
						PANASONIC LCD TV 42"(107 cm)<br />
						MODEL:TX-L42E6EK<br />
						BILDSCHIRM DEFEKT<br />
						OHNE FERNBEDIENUNG
						</p>
						<p class="DescPrice">
						Preis: 200 CHF
						</p>
						<!-- Buy informations button/link-->
						<div>
							<a href="buy.php" class="waves-effect waves-light btn">Jetzt Kaufen</a>
							<p class="DescVerkaufer">Verkaufer: <a href="userprof.php">Jellybean61</a></p>
						</div>
						<!-- End of buy informations-->
					</div>
					<!-- End of details container-->
				</div>
				<!-- Modal bottom button-->
			</div>
			<div class="modal-footer">
				<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
			</div>
			<!-- End of bottom button-->
		</div>
		<!-- End of modal-->

		<!--Navigation Bottom-->
		<div class=" center row col m6 offset-m5">
			<ul class="pagination" id="bottomnavigation">
				<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
				<li class="active"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
			</ul>
		</div>
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
				$("#modalProduct").modal();
			});
		</script>
		<!-- End of script-->

	</body>
	<!-- End of body-->

</html>
<!-- End of HTML-->
