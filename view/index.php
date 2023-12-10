<?php 

	require('../config/database.php');
	
	include '../admin/functions.php';
	
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
	
	<div class="container drawingcon">
	<div class="row">
	

<?php
 if(isset($_GET['id'])){
    $drawing_id = $_GET['id']; 
     
        $sql = " select * from drawing where id = '$drawing_id'";
		
                $result = mysqli_query($conn,$sql); 

                 while($row = mysqli_fetch_array($result)){
                      $image = '../submittedarts/'.$row["link"];

                          
                     
?>



<div class="card drawingcard centerview" style="width:100%;">
  <img class="card-img-top img-fit-poggers-view" id="thisimage" src="<?php echo $image; ?>" alt="<?php echo $row['name']; ?>">
  <div class="card-body-for-view">
	
  	<h5><p class="card-text" style="text-align:center; width:50%; display:block; margin:auto;">from: <span style="color:#F05454;"><?php echo $row['userbysub']; ?></span> </p></h5>
	<hr style="margin: 1rem 10rem;">
	<h3><p class="card-text" style="text-align: center;"><?php echo $row['name']; ?></p></h3>
	<hr>
	<div class="card mb-3 box-shadow">
    <p class="card-text" style="text-align: center;"><?php echo $row['detail']; ?></p>
	</div>
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

<div class="middlingoptions">

<div class="fb-share-button" data-href="http://localhost/nzro/view/index.php?id=" data-layout="box_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%2Fnzro%2Fview%2Findex.php%3Fid&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>

</div>




<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="BKGYDNia"></script>



<hr>
      
</div>	


<script type="text/javascript" src="like_heart.js"></script>


<div id="Modal-Nzro" class="modal-nzro">
  <span class="thisclose">&times;</span>
  <img class="modal-content-nzro" id="img01">
  <div id="caption"></div>
</div>



<script>
// Get the modal
var thismodal = document.getElementById("Modal-Nzro");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("thisimage");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");

img.onclick = function(){
  thismodal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var thisclosespan = document.getElementsByClassName("thisclose")[0];

// When the user clicks on <span> (x), close the modal
thisclosespan.onclick = function() { 
  thismodal.style.display = "none";
}


$('body').click(function (event) 
{
   if(!$(event.target).closest('#thisimage').length && !$(event.target).is('#thisimage')) {
     $(thismodal).hide();
   }     
});


</script>

<style>


#thisimage {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#thisimage:hover {opacity: 0.7;}


.modal-nzro {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 50px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.9); 
}


.modal-content-nzro {
  margin: auto;
  display: block;
  max-width: 100%;
  max-height: 100%;
}


#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}


.modal-content-nzro, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}


.thisclose {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.thisclose:hover,
.thisclose:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}


@media only screen and (max-width: 700px){
  .modal-content-nzro {
    width: 100%;
  }
}
</style>


  <link rel="stylesheet" type="text/css" href="dist/emojionearea.min.css" media="screen">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript" src="dist/emojionearea.js"></script>
  

<script type="text/javascript">
  
/*emojioneArea */
   $(document).ready(function() {
         $("#nzrotxtbox").emojioneArea({
                       pickerPosition: "bottom",
                       tonesStyle: "bullet",
                       events: {
                         keyup: function (editor, event) {
                           console.log('event:keyup');
                           countChar(this);
                        }
                      }
               });
    }); 

   /*Character Counter */
        function countChar(val) {
            var len = val.getText().length;
            if (len >= 140) {
                  val.value = val.content.substring(0, 140);
                  $('#chars').text(0);
            } else {
                 $('#chars').text(140 - len);
            } 
			
        }

</script>


<div class="card mb-6 mt-5 box-shadow">
<div class="card-body">
  <form class="form-inline " action="index.php?id=<?php echo $row['id']?>" method="post">

  	<h3>@<?php echo $_SESSION['username'] ?>
    <label  class="mb-2 mr-sm-2"></label>
	
    <textarea type="text" id="nzrotxtbox" maxlength="140" class="form-control mb-2 mr-sm-2" cols="80" rows="5" placeholder="write a comment" name="comment"></textarea>
	
	
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
	
	<button type="submit" class="btn btn-dark mb-2" name="create">Publish</button>
	<label><span id="chars" class="lead">140</span></label>
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

	<?php 


	$sql = "SELECT * FROM comments WHERE comments.drawingid = '".$_GET['id']."' ORDER BY rand(id) ASC limit 0, 4";
	$result = mysqli_query($conn, $sql);
	
	$resultCheck = mysqli_num_rows($result);

		
	while ($row = mysqli_fetch_assoc($result))	{
		
	$pp = '../admin/uploads/'.$row["ppic"];
	$commentid = $row["id"];
	
	?> 	
	
	

	

<div class="my-3 mb-2 bg-body rounded shadow-sm">
 

	
	<?php
	if ($_SESSION['username'] == $row['userid']) {
	?>
	
	
	<div class="btn-group dropstart" style="float:right;">
	<button type="button" style="border:none;text-decoration:none;background-color:white;" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="bi bi-three-dots"></i>
	</button>
	
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
	
	

	<?php
	}
	?>

	
<div class="d-flex text-muted">

<style>
.col-1-nzro {
    flex: 0 0 auto;
    width: 3.33333333%;
}
</style>
	     
<div class="container-fluid">
	<div class="row">

	<div class="col-1-nzro">
		<div class="leftoptions" >
						<?php
							$query1=mysqli_query($conn,"select * from likes where postid='".$row['id']."' and userid='".$_SESSION['username']."'");
							if (mysqli_num_rows($query1)>0){
								?>
                                <button value="<?php echo $row['id']; ?>" class="unvote"></button>
								<?php
							}
							else{
								?>
								<button value="<?php echo $row['id']; ?>" class="vote"></button>
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
	</div>
	
	<div class="col-md-1 col-4">
	<img src="<?php echo $pp ?>" alt="mdo" width="102" height="102" style="padding:10px;" class="rounded-circle">
	</div>

	<div class="col-md-10 col-7">
	
    <p class="pb-3 border-bottom">
        <strong class="d-block text-gray-dark">@<?php echo $row['userid']; ?></strong>
		<span class="d-block"><?php echo $row['date']; ?></span>
	</p>
    <p  style="white-space: normal; overflow: hidden; text-overflow: ellipsis;">
	<?php echo $row['usercomments']; ?>
	</p>
	</div>
	
	</div>
				
<hr style="">
<div class="bg-body rounded">	
<?php 
	$resultreply = mysqli_query($conn,"select * from reply where commentid = $commentid");
	$resultCheck = mysqli_num_rows($resultreply);
	if($resultCheck > 0) 	
	while ($reply = mysqli_fetch_assoc($resultreply))	{
		
?>	

    <div class="d-flex text-muted">

	<?php
	if ($_SESSION['username'] == $reply['useridreply']) {
	?>

	<div class="dropdown text-end">
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
	
	<?php
	}
	?>	

	
      <p class="mb-0">
        <strong class="d-block text-gray-dark">@<?php echo $reply['useridreply']; ?></strong>
		<?php echo $reply['usercomments']; ?>
      </p>
	  
    </div>
	<hr style="">
<?php 
}
?>
</div>






</div>	
  
</div>


<style>
.collapsible-nzro<?php echo $row['id']?> {
  color: #1A1A1A;
  border: none;
  background-color:white;
}


.content-nzro {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
</style>	
	
	
  

<div class="replywar">
<button class="collapsible-nzro<?php echo $row['id']?>">Reply</button>
<div class="content-nzro">

	<h5><?php echo $_SESSION['username'] ?></h5>
	<form class="form-inline " action="index.php?id=<?php echo $row['id']?>" method="post">	
	<textarea type="text" name="commenterreply" class="form-control mb-2 mr-sm-2 commentreplynoresize" cols="80" rows="3" placeholder="write a reply"></textarea>	
	<input type="hidden" name="commentid" value="<?php echo $row['id'];?>" />
	
	<input type="hidden" name="userglobalid" value="<?php echo $globaluserid2; ?>" />	
	
	<button class="btn btn-dark mb-2" name="reply">Reply</button>
	
	</form>
	
	
</div>
</div>

<script>
var coll = document.getElementsByClassName("collapsible-nzro"+<?php echo $row['id']?>);
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active-nzro"+<?php echo $row['id']?>);
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>		

	
</div>	




<?php 
}
?> 		

<?php
}    
}
?>



<style>
#more {display: none;}
</style>



<span id="dots"></span>
<span id="more">
<?php 
	include 'more.php';
?>

</span>

<button onclick="myFunction()" id="myBtn" class="btn btn-outline-dark mt-5">Read more comments</button>


<script>




function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more comments"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}


</script>




















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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>