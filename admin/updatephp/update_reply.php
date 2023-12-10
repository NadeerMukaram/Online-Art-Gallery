<?php 
	
	require('../../config/database.php');
	
	session_start();
	
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../index.php');
	}	
	
		if(isset($_POST['reply'])) {
		
		$editcomment = $_POST['editcommentreply'];
		$editcommentid = $_POST['editcommentidreply'];
		
		}

		
		if(isset($_POST['update'])){
			
		
		$updatecomment = $_POST['updatecomment'];	
		$updatecommentid = intval($_POST['updatecommentid']);
		
		$queryUpdate = "UPDATE reply SET usercomments = '$updatecomment' where replyid = $updatecommentid";
		$sqlUpdate = mysqli_query($conn, $queryUpdate);
		
		echo "<script>alert('Comment succesfully updated!'); window.history.go(-2); </script>";
	
		
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

  <h2 class="mt-5" >Update Reply Comment</h2>
  
  <form name="myForm" onsubmit="return validateForm()" class="form-inline" action="../../admin/updatephp/update_reply.php" method="post">
	
    <label  class="mb-2 mr-sm-2">Comment: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Update comment" name="updatecomment" value="<?php echo $editcomment ?>"> 
	
	<input type="hidden" class="form-control mb-2 mr-sm-2"  placeholder="Update comment" name="updatecommentid" value="<?php echo $editcommentid ?>"> 
 
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