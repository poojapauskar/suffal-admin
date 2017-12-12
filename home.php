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

<body >



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
  /*echo $arr_get_campaigns[0]['image_url'];*/
  
?>


<a href="logout.php">Logout</a><br>
<input style="margin-top:3%" type="button" onclick="location.href='add_campaign.php';" value="Add Campaign" />

<h2 style="text-align:center;margin-top:4%">List Of Campaigns</h2>
<table style="margin-top:3%" id="example" class="mdl-data-table" cellspacing="0" width="100%">
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
/*
$pattern = '~{[^}]*}?(*SKIP)(*F)|,~';
$arr_split=preg_split($pattern, $arr1);
print_r($arr_split);
echo "<br><br>";*/
?>
      <tr> 
        <td><img style="height:40%" src="<?php echo $arr_get_campaigns[$x]['image_url']; ?>"></img></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['name']; ?></td>
        <td><?php echo $arr_get_campaigns[$x]['campaign_detail']['item']; ?></td>
        <td></td>
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
</table> 


  </body>
</html>