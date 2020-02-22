<?php
require 'database/db.php';
session_start();
$votable = true;
$username = $_SESSION['username'];
$get_profile = $db->prepare("SELECT Uid FROM users WHERE username='$username'");
$get_profile->execute();
$profile = $get_profile->fetch();
$id = $_POST['post_id'];
$Uid = $profile['Uid'];

$get_upvote = $db->prepare("SELECT user_id,post_id FROM upvote WHERE post_id='$id'");
$get_upvote->execute();
$upvote = $get_upvote->fetchAll();

$get_downvote = $db->prepare("SELECT user_id,post_id  FROM downvote WHERE post_id='$id'");
$get_downvote->execute();
$downvote = $get_downvote->fetchAll();
var_dump($upvote);
var_dump($downvote);

for($i = 0; $i < count($upvote); $i++){
    if(isset($upvote[$i]['user_id'])){
        $votable = false;
    }
}
for($i = 0; $i < count($downvote); $i++){
    if(isset($downvote[$i]['user_id'])){
        $votable = false;
    }
}
if(isset($_POST['voteType'])) {
    if($votable){
        echo 'com voter';
        if ($_POST['voteType'] = 'upvote') {
           //$update = $db->prepare("UPDATE post_text SET upvote = upvote+1 WHERE post_id='$id'");
           //$update->execute();
            $new_upvote = $db->prepare("INSERT INTO upvote (user_id, post_id) VALUES (?,?)");
            $new_upvote->execute(array($Uid, $id));
        } else if ($_POST['voteType'] = 'downvote') {
           //$update = $db->prepare("UPDATE post_text SET downvote = downvote+1 WHERE post_id='$id'");
           //$update->execute();
            $new_downvote = $db->prepare("INSERT INTO downvote (user_id, post_id) VALUES (?,?)");
            $new_downvote->execute(array($Uid, $id));
        } else {
            echo 'parametre incorrect';
        }
    }
} else {
    echo 'com non voter';
}
