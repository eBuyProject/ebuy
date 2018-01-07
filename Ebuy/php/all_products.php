<?php
	//Function to show all Products on the homepage
	function all_products(){
		include('mysql_r_db_connect.php');
		
		//SQL query to show all Products
		$sql = "SELECT fldIdProduct, fldProduct, fldPrice, fldImage FROM tblProducts WHERE fldEnabled <> false";
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
	}
?>