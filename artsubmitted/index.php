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
	
	$uquery2=mysqli_query($conn,"select * from drawing where namesubmittedbyid = '".$_SESSION['id']."'");
	$drawinguser=mysqli_fetch_assoc($uquery2);
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: ../login/index.php");
	}	
	
	
	error_reporting(E_ERROR | E_PARSE);
	$wid=intval($_GET['deleleart']);
	error_reporting();
	
	
	if(isset($_GET['deleleart']))
	{
		
	$wid = $_GET['deleleart'];
	
	$query=mysqli_query($conn,"delete from drawing where id='$wid'");
	
	}
	
	

?>

<?php 

	//GLOBAL VARIABLES
	$globaluserid = "";
	
	$result = mysqli_query($conn,"select * from drawing");
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) 
	while ($row = mysqli_fetch_assoc($result))	{
	if ($row['userbysub'] == $currentuser['username']) {
		
	$globaluserid = $row['namesubmittedbyid'];
			
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
	<link href="../maincss/maincss.css" rel="stylesheet" >
	<link href="../maincss/likeheart.css" rel="stylesheet" >
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
    <title>The Nzro Site</title>
  </head>
  <body>
    
	<?php 
	include('../pagelayout/nav.php');
	?>
	

	
	
 <div class="container px-4 py-5" id="custom-cards">

    <div class="row row-cols-1 row-cols-lg-12 align-items-stretch g-4 py-5">
	
	<?php 
	
	$result = mysqli_query($conn,"select * from drawing where namesubmittedbyid = '".$currentuser['id']."' order by rand(link) limit 1");

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	$pp = '../submittedarts/'.$row["link"];
	
	?> 	

      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-4 shadow-sm" 
		
		style="background: #fff url('<?php echo $pp;?>') center top/cover no-repeat border-box local;">
		
          <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
            <h2 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold hiddenthistwo" style="-webkit-text-stroke: 1px #1a1a1a;"><?php echo $currentuser['username'];?> Stats</h2>
            <ul class="d-flex list-unstyled mt-auto">
              <li class="me-auto">
                <img src="../logo/newn.png" width="32" height="32" >
              </li>
              <li class="d-flex align-items-center p-3">  
				<small style="-webkit-text-stroke: 1px #1a1a1a;" class="display-4">
						Total :
				</small>			  
                <small style="color: #bd4343;" class="display-4 p-3"><i class="bi bi-hand-thumbs-up-fill"></i>
						<?php
							$query2=mysqli_query($conn,"select * from likes where userid='".$_SESSION['username']."'");
							echo mysqli_num_rows($query2);
						?>				
				</small>
				<small style="color: #577aaf;" class="display-4"><i class="bi bi-box2-heart-fill"></i>
						<?php
							$query4=mysqli_query($conn,"select * from favorites where userid='".$_SESSION['username']."'");
							echo mysqli_num_rows($query4);
						?>				
				</small>
              </li>
            </ul>
          </div>
        </div>				
      </div>
	  
	<?php 
	}

	?> 	  
	  
   </div>
  </div>
  
  
  
  

	<div class="container drawingcon">
	<div class="row">
	<h2 class="pb-2 border-bottom"><i class="fa-brands fa-firstdraft"></i> <?php echo $currentuser['username'];?>'s Art</h2> 

	 
	<?php 
	
	$result = mysqli_query($conn,"select * from drawing where namesubmittedbyid = '".$currentuser['id']."'");

	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 
		
	while ($row = mysqli_fetch_assoc($result))	{
	
	$pp = '../submittedarts/'.$row["link"];
	
	?> 	
	
        
		  

			
            <div class="col-md-4 col-6 drawingcard" style="margin-bottom: 10px;">

              <div class="card mb-6 box-shadow shadow-sm">
			  
			  	<td class="col-md-2 close-btn">
				<a style="padding: 10px;" href="index.php?deleleart=<?php echo $row['id'];?>" onClick="return confirm('Are you sure you want to remove <?php echo $row['name']; ?> from your arts submitted?')" class=""><i class="fa fa-times"></i></a>
				</td>
				
                <a href="../view/index.php?view&id=<?php echo $row['id']?>"><img class="card-img-top img-fit-poggers-for-submitted" src = "<?php echo $pp ?>" alt="Card image cap"></a>
				<div class="card-body">
				<h5><p class="card-text" style="text-align: center;"><?php echo $row['name']; ?></p></h5>
				</div>
				
				
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
							$query3=mysqli_query($conn,"select * from favorites where drawingid='".$row['id']."' and userid='".$currentuser['username']."'");
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
			
		
		
		
		
		
	<?php 
	}

	?> 			
	
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