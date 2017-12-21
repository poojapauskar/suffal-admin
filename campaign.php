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
 <style type="text/css">
  thead,td,th{
      border: 1px solid #E0E0E0 ;
      
  } 
/*th, td {
    width: 220px;
    text-align:left;
    padding:4px;
}

th{font-size: 18px}
td{font-size: 15px}*/

thead, tbody { display: table-header-group; }

tbody {    
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}


</style>  
  </head>
  <body>

<?php

  $url_get_ppl_in_campaign = 'https://suffalproject.herokuapp.com/get_all_ppl_in_a_campaign/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $options_get_ppl_in_campaign = array(
    'http' => array(
      'header'  => array(
                  'PK: '.$_GET['pk'],
                  'FILTER: '.$_GET['filter']
                ),
      'method'  => 'GET',
    ),
  );
  $context_get_ppl_in_campaign = stream_context_create($options_get_ppl_in_campaign);
  $output_get_ppl_in_campaign = file_get_contents($url_get_ppl_in_campaign, false,$context_get_ppl_in_campaign);
  /*echo $output_get_ppl_in_campaign;*/
  $arr_get_ppl_in_campaign = json_decode($output_get_ppl_in_campaign,true);
 /* echo $arr_get_ppl_in_campaign[0]['user_data'][0]['user_data']['name'];
  echo $arr_get_ppl_in_campaign[0]['campaign_data']['name'];*/
  /*echo $arr_get_ppl_in_campaign[0]['campaign_data'][0]['name'];*/
  
?>


<!-- <h3>Number of people joined : <?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_joined']; ?></h3>
<h3>Number of people qualified :<?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_qualified']; ?></h3>
<h3>Number of people confirmed :<?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_confirmed']; ?></h3> -->

<legend style="text-align:center;margin-top:4%"><?php echo $arr_get_ppl_in_campaign[0]['campaign_data'][0]['name']; ?></legend>

<div style="text-align:right;margin-right:3%;margin-top:-5%">
<button onclick="window.location.href='details.php?pk=<?php echo $_GET['pk'];?>'" class="mdl-button mdl-js-button mdl-button--raised">Back</button>
</div>
<?php

if($_GET['filter'] == "total"){
  $head1="Total Participants";
}elseif($_GET['filter'] == "beneficiary"){
  $head1="Total Beneficiary";
}elseif($_GET['filter'] == "cancelled"){
  $head1="Cancellation";
}elseif($_GET['filter'] == "transferred"){
  $head1="Transfers";
}

?>

<h5 style="text-align:center;"><?php echo $head1;echo " ";?><b><?php echo $arr_get_ppl_in_campaign[0]['total_number']; ?></b></h5>

<table style="margin-top:1%" id="example" class="table table-hover table-mc-light-blue" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th>Sl. No.</th>
        <th>Name</th>
        <th>Unique ID</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>DOJ</th>
        <th>Status</th>
        <th>Details</th>
    </tr>
  </thead>

  <tbody>



    <?php for($x=0;$x<count($arr_get_ppl_in_campaign[0]['user_data']);$x++){?>

<?php
$variable=$arr_get_ppl_in_campaign[0]['user_data'][$x]['joined_date'];
$var=strstr($variable, 'TO', true);
?>
      <tr> 
        <!-- <td><img style="height:40%" src="<?php echo $arr_get_ppl_in_campaign[$x]['image_url']; ?>"></img></td> -->
        <td><?php echo $x+1; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['firstname']." ".$arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['lastname']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['uid']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['mobile']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['email']; ?></td>
        <td><?php echo $variable; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['status']; ?></td>
        <!-- <td><a href="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['pan_details']; ?>" download>Pan Card</td>
        <td><a href="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['aadhar_card_details']; ?>" download>Aadhar Card</td> -->
        <td>
          <form method="post" action="user_detail.php?filter=<?php echo $_GET['filter']; ?>&cid=<?php echo $_GET['pk']; ?>&user_id=<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['pk']; ?>">

            <button  class="mdl-button mdl-js-button mdl-button--raised" type="submit">Details</button>
            </form>
        </td>
        
      </tr>
    <?php }?>
  </tbody>
</table>

<?php if(count($arr_get_ppl_in_campaign[0]['user_data']) == 0){?>
<h3 style="text-align:center">No records found</h3>
 <?php }?>

    </body>
    </html>
