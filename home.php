<!-- visitors can only access this page if logged in -->

<?php
  require_once('auth.inc.php');
?>
<!DOCTYPE html>

<!-- A bare bones web page to start IT360 assignments with -->

<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>IT360</title>
</head>

<body>
  <h1> Welcome, you are logged in!</h1>
  <p><a href="home.php?logoff=1">Sign out</a></p>
</body>
</html>
