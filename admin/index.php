<?php 
	
	require('../admin/read.php');

	
	session_start();

	if (!isset($_SESSION['usernameadmin'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../adminlogin/index.php');
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
    
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Admin</title>
	
  </head>
  <body>
  
  	<?php 
	include('./pagelayout/nav.php');
	?>
	
	

<div class="container">

<div class="w3-container">
  <h2>Tabs</h2>
</div>


<div class="card mb-4 box-shadow">
  <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <h2><li class="nav-item"><a href="./index.php" class="nav-link active" aria-current="page" style="background-color: #1a1a1a;">Artworks</a></li>
        <li class="nav-item"><a href="./users.php" class="nav-link" style="color: #1a1a1a;">Users</a></li>
        <li class="nav-item"><a href="./admin.php" class="nav-link" style="color: #1a1a1a;">Admins</a></li>
		</h2>
      </ul>
    </header>
	
  	<?php 
	include('../admin/otheroptions.php');
	?>
	
  </div>
</div>  
	
  


<div class="card mb-4 box-shadow" style="padding:40px;">
  <h2>Submit Artworks</h2>
  
  <form class="form-inline" name="Form" onsubmit="return validateForm()" action="../admin/create.php" method="post" enctype="multipart/form-data">
  
    <label  class="mb-2 mr-sm-2">Name: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter name" name="name" id="a">
	
	<label class="mb-2 mr-sm-2">Detail:</label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter detail" name="detail" id="b">
	
	<div class="form-floating">
    Select Art to Upload:
    <input type="file" name="file">
	<input type="hidden" name="updateid" value="<?php echo $editid ?>">
	</div>	
	
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="namesubmittedby" value="<?php echo $_SESSION['usernameadmin']; ?>">
	
	<button type="create" class="btn btn-dark mb-2" name="create">Submit</button>

	
  </form>
</div>
 
<script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["name"].value;
    var b = document.forms["Form"]["link"].value;
    var c = document.forms["Form"]["detail"].value;
    if (a == null || a == "", b == null || b == "", c == null || c == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
</script>

<div class="card mb-4 box-shadow" style="padding:40px;">  
  <h2>List of Artworks</h2>
  <hr>
 
 
	<div class="container-fluid">
	
	<div class="row" style="margin-bottom: 2%;">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2">
				<h4><a href="?column=id&sort=<?php echo $sort ?>" style='color:black; text-decoration: none;'><i class="fa-solid fa-arrows-up-down"></i> ID</a></h4>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-10">
						<h4><a href="?column=name&sort=<?php echo $sort ?>" style='color:black; text-decoration: none;'><i class="fa-solid fa-arrows-up-down"></i> Name</a></h4>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-10">
						<h4>Image</h4>
						</div>
					</div>
				</div>
				<div class="col-md-2 align-middle">
				<h4>Action</h4>
				</div>
			</div>
		</div>
	</div>
	
	</div>
  
	<?php while($results = mysqli_fetch_array($sqlDrawings)) { 
	
	$pp = '../submittedarts/'.$results["link"];
	
	?>
	
	<div class="container-fluid mb-5">
	
	<div class="row">
	
		<div class="col-md-2">
		<td><?php echo $results['id'] ?></td>		
		</div>
		
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-6">
				<td><?php echo $results['name'] ?></td>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-6">
				<td><a href="../view/index.php?id=<?php echo $results['id']?>"><?php echo "<img style='width: 100%; height: 100px; object-fit: scale-down; border: 1px solid #333333;' src = ".$pp." />" ?></a></td>
				</div>
			</div>
		</div>
		
		<div class="col-md-2">
			<div class="row">
				<div class="col-md-4">
				
				<form action="../admin/updatephp/update.php" method="post">
				<input type="submit" name="edit" value="EDIT" />
				<input type="hidden" name="editid" value="<?php echo $results['id'] ?>" />
				<input type="hidden" name="editname" value="<?php echo $results['name'] ?>" />
				<input type="hidden" name="editlink" value="<?php echo $results['link'] ?>" />
				<input type="hidden" name="editdetail" value="<?php echo $results['detail'] ?>" />
				</form>
				
				</div>
				<div class="col-md-4">

				<form action="../admin/delete.php" onClick="return confirm('Are you sure you want to remove this drawing?')" method="post">
				<input type="submit" name="delete" value="DELETE" />
				<input type="hidden" name="deleteid" value="<?php echo $results['id'] ?>" />
				</form>				
				
				</div>
			</div>
		</div>
	</div>
	</div>	
		
		
	<?php } ?>
		
     
    </table>

</div>



  
</div>	







	<?php 
	include('./pagelayout/footer.php');
	?>





	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>