<?php
/*ob_start("ob_gzhandler");*/  //Enables Gzip compression 

session_start();
if($_SESSION['login_suffal_app'] == 1){

}else{
  echo "<script>location='index.php'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>

  <title>Home</title>
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
      border: 1px solid black ;
      
  }
    
th, td {
    width: 220px;
    text-align:left;
}

th{font-size: 18px}
td{font-size: 15px}

thead, tbody { display: table-header-group; }

tbody {
    height: 433px;       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
}


</style>

  </head>

<body style="overflow-x:hidden">



<?php
session_start();

  $url_get_campaigns = 'https://suffalproject.herokuapp.com/web_get_all_campaigns/';
  $options_get_campaigns = array(
    'http' => array(
      'method'  => 'GET',
    ),
  );
  $context_get_campaigns = stream_context_create($options_get_campaigns);
  $output_get_campaigns = file_get_contents($url_get_campaigns, false,$context_get_campaigns);
  /*echo $output_get_campaigns;*/
  $arr_get_campaigns = json_decode($output_get_campaigns,true);
/*  echo $arr_get_campaigns[0]['description_detail'];*/
  
?>

<div style="text-align:center">
<legend style="margin-top:3%;text-align:center">Admin Console</legend>
<div style="text-align:right;margin-right:3%;margin-top:-3%">
<b>Welcome User, </b><a style="color:red;margin-left:2%" href="logout.php">Logout</a>
</div>
</div>




<div style="z-index:2000;position:absolute;margin-left:44%;margin-top:11%" onclick="location.href='add_campaign.php';">
<!-- <img style="height:150px;" src="images/add.png"></img> -->
<button style="height:150px;width:150px;border-radius:50%" class="mdl-button mdl-js-button mdl-button--raised">
    +
  </button>
<h5 style="margin-left:2%">Add Campagne</h5>
</div>

<div style="margin-top:3%">
<?php for($x=0;$x<count($arr_get_campaigns);$x++) {?>
<div class="row" style="text-align:center">
    <div class="col-sm-6" onclick="window.location.href='details.php?pk=<?php echo $arr_get_campaigns[$x]['campaign_detail']['pk'];?>'">
      <img style="height:150px" src="<?php echo $arr_get_campaigns[$x]['image_url']; ?>"></img>
      <h3><?php echo $arr_get_campaigns[$x]['campaign_detail']['name']; ?></h3>
    </div>
    <?php $x++; ?>
    <div class="col-sm-6" onclick="window.location.href='details.php?pk=<?php echo $arr_get_campaigns[$x]['campaign_detail']['pk'];?>'">
      <img style="height:150px" src="<?php echo $arr_get_campaigns[$x]['image_url']; ?>"></img>
      <h3><?php echo $arr_get_campaigns[$x]['campaign_detail']['name']; ?></h3>
    </div>
  </div>
<?php }?>
</div>


<!-- <h2 style="text-align:center;margin-top:4%">List Of Campaigns</h2> -->
<!-- <table style="margin-top:3%" id="example" class="mdl-data-table" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th>IMAGE</th>
        <th>NAME</th>
        <th>ITEM</th>
        <th>DESCRIPTION</th>
        <th>PRICE</th>
        <th>NO. OF PEOPLE</th>
        <th>START DATE</th>
        <th>DURATION</th>
        <th>VIEW</th>
    </tr>
  </thead>

  <tbody>
    <?php for($x=0;$x<count($arr_get_campaigns);$x++){?>

<?php /*echo $arr_get_campaigns[$x]['campaign_detail']['description']; */
$arr1 = $arr_get_campaigns[$x]['campaign_detail']['description'];
$arr1=str_replace("[","",$arr1);
$arr1=str_replace("]","",$arr1);

/*echo $arr1;*/

/*$pattern = '~{[^}]*}?(*SKIP)(*F)|,~';
$arr_split=preg_split($pattern, $arr1);
print_r($arr_split);*/



?>
      <tr> 
        <td><img style="height:40%" src="<?php echo $arr_get_campaigns[$x]['image_url']; ?>"></img></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['name']; ?></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['name']; ?></td>
        <td>
          <?php for($y=0;$y<count($arr_get_campaigns[$x]['description_detail']);$y++){
          echo $arr_get_campaigns[$x]['description_detail'][$y]['key']." : ".$arr_get_campaigns[$x]['description_detail'][$y]['value'];echo "<br>";
          }?>
        </td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['price']; ?></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['no_of_people']; ?></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['start_date']; ?></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['duration']; ?></td>
        <td>
        <form method="post" action="campaign.php?pk=<?php echo $arr_get_campaigns[$x]['campaign_detail']['pk'];?>">
        <button type="submit">View</button>
        </form>
        </td>
      </tr>
    <?php }?>
  </tbody>
</table>  -->


  </body>
</html>