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
      <div class="container">
	<div class="row" id="memeber-list-area">
		<div class="col-md-12">
            <h3>Group Members</h3>
            <div id="member-list">
            <ul class="list-group" >
  <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
  <li class="list-group-item">Porta ac consectetur ac</li>
  <li class="list-group-item">Vestibulum at eros</li>
                <li class="list-group-item">Cras justo odio</li>
  <li class="list-group-item">Dapibus ac facilisis in</li>
  <li class="list-group-item">Morbi leo risus</li>
                </ul>
            </div>
		</div>
	</div><br><br>
	<div class="row">
		<div class="col-md-8" id="milestones-area">
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
</div>

		</div>
		<div class="col-md-4" id="commun-link-area"><table class="table table-striped">
<thead><tr><th>Communication tools</th><th>Link</th></tr></thead>
<tbody>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>
    <tr><td>..</td><td>..</td></tr>

  </tbody></table>
            <button type="button" class="btn btn-default pull-right">View Group Charter</button>
		</div>
	</div>
</div>

  </body>
</html>
