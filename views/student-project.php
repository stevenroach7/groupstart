<?php


 ?>


<html>
<?php
  include 'features/authentication.php';
  include 'features/student-authentication.php';
  include 'features/banner.php'
?>

  <head>

     <?php include 'features/banner.php' ?>

      <link rel="stylesheet" type="text/css" href="../css/style.css" />

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <!-- Latest compiled JavaScript -->
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </head>

  <body>
      <?php echo $banner ?>

      <?php

        include '../config/connection.php';


        // TODO: Get course id
        // TODO: Use course id and student_id to allow for easy navigation to other projects.
        // TODO: Add project deliverables display_name
        // TODO: Add project deliverables form upload

        $project_group_id = $_GET['project_group_id'];


        // Get group of students in this project
        $get_project_group = mysqli_query($db, "SELECT * FROM project_group WHERE project_group_id = '".$project_group_id."'");

        // We are querying based off of a primary key so the result should be unique.
        $row = mysqli_fetch_assoc($get_project_group);
        $project_id = $row['project_fk'];

        // Get students in project group
        $student_ids = array(); // array of student_ids of students in project group
        $get_students = mysqli_query($db, "SELECT * FROM project_group_students WHERE project_group_fk = '".$project_group_id."'");

        if (mysqli_num_rows($get_students) > 0) {
            while ($row = mysqli_fetch_assoc($get_students)) {
                $student_ids[] = $row['student_fk'];
            }
        }

        // Create array of student information from student_projects table.
        $student_project_info = array(); // Initialize empty array to hold arrays of info for each student.

        foreach ($student_ids as $student_id) {
            $student_info = array(); // Initialize array of info
          $student_info['student_id'] = $student_id;

          // Use student_id to query students table to get display_name
          $get_student = mysqli_query($db, "SELECT * FROM students WHERE student_id = '".$student_id."'");

          $row = mysqli_fetch_assoc($get_student); // student_id is the primary key so only one result should be returned.

          $student_info['display_name'] = $row['display_name'];

          // Use student_id and project_id to query student_projects to get student_project info
          $get_student_projects = mysqli_query($db, "SELECT * FROM student_projects WHERE student_fk = '".$student_id."' AND project_fk = '".$project_id."'");

          $row = mysqli_fetch_assoc($get_student_projects); // Intersection of student_id and project_id is unique so only one result should be returned.
          // Get motivation sentence.
          $student_info['motivation'] = $row['motivation'];

          // Create array of expectation inputs.
          $expectations = array('work' => $row['work'], 'inform' => $row['inform'], 'messages' => $row['messages'],
          'progress' => $row['progress'], 'consensus' => $row['consensus'], 'diversity' => $row['diversity'],
          'honest' => $row['honest'], 'active' => $row['active'], 'trust' => $row['trust'], 'respect' => $row['respect'], );
          // Add expectations array to student_info
          $student_info['expectations'] = $expectations;

          // Add student info array to array holding a student_info array for each student
          $student_project_info[] = $student_info;
        }




        // Use student_project_info array to calculate group expectations

        /*
        * Takes a student_project_info array and returns an array of student expectation arrays.
        */
         function create_expectations_info($student_project_info) {
          $expectations_info = array();

          foreach ($student_project_info as $student_info) {
            $expectations_info[] = $student_info['expectations'];
          }
          return $expectations_info;
        }

        /*
        * Takes an array of expectation preferences arrays and returns an associative array holding the number of times each expectation is true in the expectation_arrays.
        */
        function calculate_expectation_counts($expectation_arrays) {

          $expectations_counts = array(); // Holds the number of times each expectation has been counted true.

          foreach ($expectation_arrays as $expectations) {
            foreach ($expectations as $expect_key => $expect_val) {

              if ($expect_val == 1) {

                if (!array_key_exists($expect_key, $expectations_counts)) { // check if expectation has been counted yet.
                  $expectations_counts[$expect_key] = 1; // initialize count as 1
                } else {
                  $expectations_counts[$expect_key]++; // key exists so increment count
                }
              }

            }
          }
          return $expectations_counts;
        }

        /*
        * Takes an associative array of expectations and their counts, a denominator to use to calculate percentages and a percentage value.
        * Returns the expectations where the count / $total is greater than $pct.
        */
        function filter_expectations_counts($expectations_counts, $total, $pct) {

          $true_expectations = array(); // Holds keys of expectations that are true in at least $pct of the expectation_arrays.

          foreach($expectations_counts as $expect_key => $count) {
            if ($count / $total >= $pct) {
              $true_expectations[] = $expect_key;
            }
          }
          return $true_expectations;
        }

        /*
        * Takes an array of expectations arrays and a percent and returns an array of the expectations that were true in
        * at least $pct of the expectation_arrays.
        */
        function calculate_group_expectations($expectation_arrays, $pct) {

          // Create array holding number of times each expectation is true in the expectation_arrays.
          $expectation_counts = calculate_expectation_counts($expectation_arrays);

          // Filter expectation_counts arrays for the expectations counted $pct or more percent of the time
          $num_arrays = count($expectation_arrays); // Holds number of possible expectations. Will act as denominator in calculating percent.

          return filter_expectations_counts($expectation_counts, $num_arrays, $pct);
        }

        // Create array of only expectations data.
        $expectations_info = create_expectations_info($student_project_info);

        // Calculate group expectations that should be displayed
        $true_expectations = calculate_group_expectations($expectations_info, 0.5);

        // Messages to display based off of expectation keys.
        $expectation_messages = array(
        'work' => 'Complete agreed upon work on time',
        'inform' => 'Inform of non-completion',
        'messages' => 'Read and respond to messages within agreed time',
        'progress' => 'Inform others of progress',
        'consensus' => 'Respect consensus decisions',
        'diversity' => 'Value diversity',
        'honest' => 'Be honest',
        'active' => 'Play an active part in team',
        'trust' => 'Trust each other',
        'respect' => 'Respect each other'
        );




        // Script to get Communication tools and links and handle deletes and additions.

        // Add communication tool and link
        if (isset($_POST['add-com-submit'])) {

          $name = $_POST['tool'];
          $link = $_POST['link'];

          // Insert into communications table.
          $insert = "INSERT INTO `communications` (`communication_id`, `name`, `link`, `project_group_fk`)
          VALUES (NULL, '$name', '$link', '$project_group_id')";

          $retval = mysqli_query($db, $insert); // performing mysql query

          if (!$retval) {
            // if data is not inserted into database return error
            die('Could not enter data given: '.mysqli_error($db));
          };

          header("Location: http://localhost/groupstart/views/student-project.php?project_group_id=$project_group_id");
        }

        // Get group communication tools and links
        $communications = array();

        $get_communications = mysqli_query($db, "SELECT * FROM communications WHERE project_group_fk = '".$project_group_id."'");

        if (mysqli_num_rows($get_communications) > 0) {

          while ($row = mysqli_fetch_assoc($get_communications)) {
            $communication = array();
            $communication['tool'] = $row['name'];
            $communication['link'] = $row['link'];
            $communication['communication_id'] = $row['communication_id'];
            $communications[] = $communication;
          }
        }




        // Get Deliverables for this project
        $deliverables = array();

        $get_deliverables = mysqli_query($db, "SELECT * FROM project_deliverables WHERE project_fk = '".$project_id."'");

        if (mysqli_num_rows($get_deliverables) > 0) {

          while ($row = mysqli_fetch_assoc($get_deliverables)) {
            $deliverable = array();
            $deliverable['project_deliverable_id'] = $row['project_deliverable_id'];
            $deliverable['title'] = $row['title'];
            $deliverable['description'] = $row['description'];
            $deliverable['due_date'] = $row['due_date'];
            $deliverables[] = $deliverable;
          }
        }


        // Get Deliverable Submissions for this project
        $submissions = array();

        $get_submissions = mysqli_query($db, "SELECT * FROM project_group_project_deliverables WHERE project_group_fk = '".$project_group_id."'");

        if (mysqli_num_rows($get_submissions) > 0) {

          while ($row = mysqli_fetch_assoc($get_submissions)) {
            $submission = array();
            $submission['submission_id'] = $row['project_group_project_deliverables_id'];
            $submission['submission_text'] = $row['submission_text'];
            $submission['project_deliverable_id'] = $row['project_deliverables_fk'];
            $submission[] = $submission;
          }
        }


      ?>


      <div class="container">
	       <div class="row" id="memeber-list-area">
		         <div class="col-md-12">
               <h3>Group Members</h3>
               <div id="member-list">
                 <ul class="list-group" >

                   <?php
                     foreach ($student_project_info as $student_info) {
                         echo "<li class='list-group-item'><label>$student_info[display_name]:</label> $student_info[motivation]</li>";
                     }
                   ?>

                 </ul>
               </div>
		         </div>
             <div class="col-md-12">
               <h3>Group Expectations</h3>
               <div id="member-list">
                 <ul class="list-group" >

                   <?php
                     foreach ($true_expectations as $expectation) {
                       echo "<li class='list-group-item'>$expectation_messages[$expectation]</li>";
                     }
                   ?>

                 </ul>
               </div>
		         </div>
	         </div>
           <br><br>



	         <!-- <div class="row"> -->
		<!--div class="col-md-8" id="milestones-area">
            <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
        <button type="button" class="btn btn-default pull-right">Submit</button>
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        Milestone 1</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body sp">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
        <button type="button" class="btn btn-default pull-right">Submit</button>
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        Milestone 2</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body sp">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading clearfix">
        <button type="button" class="btn btn-default pull-right">Submit</button>
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        Milestone 3</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body sp">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
</div-->

		<!-- </div> -->
        <div class="col-md-12" id="commun-link-area">
    	    <table class="table table-striped">
            <thead>
              <tr><th>Communication Tool</th><th>Link</th></tr>
    		    </thead>
    		    <tbody>
              <?php

              foreach ($communications as $com) {

                echo "<tr><td>$com[tool]</td><td class='pull-right link'>$com[link]</td>
                <td>
                <a href='features/delete-com-tool.php?communication_id=$com[communication_id]&project_group_id=$project_group_id' class='btn btn-primary pull-right' role='button'>Delete Tool</a>

                </td>
                </tr>";
              }

              ?>

              <!-- Show Add tool input as last row -->
              <form action="" method="POST" id="add-com-tool">
                <tr><td><input type="text" name="tool" class="com-input" placeholder="Tool"></td>

                <td class="link"> <input type="text" class="com-input" name="link" placeholder="Link"></td>
                <td>
                  <input type="submit" name="add-com-submit" value="Add Tool" class="btn btn-info" style="margin-left:30px;" form="add-com-tool" id="add-com-submit"/>
                </td></tr>
              </form>

    		    </tbody>
    		  </table>
        </div>
      </div>
    </div>
  </body>
</html>
