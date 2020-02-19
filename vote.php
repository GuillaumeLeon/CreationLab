<?php
require 'database/db.php';
session_start();
$username = $_SESSION['username'];
$get_profile = $db->prepare("SELECT * FROM users WHERE username='$username'");
$get_profile->execute();
$profile = $get_profile->fetch();
$id = $_POST['post_id'];
$data = $_POST['data'];

//json_decode($data);

if(isset($data)) {
    if ($data['voteType'] = 'upvote') {
        $update = $db->prepare("UPDATE post_text SET upvote = upvote+1 WHERE post_id='$id'");
        $update->execute();
        $new_upvote = $db->prepare("INSERT INTO upvote (user_id, post_id) VALUES (?,?)");
        $new_upvote->execute(array($profile[0]['Uid'], $id));
    }
    if ($data['voteType'] = 'downvote') {
        $update = $db->prepare("UPDATE post_text SET downvote = downvote+1 WHERE post_id='$id'");
        $update->execute();
        $new_downvote = $db->prepare("INSERT INTO downvote (user_id, post_id) VALUES (?,?)");
        $new_downvote->execute(array($profile[0]['Uid'], $id));
    }
}
