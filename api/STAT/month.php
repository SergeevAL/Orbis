<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Stat.php';

$database = new Database();
$db = $database->connect();

$stat = new Stat($db);

$result = $stat->month();

$num = $result->rowCount();

if($num > 0) {

    $posts_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
        'user_id' => $user_id,
        'count_impressions' => $count_impressions,
        'count_conversions' => $count_conversions,
        'sum_payout' => $sum_payout
        );
      
        array_push($posts_arr, $post_item);

    }

    echo json_encode($posts_arr);

  } else {

    echo json_encode(
      array('message' => 'No Posts Found')
    );
  }

?>