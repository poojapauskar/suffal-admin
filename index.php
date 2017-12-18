<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  
    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
    <!-- Material Design icon font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <script src="js/material.min.js"></script>
  <link rel="stylesheet" href="css/material.indigo-pink.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  </head>
  <body>


<?php
session_start();
if(isset($_POST['login_btn'])){

    if($_POST['username'] == "suffal" && $_POST['password'] == "12345"){
     $_SESSION['login_suffal_app'] = 1;
     echo "<script>location='home.php'</script>";
    }
}
?>

<div style="text-align:center">
<legend style="margin-top:7%;text-align:center">Admin Console</legend>

<form class="mui-form" name="myForm" method="post" action="" style="width:300px;margin:0 auto;">
 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  <input name="username" id="username" class="mdl-textfield__input" value="">
  <label class="mdl-textfield__label">Username</label>
 </div>
 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label"> 
  <input name="password" id="password" class="mdl-textfield__input" type="password" value="">
  <label class="mdl-textfield__label">Password</label>
 </div>

  <button name="login_btn" id="login_btn"  type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
    Log In
  </button>

</form>

</div>

  </body>
</html>