<?php
	session_start();
	
	//Database connection
	
	require_once('php/mysql_r_db_connect.php');
	
	//Includes
	
	require_once('php/get_rating.php');
		
	//Site only accessible with a selected user
	if (!isset($_GET['user'])){
		header('Location: userprof.php?user=' . $_SESSION['id']);
	}
	
	//Get data of user out of database	
	
	$id_user = $_GET['user'];
	
	//SQL query to check if user with id X exists 
	$sql_id = "SELECT COUNT(fldIdUSer) FROM tblUsers WHERE fldIdUSer LIKE '$id_user'";
	$quantity_id = $handle -> prepare($sql_id);
	$quantity_id->execute();
	$row_id = $quantity_id->fetchColumn();

	//Check if user exists
	if ($row_id == 0){
		header('Location: userprof.php?user=' . $_SESSION['id']);
	}
	
	//SQL query to get user data
	$sql = "SELECT fldUsername, fldEmail, fldPhone, fldStreet, fldPostcode, fldPlace FROM tblUsers WHERE fldIdUSer LIKE '$id_user'";
	$stmt = $handle->query($sql);
	$row = $stmt->fetchObject();
	
	//SQL query to find how many products the buyer  has sold
	$sql_sold = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldFkSoldBy LIKE '$id_user'";
	$quantitys = $handle -> prepare($sql_sold);
	$quantitys->execute();
	$row_sold = $quantitys->fetchColumn();
	
	//SQL query to find how many products the buyer  has bought
	$sql_boughtd = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldFkBoughtBy LIKE '$id_user'";
	$quantityb = $handle -> prepare($sql_boughtd);
	$quantityb->execute();
	$row_bought = $quantityb->fetchColumn();
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
							<a class="breadcrumb"><?php echo $row->fldUsername; ?></a>
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
						<blockquote class="blocknear">
							<h4>
								<?php echo $row->fldUsername; getRating($id_user);?></h4>
						</blockquote>
					</div>
					
				<div class="col s8">
					<table id="userinformations" class="grey lighten-5">
						<tr>
							<td><b>Email Adresse:</b></td>
							<td><a><?php echo $row->fldEmail; ?></a></td>
						</tr>						
						<tr>
							<td><b>Telefonnummer:</b></td>
							<td><a><?php echo $row->fldPhone; ?></a></td>
						</tr>
						<tr>
							<td><b>Strasse</b></td>
							<td><a><?php echo $row->fldStreet; ?></a></td>
						</tr>						
						<tr>
							<td><b>Stadt</b></td>
							<td><a><?php echo $row->fldPostcode . ', ' . $row->fldPlace; ?></a></td>
						</tr>
						<tr>
							<td><b>Total verkaufte Produkte</b></td>
							<td><a><?php echo $row_sold; ?></a></td>
						</tr>						
						<tr>
							<td><b>Gekaufte Produkte</b></td>
							<td><a><?php echo $row_bought; ?></a></td>
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

