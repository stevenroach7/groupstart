<?php



 ?>


<html>
    <?php include 'features/banner.php' ?>

  <head>
    <h1>Group Forming Questionnaire</h1>
  </head>

  <body>


    <h6>Pick 3 projects that you would like to complete</h6>
    <ul> <!-- Will have some type of loop here. Will use bootstrap (http://www.w3schools.com/bootstrap/bootstrap_collapse.asp) to make items collapsible.-->
      <li><h5>Redesign Coursera</h5> <a href="#collapsible">View Project</a></li>
      <div id="collapsible">
        <h4>Short Description of Project</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec neque ante. Donec id diam vel risus mattis molestie.
          Nunc fringilla faucibus lorem non sollicitudin. Duis finibus commodo mi, eu feugiat ligula malesuada nec. Cras eget maximus mi.
          Aenean vel diam gravida, venenatis mi in, malesuada turpis. Mauris velit sapien, laoreet vel eleifend et, varius in neque.
          Sed mollis ex mauris.
        </p>
      </div>
      <li> <h5>Make an app for gaming addiction</h5> <a href="#collapsible">View Project</a></li>
      <li> <h5>Meeting Finding Platform</h5> <a href="#collapsible">View Project</a></li>
      <li> <h5>Quit Smoking Platform</h5> <a href="#collapsible">View Project</a></li>
    </ul>
    <form method="post" action="student-cluster-form.php">
      <p><input type="text" name="q1" placeholder="Question 1">
      </p>
      <p><input type="text" name="q2" maxlength="255" placeholder="Question 2"></p>
      <p><input type="text" name="q3" maxlength="255" placeholder="Question 3"></p>
      <p><input type="text" name="q4" maxlength="32" placeholder="Question 4"></p>
      <p><input type="text" name="q5" maxlength="32" placeholder="Question 5"></p>
      <p><input type="submit" name="submit-group-form" value="Submit"></p>

    </form>

    <a href="student-charter-form.php">Go to Group Introduction Step</a>
  </body>
</html>
