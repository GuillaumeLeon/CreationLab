<?php

require 'database/db.php';
session_start();

$get_number_post = $db->prepare("SELECT post_id FROM post_text AND parent_node IS NULL");
$get_number_post->execute();
$count = $get_number_post->fetchAll(PDO::FETCH_ASSOC);

$random_post = array_rand($count, 1);
$val = $count[$random_post];

header("Location:post/".$val['post_id']);
