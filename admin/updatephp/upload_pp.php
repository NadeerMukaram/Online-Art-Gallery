<?php
// Include the database configuration file
include '../../config/database.php';
$statusMsg = '';

// File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
	$updateid = $_POST['updateiduser'];
	
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
			
		$queryUpdate = "UPDATE users, comments SET users.pp = '".$fileName."', comments.ppic = '".$fileName."' 
		WHERE users.id = $updateid and comments.useridnumber = $updateid";	
		$sqlUpdate = mysqli_query($conn, $queryUpdate);
		
            if($sqlUpdate){
                echo '<script>alert"Account display picture successfully updated!")</script>';
				echo '<script>window.location.href= "../../admin/updatephp/"</script>';
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