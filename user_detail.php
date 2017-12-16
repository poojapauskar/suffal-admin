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

.bord1{
  border:none;
}
.hid1{
  visibility: hidden;
}
</style>
   <title></title>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- <link rel="stylesheet" type="text/css" href="css/material.indigo-pink.min.css"> -->
 <meta name="viewport" content="width=device-width, arinitial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="autocomplete-Files/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>

<?php

session_start();
if(isset($_POST['submit'])){



        $img_profile = $_FILES["edit_profile"]["name"];
        $img_profile = end((explode(".", $img_profile))); # extra () to prevent notice
        if($img_profile == ""){
          $img_profile=".jpg";
        }else{
          $img_profile=".".$img_profile;
        }

        $name_profile= "profile".rand(0, 9999).$img_profile;

        $img_pan = $_FILES["edit_pan"]["name"];
        $img_pan = end((explode(".", $img_pan))); # extra () to prevent notice
        if($img_pan == ""){
          $img_pan=".jpg";
        }else{
          $img_pan=".".$img_pan;
        }

        $name_pan= "pan".rand(0, 9999).$img_pan;

        $img_aadhar = $_FILES["edit_aadhar"]["name"];
        $img_aadhar = end((explode(".", $img_aadhar))); # extra () to prevent notice
        if($img_aadhar == ""){
          $img_aadhar=".jpg";
        }else{
          $img_aadhar=".".$img_aadhar;
        }

        $name_aadhar= "aadhar".rand(0, 9999).$img_aadhar;


        /*Get Signed Urls*/
        $url = 'https://suffalproject.herokuapp.com/get_signed_url/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
        $data = array('image_list' => [$name_profile,$name_pan,$name_aadhar]);

        $options = array(
          'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'PUT',
            'content' => json_encode($data),
          ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $arr = json_decode($result,true);
        /*echo $arr['signed_urls'][0][0];*/

        /*var_dump($_POST['key'][0]);*/
        /*echo $_POST['value'];*/
       
        /*echo "[".$description."]";*/
        /*var_dump($key_value);*/
        // echo $key_value;

        $check = getimagesize($_FILES["edit_profile"]["tmp_name"]);
        if(is_uploaded_file($_FILES['edit_profile']['tmp_name']) && !($_FILES['edit_profile']['error'])) {
            $url_upload = $arr['signed_urls'][0][0];


            $filename = $_FILES["edit_profile"]["tmp_name"];
            $file = fopen($filename, "rb");
            $data = fread($file, filesize($filename));

            $options_upload = array(
              'http' => array(
                'header'  => "Content-type: \r\n",
                'method'  => 'PUT',
                'content' => $data,
              ),
            );
            $context_upload  = stream_context_create($options_upload);
            $result_upload = file_get_contents($url_upload, false, $context_upload);
            $arr_upload = json_decode($result_upload,true);

            $image_id=$arr['signed_urls'][0]['id'];

          } else {
              $image_id="";
          }

        $check = getimagesize($_FILES["edit_pan"]["tmp_name"]);
        if(is_uploaded_file($_FILES['edit_pan']['tmp_name']) && !($_FILES['edit_pan']['error'])) {
            $url_upload = $arr['signed_urls'][1][1];


            $filename = $_FILES["edit_pan"]["tmp_name"];
            $file = fopen($filename, "rb");
            $data = fread($file, filesize($filename));

            $options_upload = array(
              'http' => array(
                'header'  => "Content-type: \r\n",
                'method'  => 'PUT',
                'content' => $data,
              ),
            );
            $context_upload  = stream_context_create($options_upload);
            $result_upload = file_get_contents($url_upload, false, $context_upload);
            $arr_upload = json_decode($result_upload,true);

            $image_pan=$arr['signed_urls'][1]['id'];

          } else {
              $image_pan="";
          }

        $check = getimagesize($_FILES["edit_aadhar"]["tmp_name"]);
        if(is_uploaded_file($_FILES['edit_aadhar']['tmp_name']) && !($_FILES['edit_aadhar']['error'])) {
            $url_upload = $arr['signed_urls'][2][2];


            $filename = $_FILES["edit_aadhar"]["tmp_name"];
            $file = fopen($filename, "rb");
            $data = fread($file, filesize($filename));

            $options_upload = array(
              'http' => array(
                'header'  => "Content-type: \r\n",
                'method'  => 'PUT',
                'content' => $data,
              ),
            );
            $context_upload  = stream_context_create($options_upload);
            $result_upload = file_get_contents($url_upload, false, $context_upload);
            $arr_upload = json_decode($result_upload,true);

            $image_aadhar=$arr['signed_urls'][2]['id'];

          } else {
              $image_aadhar="";
          }
   
   

  $url_edit_user = 'https://suffalproject.herokuapp.com/edit_user/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $data_edit_user = array(
              'campaign_id' => $_POST['campaign_id'],
              'uid' => $_POST['edit_uid'],
              'pk_value' => $_POST['pk_value'],
              'firstname' => $_POST['edit_firstname'],
              'lastname' => $_POST['edit_lastname'],
              'address' => $_POST['edit_address'],
              'pincode' => $_POST['edit_pincode'],
              'aadhar_no' => $_POST['edit_aadhar_no'],
              'pan_no' => $_POST['edit_pan_no'],
              'dob' => $_POST['edit_dob'],
              'email' => $_POST['edit_email'],
              'pan' => $image_pan,
              'aadhar' => $image_aadhar,
              'image_id' => $image_id,
            );
  $options_edit_user = array(
      'http' => array(
        'header'  => "Content-Type: application/json\r\n" .
                       "Accept: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode( $data_edit_user),
      ),
    );
  $context_edit_user = stream_context_create($options_edit_user);
  $output_edit_user = file_get_contents($url_edit_user, false,$context_edit_user);
  $arr_edit_user = json_decode($output_edit_user,true);
}
?>

