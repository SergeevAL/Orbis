<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Stat.php';

$database = new Database();
$db = $database->connect();

$stat = new Stat($db);

if(!isset($_GET['user_id']))
{
    exit("Error: ");
}

$result = $stat->month($_GET['user_id']);
$num = $result->rowCount();

if($num > 0) {

    $posts_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
        'stat_day' => $stat_day,
        'stat_hour' => $stat_hour,
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