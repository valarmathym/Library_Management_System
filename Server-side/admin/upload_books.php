<?php
session_start();
require_once "../config/db.php"; 
include "../page_parts/header.php";

if(!isset($_SESSION["user_id"])){
       header("location:./admin-login.php");
    }
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/style.css">

     <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        <script src="/js/jquery.form.js"></script> 
    <title>Upload books</title>
</head>
<body>
    
  <div class="wrapper">  
 <div class="admin-dash">
        <h1> Add/ Insert Book</h1><br>
        
        <div class="flex-container">  
             <div class="flex-item-left">
                    <?php  
                        include "../page_parts/admin-sidebar.php";  
                    ?>
              </div>
            
                <div class="flex-item-right" id="ad-content">
                <?php

                if (isset($_POST['submit'])) {
                    $title = $_POST['title'];
                    $author= $_POST['author'];
                    $publisher = $_POST['publisher'];
                    $language = $_POST['language'];
                    $category = $_POST['category'];

                //file upload
                    $image = $_FILES["choosefile"]["name"];
                    $tempname = $_FILES["choosefile"]["tmp_name"];  
                    $folder = "imgs/".basename($image); 
           
                    // prepared statement to avoid SQL injection
                    $stmt = $conn->prepare("INSERT INTO books (title, author, publisher, language, category, image) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssss", $title, $author, $publisher, $language, $category, $image);

             if ($stmt->execute()) {
                    if (move_uploaded_file($tempname, $folder)) {
                        echo "Book uploaded successfully.";
                    } else {
                        echo "Book data saved, but failed to upload image.";
                    }

            
                    // query to insert the submitted data
            //    $sql = "INSERT INTO books (title, author, publisher, language, category, image) VALUES ('$title','$author','$publisher','$language', '$category', '$image')";

                        // function to execute above query
            //           mysqli_query($conn, $sql);       

                        // Add the image to the folder
        //      if (move_uploaded_file($tempname, $folder)) {
            //        echo "Book uploaded successfully";
        //     }else{
        //         echo "Failed to upload Book";
        //          }
                }
            }

?>
<table border="1" class="">
 <form  action="<?php echo $_SERVER["PHP_SELF"];?>"  method="POST" enctype="multipart/form-data" >
        <tr>
        <td><label for="title">Book Title</label></td>
        <td><input type="text" name="title"  id="title" required></td>
       </tr>

        <tr>
        <td><label for="author">Author</label></td>
        <td><input type="text" name="author"  id="author" required></td>
       </tr> 

        <tr>
        <td> <label for="publisher">Publisher</label></td>
        <td><input type="text" name="publisher"  id="publisher" required></td>
       </tr>

       <tr>
        <td> <label for="language">Language</label></td>
        <td><input type="text" name="language"  id="language" required></td>
       </tr>

       <tr>
        <td> <label for="category">Category</label></td>
        <td><input type="text" name="category" id="category" required></td>
       </tr>

       <tr>
        <td><label for="image">Upload file</label></td>
        <td><input type="file" name="choosefile" id="image" required></td>
       </tr>

        <tr align-"center">  
        <td colspan="2"><button type="submit" name="submit" id="submit">Upload Book</button></td>
       </tr>
    </form>
</table>
  
</div>
</div>
</div>
     <?php
       include "../page_parts/footer.php";
      ?> 
   </div>
</body>
</html>