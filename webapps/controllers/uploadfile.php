<?php
 //   ini_set('display_errors', 'On');
 //   ini_set('html_errors', 0);
   require '../config.php';
   require 'database.php';
   $currentDirectory = getcwd();
   $uploadDirectory = "/../uploads/";
   $ip = $_POST['ip'];

   $errors = []; // Store errors here

   $fileExtensionsAllowed = ['fls','cfg','txt','jpeg','jpg','png','doc','docx','ppt','pptx','pdf','xml','zip','ucf']; // These will be the only file extensions allowed 
   $fileName = $ip."_".$_FILES['file']['name'];
   $fileSize = $_FILES['file']['size'];
   $fileTmpName  = $_FILES['file']['tmp_name'];
   $fileType = $_FILES['file']['type'];
   $tmp = explode('.',$fileName);
   $fileExtension = strtolower(end($tmp));

   $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Upload Results</title>
</head>
<body>
    <div class="alert alert-warning text-center" role="alert">
<?php 
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
        $desc = $_POST['description'];
        $path = "uploads/".$fileName;
        $findfile = "SELECT name FROM ip_files where name='$fileName'";
        $entry = $pdo->query($findfile)->fetch();
        if (empty($entry)) {
        $insert = "INSERT INTO ip_files ( ip,name,description,path ) VALUES ('$ip','$fileName','$desc','$path')";
        } else $insert = "UPDATE ip_files SET description='$desc', path='$path' WHERE name='$fileName'";
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
?><a href="../ipview.php?ip=<?php echo $ip?>">Go Back to the IP</a> or <a href="../viewfiles.php?ip=<?php echo $ip?>">View files</a>.
    </div>
</body>
</html>
