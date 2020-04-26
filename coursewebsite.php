<?php

  // Author: Jess Lonetti
  // Title: Course Website
  // Date: 4.26.2020
  // ****--------FUNCTIONALITY---------****
  // This php file accesses 'http://courses.cs.usna.edu/'
  // to find all the available courses in that domain.
  // It also checks if the website is standard to
  // assure all information is correct.

  include 'courseinsert.php';
  include 'Daysnatcher.php';
  require_once('mysql.inc.php');
  $db = new myConnectDB();

  DBupdater($db);

  // ****--------Database Updater---------****
  // starts the disection process by taking individual
  // courses and gives to daysnatcher to get a list back
  // which is then inserted into the database with the
  // coressponding Course code and date
  function DBupdater($db){
    $address = 'http://courses.cs.usna.edu/';
    $html = file_get_contents($address);
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    $i = 0;
    $coursecode = [];
    $coursedescription = [];
    foreach($dom->getElementsByTagName('td') as $result){
      if($i == 0){
        $coursecode[]= $result->nodeValue;
        $i=1;
      }
      else{
        $i=0;
        $coursedescription[]= $result->nodeValue;
      }

    }

    $length = count($coursecode);
    //start of for loop
    for($i=0;$i<$length;$i+=1){
      $courseadress=$address.$coursecode[$i]."/calendar.php?show=calendar_display";
      $coursecalendars = Daysnatcher($courseadress);

      if($coursecalendars != false){
        echo $coursecode[$i]. "  " . $coursedescription[$i]. "<br>";
        courseinsert($db,$coursecode[$i],$coursedescription[$i]);
        foreach($coursecalendars as $key=>$value){
          assignmentinsert($db,$coursecode[$i],$key,json_encode($value));
        }
      }
    // end of for loop
    }
  }

?>
