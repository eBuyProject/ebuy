<?php
	//Function to see you sales

	function my_sell(){
		include('mysql_r_db_connect.php');
		
		//Variables
		$user_id = $_SESSION['id'];
		$date = date('d.m.Y');
		
		//SQL query to find all Sales made by logged in user, loop is needed because there can be multiple entries
		$sql = "SELECT fldStartOffer, fldProduct, fldDescription, fldPrice, fldEnabled, fldImage, fldFkBoughtBy FROM tblProducts WHERE fldFkSoldBy LIKE '$user_id'";	
		$stmt = $handle->query($sql);
		while($rows = $stmt->fetchObject()){
			
			//SQL query to find personal data of buyer 
			$sqll = "SELECT fldIdUser, fldUsername, fldEmail FROM tblUsers WHERE fldIdUser LIKE '$rows->fldFkBoughtBy'";
			$stat = $handle->query($sqll);		
			$row = $stat->fetchObject();
				
			//Auto generated HTML
			echo'<tr><td>';
			if($rows->fldStartOffer == $date){echo 'Neu';}else{echo $rows->fldStartOffer;}
			echo '</td><td>';
			if ($row->fldUsername == NULL){
				echo 'Kein Käufer';
			}
			else{
				echo '<a class="modal-trigger" href="#' . $row->fldUsername . '">' . $row->fldUsername . '</a></td>';
			}
			echo '
				<td><a class="modal-trigger" href="#' . $rows->fldProduct . '">' . $rows->fldProduct . '</a></td>
				<td>' . $rows->fldPrice . ' CHF</td><td>';
				if ($rows->fldEnabled == True){ echo 'Offen';}else{ echo 'Abgeschlossen';}
				echo '
				</td>
					<td>
						<select class="starskaufen">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						</select>
					</td>
					<td class="no-decoration"><a class="modal-trigger" href="#modalComment"><i class="material-icons">comment</i></a></td>
				</tr>
			';
		}
		echo '
			</tbody>
					</table>
				</div>
			</div>
		</div>
		';
		
		//SQL query to find all Sales made by logged in user, loop is needed because there can be multiple entries
		$sql = "SELECT fldStartOffer, fldProduct, fldDescription, fldPrice, fldEnabled, fldImage, fldFkBoughtBy FROM tblProducts WHERE fldFkSoldBy LIKE '$user_id'";	
		$stmt = $handle->query($sql);
		while($rows = $stmt->fetchObject()){
			
			//SQL query to find personal data of buyer 
			$sqll = "SELECT fldIdUser, fldUsername, fldEmail FROM tblUsers WHERE fldIdUser LIKE '$rows->fldFkBoughtBy'";
			$stat = $handle->query($sqll);		
			$row = $stat->fetchObject();
			
			//SQL query to find how many products the buyer  has sold
			$sql_sold = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldFkSoldBy LIKE '$rows->fldFkBoughtBy'";
			$quantitys = $handle -> prepare($sql_sold);
			$quantitys->execute();
			$row_sold = $quantitys->fetchColumn();
			
			//SQL query to find how many products the buyer  has bought
			$sql_boughtd = "SELECT COUNT(fldIdProduct) FROM tblProducts WHERE fldFkBoughtBy LIKE '$rows->fldFkBoughtBy'";
			$quantityb = $handle -> prepare($sql_boughtd);
			$quantityb->execute();
			$row_bought = $quantityb->fetchColumn();
			
			//Auto generated HTML
			echo '
				<div id="' . $row->fldUsername . '" class="modal">
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
				<div id="' . $rows->fldProduct . '" class="modal">
					<div class="modal-content">
						<h4>' . $rows->fldProduct . '</h4>
						<div class="clearfix float-my-children">
							<img src="img/products/' . $rows->fldImage . '" class="imagepadding">
							<div>
								<p class="DescTitle">Produkt Beschreibung:</p>
								<p class="Description">' . $rows->fldDescription . '</p>
								<p class="DescPrice">' . $rows->fldPrice . ' CHF</p>
								<p class="DescVerkaufer">Verkäufer: <a href="userprof.php?user=' . $user_id . '">' . $_SESSION['username'] . '</a></p>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<a class="modal-action modal-close waves-effect waves-teal lighten-2 btn-flat">Schliessen</a>
					</div>			
				</div>
			';
		}
	}
?>