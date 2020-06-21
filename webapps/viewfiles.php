<?php
require 'config.php';
require 'controllers/functions.php';
require_once 'vendor/autoload.php';
ini_set('display_errors', 'On');
ini_set('html_errors', 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    
    <title><?php echo $_GET['ip']?> - Attachments</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
  <div class="navbar-header">     
      <a class="navbar-brand" href="#"> View Attachments - <?php echo $_GET['ip']?> </a>  
  </div>
  <div class="collapse navbar-collapse" id="options">
  
          <!-- Links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a class="nav-link" href="#fileUpload" data-toggle="modal" data-target="#fileUpload">
                Add File</a>
            </li>  
          </ul>
              <!-- Links -->    
      </div>  
</nav>


<div class="container pt-3 d-flex justify-content-center">
    <section>
    <div class="px-3 py-3 border rounded">
        <table class="table table-striped">
            <tbody>
            <?php showFiles($_GET['ip']); ?>
            </tbody>
        </table> 
    </div>
    <div class="alert alert-warning" id="response"></div>
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
      <form method="post"  action="controllers/uploadfile.php" enctype="multipart/form-data" id="data">
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
        <input id="submitbtn" type="submit" class="btn btn-primary btn-sm" data-dismiss="modal" value="Upload File">
      </div>
    </form>
    </div>
  </div>
</div>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){

    $("#submitbtn").click(function(e){
        e.preventDefault();    
        var formData = new FormData(this);

        $.ajax({
            url: "controllers/uploadfile2.php",
            type: 'POST',
            data: formData,
            success: function (data) {
                alert(data)
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});

</script>
</html>
