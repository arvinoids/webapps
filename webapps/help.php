
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/custom.css">
        <title>Help - Level 3 Printer Reservation System</title>
    </head>
    <body>

<!--Nav-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="../"><img src="images/logo.svg" height="25"></a>
    <div class="navbar-header">     
        <a class="navbar-brand" href="#"> Using the Printer Reservation System </a>  
    </div>  
  
    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#options"
      aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="options">
  
          <!-- Links -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link " href="printers.php">Printers</a>
            </li>  
          </ul>
              <!-- Links -->    
      </div>
      <!-- Collapsible content -->
  </nav>
<div class="container-fluid px-md-5 py-md-5">
  <h5>Introduction</h5>
    <p>This system can be used to reserve MFPs and printers in the Level 3 Lab. The system will add your IP address in the restricted server list so that only you are able to access the web interface, and print to the device.</p>
    <p class="font-italic">Note: There is a <a href="printersview.php">View Only</a> mode from the login screen. Login is not required, but you will not be able to reserve devices.</p>
  <h5>How to register as a new user</h5>
    <p>The registration link is accessible from the login screen or <a href="register.html" target="_BLANK">here</a>. Fill in your details and click Submit. Please remember your password as there is currently no reset or recovery in place. This is still a work in progress. Once you have entered your details and there are no errors, you will be able to login immediately.</p>
  <h5>How to reserve a printer</h5>
    <p>Once you are logged in, you will see a list of all available printers in the lab. Note that the system does not know if a printer is online or not. To be safe, click on the model of the printer and see if you are able to access the page. 
  Once you are sure that the printer is online, click on the Reserve button and confirm your reservation. You may use the Search field at the top of the list to find a specific model.</p>
    <p>Reserving the printer will ensure that no other user is able to access the printer to make changes to the settings, and also blocking jobs from all IP addresses other than your own.</p>
  <h5>How to change the reservation settings to add IP addresses</h5>
    <p>The system uses the printer's TCP/IP Restricted Server List to restrict other IP addresses. If you want to add an IP address of a print server or computer, 
      go to the printer's web interface into<br/> <b>Settings > Network/Ports > TCP/IP > Restricted Server List </b> and add the IP addresses in the list as needed.
    Don't forget to hit <b>Save</b> or <b>Submit</b> after making the change.</p>
  <h5>How do I release a printer</h5>
    <p>To release the printer, simply click the Release button and confirm.</p>
  <h5>How do add printer that is not in the list?</h5>
    <p>To add a printer, click on Actions on the upper right and select Add a Printer. A new tab will appear that will ask for the IP address of the printer. The model number will be autodetected. Confirm that it is correct and hit Submit. You will get a message if the submission is successful.</p>
  <h5>What if I need a specific printer that is already reserved, what do I do?</h5>
    <p>If a printer is already reserved, you will see a "Request" button for that printer. Clicking the button will send out an email to the current user of the printer and to the system admin, alerting that you are requesting access to the printer. 
      The user can either add you to the restricted server list, or release the printer. If your request is urgent, you may contact the admin directly to check with the user and manually release the printer if needed.</p>
  <h5>Currently In Development</h5>
  <ul>
    <li><p>There is currently no way to change the password or reset the password. If you forgot your password, please notify the admin and your account will be deleted so you can reregister and use your preferred password. Your reserved printers will be retained as long as you use the same username.</p></li>
    <li><p><del>Printer status - Online/Offline</del> Done!</p>
    <li><p><del>View Only Mode</del> Done!</p>
    <li><p>Other items are in the pipeline. Watch out!</p>
  </ul>

  <h5>Questions?</h5>
  <p>If you have more questions, you may send an email to the <a href="mailto:amagaway@lexmark.com?subject=Printer%20Reservation%20Question">admin</a>.</p>

  <h5><b>IMPORTANT NOTE<b></h5>
    <p>Please RELEASE the printer when you are done using it, so that others may be able to use it. If a another user is requesting access to the printer but you are still working on it, please reply to all on the request email and state your reason so that the admin and the user will be notified.</p>
  

</div>
    <footer class="footer py-md-6">
      <div class="container">
        <span class="text-muted">© Copyright 2020 Lexmark Solutions Support Team.</span>
      </div>
    </footer>
    </body>

    </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>