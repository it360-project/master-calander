  <!-- visitors can only access this page if logged in -->

  <!--
  // Author: Jess Lonetti,Greg Polmatier,Sam Kim...CS Department(Navbar and CSS)
  // Title: Master Calander
  // Date: 4.26.2020
  // ****--------FUNCTIONALITY---------****
  // This allows access to a users whole schedule
  // if calander is made using the default cs page style
  //
  </style>
 -->

<?php
  require_once('./login/auth.inc.php');
?>



<!DOCTYPE html>

<html lang="en" style="background-color:#F2FEFE;">


  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head;
         any other head content must come *after* these tags -->

    <!-- My css -->
    <link rel="stylesheet" href="my.css">

    <!-- Icon to use on the browser bar -->
    <link rel="icon" href="calendar/images/web-icon.png">

    <!-- Bootstrap core CSS -->
    <link href="calendar/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Skeleton CSS -->
    <link rel="stylesheet" href="calendar/Skeleton/css/normalize.css">
    <link rel="stylesheet" href="calendar/Skeleton/css/skeleton.css">
    <link rel="stylesheet" href="calendar/css/skeleton-modifications.css">


    <!-- Styles for the submission System -->
    <link href="calendar/css/calendar-default.css" rel="stylesheet">



    <!-- Styles for the submission System -->
    <link href="calendar/css/calendar-default.css" rel="stylesheet">



    <!-- Highlight.js -->
    <link rel="stylesheet" href="calendar/highlight/styles/color-brewer.css">
    <script src='calendar/highlight/highlight.pack.js'></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <!-- Font-Awesome -->
    <link rel="stylesheet" type="text/css" href="calendar/Font-Awesome/css/font-awesome.min.css">

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="calendar/datatables.net/datatables.min.css"/>

    <!-- Printing -->
    <link rel="stylesheet" type="text/css" media="print" href="calendar/css/calendar-print.css" />

    <!-- Custom CSS based on user preferences -->


    <!-- Custom JavaScript based on user preferences -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="calendar/jquery/js/jquery-3.4.1.min.js"></script>
    <script src="calendar/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="calendar/bootstrap3-ie10-viewport-bug-workaround/ie10-viewport-bug-workaround.js"></script> -->
    <!-- DataTables -->
    <script type="text/javascript" src="calendar/datatables.net/datatables.min.js"></script>

  <title>Master-Calander</title>

  </head>

  <body style="background-color:#F2FEFE;">


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


            <li><a href="#">
                Master Calendar</a></li>
            <li><a href="home.php?logoff=1">Sign out</a></li>
            <li><a href="http://submit.cs.usna.edu/site/home.php">Submission</a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

  <!-- End TopBar and CSS Stuff! -->
<!-- Begin providing the contents of the page -->

<div class="container" id="cal">


</div>
 <!-- /container AKA CALANDER -->
</body>
<script src="Calander_Maker/calander.js"></script>
</html>
