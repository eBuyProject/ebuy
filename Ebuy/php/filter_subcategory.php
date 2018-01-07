<?php
	//Function to show only specific subcategory entries
	function filter_subcategory($_subcategory){
		include('mysql_r_db_connect.php');
		
		//Check if such subcategory exists 
		$sql = "SELECT COUNT(fldIdSubcategory) FROM tblSubcategorys WHERE fldSubcategoryShort LIKE '$_subcategory'";
		$quantity = $handle -> prepare($sql);
		$quantity->execute();
		$row = $quantity->fetchColumn();
		
		if ($row != 0){
			//Get Id of subcategory
			$sql_sub = "SELECT fldIdSubcategory FROM tblSubcategorys WHERE fldSubcategoryShort LIKE '$_subcategory'";
			$stmt_sub = $handle->query($sql_sub);
			$row_sub = $stmt_sub->fetchObject();
			
			//SQL query to show the wanted Products
			$sql = "SELECT fldIdProduct, fldProduct, fldPrice, fldImage FROM tblProducts WHERE fldFkSubcategory LIKE '$row_sub->fldIdSubcategory' AND fldEnabled <> false";
			$stmt = $handle->query($sql);
			while($row = $stmt->fetchObject()){
				//Auto generated HTML for display Products
				echo '
					<!-- Begin of product content-->
					<div class="col m6">
						<!-- Beginn of product-->
						<div class="card">
							<div class="card-image">
								<img src="img/products/' . $row->fldImage . '">							
								<a class="btn-floating halfway-fab waves-effect waves-light red modal-trigger" href="#' . $row->fldIdProduct . '"><i class="material-icons">add</i></a>
							</div>
							<div class="card-content center">
								<p>' . $row->fldProduct . '</p>
								<h4>' . $row->fldPrice . ' CHF</h4>
								<br/>';
								
								//SQL query to get FK of Tag
								$sql_fk_tag = "SELECT fldFkTag FROM tblProductsToTags WHERE fldFkProduct LIKE '$row->fldIdProduct'";
								$stmt_fk_tag = $handle->query($sql_fk_tag);
								while($row_fk_tag = $stmt_fk_tag->fetchObject()){
									
									//SQL query to get Tag
									$sql_tag = "SELECT fldTag FROM tblTags WHERE fldIdTag LIKE '$row_fk_tag->fldFkTag'";
									$stmt_tag = $handle->query($sql_tag);
									while($row_tag = $stmt_tag->fetchObject()){
										echo '<div class="chip">' . $row_tag->fldTag . '</div>';
									}
								}
							echo '</div>
						</div>
						<!-- End of product-->
					</div>
					<!-- End of product content-->
				';
			}	
			echo '</div></div>';
			
			//SQL query to create modal for shown Products
			$sql = "SELECT fldIdProduct, fldProduct, fldDescription, fldPrice, fldImage, fldFkSoldBy FROM tblProducts WHERE fldFkSubcategory LIKE '$row_sub->fldIdSubcategory' AND fldEnabled <> false";
			$stmt = $handle->query($sql);
			while($row = $stmt->fetchObject()){
				//SQL query to get seller
				$sql_seller = "SELECT fldUsername FROM tblUsers WHERE fldIdUser LIKE '$row->fldFkSoldBy'";
				$stmt_seller = $handle->query($sql_seller);
				while($row_seller = $stmt_seller->fetchObject()){
					//Auto generated HTML for display Products
					echo '
						<div id="' . $row->fldIdProduct . '" class="modal">
							<div class="modal-content">
								<h4>' . $row->fldProduct . '</h4>
								<div class="clearfix float-my-children">
									<img src="img/products/' . $row->fldImage . '" class="imagepadding">
									<!-- Modal details container-->
									<div>
										<p class="DescTitle">Produkt Beschreibung:</p>
										<p class="Description">' . $row->fldDescription . '</p>
										<p class="DescPrice">
										Preis: ' . $row->fldPrice . ' CHF
										</p>
										<!-- Buy informations button/link-->
										<div>
											<a href="buy.php?product=' . $row->fldIdProduct . '" class="waves-effect waves-light btn">Jetzt Kaufen</a>
											<p class="DescVerkaufer">Verkaufer: <a href="userprof.php?user=' . $row->fldFkSoldBy . '">' . $row_seller->fldUsername . '</a></p>
										</div>
										<!-- End of buy informations-->
									</div>
									<!-- End of details container-->
								</div>
								<!-- Modal bottom button-->
							</div>
							<div class="modal-footer">
								<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
							</div>
							<!-- End of bottom button-->
						</div>
						<!-- End of modal-->
					';
				}
			}
		}
		else{
			echo 'Die Unterkategorie' . $_subcategory . ' existiert nicht';
		}
	}
?>