<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    // if user isnt logged in via session, cehcks to see if cookies are set
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      // sets the session variables usig cookies
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>