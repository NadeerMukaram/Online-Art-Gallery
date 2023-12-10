<?php 
	
	require('../../config/database.php');
	
		if(isset($_POST['passwordedit'])) {
			
		$editid = $_POST['editid'];
		$editpassword = $_POST['editpassword'];
		
		}
?>

<?php		
		
		
		
		if(isset($_POST['update'])){
		
		
		$updateid = $_POST['updateid'];
		$updatepassword = md5($_POST['updatepassword']);
		
		
		$sql = "SELECT * FROM users";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if($resultCheck > 0) 	
		while ($row = mysqli_fetch_assoc($result))	{
			
		$queryUpdate = "UPDATE users SET password = '$updatepassword' WHERE id = $updateid";
		$sqlUpdate = mysqli_query($conn, $queryUpdate);
		
		echo '<script>alert("Password successfully updated!")</script>';	
		echo '<script>window.location.href= "../../admin/users.php"</script>';

		
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
  
  <form name="myForm" onsubmit="return validateForm()" class="form-inline" action="../../admin/updatephp/update_password.php" method="post">
	
    <label class="mb-2 mr-sm-2">Password:</label>
    <input type="password" class="form-control mb-2 mr-sm-2"  placeholder="update your password" name="updatepassword" value="">

	<button type="submit" class="btn btn-primary mb-2" name="update" value="Submit">Update</button>
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="updateid" value="<?php echo $editid ?>">
	
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