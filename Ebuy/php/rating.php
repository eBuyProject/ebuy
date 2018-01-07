<?php
	if (isset($_POST['do_comment'])){
		$rating = trim(htmlentities($_POST['ddrating']));
		$comment = nl2br(trim(htmlentities($_POST['comment'])));
		$product = trim(htmlentities($_POST['product']));
		
		//Check for dropdown value
		if ($rating != 1 and $rating != 2 and$rating != 3 and$rating != 4 and$rating != 5){
			header('Location: ../myebuy.php#profile-swipe-2');
		}
		//Check if comment is empty
		else if (strlen($comment) == 0){
			header('Location: ../myebuy.php#profile-swipe-2');
		}
		//Check if comment is longer than 500 chars
		else if (strlen($comment > 500) ){
			header('Location: ../myebuy.php#profile-swipe-2');
		}		
		else{
			rating($rating, $comment, $product);
		}
	}
	
	//Function to add rating to database
	function rating($_rating, $_comment, $_product){
		include('mysql_db_connect.php');
		
		//SQL insert query with parameters
		$stmt = $handle -> prepare
		('
			INSERT INTO tblRatings
			(
				fldRating,
				fldComment
			)
			VALUES
			(
				:fldRating,
				:fldComment
			)
		');
		//Reaction on failed insert preparation 
		if ( !$stmt ){
			header('Location: ../myebuy.php#profile-swipe-2');
		}
		//Bind parameters with user input
		else{
			$stmt -> bindParam(':fldRating',     $_rating);
			$stmt -> bindParam(':fldComment',   		$_comment);
			
			//Reaction on failed insert execution
			if ( !$stmt -> execute()){
				header('Location: ../myebuy.php#profile-swipe-2');
			}
			//Successful insert execution
			else{
				$id_rating = $handle->lastInsertId();
				
				//SQL insert query with parameters to insert id of rating to product FK
				$stmt = $handle -> prepare
				('
					UPDATE tblProducts SET 
						fldFkRating = :fldFkRating
					WHERE
						fldIdProduct = :fldIdProduct;
				');
				//Reaction on failed insert preparation 
				if ( !$stmt ){
					header('Location: ../myebuy.php#profile-swipe-2');
				}
				//Bind parameters with user input
				else{
					$stmt -> bindParam(':fldFkRating',     $id_rating);
					$stmt -> bindParam(':fldIdProduct',   		$_product);
					
					//Reaction on failed insert execution
					if ( !$stmt -> execute()){
						header('Location: ../myebuy.php#profile-swipe-2');
					}
					//Successful insert execution
					else{
						header('Location: ../myebuy.php#profile-swipe-2');
					}
				}
			}
		}
	}
?>