<?php
/* Author: MIDN 2/C Samuel Kim
 * Purpose: consolidate the functions and logic necessary for tracking
 *      user logins, session information and corresponding database 
 *      inserts/updates.
 * This code is adapted from Lab 07: PHP Sessions.
 */

//THIS FILE IS NOT A DUPLICATE (has minor changes for files within subdirectories)
require_once('../../../../../priv/mysql.inc.php');
//connect to SQLiteDatabase
$db = new myConnectDB();

//begin session and retrieve sessionID
session_start();
$sessionid = session_id();

//retrieve information from session array
$username = $_SESSION['user']['user'];
$fullname = $_SESSION['user']['fullname'];
$first = $_SESSION['user']['first'];
$last = $_SESSION['user']['last'];

//log user off if requested and redirect
if (isset($_REQUEST['logoff'])) {
  logoff($db, $sessionid);
  header('Location: ../login/login.php');
  die;
}

//log user on if credentials were inputted
if ($username) {
  //validate credentials, redirect if validation fails
  if (!logon($db, $username, $sessionid)) {
    header('Location: ../login/login.php');
    die;
  }
}

//verify user is logged in, otherwise redirect
$user = verify($db, $sessionid);
  if ($user == '') {
  header('Location: ../login/login.php');
  die;
}

/*
logon() allows users to log in to the application
links a session to a user (database backend)
Input: $db mysqli object
$username - string password provided by user
$sessionid - string result of session_start()
Output: true if credentials are valid and a session was created
*/
function logon($db, $username, $sessionid) {
  //build query
  $query = "SELECT alpha
  FROM auth_user
  WHERE alpha = ?";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($query);
  $stmt -> bind_param ('s', $username);

  $success = $stmt -> execute();
  $stmt -> store_result();
  $num_rows = $stmt->num_rows;

  //Return error if query returns no result
  if ($num_rows == 0){
    return signUp($db, $username, $first, $last);
  }
  else {
    //if query is successful, retrieve the results
    if($success) {
      $stmt -> store_result();
      $stmt -> bind_result( $user );

      //retrieve sessionID
      $stmt -> fetch();
    }
    $stmt->close();
  }

  //update user's last login to the application
  $lastloginQuery = "UPDATE auth_user
  SET lastlogin = NOW()
  WHERE alpha = ?";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($lastloginQuery);
  $stmt -> bind_param ('s', $username);

  $success = $stmt -> execute();

  //error messages
  if ($db -> affected_rows == 0){
    echo "<h5> logon(): ERROR! No rows updated in auth_user( lastlogin )!</h5>";
    return FALSE;
    //kill script if no results are returned
    die;
  }else if (!$success) {
    echo "<h5> ERROR: " . $db -> error . " for query *$lastloginQuery* in login()! </h5><hr> Please Try Again!";
    return FALSE;
    //kill script if query was unsuccessful
    die;
  }
  $stmt -> close();

  //store username and sessionID in session table in database
  $sessionQuery = "INSERT INTO auth_session (id, alpha, lastVisit)
  VALUES(?, ?, NOW())
  ON DUPLICATE KEY UPDATE lastvisit=NOW()";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($sessionQuery);
  $stmt -> bind_param ('ss', $sessionid, $username);

  $success = $stmt -> execute();

  //if query returns no results, or otherwise fails, print error message
  if ($db -> affected_rows== 0){
    echo "<h5> logon(): ERROR! No rows updated in auth_user(lastlogin)!</h5>";
  } else if (!$success) {
    echo "<h5> ERROR: " . $db -> error . " for query *$sessionQuery* in login()! </h5> Please Try Again!";
  }

  return $success;
}

