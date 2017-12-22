<?php
	session_start();

	//Page only accessible when logged in
	
	if (!isset($_SESSION['username'])){
		header ('Location: index.php');
	}
	
	//Database connection
	
	
	//Inludes
	
	//Global Variables
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
						<blockquote><h4>My eBuy: <?php echo $_SESSION['username']; ?>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star icon-star" aria-hidden="true"></i>
							<i class="fa fa-star-half-o icon-star" aria-hidden="true"></i></h4>
						</blockquote>
					</div>
				</div>

				<br />
				<br />
				
				<!-- MEIN VERKAUFEN und MEIN KAUFEN swipe buttons-->
				<ul id="tabs-swipe-profile" class="tabs waves-light">
					<li class="tab col s3"><a class="active" href="#profile-swipe-1">Mein Verkaufen</a></li>
					<li class="tab col s3"><a href="#profile-swipe-2">Mein Kaufen</a></li>
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
							<tr>
								<td>11.11.2017</td>
								<td><a class="modal-trigger" href="#modalUser">Markfas4634</a></td>
								<td><a class="modal-trigger" href="#modalProductInfo">Panasonic LCD TV</a></td>
								<td>200 CHF</td>
								<td>Abgeschlossen</td>
								<td>
									<select class="starsverkaufen">
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
								</td>
								<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">check</i></a></td>
							</tr>
							<tr>
								<td>11.11.2017</td>
								<td><a class="modal-trigger" href="#modalUser">Jellybean61</a></td>
								<td><a class="modal-trigger" href="#modalProductInfo">HP DC7900 Small Factor</a></td>
								<td>60 CHF</td>
								<td>Abgeschlossen</td>
								<td>
									<select class="starsverkaufen">
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
								</td>
								<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">comment</i></a></td>
							</tr>
							<tr>
								<td>11.11.2017</td>
								<td><a class="modal-trigger" href="#modalUser">Lollipop_6</a></td>
								<td><a class="modal-trigger" href="#modalProductInfo">Lucky Luke Collection</a></td>
								<td>500 CHF</td>
								<td>In Verlauf</td>
								<td>
									<select class="starsverkaufen">
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
								</td>
								<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">comment</i></a></td>
							</tr>
						</tbody>
					</table>
				</div>
				
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
							<tr>
								<td>Neu</td>
								<td><a class="modal-trigger" href="#modalUser">Franzfranz</a></td>
								<td><a class="modal-trigger" href="#modalProductInfo">Citroen C3 1.2i</a></td>
								<td>22'650 CHF</td>
								<td>Abgeschlossen</td>
								<td>
									<select class="starskaufen">
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
								</td>
								<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">comment</i></a></td>
							</tr>
							<tr>
								<td>11.11.2017</td>
								<td><a class="modal-trigger" href="#modalUser">Mirkogross</a></td>
								<td><a class="modal-trigger" href="#modalProductInfo">Nikon D300S</a></td>
								<td>580 CHF</td>
								<td>Abgeschlossen</td>
								<td>
									<select class="starskaufen">
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
								</td>
								<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">check</i></a></td>
							</tr>
							<tr>
								<td>11.11.2017</td>
								<td><a class="modal-trigger" href="#modalUser">Friedchicken11</a></td>
								<td><a class="modal-trigger" href="#modalProductInfo">E-Gitarre Stratocaster</a></td>
								<td>140 CHF</td>
								<td>Im Verlauf</td>
								<td>
									<select class="starskaufen">
									  <option value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
								</td>
								<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">comment</i></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
			
		<!-- Modal Structure for User-->
		<div id="modalUser" class="modal">
			<div class="modal-content">
				<h4>HisHerUsername<i class="material-icons icon-star">&nbsp;star star star star star_border</i></h4>
				<br />
				<table>
				  <tr>
					<th>Email Adresse:</th>
					<td><a>hisherusername@pollos.com</a></td>
				  </tr>
				  <tr>
					<th>Total verkaufte Produkte</th>
					<td><a>11</a></td>
				  </tr>
				  <tr>
					<th>Gekaufte Produkte</th>
					<td><a>3</a></td>
				  </tr>
				</table>
			</div>
			<div class="modal-footer">
				<a href="userprof.php" class=" waves-effect waves-teal lighten-2 btn-flat">Profil anzeigen</a>
				<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
			</div>
		</div>
		
		<!-- Modal Structure for Product-->
		<div id="modalProductInfo" class="modal">
			<div class="modal-content">
				<h4>Panasonic LCD TV</h4>
				<div class="clearfix float-my-children">
					<img src="img/products/panasonic.jpg" class="imagepadding">
					<div>
						<p class="DescTitle">Produkt Beschreibung:</p>
						<p class="Description">
						PANASONIC LCD TV 42"(107 cm)<br />
						MODEL:TX-L42E6EK<br />
						BILDSCHIRM DEFEKT<br />
						OHNE FERNBEDIENUNG
						</p>
						<p class="DescPrice">Preis: 200 CHF</p>
						<p class="DescVerkaufer">Verkäufer: <a href="userprof.php">Jellybean61</a></p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
			</div>			
		</div>
		
		<!-- Modal Structure for Comment-->
		<div id="modalComment" class="modal">
			<div class="modal-content">
				<h4>Verkäufer: HisHerUsername<i class="material-icons icon-star">&nbsp;star star star star star_border</i></h4>
				
				<br />
				<p class="Description">Hier kannst du ein Kommentar über der Verkäfer schreiben.</p>
				<br />
					<div class="input-field col s12">
						<textarea id="textarea1" class="materialize-textarea"></textarea>
						<label for="textarea1">Kommentar über das Verkäufer schreiben:</label>
					</div>
			
			</div>
			<div class="modal-footer">
				<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Abbrechen</a>
				<a class=" waves-effect waves-teal lighten-2 btn-flat">Kommentieren</a>
			</div>
			</div>			
		</div>

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

