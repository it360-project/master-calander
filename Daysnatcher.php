<?php
  Daysnatcher();
  function Daysnatcher($address = 'https://www.usna.edu/Users/cs/leavitt/IT452/'){

    $date = "what";
    $addresscal = $address.'calendar.php?show=calendar_display';
    $html = file_get_contents($addresscal);
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    // foreach($dom->childNodes as $everything){
    //   echo "first";
    //   echo $everything->nodeName. "and". $everything->nodeValue;
    //   echo "<br>";
    // }
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
    foreach($month as $month){
      $day = $month->getElementsByTagName('td');
      foreach($day as $day){
        $tasks=explode(" ",$day->textContent);
        echo $day->formatOutput;
        if($tasks[1] !== ""){
          $date = $days_Task[$tasks[0]." ".$monthes[$i]];
          foreach($day->getElementsByTagName('a') as $result)
            $days_Task[$tasks[0]." ".$monthes[$i]][$result->nodeValue] = $address.$result->getAttribute('href');
          foreach($day->getElementsByTagName('b') as $result)
            $days_Task[$tasks[0]." ".$monthes[$i]]["Bold"] = $result->nodeValue;

        }

      }
      $i++;
    }
    unset($days_Task[0]);
    print_r($days_Task);
    echo $date;
  }
  ?>
