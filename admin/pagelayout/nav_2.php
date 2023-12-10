   
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

 <nav class="py-2 bg-light border-bottom">
    <div class="container d-flex flex-wrap">
      <ul class="nav me-auto">
        <li class="nav-item"><a href="../index.php" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="../admin/index.php" class="nav-link link-dark px-2">Admin</a></li>
        <li class="nav-item"><a href="../artworks/index.php" class="nav-link link-dark px-2">Artworks</a></li>
      </ul>
      <ul class="nav">
	<?php if (isset($_SESSION['usernameadmin'])) : ?>
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2"><?php echo $_SESSION['usernameadmin']; ?></a></li>
        <li class="nav-item"><a href="../admin/logout.php" class="nav-link link-dark px-2">Log Out</a></li>
	<?php endif ?>
      </ul>	 
    </div>
  </nav>
  <header class="py-3 mb-4 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
      <a href="../index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
        <svg width="30" height="30"xmlns="http://www.w3.org/2000/svg"><image href="./logo/n.png" height="30" width="30"/></svg>
        <span class="fs-4">ZRO</span>
      </a>
      <form  action="./searchuserordrawing_2.php" method="POST" class="col-12 col-lg-auto mb-3 mb-lg-0" style="display: flex; align-items: center;">
        <input type="text" name="user" class="form-control-nzro" placeholder="Search User" aria-label="">
        <input type="submit" name="submit" class="form-control" placeholder="Search..." aria-label="Search">
      </form>
    </div>
  </header>