<?php
	session_start();
	require('../config/database.php');
	
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../index.php');
	}	
		
	if (isset($_POST['like'])){		
		
		$id = $_POST['id'];
		$query=mysqli_query($conn,"select * from likes where postid='$id' and userid='".$_SESSION['username']."'") or die(mysqli_error());
		
		if(mysqli_num_rows($query)>0){
			mysqli_query($conn,"delete from likes where userid='".$_SESSION['username']."' and postid='$id'");
		}
		else{
			mysqli_query($conn,"insert into likes (userid,postid) values ('".$_SESSION['username']."', '$id')");
		}
	}	
	
	if (isset($_POST['heart'])){		
		
		$id = $_POST['id'];
		$query=mysqli_query($conn,"select * from favorites where drawingid='$id' and userid='".$_SESSION['username']."'") or die(mysqli_error());
		
		if(mysqli_num_rows($query)>0){
			mysqli_query($conn,"delete from favorites where userid='".$_SESSION['username']."' and drawingid='$id'");
		}
		else{
			mysqli_query($conn,"insert into favorites (userid,drawingid) values ('".$_SESSION['username']."', '$id')");
		}
	}	
	
			
?>


