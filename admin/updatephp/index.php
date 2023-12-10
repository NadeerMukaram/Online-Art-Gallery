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
		if ($user['username'] == $username) {
			array_push($errors, "email already exists");
			echo "<script>alert('email already existed!');  </script>" . count($errors);	
			echo '<script>window.location.href= "../../admin/updatephp/"</script>';
		}
	// Insert New Data
	else{
		
		$query = "UPDATE users, comments, reply 
		SET users.username = '$username', comments.userid = '$username', reply.useridreply = '$username' 
		WHERE users.id = $updateid and comments.useridnumber = $updateid";
		
		mysqli_query($db, $query);
		
		echo '<script>alert("User email successfully updated!")</script>';
		echo '<script>window.location.href= "../../login/"</script>';
		
		
	}
	}

}

?>

<?php 

	//GLOBAL VARIABLES
	$globaluseremail = "";
	$globaluserid = "";
	
	$result = mysqli_query($conn,"select * from users");
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) 
	while ($row = mysqli_fetch_assoc($result))	{
	if ($row['username'] == $currentuser['username']) {
		
	$globaluseremail .= $row['email'];
	$globaluserid = $row['id'];
			
	}
	}
	$globaluseremail2 = $globaluseremail;
	$globaluserid2 = $globaluserid;

?> 
 	


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="../admincss.css" rel="stylesheet">
	
   	<link href="../../maincss/maincss.css" rel="stylesheet" >
	
	<title>Update</title>
	
  </head>
  <body>

	<?php 
	include('../pagelayout_for_user/nav.php');
	?>  

<div class="midcontent col-md-8">

<div class="container-fluid">
<div class="row">
	
		<div class="col-md-4 col-12">
		
	<?php 

	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	if($resultCheck > 0) 	
	while ($row = mysqli_fetch_assoc($result))	{
	$pp = '../../admin/uploads/'.$row["pp"];
	?> 			
	<?php
	if ($row['username'] == $currentuser['username']) {
	?>
        <div class="col">
          <div class="card shadow-sm" style="overflow: hidden;">
            <img class="mt-2 pppoggers" alt="no pic" src="<?php echo $pp ?>"/>
          </div>
        </div>
		
	
	<?php
	}
	?>
	<?php 
	}
	?> 	

	<div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
				
				<form action="upload_pp.php" method="post" enctype="multipart/form-data">
				<input type="file" class="btn btn-sm btn-outline-dark mb-1 p-1" name="file">
				<input type="submit" class="btn btn-sm btn-dark" name="submit" value="Upload">
				<input type="hidden" name="updateiduser" value="<?php echo $globaluserid2 ?>">
				</form>	
				
            </div>
        </div>
        </div>
	</div>



<div class="col-md-8 col-12">
		
<div class="container">

  <h2 >Update Account Details</h2>
  
  <form name="myForm" onsubmit="return validateForm()" class="form-inline" action="../../admin/updatephp/" method="post">
  
    <label  class="mb-2 mr-sm-2">Name: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Update name" name="updateusername" value="<?php echo $currentuser['username'] ?>">
	
	 <input type="hidden" class="form-control mb-2 mr-sm-2"  placeholder="Update Email" name="updateuseremail" value="<?php echo $globaluseremail2 ?>">
	
	<button type="submit" class="btn btn-dark mb-2" name="update" value="Submit">Update</button>
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="updateid" value="<?php echo $globaluserid2 ?>">
	
  </form>
  
    <label class="mb-2 mr-sm-2 mt-2">Email:</label>
	<form action="update_email_user.php" method="post">
	<input type="submit" class="btn btn-sm btn-outline-dark" name="emailedit" value="Edit Email" />
	</form>	 
  
    <label class="mb-2 mr-sm-2 mt-2">Password:</label>
	<form action="update_password_user.php" method="post">
	<input type="submit" class="btn btn-sm btn-outline-dark" name="passwordedit" value="Edit Password" />
	</form>	  

</div>	
		
		
		</div>
	</div>
</div>


</div>

	<?php 
	include('../pagelayout/footer.php');
	?>


<script type="text/javascript">
function validateForm() {
  var x = document.forms["myForm"]["updateusername"].value;
  if (x == "" || x == null) {
    alert("username must be filled out");
    return false;
  }
}
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>