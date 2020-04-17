
<?php
  session_start();
  $_SESSION['user']= array("user"=>"m213220","fullname"=>"Jes Lonetti","first"=>"Jess","last"=>"Lonetti","department"=>"Computer Science Department","time"=>time(),"max"=>5);
  if(!isset($_SESSION['user'])){
    require_once('lib_authenticate.php');
    $_SESSION['user']['user']['max']=5;
    // echo "<pre>";
    //print_r($_SESSION);
    // echo "</pre>";
  }
  else{

    echo '
    <div id="myModal" class="modal" >
      <div id="myModCon" class="modal-content">
      WELCOME '.$_SESSION['user']['first'].' '.$_SESSION['user']['last'].'! Votes left: '.$_SESSION['user']['max'].'

      </div>
    </div>
    ';
    }
  
  // If a real login was performed then the users information would now be
  // available in the $_SESSION super global.  The
  // resulting values within $_SESSION should look like:


  // Array
  // (
  //     [user] => Array
  //         (
  //             [user] => m123456
  //             [fullname] => MIDN John Paul Jones
  //             [first] => John
  //             [last] => Jones
  //             [department] => Computer Science Department
  //             [time] => 1234567890
  //         )
  //
  // )

  // To assist with your debugging, this example script will output
  // the information that was returned for your review.



 ?>
