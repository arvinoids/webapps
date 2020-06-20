<?php 
session_start();
require 'config.php';
require './controllers/decide.php';
require_once 'vendor/autoload.php';
//ini_set('display_errors', 'On');
//ini_set('html_errors', 0);
if(!isset($_SESSION['breadcrumb'])) $_SESSION['breadcrumb'] = array();
else if(isset($_GET['id'])) array_push($_SESSION['breadcrumb'],$_GET['id']);
if($_GET['mode']=='edit') {
    $search = "style=\"display:block\""; 
} else $search = "style=\"display:none\"";
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
<title>Troubleshooting Wizard</title>
</head>
<body class="decision ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
        <div class="navbar-header">
            <a class="navbar-brand" href="./troubleshooter.php"> Troubleshooting wizard </a>
        </div>
        <ul class="navbar-nav ml-auto" <?php if ($_GET['mode']=='edit') echo "style='display:none'" ?>>
            <li class="nav-item">
            </li>
            <li class="nav-item">
                <!--<a class="nav-link" href="troubleshooter.php?mode=edit">Editor</a>-->
            </li>
        </ul>
    </nav>

<div class="container pt-md-5 searchresults">
    <section>
        <div class="container container-fluid px-md-5 center-block " >
            <nav aria-label="breadcrumb" <?php if ($_GET['mode']=='edit') echo "style='display:none'" ?>>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="controllers/decide.php?mode=reset">Home</a></li>
                    <?php 
                    breadCrumb();
                    ?>
                </ol>
            </nav>
            <input type="text" id="getItem" onkeyup="findItem()" class="form-control mb-2 bg-light text-center" placeholder=" Search Items..." <?php echo $search ?>>
            <form method="post" action="troubleshooter.php" <?php if ($_GET['mode']=='edit') echo "style='display:none'" ?>>
                <input type="text" name="query" id="query" class="form-control mb-3 text-center bg-light" placeholder="Enter search terms here">
            </form>

            <table id="data" class='table table-hover table-bordered'>
                    <thead id="header">
                        <tr class="header thead-light" >
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($_GET['mode']=='edit') {
                            newForm();
                            dataEditor();
                        } else 
                        if (isset($_POST['query']) && !empty($_POST['query'])) queryItems($_POST['query']);
                        else showItems($_GET['id']);
                        ?>        
                    </tbody>
            </table>
            </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="js/tseditor.js"></script>
</body>
</html>