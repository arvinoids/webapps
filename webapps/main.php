<?php
session_start();

require_once 'vendor/autoload.php';
require 'config.php';
require 'controllers/functions.php';

if(isset($_SESSION['sa']) && isset($_SESSION['gn']))
  {
      // header("location: index.php");
  }
  else{     

      header('location: login.php');
  }



$pdo = dbconnect();
updateOnline();

//initialize session variables
$_SESSION['printer_address']='0.0.0.0';
$_SESSION['user'];

?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">

        <meta name="useraddress" content="<?php echo getIpAddress();?>">
        <meta name="user" content="<?php echo $_SESSION['sa'];?>">
        <title>Home - Level 3 Printer Reservation System</title>
    </head>
    <body>

<!--Nav-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../"><img src="images/logo_rgb.svg" height="25"></a>      </div>

    <div class="navbar-header">     
      <a class="navbar-brand" href="#"> Level 3 Lab Printers </a>  
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> 
       <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['sa']; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php">Log out</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Actions</span><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="addprinter.html" target="_BLANK">Add Printer</a></li>
            <li><a href="../phpMyAdmin/" target="_BLANK">Go to Database</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right"> <li><a href="help.php" >Help</a></li></ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<section>
        <div class="container container-fluid px-md-5">
        <input type="text" id="getModel" onkeyup="findModel()" class="form-control" placeholder=" Search by model...">
            <table id="printers" class='table table-dark table-hover table-bordered'>
                <tr class="header">
                    <th>IP Address</th>
                    <th>Net</th>
                    <th>Model</th>
                    <th>Status</th>
                    <th>Reserved by</th>
                    <th>Actions</th>
                </tr>
                <?php showPrinters($pdo,$_SESSION['sa']);?>    
            </table>
        </div>
</section>
<footer class="footer py-md-6">
      <div class="container">
        <span class="text-muted">© Copyright 2020 Lexmark Solutions Support Team.</span>
      </div>
    </footer>
    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src='js/actions.js'></script>
<script src='js/scripts.js'></script>
</html>