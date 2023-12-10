<?php 
	
	require('../../config/database.php');
	
		if(isset($_POST['edit'])) {
		
		$editid = $_POST['editid'];
		$editusername = $_POST['editusername'];
		$editpassword = md5($_POST['editpassword']);
		$edituseremail = $_POST['edituseremail'];
		
		}
?>


<?php 
$username = "";
$email	  = "";
$errors   = array();

$db = mysqli_connect('localhost', 'root', '', 'nzro');

if (isset($_POST['update'])) {

	$username   = mysqli_real_escape_string($db, $_POST['updateusername']);
	$email	    = mysqli_real_escape_string($db, $_POST['updateuseremail']);
	$updateid = $_POST['updateid'];

	// checking filled
	if (empty($username)) { 
		array_push($errors, "-Username is required");
	}

	if (empty($email)) {
		array_push($errors, "-Email is required");
	}


	$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	// Checking user in database
	if ($user) {
		if ($user['username'] === $username) {
			array_push($errors, "Username already exists");
			echo "<script>alert('Username already existed!'); window.history.go(-1); </script>" . count($errors);	
		}
	// Insert New Data
	else{
		
		$query = "UPDATE users, comments, reply, drawing 
		SET users.username = '$username', users.email = '$email', comments.userid = '$username', reply.useridreply = '$username', drawing.userbysub = '$username'
		WHERE users.id = $updateid and comments.useridnumber = $updateid and reply.useridreplyid = $updateid and drawing.namesubmittedbyid = $updateid";
		
		mysqli_query($db, $query);
		
		echo '<script>alert("Successfully Updated!")</script>';
		echo '<script>window.location.href= "../../admin/users.php"</script>';
		
		
	}
	}

}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="admincss.css" rel="stylesheet">
    
	<title>Update</title>
	
  </head>
  <body>
  

<div class="container">

  <h2 class="mt-5" >Update User Details</h2>
  
  <form name="myForm" onsubmit="return validateForm()" class="form-inline" action="../../admin/updatephp/update_user.php" method="post">
  
    <label  class="mb-2 mr-sm-2">Name: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Update name" name="updateusername" value="<?php echo $editusername ?>"> 
	
	
    <label class="mb-2 mr-sm-2">Email:</label>
    <input type="email" class="form-control mb-2 mr-sm-2"  placeholder="Update Email" name="updateuseremail" value="<?php echo $edituseremail ?>">

 
	<button type="submit" class="btn btn-primary mb-2" name="update" value="Submit">Update</button>
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="updateid" value="<?php echo $editid ?>">
	
  </form>
  
  
   <label class="mb-2 mr-sm-2">Password:</label>
	<form action="update_password.php" method="post">
	<input type="submit" name="passwordedit" value="Edit Password" />
	<input type="hidden" name="editpassword" value="" />
	<input type="hidden" name="editid" value="<?php echo $editid ?>">
	</form>	
  
</div>	

<script type="text/javascript">
function validateForm() {
  var x = document.forms["myForm"]["updatepassword"].value;
  if (x == "" || x == null) {
    alert("password must be filled out");
    return false;
  }
}
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>