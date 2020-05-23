<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=creationlab', "guillaume", '6gJl0202');
} catch (Exception $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
}
