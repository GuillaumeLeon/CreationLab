<?php
require '../database/db.php';
require '../vendor/autoload.php';
session_start();
$id = $_SESSION['post'][0]['post_id'];
if ($_SESSION['connected'] != 1) {
    header('Location:../index.php');
}

if (!isset($_POST['com_content'])) {
    header("Location:/post/post.php?post=$id");
    exit;
} else {
    $author  = $_SESSION['username'];
    $content = $_POST['com_content'];
    date_default_timezone_set(date_default_timezone_get());
    $date = date('Y/m/d h:i:s');
}
$new_comment = $db->prepare('INSERT INTO comment (author, post_id, content, created_at) VALUES(?,?,?,?)');
$new_comment->execute(array($author, $id, $content, $date));
header("Location:../post/$id");