<?php
if(isset($_POST['delete_btn'])){
  /*echo "delete";*/
  $url_delete = 'https://suffalproject.herokuapp.com/delete_user/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
  $data_delete = array(
              'pk_delete' => $_POST['pk_delete'],
              'campaign_id' => $_POST['campaign_id']
            );
  $options_delete = array(
      'http' => array(
        'header'  => "Content-Type: application/json\r\n" .
                       "Accept: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode( $data_delete ),
      ),
    );
  $context_delete = stream_context_create($options_delete);
  $output_delete = file_get_contents($url_delete, false,$context_delete);
  $arr_delete = json_decode($output_delete,true);

  header("Location: campaign.php?pk=".$_GET['cid']."&filter=".$_GET['filter']);
}  
?>
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


<button name="back_btn" id="back_btn" onclick="window.location.href='campaign.php?pk=<?php echo $_GET['cid'];?>&filter=<?php echo $_GET['filter'];?>'">Back</button>

<h2 style="margin-top:3%;text-align:center"><?php echo $arr_get_campaign_user_detail[0]['campaign_data']['name']; ?></h2>

<div style="margin-left:17%;margin-top:4%">
<form method="post" enctype="multipart/form-data" action="user_detail.php?filter=<?php echo $_GET['filter']; ?>&user_id=<?php echo $_GET['user_id']; ?>&cid=<?php echo $_GET['cid']; ?>">
    <input type="hidden" name="campaign_id" value="<?php echo $arr_get_campaign_user_detail[0]['campaign_data']['pk']; ?>"></input>
    <input type="hidden" name="pk_value" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['pk']; ?>"></input>
    <label>First Name :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_firstname" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['firstname']; ?>" readonly></input>
    <br>
    <label>Last Name :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_lastname" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['lastname']; ?>" readonly></input>
    <br>
    <label>Pincode :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_pincode" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['pincode']; ?>" readonly></input>
    <br>
    <label>Aadhar No. :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_aadhar_no" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['aadhar_no']; ?>" readonly></input>
    <br>
    <label>Pan No. :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_pan_no" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['pan_no']; ?>" readonly></input>
    <br>
    <label>Unique Id :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_uid" value="<?php echo $arr_get_campaign_user_detail[0]['uid']; ?>" readonly></input>
    <br>
    <label>Mobile :</label>
    <input type="text" class="bord1" name="edit_mobile" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['mobile']; ?>" readonly></input>
    <br>
    <label>Email :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_email" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['email']; ?>" readonly></input>
    <br>
    <label>Date of Birth :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_dob" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['dob']; ?>" readonly></input>
    <br>
    <label>Date of Joining :</label>
    <input type="text" class="bord1" name="edit_doj" value="<?php echo $arr_get_campaign_user_detail[0]['date_of_joining']; ?>" readonly></input>
    <br>
    <label>Address :</label>
    <input type="text" class="edit1 bord1 bord" name="edit_address" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['address']; ?>" readonly></input>
    <br>
