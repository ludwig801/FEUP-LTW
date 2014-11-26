<?php
		
	if(isset($_POST['submit'])) {
	
		$target_dir = "uploads/";
		$target_file = $target_dir . basename ($_FILES['image']['name']);
		$success = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		
		if(isset($_POST['submit'])) {
	
			$check = getimagesize($_FILES['image']['tmp_name']);
			if($check !== false) {
				$success = 1;
			} else {
				$sucess = 0;
			}
		}
		
		if(file_exists($target_file)) {
			$_SESSION['message'] = "File already exists.";
			$success = 0;
		}
		
		if($_FILES['image']['size'] > 50000) {
			$_SESSION['message'] = "File size limit exceeded.";
			$success = 0;
		}
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			$_SESSION['message'] = "Invalid file type.";
			$success = 0;
		}
		
		if($success == 0) {
			header("location: signup.php");
		} else {
			if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
				$_SESSION['message'] = "File uploaded.";
			} else {
				$_SESSION['message'] = "File upload failed.";
				header("location: signup.php");
			}
		}
	
	}

?>