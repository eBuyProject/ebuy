<?php
	//Function to show all Products on the homepage
	function all_modal_products(){
		include('mysql_r_db_connect.php');
		
		//SQL query to create modal for shown Products
		$sql = "SELECT fldIdProduct, fldProduct, fldDescription, fldPrice, fldImage, fldFkSoldBy FROM tblProducts WHERE fldEnabled <> false";
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
?>