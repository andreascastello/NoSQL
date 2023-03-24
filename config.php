<?php


require_once __DIR__ . "/vendor/autoload.php";


$collection = (new MongoDB\Client)->restaurants->restaurants;
$collection_users = (new MongoDB\Client)->restaurants->users;

?>