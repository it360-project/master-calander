<?php
/* Author: MIDN 2/C Samuel Kim
 * Purpose: Insert rows in database from form input.
 */

  require_once('../login/nested_auth.inc.php');

  //connect to db
  $db = new myConnectDB();

  if (mysqli_connect_errno()) {
    echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
  }

  //retrieve alpha from session
  $alpha = $_SESSION['user']['user'];
  $courseArray = $_POST['course'];

  //successful entries for user feedback
  echo "<h2>Courses entered successfully:</h2><br>";

  //iterate through array of inputted courses
  foreach($courseArray as $value) {
    //retrieve value for text input from form
    $courseLine = $value;
    //separate using comma delimiter
    $course = explode(",", $courseLine);
    $courseCode = $course[0];

    //input sanitization
    $courseCode = trim($courseCode);
    $courseCode = stripslashes($courseCode);
    $courseCode = htmlspecialchars($courseCode);

    insertStudentCourses($db, $alpha, $courseCode);
  }

  /* Purpose: insert student-course pairs into database
   * Input:
        $db - mysqli class
        $alpha - student's malpha code
        $courseCode - courseCode for course being taken
     Output:
        error message if unsuccessful, none if successful (check db for proper insertion)
   */
  function insertStudentCourses($db, $alpha, $courseCode) {
    //build INSERT statement
    $query = "INSERT INTO student_courses (alpha, courseCode)
                VALUES (?, ?);";

    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    $stmt->bind_param('ss', $alpha, $courseCode);

    $success = $stmt->execute();

    //error message
    if (!$success || $db->affected_rows == 0) {
      echo "<h5>ERROR: " . $db->error . " for query *$query*</h5><hr>";
    }
    else {
      //user feedback for successfully added courses
      echo "$courseCode<br>";
    }

    $stmt->close();
  }
?>

