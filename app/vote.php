<?php
require '../database/db.php';
require '../vendor/autoload.php';

session_start();
$votable = true;
$vote_downvote = false;
$vote_upvote = false;
$username = $_SESSION['username'];
$id = $_POST['post_id'];

$Uid = $_SESSION['id'];

$get_upvote = $db->prepare("SELECT user_id FROM upvote WHERE post_id='$id' AND user_id='$Uid'");
$get_upvote->execute();
$upvote = $get_upvote->fetchALL(PDO::FETCH_ASSOC);

$get_downvote = $db->prepare("SELECT user_id,post_id  FROM downvote WHERE post_id='$id' AND user_id='$Uid'");
$get_downvote->execute();
$downvote = $get_downvote->fetchALL(PDO::FETCH_ASSOC);

if (!empty($downvote)) {
    $votable = false;
    $vote_downvote = true;
}

if (!empty($upvote)) {
    $votable = false;
    $vote_upvote = true;
}
if (isset($_POST['voteType'])) {
    if ($votable) {
        if ($_POST['voteType'] == 'upvote') {
            $new_upvote = $db->prepare("INSERT INTO upvote (user_id, post_id) VALUES (?,?)");
            $new_upvote->execute(array($Uid, $id));
        } elseif ($_POST['voteType'] == 'downvote') {
            $new_downvote = $db->prepare("INSERT INTO downvote (user_id, post_id) VALUES (?,?)");
            $new_downvote->execute(array($Uid, $id));
        } else {
            echo 'parametre incorrect';
        }
    } elseif ($vote_downvote && $_POST['voteType'] == 'upvote') {
        $delete_downvote = $db->prepare("DELETE FROM downvote WHERE post_id='$id' AND user_id='$Uid'");
        $delete_downvote->execute();
        $new_upvote = $db->prepare("INSERT INTO upvote (user_id, post_id) VALUES (?,?)");
        $new_upvote->execute(array($Uid, $id));
    } elseif ($vote_upvote && $_POST['voteType'] == 'downvote') {
        $delete_upvote = $db->prepare("DELETE FROM upvote WHERE post_id='$id' AND user_id='$Uid'");
        $delete_upvote->execute();
        $new_downvote = $db->prepare("INSERT INTO downvote (user_id, post_id) VALUES (?,?)");
        $new_downvote->execute(array($Uid, $id));
    } elseif ($vote_upvote && $_POST['voteType'] == 'upvote') {
        $delete_upvote = $db->prepare("DELETE FROM upvote WHERE post_id='$id' AND user_id='$Uid'");
        $delete_upvote->execute();
    } elseif ($vote_downvote && $_POST['voteType'] == 'downvote') {
        $delete_downvote = $db->prepare("DELETE FROM downvote WHERE post_id='$id' AND user_id='$Uid'");
        $delete_downvote->execute();
    }
}
