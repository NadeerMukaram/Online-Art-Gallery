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

?>

<?php 

	//GLOBAL VARIABLES
	$globaluserid = "";
	
	$result = mysqli_query($conn,"select * from users");
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) 
	while ($row = mysqli_fetch_assoc($result))	{
	if ($row['username'] == $currentuser['username']) {
		
	$globaluserid .= $row['id'];
			
	}
	}
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
	<link href="../maincss/footer.css" rel="stylesheet" >
	<link href="../maincss/maincss.css" rel="stylesheet" >
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">

    <title>The Nzro Site</title>
	
	<style>
	body  {
	background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/1b02d68f-ba19-4ea6-8fa7-6b3559dc2eec/deq61pq-46539c76-5128-425f-a23d-cd697bcc946b.jpg/v1/fill/w_1280,h_1537,q_75,strp/random__104_by_nadzero_deq61pq-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTUzNyIsInBhdGgiOiJcL2ZcLzFiMDJkNjhmLWJhMTktNGVhNi04ZmE3LTZiMzU1OWRjMmVlY1wvZGVxNjFwcS00NjUzOWM3Ni01MTI4LTQyNWYtYTIzZC1jZDY5N2JjYzk0NmIuanBnIiwid2lkdGgiOiI8PTEyODAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.Xa7rrMNRHsu6xaNtNvvELXLi8G6WnmMpkhyOtQxbISE");	
	background-repeat: no-repeat;
	background-size: contain;
	}
	</style>
  </head>
  
<body class="text-center">
    
<main class="form-signin">

  <form action="../submission/upload_pp.php" method="post" enctype="multipart/form-data">
    <a href="../index.php"><img class="mb-4" src="../logo/newn.png" alt="" style="image-rendering: pixelated;" width="52" height="57"></a>
	
    <h5 class="h1 fw-normal">Submit Art</h5>
	<h5>Upload your creation <?php echo $_SESSION['username'];?>!</h5>

    <div class="form-floating">
      <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter name" name="imagename" id="a">
      <label for="floatingInput">Name:</label>
    </div>
	
	
    <div class="form-floating">
      <textarea type="text" class="form-control mb-2 mr-sm-2" style="height: calc(10.5rem + 2px); line-height: 1.25;" placeholder="Enter image description" name="imagedes" id="b"></textarea>
      <label for="floatingPassword">Description:</label>
    </div>
	
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="namesubmittedby" value="<?php echo $_SESSION['username']; ?>">
	<input type="hidden" class="form-control mb-2 mr-sm-2"  name="namesubmittedbyid" value="<?php echo $globaluserid2; ?>">
	
	<div class="form-floating">
    Select Art to Upload:
    <input type="file" name="file">
	<input type="hidden" name="updateid" value="<?php echo $editid ?>">
	</div>
	
    <button class="w-100 btn btn-lg btn-dark mt-3" type="submit" name="submit">Upload</button>

  </form>
  
</main>
   	
			
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>