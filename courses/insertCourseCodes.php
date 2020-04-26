<?php
  require_once('../login/nested_auth.inc.php');

  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
    echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }

  function insertCourse($db, $courseCode, $courseTitle) {
    $query = "INSERT INTO courses (courseCode, courseTitle)
                VALUES (?, ?);";

    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('ss', $courseCode, $courseTitle);

    $success = $stmt->execute();
    if (!$success || $db->affected_rows == 0) {
      echo "<h5>ERROR: " . $db->error . " for query *$query*</h5><hr>";
      return false;
    }

    $stmt->close();

    return true;
  }

  //open filestream for list of courses
  $file = fopen("courses.csv","r");
  //read in first line of format
  fgets($file);

  //loop for reading file line by line
  while(!feof($file)) {
    $line = fgets($file);
    $courseArr = explode(',', $line);
    //insert course into db
    insertCourse($db, $courseArr[0], $courseArr[1]);
  }

  //close file stream
  fclose($file);
?>

