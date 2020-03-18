<?php
require 'database/db.php';

session_start();
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}

if (!isset($_POST['title_post']) && !isset($_POST['content'])) {
    header('Location:index.php');
    exit;
} else {
    $title = $_POST['title_post'];
    $desc = $_POST['desc_post'];
    date_default_timezone_set(date_default_timezone_get());
    $date = date('Y/m/d h:i:s');
    $slug = str_replace(' ','_',$title);
    //$tag = $_POST['tag'];
    $content = $_POST['content'];
}

$new_post = $db->prepare('INSERT INTO post_text (post_name, post_desc,contenue ,author, date_post,slug) VALUES(?,?,?,?,?,?)');
$new_post->execute(array($title, $desc, $content,$_SESSION['username'], $date,$slug));

var_dump($_POST);

header('Location:index.php');