/*
signUp() allows users to create an account
inserts a row for the user in the users table of the database
Input: $db mysqli object
$username - string username inputted by user
$sessionid - string result of session_start()
Output: true if a row was successfully inserted for the user
*/
function signUp($db, $username, $first, $last) {
  //SQL Insert statement generated:
  $query = "INSERT INTO auth_user (alpha, lastlogin, firstName, lastName)
  VALUES(?, NOW(), ?, ?)";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($query);
  $stmt -> bind_param ('sss', $username, $first, $last);
  $success1 = $stmt -> execute();

  // prevent creation of duplicate usernames
  if ($db->errno == 1062) { // 1062 = duplicate key error number!
    echo "Username: $username already taken, please select another username and try again!!!";
  } else if ( !$success1 || $db -> affected_rows == 0 ){
    echo "<h5>ERROR: " . $db -> error . " for query *$query* in signUp()</h5><hr> Please Try Again!";
  }

  //only create second INSERT statement if previous INSERT was successful
  if($success1) {
    $sessionQuery = "INSERT INTO auth_session (id, alpha, lastVisit)
    VALUES(?, ?, NOW())
    ON DUPLICATE KEY UPDATE lastvisit=NOW()";

    $stmt = $db -> stmt_init();
    $stmt -> prepare($sessionQuery);
    $stmt -> bind_param ('ss', $sessionid, $username);

    $success2 = $stmt -> execute();

    //if query returns no results, or otherwise fails, print error message
    if ($db -> affected_rows== 0){
      echo "<h5> logon(): ERROR! No rows updated in auth_user(lastlogin)!</h5>";
    } else if (!$success2) {
      echo "<h5> ERROR: " . $db -> error . " for query *$sessionQuery* in login()! </h5> Please Try Again!";
    }
  }

  if($success1 && $success2)
    return true;

  return false;
}

/*
logoff() allows users to log out of the application
removes user's row from session table in database
Input: $db mysqli object
$sessionid - string result of session_start()
Output: true if user's session was successfully deleted
*/
function logoff($db, $sessionid) {
  //delete matching row for user in session table in database
  $sessionRemove = "DELETE FROM auth_session
  WHERE id = ? ";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($sessionRemove);
  $stmt -> bind_param ('s', $sessionid);
  $success = $stmt -> execute();

  //destroy session on user logoff
  session_destroy();

  return $success;
}

/*
verify() checks if a user's sessionid is valid
queries the sessionid in the database
ensures that the user's last visit and login were within a reasonable timeframe
Input: $db mysqli object
$sessionid - string result of session_start()
Output: $user - a string username matching the provided sessionid
*/
function verify( $db, $sessionid) {
  //query the database
  $query = "SELECT alpha, session
  FROM auth_user INNER JOIN auth_session USING ( alpha )
  WHERE ( NOW() < (DATE_ADD( lastvisit, INTERVAL 1 HOUR )))
  AND ( NOW() < (DATE_ADD( lastlogin, INTERVAL 1 DAY )))
  AND id = ?";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($query);
  $stmt -> bind_param ('s', $sessionid);

  $success = $stmt -> execute();
  $stmt -> store_result();

  $num_rows = $stmt->num_rows;

  $stmt -> bind_result($user, $session);
  $stmt -> fetch();

  //error checking if there was a problem retrieving username for sessionID
  if ($num_rows == 0){
    echo "<h5> verify(): No existing valid session, send user to logon()!";
  } else if (!$success){ // always return query errors
    echo "<h5> ERROR: " . $db -> error . " for query *$query* in verify()! </h5><hr> Please Try Again!";
  }

  $stmt -> close();

  //populate session array
  $valid_user = '';
  if ( !empty( $user ) ){
    session_decode($session);

    $valid_user = $user;
  }

  //update session table in database
  $querySession = "UPDATE auth_session
  SET lastvisit=NOW()
  WHERE id=?";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($querySession);
  $stmt -> bind_param ('s', $sessionid);

  $success = $stmt -> execute();

  //error checking
  if ( !$success ) {
    echo "<h5> ERROR: " . $db -> error . " for query *$querySession* in verify()! </h5><hr> Please Try Again!";
  }

  // Return $username or '' if checks fail!
  return $valid_user;
}

/*
update() makes necessary updates to a user's session information in the database
removes user's row from session table in database
Input: $db mysqli object
$username - string provided by user
$sessionString - string result of session_encode()
Output: true if user insertion into database was successful
*/
function update( $db, $username, $sessionString, $test = FALSE ){
  //Update the session information for user in auth_user(session):
  $query = "UPDATE auth_user
  SET session = ?
  WHERE alpha = ?";

  $stmt = $db -> stmt_init();
  $stmt -> prepare($query);
  $stmt -> bind_param ('ss', $sessionString, $username);

  $success = $stmt -> execute();

  //Error check, success message only when requested via $test:
  if ( !$success ){
    echo "<h5>ERROR: " . $db -> error . " for query *$query*</h5> in setSession()<hr> Please Try Again!";
  }

  return $success;
}

//regularly update user information in the table
update($db, $username, session_encode());
?>

