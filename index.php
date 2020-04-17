<!-- visitors can only access this page if NOT logged in -->
<?php
session_start();
if(isset($_SESSION['user']))
  header("location: usersonly.php");
?>
<!DOCTYPE html>

<!-- A bare bones web page to start IT360 assignments with -->

<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>IT360</title>
</head>

<body>
  <h1> Not logged in!</h1>
  <p><a href="usersonly.php">Sign in</a></p>
</body>
</html>
