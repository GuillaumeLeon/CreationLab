<?php
require '../database/db.php';
require '../vendor/autoload.php';

session_start();
$username = $_SESSION['username'];
$post_id = $_POST['post_id'];

$Uid = $_SESSION['id'];

$is_favorite = $db->prepare("SELECT * FROM favoris WHERE user_id='$Uid' AND post_id='$post_id'");
$is_favorite->execute();
$is_favorite = $is_favorite->fetch();

if ($is_favorite != null) {
    $delete_favorite = $db->prepare("DELETE FROM favoris WHERE user_id='$Uid' AND post_id='$post_id'");
    $delete_favorite->execute();
} else {
    $add_favorite = $db->prepare("INSERT INTO favoris (post_id, user_id) VALUES (?,?)");
    $add_favorite->execute([$post_id,$Uid]);
}
