<?php  

  
session_start();
  
// destroy everything in this session
  
unset($_SESSION);
session_destroy();
header("Location: ./index.php");

?>  