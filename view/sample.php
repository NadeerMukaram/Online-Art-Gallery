<?php 

	require('../config/database.php');
	
	include '../admin/functions.php';
	
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
	
	
	if(isset($_POST['create'])) {
		
		$id = $_GET['id'];
		$name = $_SESSION['username'];	
		$comments = $_POST['comment'];
		$pp = $_POST['editpp'];
		$useridnumber = $_POST['edituseridnumber'];
		
		$comments2 = str_replace("'", "\'", $comments);
	
		$queryCreate = "insert into comments values (null, '$id', '$name', '$useridnumber', '$comments2', '$pp', NOW())";
		$sqlCreate = mysqli_query($conn, $queryCreate);
		
		echo "<script>window.history.go(-1); </script>";	
		
		
	}
	
	if(isset($_POST['reply'])) {
		
		
		$commentidnumber = $_POST['commentid'];
		$commentername = $_SESSION['username'];	
		$commentreply = $_POST['commenterreply'];
		$commenterpp = $_POST['commenterpp'];
		$useridreplyid = $_POST['userglobalid'];
		
		$comments2 = str_replace("'", "\'", $commentreply);
	
		$queryCreate = "insert into reply values (null, '$commentidnumber', '$commentername', '$useridreplyid', '$comments2', NOW())";
		$sqlCreate = mysqli_query($conn, $queryCreate);
		
		echo "<script>window.history.go(-1); </script>";	
		
		
	}
	
	
	
	error_reporting(E_ERROR | E_PARSE);
	$wid=intval($_GET['del']);
	error_reporting();
	if(isset($_GET['del']))
	{
	$query=mysqli_query($conn,"delete from comments where id='$wid'");
	
	echo "<script>window.history.go(-1); </script>";
	
	}
	
	error_reporting(E_ERROR | E_PARSE);
	$widreply=intval($_GET['delreply']);
	error_reporting();
	if(isset($_GET['delreply']))
	{
	$query=mysqli_query($conn,"delete from reply where replyid='$widreply'");
	
	echo "<script>window.history.go(-1); </script>";
	
	}	
	
		
	if(isset($_GET['pid'])){
	mysqli_query($conn,"insert into favorites(userid,drawingid) values('".$_SESSION['username']."','".$_GET['pid']."')");
	
	echo "<script>alert('Favorite added');</script>";
	echo "<script>window.history.go(-1); </script>";
	}
?>

