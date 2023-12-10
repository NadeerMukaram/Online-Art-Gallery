<?php 
	require('../config/database.php');
	
	$sort = "DESC";
	$column = "id";
	
	if(isset($_GET['column']) && isset($_GET['sort'])) {
		
	$sort = $_GET['sort'];
	$column = $_GET['column'];
	
	$sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC' ;
	
	}
	
	
	$queryDrawings = "SELECT * FROM likes ORDER BY $column $sort";
	$sqlDrawings = mysqli_query($conn, $queryDrawings);

	
	
?>