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

<?php

session_start();
if(isset($_POST['submit'])){



        $img = $_FILES["image"]["name"];
        $img = end((explode(".", $img))); # extra () to prevent notice
        if($img == ""){
          $img=".jpg";
        }else{
          $img=".".$img;
        }

        $name= "campaign".rand(0, 9999).$img;


        /*Get Signed Urls*/
        $url = 'https://suffalproject.herokuapp.com/get_signed_url/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
        $data = array('image_list' => [$name]);

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

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if(is_uploaded_file($_FILES['image']['tmp_name']) && !($_FILES['image']['error'])) {
            $url_upload = $arr['signed_urls'][0][0];


            $filename = $_FILES["image"]["tmp_name"];
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
   
   

   $url = 'https://suffalproject.herokuapp.com/campaign/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
   $data = array(
              'name' => '',
              'description' => '',
              'item' => $_POST['item'],
              'actual_price' => $_POST['actual_price'],
              'offer_price' => $_POST['offer_price'],
              'no_of_people' => $_POST['number_of_ppl'],
              'image_id' => $image_id,
              'start_date' => '',
              'duration' => ''
            );

    $options = array(
      'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
      ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    $arr = json_decode($result,true);
    $_SESSION['pk_key']= $arr['pk'];


    for ($k=0;$k<count($_POST['key']);$k++){
      $url_key = 'https://suffalproject.herokuapp.com/description/?access_token=6L0twxGEfgGNXE0wnRaJIzRk4KkfVF';
      $data_key = array(
              'campaign_id' => $_SESSION['pk_key'],
              'key' => $_POST['key'][$k],
              'value' => $_POST['value'][$k]
            );

      $options_key = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data_key),
        ),
      );
      $context_key  = stream_context_create($options_key);
      $result_key = file_get_contents($url_key, false, $context_key);
    }

    echo "<script type='text/javascript'>alert('New Campaign Added')</script>";
}
?>


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

    <label>Product description</label><br>
      <div class="present_fields_1">
          <input type="text" name="key[]" placeholder="key"/><input type="text" name="value[]" placeholder="value"/>
          <div class="input_fields" style="color:black"><br>
           <button type="button" class="add_field btn ">Add More</button>
          </div>
      </div>
    
    <br><br>

    

    <!-- <label>Start Date</label><br>
    <input type="text" id="start_date" name="start_date" placeholder="dd/mm/yyyy" required/>
    <br><br>

    <label>Duration</label><br>
    <input type="text" id="duration" name="duration" required>
    <br><br> -->

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

<!--      <button style="background-color:#d9534f" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
    Delete
  </button> -->
  </form>


 <script type="text/javascript">
$(document).ready(function() {
 
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields"); //Fields wrapper
    var add_button      = $(".add_field"); //Add button ID
    var wrapper_pre1         = $(".present_fields_1"); //Fields wrapper
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
      /* alert("hi");*/
        e.preventDefault();

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $('<div><input type="text" name="key[]" placeholder="key"/><input type="text" name="value[]" placeholder="value"/><a href="#" class="remove_field">Remove</a></div><br>').insertBefore(add_button)//add input box\
          

      }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

    $(wrapper_pre1).on("click",".remove_field_pre1", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
      
  });

  
</script>
    </body>
    </html>