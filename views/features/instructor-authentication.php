<?php



// We checked to make sure session type was student or instructor in authentication.php
// so we just need to check if they are a student trying to access an instructor page.
if ($_SESSION['type'] == 'student') {
  // Redirect to student home page
  header('Location: http://localhost/groupstart/views/student-courses.php');
}



?>
