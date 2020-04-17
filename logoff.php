<!-- visitors can only access this script if logged in -->
<?php
  session_start();
  if(!isset($_SESSION['user']))
    header("location: index.php");
  //do both just in case
  session_unset();
  session_destroy();

  echo "Logging out!";
  header("refresh:3; url=index.php");
  die;
?>
