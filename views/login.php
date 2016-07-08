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

    <div class="sign-up">
      <h2>Sign Up</h2>
      <a href="#student-sign-up"><button>Student</button></a>
      <a href="#instructor-sign-up"><button>Instructor</button></a>
    </div>



    <div id="student-sign-up" class="modal-dialog">
      <div>
  		  <a href="#close" title="Close" class="close">close</a>
  		  <h2>Student Sign Up</h2>
        <form method="post" action="login.php">
          <p><input type="text" name="first-name" placeholder="First Name">
            <input type="text" name="last-name" placeholder="Last Name"></p>
          <p><input type="text" name="email" maxlength="255" placeholder="Email"></p>
          <p><input type="text" name="password" maxlength="32" placeholder="Password"></p>
          <p><input type="text" name="confirm-password" maxlength="32" placeholder="Confirm Password"></p>
          <p><input type="radio" name="age-range" value="0-18">18 or younger
            <input type="radio" name="age-range" value="19-29">19-29
            <input type="radio" name="age-range" value="30-39">30-39
            <input type="radio" name="age-range" value="30-39">30-39

          </p>
          <p><input type="submit" name="sign-in" value="Sign In"></p>
        </form>
  	  </div>
    </div>

    <div id="instructor-sign-up" class="modal-dialog">
      <div>
  		  <a href="#close" title="Close" class="close">close</a>
  		  <h2>Instructor Sign Up</h2>
        <form method="post" action="login.php">
          <p><input type="radio" name="account-type" value="student">Student
            <input type="radio" name="account-type" value="instructor">Instructor</p>
          <p><input type="text" name="email" maxlength="255" placeholder="Email"></p>
          <p><input type="text" name="password" maxlength="32" placeholder="Password"></p>
          <p><input type="submit" name="sign-in" value="Sign In"></p>
        </form>
  	  </div>
    </div>

    <div class="sign-in">
      <h2>Sign In</h2>
      <form method="post" action="login.php">
        <p><input type="radio" name="account-type" value="student">Student
          <input type="radio" name="account-type" value="instructor">Instructor</p>
        <p><input type="text" name="email" maxlength="255" placeholder="Email"></p>
        <p><input type="text" name="password" maxlength="32" placeholder="Password"></p>
        <p><input type="submit" name="sign-in" value="Sign In"></p>
      </form>

    </div>







  </body>
</html>
