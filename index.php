<?php

  // header('Refresh: 0; URL=views/login.php');



 ?>


<html>
<link rel="stylesheet" type="text/css" href="css/style.css" />


<script src="js/dropzone.min.js"></script>

<head>
  <h1>GroupStart</h1>

</head>


<body>

  <p>
    GroupStart is an experimental, alpha-stage application
     that seeks to facilitate the early stages of an online group project.
  </p>
  <h5>University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5>

  <a href="views/login.php">Login</a>


  <?php
    $name = "Steven";
    $name1 = "Tosin";
    echo "<h3>Welcome to GroupStart, ".$name." and ".$name1.".</h3>";
  ?>





  <form action="../php_scripts/upload.php" class="dropzone"></form>



</body>
