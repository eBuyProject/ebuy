<?php
	session_start();
	
	//Database connection
	
	require_once('php/mysql_r_db_connect.php');
		
	//Site only accessible with a selected product
	if (!isset($_GET['product'])){
		header('Location: index.php');
	}	
	
	//Get data of product out of database	
	
	$id_product = $_GET['product'];
	
	//SQL query to get product data
	$sql = "SELECT fldProduct, fldDescription, fldPrice, fldImage, fldFkSoldBy, fldFkPayment, fldEnabled FROM tblProducts WHERE fldIdProduct LIKE '$id_product'";
	$stmt = $handle->query($sql);
	$row = $stmt->fetchObject();
	
	//SQL query to get seller
	$sql_s = "SELECT fldUsername FROM tblUsers WHERE fldIdUser LIKE '$row->fldFkSoldBy'";
	$stmt_s = $handle->query($sql_s);
	$row_s = $stmt_s->fetchObject();
	
	//SQL query to get payment
	$sql_p = "SELECT fldPayment FROM tblPayment WHERE fldIdPayment LIKE '$row->fldFkPayment'";
	$stmt_p = $handle->query($sql_p);
	$row_p = $stmt_p->fetchObject();
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
			
			
			<!-- Username Dropdown Button -->
			<ul id='dropdownAccount' class='dropdown-content'>
				<li><a href="index.php"><i class="material-icons">home</i>Home</a></li>
				<li><a href="myebuy.php"><i class="material-icons">account_circle</i>My eBuy</a></li>
				<li><a href="sell.php"><i class="material-icons">store</i>Jetzt Verkaufen</a></li>
				<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>
				<!--<li><a href="mybuy.php"><i class="material-icons">shopping_cart</i>Mein Kaufen</a></li>
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
								<a href="buy.php" class="breadcrumb">Kaufen</a>
								<a class="breadcrumb"><?php echo $row->fldProduct; ?></a>
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
							<img class="activator" src="img/products/<?php echo $row->fldImage; ?>">
						</div>
						<div class="card-content">
							<span class="card-title activator grey-text text-darken-4"><?php echo $row->fldProduct; ?><i class="material-icons right">more_vert</i></span>
							<p class="DescVerkaufer">Verkaufer: <a href="userprof.php?user=<?php echo $row->fldFkSoldBy; ?>"><?php echo $row_s->fldUsername; ?></a></p>
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4"><b>Beschreibung:</b><i class="material-icons right">close</i></span>
							<p>
								<?php echo $row->fldDescription; ?>
								<br/>
								<br/>
								<?php echo $row_p->fldPayment; ?>
							</p>
						</div>
					</div>
				</div>
				
				<div class="col center s10 offset-s1">
				<br />
				<br />
					<form action="php/buy.php" method="POST">
						<input type="hidden" name="product" value="<?php echo $_GET['product']; ?>" />
						<?php
							//Display "buy button" if the product is not already bought or if you are not the seller
							if ($row_s->fldUsername == $_SESSION['username']){
								echo 'Sie könnne ihr eigenes Produkt nicht erwerben';
							}
														else if ($row->fldEnabled == true){
								echo '<button class="center btn waves-effect waves-light" type="submit" name="buy">Kauf Bestätigen</button>';
							}
							
							else{
								echo 'Dieses Produkt wurde bereits erworben';
							}
						?>
						<!--<a href="myebuy.php#profile-swipe-2" class="waves-effect waves-light btn"><i class="material-icons right">chevron_right</i>Kauf Bestätigen</a>-->
					</form>
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

