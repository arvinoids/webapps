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
    <title>Troubleshooter Editor</title>
</head>

<body class="decision">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
        <div class="navbar-header">
            <a class="navbar-brand" href="#"> Update Entry - <?php echo $_SESSION['step']?> </a>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="./troubleshooter.php?mode=edit">Back</a>
            </li>
        </ul>
    </nav>
    <?php editEntry($_GET['id']); ?>

    <!-- Modal -->
    <div class="modal fade" id="itemselection" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Items under <?php echo $_SESSION['step']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                            <?php listItems($_GET['id']) ?>
                    </ul>
                      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="js/tseditor.js"></script>
</body>

</html>