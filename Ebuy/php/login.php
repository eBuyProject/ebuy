<?php
	//Function to login into your account

	function login($_username, $_password){
		include('mysql_r_db_connect.php');
		
		//SQL query to check if username  exists by counting the entry with the same username
		$sql = "SELECT COUNT(fldIdUser) FROM tblUsers WHERE fldUsername LIKE '$_username' LIMIT 1"; 
		$quantity = $handle -> prepare($sql);
		$quantity->execute();
		$row = $quantity->fetchColumn();
		
		//Check 
		if ($row != 0){

			//SQL query to check if password input is korrekt
			$sql = "SELECT fldPassword, fldIdUser FROM tblUsers WHERE fldUsername LIKE '$_username' LIMIT 1";	
			$stmt = $handle->query($sql);
			$row = $stmt->fetchObject();
			
			//Check if input password corresponds with the one saved in the database
			if ($_password == $row->fldPassword){				
				$_SESSION['username'] = $_username;
				$_SESSION['id'] = $row->fldIdUser;
				header('Location: ../index.php');
			}
			else{
				$_SESSION['form_login_error'] = 'Username und/oder Passwort sind inkorrekt';
			}
		}
		else{
			$_SESSION['form_login_error'] = 'Username und/oder Passwort sind inkorrekt';
		}
	}
?>