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

<script type="text/javascript" src="js/require.js"></script>
 <script src="js/ajax.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

  $url_get_campaigns = 'https://suffalproject.herokuapp.com/get_all_counts/';
  $options_get_campaigns = array(
    'http' => array(
      'header'  => array(
                  'CAMPAIGN-ID: '.$_GET['pk']
                ),
      'method'  => 'GET',
    ),
  );
  $context_get_campaigns = stream_context_create($options_get_campaigns);
  $output_get_campaigns = file_get_contents($url_get_campaigns, false,$context_get_campaigns);
  /*echo $output_get_campaigns;*/
  $arr_get_campaigns = json_decode($output_get_campaigns,true);
  /*echo $arr_get_ppl_in_campaign[0]['campaign_detail']['item'];*/
?>



<legend style="text-align:center;margin-top:4%"><?php echo $arr_get_campaigns[0]['campaign_detail']['name']; ?></legend>

<div style="text-align:right;margin-right:3%;margin-top:-5%">
<button onclick="window.location.href='home.php'" class="mdl-button mdl-js-button mdl-button--raised">Back</button>
</div>



<div class="row" style="text-align:center;margin-top:4%">
    <div class="col-sm-3" onclick="window.location.href='campaign.php?filter=total&pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
       <p style="font-weight:bold;font-size:20px">Total Participants</p>
       <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
        <h3 id="total"><?php echo $arr_get_campaigns[0]['total_number']; ?></h3>
        <h5>Click for List</h5>
       </button>
    </div>

    <div class="col-sm-3" onclick="window.location.href='campaign.php?filter=beneficiary&pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
       <p style="font-weight:bold;font-size:20px">Total Beneficiary</p>
       <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
        <h3 id="ben"><?php echo $arr_get_campaigns[0]['no_of_ppl_qualified']; ?></h3>
        <h5>Click for List</h5>
       </button>
    </div>

    <div class="col-sm-3" onclick="window.location.href='campaign.php?filter=cancelled&pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
      <p style="font-weight:bold;font-size:20px">Cancellation</p>
      <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
       <h3 id="can"><?php echo $arr_get_campaigns[0]['no_of_ppl_cancelled']; ?></h3>
       <h5>Click for List</h5>
      </button>
    </div>

    <div class="col-sm-3" onclick="window.location.href='campaign.php?filter=transferred&pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
      <p style="font-weight:bold;font-size:20px">Transfers</p>
      <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
       <h3 id="trans"><?php echo $arr_get_campaigns[0]['no_of_ppl_transferred']; ?></h3>
       <h5>Click for List</h5>
      </button>
    </div>

</div>

<div class="row" style="text-align:center;margin-top:3%">
    <div class="col-sm-3">
     <p style="font-weight:bold;font-size:20px">Total Amount</p>
     <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
      <h3><?php echo $arr_get_campaigns[0]['campaign_detail']['offer_price']; ?></h3>
       </button>
    </div>

    <div class="col-sm-3" onclick="window.location.href='order_to_process.php?filter=order_to_process&pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
     <p style="font-weight:bold;font-size:20px">Order To Process</p>
     <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
      <h5><?php echo $arr_get_campaigns[0]['campaign_detail']['created']; ?></h5>
      <h5 id="otp"><?php echo $arr_get_campaigns[0]['order_in_process']; ?></h5>
      <h5>Click for List</h5>
       </button>
    </div>

    <div class="col-sm-3" onclick="window.location.href='order_to_process.php?pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
    </div>

    <div class="col-sm-3" onclick="window.location.href='edit_campagne.php?pk=<?php echo $arr_get_campaigns[0]['campaign_detail']['pk'];?>'">
     <p style="font-weight:bold;font-size:20px;visibility:hidden">Campagne Settings</p>
     <button  class="mdl-button mdl-js-button mdl-button--raised" style="width:250px;height:130px;margin-left:10%">
      <h4>Campagne <br>Settings</h4>
       </button>
    </div>

  </div>


</div>


<script type="text/javascript">
window.setInterval(function(){
  var Url="count.php";
  /*alert("<?php echo $_GET['pk'];  ?>");*/
  $.ajax({
  type: "POST",
  url: Url,
  dataType: 'json',
  data: {cid:"<?php echo $_GET['pk']; ?>",session:1},
  success: function(fields){
    $.each(fields, function(idx, f){
      /*alert(f.status);*/
      /*alert(f.total);
      alert(f.ben);
      alert(f.can);
      alert(f.trans);
      alert(f.otp);*/
      $('#total').text(f.total);
      $('#ben').text(f.ben);
      $('#can').text(f.can);
      $('#trans').text(f.trans);
      $('#otp').text(f.otp);
      /*if(f.status==400){
        document.location.href='session_exp.php';
      }*/
    });
  }
});

}, 60000);
</script>

  </body>
</html>