<?php
	require('../config/database.php');
	
	if(isset($_POST['delete'])) {
		
		$deleteid = $_POST['deleteid'];
		
		$queryDelete = "DELETE FROM drawing WHERE id = $deleteid";
		$sqlDelete = mysqli_query($conn, $queryDelete);
		

		echo '<script>window.location.href= "../admin/index.php"</script>';
	}
	
	if(isset($_POST['deleteuser'])) {
		
		$deleteid = $_POST['deleteid'];
		
		$queryDelete = "DELETE FROM users WHERE id = $deleteid";
		$sqlDelete = mysqli_query($conn, $queryDelete);
		

		echo '<script>window.location.href= "../admin/users.php"</script>';
	}	
	
	
	if(isset($_POST['deletefav'])) {
		
		$deleteid = $_POST['deletedid'];
		
		$queryDelete = "DELETE FROM drawing WHERE id = $deleteid";
		$sqlDelete = mysqli_query($conn, $queryDelete);
		

		echo '<script>window.location.href= "../favorites/index.php"</script>';
	}	
		
	
?>