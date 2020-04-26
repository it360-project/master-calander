<?php
  require_once('../login/nested_auth.inc.php');

  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
    echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }
/*
  function insertCourse($db) {
    $query = "INSERT INTO courses (courseCode, courseTitle)
                VALUES (?, ?);";

    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('ss', ??);

    $success = $stmt->execute();
    if (!$success || $db->affected_rows == 0) {
      echo "<h5>ERROR: " . $db->error . " for query *$query*</h5><hr>";
      return false;
    }

    $stmt->close();

    return true;
  }
*/
  //open filestream for list of courses
  $file = fopen("courses.csv","r");
  //loop for reading file line by line
  while(!feof($file)) {
    $line = fgets($file);
    $courseArr = explode(',', $line);
    print_r($courseArr);
  }

  //close file stream
  fclose($file);

?>

