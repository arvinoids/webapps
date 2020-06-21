<?php
require 'config.php';
require 'controllers/functions.php';
require_once 'vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="css/ipview.css" rel="stylesheet">

    <title><?php echo $_GET['ip']?> - Installation Profile Viewer</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
  <div class="navbar-header">     
      <a class="navbar-brand" href="#"> Profile Viewer - <?php echo $_GET['ip']?> </a>  
  </div>
  <div class="collapse navbar-collapse" id="options">
  
          <!-- Links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a  class="nav-link" href="ipupdate.php?ip=<?php echo $_GET['ip']?>">Edit Profile</a>
            </li>  
          </ul>
              <!-- Links -->    
      </div>  
</nav>


<div class="container pt-3 d-flex justify-content-center">
    <section>
        <?php fetchProfile($_GET['ip']); ?>
    </section>
</div>

<footer class="page-footer font-small">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="https://level3.dhcp.lexmark.com/" style="color:rgb(165, 165, 165)"> Level 3 Solutions Team </a>
    </div>
<!-- Copyright -->

</footer>

<!-- Modal -->
<div class="modal fade" id="fileUpload" tabindex="-1" role="dialog" aria-labelledby="fileUpload" aria-hidden="true" style="font-size:85%;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add a file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post"  action="controllers/uploadfile.php" enctype="multipart/form-data">
      <div class="modal-body">
        <!--start of upload form-->
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="file" name="file">
                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
            </div>
        </div>

        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
            </div>
            <input type="text" class="form-control" name="description">
            <input type="hidden" name="ip" value="<?php echo $_GET['ip']?>">
        </div>
        <!--end of upload form-->        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        <input class="btn btn-primary btn-sm" type="submit" value="Upload file" name='submit'>
      </div>
    </form>
    </div>
  </div>
</div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</html>
