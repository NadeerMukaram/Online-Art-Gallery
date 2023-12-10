<?php 

	require('../config/database.php');
	
	session_start();

	if (!isset($_SESSION['username']) ||(trim ($_SESSION['username']) == '')) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../index.php');
    exit();
	}
	
	$uquery=mysqli_query($conn,"select * from users where username='".$_SESSION['username']."'");
	$currentuser=mysqli_fetch_assoc($uquery);
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: ../login/index.php");
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
	<link href="../maincss/maincss.css" rel="stylesheet" >
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />	

    <title>The Nzro Site</title>
  </head>
  <body>
    
	<?php 
	include('../pagelayout/nav.php');
	?>
	
	<div class="container drawingcon">
	<div class="row">
	<h2> Search Result</h2>
	<?php
	$conn = mysqli_connect("localhost", "root", "","nzro");

	if($_REQUEST['submit']){
	$name = $_POST['name'];

	if(empty($name)){
	$make = '<h4>You mus type a word to search!</h4>';
	}else{
	$make = '<h4>No match found!</h4>';
	$sele = "SELECT * FROM drawing WHERE name LIKE '%$name%'";
	$result = mysqli_query($conn,$sele);
	
	if($row = mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
	$image = '../submittedarts/'.$row["link"];
	?>	
			
			

            <div class="col-md-4 drawingcard">
              <div class="card mb-4 box-shadow">
                <a href="../view/index.php?view&id=<?php echo $row['id']?>"><img class="card-img-top img-fit-poggers" src = "<?php echo $image; ?>" alt="Card image cap"></a>
                <div class="card-body">
                  <p class="card-text" style="text-align: center;"><?php echo $row['name']; ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
						<a href="../view/index.php?view&id=<?php echo $row['id']?>"><button type="button" class="btn btn-sm btn-outline-dark" name="view">View</button></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
		
		
	<?php 	
	}
	
	}else{
	print ($make);
	}
	mysqli_free_result($result);
	mysqli_close($conn);
	}
	}

	?>		
	
	</div>
	</div>	
			
	<?php 
	include('../pagelayout/footer.php');
	?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>