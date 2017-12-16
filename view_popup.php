<html lang="en">
<head>
  <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Material Design Lite -->
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/material.css">
    <link rel="stylesheet" href="css/fileupload.css">
     <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body style="background-color:#E8E8E8;overflow-x:hidden;">
<?php 

$url= $_SERVER['REQUEST_URI'];

$url = explode('link=', $url);
$url = $url[1];

/*echo $important;*/
/*echo $_GET['name'];*/

if($_GET['name'] == 'pan_card'){
  $certificate_name= "Pan Card";
}elseif($_GET['name'] == 'aadhar_card'){
  $certificate_name= "Aadhar Card";
}

?>
<div id="modal-section">
  <div style="text-align:center;margin-top:12%">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
    <h3><?php echo $certificate_name; ?></h3>


    <!-- if url has https://kyc-app-bucket.s3.amazonaws.com/?Signature then it has no-image -->
    <?php if($url=="" || (strpos($url, 'https://kyc-app-bucket.s3.amazonaws.com/?Signature') !== false)){
      $img_lnk="images/no_image.jpg";
    }else{
        $img_lnk=$url;
    }?>

    <img id="img1" src="<?php echo $img_lnk; ?>"></img>

    <div style="margin-top:5%;margin-left:-22%" class="row">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-3">
       <button class="btn btn-success" style="color:white;width:100px;height:50px" onclick="print()">Print</button>
      </div>
      <div class="col-sm-3">
        <a href="mailto:test@gmail.com?subject=KYC Application
        &body=Thank You!" style="color:white"> 
          <button class="btn btn-success" style="color:white;width:100px;height:50px" >Email
          </button>
        </a>
      </div>
      <div class="col-sm-3">
        <a  style="color:white" download="<?php echo $certificate_name."jpg"; ?>" href="<?php echo $url; ?>" title="Save">
          <button class="btn btn-success" style="color:white;width:100px;height:50px">Save
          </button>
        </a>
      </div>
      <div class="col-sm-3"><br><br>
      </div>
    </div>
  </div>
</div>

<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>
