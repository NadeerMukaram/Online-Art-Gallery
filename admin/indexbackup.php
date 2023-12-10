<?php 
	
	require('../admin/read.php');
	
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
    
	<title>Admin</title>
	
  </head>
  <body>
  

<div class="container">
  <h2 class="mt-5" >Add Drawing</h2>
  
  <form class="form-inline" action="../admin/create.php" method="post">
  
    <label  class="mb-2 mr-sm-2">Name: </label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter name" name="name">
	
    <label class="mb-2 mr-sm-2">Link:</label>
    <input type="text" class="form-control mb-2 mr-sm-2"  placeholder="Enter image address" name="link">
 
	<button type="create" class="btn btn-primary mb-2" name="create">Create</button>
	
  </form>
  
      <table class="nzrotable" class="mr-5">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Link</th>
        <th>Actions</th>
      </tr>
	  
	<?php while($results = mysqli_fetch_array($sqlDrawings)) { ?>
	
        <tr>
          <td><?php echo $results['id'] ?></td>
          <td><?php echo $results['name'] ?></td>
		  <td><?php echo "<img style='width:10%' src = ".$results['link']." />" ?></td>
          <td>
		  
            <form action="../admin/update.php" method="post">
            <input type="submit" name="edit" value="EDIT" />
			<input type="hidden" name="editid" value="<?php echo $results['id'] ?>" />
			<input type="hidden" name="editname" value="<?php echo $results['name'] ?>" />
			<input type="hidden" name="editlink" value="<?php echo $results['link'] ?>" />
            </form>
			
            <form action="../admin/delete.php" method="post">
            <input type="submit" name="delete" value="DELETE" />
			<input type="hidden" name="deleteid" value="<?php echo $results['id'] ?>" />
            </form>
			
          </td>
        </tr>
		
	<?php } ?>
		
     
    </table>
  
</div>	














    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>