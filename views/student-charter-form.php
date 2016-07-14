<?php

$questions = ['question 1', 'question 2', 'question 3', 'question 4' ,'question 5'];


 ?>


<html>


  <head>
    <?php
      include 'features/authentication.php';
      include 'features/banner.php'
    ?>


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
    <div class="container" id="scharform">
        <h1>Group Charter Activity</h1>
        <div class="row" id="part_1">
            <div class="col-md-12">
                <h3>Part 1</h3>
                <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-charter-form.php'>
      <p><input type='text' maxlength='255'></p>
    </form>
     ";
 }?>
            </div>
        </div>
        <div class="row" id="part_2">
            <div class="col-md-12">
            <h3>Part 2</h3>
                <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-charter-form.php'>
      <p><input type='text' maxlength='255'></p>
    </form>
     ";
 }?></div>
        </div>
        <div class="row" id="part_3">
            <div class="col-md-12">
            <h3>Part 3</h3>
                <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-charter-form.php'>
      <p><input type='text' maxlength='255'></p>
    </form>
     ";
 }?></div>
        </div>
        <div class="row" id="part_4">
            <div class="col-md-12">
            <h3>Part 4</h3>
                <?php foreach ($questions as $question) {
     echo "<h5>$question</h5>
     <form method='post' action='student-charter-form.php'>
      <p><input type='text' maxlength='255'></p>
    </form>
     ";
 }?></div>
        </div>
        <div class="row" id="finished-button">
              <div class="col-md-12">
                  <button type="button" class="btn btn-block btn-primary">Submit</button>
              </div>
          </div><br>
      </div>

  </body>
</html>
