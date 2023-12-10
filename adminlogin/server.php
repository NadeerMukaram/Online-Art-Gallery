<?php 
session_start();

require('../config/database.php');

if (isset($_POST['reg_user'])) {

	$username   = mysqli_real_escape_string($db, $_POST['usernameadmin']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	// checking filled
	if (empty($username)) { 
		array_push($errors, "-Username is required");
	}

	if ($password_1 != $password_2) {
		array_push ($errors, "-Password you typed doesn't match");
	} 

	if (empty($password_1)) {
		array_push($errors, "-Password is required");
	}

	$user_check_query = "SELECT * FROM admin WHERE username='$username'";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	// Checking user in database
	if ($user) {
		if ($user['usernameadmin'] === $username) {
			array_push($errors, "Username already exists");
		}
	}

	echo "Total error: " . count($errors);

	// Insert New Data
	if (count($errors) == 0) {
		$password = md5($password_1);

		$query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
		mysqli_query($db, $query);
		$_SESSION['usernameadmin'] = $username;
		header('location: ../admin/index.php');
	}

}

// Click Login
if (isset($_POST['login_user_admin'])) {
	$username = mysqli_real_escape_string($db, $_POST['usernameadmin']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}

	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
			$_SESSION['usernameadmin'] = $username;
			header('location: ../admin/index.php');
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

?>