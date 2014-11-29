<?php	
	function validateInput($data) {
		// Strips unnecessary characters.
		$data = trim($data); 
		// Strips slashes.
		$data = stripslashes($data);
		// Converts special characters to HTML entities
		$data  = htmlspecialchars($data);
		return $data;
	}
?>