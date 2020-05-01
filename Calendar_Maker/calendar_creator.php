<?php
    // Author: Jess Lonetti
    // Title: Calander Creator
    // Date: 4.26.2020
    // ****--------FUNCTIONALITY---------****
    // Calander Creator makes an existing student
    // and their courses to make a comprehessible calander
    // that is accessible via javascript or direct placement.
    // requirments: Student_Courses table entries, assignments
    // table entries, User account.
    //
    // Augments: Calander retriever by parsing a calander
    // based on the decisions made by calander_retriever.
    // Niether of these functions return anything
    // they merely print out the necessary information.


    function generateCal($data,$start,$end){
      // Some convinient list to help with labeling
      $monthes = ["January","February","March","April","May","June","July","August","September","October","November","December"];
      $daysofweek = ["Saturday"=>0,"Sunday"=>1,"Monday"=>2,"Tuesday"=>3,"Wednesday"=>4,"Thursday"=>5,"Friday"=>6];
      echo "<h3>Welcome to Master Calendar</h3>";
      $currYear =date("Y");
      // ****--------Start: Month by Month---------****
      // Retrieves monthes based on designated time frame
      // Monthes are individual tables.
      for($i=$start;$i<$end;$i++){
        $daytracker=$daysofweek[date("l",strtotime($currYear."-".($i+1)."-01"))];
        echo  '<h4>'.$monthes[$i]." ".$currYear.'</h4>';
        echo '<button type="button" class ="btn" id="b'.$monthes[$i].'">Maximize</button><br>';
        echo '<table class="table table-striped table-bordered calendar" id = "'.$monthes[$i].'" style="display:none;"><thead><tr><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr></thead><tbody><tr>';
        monthBuilder($monthHeader,$daytracker,$i,$data);

        }
      // ****--------End: Month by Month---------****

    }
    // ****--------Start: Day by Day---------****
    // This funcrion gets the assignment data and matches it with date
    // The large for statments are for the scenarios where the month
    // does not start on monday since the table always starts on monday
    // and each row ends on friday this was a bit tricky. The main thing
    // to note is that the first day of the month is found and from there
    // it decides on an offset.
    function monthBuilder($monthHeader,$daytracker,$i,$data){
      $calander = $monthHeader;
      $ii = 0;
      $dayblank = 2;
      $daytracker;
      $days = [31,28,31,30,31,30,31,31,30,31,30,31];
      $currYear =date("Y");
      while($ii<$days[$i]){
        if(($i+1)<10)
          $d = "0".($i+1);
        else
          $d = ($i+1);

        if(($ii+1)<10)
          $m = "0".($ii+1);
        else
          $m = ($ii+1);

        if($dayblank == $daytracker){
          echo '<td>'.($ii+1).'<div class="content-center-day" id="'.$currYear."-".$d."-".$m.'"><br>';




          if(isset($data[$currYear."-".$d."-".$m])){
            foreach($data[$currYear."-".$d."-".$m] as $key=>$arr){
              echo "<b>".$key."</b><br>";

              foreach($arr as $innerkey =>$value){

                if($innerkey!="Bold"){
                  echo "<br><a href=\"$value\">$innerkey</a><br>";
                }
                else
                  echo "<b>".$value."</b><br>";


              }

              echo "<hr>";
            }
            echo '<br></div></td>';
          }
          else
            echo '<br><br><br><br><br><br></div></td>';


          $daytracker ++;
          $ii++;
        }
        elseif($daytracker%7<2){
          $daytracker++;
          $ii++;
        }
        elseif($ii == 0){
          echo'<td class="spacer-day" >&nbsp; </td>';
          $dayblank++;
        }
        else{

          echo '<td >'.($ii+1).'<div class="content-center-day" id="'.$currYear."-".$d."-".$m.'"><br>';


          if(isset($data[$currYear."-".$d."-".$m])){
            foreach($data[$currYear."-".$d."-".$m] as $key=>$arr){
              echo "<b>".$key."</b><br>";

              foreach($arr as $innerkey =>$value){

                if($innerkey!="Bold"){
                  echo "<br><a href=\"$value\" target=\"_blank\">$innerkey</a><br>";
                }
                else
                  echo "<b>".$value."</b><br>";


              }

              echo "<hr>";
            }
            echo '<br></div></td>';
          }
          else
            echo '<br><br><br><br><br><br></div></td>';


          $daytracker++;
          $ii++;
        }

        if($daytracker%7==0 and $ii!=0){
		if(($days[$i]-6)<$ii) 
		  echo "</tr><tr>";
		else	
		  echo"</tr>";
        }

    }

    echo'</tbody></table>';
  }
  // ****--------End: Day by Day---------****
 ?>
