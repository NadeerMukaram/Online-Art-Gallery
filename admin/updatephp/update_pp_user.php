<?php 
	
	require('../../config/database.php');

	session_start();
	
	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../../index.php');
	}
	
		if(isset($_POST['ppedit'])) {
			
		$editid = $_POST['editid'];
		$editpp = $_POST['editpp'];
		
		}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link href="admincss.css" rel="stylesheet">
    
	<title>Update</title>
	
  </head>
  <body>
    
	<form action="upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
	<input type="hidden" name="updateid" value="<?php echo $editid ?>">
    <input type="submit" name="submit" value="Upload">
	</form>

<?php

$query = $conn->query("SELECT * FROM users");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $pp = 'uploads/'.$row["pp"];
?>
    <img src="<?php echo $pp; ?>" alt="" width="20%"/>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>