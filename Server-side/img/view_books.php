<?php

require_once "../config/db.php";

session_start();

if(isset($_SESSION["id"])){
    header("location:dashboard_admin1.php");
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
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="/js/jquery.form.js"></script> 
    <title>Admin Dashboard</title>
</head>
<body>
     <header id="home-page">
        <nav class="nav">
           <div class="nav-container">
              
                      <a href="./index.html" class="nav-logo">
                        <img src="../img/university-logo.png" id="logo" alt="university Logo">
                        <span class="logo-text">Australia University LMS</span>
                       </a>
           </div>
        </nav>
     </header>
    <div class="admin-dash">
          <h1> View Books Details</h1>
          <div class="ad-wrapper">  
                <div>
                  <?php  
                      include "../page_parts/admin-sidebar.php";  
                   ?>
                </div>
                <div id="ad-content">
                    <?php
                        $sql = "SELECT * FROM books"; 
                        $result =$conn->query($sql);
                        if($result->num_rows>0)
                        {
                            echo "<table>
                            <tr>
                                    <th>SNo</th>
                                    <th>image</th>
                                    <th>title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Language</th>
                                    <th>Category</th>
                                    
                            </tr>";
                             
                            $i=0;
                            while($row = $result->fetch_assoc())
                            {
                                $i++;
                                 echo "<tr>";
                                    echo "<td>{$i}</td>";
                                    echo "<td><img src=./upload/ " . $row['image']."></td>";
                                    echo "<td>{$row["title"]}</td>";
                                    echo "<td>{$row["author"]}</td>";
                                    echo "<td>{$row["publisher"]}</td>";
                                    echo "<td>{$row["language"]}</td>";
                                    echo "<td>{$row["category"]}</td>";
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

  <?php
       include "../page_parts/footer.php";
   ?>   
</body>
</html>