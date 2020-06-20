<?php
  session_start();

  require_once 'vendor/autoload.php';
  require 'config.php';
  require 'controllers/functions.php';

  $pdo = dbconnect();
  updateStatus(); 
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">
        <title>Solutions Lab Server</title>
    </head>
    <body>

<!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="../"><img src="images/logo.svg" height="25"></a>
  <div class="navbar-header">     
      <a class="navbar-brand" href="#"> Solutions Lab Servers </a>  
  </div>  

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
          <!--<li class="nav-item">
              <a class="nav-link" href=".">Help</a>
          </li>-->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="dropdown"aria-haspopup="true" href="" aria-expanded="false">Actions</a>
              <div class="dropdown-menu dropdown-menu-right dropdown-primary">
                <!--<a class="dropdown-item" href="#">Add Printer</a>-->
                <a class="dropdown-item" href="../phpMyAdmin/" target="_BLANK">Go to Database</a>
              </div>
          </li>
          <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">User</a>
              <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="logout.php">Log out</a>
              </div>
          </li>-->

        </ul>
            <!-- Links -->    
    </div>
    <!-- Collapsible content -->
</nav>

<div class="container pt-md-5">
        
    <section>
    <main>
        <div class="container container-fluid px-md-5">
            <table class='table table-hover table-bordered'>
            <thead id="header">
                    <tr class="header thead-light" >
                    <th>Solutions</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php showServers($pdo);?>  
            </tbody>
            </table>
        </div>
    </main>
    </section>
</div>

        <footer class="page-footer font-small">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="https://level3.dhcp.lexmark.com/" style="color:rgb(165, 165, 165)"> Level 3 Solutions Team </a>
            </div>
            <!-- Copyright -->
        </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src='js/scripts.js'></script>
    <script>
        setTimeout(function(){ window.location.reload(1); }, 30000);
    </script>
</html>