<?php 
session_start();

$username = "";
$email	  = "";
$pp	  = "";
$errors   = array();

$db = mysqli_connect('localhost', 'root', '', 'nzro');

if (isset($_POST['create'])) {

	$name   = mysqli_real_escape_string($db, $_POST['username']);
	$email	    = mysqli_real_escape_string($db, $_POST['email']);
	$pp 		= mysqli_real_escape_string($db, $_POST['pp']);
	$passworduser = mysqli_real_escape_string($db, $_POST['password']);
	$password = md5($passworduser);

	// checking filled
	if (empty($name)) { 
		array_push($errors, "-Username is required");
	}

	if (empty($email)) {
		array_push($errors, "-Email is required");
	}

	if (empty($password)) {
		array_push($errors, "-Password is required");
	}

	$user_check_query = "SELECT * FROM users WHERE username='$name' OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	// Checking user in database
	if ($user) {
		if ($user['username'] === $name) {
			array_push($errors, "Username already exists");
				echo '<script>alert("Username already existed!")</script>';
		}

		if ($user['email'] === $email) {
			array_push($errors, "Email already exists");
			echo '<script>alert("Email already existed!")</script>';
		}
		
	}
	echo "<script>window.history.go(-1); </script>";

	// Insert New Data
	if (count($errors) == 0) {

		$query = "INSERT INTO users (id, username, email, password, pp) VALUES (null, '$name', '$email', '$password', '$pp')";
		mysqli_query($db, $query);
		
		
		echo '<script>alert("Successfully Createad!")</script>';
		echo '<script>window.location.href= "../admin/users.php"</script>';
	}

}



?>
