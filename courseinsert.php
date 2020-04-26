<?php
  // Author: Jess Lonetti
  // Title: Course Insert
  // Date: 4.26.2020
  // ****--------FUNCTIONALITY---------****
  // Easy functions for sql statments to put information
  // into tables.
  // courseinsert(): adds values into courses table
  // assignmentinsert(): adds values into assignments table 
  function courseinsert($db,$coursid,$coursdes){
    $stmt = $db->stmt_init();
    $query = "INSERT INTO courses VALUES(?,?);";
    $stmt->prepare($query);
    $stmt->bind_param('ss',$coursid,$coursdes);
    $check = $stmt->execute();
    // if (!$check || $db->affected_rows == 0)
    //   echo "<h5>ERROR: " . $db->error . " for query *$query*verify()</h5><hr>";

    $stmt->close();
  }
  function assignmentinsert($db,$coursid,$date,$notes){
    $stmt = $db->stmt_init();
    $query = "INSERT INTO assignments(courseCode,assignmentDate,notes) VALUES(?,?,?);";
    $stmt->prepare($query);
    echo ".<br> day".substr($date,8)." month".substr($date,5,2)." year".substr($date,0,4)."<br>";
    $newdate  = date("Y-m-d",mktime(0,0,0,substr($date,5,2),substr($date,8),substr($date,0,4)));
    $stmt->bind_param('sss',$coursid,$newdate,$notes);
    $check = $stmt->execute();
    if (!$check || $db->affected_rows == 0)
      echo "<h5>ERROR: " . $db->error . " for query *$query*assignmentinsert</h5><hr>";
    $stmt->close();

  }



?>
