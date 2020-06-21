<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">
        <title>Add a file</title>
    </head>
    <body>

<!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#"><img src="images/logo.svg" height="25"></a>
  <div class="navbar-header">     
      <a class="navbar-brand" href="#"> Add file - <?php echo $_GET['ip']?> </a>  
  </div>
  <div class="collapse navbar-collapse" id="options">
  
          <!-- Links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a  class="nav-link" href="#" onclick="window.close();">Close</a>
            </li>  
          </ul>
              <!-- Links -->    
      </div>  
</nav>

<div class="container">               
    <div style=" margin-top:50px" class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="card" style="width: 30rem;">
            <div class="card-body" >
                <form method="post"  action="controllers/uploadfile.php" enctype="multipart/form-data">
                    Select file to upload:
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="filename">
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="d-flex justify-content-around">
                        <button class="btn btn-outline-secondary">Cancel</button>
                        <input class="btn btn-primary" type="submit" value="Upload file" name='submit'>
                    </div>
                    
                </form>
            </div>
        </div>
    </div> 
</div>

</div>   


    </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
function close_window() {
  if (confirm("Close Window?")) {
    close();
  }
}
</script>
<script src="js/scripts.js"></script>
</html>