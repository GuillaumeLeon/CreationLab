<?php
session_start();
//session_destroy();
$_SESSION['connected'] = array();
header("Location:index.php");
