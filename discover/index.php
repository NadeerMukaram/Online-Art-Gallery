<?php 

	session_start();
	error_reporting(0);

	
	require('../config/database.php');
	
	if (!isset($_SESSION['username']) ||(trim ($_SESSION['username']) == '')) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login/index.php');
    exit();
	}
	
	$uquery=mysqli_query($conn,"select * from users where username='".$_SESSION['username']."'");
	$currentuser=mysqli_fetch_assoc($uquery);
	
	
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
	<link href="../maincss/likeheart.css" rel="stylesheet" >
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<title>The Nzro Site</title>
  </head>
  
  
  <body>

	
	
	<?php 
	include('../pagelayout/nav.php');
	?>
	
	
	
  <div class="container px-4 py-5" id="icon-grid">
    <h2 class="pb-2 border-bottom">Welcome to the Nzro Art Community</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#bootstrap"/></svg>
        <div>
		<a href="../discover/" class="nav-link link-dark">
          <h4 class="fw-bold mb-0"><i class="fa-solid fa-house-laptop"></i> Home</h4>
          <p>Paragraph of text beneath the heading to explain the heading.</p>
        </div>
		</a>
      </div>
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#cpu-fill"/></svg>
        <div>
		<a href="./new/" class="nav-link link-dark">
          <h4 class="fw-bold mb-0"><i class="fa-solid fa-plus"></i><i class="fa-solid fa-rectangle-history-circle-plus"></i> New</h4>
          <p>Paragraph of text beneath the heading to explain the heading.</p>
        </div>
		</a>
      </div>
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#calendar3"/></svg>
        <div>
		<a href="./likes/" class="nav-link link-dark">
          <h4 class="fw-bold mb-0"><i class="fa-solid fa-thumbs-up"></i> Most Popular</h4>
          <p>Paragraph of text beneath the heading to explain the heading.</p>
        </div>
		</a>
      </div>
 
    </div>
  </div>

	
	<div class="container drawingcon">
	
	
	<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-9">
				
	<div class="row">
	 
	<?php 
	
	$sql = "SELECT * FROM drawing ORDER BY rand(id) DESC";	
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	$pp = '../submittedarts/'.$row["link"];
	
	?> 	
	
        
		  
            <div class="col-md-4 drawingcard">
			
			
              <div class="card mb-4 box-shadow shadow-sm">
                <a href="../view/index.php?id=<?php echo $row['id']?>"><img class="card-img-top img-fit-poggers" src = "<?php echo $pp ?>" alt="Card image cap"></a>
                <div class="card-body">
                  <h6><p class="card-text" style="text-align: center;"><?php echo $row['name']; ?></p></h6>
                  <div class="d-flex justify-content-center align-items-center">
                    <div class="btn-group-nzro">
					
					<div style="display: flex;justify-content: center;">
					<div class="middlingoptions">

						<?php
							$query1=mysqli_query($conn,"select * from likes where postid='".$row['id']."' and userid='".$_SESSION['username']."'");
							if (mysqli_num_rows($query1)>0){
								?>
                                <button value="<?php echo $row['id']; ?>" class="unlike"></button>
								<?php
							}
							else{
								?>
								<button value="<?php echo $row['id']; ?>" class="like"></button>
								<?php
							}
						?>	

						<span id="show_like<?php echo $row['id']; ?>" style="font-size: 20px; margin-right:10px;">
						<?php
							$query2=mysqli_query($conn,"select * from likes where postid='".$row['id']."'");
							echo mysqli_num_rows($query2);
						?>



					</div>
					<div class="middlingoptions">

						<?php
							$query3=mysqli_query($conn,"select * from favorites where drawingid='".$row['id']."' and userid='".$_SESSION['username']."'");
							if (mysqli_num_rows($query3)>0){
								?>
                                <button value="<?php echo $row['id']; ?>" class="heart"></button>
								<?php
							}
							else{
								?>
								<button value="<?php echo $row['id']; ?>" class="heart_inactive"></button>
								<?php
							}
						?>	

						<span id="showlikeheart<?php echo $row['id']; ?>" style="font-size: 20px; margin-right:10px;">
						<?php
							$query4=mysqli_query($conn,"select * from favorites where drawingid='".$row['id']."'");
							echo mysqli_num_rows($query4);
						?>
								

					</div>
					</div>						
						
                    </div>
						
                  </div>
                </div>
              </div>
			  
			  
            </div>	
	<?php 
	}

	?> 	

	
	
	</div>				
				
				
				</div>
				<div class="col-md-3">

<style>

