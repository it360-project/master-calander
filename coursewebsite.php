<?php
  include 'Daysnatcher.php';
  include 'courseinsert';

  if(!isset($_SESSION["user"]["user"]))
    exit();

  function DBupdater(){
    $address = 'courses.cs.usna.edu';
    $html = file_get_contents($address);
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    $links = $dom->getElementsByTagName('a');
    foreach($links as $links){

      $coursecode=$links->nodeValue;
      $courseadress=$links->getAttribute('href')."calendar.php?show=calendar_display";
      $coursecalendars = Daysnatcher($courseadress)
      if(is_array()){
        //SEQUAL MongoCommandCursor
        foreach($coursecalendars as $key=>$value){

        }

      }
    }
  }

?>
