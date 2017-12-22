<?php
	//Function to find ID of Seller

	function soldby($_soldby){
		include('mysql_r_db_connect.php');
		
		//SQL query to find ID of seller
		$sql = "SELECT fldIdUser FROM tblUsers WHERE fldUsername LIKE '$_soldby' LIMIT 1";	
		$stmt = $handle->query($sql);
		$row = $stmt->fetchObject();
		
		return $row->fldIdUser;
	}
?>