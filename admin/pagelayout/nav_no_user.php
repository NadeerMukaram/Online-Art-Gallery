<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

<nav class="py-2 bg-light border-bottom stickynav">
    <div class="container d-flex flex-wrap">
      <ul class="nav-nzro nav me-auto">
        <li class="nav-item"><a href="./home/index.php" class="nav-link link-dark px-2 active" aria-current="page"><i class="bi bi-x-diamond-fill"></i> Home</a></li>
		<li class="nav-item"><a href="./discover/index.php" class="nav-link link-dark px-2"><i class="bi bi-slack"></i> Discover</a></li>
        <li class="nav-item"><a href="./admin/index.php" class="nav-link link-dark px-2"><i class="bi bi-eye-fill"></i> Admin</a></li>
      </ul>
      <ul class="nav-nzro nav">
        <li class="nav-item"><a href="./login/index.php" class="nav-link link-dark px-2">Sign In</a></li>
      </ul>	 
    </div>
  </nav>
  <header class="py-3 mb-4 border-bottom fixednav">
    <div class="container d-flex flex-wrap justify-content-center">
      <a href="./index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
        <span class="fs-4 nzro-logo">NZRO</span>
      </a>
      <form  action="./searchresult/index.php" method="POST" class="col-12 col-lg-auto mb-3 mb-lg-0" style="display: flex; align-items: center;">
        <input type="text" name="name" name="submit" class="form-control-nzro" placeholder="Search..." aria-label="">
        <input type="submit" name="submit" class="form-control" placeholder="Search..." aria-label="Search">
      </form>
    </div>
  </header>
  
  <link href="style.css" rel="stylesheet">