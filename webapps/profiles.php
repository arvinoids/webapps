<?php
session_start();
require 'controllers/search.php';

?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">
        <title>Installation Profiles</title>
    </head>
    <body>

<!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="../"><img src="images/logo.svg" height="25"></a>
  <div class="navbar-header">     
      <a class="navbar-brand" href="#"> Installation Profiles </a>  
  </div>  

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#entries"
    aria-controls="entries" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="entries">

        <!-- Links -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="./printers.php">Printers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./servers.php">Servers</a>
        </li>
        </ul>
            <!-- Links -->    
    </div>
    <!-- Collapsible content -->
</nav>

<div class="container pt-md-5">
        
    <section>
    
        <div class="container container-fluid px-md-5 center-block" >
            <form action="profiles.php" method="post" class='mx-auto' >
                <div class="form-group col-xs-4">
                    <input type="text" name="search" class='form-control text-center bg-light' placeholder="Search for Company, Account or IP" autocomplete="off">
                </div>
            </form>

            <table id="profiles" class='table table-hover table-bordered searchresults'>
                    <thead id="header">
                        <tr class="header thead-light" >
                            <th class="profile">Profile</th>
                            <th class="account">Account</th>
                            <th class="project">Project</th>
                            <th class="solutions">Solutions Installed</th>
                            <th class="owner">App Owner</th>
                            <th>Status</th>
                            <th>Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(isset($_POST['search'])&&!empty(showProfiles($_POST['search'])))
                    {
                        showProfiles($pdo,$_POST['search']); 
                    }    
                    ?>
                    </tbody>
            </table>
            <div id="note" style="display:none"><p style="text-align:center">Start searching or try a different search term. See all entries by searching blank.</p></div>
        </div>
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
        $( document ).ready(function(){  
            var tbody = $("#profiles tbody");
            if (tbody.children().length == 0) {
            document.getElementById('note').style.display = "inline";
            document.getElementById('header').style.display = "none";
                    }   
            });
    </script>
</html>