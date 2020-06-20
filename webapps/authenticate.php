<?php
require 'config.php';
require 'controllers/functions.php';
require 'config.php';

session_start();

if(isset($_SESSION['sa']) && isset($_SESSION['gn']))
{
    header("location: printers.php");
}

if(isset($_POST['username']) && isset($_POST['password']))
{
    $con = mySQLConnect();

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password, firstname, lastname FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
   
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $firstname, $lastname);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['sa'] = $_POST['username'];
            $_SESSION['gn'] = $firstname." ".$lastname;
            header('location: printers.php');  

        } else {
          echo 'Incorrect password!';
        }
    } else {
       echo 'Incorrect username!';
    }

	$stmt->close();
}

else 
    {

        header('location: login.php');
    }
}
?>