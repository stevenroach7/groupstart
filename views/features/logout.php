<?php

  session_start();

  $type = $_SESSION['type'];


  // Unset all of the session variables.
  $_SESSION = array();

  // If it's desired to kill the session, also delete the session cookie.
  // Note: This will destroy the session, and not just the session data!
  // if (ini_get("session.use_cookies")) {
  //     $params = session_get_cookie_params();
  //     setcookie(session_name(), '', time() - 42000,
  //         $params["path"], $params["domain"],
  //         $params["secure"], $params["httponly"]
  //     );
  // }

  // Finally, destroy the session.
  // session_destroy();
  // echo "Session should be destroyed.";
  $_SESSION['loggedin'] = false;



  // Check if student or instructor before redirecting
  if ($type == 'student') {
    header('Location: https://groupstartstudents.auth0.com/v2/logout?returnTo=http://localhost/groupstart/views/login.php');
  } elseif ($type == 'instructor') {
    header('Location: https://groupstartinstructors.auth0.com/v2/logout?returnTo=http://localhost/groupstart/views/login.php');
  } else {
    header('Location: http://localhost/groupstart/views/login.php');
  }

?>
