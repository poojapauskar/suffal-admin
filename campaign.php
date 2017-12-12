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
  thead,td,th{
      border: 1px solid black ;
      
  }
    
th, td {
    width: 220px;
    text-align:left;
    padding:4px;
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
  <body>

<?php

  $url_get_ppl_in_campaign = 'https://suffalproject.herokuapp.com/get_all_ppl_in_a_campaign/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $options_get_ppl_in_campaign = array(
    'http' => array(
      'header'  => array(
                  'PK: '.$_GET['pk']
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
  
?>

 <a href="home.php">Back</a><br>

<h3>Number of people joined : <?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_joined']; ?></h3>
<h3>Number of people qualified :<?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_qualified']; ?></h3>
<h3>Number of people confirmed :<?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_confirmed']; ?></h3>

<h2 style="text-align:center;margin-top:4%">People in <?php echo $arr_get_ppl_in_campaign[0]['campaign_data']['name']; ?></h2>
<table style="margin-top:3%" id="example" class="mdl-data-table" cellspacing="0" width="100%">
  <thead>
    <tr>
        <!-- <th>Name</th> -->
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Pan</th>
        <th>Aadhar</th>
        <th>Status</th>
    </tr>
  </thead>

  <tbody>
    <?php for($x=0;$x<count($arr_get_ppl_in_campaign[0]['user_data']);$x++){?>
      <tr> 
        <!-- <td><img style="height:40%" src="<?php echo $arr_get_ppl_in_campaign[$x]['image_url']; ?>"></img></td> -->
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['name']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['mobile']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['email']; ?></td>
        <td><a href="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['pan_details']; ?>" download>Pan Card</td>
        <td><a href="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['aadhar_card_details']; ?>" download>Aadhar Card</td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['status']; ?></td>
        
      </tr>
    <?php }?>
  </tbody>
</table>

    </body>
    </html>
