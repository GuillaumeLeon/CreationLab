<?php
require('db.php');
$sql = "SELECT * FROM post_text
   WHERE id < '".$_GET['last_id']."' ORDER BY id DESC LIMIT 8"; 
$result = $db->prepare($sql);
$result->execute();

$json = include('data.php');
echo json_encode($json);

?>