.img-fit-poggers-related {
    object-fit: scale-down;
	max-height: 20rem;
}

</style>


      <div class="position-sticky hiddenthis" style="top: 3rem;">
        <div class="p-4 rounded">
          <h4>About</h4>
          <p class="mb-0"><strong>Nzro</strong> is a personalized website for my artworks. Add yours as well and participate in the community. I designed and developed it.</p>
        </div>
		
        <div class="p-4">
        <h4>Related Artworks</h4>
		
		<div class="relatedartworksflex d-flex justify-content-center">	
	<?php 
	
	$sql = "SELECT * FROM drawing ORDER BY rand(id) DESC limit 4 offset 0";	
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	$pp = '../submittedarts/'.$row["link"];
	
	?> 		
	<a href="../view/index.php?id=<?php echo $row['id']?>">
        <div class="card shadow-sm">
            <img src = "<?php echo $pp ?>" class="relatedartworks card-img-top img-fit-poggers-related" alt="Card image cap">
		</div>
	</a>	
	<?php 
	}

	?> 		
		</div>
		<div class="relatedartworksflex d-flex justify-content-center">	
	<?php 
	
	$sql = "SELECT * FROM drawing ORDER BY rand(link) ASC limit 4 offset 15";	
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	$pp = '../submittedarts/'.$row["link"];
	
	?> 		
	<a href="../view/index.php?id=<?php echo $row['id']?>">
        <div class="card shadow-sm">
            <img src = "<?php echo $pp ?>" class="relatedartworks card-img-top img-fit-poggers-related" alt="Card image cap">
		</div>
	</a>	
	<?php 
	}

	?> 		
		</div>
		<div class="relatedartworksflex d-flex justify-content-center">	
	<?php 
	
	$sql = "SELECT * FROM drawing ORDER BY rand(name) ASC limit 4 offset 20";	
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	$pp = '../submittedarts/'.$row["link"];
	
	?> 		
	<a href="../view/index.php?id=<?php echo $row['id']?>">
        <div class="card shadow-sm">
            <img src = "<?php echo $pp ?>" class="relatedartworks card-img-top img-fit-poggers-related" alt="Card image cap">
		</div>
	</a>	
	<?php 
	}

	?> 		
		</div>
		
		
        </div>
		
	 
      </div>
    </div>				
				
				</div>
			</div>
		</div>
	</div>
	</div>
	

	</div>	
	
<script type = "text/javascript">
	
      $(document).ready(function(){
		$(document).on('click', '.like', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('like');
          	if($this.hasClass('like')){
				$this.text(''); 
			} else {
				$this.text('');
				$this.addClass("unlike"); 
			}
				$.ajax({
					type: "POST",
					url: "../view/like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
		
		$(document).on('click', '.unlike', function(){
			var id=$(this).val();
			var $this = $(this);
            $this.toggleClass('unlike');
 			if($this.hasClass('unlike')){
				$this.text('');
			} else {
				$this.text('');
				$this.addClass("like");
			}
				$.ajax({
					type: "POST",
					url: "../view/like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
		
	});
	
	function showLike(id){
		$.ajax({
			url: '../view/show_like.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				showlike: 1
			},
			success: function(response){
				$('#show_like'+id).html(response);
				
			}
		});
	}
	
	
	
	
	
	
	
	
      $(document).ready(function(){
		$(document).on('click', '.heart', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('heart');
          	if($this.hasClass('heart')){
				$this.text(''); 
			} else {
				$this.text('');
				$this.addClass("heart_inactive"); 
			}
				$.ajax({
					type: "POST",
					url: "../view/like.php",
					data: {
						id: id,
						heart: 1,
					},
					success: function(){
						showLikeHeart(id);
					}
				});
		});
		
		$(document).on('click', '.heart_inactive', function(){
			var id=$(this).val();
			var $this = $(this);
            $this.toggleClass('heart_inactive');
 			if($this.hasClass('heart_inactive')){
				$this.text('');
			} else {
				$this.text('');
				$this.addClass("heart");
			}
				$.ajax({
					type: "POST",
					url: "../view/like.php",
					data: {
						id: id,
						heart: 1,
					},
					success: function(){
						showLikeHeart(id);
					}
				});
		});
		
	});
	
	function showLikeHeart(id){
		$.ajax({
			url: '../view/show_like.php',
			type: 'POST',
			async: false,
			data:{
				id: id,
				showlikeheart: 1
			},
			success: function(response){
				$('#showlikeheart'+id).html(response);
				
			}
		});
	}
</script>	
	
	<?php 
	include('../pagelayout/footer.php');
	?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>