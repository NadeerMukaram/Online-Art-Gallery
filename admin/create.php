<?php

// Include the database configuration file
include '../config/database.php';
$statusMsg = '';

// File upload path
$targetDir = "../submittedarts/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["create"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
	
	$namesubmittedby = $_POST['namesubmittedby'];
	$updateid = $_POST['updateid'];
	$name = $_POST['name'];
	$des = $_POST['detail'];
	
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
			
		$queryUpdate = "INSERT INTO drawing(id, name, link, detail, userbysub) VALUES(null, '$name', '".$fileName."', '$des', '$namesubmittedby');";
		
		$sqlUpdate = mysqli_query($conn, $queryUpdate);
		
            if($sqlUpdate){
                echo '<script>alert"Successfully uploded!")</script>';
				header('location: ../admin/index.php');
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}

?>