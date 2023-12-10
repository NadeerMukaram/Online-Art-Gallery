<?php
	session_start();
	require('../config/database.php');
	
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../index.php');
	}	
	
	if (isset($_POST['showlike'])){
		$id = $_POST['id'];
		$query2=mysqli_query($conn,"select * from likes where postid='$id'");
		echo mysqli_num_rows($query2);	
	}
	
	if (isset($_POST['showlikeheart'])){
		$id = $_POST['id'];
		$query3=mysqli_query($conn,"select * from favorites where drawingid='$id'");
		echo mysqli_num_rows($query3);	
	}

?>

