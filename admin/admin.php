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
	
  	<?php 
	include('../admin/otheroptions.php');
	?>	
	
  </div>
</div> 


<div class="card mb-4 box-shadow" style="padding:40px;">
 <h2>Admin Credentials</h2>
  




	
	<div class="row" style="margin-bottom: 2%;">
		<div class="col-md-12">
			<div class="row">
			
				<div class="col-md-6">
				<div class="row">
				</div>
				</div>
				
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
						<h4>Name</h4>
						</div>
						<div class="col-md-6">
						<h4>Password</h4>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
						<h4>admin</h4>
						</div>
						<div class="col-md-6">
						<h4>12345</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	</div>
	</div>
  
	
		
		
     
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