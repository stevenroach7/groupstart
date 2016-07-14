<!-- Banner at the top of each page. Check if logged in and if not, redirect to login page. If so, show logout button-->
<?php

?>


<link rel="stylesheet" type="text/css" href="../css/style.css" />


<php

<?php
if (isset($_SESSION['type'])) { // Create redirect links for banner.
  if ($_SESSION['type'] == 'student') {
    $logo = '<a class="banner pull-left" href="student-courses.php" style="text-align:left"><h1>GroupStart</h1></a>';
  } else {
    $logo = '<a class="banner pull-left" href="instructor-courses.php" style="text-align:left"><h1>GroupStart</h1></a>';
  }
} else { // Test this
  $logo = '<a class="banner pull-left" href="login.php" style="text-align:left"><h1>GroupStart</h1></a>';
}

  $settings ='<a href="student-settings.php"><span class="glyphicon glyphicon-cog pull-right" style="font-size: 40px; margin-top:20px;"></span></a>';

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $logout = "<a href='features/logout.php'>Logout</a>";
  } else {
    $logout = "";
  }

  $banner = '<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">'.$logo.$settings.$logout.'</div></nav>';


  ?>


?>



</html>
