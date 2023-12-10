<header class="d-flex justify-content-center py-3-a">

<ul class="nav nav-pills">
<h2>
<div class="card box-shadow" style="text-align: center;">

<?php 
$sql="select count('id') from users";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
{ ?>
		<li class="nav-item nav-link-a" style="color: #1a1a1a;">Current Users <h1><i class="fa-solid fa-users"></i> / <?php echo $row[0] ?></h1></li>
<?php } ?>
		
</div>
</h2>
</ul>

<ul class="nav nav-pills">
<h2>
<div class="card box-shadow" style="text-align: center;">

<?php 
$sql="select count('id') from drawing";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
{ ?>
		<li class="nav-item nav-link-a" style="color: #1a1a1a;">Number of Artworks <h1><i class="fa-solid fa-hand-fist"></i> / <?php echo $row[0] ?></h1></li>
<?php } ?>
		
</div>
</h2>
</ul>

</header>
