<?php
  // User name and password for authentication
  $username = 'rock';
  $password = 'roll';
// $_SERVER supreglobal provides access to the username and password entered buy the user and are checked. !isset = is not set
  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
// The user name/password are incorrect so send the authentication headers
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="Guitar Wars"');
// displays deniel message and makes sure nothing else is sent to the browser
    exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid user name and password to access this page.');
  }
?>