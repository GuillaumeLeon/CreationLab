<?php
require '../database/db.php';
require '../vendor/autoload.php';
session_start();

if ($_SESSION['connected'] != 1) {
    header('Location:../index.php');
    exit;
}
if (!isset($_POST['content'])) {
    header('Location:../index.php');
    exit;
} else {
    $content = $_POST['content'];

    $trim = strip_tags($content);
    $trim=str_replace([" ","\n","\t","&ndash;","&rsquo;","&#39;","&quot;","&nbsp;"], '', $trim);

    $totalCharacter = strlen(utf8_decode($trim));
    if ($totalCharacter > 280) {
        $_SESSION['error'] = 1;
        $_SESSION['content'] = $_POST['content'];

        header('Location:../public/'.$_SESSION['post'][0]['post_id']);
        exit;
    }
    $post_id = $_SESSION['post'][0]['post_id'];
    date_default_timezone_set(date_default_timezone_get());
    $date = date('Y/m/d h:i:s');
    $content = $_POST['content'];
}
$get_name = $db->prepare("SELECT post_name FROM post_text WHERE post_id='$post_id'");
$get_name->execute();
$post_name = $get_name->fetch();

$add_suite = $db->prepare("INSERT INTO post_text(post_name, contenue, parent_node, author, date_post) VALUES (?,?,?,?,?)");
$add_suite->execute(array($post_name[0],$content,$_SESSION['post_id'],$_SESSION['username'],$date));
unset($_SESSION['post_id']);
unset($_SESSION['post']);

header('Location:../post/'.$post_id);
