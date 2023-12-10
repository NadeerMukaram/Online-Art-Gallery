<?php
	require('../config/database.php');
	
	if(isset($_POST['create'])) {
		
		$drawingid = $_POST['id'];
		$name = $_SESSION['username'];
		$comments = $_POST['link'];
		
		$queryCreate = "insert into comments values (null, '$drawingid', '$name', '$comments')";
		$sqlCreate = mysqli_query($conn, $queryCreate);
		
		echo '<script>alert("Successfully Createad!")</script>';
		echo '<script>window.location.href= "../admin/index.php"</script>';
		
	}
	
?>