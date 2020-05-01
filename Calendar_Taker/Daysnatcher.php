<?php


  // Author: Jess Lonetti
  // Title: Day Snatcher
  // Date: 4.26.2020
  // ****--------FUNCTIONALITY---------****
  // Rips a standard cs calander into one comprhessible list
  // List["date"]["CourseCode"]["name of href or Bold for bold data"]
  // Example List["2020-25-02"]["IC211"]["Class2"or"Bold"]

  function Daysnatcher($address){
    $courseaddress = $address."/calendar.php?show=calendar_display";
    $address = $address."/";
    $monthlist = ["January"=>"01","February"=>"02","March"=>"03","April"=>"04","May"=>"05","June"=>"06","July"=>"07","August"=>"08","September"=>"09","October"=>"10","November"=>"11","December"=>"12"];
    $dayslist =    [31,28,31,30,31,30,31,31,30,31,30,31];
    $html = file_get_contents($courseaddress);
    if(false ==  $html)
      return $html;


    $dom = new DOMDocument;
    $dom->loadHTML($html);

    $Cal_array=[];
    $title = $dom->getElementsByTagName('h4');
    $monthes = array();
    $days_Task = array(array());
    $i = 0;
    foreach($title as $title){
      $monthes[$i]=$title->nodeValue;
      if(substr($monthes[$i],-4)!=date("Y"))
        return false;
      $i++;
    }
    $month = $dom->getElementsByTagName('table');
    $i= 0;
    $string ="";
    foreach($month as $month){
      $day = $month->getElementsByTagName('td');
      foreach($day as $day){
        $tasks=explode(" ",$day->textContent);
        if($tasks[1] !== ""){
          $string = substr($monthes[$i],0,-5);
          $keyforarray = substr($monthes[$i],-4)."-".$monthlist[$string]."-".$tasks[0]."<br>";
          foreach($day->getElementsByTagName('a') as $result)
            $days_Task[$keyforarray][$result->nodeValue] = $address.$result->getAttribute('href');
          foreach($day->getElementsByTagName('b') as $result)
            $days_Task[$keyforarray]["Bold"] = $result->nodeValue;

        }

      }
      $i++;
    }
    unset($days_Task[0]);

    return $days_Task;

  }

  ?>
