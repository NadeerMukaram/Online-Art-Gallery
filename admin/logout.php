<?php  

  
session_start();//session is a way to store information (in variables) to be used across multiple pages.  
unset($_SESSION['usernameadmin']);
header("Location: ../adminlogin/index.php");//use for the redirection to some page  

?>  