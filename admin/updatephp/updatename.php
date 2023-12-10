<?php 
	
	require('../../config/database.php');
	
	session_start();
	
	if (!isset($_SESSION['username']) ||(trim ($_SESSION['username']) == '')) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../index.php');
    exit();
	}

	$uquery=mysqli_query($conn,"select * from users where username='".$_SESSION['username']."'");
	$currentuser=mysqli_fetch_assoc($uquery);
?>

<?php 
$username = "";
$email	  = "";
$errors   = array();

$db = mysqli_connect('localhost', 'root', '', 'nzro');

if (isset($_POST['update'])) {

	$username   = mysqli_real_escape_string($db, $_POST['updateusername']);
	$updateid = $_POST['updateid'];

	// checking filled
	if (empty($username)) { 
		array_push($errors, "-Username is required");
	}



	$user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	// Checking user in database
	if ($user) {
		if ($currentuser['username'] === $username) {

		
		$query = "UPDATE users, comments, reply, drawing 
		SET users.username = '$username', comments.userid = '$username', reply.useridreply = '$username', drawing.userbysub = '$username'
		WHERE users.id = $updateid and comments.useridnumber = $updateid and reply.useridreplyid = $updateid and drawing.namesubmittedbyid = $updateid";
		
		mysqli_query($db, $query);
		
		echo '<script>alert("Account setting successfully updated! Please re-login!")</script>';
		echo '<script>window.location.href= "../../login/index.php"</script>';
		
		
	}
	}

}

?>
