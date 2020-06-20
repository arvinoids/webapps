<?php
session_start();
require 'config.php';
require 'controllers/decide.php';
require_once 'vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <title>Troubleshooter Detail View</title>
</head>

<body class="decision">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
        <div class="navbar-header">
            <a class="navbar-brand" href="#"></a>
        </div>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
                <a class="nav-link" href="tsedit.php?id=<?php echo $_GET['id']?>">Edit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="javascript:window.close()">Close</a>
            </li>
        </ul>
    </nav>
    <?php viewEntry($_GET['id']); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/tseditor.js"></script>
</body>

</html>