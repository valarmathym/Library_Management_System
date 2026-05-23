<?php
require_once "../config/db.php";
include "../page_parts/header.php";

session_start();

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
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="wrapper">
    <div class="admin-dash">
          <h1> View BookList</h1><br>
          
          <div class="flex-container">  
                <div class="flex-item-left">
                    <?php  
                        include "../page_parts/admin-sidebar.php";  
                    ?>
                </div>
               
                <div class="flex-item-right" id="ad-content">
                    <div id="insert"><button><a href="upload_books.php"><strong>INSERT BOOK</strong></a></button></div> 
                    <?php
                        $sql = "SELECT * FROM books"; 
                        $result = $conn->query($sql);
                        if($result->num_rows>0)
                        {
                            echo "<table>
                            <tr>
                                    <th>BookID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Language</th>
                                    <th>Category</th>
                                    <th>Availability</th>
                                    <th colspan='2'>Action</th>
                            </tr>";
                             
                            $i=0;
                            while($row = $result->fetch_assoc())
                            {
                                $i++;
                                 echo "<tr>";
                                    echo "<td>{$row["id"]}</td>";
                                    echo "<td><img src=../img/". $row['image']."></td>";
                                    echo "<td>{$row["title"]}</td>";
                                    echo "<td>{$row["author"]}</td>";
                                    echo "<td>{$row["publisher"]}</td>";
                                    echo "<td>{$row["language"]}</td>";
                                    echo "<td>{$row["category"]}</td>";
                                    echo "<td>{$row["availability"]}</td>";
                                    echo "<td colspan='2'><a href='editBook.php?id=" . $row['id'] . "'>EDIT</a> | <a href='deleteBook.php?id=" . $row['id'] . "'>DELETE</a></td>";
                                 echo "</tr>";

                            } 
                                echo "</table>";
                            
                        }
                        else{
                            echo "<p class='error'>No User Records Found! </p>";
                        }
                   ?>  
                   
                </div>
         </div>
    </div>
 </div>
   <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>
