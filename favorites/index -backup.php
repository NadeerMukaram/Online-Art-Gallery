<?php 

	require('../config/database.php');
	
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login/index.php');
	}
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: ../login/index.php");
	}	
	
	
	error_reporting(E_ERROR | E_PARSE);
	
	$wid=intval($_GET['del']);
	error_reporting();
	if(isset($_GET['del']))
	{
	$query=mysqli_query($conn,"delete from favorites where id='$wid'");
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
	<h2 class="pb-2 border-bottom"><?php echo $_SESSION['username'];?>'s Favorites</h2> 

	 
	<?php 
	
	$result = mysqli_query($conn,"select drawing.detail as detail, drawing.name as name, drawing.link as link, favorites.drawingid as id, 
						favorites.id as wid from favorites join drawing on drawing.id=favorites.drawingid where favorites.userid='".$_SESSION['username']."'");

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	?> 	
	
        
		  

			
            <div class="col-md-6 drawingcard" style="margin-bottom: 10px;">

              <div class="card mb-6 box-shadow">
			  
			  	<td class="col-md-2 close-btn">
				<a style="padding: 10px;" href="index.php?del=<?php echo htmlentities($row['wid']);?>" onClick="return confirm('Are you sure you want to remove <?php echo $row['name']; ?> as your favorite?')" class=""><i class="fa fa-times"></i></a>
				</td>
				
                <a href="../view/index.php?view&id=<?php echo $row['id']?>"><img class="card-img-top img-fit-poggers-for-favorites" src = "<?php echo $row['link']; ?>" alt="Card image cap"></a>
				<div class="card-body">
				<h5><p class="card-text" style="text-align: center;"><?php echo $row['name']; ?></p></h5>
				</div>
              </div>
			  
            </div>
			
		
		
		
		
		
	<?php 
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