<?php
	//Source: http://www.rither.de/a/informatik/php-beispiele/strings/hash-eines-strings-bilden/

	//Function to hash the password
	
	function mySha512($str, $salt, $iterations) {
		for ($x=0; $x<$iterations; $x++) {
			$str = hash('sha512', $str . $salt);
		}
		return $str;
    }
?>
