<?php
require '../database/db.php';
require '../vendor/autoload.php';

session_start();
if ($_SESSION['connected'] != 1) {
    header('Location:index.php');
}

if (!isset($_POST['title_post']) && !isset($_POST['content'])) {
    header('Location:index.php');
    exit;
} else {
    $content = $_POST['content'];

    $trim = strip_tags($content);
    $trim=str_replace([" ","\n","\t","&ndash;","&rsquo;","&#39;","&quot;","&nbsp;"], '', $trim);

    $totalCharacter = strlen(utf8_decode($trim));
    if($totalCharacter > 280) {
	$_SESSION['error'] = 1;
	$_SESSION['title'] = $_POST['title_post'];
	$_SESSION['desc'] = $_POST['desc_post'];
	$_SESSION['content'] = $_POST['content'];

	header('Location:../public/new_project.php');

    } else  {
	$title = $_POST['title_post'];
	$desc = $_POST['desc_post'];
	date_default_timezone_set(date_default_timezone_get());
	$date = date('Y/m/d h:i:s');
	$slug = str_replace(' ','_',$title);
	$tag = $_POST['tag'];
	$content = $_POST['content'];
    }
 } 

$new_post = $db->prepare('INSERT INTO post_text (post_name, post_desc,contenue ,author, date_post,slug,tag) VALUES(?,?,?,?,?,?,?)');
$new_post->execute(array($title, $desc, $content,$_SESSION['username'], $date,$slug,$tag));

header('Location:../index.php');
