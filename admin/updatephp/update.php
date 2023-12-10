<?php 
	
	require('../../config/database.php');
	
		if(isset($_POST['edit'])) {
		
		$editid = $_POST['editid'];
		$editname = $_POST['editname'];
		$editlink = $_POST['editlink'];
		$editdetail = $_POST['editdetail'];
		
		}
		
		if(isset($_POST['update'])) {
		
		$updateid = $_POST['updateid'];
		$updatename = $_POST['updatename'];
		$updatelink = $_POST['updatelink'];
		$updatedetail = $_POST['updatedetail'];
		
		$queryUpdate = "UPDATE drawing SET name = '$updatename', detail = '$updatedetail', link = '$updatelink' WHERE id = $updateid";
		$sqlUpdate = mysqli_query($conn, $queryUpdate);
		
		
		echo '<script>alert("Successfully Updated!")</script>';
		echo "<script>window.history.go(-2); </script>";

		
		
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

  <h2 class="mt-5" >Update Drawing Details</h2>
  
  <form class="form-inline" action="../../admin/updatephp/update.php" method="post">
  
    <label  class="mb-2 mr-sm-2">Name: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter name" name="updatename" value="<?php echo $editname ?>">
	
    <label class="mb-2 mr-sm-2">Link:</label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter image address" name="updatelink" value="<?php echo $editlink ?>">

    <label class="mb-2 mr-sm-2">Detail:</label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter drawing detail" name="updatedetail" value="<?php echo $editdetail ?>">
 
 
	<button type="create" class="btn btn-primary mb-2" name="update" value="UPDATE">Update</button>
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="updateid" value="<?php echo $editid ?>">
	
  </form>
  
  
</div>	


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>