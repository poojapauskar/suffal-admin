<?php ?>
<html>
  <head>
  
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
<h1 style="margin-top:7%">Admin Console</h1>

<form name="myForm" method="post" action="" style="background-color:white !important">

  <label>Username</label>
  <input name="username" id="username" class="mdl-textfield__input" value="">
  <br>
  
  <label>Password</label>
  <input name="password" id="password" class="mdl-textfield__input" type="password" value="">
  <br>
  <br>

  <button name="login_btn" id="login_btn"  type="submit">
    Log In
  </button>

</form>
</div>

  </body>
</html>