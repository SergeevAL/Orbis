<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

if(isset($_GET['user_id']))
{
    $post->setImpression($_GET['user_id']);
}
else{
    exit('Error with impression');
}

?>