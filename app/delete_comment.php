<?php
require '../database/db.php';
require '../vendor/autoload.php';
session_start();
require '../includes/debugger.php';


if (!isset($_POST['id']) || !isset($_SESSION['connected'])) {
    header('Location: ../index.php');
    exit;
} else {
    $comm_id = $_POST['id'];

    $delete_comment = $db->prepare("DELETE FROM comment WHERE id='$comm_id'");
    $delete_comment->execute();
    header('Location: ../post/'.$_SESSION['post'][0]['post_id'].'');
}
