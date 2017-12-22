<?php
	session_start();
	
	//Page only accessible when logged in
	
	if (!isset($_SESSION['username'])){
		header ('Location: index.php');
	}
	
	//Database Connection
	
	require_once('php/mysql_db_connect.php');

	//Includes
	
	require_once('php/category.php');
	require_once('php/subcategory.php');
	require_once('php/soldby.php');
	require_once('php/upload_image.php');
	require_once('php/sell.php');
	
	//Global variables
	
	$product_title = '';
	$price = 0;
	$product_description = '';
	$image = '';
	$terms = 0;
	$all_tags = array();
	$category = 0;
	$soldby = 0;
	$tag_string = '';
	$terms = '';
	$payment = 0;
	
	//Sell Form
	
	if (isset($_POST['sell'])){
		
		$_SESSION['form_sell_error'] = '';
		
		$product_title = trim(htmlentities($_POST['product_title']));
		$price = round(trim(htmlentities($_POST['price'])), 2);
		$product_description = nl2br(trim(htmlentities($_POST['product_description'])));
		$ddcategory = trim(htmlentities($_POST['ddcategory']));
		$ddpayment = trim(htmlentities($_POST['ddpayment']));
		$image = $_FILES['image']['name'];
		$image_size = $_FILES['image']['size'];
		$image_tmp = $_FILES['image']['tmp_name'];
		$tags = nl2br(htmlentities($_POST['tags']));
		$terms = trim(htmlentities($_POST['terms']));
		$beginoffer = date('d.m.Y');
		

		//Add line break at the end of tag string, is needed for the for loop to work
		$tags = $tags . "\n";
		
		//Add single Tag to Tag array ($all_tags)
		for ($i=0; $i<strlen($tags); $i++){
			$tag_char = $tags[$i];
			
			if (strpos($tag_char, "\n") !== false){
				array_push($all_tags, $tag_string);
				
				$tag_string = '';
			}
			else{
				$tag_string = $tag_string . $tag_char;
			}
		}
		
		//Error on empty fields
		if (strlen($product_title) == 0 or strlen($price) == 0 or strlen($product_description) == 0 or strlen($ddcategory) == 0 or strlen($ddpayment) == 0 or strlen($image) == 0){
			$_SESSION['form_sell_error'] = 'Tietel, Preis, Beschreibung, Kategorie, Zahlungsart und Bild müssen ausgefüllt werden';
		}
		//Error on exceed of max fields length
		else if (strlen($product_title) > 45 or strlen($product_description) > 500 or strlen($image) > 500){
			$_SESSION['form_sell_error'] = 'Bitte überschreiten Sie nicht die maximale Feldereingabelänge';
		}
		//Error on non existing category
		else if ($ddcategory != 'Audio' and $ddcategory != 'TV' and $ddcategory != 'Video' and $ddcategory != 'Comics' and $ddcategory != 'Buecher' and $ddcategory != 'PCs' and $ddcategory != 'Apple' and $ddcategory != 'NotebookZubehoer' and $ddcategory != 'Autos' and $ddcategory != 'Motorraeder' and $ddcategory != 'BlueRay' and $ddcategory != 'DVDs' and $ddcategory != 'ActionCam' and $ddcategory != 'Digitalcamera' and $ddcategory != 'Optik' and $ddcategory != 'PCSpiele' and $ddcategory != 'PlaystationSpiele' and $ddcategory != 'Spielkonsolen' and $ddcategory != 'HandysSmartphones' and $ddcategory != 'PrePaidKarten' and $ddcategory != 'Fussball' and $ddcategory != 'Skisport' and $ddcategory != 'Instrumente' and $ddcategory != 'Blasinstrumente' and $ddcategory != 'Goldschmuck' and $ddcategory != 'Uhren' and $ddcategory != 'Edelnsteine'){
			$_SESSION['form_sell_error'] = 'Die Kategorie ' . $ddcategory . ' existiert nicht';
		}
		//Error on non existing payment
		else if ($ddpayment != 1 and $ddpayment != 2){
			$_SESSION['form_sell_error'] = $ddpayment . ' ist keine gültige Zahlungsart';
		}
		//Erro on negativ or 0 price
		else if ($price <= 0){
			$_SESSION['form_sell_error'] = 'Der Preis darf weder Null noch kleiner sein';
		}
		//Error on non numeric price
		else if (!is_numeric($price)){
			$_SESSION['form_sell_error'] = 'Der Preis muss eine Zahl sein';
		}
		else if ($terms !='on'){
			$_SESSION['form_sell_error'] = 'Bitte bestätigen Sie die AGB Richtlinigen (Terms and Conditions)';
		}
		else{
			$category = category($ddcategory);
			$subcategory = subcategory($ddcategory);
			$soldby = soldby($_SESSION['username']);
			$image = upload_image($image, $image_size, $image_tmp);
			sell($product_title, $price, $product_description, $category, $subcategory, $ddpayment, $image, $all_tags, $soldby, $beginoffer);
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
		
		<!-- Materialize -->
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

		<!-- Materialize icons -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
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
					<li><a class="btn-min-width waves-effect waves-light dropdown-button btn" data-activates='dropdownAccount'><?php echo $_SESSION['username']; ?> <i class="material-icons right">account_circle</i></a></li>
				</ul>
			</div>
		</nav>
		
		<!-- Dropdown Button -->
		<ul id='dropdownAccount' class='dropdown-content'>
			<li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
			<li><a href="myebuy.php"><i class="material-icons">account_circle</i>My eBuy</a></li>
			<li><a href="sell.php"><i class="material-icons">store</i>Jetzt Verkaufen</a></li>
			<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>
			<!--<li><a href="mykaufen.php"><i class="material-icons">shopping_cart</i>Mein Kaufen</a></li>
			<li><a href="myverkaufen.php"><i class="material-icons">exit_to_app</i>Mein Verkaufen</a></li>-->
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
							<a href="verkaufen.php" class="breadcrumb">Jetz Verkaufen</a>
						</div>
					</div>
				</nav>
			</div>	
		</div>
		
		<br />
		<br />
		
		<div class="row">
			<div class="input-field col s8 offset-s3">
				<blockquote><h4>Jetzt ein Produkt Verkaufen</h4></blockquote>
			</div>
		</div>
		
		<br />
		
		<div class="row">
			<div class="row">
				<div class="input-field col s5 offset-s3">
					<?php echo $_SESSION['form_sell_error'];?>
				</div>
			</div>
			<form action="sell.php" method="POST" enctype="multipart/form-data" class="col s12">
				<div class="row">
					<div class="input-field col s4 offset-s3">
						<input id="product_title" name="product_title" type="text" data-length="45">
						<label for="product_title">Produkt Titel</label>
					</div>
					<div class="input-field col s2">
						<input id="price" name="price" type="number" min="0" value="0" step="any">
						<label for="price">Preis in CHF</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s5 offset-s3">
						<textarea id="product_description" name="product_description" class="materialize-textarea" data-length="500"></textarea>
						<label for="product_description">Produkt Beschreibung</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s5 offset-s3">
						<select name="ddcategory" id="ddcategory">
							<option value="" disabled selected>Kategorie</option>
							<option value="Audio">Audio</option>
							<option value="TV">TV</option>
							<option value="Video">Video</option>
							<option value="Comics">Comics</option>
							<option value="Buecher">Bücher</option>
							<option value="PCs">PCs</option>
							<option value="">Apple</option>
							<option value="NotebookZubehoer">Notebooks & Zubehör</option>
							<option value="Autos">Autos</option>
							<option value="Motorreader">Motorräder</option>
							<option value="BlueRay">Blue-Ray</option>
							<option value="DVDs">DVDs</option>
							<option value="Action Cam">ActionCam</option>
							<option value="Digitalcamera">Digitalcamera</option>
							<option value="Optik">Optik</option>
							<option value="PCSpiele">PC Spiele</option>
							<option value="PlaystationSpiele">PlayStation Spiele</option>
							<option value="Spielkonsolen">Spielkonsolen</option>
							<option value="HandysSmartphones">Handys / Smartphones</option>
							<option value="PrePaidKarten">PrePaid Karten</option>
							<option value="Fussball">Fussball</option>
							<option value="Skisport">Skisport</option>
							<option value="Instrumente">Instrumente</option>
							<option value="Blasinstrumente">Blasinstrumente</option>
							<option value="Goldschmuck">Goldschmuck</option>
							<option value="Uhren">Uhren</option>
							<option value="Edelsteine">Edelsteine</option>
						</select>
						<label>Kategorie:</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s5 offset-s3">
						<select name="ddpayment" id="ddpayment">
							<option value="" disabled selected>Zahlungsart</option>
							<option value="1">Barzahlung bei Abholung</option>
							<option value="2">Überweisung per Bank / Post</option>
						</select>
						<label>Kategorie:</label>
					</div>
				</div>
				<div class="row">
					<div class="file-field input-field col s5 offset-s3">
						<div class="btn">
							<span>Bild</span>
							<input type="file" name="image" accept="image/*">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Bild hochladen">
						</div>
					</div>
				</div>
				<br />
				<br />
				<div class="row">
					<div class="input-field col s5 offset-s3">
						<textarea id="tags" name="tags" class="materialize-textarea"></textarea>
						<label for="tags">Tags (Ein Tag pro Zeile)</label>
					</div>
				</div>
				<!--<div class="row">
					<div class="col s5 offset-s3">
						<div class="chips chips-placeholder"></div>
					</div>
				</div>-->
				<br />
				<br />
				<div class="row">
					<div class="col s2 offset-s4">
						<button class="btn waves-effect waves-light" type="submit" name="sell">Verkaufen</button>
					</div>
					<div class="col s2">
						<p>
							<input type="checkbox" id="terms" name="terms" required="required"/>
							<label id="ceckTerms" for="terms">I agree to the eBuy <a target="_blank" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Terms & Conditions</a></label>
						</p>
					</div>
				</div>
			</form>
		</div>


		<!-- jQuery -->
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Compiled and minified JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
		<!-- Main JS -->
		<script type="text/javascript" src="js/main.js"></script>
		
		<script type="text/javascript">
		
			$('.chips-placeholder').material_chip({
				data: [{
				  tag: 'Tags eingeben',
				}, {
					tag: 'Fernsehr',
				}, {
				  tag: 'TV',
				}],
			  });		
		</script>

	</body>
</html>
