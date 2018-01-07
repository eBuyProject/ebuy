<?php
	//funtion to find full ratig of user
	function getRating($id){
		include('mysql_r_db_connect.php');
		
		//Variables
		
		$rating = array();
		
		//SQL query to find Rating FK of user
		$sql = "SELECT fldFkRating FROM tblProducts WHERE fldFkSoldBy LIKE '$id'";
		$stmt = $handle->query($sql);
		while($row = $stmt->fetchObject()){
			//SQL query to find rating of user
			$sql_r = "SELECT fldRating FROM tblRatings WHERE fldIdRating LIKE '$row->fldFkRating'";
			$stmt_r = $handle->query($sql_r);
			while($row_r = $stmt_r->fetchObject()){
				array_push($rating, $row_r->fldRating);
			}
		}
		
		//Get avarage rating
		$avg = (!empty($rating) ? array_sum($rating) / count($rating) : 0);
		
		//Round avarage
		round($avg);
		
		//Show rating
		switch($avg){
			case 1:
				echo'
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>	
				';
				break;
			case 2:
				echo'
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
				';
				break;
			case 3:
				echo'
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
				';
				break;
			case 4:
				echo'
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
				';
				break;
			case 5:
				echo'
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
					<i class="fa fa-star icon-star" aria-hidden="true"></i>
				';
				break;
			default:
				echo'
					<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
					<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
					<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
					<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
					<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
				';
				break;
			
		}
	}
?>