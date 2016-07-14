<?php



 ?>


<html>


  <head>
		<?php
			include 'features/authentication.php';
			include 'features/banner.php'
		?>

        <link rel="stylesheet" type="text/css" href="../css/style.css" />

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

      <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
      <script type="text/javascript" src="../js/instructor-project.js"></script>


  </head>


  <body>
      <?php echo $banner ?>
      <div class="container">
	<div class="row">
		<div class="col-md-8" id="project-info">
			<div class="row" id="description-importance">
				<div class="col-md-6" id="project-description">
                    <h2>Project Description</h2>
					<p id="proj-descrip-statement">
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-block btn-default " id="edit-proj-descrip">
						Edit
					</button>
				</div>
				<div class="col-md-6" id="importance-statment">
                    <h2>Group Importance Statement</h2>
					<p id="group-impo-statement">
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-block btn-default" id="edit-impo-statement">
						Edit
					</button>
				</div>
			</div>
			<div class="row" id="chosen-machnisms">
				<div class="col-md-6" id="group-formation"><h2>Clustering Options</h2>
					<p>
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-block btn-default">
						Change
					</button>
				</div>
				<div class="col-md-6" id="group-intro">
					<h2>Introduction Options</h2><p>
						Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
					</p>
					<button type="button" class="btn btn-block btn-default">
						Change
					</button>
				</div>
			</div>
		</div>
        <div class="col-md-1"></div>
		<div class="col-md-3" id="manage-group">
			<div class="row">
                <h3>Manage Groups</h3>
				<div class="col-md-12" id="manage-group-panels">
                    <div id="tabs">
                        <ul>
                            <li><a href="#a">Tab A</a></li>
                            <li><a href="#b">Tab B</a></li>
                            <li><a href="#c">Tab C</a></li>
                            <li><a href="#d">Tab D</a></li>
                        </ul>
                        <div id="a"><p>Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                        <div id="b"><p>In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                        <div id="c"><p> Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                        <div id="d"><p> Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <h3>View other Projects</h3>
            <div class="col-md-12">
                <div id='project-list-inpro'>
              <ul class='list-group'>
                  <a href='instructor-project.php'><li class='list-group-item'>Project 1</li> </a>
                        <a href='instructor-project.php'><li class='list-group-item'>Project 2</li></a>
                        <a href='instructor-project.php'><li class='list-group-item'>Project 3</li></a>
                        <a href='instructor-project.php'><li class='list-group-item'>Project 4</li></a>
                        <a href='instructor-project.php'><li class='list-group-item'>Project 5</li></a>
                        <a href='instructor-project.php'><li class='list-group-item'>Project 6</li></a>
              </ul>
          </div>
                </div>
            </div>
        </div>
          </div>
      </div>


  </body>
</html>
