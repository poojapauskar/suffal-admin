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
              'name' => $_POST['name'],
              'description' => $_POST['description'],
              'item' => $_POST['item'],
              'price' => $_POST['price'],
              'no_of_people' => $_POST['number_of_ppl'],
              'image_id' => $image_id,
              'start_date' => $_POST['start_date'],
              'duration' => $_POST['duration']
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
    echo "<script type='text/javascript'>alert('New Campaign Added')</script>";
}
?>


<a href="home.php">Back</a><br>
<h2 style="margin-top:3%;margin-left:3%">Add Campaign</h2>

  <form  action="#" enctype="multipart/form-data" style="margin-top:1%;margin-left:3%" method="post">
      
    <label>Name</label><br>
    <input type="text" id="name" name="name" required/>
    <br><br>

    <label>Description</label><br>
    <input type="text" id="description" name="description"/>
    <br><br>

    <label>Item</label><br>
    <input type="text" id="item" name="item" required/>
    <br><br>

    <label>Price</label><br>
    <input type="text" id="price" name="price" required/>
    <br><br>

    <label>Number Of People</label><br>
    <input type="text" id="number_of_ppl" name="number_of_ppl" required/>
    <br><br>

    <label>Start Date</label><br>
    <input type="text" id="start_date" name="start_date" placeholder="dd/mm/yyyy" required/>
    <br><br>

    <label>Duration</label><br>
    <input type="text" id="duration" name="duration" required>
    <br><br>

    <label>Image</label><br>
    <input type="file" id="image" name="image">
    <br><br>


      <!-- Accent-colored raised button with ripple -->
  <button name="submit" id="submit" style="background-color: #5cb85c;width:7em;margin-top:0%" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
    Save
  </button>

<!--      <button style="background-color:#d9534f" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
    Delete
  </button> -->
  </form>

    </body>
    </html>