<?php 
require '../config.php';
require 'functions.php';
require 'snmp.php';

$address=$_POST["address"];
$community = 'public';
$model = getModel($address,$community);
$legacy=$_POST["legacy"];

function newPrinter($address,$model,$legacy)
{
    $status="Just Added";
    try{
        $pdo = dbConnect();
        $stmt = 'INSERT INTO printers (address,model,status,is_legacy) VALUES ( \''.$address.'\' ,\''.$model.'\' ,\''.$status.'\',\''.$legacy.'\')';
        $pdo->query($stmt);
        $msg = 'Data Successfully submitted.';
        }
        catch (Exception $e) {
            $msg = 'Caught Exception: '.( $e->getMessage()).'\n';
        }
    return $msg;
}

echo newPrinter($address,$model,$legacy);

?>