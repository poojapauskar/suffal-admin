<?php
/*ob_start("ob_gzhandler");*/  //Enables Gzip compression 

session_start();
if($_SESSION['login_suffal_app'] == 1){

}else{
  echo "<script>location='index.php'</script>";
}

?>
<html>
  <head>
   <title></title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- <link rel="stylesheet" type="text/css" href="css/material.indigo-pink.min.css"> -->
 <meta name="viewport" content="width=device-width, arinitial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="autocomplete-Files/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  </head>
  <body>


<script>
function goBack() {
    window.history.back();
}
</script>
<button onclick="goBack()">Back</button>
<h2 style="margin-top:3%;margin-left:3%;text-align:center">New Campagne</h2>

  <form  action="#" enctype="multipart/form-data" style="margin-top:1%;margin-left:25%" method="post">
      
    <!-- <label>Name</label><br>
    <input type="text" id="name" name="name" required/>
    <br><br> -->
    <label>Product</label><br>
    <input type="text" id="item" name="item" required/>
    <br>
    <label>Product Price</label><br>
    <input type="text" id="actual_price" name="actual_price" required/>
    <br>
    <label>Offer Price</label><br>
    <input type="text" id="offer_price" name="offer_price" required/>
    <br>
    <label>Number Of members per product</label><br>
    <input type="text" id="number_of_ppl" name="number_of_ppl" required/>
    <br>

    <div style="margin-left:40%;margin-top:-30%">
    <img src="images/add_image.png" style="height:80px"></img>
    <input type="file" id="image" name="image"></input>
    <label style="margin-top:1%">Add Image</label>
    </div>


      <!-- Accent-colored raised button with ripple -->
  <div>
  <button name="submit" id="submit" style="margin-top:20%;margin-left:25%" class="btn-primary mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
    Launch Campagne
  </button>
  </div>


    </body>
    </html>