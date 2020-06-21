<?php
 //   ini_set('display_errors', 'On');
 //   ini_set('html_errors', 0);
   require '../config.php';
   require 'database.php';
   $currentDirectory = getcwd();
   $uploadDirectory = "/../uploads/";

   $errors = []; // Store errors here

   $fileExtensionsAllowed = ['jpeg','jpg','png','doc','docx','ppt','pptx','pdf','xml','zip','ucf']; // These will be the only file extensions allowed 

   $fileName = $_FILES['file']['name'];
   $fileSize = $_FILES['file']['size'];
   $fileTmpName  = $_FILES['file']['tmp_name'];
   $fileType = $_FILES['file']['type'];
   $fileExtension = strtolower(end(explode('.',$fileName)));

   $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
   if (isset($_POST['submit'])) {

     if (! in_array($fileExtension,$fileExtensionsAllowed)) {
       $errors[] = "This file extension is not allowed. Please upload a document, image or zip file";
     }

     if ($fileSize > 40000000) {
       $errors[] = "File exceeds maximum size (40MB)";
     }

     if (empty($errors)) {
       $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

       if ($didUpload) {
        $pdo = dbConnect();
        $ip = $_POST['ip'];
        $desc = $_POST['description'];
        $path = "uploads/".$fileName;
        $insert = "INSERT INTO ip_files ( ip,name,description,path ) VALUES ('$ip','$fileName','$desc','$path')";
        $pdo->query($insert);
         echo "The file " . basename($fileName) . " has been uploaded.";
       } else {
         echo  "An error occurred. Please contact the administrator.";
       }
     } else {
       foreach ($errors as $error) {
         echo $error . "These are the errors" . "\n";
       }
     }
   }
?>

