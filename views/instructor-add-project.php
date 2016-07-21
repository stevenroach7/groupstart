<?php



 ?>


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

      <!--script type="text/javascript" src="../js/add_project.js"></script-->
      <script type="text/javascript" src="../js/instructor-add-project.js"></script>

      <script src="../js/dropzone.min.js"></script>
      
      <script src="../js/nouislider.min.js"></script>
      
      <script type="text/javascript" src="../js/slider.js"></script>

      <?php
        include 'features/authentication.php';
        include 'features/instructor-authentication.php';
        include 'features/banner.php'
      ?>
  </head>


  <body>
      <?php echo $banner ?>
      <?php 
            include '../config/connection.php';

$title = $description = $group_importance_statement = $min_input_number = $max_input_number = $group_form_algorithm = "";

if(isset($_POST['submit'])){
    if(empty($_POST['title']) || (empty($_POST['description'])) || (empty($_POST['group_form_algorithm'])) || (empty($_POST['min_input_number'])) || (empty($_POST['max_input_number']))){
        //echo "One of the required fields is empty.";
    }else{
    $title = $_POST['title'];
                 $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $group_importance_statement = $_POST['group_importance_statement'];
    $min_input_number = $_POST['min_input_number'];
    $max_input_number = $_POST['max_input_number'];
    $group_form_algorithm = $_POST['$group_form_algorithm'];
        
         $query = "INSERT INTO projects (project_id, course_fk, title, description, group_importance_statement, min_input_number, max_input_number, group_form_algorithm) VALUES (NULL, '22', '$title', '$description', '$group_importance_statement', '$min_input_number', '$max_input_number', '$group_form_algorithm')";
    };
    
    $retval = mysqli_query($db,$query);
                
                if(!$retval ) {
                    die('Could not enter data in first try: ' . mysql_error());
                }
    //echo "Entered data successfully\n";
                header("Location: http://localhost/groupstart/views/instructor-project.php");
    
}
      
      
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
                                    <input type="checkbox" value="project-desrciption" class="compulsory" id="panel-project-desrciption" disabled > &nbsp;Write project descriprion</label>
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
                    </div><br>
                    <input type="submit" name="submit" class="btn btn-info btn-block" id="create-project" value="Add New Project"/>
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
                        <form  action="" method="POST" id ="title-descrip-add-proj-form">
                        <h4>Project Title</h4>
          <input type="text" name="title"><br><br>
                            <textarea rows="4" cols="50" name="description" id="area-description" class="mceEditor"></textarea><br><br></form><br>

                        <h4>Project Attachments</h4>

                        <form action="../php_scripts/upload.php" class="dropzone dz-clickable">
               <div class="dz-default dz-message">
                   <span>Drop files here to upload</span>
               </div>
          </form><br><br>
                        <a href="#" class="btn btn-info" role="button" id="add-project-options">Add Project Options</a><i>(optional)</i><br>
                         <a href="#" class="btn btn-info" role="button" id="add-project-examples">Add Project Examples</a><i>(optional)</i>

                         <a href="#" class="btn btn-info" role="button" id="next-step-to-impo-statement" style="float:right">Next Step</a>
                        </div>

                    <div id="impo-state-panel" class="section">
                        <h2>Group Importance Statement</h2>
                                                 <p id="statement"> Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.
                        </p>
                                                     <a href="#" class="btn btn-info" role="button" id="edit-impo-statment">Edit</a>
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
                    <form action="" method="POST" id ="select-algo-form">
  <label for="algo-list">Select clustering algorithm that you would like to use to group students:</label>
  <select class="form-control" id="algo-list" name="group_form_algorithm">
   <option value="random-algo">Random Algorithm</option>
  <option value="knn-algo">KNN Algorithm</option>
  <option value="weighting-algo">Weighting Algorithm</option>
  </select>
</form>
                    
                </div>
            </div>

            <div class="row" id="space-out">
                <div class="col-md-12">
                      <div id="range"></div>
                        <form action="" method="POST" id="group-size-range">
                <label for="min-input-number">Minimum group size</label>
                <input type="number" min="2" max="40" step="1" id="min-input-number">
                <div id="max-option"><label for="max-input-number">Maximum group size</label>
                <input type="number" min="2" max="40" step="1" id="max-input-number">
                    </div>
                            </form>
          </div>
            </div>

			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6" id="cluster-by-options"><h4 style="font-weight:200">Clustering Options</h4>
                            <div class="scrollbox">
                                <form action="" method="POST" id="clustering-options-form">
                                <ul class="list-group">
  <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
  <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option2"> Option 2</li>
  <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option3"> Option 3</li>
  <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option4"> Option 4</li>
  <li class="list-group-item"><input type="checkbox" name="clustering-by" value="cluster-by-option5"> Option 5</li>
                                    </ul></form>
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
				</div>
			</div>
		</div>
	</div><br/>
                    </div>
                    <div id="charter-options-panel" class="section">Charter Options panel is now open
                    <a href="#" class="btn btn-info" role="button" id="next-step-to-complete-div" style="float:right">Next Step</a></div>

                    <div id="complete-add-project-process" class="section">
                    <div class="row">
		<div class="col-md-12">
            <h1>You have completed the necessary steps. Click <b>add new project</b> at the bottom left-hand side of this page to confirm.</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<h3>
						Project Description
					</h3>
					<p>
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-default">
						Edit
					</button>
				</div>
				<div class="col-md-6">
					<h3>
						Group Importance Statment
					</h3>
					<p>
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-default">
						Edit
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h3>
						Group Clustering Options
					</h3>
					<p>
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-default">
						Change
					</button>
				</div>
				<div class="col-md-6">
					<h3>
						Group Charter Options
					</h3>
					<p>
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-default">
						Change
					</button>
				</div>
			</div>
		</div>
	</div></div>


			</div>
		</div>
	</div>
</div>
      </div>

  </body>
</html>
