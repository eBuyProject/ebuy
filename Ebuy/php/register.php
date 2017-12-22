<?php
	//Function to register a new account

	function register($_salutation, $_first_name, $_last_name, $_username, $_password, $_email, $_phone, $_street, $_postcode, $_place, $_birthday){
		include('mysql_db_connect.php');
		
		//SQL query to check if username alerady exists, by counting the entry with the same username
		$sql = "SELECT COUNT(fldIdUser) FROM tblUsers WHERE fldUsername LIKE '$_username' LIMIT 1"; 
		$quantity = $handle -> prepare($sql);
		$quantity->execute();
		$row = $quantity->fetchColumn();		
		
		if ($row == 0){
			
			//SQL query to check if email already exists, by counting the entry with the same E-Mail
			$sql = "SELECT COUNT(fldIdUser) FROM tblUsers WHERE fldEmail LIKE '$_email' LIMIT 1"; 
			$quantity = $handle -> prepare($sql);
			$quantity->execute();
			$row = $quantity->fetchColumn();
			
			
			if ($row == 0){
				
				//SQL insert query with parameters
				$stmt = $handle -> prepare
				('
					INSERT INTO tblUsers
					(
						fldUsername,
						fldEmail,
						fldPassword,
						fldBirthday,
						fldSalutation,
						fldFirstname,
						fldLastname,
						fldPhone,
						fldStreet,
						fldPostcode,
						fldPlace
					)
					VALUES
					(
						:fldUsername,
						:fldEmail,
						:fldPassword,
						:fldBirthday,
						:fldSalutation,
						:fldFirstname,
						:fldLastname,
						:fldPhone,
						:fldStreet,
						:fldPostcode,
						:fldPlace
					)
				');
				//Error on failed insert preparation 
				if ( !$stmt ){
					$_SESSION['form_register_error'] = 'Benutzerprofil konnte nicht erstellt werden';
					header('Location: ../register.php');
				}
				//Bind parameters with user input
				else{
					$stmt -> bindParam(':fldUsername',     $_username);
					$stmt -> bindParam(':fldEmail',   		$_email);
					$stmt -> bindParam(':fldPassword',   	$_password);
					$stmt -> bindParam(':fldBirthday',   $_birthday);
					$stmt -> bindParam(':fldSalutation',   $_salutation);
					$stmt -> bindParam(':fldFirstname',   $_first_name);
					$stmt -> bindParam(':fldLastname',   $_last_name);
					$stmt -> bindParam(':fldPhone',   $_phone);
					$stmt -> bindParam(':fldStreet',   $_street);
					$stmt -> bindParam(':fldPostcode',   $_postcode);
					$stmt -> bindParam(':fldPlace',   $_place);
					
					//Error on failed insert execution
					if ( !$stmt -> execute()){
						$_SESSION['form_register_error'] = 'Benutzerprofil konnte nicht erstellt werden';
					}
					//Successful insert execution
					else{
						$_SESSION['form_login_error'] = 'Benutzerprofil wurde erfolgreicht erstellt';
						header('Location: ../login.php');
					}
				}
			}
			else{
				$_SESSION['form_register_error'] = 'Ein Benutzerprofil mit der E-Mail: <b>' . $_email . '</b> existiert bereits';
			}
		}
		else{
			$_SESSION['form_register_error'] = 'Ein Benutzerprofil mit dem Username <b>' . $_username . '</b> existiert bereits';
		}
	}
?>