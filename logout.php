<?php session_start(); 

  //1. unset all data
  session_unset();

  //2. destroy Session
  session_destroy();

  //3. Redirect to login page
  header("Location:login.php");
  
?>
