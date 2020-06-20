<?php
require 'config.php';
require 'controllers/functions.php';
require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="css/ipview.css" rel="stylesheet">

    <title><?php echo $_GET['ip']?> - Installation Profile Viewer</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
  <div class="navbar-header">     
      <a class="navbar-brand" href="#"> Update Profile - <?php echo $_GET['ip']?> </a>  
  </div>
  <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="ipview.php?ip=<?php echo $_GET['ip']?>">Back to Profile View</a>
            </li>  
          </ul>
  
</nav>

<form action="controllers/updateprofile.php" method="POST">
    <div class="container pt-3 d-flex justify-content-center">
        <form action="controllers/updateprofile.php" method="POST">
        <section>
            <?php updateProfile($_GET['ip']); ?>
            <div class="pb-3">
                <table>
                    <tbody>
                        <tr style="text-align:center"><td><input type="submit" class="btn btn-secondary form-control" value="Update"></td></tr>
                    </tbody>
                </table> 
            </div>
        </section>    
    </div>
</form>
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
</html>
