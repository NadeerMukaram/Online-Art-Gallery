<?php 

include('server.php') 


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
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">

    <title>The Nzro Site</title>
	
	<style>
	body  {
	background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/1b02d68f-ba19-4ea6-8fa7-6b3559dc2eec/df4nzr3-3ad1d9ff-f2ce-40fc-8048-bd0927cd9543.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzFiMDJkNjhmLWJhMTktNGVhNi04ZmE3LTZiMzU1OWRjMmVlY1wvZGY0bnpyMy0zYWQxZDlmZi1mMmNlLTQwZmMtODA0OC1iZDA5MjdjZDk1NDMuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.pO1NnKCW5TSj3Nt8O8EN6XtA1gjbLJFLqMQdkIk-ffw");
	background-repeat: repeat-y;
	}
	</style>
  </head>
  
<body class="text-center">
    
<main class="form-signin">
  <form action="../login/index.php" method="post">
  <?php include('errors.php') ?>
    <a href="../index.php"><img class="mb-4" src="../logo/newn.png" alt="" style="image-rendering: pixelated;" width="52" height="57"></a>
    <h1 class="h3 mb-3 fw-normal">Sign In to proceed</h1>

    <div class="form-floating">
      <input type="text" name="username" class="form-control" placeholder="name@example.com">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-dark" type="submit" name="login_user">Login</button>
    <p class="mt-5 mb-3 text-muted"><a href="register.php" style="text-decoration:none;color:#1a1a1a;"><h4>REGISTER</h4></a></p>
  </form>
</main>
   	
			
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>