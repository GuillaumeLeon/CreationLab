<?php
session_start();
//session_destroy();
$_SESSION['connected'] = 0;
header("Location:index.php");