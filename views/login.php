<?php




 ?>


<html>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />


  <head>
    <h1>GroupStart</h1>
  </head>


  <body>

    <p>
      GroupStart is an experimental, alpha-stage application
       that seeks to facilitate the early stages of an online group project.
    </p>
    <h5>University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5>

    <a href="#loginModal">Login</a>

    <div id="loginModal" class="modalDialog">
      <div>
  		  <a href="#close" title="Close" class="close">X</a>
  		  <h2>Login</h2>
  		  <p>This is a sample modal box that can be created using the powers of CSS3.</p>
  		  <p>You could do a lot of things here like have a pop-up ad that shows when your website loads, or create a login/register form for users.</p>
  	  </div>

    </div>


    <?php
      $name = "Steven";
      $name1 = "Tosin";
      echo "<h3>Welcome to GroupStart, ".$name." and ".$name1.".</h3>";
    ?>




  </body>
</html>
