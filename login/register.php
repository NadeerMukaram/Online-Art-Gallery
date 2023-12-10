<?php 


include('server.php') 


?>

<!DOCTYPE html>
<html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />	

	<style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }	
	  
	  .container {
	max-width: 960px;
	}
	
	body  {
	background-image: url("https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/1b02d68f-ba19-4ea6-8fa7-6b3559dc2eec/df4nzr3-3ad1d9ff-f2ce-40fc-8048-bd0927cd9543.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzFiMDJkNjhmLWJhMTktNGVhNi04ZmE3LTZiMzU1OWRjMmVlY1wvZGY0bnpyMy0zYWQxZDlmZi1mMmNlLTQwZmMtODA0OC1iZDA5MjdjZDk1NDMuanBnIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.pO1NnKCW5TSj3Nt8O8EN6XtA1gjbLJFLqMQdkIk-ffw");
	background-repeat: repeat-y;
	}
	
	

	</style>


    <title>The Nzro Site</title>
  </head>
  
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="../logo/newn.png" alt="" style="image-rendering: pixelated;" width="52" height="57">
      <h2>Registration Form</h2>
      <p class="lead">Welcome to the Nzro.</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-start">
      </div>
      <div class="col-md-12 col-lg-4">
        <form class="needs-validation" method="post" action="register.php">
		<?php include('errors.php') ?>
          <div class="row g-3">

            <div class="col-12">
              <label for="username" class="form-label"><h4>Username</h4></label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
              <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label"><h4>Email</h4></label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com" name="email" value="<?php echo $email; ?>">
              <div class="invalid-feedback">
                Please enter a valid email address.
              </div>
            </div>

            <div class="col-12">
              <label for="pas" class="form-label"><h4>Password</h4></label>
              <input type="password" class="form-control" id="address" placeholder="Password" name="password_1" required>
              <div class="invalid-feedback">
                Please enter your please enter your password.
              </div>
            </div>

            <div class="col-12">
              <label for="pass2" class="form-label"><h4>Confirm Password</h4></label>
              <input type="password" class="form-control" id="address2" placeholder="Confirm your password" name="password_2">
            </div>
			
			
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-dark btn-lg" type="submit" name="reg_user">Register</button>
        </form>
      </div>
    </div>
  </main>

</div>


    <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script>
	
	// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

  </body>
</html>