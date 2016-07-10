<?php



 ?>


<html>
    <?php include 'features/banner.php' ?>

  <head>
    <h1>List of Courses</h1>
  </head>

  <body>


    <ul> <!-- Will have some type of loop here. Will use bootstrap (http://www.w3schools.com/bootstrap/bootstrap_collapse.asp) to make items collapsible.-->
      <li><h5>Introduction to Computer Science</h5> <a href="#collapsible">View Course</a></li>
      <div id="collapsible">
        <h4>Short Description of Course</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec neque ante. Donec id diam vel risus mattis molestie.
          Nunc fringilla faucibus lorem non sollicitudin. Duis finibus commodo mi, eu feugiat ligula malesuada nec. Cras eget maximus mi.
          Aenean vel diam gravida, venenatis mi in, malesuada turpis. Mauris velit sapien, laoreet vel eleifend et, varius in neque.
          Sed mollis ex mauris.
        </p>

        <h4>Group Projects</h4>
        <ul>
          <li><a href="student-start-project.php">Map Coloring</a></li>
          <li><a href="student-start-project.php">Game</a></li>
          <li><a href="student-start-project.php">Map Game</a></li>
        </ul>
        <a>View Attachments</a>
      </div>
      <li> <h5>Real Life Implementations of Machine Learning Algorithms</h5> <a href="#collapsible">View Course</a></li>
      <li> <h5>Mobile Development for Social Good</h5> <a href="#collapsible">View Course</a></li>
      <li> <h5>User Interface Design</h5> <a href="#collapsible">View Course</a></li>
    </ul>




    <form method="post" action="student-courses.php">
      <h2>Add New Course</h2>
      <input type="text" name="registration-code" placeholder="Enter Course Registration Code">
      <input type="submit" name="student-add-course" value="Submit">
    </form>



  </body>
</html>
