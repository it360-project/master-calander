<?php
  /*
   * Author: MIDN 2/C Samuel Kim
   * Purpose: page which presents two successive forms:
        first form for entering how many courses currently being taken
        second form for entering courses
   */
  require_once('../login/nested_auth.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head;
         any other head content must come *after* these tags -->

    <!-- Icon to use on the browser bar -->
    <link rel="icon" href="../calendar/images/web-icon.png">

    <!-- Bootstrap core CSS -->
    <link href="../calendar/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Skeleton CSS -->
    <link rel="stylesheet" href="../calendar/Skeleton/css/normalize.css">
    <link rel="stylesheet" href="../calendar/Skeleton/css/skeleton.css">
    <link rel="stylesheet" href="../calendar/css/skeleton-modifications.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="calendar/bootstrap3-ie10-viewport-bug-workaround/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Fonts -->
    <!-- <link href='calendar/fonts/raleway.css' rel='stylesheet' type='text/css'> -->

    <!-- Ace Code Editor - https://ace.c9.io/ -->
    <!-- <script type="text/javascript"
      src="calendar/ace-builds/src-noconflict/ace.js" charset="utf-8">
    </script> -->

    <!-- Chart.js - http://www.chartjs.org -->
    <!-- <script type="text/javascript"
      src="calendar/chartjs/Chart.bundle.min.js" charset="utf-8">
    </script> -->

    <!-- To support challenge/response authentication within course notes-->
        <!-- <script type="text/javascript">
      var nonce = "b227c3c5011d9512561e1dc358731d9b7e7f953d566b201369061f375e010899";
    </script>
    <script type="text/javascript" src="calendar/js/sha256.js"></script> -->

    <!-- Styles for the submission System -->
    <link href="../calendar/css/calendar-default.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- MathJax -->
    <!-- <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
        tex2jax: {
          inlineMath: [ ["\\(","\\)"] ],
          processEscapes: true
        }
      });
    </script>
    <script type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML">
    </script> -->

    <!-- Highlight.js -->
    <link rel="stylesheet" href="../calendar/highlight/styles/color-brewer.css">
    <script src='../calendar/highlight/highlight.pack.js'></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="../calendar/Font-Awesome/css/font-awesome.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="../calendar/datatables.net/datatables.min.css"/>

    <!-- Printing -->
    <link rel="stylesheet" type="text/css" media="print" href="../calendar/css/calendar-print.css" />

    <!-- Custom CSS based on user preferences -->


    <!-- Custom JavaScript based on user preferences -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../calendar/jquery/js/jquery-3.4.1.min.js"></script>
    <script src="../calendar/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="calendar/bootstrap3-ie10-viewport-bug-workaround/ie10-viewport-bug-workaround.js"></script> -->
    <!-- DataTables -->
    <script type="text/javascript" src="../calendar/datatables.net/datatables.min.js"></script>

  <title>Master-Calander</title>

  </head>
  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!--
            <a class="navbar-brand" href="#">
              <img alt="Navbar!" src="css/images/web-icon.png" width="24">
            </a>
          -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

            <li><a href="../calendar.php?load=home">
                IT360 - Applied Database Systems</a></li>


            <li><a title="Calendar" href="../calendar.php?show=calendar_display">
                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                </a></li>

            <li><a title="Resources" href="../calendar.php?load=resources">
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
                </a></li>

            <li><a title="Information" href="../calendar.php?load=policy">
                <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                </a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

  <!-- End TopBar and CSS Stuff! -->
    <div class='container'>
      <div class='row'>
        <h2> Course Entry </h2><br>
      </div>
      <div class='row'>
        <?php
          //present form for number of courses
          if(!isset($_POST['numCourses'])) {
            numForm();
          }
          //present form for course entry if number of courses has been submitted
          else {
            codeForm();
          }
        ?>
      </div>
    </div>
  </body>
</html>

<?php
  /* Purpose: generate a form asking for number of courses being taken
   * Input: none
   * Output: HTML for one-line form
   */
    function numForm() {
      //form action is itself (in order to fill out the actual courses themselves after submitting)
      echo "<form method='POST' action='courseForm.php'>
              <label for='numCourses'>Number of courses this semester</label>
              <input type='text' id='numCourses' name='numCourses' placeholder='5'>
              <button type='submit' class='btn btn-default'>Submit</button>
            </form>";
    }

  /* Purpose: generate a form asking for list of courses being taken
   * Input: none
   * Output: HTML for form with variable lines based on response to numForm()'s form
   */
  function codeForm() {
	echo "<h5>Warning: only CS/IT courses will be populated in the calendar</h5>";
      echo "<form method='POST' action='insertStudentCourses.php'>
              <label for='numCourses'>Courses</label>";

      //retrieve submitted input from previous form
      $numCourses = $_POST['numCourses'];

      //cap number of courses at 10 (arbitrary number in case of malicious entry)
      if($numCourses > 10)
	     	$numCourses = 10;

      //first text input has placeholder, store inputs in an array
      echo "<input list='courses' type='text' id='course1' name='course[]' placeholder='IT360, APPLIED DATABASE SYSTEMS' size='40' required><br>";
      for($i = 1; $i < $numCourses; $i++) {
        echo "<input list='courses' type='text' id='course$i' name='course[]' size='40' required><br>";
      }

      //include HTML for autocomplete mechanism
      insertDataList();

      echo "<button type='submit' class='btn btn-default'>Submit</button>
          </form>";
    }

    /* Purpose: implement HTML5 autocomplete for course entries
       Input: none
       Output: HTML for autocompletion of courses
    */
    function insertDataList() {
      //code for HTML5 autocomplete
      echo "<datalist id='courses'>";

      //open filestream for list of courses
      $file = fopen("../courses/courses.csv","r");
      //read in first line of format
      fgets($file);

      //loop for reading file line by line
      while(!feof($file)) {
        $line = fgets($file);
        echo "<option value = '$line'/>";
      }

      echo "</datalist>";
    }
?>

