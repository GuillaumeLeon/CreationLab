<?php
require 'database/db.php';
session_start();
$username = $_SESSION['username'];
$get_profile = $db->prepare("SELECT Uid FROM users WHERE username='$username'");
$get_profile->execute();
$profile = $get_profile->fetch();
var_dump($_POST);
var_dump($profile);
$id = $_POST['post_id'];
$Uid = $profile['Uid'];

if(isset($_POST['voteType'])) {
    if ($_POST['voteType'] = 'upvote') {
        $update = $db->prepare("UPDATE post_text SET upvote = upvote+1 WHERE post_id='$id'");
        $update->execute();
        $new_upvote = $db->prepare("INSERT INTO upvote (user_id, post_id) VALUES (?,?)");
        $new_upvote->execute(array($Uid, $id));
    }
    if ($_POST['voteType'] = 'downvote') {
        $update = $db->prepare("UPDATE post_text SET downvote = downvote+1 WHERE post_id='$id'");
        $update->execute();
        $new_downvote = $db->prepare("INSERT INTO downvote (user_id, post_id) VALUES (?,?)");
        $new_downvote->execute(array($Uid, $id));
    }
}
