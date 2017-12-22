<?php
	//MySQL Database connection read rights

	try{
		$handle = new PDO('mysql:host=localhost;dbname=dbEbuy;charset=utf8', 'ebuyR', 'Engadin1');
		$handle -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch(PDOException $e){
		// echo $e -> getMessage();
		exit('Verbindung zur Datenbank fehlgeschlagen!');
	}
?>