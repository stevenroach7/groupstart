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
            selector: "#textarea-description"
        });
  </script>

      <!--script type="text/javascript" src="../js/add_project.js"></script-->
      <script type="text/javascript" src="../js/instructor-add-project.js"></script>

      <script src="../js/dropzone.min.js"></script>

      <?php
        include 'features/authentication.php';
        include 'features/instructor-authentication.php';
        include 'features/banner.php'
      ?>
  </head>


  <body>
      <?php echo $banner ?>
      <div class="container" id="iap">
	<div class="row">
		<div class="col-md-12">
			<div class="row" id="int-add-pro-part-1">
				<div class="col-md-4" id="steps-panel">
                    <div class="row" id="panel-1"><div class="col-md-12">
                        <div class="panel panel-default" id="write-description">
                            <div class="panel-body" id="wr-pr-de">
                                <label>
                                    <input type="checkbox" value="project-desrciption"> &nbsp;Write project descriprion</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row" id="panel-2"><div class="col-md-12">
                        <div class="panel panel-default" id="group-importance-statement">
                            <div class="panel-body">
                                <label>
                                    <input type="checkbox" value="importance-statement"> &nbsp;Edit group Importance Statement</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row" id="panel-3"><div class="col-md-12">
                        <div class="panel panel-default" id="group-clustering-formation">
                            <div class="panel-body">
                                <label>
                                    <input type="checkbox" value="clustering-options"> &nbsp;Clustering Options</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row" id="panel-4"><div class="col-md-12">
                        <div class="panel panel-default" id="group-introduction-mechanism">
                            <div class="panel-body">
                                <label>
                                    <input type="checkbox" value="charter-options"> &nbsp;Charter Options</label>
                            </div>
                        </div>
                        </div>
                    </div><br>
                    <a href="instructor-project.php" class="btn btn-info btn-block" role="button" id="create-project">Add New Project</a>
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
                    <textarea rows="4" cols="50" id="textarea-description" name="course_description"></textarea><br><br>

                        <h4>Project Attachments</h4>

                        <form action="../php_scripts/upload.php" class="dropzone dz-clickable">
               <div class="dz-default dz-message">
                   <span>Drop files here to upload</span>
               </div>
          </form><br><br>
                        <a href="#" class="btn btn-info" role="button" id="add-project-options">Add Project Options</a><i>(optional)</i><br><br>
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
                    <div id="clustering-options-panel" class="section"><h2>Clustering Options</h2>
                        <div class="row">
		<div class="col-md-12">
            <h2>Cluster using...</h2>
			<div class="row" id="clustering-algos">

				<div class="col-md-4" id=random>
					<h3 style="text-align:center">
						Random Algorithm
					</h3>
					<p class="text-info">
						description of what the random algorithm does.
					</p>
				</div>
				<div class="col-md-4" id="knn">
					<h3 style="text-align:center">
						KNN Algorithm
					</h3>
					<p class="text-info">
						description of what the KNN algorithm does.
					</p>

				</div>
				<div class="col-md-4" id="weighting">
					<h3 style="text-align:center">
						Weighting Algorithm
					</h3>
					<p class="text-info">
						description of what the weighting algorithm does.
					</p>
				</div>
			</div><br/>

            <div class="row" id="space-out"><div class="col-md-12">
          <div style="float:left">Minimum Group Size <input type="text" name="min-group-size" id="min-group-size"></div>
                <div style="float:right">Maximum Group Size <input type="text" name="max-group-size" id="max-group-size"></div></div>
            </div>

			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6" id="cluster-by-options"><h4 style="color:black">Clustering Options</h4>
                            <div class="scrollbox">
                                <ul class="list-group">
  <li><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
  <li><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
  <li><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
  <li><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
  <li><input type="checkbox" name="clustering-by" value="cluster-by-option1"> Option 1</li>
</ul>
                            </div>
						</div>
						<div class="col-md-6">
                            <h4>Clustering options summary</h4><div id="summary">
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
