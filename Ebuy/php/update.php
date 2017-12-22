<?php
	//Function to modify personal data entry 

	function update($_first_name, $_last_name, $_username, $_current_password, $_password, $_email, $_phone, $_street, $_postcode, $_place, $_birthday){
		include('mysql_db_connect.php');
		
		//Variables
		
		$username = $_SESSION['username'];
		$user_id = $_SESSION['id'];
		
		//SQL query to check if the password input matches with the one saved in the database 
		$sql = "SELECT fldPassword FROM tblUsers WHERE fldUsername LIKE '$username' LIMIT 1";	
		$stmt = $handle->query($sql);
		$row = $stmt->fetchObject();
		
		//Check if passwor input is correct 
		if ($_current_password == $row->fldPassword){
			
			//SQL query to check if Username already exists
			$sql = "SELECT COUNT(fldIdUser) FROM tblUsers WHERE fldUsername LIKE '$_username' LIMIT 1"; 
			$quantity = $handle -> prepare($sql);
			$quantity->execute();
			$row = $quantity->fetchColumn();
		
			if ($row == 0){
				
				//SQL query to check if E-Mail already exists
				$sql = "SELECT COUNT(fldIdUser) FROM tblUsers WHERE fldEmail LIKE '$_email' LIMIT 1"; 
				$quantity = $handle -> prepare($sql);
				$quantity->execute();
				$row = $quantity->fetchColumn();
				
				if ($row == 0){
					//SQL insert query with parameters 
					$stmt = $handle -> prepare
					('
						UPDATE tblUsers SET 
							fldUsername = :fldUsername,
							fldEmail = :fldEmail,
							fldPassword = :fldPassword,
							fldBirthday = :fldBirthday,
							fldFirstname = :fldFirstname,
							fldLastname = :fldLastname,
							fldPhone = :fldPhone,
							fldStreet = :fldStreet,
							fldPostcode = :fldPostcode,
							fldPlace = :fldPlace
						WHERE 
							fldIdUSer = :fldIdUSer LIMIT 1;
					');
					
					//Error on failed insert preparation
					if ( !$stmt ){
						$_SESSION['form_settings_error'] = '&Auml;nderung konnten nicht gespeichert werden';
					}
					//Binding of parameters with user input
					else{
						$stmt -> bindParam(':fldUsername',  $_username);
						$stmt -> bindParam(':fldEmail',  $_email);
						$stmt -> bindParam(':fldPassword',  $_password);
						$stmt -> bindParam(':fldBirthday',  $_birthday);
						$stmt -> bindParam(':fldFirstname',  $_first_name);
						$stmt -> bindParam(':fldLastname',  $_last_name);
						$stmt -> bindParam(':fldPhone',  $_phone);
						$stmt -> bindParam(':fldStreet',  $_street);
						$stmt -> bindParam(':fldPostcode',  $_postcode);
						$stmt -> bindParam(':fldPlace',  $_place);
						$stmt -> bindParam(':fldIdUSer',  $user_id);
						$stmt -> execute();
						
						//Error on faild binding
						if ( !$stmt -> execute() ){
							$_SESSION['form_settings_error'] = '&Auml;nderung konnten nicht gespeichert werden';
						}
						else{
							header('Location: logout.php');
						}
					}
				}
				else{
					$_SESSION['form_settings_error'] = 'Ein Benutzerprofil mit der E-Mail: ' . $_email . ' ist bereits vorhanden';
				}
			}
			else{
				$_SESSION['form_settings_error'] = 'Ein Benutzerprofil mit dem Username: ' . $_username . ' ist bereits vorhanden';
			}
		}
		else{
			$_SESSION['form_settings_error'] = 'Das eingegebene Passwort ist falsch';
		}
	}
?>