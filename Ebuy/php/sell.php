<?php
	//Function to create a new Product

	function sell($_product_title, $_price, $_product_description, $_category, $_subcategory, $_payment, $_image, $_all_tags, $_sold_by, $_begin_offer){
		include('mysql_db_connect.php');
		
		//Variables
		$all_tags_id = array();
		$true = true;
		
		//SQL insert query with parameters
		$stmt = $handle -> prepare
				('
					INSERT INTO tblProducts 
					(
						fldProduct,
						fldDescription,
						fldPrice,
						fldImage,
						fldStartOffer,
						fldFkSoldBy,
						fldFkCategory,
						fldFkSubcategory,
						fldFkPayment,
						fldEnabled
					)
					VALUES
					(
						:fldProduct,
						:fldDescription,
						:fldPrice,
						:fldImage,
						:fldStartOffer,
						:fldFkSoldBy,
						:fldFkCategory,
						:fldFkSubcategory,
						:fldFkPayment,
						:fldEnabled
					)
				');
				//Error on failed insert preparation
				if ( !$stmt ){
					$_SESSION['form_sell_error'] = 'Produkt konnte nicht erstellt werden';
				}
				//Bind parameters with user input
				else{
					$stmt -> bindParam(':fldProduct',     $_product_title);
					$stmt -> bindParam(':fldDescription',   		$_product_description);
					$stmt -> bindParam(':fldPrice',   	$_price);
					$stmt -> bindParam(':fldImage',   $_image);
					$stmt -> bindParam(':fldStartOffer',   $_begin_offer);
					$stmt -> bindParam(':fldFkSoldBy',   $_sold_by);
					$stmt -> bindParam(':fldFkCategory',   $_category);
					$stmt -> bindParam(':fldFkSubcategory',   $_subcategory);
					$stmt -> bindParam(':fldFkPayment',   $_payment);
					$stmt -> bindParam(':fldEnabled',   $true);
					
					//Error on failed insert execution
					if ( !$stmt -> execute()){
						$_SESSION['form_sell_error'] = 'Produkt konnte nicht erstellt werden';
					}
					else{
						//Insert single Tag into database entry, does only run if tags are present
						if (count($_all_tags) != 0){
							$last_product_id = $handle->lastInsertId(); //Gets last inserted ID of client
							
							//Loop for SQL insert query to create new entry with single tag
							for ($i=0; $i<count($_all_tags); $i++){
								//SQL insert query with parameters
								$stmt = $handle -> prepare
								('
									INSERT INTO tblTags
									(
										fldTag
									)
									VALUES
									(
										:fldTag
									)
								');
								//Bind parameter with user input tag
								$stmt -> bindParam(':fldTag',     $_all_tags[$i]);
								$stmt -> execute();
								
								
								array_push($all_tags_id, $handle->lastInsertId()); //Adds last inserted ID of Tag in array
							}
							
							//Loop to fill in between table with correspond IDs
							for ($pt=0; $pt<count($all_tags_id); $pt++){
								
								$stmt = $handle -> prepare
								('
									INSERT INTO tblProductsToTags
									(
										fldFkProduct,
										fldFkTag
									)
									VALUES
									(
										:fldFkProduct,
										:fldFkTag
									)
								');
								$stmt -> bindParam(':fldFkProduct',     $last_product_id);
								$stmt -> bindParam(':fldFkTag',     $all_tags_id[$pt]);
								$stmt -> execute();								
							}
							
							header('Location: myebuy.php');
						}
						else{
							header('Location: myebuy.php');
						}
					}
				}
	}
?>