</div> 

<div style="margin-left:60%;margin-top:-12%">
  <?php if($arr_get_campaign_user_detail[0]['image_url']['profile'] == "") { 
     $img_src="images/no-image.png";
   }else{
     $img_src=$arr_get_campaign_user_detail[0]['image_url']['profile'];
   } ?>
    <img src="<?php echo $img_src; ?>" style="height:80px"></img><br><br>
    
    <button type="button" data-toggle="modal" data-target="#myModal1">VIEW PAN</button>
    <button type="button"><a href="<?php echo $arr_get_campaign_user_detail[0]['image_url']['pan']; ?>" download>DOWNLOAD PAN</a></button><br><br>
    
    <button type="button" data-toggle="modal" data-target="#myModal2">VIEW AADHAR</button>
    <button type="button"><a href="<?php echo $arr_get_campaign_user_detail[0]['image_url']['aadhar']; ?>" download>DOWNLOAD AADHAR</a></button>
    <!-- <button type="button" onclick="window.location.href='<?php echo $arr_get_campaign_user_detail[0]['image_url']['pan']; ?>'">VIEW PAN</button><br><br>
    <button type="button" onclick="window.location.href='<?php echo $arr_get_campaign_user_detail[0]['image_url']['aadhar'] ?>'">VIEW AADHAR</button> -->
    <br><br>
    <input class="hid1 hid" type="file" name="edit_profile"><b class="hid1 hid">Upload Profile Image</b></input><br><br>
    <input class="hid1 hid" type="file" name="edit_pan"><b class="hid1 hid">Upload Pan</b></input><br><br>
    <input class="hid1 hid" type="file"name="edit_aadhar"><b class="hid1 hid">Upload Aadhar</b></input><br><br>
</div> 

<div style="margin-left:30%;margin-top:-10%">
<button type="button" name="edit" class="edit">Edit</button>

<button type="submit" name="submit" class="hid1 hid">Submit</button>
<button type="button" name="cancel" class="hid1 hid cancel">Cancel</button>
</div>
 
</form>


<form method="post" action="user_detail.php?filter=<?php echo $_GET['filter']; ?>&user_id=<?php echo $_GET['user_id']; ?>&cid=<?php echo $_GET['cid']; ?>">
<input type="hidden" name="campaign_id" value="<?php echo $arr_get_campaign_user_detail[0]['campaign_data']['pk']; ?>"></input>
<input type="hidden" name="pk_delete" value="<?php echo $arr_get_campaign_user_detail[0]['user_data']['pk']; ?>"></input>
<button style="margin-left:10%;margin-top:-2%" type="submit" name="delete_btn">Delete</button>
</form>




 <div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="text-align:center">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">PAN CARD</h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo $arr_get_campaign_user_detail[0]['image_url']['pan']; ?>"></img>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="text-align:center">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">AADHAR CARD</h4>
        </div>
        <div class="modal-body">
          <img src="<?php echo $arr_get_campaign_user_detail[0]['image_url']['aadhar']; ?>"></img>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


<script type="text/javascript">
  $( ".edit" ).click(function() {
       $('.hid').removeClass('hid1');
       $('.edit1').prop('readonly', false);
       $('.bord').removeClass('bord1');
       $('.edit').addClass('hid1');
    });

  $( ".cancel" ).click(function() {
       $('.hid').addClass('hid1');
       $('.edit1').prop('readonly', true);
       $('.bord').addClass('bord1');
       $('.edit').removeClass('hid1');
    });
</script>
    </body>
    </html>