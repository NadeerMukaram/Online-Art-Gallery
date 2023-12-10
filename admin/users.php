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
	include('./pagelayout/nav_2.php');
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
  </div>
  
    <?php 
	include('../admin/otheroptions.php');
	?>	
  
</div>  


<div class="card mb-4 box-shadow" style="padding:40px;">
  <h2>Add User</h2>
  
  <form class="form-inline" name="Form" onsubmit="return validateForm()" action="../admin/create_user.php" method="post">
  
    <label  class="mb-2 mr-sm-2">Username: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter name" name="username" id="a">
	
    <label class="mb-2 mr-sm-2">Password:</label>
    <input type="password" class="form-control mb-2 mr-sm-2" placeholder="Enter password" name="password" id="b">
	
    <label class="mb-2 mr-sm-2">Email:</label>
    <input type="email" class="form-control mb-2 mr-sm-2"  placeholder="Enter email" name="email" id="c">
	
    <label class="mb-2 mr-sm-2">Display Picture (image address):</label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter image address" name="pp" id="d">	
 
	<button type="create" class="btn btn-dark mb-2" name="create">Create</button>
	
  </form>
</div>

<script type="text/javascript">
  function validateForm() {
    var a = document.forms["Form"]["username"].value;
    var b = document.forms["Form"]["password"].value;
    var c = document.forms["Form"]["email"].value;
    var d = document.forms["Form"]["pp"].value;
    if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "") {
      alert("Please Fill All Required Field");
      return false;
    }
  }
</script>


<h2 class="mt-5" >User</h2>
  
  <hr>
  		
	<div class="container-fluid">
	
	
	<?php 
	$sort = "DESC";
	$column = "id";
	
	if(isset($_GET['columnusers']) && isset($_GET['columnsort'])) {
		
	$sort = $_GET['columnsort'];
	$column = $_GET['columnusers'];
	
	$sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC' ;
	
	}
?>
	
	<div class="row" style="margin-bottom: 2%;">
		<div class="col-md-12">
			<div class="row">
			
				<div class="col-md-6">
				<div class="row">
				
				<div class="col-md-4">
				<h4><a href="?columnusers=id&columnsort=<?php echo $sort ?>" style='color:black; text-decoration: none;'><i class="fa-solid fa-arrows-up-down"></i> ID</a></h4>
				</div>
				
				<div class="col-md-4">
				<h4>Emails</h4>
				</div>				
				
				</div>
				</div>
				
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-6">
						<h4><a href="?columnusers=username&columnsort=<?php echo $sort ?>" style='color:black; text-decoration: none;'><i class="fa-solid fa-arrows-up-down"></i> Name</a></h4>
						</div>
						<div class="col-md-6">
						<h4>Password</h4>
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
  
	<?php 	
	
	$queryUsers = "SELECT * FROM users ORDER BY $column $sort";
	$sqlUsers = mysqli_query($conn, $queryUsers);
	

	
	while($resultsusers = mysqli_fetch_array($sqlUsers))
	{ ?>
	
	<div class="container-fluid mb-5">
	
	<div class="row">
	
		<div class="col-md-6">
		<div class="row">
				<div class="col-md-4">
				<td><?php echo $resultsusers['id'] ?></td>		
				</div>
				<div class="col-md-6" style="overflow:hidden;">
				<td><?php echo $resultsusers['email'] ?></td>		
				</div>
		</div>
		</div>
		
		<div class="col-md-4">
		<div class="row">
				<div class="col-md-6">
				<td><?php echo $resultsusers['username'] ?></td>
				</div>
				<div class="col-md-4" style="overflow:hidden; ">
				<td><?php echo str_repeat("*", strlen($resultsusers['password'])) ?> </td>	
				</div>
		</div>
		</div>
		
		<div class="col-md-2">
			<div class="row">
				<div class="col-md-4">
				
				<form action="../admin/updatephp/update_user.php" method="post">
				<input type="submit" name="edit" value="EDIT" />
				<input type="hidden" name="editid" value="<?php echo $resultsusers['id'] ?>" />
				<input type="hidden" name="editusername" value="<?php echo $resultsusers['username'] ?>" />
				<input type="hidden" name="edituseremail" value="<?php echo $resultsusers['email'] ?>" />
				<input type="hidden" name="editpassword" value="<?php echo $resultsusers['password'] ?>" />
				</form>
				
				</div>
				<div class="col-md-4">
				
				<form action="../admin/delete.php" onClick="return confirm('Are you sure you want to remove this user?')" method="post">
				<input type="submit" name="deleteuser" value="DELETE" />
				<input type="hidden" name="deleteid" value="<?php echo $resultsusers['id'] ?>" />
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