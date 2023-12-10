<?php

// Include the database configuration file
include '../config/database.php';
$statusMsg = '';

// File upload path
$targetDir = "../submittedarts/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
	
	$namesubmittedby = $_POST['namesubmittedby'];
	$namesubmittedbyid = $_POST['namesubmittedbyid'];
	$updateid = $_POST['updateid'];
	$name = $_POST['imagename'];
	$des = $_POST['imagedes'];
	
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
			
		$queryUpdate = "INSERT INTO drawing(id, name, link, detail, userbysub, namesubmittedbyid) VALUES(null, '$name', '".$fileName."', '$des', '$namesubmittedby', '$namesubmittedbyid');";
		
		$sqlUpdate = mysqli_query($conn, $queryUpdate);
		
            if($sqlUpdate){
                echo '<script>alert"Successfully uploded!")</script>';
				header('location: ../discover/index.php');
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