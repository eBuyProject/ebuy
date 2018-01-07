<?php
	//Function to show search results
	function filter($_search, $_category, $_sort){
		include('mysql_r_db_connect.php');
		
		//Create dynamically OREDER BY
		switch ($_sort){
			case 1:
				$_sort = 'ORDER BY fldIdProduct DESC';
				break;
			case 2:
				$_sort = 'ORDER BY fldPrice ASC';
				break;
			case 3:
				$_sort = 'ORDER BY fldPrice DESC';
				break;
		}
		
		$_search = '%' . $_search . '%';
		
		//Check if such product exists 
		$sql = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldProduct LIKE '$_search'";
		$quantity = $handle -> prepare($sql);
		$quantity->execute();
		$row = $quantity->fetchColumn();
		
		if ($row != 0){
			
			//Check if to search in specific category or in all
			$sql = "SELECT COUNT(fldIdCategory) FROM tblCategorys WHERE fldCategoryShort LIKE '$_category'";
			$quantity = $handle -> prepare($sql);
			$quantity->execute();
			$row = $quantity->fetchColumn();
			
			if ($row == 0){
			
				//SQL query to show the wanted Products
				$sql = "SELECT fldIdProduct, fldProduct, fldPrice, fldImage FROM tblProducts WHERE fldProduct LIKE '$_search' AND fldEnabled <> false $_sort";
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
											echo '<div class="chip"><a href="filter.php?search='.$row_tag->fldTag.'&category=All&sort=1&start_search=Suchen">' . $row_tag->fldTag . '</a></div>';
										}
									}
								echo '</div>
							</div>
							<!-- End of product-->
						</div>
						<!-- End of product content-->
					';
				}	
				echo '
				</div>
			</div>
				';
				
			//SQL query to create modal for shown Products
			$sql = "SELECT fldIdProduct, fldProduct, fldDescription, fldPrice, fldImage, fldFkSoldBy FROM tblProducts WHERE fldProduct LIKE '$_search' AND fldEnabled <> false $_sort";
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
				//Search for entries in specific category
				$sql_cat = "SELECT fldIdCategory FROM tblCategorys WHERE fldCategoryShort LIKE '$_category'";
				$stmt_cat = $handle->query($sql_cat);
				$row_cat = $stmt_cat->fetchObject();
				
				//SQL query to show wanted Products
				$sql = "SELECT fldIdProduct, fldProduct, fldPrice, fldImage FROM tblProducts WHERE fldProduct LIKE '$_search' AND fldFkCategory LIKE '$row_cat->fldIdCategory' AND fldEnabled <> false $_sort";
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
											echo '<div class="chip"><a href="filter.php?search='.$row_tag->fldTag.'&category=All&sort=1&start_search=Suchen">' . $row_tag->fldTag . '</a></div>';
										}
									}
								echo '</div>
							</div>
							<!-- End of product-->
						</div>
						<!-- End of product content-->
					';
				}
				echo '
						</div>
					</div>
				';	
				//SQL query to create modal for shown Products
				$sql = "SELECT fldIdProduct, fldProduct, fldDescription, fldPrice, fldImage, fldFkSoldBy FROM tblProducts WHERE fldProduct LIKE '$_search' $_sort";
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
		}
		else{
			//Search for tags with the same words like the user input
			$sql = "SELECT COUNT(fldIdTag) FROM tblTags WHERE fldTag LIKE '$_search'";
			$quantity = $handle -> prepare($sql);
			$quantity->execute();
			$row = $quantity->fetchColumn();
			
			if ($row != 0){
				//Get ID of Tag
				$sql_tag = "SELECT fldIdTag FROM tblTags WHERE fldTag LIKE '$_search'";
				$stmt_tag = $handle->query($sql_tag);
				$row_tag = $stmt_tag->fetchObject();	
				
				//Get FK of Tag from in between table
				$sql_pro = "SELECT fldFkProduct FROM tblProductsToTags WHERE fldFkTag LIKE '$row_tag->fldIdTag'";
				$stmt_pro = $handle->query($sql_pro);
				$row_pro = $stmt_pro->fetchObject();
				
				//SQL query to show the wanted Products
				$sql = "SELECT fldIdProduct, fldProduct, fldPrice, fldImage FROM tblProducts WHERE fldIdProduct LIKE  '$row_pro->fldFkProduct' $_sort";
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
											echo '<div class="chip"><a href="filter.php?search='.$row_tag->fldTag.'&category=All&sort=1&start_search=Suchen">' . $row_tag->fldTag . '</a></div>';
										}
									}
								echo '</div>
							</div>
							<!-- End of product-->
						</div>
						<!-- End of product content-->
					';
				}
				
				//SQL query to create modal for shown Products
				$sql = "SELECT fldIdProduct, fldProduct, fldDescription, fldPrice, fldImage, fldFkSoldBy FROM tblProducts WHERE fldIdProduct LIKE '$row_pro->fldFkProduct' $_sort";
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
				echo '</div></div>';
				}
			else{
				echo 'Es tut uns leid, aber es konnten keine Produkte mit diesen Suchkriterien gefunden werden</div></div>';
			}
		}
	}
?>