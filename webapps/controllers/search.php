<?php

require_once 'vendor/autoload.php';
require 'config.php';
require 'controllers/functions.php';

function showProfiles($search) //just display the table
{
    
    $pdo = dbconnect();
    $query = "SELECT * FROM installprofiles WHERE account LIKE '%$search%' OR project LIKE '%$search%' OR ip LIKE '%$search%'";
    $m = new Mustache_Engine;
    $result = $pdo->query($query);
    $template=file_get_contents('templates/searchresults.mst');
    while ($row = $result->fetch())
    {
        echo $m->render($template,$row);
    }
    logger(__FUNCTION__,$query,$pdo);
    unset($pdo);
}
?>