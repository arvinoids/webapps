<?php
//required files
require '../config.php';
require 'database.php';
ini_set('display_errors', 'On');
ini_set('html_errors', 0);

if(isset($_POST['id']))
{
    updateEntry($_POST['id']);
    $header = 'location: ../troubleshooter.php?mode=edit';
    header($header);
    exit;
}

else echo "ID not specified.";

function updateEntry($id)
{
    $elements = $_POST['elements'];
    $step = $_POST['step'];
    $details = $_POST['details'];
    $reference = $_POST['reference'];

    $pdo = dbconnect();
    $query = "UPDATE tr_data SET elements=?, step=?, details=?, reference=? WHERE id=?";
    $q = $pdo->prepare($query);
    $q->execute([$elements, $step, $details, $reference, $id]);
}

?>