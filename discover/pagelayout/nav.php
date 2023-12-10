 <style>

body {
    background: linear-gradient(-45deg, #FFFFFF, #FFFFFF, #E7E7E7, #FFFFFF);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

element {
    -ms-overflow-style: none; /* for Internet Explorer, Edge */
    scrollbar-width: none; /* for Firefox */
    overflow-y: scroll; 
}

element::-webkit-scrollbar {
    display: none; /* for Chrome, Safari, and Opera */
}

</style> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	
	<?php if (isset($_SESSION['success'])) : ?>
		<div class="error success">
			<h3>
				<?php 
					echo $_SESSION['success'];
					unset($_SESSION['success']);
				?>
			</h3>
		</div>
	<?php endif ?>

  <nav class="py-2 bg-light border-bottom stickynav">
    <div class="container d-flex flex-wrap">
      <ul class="nav-nzro nav me-auto">
        <li class="nav-item"><a href="../../home/" class="nav-link link-dark px-2 active" aria-current="page"><i class="bi bi-x-diamond-fill"></i> Home</a></li>
		<li class="nav-item"><a href="../../discover/" class="nav-link link-dark px-2"><i class="bi bi-slack"></i> ✥Discover</a></li>
        <li class="nav-item"><a href="../../adminlogin/" class="nav-link link-dark px-2"><i class="bi bi-eye-fill"></i> Admin</a></li>
      </ul>
	  

	  
      <ul class="nav-nzro nav">    
	<?php if (isset($_SESSION['username'])) : ?>
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2 namehidden"><?php echo $currentuser['username'];?></a></li>
	<?php endif ?>
      </ul>	

	  	  
	  <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
	<?php 

	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 	
	while ($row = mysqli_fetch_assoc($result))	{
	$pp = '../../admin/uploads/'.$row["pp"];
	?> 			
	<?php
	if ($row['username'] == $currentuser['username']) {
	?>			
			
			
			<img src="<?php echo $pp ?>" alt="display_picture" width="32" height="32" class="rounded">
			
	<?php
	}
	?>
	<?php 
	}
	?> 				
			
		<i class="bi bi-chevron-double-down"></i>  
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" style="background: #121212;color:white;" href="../../submission/"><i class="bi bi-easel2-fill"></i> ▶ Submit Art</a></li>
			
			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="../../artsubmitted/"><i class="bi bi-back"></i> ▶ Arts Submitted</a></li>

			<li><hr class="dropdown-divider"></li>
			<li><a class="dropdown-item" href="../../favorites/"><i class="bi bi-bag-heart-fill"></i> ▶ Favorites</a></li>
			
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" id="AccountSettings"><i class="bi bi-gear-fill"></i> ▶ Account Settings</a></li>			

            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../../logout.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> ▶ Log out</a></li>
          </ul>
        </div>
    </div> 
	  
	
  </nav>
  <header class="py-3 mb-4 border-bottom fixednav">
    <div class="container d-flex flex-wrap justify-content-center">
      <a href="../index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
        <span class="fs-4 nzro-logo">NZRO</span>
      </a>
      <form  action="../../searchresult/index.php" method="POST" class="col-12 col-lg-auto mb-3 mb-lg-0" style="display: flex; align-items: center;">
        <input type="search" name="name" name="submit" class="form-control-nzro" placeholder="Search..." aria-label="">
        <input type="submit" name="submit" class="form-control" placeholder="Search..." aria-label="Search">
      </form>
    </div>
  </header>
  
  
<div id="AccountSettingsModal" class="modal">

	<div class="modal-content">
    <div class="modal-header">
    <h3 class="modal-title"><i class="fa-solid fa-user-gear"></i> Account Settings</h3>
    </div>

	<div class="container-fluid">
	<div class="row">
	
	<div class="col-md-3 col-sm-6">
	<?php 

	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	
	if($resultCheck > 0) 	
	while ($row = mysqli_fetch_assoc($result))	{
	$pp = '../admin/uploads/'.$row["pp"];
	?> 			
	<?php
	if ($row['username'] == $currentuser['username']) {
	?>
	
		<img class="mt-2 pppoggers" alt="no pic" src="<?php echo $pp ?>" width="100%"/>
	
	<?php
	}
	?>
	<?php 
	}
	?> 		
	</div>	
	
	<div class="col-md-9 col-sm-6 mt-2">
	<?php 

	$sql = "SELECT * FROM users";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) 	
	while ($row = mysqli_fetch_assoc($result))	{
	?> 		
	<div class="modal-body" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">		
	<?php
	if ($row['username'] == $currentuser['username']) {
	?>
    <h5><i class="fa-solid fa-user"></i> Name: <?php echo $currentuser['username'];?> </h5>
	<h5><i class="fa-solid fa-envelope"></i> Email: <?php echo $row['email'];?> </h5>
	<h5><i class="fa-solid fa-unlock-keyhole"></i> Password: <?php echo str_repeat("*", strlen($row['password']));?> </h5>
	
	<form action="../admin/updatephp/" method="post">
	<input class="mb-3" type="submit" name="edit" value="Update Account Settings" />
	<input type="hidden" name="editid" value="<?php echo $row['id'] ?>" />
	<input type="hidden" name="editusername" value="<?php echo $_SESSION['username'] ?>" />
	<input type="hidden" name="edituseremail" value="<?php echo $row['email'] ?>" />
	<input type="hidden" name="editpassword" value="<?php echo $row['password'] ?>" />
	<input type="hidden" name="editpp" value="<?php echo $row['pp'] ?>" />
	</form>
	
	<?php
	}
	?>
	</div>	
	
	
	<?php 
	}
	?> 	 		
		
	</div>
	
	</div>
	</div>

 
    <div class="modal-footer">
    
    <span class="close" ><h5>Close</h5></span>
    </div>
	</div>

</div>

<style>

/* Add Animation */
.modal {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal {
    width: 100%;
  }
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

</style>


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





<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  background-color: white;
  border-radius: 10px;
  max-width: 30rem;
  word-break: break-all;
}


/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>


	

<button class="open-button" onclick="toggleForm()" style="z-index: 9;">Chat</button>


<div class="chat-popup" id="myForm">
  <div style="margin:1rem">
  <form action="">
  <div class="separate">
    <h1 style="float: left;">Chat</h1>
    <button type="button" class="btn-dark cancel" onclick="toggleForm()" style="float: right;"><i class="fa-solid fa-square-xmark"></i></button>
  </div>


    <?php 
    include('publicchat.php');
    ?>		
		
    
  </form>
  </div>
</div>

<script>
  
  function toggleForm() {
    var chatPopup = document.getElementById("myForm");
    if (chatPopup.style.display === "none") {
      chatPopup.style.display = "block";
      scrollToLatestMessage(); // Scroll to the latest message when opening the chat pop-up
    } else {
      chatPopup.style.display = "none";
    }
  }
  

  // Function to scroll to the latest message
  function scrollToLatestMessage() {
    var chatbox = document.getElementById("chatbox");
    chatbox.scrollTop = chatbox.scrollHeight;
  }

  // Other code...
</script>
	  

			

			
		
		
		
		
