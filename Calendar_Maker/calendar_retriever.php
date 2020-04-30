<?php
  // Author: Jess Lonetti
  // Title: Calander Retriever
  // Date: 4.26.2020
  // ****--------FUNCTIONALITY---------****
  // Calander Retriever gathers an existing student
  // and their courses to make a comprehessible calander
  // that is accessible via javascript or direct placement.
  // requirments: Student_Courses table entries, assignments
  // table entries, User account.
  //
  //
  require_once('../../../../../priv/mysql.inc.php');
  include('calendar_creator.php');
  $db = new myConnectDB();
  session_start();

  $alpha=$_SESSION['user']['user'];


  //****--------Start: Assignemnt data Retrieval---------****
  // This segment retrieves the rows that are associated with the
  // user account that has created a valid session.
  $stmt = $db->stmt_init();
  $query = "SELECT courseCode,assignmentDate,notes FROM assignments
  WHERE courseCode IN(SELECT courseCode FROM student_courses WHERE alpha = ?);";
  $stmt->prepare($query);
  $stmt->bind_param('s',$alpha);
  $check = $stmt->execute();
  if (!$check || $db->affected_rows == 0){
    echo "FALSE";
    exit();
  }

  $stmt->bind_result($courseCode,$assignmentDate,$notes);
  $data = array(array());
  while ($stmt->fetch()) {
    $data[$assignmentDate][$courseCode]=json_decode($notes);
  }
  unset($data[0]);
  if(empty($data)){
    echo "FALSE";
    exit();
  }
  $stmt->close();
  //****--------End: Assignemnt data Retrieval---------****
  //****--------Start: is it fall or spring?---------****
  // Takes the current date and checks if the date is in the spring
  // else it assumes the semester is in the fall.
  $thisYear = date("Y");
  $genDate = date("Y-m-d",strtotime($thisYear."-01-01"));
  $date = date_create($genDate);

  $startDate = date_format($date,"Y-m-d");
  $genDate = date("Y-m-d",strtotime($thisYear."-05-29"));
  $date = date_create($genDate);
  $endDate = date_format($date,"Y-m-d");
  $today = date("Y-m-d");
  //****--------generateCal creates the calander based on time of year---------****
  if(($today>=$startDate)&&($today<=$endDate))
    generateCal($data,0,5);
  else
    generateCal($data,7,12);
  //****--------End: is it fall or spring?---------****



 ?>
