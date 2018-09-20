<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

if(isset($_GET['user_id']) & isset($_GET['payout']))
{
    $post->setConversion($_GET['user_id'],$_GET['payout']);
}
else{
    exit('Error with conversion');
}

?>