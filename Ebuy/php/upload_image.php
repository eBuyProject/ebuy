<?php

	//Source: https://www.php-einfach.de/php-tutorial/dateiupload/
	
	//Function to upload images to server
	function upload_image($_image, $_image_size, $_image_tmp){
	
		$upload_folder = 'img/products/'; //The upload folder
		$filename = pathinfo($_image, PATHINFO_FILENAME);
		$extension = strtolower(pathinfo($_image, PATHINFO_EXTENSION));
			
			
		$max_size = 500*1024; //500 KB
		 
		//Path to upload
		$new_path = $upload_folder.$filename.'.'.$extension;
		 
		//Checks the file extension 
		$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
		if (!in_array($extension, $allowed_extensions)) {
			$_SESSION['form_sell_error'] = 'Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt';
		}
		//Checks the file size
		else if ($_image_size > $max_size) {
			$_SESSION['form_sell_error'] = 'Bitte keine Dateien größer 500KB hochladen';
		}		
		//New file name if the file already exists
		else if(file_exists($new_path)) { //If file exists, append a number to the file name
			
			$id = 1;
			do {
				$new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
				$id++;
			} while(file_exists($new_path));
			move_uploaded_file($_image_tmp, $new_path);
			$filename = $filename.'_'.$id.'.'.$extension;
			return $filename;
		}
		else{
			//All right, move file to new path
			move_uploaded_file($_image_tmp, $new_path);
			$filename = $filename.'.'.$extension;
			return $filename;
		}
	}
?>