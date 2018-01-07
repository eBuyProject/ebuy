<?php
	session_start();

	//Database connection
	require_once('mysql_r_db_connect.php');

	//Form to buy product
	if (isset($_POST['buy'])){
		$product = trim(htmlentities($_POST['product']));
		
		//SQL query to check if product exists
		$sql = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldIdProduct LIKE '$product' LIMIT 1"; 
		$quantity = $handle -> prepare($sql);
		$quantity->execute();
		$row = $quantity->fetchColumn();
		
		if ($row != 0){
			//SQL query to check if product was already bought
			$sql = "SELECT fldEnabled FROM tblProducts WHERE fldIdProduct LIKE '$product' LIMIT 1"; 
			$stmt = $handle -> prepare($sql);
			$stmt->execute();
			$row = $stmt->fetchObject();
			
			if ($row->fldEnabled == true){
				//SQL query to check if seller is also buyer 
				$sql = "SELECT fldFkSoldBy FROM tblProducts WHERE fldIdProduct LIKE '$product' LIMIT 1"; 
				$stmt = $handle -> prepare($sql);
				$stmt->execute();
				$row = $stmt->fetchObject();
				
				if ($row->fldFkSoldBy == $_SESSION['id']){
					header('Location: ../buy.php?product=' . $product);
				}
				else{
					buy($product);
				}
			}
			else{
				header('Location: ../buy.php?product=' . $product);
			}
		}
		else{
			header('Location: ../buy.php?product=' . $product);
		}
	}
	
	//Function to buy product
	function buy($_id_product){
		include('mysql_db_connect.php');
		
		$date = date('d.m.Y');
		$id_me = $_SESSION['id'];
		$false = false;
		
		//SQL insert query with parameters 
		$stmt = $handle -> prepare
		('
			UPDATE tblProducts SET 
				fldEndOffer = :fldEndOffer,
				fldFkBoughtBy = :fldFkBoughtBy,
				fldEnabled = :fldEnabled
			WHERE 
				fldIdProduct = :fldIdProduct LIMIT 1;
		');
		
		//Error on failed insert preparation
		if ( !$stmt ){
			$_SESSION['form_settings_error'] = '&Auml;nderung konnten nicht gespeichert werden';
		}
		//Binding of parameters with user input
		else{
			$stmt -> bindParam(':fldEndOffer',  $date);
			$stmt -> bindParam(':fldFkBoughtBy',  $id_me);
			$stmt -> bindParam(':fldEnabled',  $false);
			$stmt -> bindParam(':fldIdProduct',  $_id_product);
			
			$stmt -> execute();
			
			//Error on faild binding
			if ( !$stmt -> execute() ){
				$_SESSION['form_buy_error'] = 'Das Produkt konnte nicht gekauft werden';
				header('Location: ../buy.php?product=' . $_id_product);
			}
			else{
				header('Location: ../myebuy.php#profile-swipe-2');
			}
		}
	}
	
	//Form to disable product
	if (isset($_POST['remove'])){
		$product = trim(htmlentities($_POST['product']));
		
		//SQL query to check if product exists
		$sql = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldIdProduct LIKE '$product' LIMIT 1"; 
		$quantity = $handle -> prepare($sql);
		$quantity->execute();
		$row = $quantity->fetchColumn();
		
		if ($row != 0){
			//SQL query to check if product was already bought
			$sql = "SELECT fldEnabled FROM tblProducts WHERE fldIdProduct LIKE '$product' LIMIT 1"; 
			$stmt = $handle -> prepare($sql);
			$stmt->execute();
			$row = $stmt->fetchObject();
			
			if ($row->fldEnabled == true){
				//SQL query to check if seller is also buyer 
				$sql = "SELECT fldFkSoldBy FROM tblProducts WHERE fldIdProduct LIKE '$product' LIMIT 1"; 
				$stmt = $handle -> prepare($sql);
				$stmt->execute();
				$row = $stmt->fetchObject();
				
				if ($row->fldFkSoldBy == $_SESSION['id']){
					remove($product);
				}
				else{
					header('Location: ../buy.php?product=' . $product);
				}
			}
			else{
				header('Location: ../buy.php?product=' . $product);
			}
		}
		else{
			header('Location: ../buy.php?product=' . $product);
		}
	}
	
	//Function to disable product
	function remove($_id_product){
		include('mysql_db_connect.php');
		
		$date = date('d.m.Y');
		$id_me = $_SESSION['id'];
		$false = false;
		
		//SQL insert query with parameters 
		$stmt = $handle -> prepare
		('
			UPDATE tblProducts SET 
				fldEndOffer = :fldEndOffer,
				fldFkBoughtBy = :fldFkBoughtBy,
				fldEnabled = :fldEnabled
			WHERE 
				fldIdProduct = :fldIdProduct LIMIT 1;
		');
		
		//Error on failed insert preparation
		if ( !$stmt ){
			$_SESSION['form_settings_error'] = '&Auml;nderung konnten nicht gespeichert werden';
		}
		//Binding of parameters with user input
		else{
			$stmt -> bindParam(':fldEndOffer',  $date);
			$stmt -> bindParam(':fldFkBoughtBy',  $id_me);
			$stmt -> bindParam(':fldEnabled',  $false);
			$stmt -> bindParam(':fldIdProduct',  $_id_product);
			
			$stmt -> execute();
			
			//Error on faild binding
			if ( !$stmt -> execute() ){
				$_SESSION['form_buy_error'] = 'Das Produkt konnte nicht entfernt werden';
				header('Location: ../buy.php?product=' . $_id_product);
			}
			else{
				header('Location: ../myebuy.php');
			}
		}
	}
?>