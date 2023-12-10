<?php	

// you need to comment first to change your profile picture or name bug.
// this code will fixed the error but the database will be a mess.

	if (isset($_SESSION['username'])) {
	
	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 	
	while ($row = mysqli_fetch_assoc($result))	{
		
	if ($row['username'] == $_SESSION['username']) {

	
		$id = 10000000;
		$name = $_SESSION['username'];	
		$comments = 'forbugfixing';
		$pp = 'forbugfixing';
		$useridnumber = $row['id'];
		
		
		$comments2 = str_replace("'", "\'", $comments);
		
		$queryCreate = "insert into comments values (null, '$id', '$name', '$useridnumber', '$comments2', '$pp', NOW())";
		$sqlCreate = mysqli_query($conn, $queryCreate);
		
		

	}

	}
	
	}
	
?>