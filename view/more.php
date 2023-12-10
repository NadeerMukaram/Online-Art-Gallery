	<?php 


	$sql = "SELECT * FROM comments WHERE comments.drawingid = '".$_GET['id']."' ORDER BY rand(id) ASC limit 4, 100";
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