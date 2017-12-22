<?php
	//Function to see you sales

	function my_buy(){
		include('mysql_r_db_connect.php');
		
		//Variables
		$user_id = $_SESSION['id'];
		$date = date('d.m.Y');
		
		//SQL query to find all purchases made by logged in user, loop is needed because there could be multiple entries
		$sql = "SELECT fldIdProduct, fldEndOffer, fldProduct, fldDescription, fldPrice, fldEnabled, fldImage, fldFkSoldBy, fldFkRating FROM tblProducts WHERE fldFkBoughtBy LIKE '$user_id'";	
		$stmt = $handle->query($sql);
		while($rows = $stmt->fetchObject()){
			
			//SQL query to find personal data of seller 
			$sqll = "SELECT fldIdUser, fldUsername, fldEmail FROM tblUsers WHERE fldIdUser LIKE '$rows->fldFkSoldBy'";
			$stat = $handle->query($sqll);		
			$row = $stat->fetchObject();
				
			//Auto generated HTML
			echo'<tr><td>';
			if($rows->fldEndOffer == $date){echo 'Neu';}else{echo $rows->fldEndOffer;}
			echo '</td><td><a class="modal-trigger" href="#' . $row->fldIdUser . '">' . $row->fldUsername . '</a></td>';
			echo '
				<td><a class="modal-trigger" href="#modalProduct' . $rows->fldIdProduct . '">' . $rows->fldProduct . '</a></td>
				<td>' . $rows->fldPrice . ' CHF</td><td>';
				if ($rows->fldEnabled == True){ echo 'Offen';}else{ echo 'Gekauft';}
				echo '
				</td>';
					if ($rows->fldFkRating == NULL){
						echo'
							<td>
								<form action="php/rating.php" method="POST">
								<select name="ddrating" class="starskaufen">
								  <option value="1">1</option>
								  <option value="2">2</option>
								  <option value="3">3</option>
								  <option value="4">4</option>
								  <option value="5">5</option>
								</select>
							</td>
						';
					}
					else{
						//SQL query to find rating of user
						$sql_r = "SELECT fldRating FROM tblRatings WHERE fldIdRating LIKE '$rows->fldFkRating'";
						$stmt_r = $handle->query($sql_r);		
						$row_r = $stmt_r->fetchObject();
						
						//Show stars 
						switch($row_r->fldRating){
							case 1:
								echo'
									<td>
										<h5>
											<i class="fa fa-star icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
										</h5>
									</td>
								';
								break;
							case 2:
								echo'
									<td>
										<h5>
											<i class="fa fa-star icon-star" aria-hidden="true"></i>
											<i class="fa fa-star icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
										</h5>
									</td>
								';
								break;
							case 3:
								echo'
									<td>
										<h5>
											<i class="fa fa-star icon-star" aria-hidden="true"></i>
											<i class="fa fa-star icon-star" aria-hidden="true"></i>
											<i class="fa fa-star icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
										</h5>
									</td>
								';
								break;
							case 4:
									echo'
										<td>
											<h5>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star-o icon-star" aria-hidden="true"></i>
											</h5>
										</td>
									';
									break;
							case 5:
									echo'
										<td>
											<h5>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
												<i class="fa fa-star icon-star" aria-hidden="true"></i>
											</h5>
										</td>
									';
									break;
							default:
									echo'
										<td>
											<h5>
												<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
												<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
												<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
												<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
												<i class="fa fa-star icon-star-o" aria-hidden="true"></i>
											</h5>
										</td>
									';
									break;
						}
					}
					
					if ($rows->fldFkRating == NULL){
						echo '<td class="no-decoration"><a class="modal-trigger" href="#modalComment' . $rows->fldIdProduct . '"><i class="material-icons">comment</i></a></td>';
					}
					else{
						//SQL query to find rating of user
						$sql_r = "SELECT fldRating FROM tblRatings WHERE fldIdRating LIKE '$rows->fldFkRating'";
						$stmt_r = $handle->query($sql_r);		
						$row_r = $stmt_r->fetchObject();
						echo '<td class="no-decoration"><a class="modal-trigger" href="#modalCommentShow' . $rows->fldIdProduct . '"><i class="material-icons">check</i></a></td>';
					}
			echo '</tr>';
		}
		echo '
			</tbody>
					</table>
				</div>
			</div>
		</div>
		';
		
		//SQL query to find all purchases made by logged in user, loop is needed because there could be multiple entries
		$sql = "SELECT fldIdProduct, fldEndOffer, fldProduct, fldDescription, fldPrice, fldEnabled, fldImage, fldFkSoldBy, fldFkRating FROM tblProducts WHERE fldFkBoughtBy LIKE '$user_id'";	
		$stmt = $handle->query($sql);
		while($rows = $stmt->fetchObject()){
			
			//SQL query to find personal data of buyer 
			$sqll = "SELECT fldIdUser, fldUsername, fldEmail FROM tblUsers WHERE fldIdUser LIKE '$rows->fldFkSoldtBy'";
			$stat = $handle->query($sqll);		
			$row = $stat->fetchObject();
			
			//SQL query to find how many products the seller  has sold
			$sql_sold = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldFkSoldBy LIKE '$rows->fldFkSoldtBy'";
			$quantitys = $handle -> prepare($sql_sold);
			$quantitys->execute();
			$row_sold = $quantitys->fetchColumn();
			
			//SQL query to find how many products the buyer  has bought
			$sql_boughtd = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldFkBoughtBy LIKE '$rows->fldFkSoldtBy'";
			$quantityb = $handle -> prepare($sql_boughtd);
			$quantityb->execute();
			$row_bought = $quantityb->fetchColumn();
			
			//Auto generated HTML
			echo '
				<div id="' . $row->fldIdUser . '" class="modal">
					<div class="modal-content">
						<h4>' . $row->fldUsername . '<i class="material-icons icon-star">&nbsp;star star star star star_border</i></h4>
						<br />
						<table>
						  <tr>
							<th>Email Adresse:</th>
							<td><a>' . $row->fldEmail . '</a></td>
						  </tr>
						  <tr>
							<th>Verkaufte Produkte</th>
							<td><a>' . $row_sold . '</a></td>
						  </tr>
						  <tr>
							<th>Gekaufte Produkte</th>
							<td><a>' . $row_bought . '</a></td>
						  </tr>
						</table>
					</div>
					<div class="modal-footer">
						<a href="userprof.php?user=' . $row->fldIdUser .'" class=" waves-effect waves-teal lighten-2 btn-flat">Profil anzeigen</a>
						<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
					</div>
				</div>
			';
			
			echo '
				<div id="modalProduct' . $rows->fldIdProduct . '" class="modal">
					<div class="modal-content">
						<h4>' . $rows->fldProduct . '</h4>
						<div class="clearfix float-my-children">
							<img src="img/products/' . $rows->fldImage . '" class="imagepadding">
							<div>
								<p class="DescTitle">Produkt Beschreibung:</p>
								<p class="Description">' . $rows->fldDescription . '</p>
								<p class="DescPrice">' . $rows->fldPrice . ' CHF</p>
								<p class="DescVerkaufer">Verkäufer: <a href="userprof.php?user=' . $user_id . '">' . $row->fldIdUser . '</a></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
					</div>			
				</div>
			';
			
			echo '
				<!-- Modal Structure for Comment-->
				<div id="modalComment' . $rows->fldIdProduct . '" class="modal">
					<div class="modal-content">
						<p class="Description">Hinterlasse hier ein Kommentar für den Verkäufer</p>
						<br />
							<div class="input-field col s12">
								<textarea name="comment" id="textarea1" class="materialize-textarea" data-length="500" required="required"></textarea>
								<label for="textarea1">Kommentar</label>
							</div>
							<input type="hidden" name="product" value="' . $rows->fldIdProduct . '" />
					
					</div>
					<div class="modal-footer">
						<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Abbrechen</a>
						<button style="outline:none;border:none;background:transparent;" type="submit" name="do_comment"><a class=" waves-effect waves-teal lighten-2 btn-flat">Kommentieren</a></button>
					</div>
					</form>
				</div>	
			';
			
			//SQL query to find rating comment of user
			$sql_r = "SELECT fldComment FROM tblRatings WHERE fldIdRating LIKE '$rows->fldFkRating'";
			$stmt_r = $handle->query($sql_r);		
			$row_r = $stmt_r->fetchObject();
			
			echo '
				<!-- Modal Structure for Comment-->
				<div id="modalCommentShow' . $rows->fldIdProduct . '" class="modal">
					<div class="modal-content">
						<p class="Description">Kommentar für den Verkäufer</p>
						<br />
							<div class="input-field col s12">'
							. $row_r->fldComment .	
							'</div>
							<input type="hidden" name="product" value="' . $rows->fldIdProduct . '" />
					
					</div>
					<div class="modal-footer">
						<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
					</div>
				</div>	
			';
		}
	}
?>