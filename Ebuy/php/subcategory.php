<?php
	//Function to find ID of subcategory through the user input subcategory

	function subcategory($_subcategory){
		include('mysql_r_db_connect.php');
		
		//SQL query to find id of subcategory
		$sql = "SELECT fldIdSubcategory FROM tblSubcategorys WHERE fldSubcategoryShort LIKE '$_subcategory' LIMIT 1";	
		$stmt = $handle->query($sql);
		$row = $stmt->fetchObject();
		
		//return the id
		return $row->fldIdSubcategory;
	}
?>