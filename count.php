   <?php

    header('Content-Type: application/json');

/* echo $_POST['cid'];  */ 

session_start();

  $url_get_campaigns = 'https://suffalproject.herokuapp.com/get_all_counts/';
  $options_get_campaigns = array(
    'http' => array(
      'header'  => array(
                  'CAMPAIGN-ID: '.$_POST['cid']
                ),
      'method'  => 'GET',
    ),
  );
  $context_get_campaigns = stream_context_create($options_get_campaigns);
  $output_get_campaigns = file_get_contents($url_get_campaigns, false,$context_get_campaigns);
  /*echo $output_get_campaigns;*/
  $arr_get_campaigns = json_decode($output_get_campaigns,true);
  /*echo $arr_get_ppl_in_campaign[0]['campaign_detail']['item'];*/
  $f = array(
            "status" => 200,
            "total" => $arr_get_campaigns[0]['total_number'],
            "ben" => $arr_get_campaigns[0]['no_of_ppl_qualified'],
            "can" => $arr_get_campaigns[0]['no_of_ppl_cancelled'],
            "trans" => $arr_get_campaigns[0]['no_of_ppl_transferred'],
            "otp" => $arr_get_campaigns[0]['order_in_process'],
          );
  $fields[] = $f;
  echo json_encode($fields);


?>

