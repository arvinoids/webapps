<?php
    session_start();

    if(isset($_SESSION['sa']) && isset($_SESSION['gn']) )
    {
        header("location: printers.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
    <title>Login</title>
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	</head>
	<body>
        <div class="wrapper">
            <div id="formContent">
              <!-- Tabs Titles -->
          
              <!-- Icon -->
              <div class="">
                <a href="../"><img src="images/logo_rgb.svg" vspace="60" id="icon" alt="Lexmark Logo" /></a>
              </div>
          
              <!-- Login Form -->
              <form action="authenticate.php" method="post">
                <input type="text" id="username" class="" name="username" placeholder="Username">
                <input type="password" id="password" class="" name="password" placeholder="Password">
                <input type="submit" class="btn btn-success mt-3 mb-3" value="Log In to Printer Reservation">
                <br>
                <!--<input type="button" onclick="window.location.href = 'printersview.php'" value="View Only" class="btn btn-light mb-4 btn-sm">-->
                <a href="printersview.php" class="underlineHover" style="font-size:80%">View Only</a>
              </form>
          
              <!-- Register -->
              <div id="formFooter">
              <div class="d-flex justify-content-around"><a class="underlineHover p-3" href="help.php">Help</a><a class="underlineHover p-3" href="register.html">Register</a></div> 
              </div>
          
            </div>
          </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>