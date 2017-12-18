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
if(isset($_POST['status_btn'])){
  
  $url_status = 'https://suffalproject.herokuapp.com/change_delivery_status/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $options_status = array(
    'http' => array(
      'header'  => array(
                  'CAMPAIGN-ID: '.$_GET['pk'],
                  'USER-ID: '.$_POST['pk_confirm']
                ),
      'method'  => 'GET',
    ),
  );
  $context_status = stream_context_create($options_status);
  $output_status = file_get_contents($url_status, false,$context_status);
  $arr_status = json_decode($output_status,true);
}
?>

<?php

  $url_get_ppl_in_campaign = 'https://suffalproject.herokuapp.com/get_all_ppl_in_a_campaign/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $options_get_ppl_in_campaign = array(
    'http' => array(
      'header'  => array(
                  'PK: '.$_GET['pk'],
                  'FILTER: order_to_process'
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



<button onclick="window.location.href='details.php?pk=<?php echo $_GET['pk'];?>'">Back</button>

<!-- <h3>Number of people joined : <?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_joined']; ?></h3>
<h3>Number of people qualified :<?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_qualified']; ?></h3>
<h3>Number of people confirmed :<?php echo $arr_get_ppl_in_campaign[0]['no_of_ppl_confirmed']; ?></h3> -->

<h2 style="text-align:center;margin-top:4%"><?php echo $arr_get_ppl_in_campaign[0]['campaign_data']['name']; ?></h2>


<h4 style="text-align:center;"><?php echo "Order to Process";echo " "; echo $arr_get_ppl_in_campaign[0]['total_number']; ?></h4>

<table style="margin-top:3%" id="example" class="mdl-data-table" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th>Sl. No.</th>
        <th>Name</th>
        <th>Unique ID</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>DOJ</th>
        <th>Qualify Code</th>
        <th>Verify Code</th>
        <th>Status</th>
        <th>Details</th>
        <th>Delivery Confirmation</th>
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
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['qualify_code']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['verify_code']; ?></td>
        <td><?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['status']; ?></td>
        <!-- <td><a href="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['pan_details']; ?>" download>Pan Card</td>
        <td><a href="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['aadhar_card_details']; ?>" download>Aadhar Card</td> -->
        <td>
          <form method="post" action="user_detail.php?cid=<?php echo $arr_get_ppl_in_campaign[0]['campaign_data']['pk']; ?>&user_id=<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['pk']; ?>">

            <button type="submit">Details</button>
            </form>
        </td>
        <td>
         <?php if($arr_get_ppl_in_campaign[0]['user_data'][$x]['delivered'] == "No") { ?>
          <form method="post" action="order_to_process.php?pk=<?php echo $arr_get_ppl_in_campaign[0]['campaign_data']['pk']; ?>">
            <input value="<?php echo $arr_get_ppl_in_campaign[0]['user_data'][$x]['user_data']['pk']; ?>" type="hidden" name="pk_confirm"></input>
            <button name="status_btn" type="submit">Delivered</button>
            </form>
         <?php } else { ?>
          <p>Done</p>
         <?php } ?>
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
