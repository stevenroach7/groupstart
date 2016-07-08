<?php



 ?>


<html>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />

  <head>
    <?php include 'features/banner.php' ?>
    <h1>Group Introduction Questionnaire</h1>
  </head>

  <body>
    <form method="post" action="student-charter-form.php">
      <p><input type="text" name="q1" placeholder="Question 1">
      </p>
      <p><input type="text" name="q2" maxlength="255" placeholder="Question 2"></p>
      <p><input type="text" name="q3" maxlength="255" placeholder="Question 3"></p>
      <p><input type="text" name="q4" maxlength="32" placeholder="Question 4"></p>
      <p><input type="text" name="q5" maxlength="32" placeholder="Question 5"></p>
      <p><input type="submit" name="submit-group-form" value="Submit"></p>

    </form>

    <a href="student-project.php">Go to Group Page</a>

  </body>
</html>
