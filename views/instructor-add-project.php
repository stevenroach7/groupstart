<html>

  <link rel="stylesheet" type="text/css" href="../css/style.css" />

  <head>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>

      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
        tinymce.init({
            selector: "#area-description",
            setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }

        });
  </script>

      <script type="text/javascript" src="../js/add_project.js"></script>
      <script type="text/javascript" src="../js/add_project2.js"></script>

      <script src="../js/dropzone.min.js"></script>

      <script src="../js/nouislider.min.js"></script>

      <script type="text/javascript" src="../js/slider.js"></script>

      <?php
        include 'features/authentication.php';
        include 'features/instructor-authentication.php';
        include 'features/banner.php';
include 'features/instructor-get-courses-data.php'
      ?>
  </head>

  <body>
      <?php echo $banner ?>

      <?php

        include '../config/connection.php';


        $course_fk = $title = $description = $group_importance_statement = $min_group_size = $max_group_size = $group_form_algorithm = ""; //initializing variables for database fields


        if(isset($_POST['submit'])){ //checks if the add project button has been clicked




          // check if file uploads are valid.
          $files_valid = 1; // Boolean
          $files_uploaded = 0; // Integer count

          foreach ($_FILES['file-uploads']['tmp_name'] as $key => $tmp_name) {

            $file_size = $_FILES['file-uploads']['size'][$key];
            $file_tmp = $_FILES['file-uploads']['tmp_name'][$key];
            $file_type = $_FILES['file-uploads']['type'][$key];

            if (is_uploaded_file($file_tmp)) {


              $files_uploaded += 1;

              // Check file size
              if ($file_size > 1000000) { // 1 Megabyte
                  echo 'Sorry, only files smaller than 1 Megabyte are allowed . ';
                  $files_valid = 0;
              } elseif (!$file_size > 0) { // 1 Megabyte
                  echo 'Invalid file uploaded . ';
                  $files_valid = 0;
              }

              // Allow certain file formats
              if ($file_type != 'application/pdf') {
                  echo 'Sorry, only PDF files are allowed. ';
                  $files_valid = 0;
              }
            }
          }



          // Add validation conditional and insert query.






            if(empty($_POST['title']) || (empty($_POST['description'])) || (empty($_POST['min_group_size'])) || (empty($_POST['max_group_size'])) || (empty($_POST['group_form_algorithm'])) ){ //checking that required fields in form is filled

              echo 'A required field is empty. ';

            } elseif ($files_valid === 0) {
              echo 'Please try again. ';
            } else {
              //setting initialized variables to values entered by user

              $title = $_POST['title'];
              $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
              $group_importance_statement = $_POST['group_importance_statement'];
              $min_group_size = $_POST['min_group_size'];
              $max_group_size = $_POST['max_group_size'];
              $group_form_algorithm = $_POST['group_form_algorithm'];
              $course_fk = $_GET['course_id'];

              //mysql query to insert values into respective fields
              $query = "INSERT INTO projects (project_id, course_fk, title, description, group_importance_statement, min_group_size, max_group_size, group_form_algorithm) VALUES (NULL, $course_fk, '$title', '$description', '$group_importance_statement','$min_group_size', '$max_group_size', '$group_form_algorithm')";


              $retval = mysqli_query($db,$query); //performing mysql query

              if (!$retval ) { //if data is not inserted into database return error
                die('Could not enter data given: ' . mysqli_error($db));
              }

              $project_id = mysqli_insert_id($db);

              if ($files_uploaded > 0) {

                foreach ($_FILES['file-uploads']['tmp_name'] as $key => $tmp_name) {
                  $file_name = $_FILES['file-uploads']['name'][$key];
                  $file_size = $_FILES['file-uploads']['size'][$key];
                  $file_tmp = $_FILES['file-uploads']['tmp_name'][$key];
                  $file_type = $_FILES['file-uploads']['type'][$key];

                  // file upload validation check.
                  $target_dir = '../uploads/';
                  $target_file = $target_dir.basename($file_name);

                  if (move_uploaded_file($file_tmp, $target_file)) {
                      echo 'The file '.basename($file_name).' has been uploaded.';

                      $file = mysqli_real_escape_string($db, file_get_contents($target_file));

                      $upload_file = "INSERT INTO attachments (attachment_id, file, file_name, file_type, file_size, project_fk) VALUES (NULL, '$file', '$file_name', '$file_type', '$file_size', '$project_id')";

                      $retval = mysqli_query($db, $upload_file);

                      if (!$retval) {
                          echo mysqli_error($db);
                          die('Could not enter data given: '.mysqli_error($db));
                      }
                  } else {
                      echo 'Sorry, there was an error uploading your file.';
                  }
                }
              }

              header("Location: http://localhost/groupstart/views/instructor-courses.php");// once data has been inserted into database redirect to instructor-project page.
            };
        };

      ?>


      <div class="container" id="iap">
            <div class="row">
                <div class="col-md-12">
                    <div class="row" id="int-add-pro-part-1">
                        <div class="col-md-4" id="steps-panel">
                            <div class="row" id="panel-1"><div class="col-md-12">
                                <div class="panel panel-default" id="write-description">
                                    <div class="panel-body" id="wr-pr-de">
                                        <label>
                                            <input type="checkbox" value="project-desrciption" class="compulsory" id="panel-project-desrciption" disabled > &nbsp;Write project description</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row" id="panel-2"><div class="col-md-12">
                                <div class="panel panel-default" id="group-importance-statement">
                                    <div class="panel-body">
                                        <label>
                                            <input type="checkbox" value="importance-statement" class="compulsory" id="panel-edit-impo-statement" disabled> &nbsp;Edit group Importance Statement</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row" id="panel-3"><div class="col-md-12">
                                <div class="panel panel-default" id="group-clustering-formation">
                                    <div class="panel-body">
                                        <label>
                                            <input type="checkbox" value="clustering-options" class="compulsory" id="panel-clustering-options" disabled> &nbsp;Group Formation Options</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row" id="panel-4"><div class="col-md-12">
                                <div class="panel panel-default" id="group-introduction-mechanism">
                                    <div class="panel-body">
                                        <label>
                                            <input type="checkbox" value="charter-options" class="compulsory" id="panel-charter-options" disabled> &nbsp;Group Introduction Options</label>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="row" id="panel-5"><div class="col-md-12">
                                <div class="panel panel-default" id="complete-div">
                                    <div class="panel-body">
                                        <label>
                                            <!--input type="checkbox" value="completed" id="panel-charter-options" disabled--> &nbsp;View project options</label>

                                    </div>
                                </div>
                            </div>
                            </div><br>
                            <!--input type="submit" name="submit" class="btn btn-info btn-block" id="create-project" onclick="submitForms()" value="Add New Project"/-->
                        </div>
                        <div class="col-md-8" id="panel-content">
                            <div id="start-div" class="section current">
                                <h1 style="text-align:center">Steps to add a new project</h1><br><div id="steps-to-add-project">
                                    <ul id="chart">
                                        <li class="block" style="float:left">
                                            <div class="block-content">
                                                <p>Step 1: Write project Description</p>
                                            </div>

                                        </li>
                                        <li class="block" style="float:right">
                                            <div class="block-content">
                                                <p>Step 2: Edit group importance statment</p>
                                            </div>

                                        </li>
                                        <li class="block" style="float:left">
                                            <div class="block-content">
                                                <p>Step 3: Choose clustering options</p>
                                            </div>
                                        </li>
                                        <li class="block" style="float:right">
                                            <div class="block-content">
                                                <p>Step 4: Choose group introduction option</p>
                                            </div>

                                        </li>

                                    </ul>
                                </div>

                            </div>
                            <div id="write-description-panel" class="section">

                                <h4>Project Title</h4>
                                <input type="text" id="project-title"><br><br>
                                    <textarea rows="4" cols="50" id="area-description" class="mceEditor"></textarea><br><br><br>

                                    <!-- <h4>Project Attachments</h4>

                                    <form action="../php_scripts/upload.php" class="dropzone dz-clickable">
                                        <div class="dz-default dz-message">
                                            <span>Drop files here to upload</span>
                                        </div> -->

                                        <!-- <h4>Project Attachments</h4>
                                        Upload PDF's (Each file must be smaller than 1 Megabyte): <input type="file" name="file-uploads[]" id="file-upload" multiple="" /> -->
                                    </form><br><br>
                                    <!--a href="#" class="btn btn-info" role="button" id="add-project-options">Add Project Options</a><i>(optional)</i><br>
                                    <a href="#" class="btn btn-info" role="button" id="add-project-examples" style="margin-bottom:20px">Add Project Examples</a><i>(optional)</i><br-->

                                    <a href="#" class="btn btn-info" role="button" id="next-step-to-impo-statement" style="float:right">Next Step</a>

                                    <input type="submit" name="submit" class="btn btn-info" id="save-project-descrip-title" style="width:400px !important" value="Save" />
                                    </div>

                            <div id="impo-state-panel" class="section">
                                <h2>Group Importance Statement</h2>
                                <p id="statement">Collaboration has been proven to increase learning in students. Working on a group project together mimics the demands of industry in a way in which no individual project does.
                                    </p>
                                    <a href="#" class="btn btn-info" role="button" style="margin-bottom:20px !important;" id="edit-impo-statment">Edit</a>

                                    <input type="submit" name="submit" class="btn btn-info" id="save-group-impo-statment" style="float:right;width:200px;" value="Save"/><br>
                                    <a href="#" class="btn btn-info" role="button" id="next-step-to-clustering" style="float:right">Next Step</a>


                                    </div>
                            <div id="clustering-options-panel" class="section">
                                <div class="row">
                                    <h2>Group Formation Options</h2>
                                    <div class="col-md-12">

                                        <div class="row" id="clustering-algos">
                                            <h4 style="font-weight:200">Algorithms to Cluster Students by:</h4>
                                            <div class="panel-group" id="accordion-clustering-algo">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Random Clustering Algorithm</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse1" class="panel-collapse collapse">
                                                        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">KNN Algorithm</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse2" class="panel-collapse collapse">
                                                        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Weighting Algorithm</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapse3" class="panel-collapse collapse">
                                                        <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="select-algo">
                                            <div class="col-12-md">
                                                <label for="algo-list">Select clustering algorithm that you would like to use to group students:</label>
                                                <select class="form-control" id="algo-list">
                                                    <option value="random-algo">Random Algorithm</option>
                                                    <option value="knn-algo">KNN Algorithm</option>
                                                    <option value="weighting-algo">Weighting Algorithm</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row" id="space-out">
                                            <div class="col-md-12" id="rangeSlider">
                                                <div id="range"></div>
                                                <label for="min-input-number">Minimum group size</label>
                                                <input type="number" min="2" max="40" step="1" id="min-input-number">
                                                    <div id="max-option"><label for="max-input-number">Maximum group size</label>
                                                        <input type="number" min="2" max="40" step="1" id="max-input-number">
                                                            </div>
                                                    </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6" id="cluster-by-options"><h4 style="font-weight:200">Variables to Cluster by</h4>
                                                        <div class="scrollbox">
                                                            <ul class="list-group" id="clust-variable-list">
                                                                <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
                                                                <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option2"> Option 2</li>
                                                                <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option3"> Option 3</li>
                                                                <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option4"> Option 4</li>
                                                                <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option5">Option 5</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4 style="font-weight:200">Clustering options summary</h4><div id="summary">
                                                            <h5 style="color:black">clustering algorithm:</h5>
                                                            <h5 style="color:black">clustering by:</h5>
                                                            <ul>
                                                                <li>location</li>
                                                                <li>experience</li>
                                                                <li>age</li>
                                                            </ul>
                                                            <h5 style="color:black">Minimum group size:</h5>
                                                            <h5 style="color:black">Maximum group size:</h5>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="#" class="btn btn-info" role="button" id="next-step-to-charter" style="float:right">Next Step</a>

                                                <input type="submit" name="submit" class="btn btn-info" id="save-formation-options" style="float:left;width:400px !important" value="Save" />
                                            </div>
                                        </div>
                                    </div>
                                </div><br/>
                            </div>
                            <div id="charter-options-panel" class="section">
                                <p>For our alpha release, students will explain their motivation for taking the course as well as filling out group expectations they would like to see for their project group.
                                These motivations and group expectations will be displayed in a group's project page.</p>
                                <input type="submit" name="submit" class="btn btn-info" id="save-intro-options" style="float:left;width:400px !important" value="Save" />
                                <a href="#" class="btn btn-info" role="button" id="next-step-to-complete-div" style="float:right">Next Step</a></div>

                            <div id="complete-add-project-process" class="section">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>You have completed the necessary steps. Click <b>add new project</b> at the bottom left-hand side of this page to confirm.</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="saved-proj-title">
                                        <h3>Project Title</h3>
                                        <p id="projTitle"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6" id="project-description">
                                                <h3>
                                                    Project Description
                                                </h3>
                                                <p id="projectDes">
                                                </p>
                                                <button id="edit-descrip-title" type="button" class="btn btn-info">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="col-md-6" id="saved-impo-state">
                                                <h3>
                                                    Group Importance Statment
                                                </h3>
                                                <p>
                                                Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
                                                </p>
                                                <button id="edit-impo" type="button" class="btn btn-info">
                                                    Edit
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row" id="saved-group-formation">
                                            <div class="col-md-12">
                                                <h3>Group Formation Options</h3>
                                                <button id="changeClust-options" style="float:right" type="button" class="btn btn-info">Change</button>

                                                <table class="table table-striped" id="saved-formation-options">
                                                    <thead>
                                                        <tr>
                                                            <th>Clustering options</th>
                                                            <th>Selected options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Clustering algorithm</td>
                                                            <td id="clustering-algo-selected-option"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Minimum group size</td>
                                                            <td id="chosen-min-group-size"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Maximum group size</td>
                                                            <td id="chosen-max-group-size"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Variables to cluster by</td>
                                                            <td id="selected-variables"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-md-12" style="margin-bottom:50px">
                                                <h3>
                                                    Group Introduction Options
                                                </h3>
                                                <p>
                                                For our alpha release, students will explain their motivation for taking the course as well as filling out group expectations they would like to see for their project group.
                                                These motivations and group expectations will be displayed in a group's project page.
                                                </p>
                                                <button id="change-charter-options" type="button" class="btn btn-info">
                                                    Change
                                                </button>
                                            </div>
                                          </div>


                                          <form action="" method="POST" id="add-project-form" enctype="multipart/form-data">

                                            <input type="hidden" name="title" id="fordb_title" value=""/>
                                            <input type="hidden" name="description" id="fordb_descrip" value=""/>
                                            <input type="hidden" name = "group_importance_statement" id ="fordb_impoState" value=""/>
                                            <input type="hidden" name = "min_group_size" id="fordb_min" value=""/>
                                            <input type="hidden" name = "max_group_size" id="fordb_max" value=""/>
                                            <input type="hidden" name = "group_form_algorithm" id="fordb_algo" value=""/>
                                            <!-- <input type="hidden" name = "project-files[]" id="fordb_project_files" value="" multiple="" /> -->

                                            <h3>Project Attachments</h3>
                                            Upload PDF's (Each file must be smaller than 1 Megabyte): <input type="file" name="file-uploads[]" id="file-upload" multiple="" />

                                            <br />
                                            <br />
                                            <input type="submit" name="submit" class="btn btn-info btn-block" id="create-project" value="Add New Project">
                                          </form>



                                    </div>
                                </div>
                            </div></div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>