<?php 

	//GLOBAL VARIABLES
	$globaluserid = "";
	
	$result = mysqli_query($conn,"select * from users");
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) 
	while ($row = mysqli_fetch_assoc($result))	{
	if ($row['username'] == $_SESSION['username']) {
		
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
	<link href="../maincss/maincss.css" rel="stylesheet" >
	
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<title>The Nzro Site</title>
  </head>
  <body>
  
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="ODDYEbwc"></script>
    
	<?php 
	include('../pagelayout/nav.php');
	?>
	
	<div class="container drawingcon">
	<div class="row">
	

<?php
 if(isset($_GET['id'])){
    $drawing_id = $_GET['id']; 
     
        $sql = " select * from drawing where id = '$drawing_id'    ";
		
                $result = mysqli_query($conn,$sql); 

                 while($row = mysqli_fetch_array($result)){
                      $image = '../submittedarts/'.$row["link"];

                          
                     
?>


<style>

.like {
   background-image: url(like_nzro.png);
    background-color: white;
    background-repeat: no-repeat; 
    background-position: 4px 5px;
    border: none;           
    cursor: pointer;       
	height: 64px;
    padding-left: 46px;
    vertical-align: middle;
    color: hsl(0deg 0% 19%);	
    border-color: hsl(0, 0%, 60%);
    background-size: 40px 40px;
    font-size: 20px;
 
}

.unlike {
 background-image: url(like_nzro_alt_v1.png);
    background-color: white;
    background-repeat: no-repeat; 
    background-position: 4px 6px;
    border: none;           
    cursor: pointer;       
	height: 64px;
    padding-left: 46px;
    vertical-align: middle;
    color: hsl(224deg 40% 37%);
    border-color: hsl(0, 0%, 60%);
    background-size: 40px 40px;
    font-size: 20px;

}

.vote {
    background-image: url(upvote_inactive.png);
    background-color: white;
    background-repeat: no-repeat;
    background-position: 0px;
    border: none;
    cursor: pointer;
    height: 34px;
    padding-left: 18px;
    vertical-align: middle;
    color: hsl(0deg 0% 19%);
    border-color: hsl(0, 0%, 60%);
    background-size: 20px 20px;
    font-size: 20px;
}


.unvote {
 background-image: url(upvote_active.png);
    background-color: white;
    background-repeat: no-repeat;
    background-position: 0px;
    border: none;
    cursor: pointer;
    height: 34px;
    padding-left: 18px;
    vertical-align: middle;
    color: hsl(0deg 0% 19%);
    border-color: hsl(0, 0%, 60%);
    background-size: 20px 20px;
    font-size: 20px;

}
	
	

</style>


	
<div class="card drawingcard centerview" style="width:100%;">
  <a href="<?php echo $image; ?>"><img class="card-img-top img-fit-poggers-view" src="<?php echo $image; ?>" alt="Card image cap"></a>
  <div class="card-body-for-view">
	
  	<h5><p class="card-text" style="text-align:center; width:50%; display:block; margin:auto;">from: <span style="color:#F05454;"><?php echo $row['userbysub']; ?></span> </p></h5>
	<hr style="margin: 1rem 10rem;">
	<h3><p class="card-text" style="text-align: center;"><?php echo $row['name']; ?></p></h3>
	<hr>
	<div class="card mb-3 box-shadow">
    <p class="card-text" style="text-align: center;"><?php echo $row['detail']; ?></p>
	</div>
</div>
 
					<div class="middlingoptions" >
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
								
								
						<span id="show_like<?php echo $row['id']; ?>" style="font-size: 20px;">
						<?php
							$query3=mysqli_query($conn,"select * from likes where postid='".$row['id']."'");
							echo mysqli_num_rows($query3);
						?>
						</span>
					
					</div>
 
<a href="../view/index.php?pid=<?php echo $row['id']?>" onClick="return confirm('Are you sure you want to add <?php echo $row['name']; ?> as your favorite?')" title="Favorites">
<div class="middlingoptions" >
<button style="margin-bottom:5px; padding:5px 30px;" type="button" class="btn btn-lg btn-outline-danger">
<i class="fa-solid fa-heart-circle-plus" style="color: #000000;"></i>
</button>
</a>
</div>


					<hr>




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
					url: "like.php",
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
					url: "like.php",
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
			url: 'show_like.php',
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
	
</script>





<div class="card mb-6 mt-5 box-shadow">
<div class="card-body">
  <form class="form-inline " action="index.php?id=<?php echo $row['id']?>" method="post">

  	<h3>@<?php echo $_SESSION['username'] ?>
    <label  class="mb-2 mr-sm-2"></label>
    <textarea type="text" class="form-control mb-2 mr-sm-2" cols="80" rows="5" placeholder="write a comment" name="comment"></textarea>
	<?php 

	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 	
	while ($row = mysqli_fetch_assoc($result))	{
	?> 				
	<?php
	if ($row['username'] == $_SESSION['username']) {
	?>
	<input type="hidden" name="edituseridnumber" value="<?php echo $row['id'] ?>" />	
	<input type="hidden" name="editpp" value="<?php echo $row['pp'] ?>" />	
	<?php
	}
	?>
	<?php 
	}
	?> 	
	
	<button type="create" class="btn btn-dark mb-2" name="create">Publish</button>

  </form>
</div>
</div>
		  


<script type = "text/javascript">
        $(document).ready(function(){
		$(document).on('click', '.vote', function(){
			var id=$(this).val();
			var $this = $(this);
			$this.toggleClass('vote');
          	if($this.hasClass('vote')){
				$this.text(''); 
			} else {
				$this.text('');
				$this.addClass("unvote"); 
			}
				$.ajax({
					type: "POST",
					url: "like.php",
					data: {
						id: id,
						like: 1,
					},
					success: function(){
						showLike(id);
					}
				});
		});
		
		$(document).on('click', '.unvote', function(){
			var id=$(this).val();
			var $this = $(this);
            $this.toggleClass('unvote');
 			if($this.hasClass('unvote')){
				$this.text('');
			} else {
				$this.text('');
				$this.addClass("vote");
			}
				$.ajax({
					type: "POST",
					url: "like.php",
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
			url: 'show_like.php',
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
	
</script>

<h5><p class="card-text mt-5" style="text-align: left;">COMMENTS:</p></h5>

<div class="my-3 mb-2 bg-body rounded shadow-sm">
 
	<div class="dropdown text-start">
	<a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="bi bi-caret-down-fill" style="color: #fb0000;"></i>
	</a>
	<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
    <li><a class="dropdown-item" href="index.php?del=<?php echo $row['id'];?>">Delete Comment</a></li>
	
	<li>
	<a class="dropdown-item" href="#">
	
	<form action="../admin/updatephp/update_comment.php" method="post">
	<input type="submit" class="btn-dark" style="border-radius:4px;" name="edit" value="Edit Comment" />
	<input type="hidden" name="editcomment" value="<?php echo $row['usercomments'];?>" />
	<input type="hidden" name="editcommentid" value="<?php echo $row['id'];?>" />
	</form>	
	
	</a>
	</li>
	</ul>
	</div> 
    
    <div class="d-flex text-muted">
 
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1 col-sm-12">
	<img src="<?php echo $pp ?>" alt="mdo" width="102" height="102" style="padding:10px;" class="rounded-circle">
		</div>

		<div class="col-md-11 col-sm-12">
    <p class="pb-3 border-bottom">
        <strong class="d-block text-gray-dark">@<?php echo $row['userid']; ?></strong>
		<span class="d-block"><?php echo $row['date']; ?></span>
	</p>
    <p  style="white-space: normal; overflow: hidden; text-overflow: ellipsis;">
	<?php echo $row['usercomments']; ?>
	</p>
		</div>
	</div>

<div class="leftoptions" >

	<button value="<?php echo $row['id']; ?>" class="unvote"></button>
	<button value="<?php echo $row['id']; ?>" class="vote"></button>
	<span id="show_like<?php echo $row['id']; ?>" style="font-size: 20px;">
	</span>
	
</div>
					
<hr style="">
<div class="bg-body rounded">	


    <div class="d-flex text-muted">


	<div class="dropdown text-start">
	<a href="#" class="d-block link-dark text-decoration-none" id="dropdownUserReply" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="bi bi-caret-right-fill" style="color: #fb0000;"></i>
	</a>
	
	<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
    <li><a class="dropdown-item" href="index.php?delreply=<?php echo $reply['replyid'];?>">Delete Comment</a></li>
	
	<li class="dropdown-item" href="#">
	<form action="../admin/updatephp/update_reply.php" method="post">
	<input type="submit" class="btn-dark" style="border-radius:4px;" name="reply" value="Edit Comment" />
	<input type="hidden" name="editcommentreply" value="<?php echo $reply['usercomments'];?>" />
	<input type="hidden" name="editcommentidreply" value="<?php echo $reply['replyid'];?>" />
	</form>	
	</li>
	
	<li>
	</li>
	</ul>
	</div> 
	

	
      <p class="mb-0">
        <strong class="d-block text-gray-dark">@<?php echo $reply['useridreply']; ?></strong>
		<?php echo $reply['usercomments']; ?>
      </p>
	  
    </div>
	<hr style="">
</div>


</div>	
  
 </div>
 
	<div class="dropdown text-start">
	<a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">Reply</a>
	<ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
	<li>
	
	<a class="dropdown-item">
	<h5><?php echo $_SESSION['username'] ?></h5>
	<form class="form-inline " action="index.php?id=<?php echo $row['id']?>" method="post">	
	<textarea type="text" name="commenterreply" class="form-control mb-2 mr-sm-2" cols="80" rows="3" placeholder="write a reply"></textarea>	
	<input type="hidden" name="commentid" value="<?php echo $row['id'];?>" />
	
	<input type="hidden" name="userglobalid" value="<?php echo $globaluserid2; ?>" />	
	
	<button class="btn btn-dark mb-2" name="reply">Reply</button>
	
	</form>
	
	</a>
	</li>
	</ul>
	</div> 
	
</div>	








<script>// Get the modal
var modal = document.getElementById("AccountSettingsModal");

// Get the button that opens the modal
var btn = document.getElementById("AccountSettings");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}</script>




			
	<?php 
	include('../pagelayout/footer.php');
	?>

	 <!-- comment js -->
	<script src="assets/js/main.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js" integrity="sha512-qzrZqY/kMVCEYeu/gCm8U2800Wz++LTGK4pitW/iswpCbjwxhsmUwleL1YXaHImptCHG0vJwU7Ly7ROw3ZQoww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>