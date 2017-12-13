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

<style type="text/css">
  label{
    font-weight: normal !important;
    width:150px;
  }

</style>
   <title></title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- <link rel="stylesheet" type="text/css" href="css/material.indigo-pink.min.css"> -->
 <meta name="viewport" content="width=device-width, arinitial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="autocomplete-Files/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  </head>
  <body>

<?php

  $url_get_campaign_user_detail = 'https://suffalproject.herokuapp.com/get_campaign_user_detail/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $options_get_campaign_user_detail = array(
    'http' => array(
      'header'  => array(
                  'USER-ID: '.$_GET['user_id'],
                  'CAMPAIGN-ID: '.$_GET['cid']
                ),
      'method'  => 'GET',
    ),
  );
  $context_get_campaign_user_detail = stream_context_create($options_get_campaign_user_detail);
  $output_get_campaign_user_detail = file_get_contents($url_get_campaign_user_detail, false,$context_get_campaign_user_detail);
  // echo $output_get_campaign_user_detail;
  $arr_get_campaign_user_detail = json_decode($output_get_campaign_user_detail,true);
 /* echo $arr_get_campaign_user_detail[0]['user_data'][0]['user_data']['name'];
  echo $arr_get_campaign_user_detail[0]['campaign_data']['name'];*/
  
?>

<script>
function goBack() {
    window.history.back();
}
</script>
<button onclick="goBack()">Back</button>

<h2 style="margin-top:3%;text-align:center"><?php echo $arr_get_campaign_user_detail[0]['campaign_data']['name']; ?></h2>

<div style="margin-left:20%;margin-top:4%">
    <label>Name :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['user_data']['firstname']." ".$arr_get_campaign_user_detail[0]['user_data']['lastname']; ?></b>
    <br>
    <label>Unique Id :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['uid']; ?></b>
    <br>
    <label>Mobile :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['user_data']['mobile']; ?></b>
    <br>
    <label>Email :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['user_data']['email']; ?></b>
    <br>
    <label>Date of Birth :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['user_data']['dob']; ?></b>
    <br>
    <label>Date of Joining :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['date_of_joining']; ?></b>
    <br>
    <label>Address :</label>
    <b><?php echo $arr_get_campaign_user_detail[0]['user_data']['address']; ?></b>
    <br>
</div> 

<div style="margin-left:60%;margin-top:-12%">
    <img src="<?php echo $arr_get_campaign_user_detail[0]['image_url']['profile']; ?>" style="height:80px"></img><br><br>
    <!-- <button><a href="<?php echo $arr_get_campaign_user_detail[0]['image_url']['pan']; ?>" download>VIEW PAN</td></button><br>
    <button><a href="<?php echo $arr_get_campaign_user_detail[0]['image_url']['aadhar']; ?>" download>VIEW AADHAR</td></button> -->
    <button onclick="window.location.href='<?php echo $arr_get_campaign_user_detail[0]['image_url']['pan']; ?>'">VIEW PAN</button><br><br>
    <button onclick="window.location.href='<?php echo $arr_get_campaign_user_detail[0]['image_url']['aadhar'] ?>'">VIEW AADHAR</button>
    </div>   

    </body>
    </html>