<?php

$questions = ['question 1', 'question 2', 'question 3', 'question 4' ,'question 5'];


 ?>


<html>
    

  <head>
      <?php include 'features/banner.php' ?>
    
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      
      <link rel="stylesheet" type="text/css" href="../css/style.css" />
  </head>

  <body>
      <?php echo $banner ?>
      <div class="container">
          <h1> Clustering Questionnaire</h1><br>
          <div class="row" id="project-options">
              <div class="col-md-12">
                  <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#project-descrip-1">
        <input type="checkbox" value=""> &nbsp;Project Option 1</a>
      </h4>
    </div>
    <div id="project-descrip-1" class="panel-collapse collapse">
        <div class="panel-body"><p>Pellentesque</p></div><br>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#project-descrip-2">
        <input type="checkbox" value=""> &nbsp;Project Option 2</a>
      </h4>
    </div>
    <div id="project-descrip-2" class="panel-collapse collapse">
        <div class="panel-body"><p>Pellentesque</p></div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#project-descrip-3">
        <input type="checkbox" value=""> &nbsp;Project Option 3</a>
      </h4>
    </div>
    <div id="project-descrip-3" class="panel-collapse collapse">
        <div class="panel-body"><p>Pellentesque</p></div><br>
    </div>
  </div>
</div>
              </div>
          </div>
          <div class="row" id="learning-style-questions">
              <div class="col-md-12">
                  <h1>Learning Style Questions</h1>
                  <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-cluster-form.php'>
     <label>
     <input type='radio' value='s-agree'> &nbsp;Strongly Agree
</label>
<label>
    <input type='radio' value='agree'> &nbsp;Agree
</label>
<label>
    <input type='radio' value='neutral'> &nbsp;Neutral
</label>
<label>
<input type='radio' value='disagree'> &nbsp;Disagree
</label>
<label>
<input type='radio' value='s-disagree'> &nbsp;Strongly Disagree
</label></form>";
     
     }?>
     
              </div>
          </div>
          <div class="row" id="personality-behavioral-questions">
              <div class="col-md-12">
                  <h1>Personality and Behavioral Questions</h1>
                  <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-cluster-form.php'>
     <label>
     <input type='radio' value='s-agree'> &nbsp;Strongly Agree
</label>
<label>
    <input type='radio' value='agree'> &nbsp;Agree
</label>
<label>
    <input type='radio' value='neutral'> &nbsp;Neutral
</label>
<label>
<input type='radio' value='disagree'> &nbsp;Disagree
</label>
<label>
<input type='radio' value='s-disagree'> &nbsp;Strongly Disagree
</label></form>";
     
     }?>
              </div>
          </div>
          <div class="row" id="expereinece-questions">
              <div class="col-md-12">
                  <h1>Experience Question</h1>
                  <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-cluster-form.php'>
     <label>
     <input type='radio' value='s-agree'> &nbsp;Strongly Agree
</label>
<label>
    <input type='radio' value='agree'> &nbsp;Agree
</label>
<label>
    <input type='radio' value='neutral'> &nbsp;Neutral
</label>
<label>
<input type='radio' value='disagree'> &nbsp;Disagree
</label>
<label>
<input type='radio' value='s-disagree'> &nbsp;Strongly Disagree
</label></form>";
     
     }?>
              </div>
          </div>
          <div class="row" id="skills-questions">
              <div class="col-md-12">
                  <h1>Skills Questions</h1>
                  <div class="container" id="skills-list">
                      <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
    <input type="checkbox" /> This is checkbox <br />
                  </div>
                
              </div>
          </div>
          <div class="row" id="motivation-questions">
              <div class="col-md-12">
                  <h1>Motivation Quetions</h1>
                  <?php foreach ($questions as $question) {
    echo "<h5>$question</h5>
     <form method='post' action='student-cluster-form.php'>
     <label>
     <input type='radio' value='s-agree'> &nbsp;Strongly Agree
</label>
<label>
    <input type='radio' value='agree'> &nbsp;Agree
</label>
<label>
    <input type='radio' value='neutral'> &nbsp;Neutral
</label>
<label>
<input type='radio' value='disagree'> &nbsp;Disagree
</label>
<label>
<input type='radio' value='s-disagree'> &nbsp;Strongly Disagree
</label></form>";
     
     }?>
              </div>
          </div><br>
          <div class="row" id="finished-button">
              <div class="col-md-12">
                  <button type="button" class="btn btn-block btn-primary">Submit</button>
              </div>
          </div>
      </div><br>


    
  </body>
</html>
