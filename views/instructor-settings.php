<?php



 ?>


<html>


  <head>
    <?php
      include 'features/authentication.php';
      include 'features/instructor-authentication.php';
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
    <div class="container">
        <h1 style="text-align:center">Instructor's Settings</h1>
        <div class="row">
            <div class=col-md-12>
                <div class="row" id="profile-area">
            <div class="col-md-5" >
                <div class="row" id="profile-pic">
                    <div class="col-md-12" >
                <img src="images/placeholder.png" alt="profile picture" class="img-rounded"><br><br>
                <button type="button" class="btn btn-block btn-primary">Change Profile Picture</button><br>
                        </div>
                    </div>
            </div>
            <div class="col-md-7">
                <div class="row" id="profile-info">
                <div class="col-md-12">
                    <div class="row" id="section0">
                        <div class="col-md-12">
                        <div id="dn"><p>Display Name:</p>
<input type="text" name="displayname">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="section1">
                        <div class="col-md-6">
                            
                            <div id="fn"><p>First name:</p>
<input type="text" name="firstname"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="ln"><p>Last name:</p>
<input type="text" name="lastname"></div>
                        </div>
                    </div><br>
                    <div class="row" id="section2">
                        <div class="col-md-12">
                            <div id="email-part"><p>Email:</p>
<input type="text" name="email"></div>
                        </div>
                    </div>
                    <div class="row" id="section3">
                       <div class="col-md-6">
                            <div id="pw"><p> Password:</p>
<input type="text" name="password"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="change-pw"><button type="button" class="btn btn-block btn-primary">Change password</button></div>
                        </div>
                    </div>
                    <div class="row" id="section4">
                        <div class="col-md-12"></div>
                    </div>

                </div>
                </div>

            </div>
                </div>
                </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                 <div class="list-group"id='course-manage-list'>
                    <a class="list-group-item clearfix">Course 1
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>
                    <a class="list-group-item clearfix">Course 2
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>
                    <a class="list-group-item clearfix">Course 3
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>
                    <a class="list-group-item clearfix">Course 4
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>
                    <a class="list-group-item clearfix">Course 5
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>
                    <a class="list-group-item clearfix">Course 6
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>
                    <a class="list-group-item clearfix">Course 7
      <span class="pull-right">
        <button class="btn btn-xs btn-info">Do not offer course</button>
      </span>
    </a>     
          </div><br>
                <button type="button" class="btn btn-block btn-primary">Save Changes</button>
                <br>
            </div>
        </div>
      </div>


  </body>
</html>
