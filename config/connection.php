<?php

  $hostname = "localhost";
  $username = "root";
  $password = ""; // password here
  $dbname = "groupstartdb"; // Database name here

  // making the connection to Mysql Connection
  $db = mysqli_connect($hostname, $username, $password, $dbname) OR die("could not connect to database, ERROR:".mysqli_connect_error());


  //set encoding
  mysqli_set_charset($db, "utf8");

  // echo "you are connected to ".$dbname." database.";

?>
